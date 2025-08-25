<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BlogsModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContentBlocksModel;
use App\Models\PagesModel;
use App\Services\EmailService;
use Gregwar\Captcha\CaptchaBuilder;
use App\Constants\ActivityTypes;

class FrontEndController extends BaseController
{
    private EmailService $emailService;
    private SimpleCacheService $cacheService;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->curlrequest = \Config\Services::curlrequest();
    }

    //############################//
    //             Home           //
    //############################//
    public function index()
    {

        //load home view
        return view('front-end/themes/'.getCurrentTheme().'/home/index');
    }

    //############################//
    //           Blogs            //
    //############################//
    public function getBlogs()
    {
        $tableName = 'blogs';
        $blogsModel = new BlogsModel();

        // Set data to pass in view
        $data = [
            'blogs' => $blogsModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $blogsModel->pager,
            'total_blogs' => $blogsModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/blogs/index', $data);
    }

    public function getBlogDetails($slug)
    { 
        $tableName = 'blogs';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = str_replace('[Record]', 'Blog', config('CustomConfig')->notFoundMsg);
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $blogId = getTableData($tableName, $whereClause, 'blog_id');
        $blogsModel = new BlogsModel();
		$categoriesModel = new CategoriesModel();
        $data = [
            'blog_data' => $blogsModel->find($blogId),
            'blogs' => $blogsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll(),
            'categories' => $categoriesModel->orderBy('title', 'ASC')->findAll(),
        ];
        return view('front-end/themes/'.getCurrentTheme().'/blogs/view-blog', $data);
    }
    
    //############################//
    //           Pages            //
    //############################//
    public function getPageDetails($slug)
    {
        $tableName = 'pages';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = str_replace('[Record]', 'Page', config('CustomConfig')->notFoundMsg);
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $pageId = getTableData($tableName, $whereClause, 'page_id');
        $pagesModel = new PagesModel();
        $data = [
            'page_data' => $pagesModel->find($pageId)
        ];
        return view('front-end/themes/'.getCurrentTheme().'/pages/view-page', $data);
    }

    //############################//
    //          Search            //
    //############################//
    public function searchResults()
    {
        $session = session();
        $searchQuery = $this->request->getGet('q');

        //if no search query is passed
        if(empty($searchQuery)){
            return redirect()->to('/');
        }
        
        // Load the models
        $blogsModel = new BlogsModel();
        $pagesModel = new PagesModel();
        
        $data["searchQuery"] = $searchQuery;
        
        // Blogs search
        $data['blogsSearchResults'] = $blogsModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('excerpt', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
                ->orLike('tags', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        
        // Pages search
        $data['pagesSearchResults'] = $pagesModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
                ->orLike('meta_description', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        
        // Log activity
        logActivity(null, ActivityTypes::SEARCH, 'Search made for: ' . $searchQuery);
        
        // Load the view to display search results
        return view('front-end/themes/'.getCurrentTheme().'/search/index', $data);
    }

    public function getSearchFilter()
    {
        try {
            $session = session();
            $type = $this->request->getGet('type');
            $searchQuery = trim($this->request->getGet('key'));
            
            // Initialize default data array
            $data = [
                "searchQuery" => $searchQuery,
                'blogsSearchResults' => null,
                'pagesSearchResults' => null
            ];
    
            try {
                // Load the models
                $blogsModel = new BlogsModel();
                $pagesModel = new PagesModel();
    
                if (strcasecmp($type, 'category') === 0) {
                    try {
                        // Blogs search
                        $whereClause = ['title' => $searchQuery];
                        $categoryId = searchTableData('categories', 'title', $searchQuery, 'category_id') ?? "not-found";           
                        $data['blogsSearchResults'] = $blogsModel
                            ->groupStart()
                                ->like('category', $categoryId)
                            ->groupEnd()
                            ->where('status', '1')
                            ->orderBy('created_at', 'DESC')
                            ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                            ->findAll();
                    } catch (\Exception $e) {
                        $data['blogsSearchResults'] = null;
                        log_message('error', 'Category search error: ' . $e->getMessage());
                    }
                }
    
                if (strcasecmp($type, 'tag') === 0) {
                    try {
                        // Blogs search
                        $data['blogsSearchResults'] = $blogsModel
                            ->groupStart()
                                ->like('tags', $searchQuery)
                            ->groupEnd()
                            ->where('status', '1')
                            ->orderBy('created_at', 'DESC')
                            ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                            ->findAll();
                    } catch (\Exception $e) {
                        $data['blogsSearchResults'] = null;
                        log_message('error', 'Tag search error: ' . $e->getMessage());
                    }
                }
    
                if (strcasecmp($type, 'author') === 0) {
                    try {
                        // Blogs search
                        //get $userId from $searchQuery
                        $userId = getUserIdFromName($searchQuery) ?? "not-found";
                        $data['blogsSearchResults'] = $blogsModel
                            ->groupStart()
                                ->like('created_by', $userId)
                            ->groupEnd()
                            ->where('status', '1')
                            ->orderBy('created_at', 'DESC')
                            ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                            ->findAll();
                    } catch (\Exception $e) {
                        $data['blogsSearchResults'] = null;
                        log_message('error', 'Author blogs search error: ' . $e->getMessage());
                    }
    
                    try {
                        // Pages search
                        $data['pagesSearchResults'] = $pagesModel
                            ->groupStart()
                                ->like('created_by', $userId)
                            ->groupEnd()
                            ->where('status', '1')
                            ->orderBy('created_at', 'DESC')
                            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                            ->findAll();
                    } catch (\Exception $e) {
                        $data['pagesSearchResults'] = null;
                        log_message('error', 'Author pages search error: ' . $e->getMessage());
                    }
                }
    
            } catch (\Exception $e) {
                log_message('error', 'Model initialization error: ' . $e->getMessage());
                // All results already initialized as null
            }
    
            return view('front-end/themes/'.getCurrentTheme().'/search/filter', $data);
    
        } catch (\Exception $e) {
            log_message('error', 'Search filter error: ' . $e->getMessage());
            // Return view with all null results
            return view('front-end/themes/'.getCurrentTheme().'/search/filter', [
                "searchQuery" => $searchQuery ?? '',
                'blogsSearchResults' => null,
                'pagesSearchResults' => null
            ]);
        }
    }

    //############################//
    //         Sitemaps           //
    //############################//
    public function getSitemaps()
    {


        // Models to query
        $models = [
            'blog' => new BlogsModel(),
            'page' => new PagesModel()
        ];

        // Fetch data from each model
        $sitemapData = [];
        foreach ($models as $key => $model) {
            $sitemapData[$key] = $model->select('slug, updated_at, created_at')
                ->where('status', '1') // Only active records
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_HIGH', 50))) 
                ->findAll();
        }

        // Log activity for sitemap access
        logActivity(null, ActivityTypes::SITEMAP, 'Sitemap accessed');

        // Generate the sitemap XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . PHP_EOL;
        $xml .= '      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . PHP_EOL;
        $xml .= '      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . PHP_EOL;
        $xml .= '            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
        $xml .= '<!-- created with IgniterCMS Sitemap Generator www.github.com/akassama/igniter-cms -->' . PHP_EOL;

        // Add static URLs (homepage and other static pages)
        $staticUrls = [
            ['loc' => base_url('/'), 'lastmod' => date('c'), 'priority' => '1.00'],
            ['loc' => base_url('/home'), 'lastmod' => date('c'), 'priority' => '0.80']
        ];

        foreach ($staticUrls as $url) {
            $xml .= $this->generateUrlXml($url['loc'], $url['lastmod'], $url['priority']);
        }

        // Add dynamic URLs from models
        foreach ($sitemapData as $type => $items) {
            foreach ($items as $item) {
                $url = base_url("/{$type}/{$item['slug']}");
                $lastmod = !empty($item['updated_at']) ? $item['updated_at'] : $item['created_at'];
                $priority = $this->calculatePriority($type);

                $xml .= $this->generateUrlXml($url, $lastmod, $priority);
            }
        }

        // Close the XML tag
        $xml .= '</urlset>';

        // Set the response headers
        $this->response->setContentType('application/xml');
        return $this->response->setBody($xml);
    }

    /**
     * Helper function to generate a single <url> XML block.
     *
     * @param string $loc URL of the page
     * @param string $lastmod Last modified date in ISO 8601 format
     * @param string $priority Priority of the page
     * @return string
     */
    private function generateUrlXml(string $loc, string $lastmod, string $priority): string
    {
        $xml = '<url>' . PHP_EOL;
        $xml .= '  <loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;
        $xml .= '  <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
        $xml .= '  <priority>' . $priority . '</priority>' . PHP_EOL;
        $xml .= '</url>' . PHP_EOL;
        return $xml;
    }

    /**
     * Helper function to calculate priority based on content type.
     *
     * @param string $type Content type (e.g., blog, page, event)
     * @return string
     */
    private function calculatePriority(string $type): string
    {
        switch ($type) {
            case 'blog':
                return '0.90';
            case 'page':
                return '0.80';
            default:
                return '0.60';
        }
    }


    //############################//
    //         Robots.txt         //
    //############################//
    public function getRobotsTxt() {
        // Set the content type to plain text
        header('Content-Type: text/plain');
    
        $robots_txt = "User-agent: *\n";
    
        $disallowed_paths = array(
            '/admin',           // Disallow access to the admin module
            '/api',             // Disallow access to the API
            '/uploads/temp',    // Disallow access to temporary uploads
            '/maintenance',    // Disallow access to maintenance pages
            '/sign-in',         // Disallow access to the sign-in page
            '/sign-up',         // Disallow access to the sign-up page
            '/account',         // Disallow access to user account pages (often sensitive)
            '/search',          // Disallow access to search results pages (can create duplicate content)
            '/login',           // Another common login path
            '/register',        // Another common registration path
            '/forgot-password', // Disallow forgot password functionality
            '/password-reset',  // Disallow password reset functionality
            '/services',        // Disallow thank you pages (often similar to order confirmation)
        );
    
        foreach ($disallowed_paths as $path) {
            $robots_txt .= "Disallow: " . $path . "\n";
        }
    
        // Allow access to the root and public uploads
        $allowed_paths = array(
            '/',
            '/public/uploads',
        );
    
        foreach ($allowed_paths as $path) {
            $robots_txt .= "Allow: " . $path . "\n";
        }
    
        // Add the sitemap directive
        $robots_txt .= "Sitemap: " . base_url('sitemap.xml') . "\n";
        
        // Log activity for Robots feed access
        logActivity(null, ActivityTypes::ROBOTS, 'Robots txt accessed');
    
        // Output the robots.txt content
        echo $robots_txt;
    }

    //############################//
    //         RSS Feed           //
    //############################//
    public function getRssFeed()
    {
        // Models to query (same as sitemap)
        $models = [
            'blog' => new BlogsModel(),
            'page' => new PagesModel()
        ];
    
        // Fetch data from each model
        $rssData = [];
        foreach ($models as $key => $model) {
            // Define the summary/description field for each model
            $summaryField = $this->getSummaryField($key);
    
            // Select fields dynamically
            $fields = ['slug', 'title', 'updated_at', 'created_at'];
            if ($summaryField) {
                $fields[] = $summaryField;
            }
    
            // Fetch data
            $rssData[$key] = $model->select($fields)
                ->where('status', '1') // Only active records
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_HIGH', 50)))
                ->findAll();
        }
    
        // Log activity for RSS feed access
        logActivity(null, ActivityTypes::RSS, 'RSS feed accessed');
    
        // Generate the RSS XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . PHP_EOL;
        $xml .= '  <channel>' . PHP_EOL;
        $xml .= '    <title>Your CMS Title</title>' . PHP_EOL;
        $xml .= '    <description>Latest updates from your CMS</description>' . PHP_EOL;
        $xml .= '    <link>' . base_url() . '</link>' . PHP_EOL;
        $xml .= '    <atom:link href="' . base_url('rss') . '" rel="self" type="application/rss+xml" />' . PHP_EOL;
        $xml .= '    <lastBuildDate>' . date('r') . '</lastBuildDate>' . PHP_EOL;
        $xml .= '    <language>en-us</language>' . PHP_EOL;
    
        // Add dynamic items from models
        foreach ($rssData as $type => $items) {
            foreach ($items as $item) {
                $url = base_url("/{$type}/{$item['slug']}");
                $title = htmlspecialchars($item['title'], ENT_XML1, 'UTF-8');
                $summaryField = $this->getSummaryField($type);
                $description = $summaryField ? htmlspecialchars($item[$summaryField] ?? '', ENT_XML1, 'UTF-8') : '';
                $pubDate = !empty($item['updated_at']) ? date('r', strtotime($item['updated_at'])) : date('r', strtotime($item['created_at']));
    
                $xml .= '    <item>' . PHP_EOL;
                $xml .= '      <title>' . $title . '</title>' . PHP_EOL;
                $xml .= '      <description>' . $description . '</description>' . PHP_EOL;
                $xml .= '      <link>' . $url . '</link>' . PHP_EOL;
                $xml .= '      <guid>' . $url . '</guid>' . PHP_EOL;
                $xml .= '      <pubDate>' . $pubDate . '</pubDate>' . PHP_EOL;
                $xml .= '    </item>' . PHP_EOL;
            }
        }
    
        // Close the RSS XML tags
        $xml .= '  </channel>' . PHP_EOL;
        $xml .= '</rss>' . PHP_EOL;
    
        // Set the response headers
        $this->response->setContentType('application/rss+xml');
        return $this->response->setBody($xml);
    }
    
    /**
     * Helper function to get the summary/description field for a given content type.
     *
     * @param string $type Content type (e.g., blog, page, event)
     * @return string|null
     */
    private function getSummaryField(string $type): ?string
    {
        switch ($type) {
            case 'blog':
                return 'excerpt'; // Blogs use "excerpt"
            case 'page':
            default:
                return null; // Pages do not have a summary/description field
        }
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BlogsModel; 
use App\Models\CodesModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContentBlocksModel;
use App\Models\ThemesModel;
use App\Models\DataGroupsModel;
use App\Services\EmailService;

class APIController extends BaseController
{
    //GENERIC GET METHODS
    public function getModelData($apiKey)
    {
        // Define the list of allowed models
        $allowedModels = [
            'blogs' => 'App\Models\BlogsModel',
            'categories' => 'App\Models\CategoriesModel',
            'codes' => 'App\Models\CodesModel',
            'contentBlocks' => 'App\Models\ContentBlocksModel',
            'navigations' => 'App\Models\NavigationsModel',
            'pages' => 'App\Models\PagesModel',
            'themes' => 'App\Models\ThemesModel',
        ];

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Get model and optional where clause from query parameters
        $modelName = $this->request->getGet('model');
        $whereClause = $this->request->getGet('where_clause'); // Should be in JSON format if passed

        // Check if the model name is provided and valid
        if (!$modelName || !array_key_exists($modelName, $allowedModels)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid or unsupported model name provided.',
            ]);
        }

        // Instantiate the model from the allowed list
        $modelClass = $allowedModels[$modelName];
        $model = new $modelClass();

        // Apply multiple filters if the where clause is provided
        if ($whereClause) {
            $filters = json_decode($whereClause, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON format for where_clause.',
                ]);
            }

            // Loop through each condition and apply it to the query
            foreach ($filters as $key => $value) {
                $model->where($key, $value);
            }
        }

        // Order by created_at in descending order (if the column exists)
        if (in_array('created_at', $model->allowedFields)) {
            $model->orderBy('created_at', 'DESC');
        }

        // Get total count
        $totalModelData = $model->countAllResults(false); // Passing `false` to not reset the query

        // Fetch paginated data
        $modelData = $model->findAll($take, $skip);

        // Prepare and return the response
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalModelData,
            'take' => $take,
            'skip' => $skip,
            'data' => $modelData,
        ]);
    }

    //BLOGS API
    public function getBlog($apiKey, $blogId = null)
    {
        // Check if slug is provided
        if (!$blogId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Slug parameter is required.'
            ]);
        }

        // Fetch the blog blog by slug
        $blogsModel = new BlogsModel();
        $blog = $blogsModel->where('slug', $blogId)->first();
        if(isValidGUID($blogId)){
            $blog = $blogsModel->where('blog_id', $blogId)->first();
        }

        // Return blog or not found error
        if ($blog) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $blog
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Blog not found.'
            ]);
        }
    }
    
    public function getBlogs($apiKey)
    {
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch blogs model
        $blogsModel = new BlogsModel();

        // Order by created_at in descending order
        $blogsModel->orderBy('created_at', 'DESC');

        // Get total count
        $totalBlogs = $blogsModel->countAllResults();

        // Fetch paginated blogs
        $blogs = $blogsModel->findAll($take, $skip);

        // Prepare response
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalBlogs,
            'take' => $take,
            'skip' => $skip,
            'data' => $blogs
        ]);
    }

    public function getAllBlogs($apiKey)
    {
        // Fetch all blog blogs
        $blogsModel = new BlogsModel();
        // Order by created_at in descending order
        $blogsModel->orderBy('created_at', 'DESC');
        $blogs = $blogsModel->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll();

        // Return the list of blogs
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $blogs
        ]);
    }

    //PAGE API
    public function getPage($apiKey, $pageId = null)
    {
        // Check if slug is provided
        if (!$pageId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Slug parameter is required.'
            ]);
        }

        // Fetch the page by slug/id
        $pagesModel = new PagesModel();
        $page = $pagesModel->where('slug', $pageId)->first();
        if(isValidGUID($pageId)){
            $page = $pagesModel->where('page_id', $pageId)->first();
        }

        // Return page or not found error
        if ($page) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $page
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Page not found.'
            ]);
        }
    }

    public function getPages($apiKey)
    {
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch pages model
        $pagesModel = new PagesModel();
        
        // Order by created_at in descending order
        $pagesModel->orderBy('created_at', 'DESC');

        // Get total pages count
        $totalPages = $pagesModel->countAllResults();

        // Fetch paginated pages
        $pages = $pagesModel->findAll($take, $skip);

        // Prepare response
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPages,
            'take' => $take,
            'skip' => $skip,
            'data' => $pages
        ]);
    }

    public function getAllPages($apiKey)
    {
        // Fetch all page
        $pagesModel = new PagesModel();
        // Order by created_at in descending order
        $pagesModel->orderBy('created_at', 'DESC');
        $pages = $pagesModel->where('status', '1')->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))->findAll();

        // Return the list of pages
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $pages
        ]);
    }

    //NAVIGATIONS API
    public function getNavigation($apiKey, $navigationId = null)
    {
        // Check if navigationId is provided
        if (!$navigationId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Navigation Id parameter is required.'
            ]);
        }

        // Fetch the navigation by id
        $navigationsModel = new NavigationsModel();
        $navigation = $navigationsModel->where('navigationId', $navigationId)->first();

        // Return navigation or not found error
        if ($navigation) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $navigation
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Navigation not found.'
            ]);
        }
    }

    public function getNavigations($apiKey)
    {
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all navigations
        $navigationsModel = new NavigationsModel();

        // Order by order in ascending order
        $navigationsModel->orderBy('order', 'ASC');

        $navigations = $navigationsModel->findAll($take, $skip);

        // Get total count
        $totalNavigations = $navigationsModel->countAllResults();

        // Return the list of navigations
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalNavigations,
            'take' => $take,
            'skip' => $skip,
            'data' => $navigations
        ]);
    }

    //CATEGORIES API
    public function getCategory($apiKey, $categoryId = null)
    {
        // Check if categoryId is provided
        if (!$categoryId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Category Id parameter is required.'
            ]);
        }

        // Fetch the category by id
        $categoriesModel = new CategoriesModel();
        $category = $categoriesModel->where('categoryId', $categoryId)->first();

        // Return category or not found error
        if ($category) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $category
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Category not found.'
            ]);
        }
    }

    public function getCategories($apiKey)
    {
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all categories
        $categoriesModel = new CategoriesModel();

        // Order by order in ascending order
        $categoriesModel->where('status', '1')->orderBy('title', 'ASC');

        $categories = $categoriesModel->findAll($take, $skip);

        // Get total count
        $totalCategories = $categoriesModel->countAllResults();

        // Return the list of categories
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalCategories,
            'take' => $take,
            'skip' => $skip,
            'data' => $categories
        ]);
    }

    // CODES API
    public function getCode($apiKey, $codeId = null)
    {

        if (!$codeId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Code ID parameter is required.'
            ]);
        }

        $codesModel = new CodesModel();
        $code = $codesModel->where('code_id', $codeId)->first();

        if ($code) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $code
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Code not found.'
            ]);
        }
    }

    public function getCodes($apiKey)
    {

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        $codesModel = new CodesModel();
        $codes = $codesModel->findAll($take, $skip);

        // Get total count
        $totalCodes = $codesModel->countAllResults();

        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalCodes,
            'take' => $take,
            'skip' => $skip,
            'data' => $codes
        ]);
    }

    // CONTENT BLOCKS API
    public function getContentBlock($apiKey, $contentId = null)
    {

        if (!$contentId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Content ID parameter is required.'
            ]);
        }

        $contentBlocksModel = new ContentBlocksModel();
        $contentBlock = $contentBlocksModel->where('content_id', $contentId)->first();

        if ($contentBlock) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $contentBlock
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Content block not found.'
            ]);
        }
    }

    public function getContentBlocks($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $contentBlocksModel = new ContentBlocksModel();
        $contentBlocks = $contentBlocksModel->findAll($take, $skip);
    
        // Get total count
        $totalContentBlocks = $contentBlocksModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalContentBlocks,
            'take' => $take,
            'skip' => $skip,
            'data' => $contentBlocks
        ]);
    }    

    // THEMES API
    public function getTheme($apiKey, $themeId = null)
    {
        // Check if id is provided
        if (!$themeId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Theme ID parameter is required.'
            ]);
        }

        // Fetch the theme by id
        $themesModel = new ThemesModel();
        $theme = $themesModel->where('theme_id', $themeId)->first();

        // Return theme or not found error
        if ($theme) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $theme
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Theme not found.'
            ]);
        }
    }

    public function getThemes($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $themesModel = new ThemesModel();
        $themes = $themesModel->findAll($take, $skip);
    
        // Get total count
        $totalThemes = $themesModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalThemes,
            'take' => $take,
            'skip' => $skip,
            'data' => $themes
        ]);
    }

    //DATA GROUPS API
    public function getDataGroup($apiKey, $dataGroupId = null)
    {
        // Check if dataGroupId is provided
        if (!$dataGroupId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'DataGroup Id parameter is required.'
            ]);
        }

        // Fetch the DataGroup by id
        $dataGroupsModel = new DataGroupsModel();
        $dataGroup = $dataGroupsModel->where('data_group_id', $dataGroupId)->first();

        // Return DataGroup or not found error
        if ($dataGroup) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $dataGroup
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'DataGroup not found.'
            ]);
        }
    }

    public function getDataGroups($apiKey)
    {

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all dataGroups
        $dataGroupsModel = new DataGroupsModel();
        // Order by title in ascending order
        $dataGroupsModel->orderBy('title', 'ASC');
        $dataGroups = $dataGroupsModel->where('status', '1')->findAll($take, $skip);

        // Get total count
        $totalDataGroups = $dataGroupsModel->countAllResults();

        // Return the list of dataGroups
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalDataGroups,
            'take' => $take,
            'skip' => $skip,
            'data' => $dataGroups
        ]);
    }

    //SEARCH API
    public function searchResults($apiKey)
    {
        
        $searchQuery = trim($this->request->getGet('key'));

        // Validate search query
        if (empty($searchQuery)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Search query is required'
            ]);
        }

        // Initialize models
        $blogsModel = new BlogsModel();
        $pagesModel = new PagesModel();

        // Perform searches across different models
        $blogs = $blogsModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('excerpt', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
                ->orLike('category', $searchQuery)
                ->orLike('tags', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();

        $pages = $pagesModel
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

        // Transform and combine results
        $combinedResults = array_merge(
            array_map(function($item) {
                return [
                    'type' => 'blog',
                    'id' => $item['post_id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'excerpt' => $item['excerpt'] ?? substr(strip_tags($item['content'] ?? ''), 0, 200),
                    'slug' => $item['slug'] ?? null,
                    'created_at' => $item['created_at'] ?? null,
                    'category' => $item['category'] ?? null,
                    'tags' => $item['tags'] ?? null
                ];
            }, $blogs),
            array_map(function($item) {
                return [
                    'type' => 'page',
                    'id' => $item['page_id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'excerpt' => substr(strip_tags($item['content'] ?? ''), 0, 200),
                    'slug' => $item['slug'] ?? null,
                    'created_at' => $item['created_at'] ?? null
                ];
            }, $pages),
        );

        // Sort combined results by created_at in descending order
        usort($combinedResults, function($a, $b) {
            return strtotime($b['created_at'] ?? '0') - strtotime($a['created_at'] ?? '0');
        });

        // Limit total results to 20
        $combinedResults = array_slice($combinedResults, 0, 20);

        // Prepare response
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => [
                'total_results' => count($combinedResults),
                'results' => $combinedResults
            ]
        ]);
    }

    public function modelSearchResults($apiKey)
    {
        // Validate API key

        // Get the search query and type
        $searchQuery = trim($this->request->getGet('key'));
        $searchType = $this->request->getGet('type'); // e.g., blog, page, event, portfolio
        
        // Validate input
        if (empty($searchQuery)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Search query is required.'
            ]);
        }

        if (empty($searchType)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Search type is required. Valid types: blog, page, event, portfolio.'
            ]);
        }

        // Define the models and search fields for each type
        $modelMap = [
            'blog' => [
                'model' => new \App\Models\BlogsModel(),
                'fields' => ['title', 'excerpt', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'category', 'tags']
            ],
            'page' => [
                'model' => new \App\Models\PagesModel(),
                'fields' => ['title', 'content', 'meta_title', 'meta_keywords', 'meta_description']
            ],
        ];

        // Check if the type is valid
        if (!array_key_exists($searchType, $modelMap)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid search type. Valid types: blog, page, event, portfolio.'
            ]);
        }

        // Get the model and fields for the selected search type
        $model = $modelMap[$searchType]['model'];
        $searchFields = $modelMap[$searchType]['fields'];

        // Build the query
        $model->groupStart();
        foreach ($searchFields as $field) {
            $model->orLike($field, $searchQuery);
        }
        $model->groupEnd();

        // Apply general filters
        $results = $model
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();

        // Return the search results
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $results
        ]);
    }

    public function filterSearchResults($apiKey)
    {
        // Validate API key

        // Get search parameters
        $type = $this->request->getGet('type'); // e.g., category, tag, author
        $searchQuery = trim($this->request->getGet('key'));

        if (empty($type) || empty($searchQuery)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Both type and key parameters are required.'
            ]);
        }

        // Load models
        $blogsModel = new \App\Models\BlogsModel();
        $pagesModel = new \App\Models\PagesModel();

        $data = [];
        $data["searchQuery"] = $searchQuery;

        // Filter by type
        if (strcasecmp($type, 'category') === 0) {
            $whereClause = ['title' => $searchQuery];
            $categoryId = getTableData('categories', $whereClause, 'category_id');
            
            $data['blogsSearchResults'] = $blogsModel
                ->groupStart()
                    ->like('category', $categoryId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                ->findAll();
        } 
        elseif (strcasecmp($type, 'tag') === 0) {
            $data['blogsSearchResults'] = $blogsModel
                ->groupStart()
                    ->like('tags', $searchQuery)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                ->findAll();
        } 
        elseif (strcasecmp($type, 'author') === 0) {
            // Replace this with actual logic to get the user ID from the search query
            $userId = getUserIdFromName($searchQuery); // Create a helper function to retrieve userId from name
            
            if (!$userId) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'Author not found.'
                ]);
            }

            // Blogs search
            $data['blogsSearchResults'] = $blogsModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))
                ->findAll();

            // Pages search
            $data['pagesSearchResults'] = $pagesModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                ->findAll();
        } 
        else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid filter type. Valid types are category, tag, or author.'
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $data
        ]);
    } 
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BlogsModel; 
use App\Models\CodesModel;
use App\Models\ContactsModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContactMessagesModel;
use App\Models\ContentBlocksModel;
use App\Models\CountersModel;
use App\Models\PartnersModel;
use App\Models\ServicesModel;
use App\Models\EventsModel;
use App\Models\FrequentlyAskedQuestionsModel;
use App\Models\GalleryModel;
use App\Models\HomePageModel;
use App\Models\PagesModel;
use App\Models\PricingsModel;
use App\Models\PortfoliosModel;
use App\Models\SlidersModel;
use App\Models\SocialsModel;
use App\Models\TeamsModel;
use App\Models\TestimonialsModel;
use App\Models\TranslationsModel;
use App\Models\CountriesModel;
use App\Models\ThemesModel;
use App\Models\ProductsModel;
use App\Models\ProductCategoriesModel;
use App\Models\ResumesModel;
use App\Models\SubscribersModel;
use App\Models\AnnouncementPopupsModel;
use App\Models\DonationCausesModel;
use App\Services\EmailService;

class APIController extends BaseController
{
    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    //GENERIC GET METHODS
    public function getModelData($apiKey)
    {
        // Define the list of allowed models
        $allowedModels = [
            'announcementPopups' => 'App\Models\AnnouncementPopupsModel',
            'blogs' => 'App\Models\BlogsModel',
            'categories' => 'App\Models\CategoriesModel',
            'codes' => 'App\Models\CodesModel',
            'contentBlocks' => 'App\Models\ContentBlocksModel',
            'countries' => 'App\Models\CountriesModel',
            'counters' => 'App\Models\CountersModel',
            'donationCauses' => 'App\Models\DonationCausesModel',
            'events' => 'App\Models\EventsModel',
            'faqs' => 'App\Models\FrequentlyAskedQuestionsModel',
            'homePage' => 'App\Models\HomePageModel',
            'languages' => 'App\Models\LanguagesModel',
            'navigations' => 'App\Models\NavigationsModel',
            'pages' => 'App\Models\PagesModel',
            'partners' => 'App\Models\PartnersModel',
            'portfolios' => 'App\Models\PortfoliosModel',
            'pricings' => 'App\Models\PricingsModel',
            'products' => 'App\Models\ProductsModel',
            'productCategories' => 'App\Models\ProductCategoriesModel',
            'resumes' => 'App\Models\ResumesModel',
            'services' => 'App\Models\ServicesModel',
            'socials' => 'App\Models\SocialsModel',
            'teams' => 'App\Models\TeamsModel',
            'testimonials' => 'App\Models\TestimonialsModel',
            'themes' => 'App\Models\ThemesModel',
            'translations' => 'App\Models\TranslationsModel',
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
        $blogs = $blogsModel->limit(intval(getConfigData("queryLimitDefault")))->findAll();

        // Return the list of blogs
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $blogs
        ]);
    }

    //HOME PAGE API
    public function getHomePageData()
    {
        // Fetch all page data
        $homePageModel = new HomePageModel();
        $pages = $homePageModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitDefault")))->findAll();

        // Return the list of pages
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $pages
        ]);
    }

    //HOME PAGE API
    public function getHomePage($apiKey)
    {
        // Fetch all page data
        $homePageModel = new HomePageModel();
        $pages = $homePageModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(getConfigData("queryLimitDefault")))->findAll();

        // Return the list of pages
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'data' => $pages
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
        $pages = $pagesModel->where('status', '1')->limit(intval(getConfigData("queryLimitVeryHigh")))->findAll();

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

    // PORTFOLIOS API
    public function getPortfolio($apiKey, $portfolioId = null)
    {

        if (!$portfolioId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Portfolio ID parameter is required.'
            ]);
        }

        $portfoliosModel = new PortfoliosModel();
        $portfolio = $portfoliosModel->where('portfolio_id', $portfolioId)->first();
        if(isValidGUID($portfolioId) === false) {
            $portfolio = $portfoliosModel->where('slug', $portfolioId)->first();
        }

        if ($portfolio) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $portfolio
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Portfolio not found.'
            ]);
        }
    }

    public function getPortfolios($apiKey)
    {

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all portfolios
        $portfoliosModel = new PortfoliosModel();

        // Order by order in ascending order
        $portfoliosModel->where('status', '1')->orderBy('created_at', 'DESC');

        $portfolios = $portfoliosModel->findAll($take, $skip);

        // Get total count
        $totalPortfolios = $portfoliosModel->countAllResults();

        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPortfolios,
            'take' => $take,
            'skip' => $skip,
            'data' => $portfolios
        ]);
    }

    // SERVICES API
    public function getService($apiKey, $serviceId = null)
    {

        if (!$serviceId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Service ID parameter is required.'
            ]);
        }

        $servicesModel = new ServicesModel();
        $service = $servicesModel->where('service_id', $serviceId)->first();

        if ($service) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $service
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Service not found.'
            ]);
        }
    }

    public function getServices($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll($take, $skip);
    
        // Get total count
        $totalServices = $servicesModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalServices,
            'take' => $take,
            'skip' => $skip,
            'data' => $services
        ]);
    }    

    // PARTNERS API
    public function getPartner($apiKey, $partnerId = null)
    {

        if (!$partnerId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Partner ID parameter is required.'
            ]);
        }

        $partnersModel = new PartnersModel();
        $partner = $partnersModel->where('partner_id', $partnerId)->first();

        if ($partner) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $partner
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Partner not found.'
            ]);
        }
    }

    public function getPartners($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $partnersModel = new PartnersModel();
        $partners = $partnersModel->findAll($take, $skip);
    
        // Get total count
        $totalPartners = $partnersModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPartners,
            'take' => $take,
            'skip' => $skip,
            'data' => $partners
        ]);
    }

    // COUNTERS API
    public function getCounter($apiKey, $counterId = null)
    {

        if (!$counterId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Counter ID parameter is required.'
            ]);
        }

        $countersModel = new CountersModel();
        $counter = $countersModel->where('counter_id', $counterId)->first();

        if ($counter) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $counter
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Counter not found.'
            ]);
        }
    }

    public function getCounters($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $countersModel = new CountersModel();
        $counters = $countersModel->findAll($take, $skip);
    
        // Get total count
        $totalCounters = $countersModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalCounters,
            'take' => $take,
            'skip' => $skip,
            'data' => $counters
        ]);
    }

    // COUNTRIES API
    public function getCountry($apiKey, $countryId = null)
    {

        if (!$countryId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Country ID parameter is required.'
            ]);
        }

        $countriesModel = new CountriesModel();
        $country = $countriesModel->where('id', $countryId)->first();

        if ($country) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $country
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Country not found.'
            ]);
        }
    }

    public function getCountries($apiKey)
    {

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all countries
        $countriesModel = new CountriesModel();

        // Order by order in ascending order
        $countriesModel->orderBy('id', 'ASC');

        $countries = $countriesModel->findAll($take, $skip);

        // Get total count
        $totalCountries = $countriesModel->countAllResults();

        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalCountries,
            'take' => $take,
            'skip' => $skip,
            'data' => $countries
        ]);
    }

    // FREQUENTLY ASKED QUESTIONS API
    public function getFaq($apiKey, $faqId = null)
    {

        if (!$faqId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'FAQ ID parameter is required.'
            ]);
        }

        $faqModel = new FrequentlyAskedQuestionsModel();
        $faq = $faqModel->where('faq_id', $faqId)->first();

        if ($faq) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $faq
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'FAQ not found.'
            ]);
        }
    }

    public function getFaqs($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $faqModel = new FrequentlyAskedQuestionsModel();
        $faqs = $faqModel->orderBy('order', 'ASC')->findAll($take, $skip);
    
        // Get total count
        $totalFaqs = $faqModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalFaqs,
            'take' => $take,
            'skip' => $skip,
            'data' => $faqs
        ]);
    }    

    // LANGUAGES API
    public function getLanguage($apiKey, $languageId = null)
    {

        if (!$languageId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Language ID parameter is required.'
            ]);
        }

        $languagesModel = new LanguagesModel();
        $language = $languagesModel->where('language_id', $languageId)->first();

        if ($language) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $language
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Language not found.'
            ]);
        }
    }

    public function getLanguages($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $languagesModel = new LanguagesModel();
        $languages = $languagesModel->findAll($take, $skip);
    
        // Get total count
        $totalLanguages = $languagesModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalLanguages,
            'take' => $take,
            'skip' => $skip,
            'data' => $languages
        ]);
    }

    // PRICINGS API
    public function getPricing($apiKey, $pricingId = null)
    {

        if (!$pricingId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Pricing ID parameter is required.'
            ]);
        }

        $pricingsModel = new PricingsModel();
        $pricing = $pricingsModel->where('pricing_id', $pricingId)->first();

        if ($pricing) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $pricing
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Pricing not found.'
            ]);
        }
    }

    public function getPricings($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $pricingsModel = new PricingsModel();
        $pricings = $pricingsModel->orderBy('order', 'ASC')->findAll($take, $skip);
    
        // Get total count
        $totalPricings = $pricingsModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPricings,
            'take' => $take,
            'skip' => $skip,
            'data' => $pricings
        ]);
    }

    // SOCIALS API
    public function getSocial($apiKey, $socialId = null)
    {

        if (!$socialId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Social ID parameter is required.'
            ]);
        }

        $socialsModel = new SocialsModel();
        $social = $socialsModel->where('social_id', $socialId)->first();

        if ($social) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $social
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Social not found.'
            ]);
        }
    }

    public function getSocials($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $socialsModel = new SocialsModel();
        $socials = $socialsModel->findAll($take, $skip);
    
        // Get total count
        $totalSocials = $socialsModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalSocials,
            'take' => $take,
            'skip' => $skip,
            'data' => $socials
        ]);
    }

    // TEAMS API
    public function getTeam($apiKey, $teamId = null)
    {

        if (!$teamId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Team ID parameter is required.'
            ]);
        }

        $teamsModel = new TeamsModel();
        $team = $teamsModel->where('team_id', $teamId)->first();

        if ($team) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $team
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Team member not found.'
            ]);
        }
    }

    public function getTeams($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $teamsModel = new TeamsModel();
        $teams = $teamsModel->findAll($take, $skip);
    
        // Get total count
        $totalTeams = $teamsModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalTeams,
            'take' => $take,
            'skip' => $skip,
            'data' => $teams
        ]);
    }

    // TESTIMONIALS API
    public function getTestimonial($apiKey, $testimonialId = null)
    {
        // Check if id is provided
        if (!$testimonialId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Testimonial ID parameter is required.'
            ]);
        }

        // Fetch the testimonial by id
        $testimonialsModel = new TestimonialsModel();
        $testimonial = $testimonialsModel->where('testimonial_id', $testimonialId)->first();

        // Return testimonial or not found error
        if ($testimonial) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $testimonial
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Testimonial not found.'
            ]);
        }
    }

    public function getTestimonials($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $testimonialsModel = new TestimonialsModel();
        $testimonials = $testimonialsModel->findAll($take, $skip);
    
        // Get total count
        $totalTestimonials = $testimonialsModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalTestimonials,
            'take' => $take,
            'skip' => $skip,
            'data' => $testimonials
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

    // TRANSLATIONS API
    public function getTranslation($apiKey, $translationId = null)
    {
        // Check if id is provided
        if (!$translationId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Translation ID parameter is required.'
            ]);
        }

        // Fetch the translation by id
        $translationsModel = new TranslationsModel();
        $translation = $translationsModel->where('translation_id', $translationId)->first();

        // Return translation or not found error
        if ($translation) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $translation
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Translation not found.'
            ]);
        }
    }

    public function getTranslations($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        $translationsModel = new TranslationsModel();
        $translations = $translationsModel->findAll($take, $skip);
    
        // Get total count
        $totalTranslations = $translationsModel->countAllResults();
    
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalTranslations,
            'take' => $take,
            'skip' => $skip,
            'data' => $translations
        ]);
    }

    // EVENTS API (with status check)
    public function getEvent($apiKey, $eventId = null)
    {

        if (!$eventId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Event ID parameter is required.'
            ]);
        }

        $eventsModel = new EventsModel();
        $event = $eventsModel->where('event_id', $eventId)->first();

        if ($event) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $event
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Event not found.'
            ]);
        }
    }

    public function getEvents($apiKey)
    {

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all events
        $eventsModel = new EventsModel();

        // Order by order in ascending order
        $eventsModel->where('status', '1')->orderBy('created_at', 'DESC');

        $events = $eventsModel->findAll($take, $skip);

        // Get total count
        $totalEvents = $eventsModel->countAllResults();

        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalEvents,
            'take' => $take,
            'skip' => $skip,
            'data' => $events
        ]);
    }

    //ECOMMERCE API
    public function getProduct($apiKey, $productId = null)
    {
        // Check if productId is provided
        if (!$productId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Product Id parameter is required.'
            ]);
        }

        // Fetch the product by id
        $productsModel = new ProductsModel();
        $product = $productsModel->where('product_id', $productId)->first();

        // Return product or not found error
        if ($product) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $product
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Product not found.'
            ]);
        }
    }

    public function getProducts($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        // Fetch all products
        $productsModel = new ProductsModel();
        // Order by title in ascending order
        $productsModel->orderBy('title', 'ASC');
        $products = $productsModel->where('status', '1')->findAll($take, $skip);
    
        // Get total count
        $totalProducts = $productsModel->countAllResults();
    
        // Return the list of products
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalProducts,
            'take' => $take,
            'skip' => $skip,
            'data' => $products
        ]);
    }

    public function getProductCategory($apiKey, $productCategoryId = null)
    {
        // Check if productId is provided
        if (!$productCategoryId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Category Id parameter is required.'
            ]);
        }

        // Fetch the product by id
        $productCategoriesModel = new ProductCategoriesModel();
        $productCategory = $productCategoriesModel->where('category_id', $productCategoryId)->first();

        // Return product or not found error
        if ($productCategory) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $productCategory
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Category not found.'
            ]);
        }
    }

    public function getProductCategories($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        // Fetch all product categories
        $productCategoriesModel = new ProductCategoriesModel();
        // Order by title in ascending order
        $productCategoriesModel->orderBy('title', 'ASC');
        $productCategories = $productCategoriesModel->where('status', '1')->findAll($take, $skip);
    
        // Get total count
        $totalProductCategories = $productCategoriesModel->countAllResults();
    
        // Return the list of product categories
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalProductCategories,
            'take' => $take,
            'skip' => $skip,
            'data' => $productCategories
        ]);
    }

    //RESUME API
    public function getResume($apiKey, $resumeId = null)
    {
        // Check if resumeId is provided
        if (!$resumeId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Resume Id parameter is required.'
            ]);
        }

        // Fetch the resume by id
        $resumesModel = new ResumesModel();
        $resume = $resumesModel->where('resume_id', $resumeId)->first();

        // Return resume or not found error
        if ($resume) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $resume
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Resume not found.'
            ]);
        }
    }

    public function getResumes($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        // Fetch all resumes
        $resumesModel = new ResumesModel();
        // Order by title in ascending order
        $resumesModel->orderBy('title', 'ASC');
        $resumes = $resumesModel->where('status', '1')->findAll($take, $skip);
    
        // Get total count
        $totalResumes = $resumesModel->countAllResults();
    
        // Return the list of resumes
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalResumes,
            'take' => $take,
            'skip' => $skip,
            'data' => $resumes
        ]);
    }

    //POPUPS API
    public function getPopupAnnouncement($apiKey, $popupId = null)
    {
        // Check if popupId is provided
        if (!$popupId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Popup Id parameter is required.'
            ]);
        }

        // Fetch the popup by id
        $popupsModel = new AnnouncementPopupsModel();
        $popup = $popupsModel->where('popup_id', $popupId)->first();

        // Return popup or not found error
        if ($popup) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $popup
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Popup not found.'
            ]);
        }
    }

    public function getPopupAnnouncements($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        // Fetch all popups
        $popupsModel = new AnnouncementPopupsModel();
        // Order by title in ascending order
        $popupsModel->orderBy('title', 'ASC');
        $popups = $popupsModel->where('status', '1')->findAll($take, $skip);
    
        // Get total count
        $totalPopups = $popupsModel->countAllResults();
    
        // Return the list of popups
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPopups,
            'take' => $take,
            'skip' => $skip,
            'data' => $popups
        ]);
    }

    //DONATION CAUSES API
    public function getDonationCause($apiKey, $donationCauseId = null)
    {
        // Check if donationCauseId is provided
        if (!$donationCauseId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Donation cause Id parameter is required.'
            ]);
        }

        // Fetch the donationCause by id
        $donationCausesModel = new DonationCausesModel();
        $donationCause = $donationCausesModel->where('donation_cause_id', $donationCauseId)->first();

        // Return donationCause or not found error
        if ($donationCause) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $donationCause
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Donation cause not found.'
            ]);
        }
    }

    public function getDonationCauses($apiKey)
    {
    
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;
    
        // Fetch all donation causes
        $donationCausesModel = new DonationCausesModel();
        // Order by title in ascending order
        $donationCausesModel->orderBy('title', 'ASC');
        $donationCauses = $donationCausesModel->where('status', '1')->findAll($take, $skip);
    
        // Get total count
        $totalDonationCauses = $donationCausesModel->countAllResults();
    
        // Return the list of donation causes
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalDonationCauses,
            'take' => $take,
            'skip' => $skip,
            'data' => $donationCauses
        ]);
    }

    //CONTACT MESSAGES
    public function sendContactMessage()
    {
        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        $returnUrl = $this->request->getPost('return_url');
        $toEmail = getConfigData("CompanyEmail");
        $name = $this->request->getPost('name');
        $fromEmail = $this->request->getPost('email');
        $subject = $this->request->getPost('subject') ?? "Contact Message";
        $message = $this->request->getPost('message');
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            // CAPTCHA validation failed
            $errorMessage = $captchaValidation; // Error message returned by the helper function
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        $templateData = [
            'preheader' => $subject,
            'greeting' => 'New Contact Message',
            'main_content' => '<p>'.$message.'</p>',
            'cta_text' => '',
            'cta_url' => '',
            'footer_text' => 'Sent from <a href="'.base_url().'">'.$companyName.'</a>',
            'company_address' => $companyAddress,
            'unsubscribe_url' => base_url('/unsubscribe/'.$toEmail)
        ];

        $result = $this->emailService->sendHtmlEmail($toEmail, $name, $subject, $templateData, $fromEmail);

        if ($result) {
            //add client feedback data
            $contactMessagesModel = new ContactMessagesModel();
            $data = [
                'name' => $name,
                'email' => $this->request->getPost('email'),
                'subject' => $subject,
                'message' => $message,
                'ip_address' => getIPAddress(),
                'country' => getCountry(),
                'device' => getUserDevice(),
            ];
            $contactMessagesModel->createContactMessage($data);

            // Record created successfully.
            $contactMessageSuccessful = config('CustomConfig')->contactMessageSuccessful;
            session()->setFlashdata('successAlert', $contactMessageSuccessful);

            //log activity
            logActivity($fromEmail, ActivityTypes::CONTACT_MESSAGE_CREATION, 'Contact message sent from user with email: ' . $fromEmail);

            if(!empty($returnUrl)){
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Email sent successfully']);
        } else {

            // Failed to create record.
            $contactMessageFailed = config('CustomConfig')->contactMessageFailed;
            session()->setFlashdata('errorAlert', $contactMessageFailed);

            //log activity
            logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_MESSAGE_CREATION, 'Failed to send contact message from user with email: ' . $fromEmail);

            if(!empty($returnUrl)){
                return redirect()->to($returnUrl);      
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to send email']);
        }
    }

    //ADD SUBSCRIPTION
    public function addSubscription()
    {
        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);
        
        // Get POST data - using input stream since it might be coming from fetch/ajax
        $json = $this->request->getBody();
        $postData = json_decode($json, true);
        
        // If json decode failed, try getting regular POST data
        if (json_last_error() !== JSON_ERROR_NONE) {
            $email = $this->request->getPost('email');
            $returnUrl = $this->request->getPost('return_url');
        } else {
            $email = $postData['email'] ?? '';
            $returnUrl = $postData['return_url'] ?? '';
        }

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            // CAPTCHA validation failed
            $errorMessage = $captchaValidation; // Error message returned by the helper function
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        // Validate email
        if (empty($email)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Email is required'
            ]);
        }

        $subscribersModel = new SubscribersModel();
        $data = [
            'name' => ucfirst(strtok($email, '@')), // Get name from email
            'email' => $email,
            'status' => 1,
            'ip_address' => getIPAddress(),
            'country' => getCountry(),
        ];

        $tableName = 'subscribers';
        //Check if record exists
        if (recordExists($tableName, "email", $email)) {
            //update status as well
            $updateColumn = "'status' = '1'";
            $updateWhereClause = "email = '$email'";
            updateRecordColumn("subscribers", $updateColumn, $updateWhereClause);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => 'Subscribed successfully'
            ]);
        }

        // Attempt to create the subscriber
        if ($subscribersModel->createSubscriber($data)) {
            // Record created successfully.
            $subscriptionSuccessful = config('CustomConfig')->subscriptionSuccessful;
            session()->setFlashdata('successAlert', $subscriptionSuccessful);

            //log activity
            logActivity($email, ActivityTypes::SUBSCRIPTION_CREATION, 'User subscribed with email: ' . $email);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => $subscriptionSuccessful
            ]);
        } else {
            // Failed to create record.
            $subscriptionFailed = config('CustomConfig')->subscriptionFailed;
            session()->setFlashdata('errorAlert', $subscriptionFailed);

            //log activity
            logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_CREATION, 'Failed to create subscription with email: ' . $email);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => $subscriptionFailed
            ]);
        }
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
        $portfoliosModel = new PortfoliosModel();
        $eventsModel = new EventsModel();

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
            ->limit(intval(getConfigData("queryLimitDefault")))
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
            ->limit(intval(getConfigData("queryLimitDefault")))
            ->findAll();

        $portfolios = $portfoliosModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('category', $searchQuery)
                ->orLike('client', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(getConfigData("queryLimitDefault")))
            ->findAll();

        $events = $eventsModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('location', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(getConfigData("queryLimitDefault")))
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
            array_map(function($item) {
                return [
                    'type' => 'portfolio',
                    'id' => $item['portfolio_id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'excerpt' => $item['description'] ?? substr(strip_tags($item['content'] ?? ''), 0, 200),
                    'slug' => $item['slug'] ?? null,
                    'created_at' => $item['created_at'] ?? null,
                    'category' => $item['category'] ?? null,
                    'client' => $item['client'] ?? null
                ];
            }, $portfolios),
            array_map(function($item) {
                return [
                    'type' => 'event',
                    'id' => $item['event_id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'excerpt' => $item['description'] ?? substr(strip_tags($item['content'] ?? ''), 0, 200),
                    'slug' => $item['slug'] ?? null,
                    'created_at' => $item['created_at'] ?? null,
                    'location' => $item['location'] ?? null
                ];
            }, $events)
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
            'event' => [
                'model' => new \App\Models\EventsModel(),
                'fields' => ['title', 'description', 'content', 'location', 'meta_title', 'meta_description', 'meta_keywords']
            ],
            'portfolio' => [
                'model' => new \App\Models\PortfoliosModel(),
                'fields' => ['title', 'description', 'content', 'category', 'client', 'meta_title', 'meta_description', 'meta_keywords']
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
            ->limit(intval(getConfigData("queryLimitDefault")))
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
        $eventsModel = new \App\Models\EventsModel();
        $portfoliosModel = new \App\Models\PortfoliosModel();
        $shopModel = new \App\Models\ProductsModel();

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
                ->limit(intval(getConfigData("queryLimitVeryHigh")))
                ->findAll();
        } 
        elseif (strcasecmp($type, 'tag') === 0) {
            $data['blogsSearchResults'] = $blogsModel
                ->groupStart()
                    ->like('tags', $searchQuery)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(getConfigData("queryLimitVeryHigh")))
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
                ->limit(intval(getConfigData("queryLimitVeryHigh")))
                ->findAll();

            // Pages search
            $data['pagesSearchResults'] = $pagesModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(getConfigData("queryLimitDefault")))
                ->findAll();
    
            // Events search
            $data['eventsSearchResults'] = $eventsModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(getConfigData("queryLimitDefault")))
                ->findAll();
            
            // Portfolios search
            $data['portfoliosSearchResults'] = $portfoliosModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(getConfigData("queryLimitDefault")))
                ->findAll();
            
            // Shop search
            $data['shopSearchResults'] = $shopModel
                ->groupStart()
                    ->like('created_by', $userId)
                ->groupEnd()
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->limit(intval(getConfigData("queryLimitDefault")))
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

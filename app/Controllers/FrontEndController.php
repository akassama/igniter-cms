<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ContactsModel;
use App\Models\BlogsModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContactMessagesModel;
use App\Models\ContentBlocksModel;
use App\Models\CountersModel;
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
use App\Models\PartnersModel;
use App\Models\ServicesModel;
use App\Models\ProductsModel;
use App\Models\ProductCategoriesModel;
use App\Models\ResumesModel;
use App\Models\SkillsModel;
use App\Models\EducationsModel;
use App\Models\ExperiencesModel;
use App\Models\AnnouncementPopupsModel;
use App\Models\DonationCausesModel;
use App\Models\AppointmentsModel;
use App\Models\BookingsModel;
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
        //set default array data
        $data = [
            'home_pages'   => [],
            'blogs'        => [],
            'categories'   => [],
            'navigations'  => [],
            'events'       => [],
            'portfolios'   => [],
            'socials'      => [],
            'counters'     => [],
            'partners'     => [],
            'services'     => [],
            'pricings'     => [],
            'teams'        => [],
            'faqs'         => [],
            'testimonials' => [],
            'donations'    => [],
            'appointments'    => [],
            'bookings'    => [],
        ];

        $homePageModel = new HomePageModel();
        $blogsModel = new BlogsModel();
        $categoriesModel = new CategoriesModel();
        $navigationsModel = new NavigationsModel();
        $eventsModel = new EventsModel();
        $portfoliosModel = new PortfoliosModel();
        $galleriesModel = new GalleryModel();
        $socialsModel = new SocialsModel();
        $countersModel = new CountersModel();
        $partnersModel = new PartnersModel();
        $servicesModel = new ServicesModel();
        $pricingsModel = new PricingsModel();
        $teamsModel = new TeamsModel();
        $faqsModel = new FrequentlyAskedQuestionsModel();
        $testimonialsModel = new TestimonialsModel();
        $donationsModel = new DonationCausesModel();
        $productsModel = new ProductsModel();
        $productCategoriesModel = new ProductCategoriesModel();
        $resumesModel = new ResumesModel();
        $skillsModel = new SkillsModel();
        $educationsModel = new EducationsModel();
        $experiencesModel = new ExperiencesModel();
        $appointmentsModel = new AppointmentsModel();
        $bookingsModel = new BookingsModel();

        $homePageFormat = getConfigData("HomePageFormat");

        // Set data to pass in view
        $data = [
            'home_pages'    => $homePageModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'blogs'         => $blogsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll(),
            'categories'    => $categoriesModel->where('status', '1')->orderBy('title', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'navigations'   => $navigationsModel->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'events'        => $eventsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'portfolios'    => $portfoliosModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'galleries'    => $galleriesModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'socials'       => $socialsModel->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'counters'      => $countersModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'partners'      => $partnersModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'services'      => $servicesModel->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'pricings'      => $pricingsModel->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'teams'         => $teamsModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'faqs'          => $faqsModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'testimonials'  => $testimonialsModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'donations'     => $donationsModel->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_MEDIUM', 12)))->findAll(),
            'appointments'    => $appointmentsModel->where('status', '1')->orderBy('title', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'bookings'    => $bookingsModel->where('booking_date <', date('Y-m-d'))->orderBy('name', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'resume' => $resumesModel->where('status', 1)->first(),
            'resume_skills'    => $skillsModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'resume_educations'    => $educationsModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'resume_experiences'    => $experiencesModel->where('status', '1')->orderBy('order', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'products' => $productsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            'product_categories'    => $productCategoriesModel->where('status', '1')->orderBy('title', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
        ];  

        if(strtolower($homePageFormat) === "blog"){
            $data = [
                'blogs' => $blogsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))->findAll(),
                'categories'    => $categoriesModel->where('status', '1')->orderBy('title', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            ];
        }
        
        if(strtolower($homePageFormat) === "shop"){
            $data = [
                'products' => $productsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_VERY_HIGH', 100)))->findAll(),
                'product_categories'    => $productCategoriesModel->where('status', '1')->orderBy('title', 'ASC')->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))->findAll(),
            ];
        }

        //load home view
        return view('front-end/themes/'.getCurrentTheme().'/home/index', $data);
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
            $errorMsg = config('CustomConfig')->notFoundMsg;
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
            $errorMsg = config('CustomConfig')->notFoundMsg;
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
    //           Events           //
    //############################//
    public function getEvents()
    {
        //get enable events page
        $enableEventsPage = getConfigData("EnableEventsPage");
        if(strtolower($enableEventsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'events';
        $eventsModel = new EventsModel();

        // Set data to pass in view
        $data = [
            'events' => $eventsModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $eventsModel->pager,
            'total_events' => $eventsModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/events/index', $data);
    }

    public function getEventDetails($slug)
    {
        //get enable events page
        $enableEventsPage = getConfigData("EnableEventsPage");
        if(strtolower($enableEventsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'events';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $eventId = getTableData($tableName, $whereClause, 'event_id');
        $eventsModel = new EventsModel();
        $data = [
            'event_data' => $eventsModel->find($eventId),
            'events' => $eventsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll()
        ];
        return view('front-end/themes/'.getCurrentTheme().'/events/view-event', $data);
    }

    //############################//
    //        Portfolios          //
    //############################//
    public function getPortfolios()
    {
        //get enable portfolios page
        $enablePortfoliosPage = getConfigData("EnablePortfoliosPage");
        if(strtolower($enablePortfoliosPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'portfolios';
        $portfoliosModel = new PortfoliosModel();

        // Set data to pass in view
        $data = [
            'portfolios' => $portfoliosModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $portfoliosModel->pager,
            'total_portfolios' => $portfoliosModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/portfolios/index', $data);
    }
    
    public function getPortfolioDetails($slug)
    {
        
        $tableName = 'portfolios';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $portfolioId = getTableData($tableName, $whereClause, 'portfolio_id');
        $portfoliosModel = new PortfoliosModel();
		$categoriesModel = new CategoriesModel();
        $data = [
            'portfolio_data' => $portfoliosModel->find($portfolioId)
        ];
        return view('front-end/themes/'.getCurrentTheme().'/portfolios/view-portfolio', $data);
    }

    //############################//
    //       Donation Causes      //
    //############################//
    public function getDonationCampaings()
    {
        //get enable donations page
        $enableDonationsPage = getConfigData("EnableDonationsPage");
        if(strtolower($enableDonationsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'donation_causes';
        $donationCausesModel = new DonationCausesModel();

        // Set data to pass in view
        $data = [
            'donation_causes' => $donationCausesModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $donationCausesModel->pager,
            'total_donation_causes' => $donationCausesModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/donate/index', $data);
    }

    public function getDonationCampaingDetails($slug)
    {
        //get enable donations page
        $enableDonationsPage = getConfigData("EnableDonationsPage");
        if(strtolower($enableDonationsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }
        
        $tableName = 'donation_causes';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $donationCauseId = getTableData($tableName, $whereClause, 'donation_cause_id');
        $donationCausesModel = new DonationCausesModel();
        $data = [
            'donation_cause_data' => $donationCausesModel->find($donationCauseId),
            'donation_causes' => $donationCausesModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll(),
        ];
        return view('front-end/themes/'.getCurrentTheme().'/donate/view-donation-campaign', $data);
    }

    //############################//
    //           Products            //
    //############################//
    public function getProducts()
    {
        //get enable shop
        $enableShopFront = getConfigData("EnableShopFront");
        if(strtolower($enableShopFront) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'products';
        $productsModel = new ProductsModel();

        // Set data to pass in view
        $data = [
            'products' => $productsModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $productsModel->pager,
            'total_products' => $productsModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/shop/index', $data);
    }

    public function getProductDetails($slug)
    {
        //get enable shop
        $enableShopFront = getConfigData("EnableShopFront");
        if(strtolower($enableShopFront) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }
        
        $tableName = 'products';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $productId = getTableData($tableName, $whereClause, 'product_id');
        $productsModel = new ProductsModel();
		$categoriesModel = new ProductCategoriesModel();
        $data = [
            'product_data' => $productsModel->find($productId),
            'products' => $productsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll(),
            'categories' => $categoriesModel->orderBy('title', 'ASC')->findAll(),
        ];
        return view('front-end/themes/'.getCurrentTheme().'/shop/view-product', $data);
    }

    //############################//
    //        Appointments        //
    //############################//
    public function getAppointments()
    {
        //get enable appointments page
        $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");
        if(strtolower($enableAppointmentsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'appointments';
        $appointmentsModel = new AppointmentsModel();

        // Set data to pass in view
        $data = [
            'appointments' => $appointmentsModel->orderBy('created_at', 'DESC')->paginate(intval(env('PAGINATE_LOW', 20))),
            'pager' => $appointmentsModel->pager,
            'total_appointments' => $appointmentsModel->pager->getTotal()
        ];

        return view('front-end/themes/'.getCurrentTheme().'/appointments/index', $data);
    }

    public function getAppointmentDetails($slug)
    {
        //get enable appointments page
        $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");
        if(strtolower($enableAppointmentsPage) === "no"){
            // Not allowed to access page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        $tableName = 'appointments';
        //Check if record exists
        if (!recordExists($tableName, "slug", $slug)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/');
        }

        $whereClause = ['slug' => $slug];
        $appointmentId = getTableData($tableName, $whereClause, 'appointment_id');
        $appointmentsModel = new AppointmentsModel();
        $data = [
            'appointment_data' => $appointmentsModel->find($appointmentId),
            'appointments' => $appointmentsModel->where('status', '1')->orderBy('created_at', 'DESC')->limit(intval(env('QUERY_LIMIT_LOW', 6)))->findAll()
        ];
        return view('front-end/themes/'.getCurrentTheme().'/appointments/view-appointment', $data);
    }

    //############################//
    //        Contact Form        //
    //############################//
    public function getContactForm()
    {
        return view('front-end/themes/'.getCurrentTheme().'/contact/index');
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
        $eventsModel = new EventsModel();
        $portfoliosModel = new PortfoliosModel();
        $donationCausesModel = new DonationCausesModel();
        $shopModel = new ProductsModel();
        $appointmentsModel = new AppointmentsModel();
        
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

        // Events search
        $enableEventsPage = getConfigData("EnableEventsPage");

        if (strtolower($enableEventsPage) === "no") {
            $data['eventsSearchResults'] = []; // Make the array empty
        } else {
            $data['eventsSearchResults'] = $eventsModel
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
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        }
        
        // Portfolios search
        $enablePortfoliosPage = getConfigData("EnablePortfoliosPage");

        if (strtolower($enablePortfoliosPage) === "no") {
            $data['portfoliosSearchResults'] = []; 
        } else {
            $data['portfoliosSearchResults'] = $portfoliosModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('client', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        }
           
        // Donations search
        $enableDonationsPage = getConfigData("EnableDonationsPage");

        if (strtolower($enableDonationsPage) === "no") {
            $data['donationsSearchResults'] = []; 
        } else {
            $data['donationsSearchResults'] = $donationCausesModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('content', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        }  
        
        // Shop search
        $enableShopFront = getConfigData("EnableShopFront");

        if (strtolower($enableShopFront) === "no") {
            $data['shopSearchResults'] = []; 
        } else {
            $data['shopSearchResults'] = $shopModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('short_description', $searchQuery)
                ->orLike('brand', $searchQuery)
                ->orLike('model', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        }

        // Appointments search
        $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");

        if (strtolower($enableAppointmentsPage) === "no") {
            $data['appointmentsSearchResults'] = []; // Make the array empty
        } else {
            $data['appointmentsSearchResults'] = $appointmentsModel
            ->groupStart()
                ->like('title', $searchQuery)
                ->orLike('description', $searchQuery)
                ->orLike('meta_title', $searchQuery)
                ->orLike('meta_description', $searchQuery)
                ->orLike('meta_keywords', $searchQuery)
            ->groupEnd()
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
            ->findAll();
        }
        
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
                'pagesSearchResults' => null,
                'eventsSearchResults' => null,
                'portfoliosSearchResults' => null,
                'donationsSearchResults' => null,
                'shopSearchResults' => null,
                'appointmentsSearchResults' => null
            ];
    
            try {
                // Load the models
                $blogsModel = new BlogsModel();
                $pagesModel = new PagesModel();
                $eventsModel = new EventsModel();
                $portfoliosModel = new PortfoliosModel();
                $donationCausesModel = new DonationCausesModel();
                $shopModel = new ProductsModel();
                $appointmentsModel = new AppointmentsModel();
    
                if (strcasecmp($type, 'category') === 0) {
                    try {
                        // Blogs search
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
                        $userId = getUserIdFromName($searchQuery);
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
        
                    // Events search
                    $enableEventsPage = getConfigData("EnableEventsPage");
                    if (strtolower($enableEventsPage) === "no") {
                        $data['eventsSearchResults'] = [];
                    } else {
                        try {
                            $data['eventsSearchResults'] = $eventsModel
                                ->groupStart()
                                    ->like('created_by', $userId)
                                ->groupEnd()
                                ->where('status', '1')
                                ->orderBy('created_at', 'DESC')
                                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                ->findAll();
                        } catch (\Exception $e) {
                            $data['eventsSearchResults'] = null;
                            log_message('error', 'Author events search error: ' . $e->getMessage());
                        }
                    }
                    
                    // Portfolios search
                    $enablePortfoliosPage = getConfigData("EnablePortfoliosPage");
                    if (strtolower($enablePortfoliosPage) === "no") {
                        $data['portfoliosSearchResults'] = []; 
                    } else {
                        try {
                            $data['portfoliosSearchResults'] = $portfoliosModel
                                ->groupStart()
                                    ->like('created_by', $userId)
                                ->groupEnd()
                                ->where('status', '1')
                                ->orderBy('created_at', 'DESC')
                                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                ->findAll();
                        } catch (\Exception $e) {
                            $data['portfoliosSearchResults'] = null;
                            log_message('error', 'Author portfolios search error: ' . $e->getMessage());
                        }
                    }
                    
                    // Donations search
                    $enableDonationsPage = getConfigData("EnableDonationsPage");
                    if (strtolower($enableDonationsPage) === "no") {
                        $data['donationsSearchResults'] = []; 
                    } else {
                        try {
                            $data['donationsSearchResults'] = $donationCausesModel
                                ->groupStart()
                                    ->like('created_by', $userId)
                                ->groupEnd()
                                ->where('status', '1')
                                ->orderBy('created_at', 'DESC')
                                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                ->findAll();
                        } catch (\Exception $e) {
                            $data['donationsSearchResults'] = null;
                            log_message('error', 'Author donations search error: ' . $e->getMessage());
                        }
                    }
        
                    // Appointments search
                    $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");
                    if (strtolower($enableAppointmentsPage) === "no") {
                        $data['appointmentsSearchResults'] = [];
                    } else {
                        try {
                            $data['appointmentsSearchResults'] = $appointmentsModel
                                ->groupStart()
                                    ->like('created_by', $userId)
                                ->groupEnd()
                                ->where('status', '1')
                                ->orderBy('created_at', 'DESC')
                                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                ->findAll();
                        } catch (\Exception $e) {
                            $data['appointmentsSearchResults'] = null;
                            log_message('error', 'Author appointments search error: ' . $e->getMessage());
                        }
                    }
    
                    // Shop search
                    $enableShopFront = getConfigData("EnableShopFront");
                    if (strtolower($enableShopFront) === "no") {
                        $data['shopSearchResults'] = []; 
                    } else {
                        try {
                            $data['shopSearchResults'] = $shopModel
                                ->groupStart()
                                    ->like('created_by', $userId)
                                ->groupEnd()
                                ->where('status', '1')
                                ->orderBy('created_at', 'DESC')
                                ->limit(intval(env('QUERY_LIMIT_DEFAULT', 25)))
                                ->findAll();
                        } catch (\Exception $e) {
                            $data['shopSearchResults'] = null;
                            log_message('error', 'Author shop search error: ' . $e->getMessage());
                        }
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
                'pagesSearchResults' => null,
                'eventsSearchResults' => null,
                'portfoliosSearchResults' => null,
                'donationsSearchResults' => null,
                'shopSearchResults' => null,
                'appointmentsSearchResults' => null
            ]);
        }
    }

    //############################//
    //         Sitemaps           //
    //############################//
    public function getSitemaps()
    {
        // Check enabled pages
        $enableEventsPage = getConfigData("EnableEventsPage");
        $enablePortfoliosPage = getConfigData("EnablePortfoliosPage");
        $enableDonationsPage = getConfigData("EnableDonationsPage");
        $enableShopFront = getConfigData("EnableShopFront");
        $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");

        // Models to query
        $models = [
            'blog' => new BlogsModel(),
            'page' => new PagesModel()
        ];

        // Conditionally add models based on config
        if (strtolower($enableEventsPage) !== "no") {
            $models['event'] = new EventsModel();
        }
        if (strtolower($enablePortfoliosPage) !== "no") {
            $models['portfolio'] = new PortfoliosModel();
        }
        if (strtolower($enableDonationsPage) !== "no") {
            $models['donate'] = new DonationCausesModel();
        }
        if (strtolower($enableShopFront) !== "no") {
            $models['shop'] = new ProductsModel();
        }
        if (strtolower($enableAppointmentsPage) !== "no") {
            $models['appointment'] = new AppointmentsModel();
        }

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
            case 'portfolio':
                return '0.70';
            case 'event':
                return '0.60';
            case 'appointment':
                return '0.60';
            case 'donate':
                return '0.50';
            case 'shop':
                return '0.50';
            default:
                return '0.50';
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
        // Check enabled pages
        $enableEventsPage = getConfigData("EnableEventsPage");
        $enablePortfoliosPage = getConfigData("EnablePortfoliosPage");
        $enableDonationsPage = getConfigData("EnableDonationsPage");
        $enableShopFront = getConfigData("EnableShopFront");
        $enableAppointmentsPage = getConfigData("EnableAppointmentsPage");

        // Models to query (same as sitemap)
        $models = [
            'blog' => new BlogsModel(),
            'page' => new PagesModel()
        ];

        // Conditionally add models based on config
        if (strtolower($enableEventsPage) !== "no") {
            $models['event'] = new EventsModel();
        }
        if (strtolower($enablePortfoliosPage) !== "no") {
            $models['portfolio'] = new PortfoliosModel();
        }
        if (strtolower($enableDonationsPage) !== "no") {
            $models['donate'] = new DonationCausesModel();
        }
        if (strtolower($enableShopFront) !== "no") {
            $models['shop'] = new ProductsModel();
        }
        if (strtolower($enableAppointmentsPage) !== "no") {
            $models['appointment'] = new AppointmentsModel();
        }
    
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
            case 'event':
            case 'donate':
            case 'portfolio':
            case 'shop':
            case 'appointment':
                return 'description'; // Events, donations, portfolios, appointments, and products use "description"
            case 'page':
            default:
                return null; // Pages do not have a summary/description field
        }
    }
}
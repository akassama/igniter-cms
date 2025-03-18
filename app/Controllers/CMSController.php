<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
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
use App\Models\HomePageModel;
use App\Models\PagesModel;
use App\Models\PricingsModel;
use App\Models\PortfoliosModel;
use App\Models\SlidersModel;
use App\Models\SocialsModel;
use App\Models\TeamsModel;
use App\Models\TestimonialsModel;
use App\Models\AnnouncementPopupsModel;
use App\Models\TranslationsModel;
use App\Models\PartnersModel;
use App\Models\ServicesModel;
use App\Models\DonationCausesModel;
use App\Models\ResumesModel;

class CMSController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        return view('back-end/cms/index');
    }

    //############################//
    //           Blogs            //
    //############################//
    public function blogs()
    {
        $tableName = 'blogs';
        $blogsModel = new BlogsModel();

        // Set data to pass in view
        $data = [
            'blogs' => $blogsModel->orderBy('created_at', 'DESC')->paginate(100),
            'pager' => $blogsModel->pager,
            'total_blogs' => $blogsModel->pager->getTotal()
        ];

        return view('back-end/cms/blogs/index', $data);
    }
    
    public function newBlog()
    {
        return view('back-end/cms/blogs/new-blog');
    }

    public function addBlog()
    {
        $loggedInUserId = $this->session->get('user_id');

        $blogsModel = new BlogsModel();

        //TODO : Add unique slug validation

        if (!$this->validate($blogsModel->getValidationRules())) {
            return view('back-end/cms/blogs/new-blog', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'featured_image' => $this->request->getPost('featured_image'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'tags' => getCsvFromJsonList($this->request->getPost('tags')),
            'is_featured' => $this->request->getPost('is_featured'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => getCsvFromJsonList($this->request->getPost('meta_keywords'))
        ];

        if ($blogsModel->createBlog($data)) {
            $insertedId = $blogsModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::BLOG_CREATION, 'Blog created: with id' . $insertedId);
            return redirect()->to('/account/cms/blogs');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_BLOG_CREATION, 'Failed to create blog with title: ' . $data['title']);
            return view('back-end/cms/blogs/new-blog');
        }
    }

    public function viewBlog($blogId)
    {
        $tableName = 'blogs';
        //Check if record exists
        if (!recordExists($tableName, "blog_id", $blogId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/blogs');
        }

        $blogsModel = new BlogsModel();
        $data = ['blog_data' => $blogsModel->find($blogId)];
        return view('back-end/cms/blogs/view-blog', $data);
    }

    public function editBlog($blogId)
    {
        $tableName = 'blogs';
        //Check if record exists
        if (!recordExists($tableName, "blog_id", $blogId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/blogs');
        }

        $blogsModel = new BlogsModel();
        $data = ['blog_data' => $blogsModel->find($blogId)];
        return view('back-end/cms/blogs/edit-blog', $data);
    }

    public function updateBlog()
    {
        $loggedInUserId = $this->session->get('user_id');
        $blogsModel = new BlogsModel();
        $blogId = $this->request->getPost('blog_id');

        //TODO : Add unique slug validation except current

        if (!$this->validate($blogsModel->getValidationRules())) {
            return view('back-end/cms/blogs/edit-blog', ['validation' => $this->validator, 'blog_data' => $blogsModel->find($blogId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'featured_image' => $this->request->getPost('featured_image'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'tags' => getCsvFromJsonList($this->request->getPost('tags')),
            'is_featured' => $this->request->getPost('is_featured'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('status'),
            'updated_by' => $loggedInUserId,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => getCsvFromJsonList($this->request->getPost('meta_keywords'))
        ];

        if ($blogsModel->updateBlog($blogId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::BLOG_UPDATE, 'Blog updated with id: ' . $blogId);
            return redirect()->to('/account/cms/blogs');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_BLOG_UPDATE, 'Failed to update blog with id: ' . $blogId);
            return redirect()->to('/account/cms/edit-blog/' . $blogId);
        }
    }

    //############################//
    //         Categories         //
    //############################//
    public function categories()
    {
        $tableName = 'categories';
        $categoriesModel = new CategoriesModel();

        // Set data to pass in view
        $data = [
            'categories' => $categoriesModel->orderBy('title', 'ASC')->findAll(),
            'total_categories' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/categories/index', $data);
    }
    
    public function newCategory()
    {
        return view('back-end/cms/categories/new-category');
    }

    public function addCategory()
    {
        $loggedInUserId = $this->session->get('user_id');
        $categoriesModel = new CategoriesModel();

        if (!$this->validate($categoriesModel->getValidationRules())) {
            return view('back-end/cms/categories/new-category', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'group' => $this->request->getPost('group'),
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
        ];

        if ($categoriesModel->createCategory($data)) {
            $insertedId = $categoriesModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CATEGORY_CREATION, 'Category created with id: ' . $insertedId);
            return redirect()->to('/account/cms/categories');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CATEGORY_CREATION, 'Failed to create category with title: ' . $data['title']);
            return view('back-end/cms/categories/new-category');
        }
    }

    public function editCategory($categoryId)
    {
        
        $tableName = 'categories';
        //Check if record exists
        if (!recordExists($tableName, "category_id", $categoryId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/categories');
        }

        $categoriesModel = new CategoriesModel();
        $data = ['category_data' => $categoriesModel->find($categoryId)];
        return view('back-end/cms/categories/edit-category', $data);
    }

    public function updateCategory()
    {
        $loggedInUserId = $this->session->get('user_id');
        $categoriesModel = new CategoriesModel();
        $categoryId = $this->request->getPost('category_id');

        if (!$this->validate($categoriesModel->getValidationRules())) {
            return view('back-end/cms/categories/edit-category', ['validation' => $this->validator, 'category_data' => $categoriesModel->find($categoryId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'group' => $this->request->getPost('group'),
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($categoriesModel->updateCategory($categoryId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CATEGORY_UPDATE, 'Category updated with id: ' . $categoryId);
            return redirect()->to('/account/cms/categories');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CATEGORY_UPDATE, 'Failed to update category with id: ' . $categoryId);
            return redirect()->to('/account/cms/edit-category/' . $categoryId);
        }
    }
    
    //############################//
    //        Navigations         //
    //############################//
    public function navigations()
    {
        $tableName = 'navigations';
        $navigationsModel = new NavigationsModel();

        // Set data to pass in view
        $data = [
            'navigations' => $navigationsModel->orderBy('order', 'ASC')->findAll(),
            'total_navigations' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/navigations/index', $data);
    }
    
    public function newNavigation()
    {
        return view('back-end/cms/navigations/new-navigation');
    }

    public function addNavigation()
    {
        $loggedInUserId = $this->session->get('user_id');
        $navigationsModel = new NavigationsModel();

        if (!$this->validate($navigationsModel->getValidationRules())) {
            return view('back-end/cms/navigations/new-navigation', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'group' => $this->request->getPost('group'),
            'order' => $this->request->getPost('order') ?? 10,
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab') ?? 0,
            'slug' => $this->request->getPost('slug'),
			'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        if ($navigationsModel->createNavigation($data)) {
            $insertedId = $navigationsModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::NAVIGATION_CREATION, 'Navigation created with id: ' . $insertedId);
            return redirect()->to('/account/cms/navigations');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_NAVIGATION_CREATION, 'Failed to create navigation with title: ' . $data['title']);
            return view('back-end/cms/navigations/new-navigation');
        }
    }

    public function viewNavigation($navigationId)
    {
        $tableName = 'navigations';
        //Check if record exists
        if (!recordExists($tableName, "navigation_id", $navigationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/navigations');
        }

        $navigationsModel = new NavigationsModel();
        $data = ['navigation_data' => $navigationsModel->find($navigationId)];
        return view('back-end/cms/navigations/view-navigation', $data);
    }

    public function editNavigation($navigationId)
    {
        $tableName = 'navigations';
        //Check if record exists
        if (!recordExists($tableName, "navigation_id", $navigationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/navigations');
        }

        $navigationsModel = new NavigationsModel();
        $data = ['navigation_data' => $navigationsModel->find($navigationId)];
        return view('back-end/cms/navigations/edit-navigation', $data);
    }

    public function updateNavigation()
    {
        $loggedInUserId = $this->session->get('user_id');
        $navigationsModel = new NavigationsModel();
        $navigationId = $this->request->getPost('navigation_id');

        if (!$this->validate($navigationsModel->getValidationRules())) {
            return view('back-end/cms/navigations/edit-navigation', ['validation' => $this->validator, 'navigation_data' => $navigationsModel->find($navigationId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'group' => $this->request->getPost('group'),
            'order' => $this->request->getPost('order') ?? 10,
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab') ?? 0,
            'slug' => $this->request->getPost('slug'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($navigationsModel->updateNavigation($navigationId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::NAVIGATION_UPDATE, 'Navigation updated with id: ' . $navigationId);
            return redirect()->to('/account/cms/navigations');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_NAVIGATION_UPDATE, 'Failed to update navigation with id: ' . $navigationId);
            return redirect()->to('/account/cms/edit-navigation/' . $navigationId);
        }
    }

    //############################//
    //         Home Page          //
    //############################//
	public function homePage()
	{
		$tableName = 'home_page';
		$homePageModel = new HomePageModel();

		// Set data to pass in view
		$data = [
			'home_pages' => $homePageModel->orderBy('order', 'ASC')->findAll(),
			'total_home_pages' => getTotalRecords($tableName)
		];

		return view('back-end/cms/home-page/index', $data);
	}

	public function viewHomePageSection($homePageId)
	{
		$homePageModel = new HomePageModel();

		// Fetch the data based on the id
		$homePageData = $homePageModel->where('home_page_id', $homePageId)->first();

		if (!$homePageData) {
			$errorMsg = config('CustomConfig')->notFoundMsg;
			session()->setFlashdata('errorAlert', $errorMsg);
			return redirect()->to('/account/cms/home-page');
		}

		// Set data to pass in view
		$data = [
			'home_page_data' => $homePageData
		];

		return view('back-end/cms/home-page/view-home-page-section', $data);
	}

	public function editHomePageSection($homePageId)
	{
		$homePageModel = new HomePageModel();

		// Fetch the data based on the id
		$homePageData = $homePageModel->where('home_page_id', $homePageId)->first();

		if (!$homePageData) {
			$errorMsg = config('CustomConfig')->notFoundMsg;
			session()->setFlashdata('errorAlert', $errorMsg);
			return redirect()->to('/account/cms/home-page');
		}

		// Set data to pass in view
		$data = [
			'home_page_data' => $homePageData
		];

		return view('back-end/cms/home-page/edit-home-page-section', $data);
	}

	public function updateHomePageSection()
	{
		//get logged-in user id
		$loggedInUserId = $this->session->get('user_id');

		$homePageModel = new HomePageModel();

		// Custom validation rules
		$rules = [
			'section_title' => 'required',
			'status' => 'required',
			'order' => 'required',
		];

		$homePageId = $this->request->getVar('home_page_id');
		$data['home_page_data'] = $homePageModel->where('home_page_id', $homePageId)->first();

		if($this->validate($rules)){
			$db = \Config\Database::connect();
			$builder = $db->table('home_page');
			$data = [
                'section' => $this->request->getPost('section'),
                'section_title' => $this->request->getPost('section_title'),
                'section_description' => $this->request->getPost('section_description'),
                'section_image' => $this->request->getPost('section_image'),
                'section_image_2' => $this->request->getPost('section_image_2'),
                'section_image_3' => $this->request->getPost('section_image_3'),
                'section_image_4' => $this->request->getPost('section_image_4'),
                'section_video' => $this->request->getPost('section_video'),
                'section_audio' => $this->request->getPost('section_audio'),
                'section_file' => $this->request->getPost('section_file'),
                'content_blocks' => arrayToCommaString($this->request->getPost('content_blocks')) ?? $this->request->getPost('current_content_blocks'),
                'section_link' => $this->request->getPost('section_link'),
                'new_tab' => $this->request->getPost('new_tab'),
				'status'  => $this->request->getVar('status'),
				'order'  => $this->request->getVar('order') ?? 10,
				'deletable' => $this->request->getPost('deletable') ?? 1,
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $loggedInUserId,
			];

			$builder->where('home_page_id', $homePageId);
			$builder->update($data);

			// Record updated successfully. Redirect to dashboard
			$createSuccessMsg = config('CustomConfig')->editSuccessMsg;
			session()->setFlashdata('successAlert', $createSuccessMsg);

			//log activity
			logActivity($loggedInUserId, ActivityTypes::HOME_PAGE_UPDATE, 'Home page section updated with id: ' . $homePageId);

			return redirect()->to('/account/cms/home-page');
		}
		else{
			$data['validation'] = $this->validator;
			$errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
			session()->setFlashdata('errorAlert', $errorMsg);

			//log activity
			logActivity($loggedInUserId, ActivityTypes::FAILED_HOME_PAGE_UPDATE, 'Failed to update home page section with id: ' . $homePageId);

			return view('back-end/cms/home-page/edit-home-page-section', $data);
		}
	}

    //############################//
    //           Pages            //
    //############################//
    public function pages()
    {
        $tableName = 'pages';
        $pagesModel = new PagesModel();

        // Set data to pass in view
        $data = [
            'pages' => $pagesModel->orderBy('title', 'ASC')->findAll(),
            'total_pages' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/pages/index', $data);
    }
    
    public function newPage()
    {
        return view('back-end/cms/pages/new-page');
    }

    public function addPage()
    {
        $loggedInUserId = $this->session->get('user_id');
        $pagesModel = new PagesModel();

        if (!$this->validate($pagesModel->getValidationRules())) {
            return view('back-end/cms/pages/new-page', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description')
        ];

        if ($pagesModel->createPage($data)) {
            $insertedId = $pagesModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PAGE_CREATION, 'Page created with id: ' . $insertedId);
            return redirect()->to('/account/cms/pages');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PAGE_CREATION, 'Failed to create page with title: ' . $data['title']);
            return view('back-end/cms/pages/new-page');
        }
    }

    public function viewPage($pageId)
    { 
        $tableName = 'pages';
        //Check if record exists
        if (!recordExists($tableName, "page_id", $pageId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/pages');
        }

        $pagesModel = new PagesModel();
        $data = ['page_data' => $pagesModel->find($pageId)];
        return view('back-end/cms/pages/view-page', $data);
    }

    public function editPage($pageId)
    {
        $tableName = 'pages';
        //Check if record exists
        if (!recordExists($tableName, "page_id", $pageId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/pages');
        }

        $pagesModel = new PagesModel();
        $data = ['page_data' => $pagesModel->find($pageId)];
        return view('back-end/cms/pages/edit-page', $data);
    }

    public function updatePage()
    {
        $loggedInUserId = $this->session->get('user_id');
        $pagesModel = new PagesModel();
        $pageId = $this->request->getPost('page_id');

        if (!$this->validate($pagesModel->getValidationRules())) {
            return view('back-end/cms/pages/edit-page', ['validation' => $this->validator, 'page_data' => $pagesModel->find($pageId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description')
        ];

        if ($pagesModel->updatePage($pageId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PAGE_UPDATE, 'Page updated with id: ' . $pageId);
            return redirect()->to('/account/cms/pages');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PAGE_UPDATE, 'Failed to update page with id: ' . $pageId);
            return redirect()->to('/account/cms/edit-page/' . $pageId);
        }
    }

    //############################//
    //       Content Blocks       //
    //############################//
    public function contentBlocks()
    {
        $tableName = 'content_blocks';
        $contentBlocksModel = new ContentBlocksModel();

        // Set data to pass in view
        $data = [
            'content_blocks' => $contentBlocksModel->orderBy('created_at', 'DESC')->findAll(),
            'total_content_blocks' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/content-blocks/index', $data);
    }

    public function newContentBlock()
    {
        return view('back-end/cms/content-blocks/new-content-block');
    }

    public function addContentBlock()
    {
        $loggedInUserId = $this->session->get('user_id');
        $contentBlocksModel = new ContentBlocksModel();

        if (!$this->validate($contentBlocksModel->getValidationRules())) {
            return view('back-end/cms/content-blocks/new-content-block', ['validation' => $this->validator]);
        }

        $data = [
            'identifier' => $this->request->getPost('identifier'),
            'author' => $loggedInUserId,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'image' => $this->request->getPost('image'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'custom_field' => $this->request->getPost('custom_field'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
        ];

        if ($contentBlocksModel->createContentBlock($data)) {
            $insertedId = $contentBlocksModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CONTENT_BLOCK_CREATION, 'Content block created with id: ' . $insertedId);
            return redirect()->to('/account/cms/content-blocks');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONTENT_BLOCK_CREATION, 'Failed to create content block with title: ' . $data['title']);
            return view('back-end/cms/content-blocks/new-content-block');
        }
    }

    public function viewContentBlock($contentBlockId)
    {
        $tableName = 'content_blocks';
        //Check if record exists
        if (!recordExists($tableName, "content_id", $contentBlockId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/content-blocks');
        }

        $contentBlocksModel = new ContentBlocksModel();
        $data = ['content_block_data' => $contentBlocksModel->find($contentBlockId)];
        return view('back-end/cms/content-blocks/view-content-block', $data);
    }

    public function editContentBlock($contentBlockId)
    {
        $tableName = 'content_blocks';
        //Check if record exists
        if (!recordExists($tableName, "content_id", $contentBlockId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/content-blocks');
        }

        $contentBlocksModel = new ContentBlocksModel();
        $data = ['content_block_data' => $contentBlocksModel->find($contentBlockId)];
        return view('back-end/cms/content-blocks/edit-content-block', $data);
    }

    public function updateContentBlock()
    {
        $loggedInUserId = $this->session->get('user_id');
        $contentBlocksModel = new ContentBlocksModel();
        $contentBlockId = $this->request->getPost('content_id');

        if (!$this->validate($contentBlocksModel->getValidationRules())) {
            return view('back-end/cms/content-blocks/edit-content-block', ['validation' => $this->validator, 'content_block_data' => $contentBlocksModel->find($contentBlockId)]);
        }

        $data = [
            'identifier' => $this->request->getPost('identifier'),
            'author' => $loggedInUserId,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'image' => $this->request->getPost('image'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'custom_field' => $this->request->getPost('custom_field'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($contentBlocksModel->updateContentBlock($contentBlockId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CONTENT_BLOCK_UPDATE, 'Content block updated with id: ' . $contentBlockId);
            return redirect()->to('/account/cms/content-blocks');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONTENT_BLOCK_UPDATE, 'Failed to update content block with id: ' . $contentBlockId);
            return redirect()->to('/account/cms/edit-content-block/' . $contentBlockId);
        }
    }


    //############################//
    //          Events            //
    //############################//
    public function events()
    {
        $tableName = 'events';
        $eventsModel = new EventsModel();

        // Set data to pass in view
        $data = [
            'events' => $eventsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_events' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/events/index', $data);
    }

    public function newEvent()
    {
        return view('back-end/cms/events/new-event');
    }

    public function addEvent()
    {
        $loggedInUserId = $this->session->get('user_id');
        $eventsModel = new EventsModel();

        if (!$this->validate($eventsModel->getValidationRules())) {
            return view('back-end/cms/events/new-event', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'image' => $this->request->getPost('image'),
            'content' => $this->request->getPost('content'),
            'start_date' => $this->request->getPost('start_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_date' => $this->request->getPost('end_date'),
            'end_time' => $this->request->getPost('end_time'),
            'location' => $this->request->getPost('location'),
            'registration_link_label' => $this->request->getPost('registration_link_label'),
            'registration_link' => $this->request->getPost('registration_link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords')
        ];

        if ($eventsModel->createEvent($data)) {
            $insertedId = $eventsModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::EVENT_CREATION, 'Event created with id: ' . $insertedId);
            return redirect()->to('/account/cms/events');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_EVENT_CREATION, 'Failed to create event with title: ' . $data['title']);
            return view('back-end/cms/events/new-event');
        }
    }

    public function viewEvent($eventId)
    {
        $tableName = 'events';
        //Check if record exists
        if (!recordExists($tableName, "event_id", $eventId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/events');
        }

        $eventsModel = new EventsModel();
        $data = ['event_data' => $eventsModel->find($eventId)];
        return view('back-end/cms/events/view-event', $data);
    }

    public function editEvent($eventId)
    {
        $tableName = 'events';
        //Check if record exists
        if (!recordExists($tableName, "event_id", $eventId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/events');
        }

        $eventsModel = new EventsModel();
        $data = ['event_data' => $eventsModel->find($eventId)];
        return view('back-end/cms/events/edit-event', $data);
    }

    public function updateEvent()
    {
        $loggedInUserId = $this->session->get('user_id');
        $eventsModel = new EventsModel();
        $eventId = $this->request->getPost('event_id');

        if (!$this->validate($eventsModel->getValidationRules())) {
            return view('back-end/cms/events/edit-event', ['validation' => $this->validator, 'event_data' => $eventsModel->find($eventId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'image' => $this->request->getPost('image'),
            'content' => $this->request->getPost('content'),
            'start_date' => $this->request->getPost('start_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_date' => $this->request->getPost('end_date'),
            'end_time' => $this->request->getPost('end_time'),
            'location' => $this->request->getPost('location'),
            'registration_link_label' => $this->request->getPost('registration_link_label'),
            'registration_link' => $this->request->getPost('registration_link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description')
        ];

        if ($eventsModel->updateEvent($eventId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::EVENT_UPDATE, 'Event updated with id: ' . $eventId);
            return redirect()->to('/account/cms/events');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_EVENT_UPDATE, 'Failed to update event with id: ' . $eventId);
            return redirect()->to('/account/cms/edit-event/' . $eventId);
        }
    }

    //############################//
    //         Portfolios           //
    //############################//
    public function portfolios()
    {
        $tableName = 'portfolios';
        $portfoliosModel = new PortfoliosModel();

        // Set data to pass in view
        $data = [
            'portfolios' => $portfoliosModel->orderBy('created_at', 'DESC')->findAll(),
            'total_portfolios' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/portfolios/index', $data);
    }

    public function newPortfolio()
    {
        return view('back-end/cms/portfolios/new-portfolio');
    }

    public function addPortfolio()
    {
        $loggedInUserId = $this->session->get('user_id');
        $portfoliosModel = new PortfoliosModel();

        if (!$this->validate($portfoliosModel->getValidationRules())) {
            return view('back-end/cms/portfolios/new-portfolio', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'category' => $this->request->getPost('category'),
            'category_filter' => $this->request->getPost('category_filter'),
            'client' => $this->request->getPost('client'),
            'project_date' => $this->request->getPost('project_date'),
            'project_url' => $this->request->getPost('project_url'),
            'featured_image' => $this->request->getPost('featured_image'),
            'details_image_1' => $this->request->getPost('details_image_1'),
            'details_image_2' => $this->request->getPost('details_image_2'),
            'details_image_3' => $this->request->getPost('details_image_3'),
            'details_image_4' => $this->request->getPost('details_image_4'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords')
        ];

        if ($portfoliosModel->createPortfolio($data)) {
            $insertedId = $portfoliosModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PORTFOLIO_CREATION, 'Portfolio created with id: ' . $insertedId);
            return redirect()->to('/account/cms/portfolios');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PORTFOLIO_CREATION, 'Failed to create project with title: ' . $data['title']);
            return view('back-end/cms/portfolios/new-portfolio');
        }
    }

    public function viewPortfolio($portfolioId)
    {
        $tableName = 'portfolios';
        //Check if record exists
        if (!recordExists($tableName, "portfolio_id", $portfolioId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/portfolios');
        }

        $portfoliosModel = new PortfoliosModel();
        $data = ['portfolio_data' => $portfoliosModel->find($portfolioId)];
        return view('back-end/cms/portfolios/view-portfolio', $data);
    }

    public function editPortfolio($portfolioId)
    {
        $tableName = 'portfolios';
        //Check if record exists
        if (!recordExists($tableName, "portfolio_id", $portfolioId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/portfolios');
        }

        $portfoliosModel = new PortfoliosModel();
        $data = ['portfolio_data' => $portfoliosModel->find($portfolioId)];
        return view('back-end/cms/portfolios/edit-portfolio', $data);
    }

    public function updatePortfolio()
    {
        $loggedInUserId = $this->session->get('user_id');
        $portfoliosModel = new PortfoliosModel();
        $portfolioId = $this->request->getPost('portfolio_id');

        $rules = $portfoliosModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/portfolios/edit-portfolio', [
                'validation' => $this->validator,
                'portfolio_data' => $portfoliosModel->find($portfolioId)
            ]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'category' => $this->request->getPost('category'),
            'category_filter' => $this->request->getPost('category_filter'),
            'client' => $this->request->getPost('client'),
            'project_date' => $this->request->getPost('project_date'),
            'project_url' => $this->request->getPost('project_url'),
            'featured_image' => $this->request->getPost('featured_image'),
            'details_image_1' => $this->request->getPost('details_image_1'),
            'details_image_2' => $this->request->getPost('details_image_2'),
            'details_image_3' => $this->request->getPost('details_image_3'),
            'details_image_4' => $this->request->getPost('details_image_4'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords')
        ];

        if ($portfoliosModel->updatePortfolio($portfolioId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PORTFOLIO_UPDATE, 'Portfolio updated with id' . $portfolioId);
            return redirect()->to('/account/cms/portfolios');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PORTFOLIO_UPDATE, 'Failed to update project with id' . $portfolioId);
            return redirect()->to('/account/cms/portfolios/edit-portfolio/' . $portfolioId);
        }
    }

    
    //############################//
    //         Services           //
    //############################//
    public function services()
    {
        $tableName = 'services';
        $servicesModel = new ServicesModel();
    
        // Set data to pass in view
        $data = [
            'services' => $servicesModel->orderBy('created_at', 'DESC')->findAll(),
            'total_services' => getTotalRecords($tableName)
        ];
    
        return view('back-end/cms/services/index', $data);
    }
    
    public function newService()
    {
        return view('back-end/cms/services/new-service');
    }
    
    public function addService()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the ServicesModel
        $servicesModel = new ServicesModel();
    
        // Validate the input
        $rules = $servicesModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/services/new-service', ['validation' => $this->validator]);
        }
    
        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'image' => $this->request->getPost('image'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];
    
        // Attempt to create the service
        if ($servicesModel->createService($data)) {
            $insertedId = $servicesModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::SERVICE_CREATION, 'Service created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/services');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_SERVICE_CREATION, 'Failed to create service with title: ' . $this->request->getPost('title'));
    
            return view('back-end/cms/services/new-service');
        }
    }
    
    public function editService($serviceId)
    {
        $tableName = 'services';
        //Check if record exists
        if (!recordExists($tableName, "service_id", $serviceId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/services');
        }

        $servicesModel = new ServicesModel();
    
        // Fetch the data based on the id
        $service = $servicesModel->where('service_id', $serviceId)->first();
    
        // Set data to pass in view
        $data = [
            'service_data' => $service
        ];
    
        return view('back-end/cms/services/edit-service', $data);
    }
    
    public function updateService()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $servicesModel = new ServicesModel();
        $serviceId = $this->request->getPost('service_id');
    
        if (!$this->validate($servicesModel->getValidationRules())) {
            return view('back-end/cms/services/edit-service', ['validation' => $this->validator, 'service_data' => $servicesModel->find($serviceId)]);
        }
    
        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'image' => $this->request->getPost('image'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($servicesModel->updateService($serviceId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::SERVICE_UPDATE, 'Service updated with id: ' . $serviceId);
            return redirect()->to('/account/cms/services');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_SERVICE_UPDATE, 'Failed to update service with id: ' . $serviceId);
            return redirect()->to('/account/cms/edit-service/' . $serviceId);
        }
    }
	
	
	//############################//
    //         Partners           //
    //############################//
    public function partners()
    {
        $tableName = 'partners';
        $partnersModel = new PartnersModel();
    
        // Set data to pass in view
        $data = [
            'partners' => $partnersModel->orderBy('created_at', 'DESC')->findAll(),
            'total_partners' => getTotalRecords($tableName)
        ];
    
        return view('back-end/cms/partners/index', $data);
    }
    
    public function newPartner()
    {
        return view('back-end/cms/partners/new-partner');
    }
    
    public function addPartner()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the PartnersModel
        $partnersModel = new PartnersModel();
    
        // Validate the input
        $rules = $partnersModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/partners/new-partner', ['validation' => $this->validator]);
        }
    
        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'logo' => $this->request->getPost('logo'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];
    
        // Attempt to create the partner
        if ($partnersModel->createPartner($data)) {
            $insertedId = $partnersModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::PARTNER_CREATION, 'Partner created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/partners');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_PARTNER_CREATION, 'Failed to create partner with title: ' . $this->request->getPost('title'));
    
            return view('back-end/cms/partners/new-partner');
        }
    }
    
    public function editPartner($partnerId)
    {
        $tableName = 'partners';
        //Check if record exists
        if (!recordExists($tableName, "partner_id", $partnerId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/partners');
        }

        $partnersModel = new PartnersModel();
    
        // Fetch the data based on the id
        $partner = $partnersModel->where('partner_id', $partnerId)->first();
    
        // Set data to pass in view
        $data = [
            'partner_data' => $partner
        ];
    
        return view('back-end/cms/partners/edit-partner', $data);
    }
    
    public function updatePartner()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $partnersModel = new PartnersModel();
        $partnerId = $this->request->getPost('partner_id');
    
        if (!$this->validate($partnersModel->getValidationRules())) {
            return view('back-end/cms/partners/edit-partner', ['validation' => $this->validator, 'partner_data' => $partnersModel->find($partnerId)]);
        }
    
        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'logo' => $this->request->getPost('logo'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($partnersModel->updatePartner($partnerId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PARTNER_UPDATE, 'Partner updated with id: ' . $partnerId);
            return redirect()->to('/account/cms/partners');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PARTNER_UPDATE, 'Failed to update partner with id: ' . $partnerId);
            return redirect()->to('/account/cms/edit-partner/' . $partnerId);
        }
    }

    //############################//
    //         Counters           //
    //############################//
    public function counters()
    {
        $tableName = 'counters';
        $countersModel = new CountersModel();
    
        // Set data to pass in view
        $data = [
            'counters' => $countersModel->orderBy('created_at', 'DESC')->findAll(),
            'total_counters' => getTotalRecords($tableName)
        ];
    
        return view('back-end/cms/counters/index', $data);
    }
    
    public function newCounter()
    {
        return view('back-end/cms/counters/new-counter');
    }
    
    public function addCounter()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the CountersModel
        $countersModel = new CountersModel();
    
        // Validate the input
        $rules = $countersModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/counters/new-counter', ['validation' => $this->validator]);
        }
    
        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'initial_value' => $this->request->getPost('initial_value'),
            'final_value' => $this->request->getPost('final_value'),
            'extra_text' => $this->request->getPost('extra_text'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];
    
        // Attempt to create the counter
        if ($countersModel->createCounter($data)) {
            $insertedId = $countersModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::COUNTER_CREATION, 'Counter created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/counters');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_COUNTER_CREATION, 'Failed to create counter with title: ' . $this->request->getPost('title'));
    
            return view('back-end/cms/counters/new-counter');
        }
    }
    
    public function editCounter($counterId)
    {
        $tableName = 'counters';
        //Check if record exists
        if (!recordExists($tableName, "counter_id", $counterId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/counters');
        }

        $countersModel = new CountersModel();
    
        // Fetch the data based on the id
        $counter = $countersModel->where('counter_id', $counterId)->first();
    
        // Set data to pass in view
        $data = [
            'counter_data' => $counter
        ];
    
        return view('back-end/cms/counters/edit-counter', $data);
    }
    
    public function updateCounter()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $countersModel = new CountersModel();
        $counterId = $this->request->getPost('counter_id');
    
        if (!$this->validate($countersModel->getValidationRules())) {
            return view('back-end/cms/counters/edit-counter', ['validation' => $this->validator, 'counter_data' => $countersModel->find($counterId)]);
        }
    
        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'initial_value' => $this->request->getPost('initial_value'),
            'final_value' => $this->request->getPost('final_value'),
            'extra_text' => $this->request->getPost('extra_text'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($countersModel->updateCounter($counterId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::COUNTER_UPDATE, 'Counter updated with id: ' . $counterId);
            return redirect()->to('/account/cms/counters');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_COUNTER_UPDATE, 'Failed to update counter with id: ' . $counterId);
            return redirect()->to('/account/cms/edit-counter/' . $counterId);
        }
    }

    //############################//
    //          Socials           //
    //############################//
    public function socials()
    {
        $tableName = 'socials';
        $socialsModel = new SocialsModel();

        // Set data to pass in view
        $data = [
            'socials' => $socialsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_socials' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/socials/index', $data);
    }

    public function newSocial()
    {
        return view('back-end/cms/socials/new-social');
    }

    public function addSocial()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the SocialsModel
        $socialsModel = new SocialsModel();

        // Validate the input
        $rules = $socialsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/socials/new-social', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'name' => $this->request->getPost('name'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];

        // Attempt to create the social
        if ($socialsModel->createSocial($data)) {
            $insertedId = $socialsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::SOCIAL_CREATION, 'Social created with id: ' . $insertedId);

            return redirect()->to('/account/cms/socials');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_SOCIAL_CREATION, 'Failed to create social with name: ' . $this->request->getPost('name'));

            return view('back-end/cms/socials/new-social');
        }
    }

    public function editSocial($socialId)
    {
        $tableName = 'socials';
        //Check if record exists
        if (!recordExists($tableName, "social_id", $socialId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/socials');
        }

        $socialsModel = new SocialsModel();

        // Fetch the data based on the id
        $social = $socialsModel->where('social_id', $socialId)->first();

        // Set data to pass in view
        $data = [
            'social_data' => $social
        ];

        return view('back-end/cms/socials/edit-social', $data);
    }

    public function updateSocial()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $socialsModel = new SocialsModel();
        $socialId = $this->request->getPost('social_id');

        if (!$this->validate($socialsModel->getValidationRules())) {
            return view('back-end/cms/socials/edit-social', ['validation' => $this->validator, 'social_data' => $socialsModel->find($socialId)]);
        }

        // Prepare data for update
        $data = [
            'name' => $this->request->getPost('name'),
            'icon' => $this->request->getPost('icon'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($socialsModel->updateSocial($socialId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::SOCIAL_UPDATE, 'Social updated with id: ' . $socialId);
            return redirect()->to('/account/cms/socials');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_SOCIAL_UPDATE, 'Failed to update social with id: ' . $socialId);
            return redirect()->to('/account/cms/edit-social/' . $socialId);
        }
    }

    //############################//
    //         Pricings           //
    //############################//
    public function pricings()
    {
        $tableName = 'pricings';
        $pricingsModel = new PricingsModel();

        // Set data to pass in view
        $data = [
            'pricings' => $pricingsModel->orderBy('order', 'ASC')->findAll(),
            'total_pricings' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/pricings/index', $data);
    }

    public function newPricing()
    {
        return view('back-end/cms/pricings/new-pricing');
    }

    public function addPricing()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the PricingsModel
        $pricingsModel = new PricingsModel();

        // Validate the input
        $rules = $pricingsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/pricings/new-pricing', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'currency' => $this->request->getPost('currency'),
            'amount' => $this->request->getPost('amount'),
            'period' => $this->request->getPost('period'),
            'is_popular' => $this->request->getPost('is_popular'),
            'included_features_list' => $this->request->getPost('included_features_list'),
            'excluded_features_list' => $this->request->getPost('excluded_features_list'),
            'link_title' => $this->request->getPost('link_title'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order'),
            'other_label' => $this->request->getPost('other_label'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];

        // Attempt to create the pricing
        if ($pricingsModel->createPricing($data)) {
            $insertedId = $pricingsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::PRICING_CREATION, 'Pricing created with id: ' . $insertedId);

            return redirect()->to('/account/cms/pricings');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRICING_CREATION, 'Failed to create pricing with title: ' . $this->request->getPost('title'));

            return view('back-end/cms/pricings/new-pricing');
        }
    }

    public function editPricing($pricingId)
    {
        $tableName = 'pricings';
        //Check if record exists
        if (!recordExists($tableName, "pricing_id", $pricingId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/pricings');
        }

        $pricingsModel = new PricingsModel();

        // Fetch the data based on the id
        $pricing = $pricingsModel->where('pricing_id', $pricingId)->first();

        // Set data to pass in view
        $data = [
            'pricing_data' => $pricing
        ];

        return view('back-end/cms/pricings/edit-pricing', $data);
    }

    public function updatePricing()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $pricingsModel = new PricingsModel();
        $pricingId = $this->request->getPost('pricing_id');

        if (!$this->validate($pricingsModel->getValidationRules())) {
            return view('back-end/cms/pricings/edit-pricing', ['validation' => $this->validator, 'pricing_data' => $pricingsModel->find($pricingId)]);
        }

        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'currency' => $this->request->getPost('currency'),
            'amount' => $this->request->getPost('amount'),
            'period' => $this->request->getPost('period'),
            'is_popular' => $this->request->getPost('is_popular'),
            'included_features_list' => $this->request->getPost('included_features_list'),
            'excluded_features_list' => $this->request->getPost('excluded_features_list'),
            'link_title' => $this->request->getPost('link_title'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order'),
            'other_label' => $this->request->getPost('other_label'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($pricingsModel->updatePricing($pricingId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PRICING_UPDATE, 'Pricing updated with id: ' . $pricingId);
            return redirect()->to('/account/cms/pricings');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRICING_UPDATE, 'Failed to update pricing with id: ' . $pricingId);
            return redirect()->to('/account/cms/edit-pricing/' . $pricingId);
        }
    }
    
    public function viewPricing($pricingId)
    {
        $tableName = 'pricings';
        //Check if record exists
        if (!recordExists($tableName, "pricing_id", $pricingId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/pricings');
        }

        $pricingsModel = new PricingsModel();
    
        // Fetch the data based on the id
        $pricing = $pricingsModel->where('pricing_id', $pricingId)->first();
    
        // Set data to pass in view
        $data = [
            'pricing_data' => $pricing
        ];
    
        return view('back-end/cms/pricings/view-pricing', $data);
    }

    //############################//
    //           Teams            //
    //############################//
    public function teams()
    {
        $tableName = 'teams';
        $teamsModel = new TeamsModel();

        // Set data to pass in view
        $data = [
            'teams' => $teamsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_teams' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/teams/index', $data);
    }

    public function newTeam()
    {
        return view('back-end/cms/teams/new-team');
    }
    
    public function addTeam()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the TeamsModel
        $teamsModel = new TeamsModel();
    
        // Validate the input
        $rules = $teamsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/teams/new-team', ['validation' => $this->validator]);
        }
    
        // Prepare data for insertion
        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'image' => $this->request->getPost('image'),
            'summary' => $this->request->getPost('summary'),
            'social_link_1' => $this->request->getPost('social_link_1'),
            'social_link_2' => $this->request->getPost('social_link_2'),
            'social_link_3' => $this->request->getPost('social_link_3'),
            'social_link_4' => $this->request->getPost('social_link_4'),
            'social_link_5' => $this->request->getPost('social_link_5'),
            'social_link_6' => $this->request->getPost('social_link_6'),
            'details_link' => $this->request->getPost('details_link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];
    
        // Attempt to create the team
        if ($teamsModel->createTeam($data)) {
            $insertedId = $teamsModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::TEAM_CREATION, 'Team created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/teams');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_TEAM_CREATION, 'Failed to create team with title: ' . $this->request->getPost('title'));
    
            return view('back-end/cms/teams/new-team');
        }
    }
    
    public function editTeam($teamId)
    {
        $tableName = 'teams';
        //Check if record exists
        if (!recordExists($tableName, "team_id", $teamId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/teams');
        }

        $teamsModel = new TeamsModel();
    
        // Fetch the data based on the id
        $team = $teamsModel->where('team_id', $teamId)->first();
    
        // Set data to pass in view
        $data = [
            'team_data' => $team
        ];
    
        return view('back-end/cms/teams/edit-team', $data);
    }
    
    public function updateTeam()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $teamsModel = new TeamsModel();
        $teamId = $this->request->getPost('team_id');
    
        if (!$this->validate($teamsModel->getValidationRules())) {
            return view('back-end/cms/teams/edit-team', ['validation' => $this->validator, 'team_data' => $teamsModel->find($teamId)]);
        }
    
        // Prepare data for update
        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'image' => $this->request->getPost('image'),
            'summary' => $this->request->getPost('summary'),
            'social_link_1' => $this->request->getPost('social_link_1'),
            'social_link_2' => $this->request->getPost('social_link_2'),
            'social_link_3' => $this->request->getPost('social_link_3'),
            'social_link_4' => $this->request->getPost('social_link_4'),
            'social_link_5' => $this->request->getPost('social_link_5'),
            'social_link_6' => $this->request->getPost('social_link_6'),
            'details_link' => $this->request->getPost('details_link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($teamsModel->updateTeam($teamId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::TEAM_UPDATE, 'Team updated with id: ' . $teamId);
            return redirect()->to('/account/cms/teams');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_TEAM_UPDATE, 'Failed to update team with id: ' . $teamId);
            return redirect()->to('/account/cms/edit-team/' . $teamId);
        }
    }
    
    public function viewTeam($teamId)
    {
        $tableName = 'teams';
        //Check if record exists
        if (!recordExists($tableName, "team_id", $teamId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/teams');
        }

        $teamsModel = new TeamsModel();
    
        // Fetch the data based on the id
        $team = $teamsModel->where('team_id', $teamId)->first();
    
        // Set data to pass in view
        $data = [
            'team_data' => $team
        ];
    
        return view('back-end/cms/teams/view-team', $data);
    }

    //############################//
    //           FAQs             //
    //############################//
    public function faqs()
    {
        $tableName = 'faqs';
        $faqsModel = new FrequentlyAskedQuestionsModel();

        // Set data to pass in view
        $data = [
            'faqs' => $faqsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_faq' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/faqs/index', $data);
    }

    public function newFaq()
    {
        return view('back-end/cms/faqs/new-faq');
    }

    public function addFaq()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the FrequentlyAskedQuestionsModel
        $faqsModel = new FrequentlyAskedQuestionsModel();

        // Validate the input
        $rules = $faqsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/faqs/new-faq', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'order' => $this->request->getPost('order'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];

        // Attempt to create the faq
        if ($faqsModel->createFaq($data)) {
            $insertedId = $faqsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAQ_CREATION, 'FAQ created with id: ' . $insertedId);

            return redirect()->to('/account/cms/faqs');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_FAQ_CREATION, 'Failed to create FAQ with question: ' . $this->request->getPost('question'));

            return view('back-end/cms/faqs/new-faq');
        }
    }

    public function editFaq($faqId)
    {
        $tableName = 'faqs';
        //Check if record exists
        if (!recordExists($tableName, "faq_id", $faqId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/faqs');
        }

        $faqsModel = new FrequentlyAskedQuestionsModel();

        // Fetch the data based on the id
        $faq = $faqsModel->where('faq_id', $faqId)->first();

        // Set data to pass in view
        $data = [
            'faq_data' => $faq
        ];

        return view('back-end/cms/faqs/edit-faq', $data);
    }

    public function updateFaq()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $faqsModel = new FrequentlyAskedQuestionsModel();
        $faqId = $this->request->getPost('faq_id');

        if (!$this->validate($faqsModel->getValidationRules())) {
            return view('back-end/cms/faqs/edit-faq', ['validation' => $this->validator, 'faq_data' => $faqsModel->find($faqId)]);
        }

        // Prepare data for update
        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'order' => $this->request->getPost('order'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($faqsModel->updateFaq($faqId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::FAQ_UPDATE, 'FAQ updated with id: ' . $faqId);
            return redirect()->to('/account/cms/faqs');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_FAQ_UPDATE, 'Failed to update FAQ with id: ' . $faqId);
            return redirect()->to('/account/cms/edit-faq/' . $faqId);
        }
    }

    public function viewFaq($faqId)
    {
        $tableName = 'faqs';
        //Check if record exists
        if (!recordExists($tableName, "faq_id", $faqId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/faqs');
        }

        $faqsModel = new FrequentlyAskedQuestionsModel();

        // Fetch the data based on the id
        $faq = $faqsModel->where('faq_id', $faqId)->first();

        // Set data to pass in view
        $data = [
            'faq_data' => $faq
        ];

        return view('back-end/cms/faqs/view-faq', $data);
    }

    //############################//
    //       Testimonials         //
    //############################//
    public function testimonials()
    {
        $tableName = 'testimonials';
        $testimonialsModel = new TestimonialsModel();
    
        // Set data to pass in view
        $data = [
            'testimonials' => $testimonialsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_testimonials' => getTotalRecords($tableName)
        ];
    
        return view('back-end/cms/testimonials/index', $data);
    }
    
    public function newTestimonial()
    {
        return view('back-end/cms/testimonials/new-testimonial');
    }
    
    public function addTestimonial()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the TestimonialsModel
        $testimonialsModel = new TestimonialsModel();
    
        // Validate the input
        $rules = $testimonialsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/cms/testimonials/new-testimonial', ['validation' => $this->validator]);
        }
    
        // Prepare data for insertion
        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'company' => $this->request->getPost('company'),
            'image' => $this->request->getPost('image'),
            'testimonial' => $this->request->getPost('testimonial'),
            'rating' => $this->request->getPost('rating'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $loggedInUserId,
            'updated_by' => $this->request->getPost('updated_by')
        ];
    
        // Attempt to create the testimonial
        if ($testimonialsModel->createTestimonial($data)) {
            $insertedId = $testimonialsModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::TESTIMONIAL_CREATION, 'Testimonial created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/testimonials');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_TESTIMONIAL_CREATION, 'Failed to create testimonial with name: ' . $this->request->getPost('name'));
    
            return view('back-end/cms/testimonials/new-testimonial');
        }
    }
    
    public function editTestimonial($testimonialId)
    {
        $tableName = 'testimonials';
        //Check if record exists
        if (!recordExists($tableName, "testimonial_id", $testimonialId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/testimonials');
        }

        $testimonialsModel = new TestimonialsModel();
    
        // Fetch the data based on the id
        $testimonial = $testimonialsModel->where('testimonial_id', $testimonialId)->first();
    
        // Set data to pass in view
        $data = [
            'testimonial_data' => $testimonial
        ];
    
        return view('back-end/cms/testimonials/edit-testimonial', $data);
    }
    
    public function updateTestimonial()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $testimonialsModel = new TestimonialsModel();
        $testimonialId = $this->request->getPost('testimonial_id');
    
        if (!$this->validate($testimonialsModel->getValidationRules())) {
            return view('back-end/cms/testimonials/edit-testimonial', ['validation' => $this->validator, 'testimonial_data' => $testimonialsModel->find($testimonialId)]);
        }
    
        // Prepare data for update
        $data = [
            'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'company' => $this->request->getPost('company'),
            'image' => $this->request->getPost('image'),
            'testimonial' => $this->request->getPost('testimonial'),
            'rating' => $this->request->getPost('rating'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($testimonialsModel->updateTestimonial($testimonialId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::TESTIMONIAL_UPDATE, 'Testimonial updated with id: ' . $testimonialId);
            return redirect()->to('/account/cms/testimonials');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_TESTIMONIAL_UPDATE, 'Failed to update testimonial with id: ' . $testimonialId);
            return redirect()->to('/account/cms/edit-testimonial/' . $testimonialId);
        }
    }
    
    public function viewTestimonial($testimonialId)
    {
        $tableName = 'testimonials';
        //Check if record exists
        if (!recordExists($tableName, "testimonial_id", $testimonialId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/testimonials');
        }

        $testimonialsModel = new TestimonialsModel();
    
        // Fetch the data based on the id
        $testimonial = $testimonialsModel->where('testimonial_id', $testimonialId)->first();
    
        // Set data to pass in view
        $data = [
            'testimonial_data' => $testimonial
        ];
    
        return view('back-end/cms/testimonials/view-testimonial', $data);
    }

    
    //############################//
    //      Donation Causes       //
    //############################//
    public function donationCauses()
    {
        $tableName = 'donation_causes';
        $donationsModel = new DonationCausesModel();

        // Set data to pass in view
        $data = [
            'donations' => $donationsModel->orderBy('title', 'ASC')->findAll(),
            'total_donations' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/donation-causes/index', $data);
    }
    
    public function newDonationCause()
    {
        return view('back-end/cms/donation-causes/new-donation-cause');
    }

    public function addDonationCause()
    {
        $loggedInUserId = $this->session->get('user_id');
        $donationsModel = new DonationCausesModel();

        if (!$this->validate($donationsModel->getValidationRules())) {
            return view('back-end/cms/donation-causes/new-donation-cause', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'image' => $this->request->getPost('image'),
            'link_title' => $this->request->getPost('link_title'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'content' => $this->request->getPost('content'),
            'embedded_page_title' => $this->request->getPost('embedded_page_title'),
            'embedded_page' => $this->request->getPost('embedded_page'),
            'status' => $this->request->getPost('status'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
        ];

        if ($donationsModel->createDonationCause($data)) {
            $insertedId = $donationsModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::DONATION_CAUSE_CREATION, 'Donation cause created with id: ' . $insertedId);
            return redirect()->to('/account/cms/donation-causes');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_DONATION_CAUSE_CREATION, 'Failed to create donation with title: ' . $data['title']);
            return view('back-end/cms/donation-causes/new-donation-cause');
        }
    }

    public function viewDonationCause($donationId)
    {
        $tableName = 'donation_causes';
        //Check if record exists
        if (!recordExists($tableName, "donation_cause_id", $donationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/donation-causes');
        }

        $donationsModel = new DonationCausesModel();
        $data = ['donation_data' => $donationsModel->find($donationId)];
        return view('back-end/cms/donation-causes/view-donation-cause', $data);
    }

    public function editDonationCause($donationId)
    {
        $tableName = 'donation_causes';
        //Check if record exists
        if (!recordExists($tableName, "donation_cause_id", $donationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/donation-causes');
        }

        $donationsModel = new DonationCausesModel();
        $data = ['donation_data' => $donationsModel->find($donationId)];
        return view('back-end/cms/donation-causes/edit-donation-cause', $data);
    }

    public function updateDonationCause()
    {
        $loggedInUserId = $this->session->get('user_id');
        $donationsModel = new DonationCausesModel();
        $donationId = $this->request->getPost('donation_cause_id');

        if (!$this->validate($donationsModel->getValidationRules())) {
            return view('back-end/cms/donation-causes/edit-donation-cause', ['validation' => $this->validator, 'donation_data' => $donationsModel->find($donationId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'image' => $this->request->getPost('image'),
            'link_title' => $this->request->getPost('link_title'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'content' => $this->request->getPost('content'),
            'embedded_page_title' => $this->request->getPost('embedded_page_title'),
            'embedded_page' => $this->request->getPost('embedded_page'),
            'status' => $this->request->getPost('status'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($donationsModel->updateDonationCause($donationId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::DONATION_CAUSE_UPDATE, 'Donation cause updated with id: ' . $donationId);
            return redirect()->to('/account/cms/donation-causes');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_DONATION_CAUSE_UPDATE, 'Failed to update donation with id: ' . $donationId);
            return redirect()->to('/account/cms/edit-donation-cause/' . $donationId);
        }
    }
    

    //############################//
    //           Popups           //
    //############################//
    public function popups()
    {
        $tableName = 'announcement_popups';
        $popupsModel = new AnnouncementPopupsModel();

        // Set data to pass in view
        $data = [
            'popups' => $popupsModel->orderBy('title', 'ASC')->findAll(),
            'total_popups' => getTotalRecords($tableName)
        ];

        return view('back-end/cms/popups/index', $data);
    }

    public function viewPopup($popupId)
    {
        $tableName = 'announcement_popups';
        //Check if record exists
        if (!recordExists($tableName, "popup_id", $popupId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/popups');
        }

        $popupsModel = new AnnouncementPopupsModel();
        $data = ['popup_data' => $popupsModel->find($popupId)];
        return view('back-end/cms/popups/view-popup', $data);
    }

    public function editPopup($popupId)
    {
        $tableName = 'announcement_popups';
        //Check if record exists
        if (!recordExists($tableName, "popup_id", $popupId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/popups');
        }

        $popupsModel = new AnnouncementPopupsModel();
        $data = ['popup_data' => $popupsModel->find($popupId)];
        return view('back-end/cms/popups/edit-popup', $data);
    }

    public function updatePopup()
    {

        $loggedInUserId = $this->session->get('user_id');
        $popupsModel = new AnnouncementPopupsModel();
        $popupId = $this->request->getPost('popup_id');

        if (!$this->validate($popupsModel->getValidationRules())) {
            return view('back-end/cms/popups/edit-popup', ['validation' => $this->validator, 'popup_data' => $popupsModel->find($popupId)]);
        }

        //if status as published, set the rest as unpublished
        if($this->request->getPost('status') == "1"){
            $updatedData = [
                'status' => 0
            ];

            $updateWhereClause = "popup_id != 'NULL'";

            updateRecord('announcement_popups', $updatedData, $updateWhereClause);
        }

        $selectedPages = $this->request->getPost('show_on_pages');
        $commaSeparatedPages = !empty($selectedPages) ? implode(',', $selectedPages) : "";
        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'title' => $this->request->getPost('title'),
            'text' => $this->request->getPost('text'),
            'button_text' => $this->request->getPost('button_text'),
            'button_color' => $this->request->getPost('button_color'),
            'cancel_button_text' => $this->request->getPost('cancel_button_text'),
            'cancel_button_color' => $this->request->getPost('cancel_button_color'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'delay' => $this->request->getPost('delay'),
            'image' => empty($this->request->getPost('image')) ? null : $this->request->getPost('image'),
            'background_color' => $this->request->getPost('background_color'),
            'text_color' => $this->request->getPost('text_color'),
            'backdrop_opacity' => $this->request->getPost('backdrop_opacity'),
            'width' => $this->request->getPost('width'),
            'height' => $this->request->getPost('height'),
            'position' => $this->request->getPost('position'),
            'animation' => $this->request->getPost('animation'),
            'show_close_button' => $this->request->getPost('show_close_button'),
            'enable_subscription' => $this->request->getPost('enable_subscription'),
            'subscription_placeholder' => $this->request->getPost('subscription_placeholder'),
            'subscription_success_message' => $this->request->getPost('subscription_success_message'),
            'enable_countdown' => $this->request->getPost('enable_countdown'),
            'countdown_end_date' => $this->request->getPost('countdown_end_date'),
            'countdown_format' => $this->request->getPost('countdown_format'),
            'countdown_expired_text' => $this->request->getPost('countdown_expired_text'),
            'order' => $this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'frequency' => $this->request->getPost('frequency'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'show_on_pages' => $commaSeparatedPages,
            'deletable' => $this->request->getPost('deletable'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($popupsModel->updatePopup($popupId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::POPUP_UPDATE, 'Popup updated with id: ' . $popupId);
            return redirect()->to('/account/cms/popups');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_POPUP_UPDATE, 'Failed to update popup with id: ' . $popupId);
            return redirect()->to('/account/cms/edit-popup/' . $popupId);
        }
    }
}
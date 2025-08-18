<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BlogsModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContentBlocksModel;
use App\Models\PagesModel;
use App\Models\DataGroupsModel;

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
            'blogs' => $blogsModel->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_VERY_HIGH', 100))),
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
            'meta_title' => !empty($this->request->getPost('meta_title')) ? $this->request->getPost('meta_title') : $this->request->getPost('title'),
            'meta_description' => !empty($this->request->getPost('meta_description')) ? $this->request->getPost('meta_description') : $this->request->getPost('excerpt'),
            'meta_keywords' => !empty($this->request->getPost('meta_keywords')) ? getCsvFromJsonList($this->request->getPost('meta_keywords')) : getCsvFromJsonList($this->request->getPost('tags')),
        ];

        if ($blogsModel->createBlog($data)) {
            $insertedId = $blogsModel->getInsertID();
            $createSuccessMsg = str_replace('[Record]', 'Blog', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
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
        $tableName = 'blogs';
        $loggedInUserId = $this->session->get('user_id');
        $blogsModel = new BlogsModel();
        $blogId = $this->request->getPost('blog_id');

        //Add unique slug validation except current
        $currentSlug = getTableData($tableName, ['blog_id' => $blogId], "slug");
        $newSlug = $this->request->getPost('slug');
        $newSlugExists = recordExists($tableName, "slug", $newSlug);
        if($newSlugExists && $currentSlug !== $newSlug){
             $newSlug = $newSlug .'-'. substr(md5(rand()) , 0, 8);
        }

        if (!$this->validate($blogsModel->getValidationRules())) {
            return view('back-end/cms/blogs/edit-blog', ['validation' => $this->validator, 'blog_data' => $blogsModel->find($blogId)]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $newSlug,
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
            $editSuccessMsg = str_replace('[Record]', 'Plugin', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
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
            $createSuccessMsg = str_replace('[Record]', 'Category', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
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
            $editSuccessMsg = str_replace('[Record]', 'Plugin', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
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
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'order' => $this->request->getPost('order') ?? 10,
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab') ?? 0,
            'status' => $this->request->getPost('status') ?? 1,
            'slug' => $this->request->getPost('slug'),
			'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        if ($navigationsModel->createNavigation($data)) {
            $insertedId = $navigationsModel->getInsertID();
            $createSuccessMsg = str_replace('[Record]', 'Navigation', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
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
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'order' => $this->request->getPost('order') ?? 10,
            'parent' => $this->request->getPost('parent'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab') ?? 0,
            'status' => $this->request->getPost('status') ?? 1,
            'slug' => $this->request->getPost('slug'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($navigationsModel->updateNavigation($navigationId, $data)) {
            $editSuccessMsg = str_replace('[Record]', 'Navigation', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::NAVIGATION_UPDATE, 'Navigation updated with id: ' . $navigationId);
            return redirect()->to('/account/cms/navigations');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_NAVIGATION_UPDATE, 'Failed to update navigation with id: ' . $navigationId);
            return redirect()->to('/account/cms/edit-navigation/' . $navigationId);
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
            'group' => $this->request->getPost('group'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
            'meta_title' => !empty($this->request->getPost('meta_title')) ? $this->request->getPost('meta_title') : $this->request->getPost('title'),
            'meta_description' => !empty($this->request->getPost('meta_description')) ? $this->request->getPost('meta_description') : getTextSummary(strip_tags($this->request->getPost('content')), 160),
            'meta_keywords' => $this->request->getPost('meta_keywords')
        ];

        if ($pagesModel->createPage($data)) {
            $insertedId = $pagesModel->getInsertID();
            $createSuccessMsg = str_replace('[Record]', 'Page', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
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
            'group' => $this->request->getPost('group'),
            'status' => $this->request->getPost('status'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId,
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description')
        ];

        if ($pagesModel->updatePage($pageId, $data)) {
            $editSuccessMsg = str_replace('[Record]', 'Page', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PAGE_UPDATE, 'Page updated with id: ' . $pageId);
            return redirect()->to('/account/cms/pages');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PAGE_UPDATE, 'Failed to update page with id: ' . $pageId);
            return redirect()->to('/account/cms/edit-page/' . $pageId);
        }
    }

    //############################//
    //         DataGroups         //
    //############################//
    public function dataGroups()
    {
        $tableName = 'data_groups';
        $dataGroupsModel = new DataGroupsModel();
    
        // Set data to pass in view
        $data = [
            'data_groups' => $dataGroupsModel->orderBy('data_group_for', 'ASC')->findAll(),
            'total_data_groups' => getTotalRecords($tableName)
        ];
    
        return view('back-end/cms/data-groups/index', $data);
    }
    
    public function newDataGroup()
    {
        return view('back-end/cms/data-groups/new-data-group');
    }
    
    public function addDataGroup()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the DataGroupsModel
        $dataGroupsModel = new DataGroupsModel();
    
        // Validation rules from the model
        $validationRules = $dataGroupsModel->getValidationRules();
    
        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/cms/data-groups/new-data-group');
        }
    
        // If validation passes, create the code
        $dataGroupData = [
            'data_group_for' => $this->request->getPost('data_group_for'),
            'data_group_list' => $this->request->getPost('data_group_list'),
            'deletable' => 1,
            'created_by' => $loggedInUserId,
            'updated_by' => ""
        ];
    
        // Call createDataGroup method from the DataGroupModel
        if ($dataGroupsModel->createDataGroup($dataGroupData)) {
            //inserted user_id
            $insertedId = $dataGroupsModel ->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Data Group', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::DATA_GROUP_CREATION, 'Data group created with id: ' . $insertedId);
    
            return redirect()->to('/account/cms/data-groups');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_DATA_GROUP_CREATION, 'Failed to create data group with data_group_for: ' .$this->request->getPost('data_groups'));
    
            return view('back-end/cms/data-groups/new-data-group');
        }
    }
    
    public function editDataGroup($dataGroupId)
    {
        $dataGroupsModel = new DataGroupsModel();
    
        // Fetch the data based on the id
        $dataGroup = $dataGroupsModel->where('data_group_id', $dataGroupId)->first();
    
        if (!$dataGroup) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/cms/data-groups');
        }
    
        // Set data to pass in view
        $data = [
            'data_group_data' => $dataGroup
        ];
    
        return view('back-end/cms/data-groups/edit-data-group', $data);
    }
    
    public function updateDataGroup()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $dataGroupsModel = new DataGroupsModel();
    
        // Custom validation rules
        $rules = [
            'data_group_id' => 'required',
            'data_group_for' => 'required',
            'data_group_list' => 'required',
        ];
    
        $codeId = $this->request->getPost('data_group_id');
        $data['data_group_data'] = $dataGroupsModel->where('data_group_id', $dataGroupId)->first();
    
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('data_groups');
            $data = [
                'data_group_for' => $this->request->getPost('data_group_for'),
                'data_group_list'  => $this->request->getPost('data_group_list'),
                'deletable' => $this->request->getPost('deletable') ?? 1,
            ];
    
            $builder->where('data_group_id', $dataGroupId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'Data Group', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::DATA_GROUP_UPDATE, 'Data group updated with id: ' . $codeId);
    
            return redirect()->to('/account/cms/data-groups');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_DATA_GROUP_UPDATE, 'Failed to update data group with id: ' . $dataGroupId);
    
            return view('back-end/admin/cms/edit-data-group', $data);
        }
    }
}
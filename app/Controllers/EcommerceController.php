<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductsModel;
use App\Models\ProductCategoriesModel;
use App\Constants\ActivityTypes;

class EcommerceController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        return view('back-end/ecommerce/index');
    }

    //############################//
    //          Products          //
    //############################//
    public function products()
    {
        $tableName = 'products';
        $productsModel = new ProductsModel();

        // Set data to pass in view
        $data = [
            'products' => $productsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_products' => getTotalRecords($tableName)
        ];

        return view('back-end/ecommerce/products/index', $data);
    }

    public function newProduct()
    {
        return view('back-end/ecommerce/products/new-product');
    }

    public function addProduct()
    {
        $loggedInUserId = $this->session->get('user_id');
        $productsModel = new ProductsModel();

        if (!$this->validate($productsModel->getValidationRules())) {
            return view('back-end/ecommerce/products/new-product', ['validation' => $this->validator]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'short_description' => $this->request->getPost('short_description'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'category' => $this->request->getPost('category'),
            'sub_category' => $this->request->getPost('sub_category'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'price' => $this->request->getPost('price'),
            'sale_price' => $this->request->getPost('sale_price'),
            'currency' => $this->request->getPost('currency'),
            'price_note' => $this->request->getPost('price_note'),
            'featured_image' => $this->request->getPost('featured_image'),
            'product_image_1' => $this->request->getPost('product_image_1'),
            'product_image_2' => $this->request->getPost('product_image_2'),
            'product_image_3' => $this->request->getPost('product_image_3'),
            'product_image_4' => $this->request->getPost('product_image_4'),
            'product_video' => $this->request->getPost('product_video'),
            'is_featured' => $this->request->getPost('is_featured'),
            'specifications' => $this->request->getPost('specifications'),
            'attributes' => $this->request->getPost('attributes'),
            'seller_info' => $this->request->getPost('seller_info'),
            'purchase_options' => $this->request->getPost('purchase_options'),
            'tags' => $this->request->getPost('tags'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'order' => $this->request->getPost('order'),
            'meta_title' => !empty($this->request->getPost('meta_title')) ? $this->request->getPost('meta_title') : $this->request->getPost('title'),
            'meta_description' => !empty($this->request->getPost('meta_description')) ? $this->request->getPost('meta_description') : $this->request->getPost('description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        if ($productsModel->createProduct($data)) {
            $insertedId = $productsModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
             //log activity
            logActivity($loggedInUserId, ActivityTypes::PRODUCT_CREATION, 'Product created with id: ' . $insertedId);

            return redirect()->to('/account/ecommerce/products');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRODUCT_CREATION, 'Failed to create Product with title: ' . $this->request->getPost('title'));

            return view('back-end/ecommerce/products/new-product');
        }
    }

    public function editProduct($productId)
    {
        $tableName = 'products';
        //Check if record exists
        if (!recordExists($tableName, "product_id", $productId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/ecommerce/products');
        }

        $productsModel = new ProductsModel();

        // Fetch the data based on the id
        $product = $productsModel->where('product_id', $productId)->first();

        // Set data to pass in view
        $data = [
            'product_data' => $product
        ];

        return view('back-end/ecommerce/products/edit-product', $data);
    }

    public function updateProduct()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $productsModel = new ProductsModel();
        $productId = $this->request->getPost('product_id');

        if (!$this->validate($productsModel->getValidationRules())) {
            return view('back-end/ecommerce/products/edit-product', ['validation' => $this->validator, 'product_data' => $productsModel->find($productId)]);
        }

        // Prepare data for update
        $data = [
            'title' => $this->request->getPost('title'),
            'short_description' => $this->request->getPost('short_description'),
            'description' => $this->request->getPost('description'),
            'slug' => $this->request->getPost('slug'),
            'category' => $this->request->getPost('category'),
            'sub_category' => $this->request->getPost('sub_category'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'price' => $this->request->getPost('price'),
            'sale_price' => $this->request->getPost('sale_price'),
            'currency' => $this->request->getPost('currency'),
            'price_note' => $this->request->getPost('price_note'),
            'featured_image' => $this->request->getPost('featured_image'),
            'product_image_1' => $this->request->getPost('product_image_1'),
            'product_image_2' => $this->request->getPost('product_image_2'),
            'product_image_3' => $this->request->getPost('product_image_3'),
            'product_image_4' => $this->request->getPost('product_image_4'),
            'product_video' => $this->request->getPost('product_video'),
            'is_featured' => $this->request->getPost('is_featured'),
            'specifications' => $this->request->getPost('specifications'),
            'attributes' => $this->request->getPost('attributes'),
            'seller_info' => $this->request->getPost('seller_info'),
            'purchase_options' => $this->request->getPost('purchase_options'),
            'tags' => $this->request->getPost('tags'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'order' => $this->request->getPost('order'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($productsModel->updateProduct($productId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PRODUCT_UPDATE, 'Product updated with id: ' . $productId);
            return redirect()->to('/account/ecommerce/products');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRODUCT_UPDATE, 'Failed to update Product with id: ' . $productId);
            return redirect()->to('/account/ecommerce/edit-product/' . $productId);
        }
    }

    public function viewProduct($productId)
    {
        $productsModel = new ProductsModel();

        // Fetch the data based on the id
        $product = $productsModel->where('product_id', $productId)->first();

        // Set data to pass in view
        $data = [
            'product_data' => $product
        ];

        return view('back-end/ecommerce/products/view-product', $data);
    }


    //############################//
    //     Product Categories     //
    //############################//
    public function productCategories()
    {
        $tableName = 'product_categories';
        $productCategoriesModel = new ProductCategoriesModel();

        // Set data to pass in view
        $data = [
            'product_categories' => $productCategoriesModel->orderBy('title', 'ASC')->findAll(),
            'total_categories' => getTotalRecords($tableName)
        ];

        return view('back-end/ecommerce/product-categories/index', $data);
    }
    
    public function newProductCategory()
    {
        return view('back-end/ecommerce/product-categories/new-product-category');
    }

    public function addProductCategory()
    {
        $loggedInUserId = $this->session->get('user_id');
        $productCategoriesModel = new ProductCategoriesModel();

        if (!$this->validate($productCategoriesModel->getValidationRules())) {
            return view('back-end/ecommerce/product-categories/new-product-category', ['validation' => $this->validator]);
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

        if ($productCategoriesModel->createProductCategory($data)) {
            $insertedId = $productCategoriesModel->getInsertID();
            session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PRODUCT_CATEGORY_CREATION, 'Product category created with id: ' . $insertedId);
            return redirect()->to('/account/ecommerce/product-categories');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRODUCT_CATEGORY_CREATION, 'Failed to create product category with title: ' . $data['title']);
            return view('back-end/ecommerce/product-categories/new-product-category');
        }
    }

    public function editProductCategory($productCategoryId)
    {
        $tableName = 'product_categories';
        //Check if record exists
        if (!recordExists($tableName, "category_id", $productCategoryId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/ecommerce/product-categories');
        }

        $productCategoriesModel = new ProductCategoriesModel();
        $data = ['product_category_data' => $productCategoriesModel->find($productCategoryId)];
        return view('back-end/ecommerce/product-categories/edit-product-category', $data);
    }

    public function updateProductCategory()
    {
        $loggedInUserId = $this->session->get('user_id');
        $productCategoriesModel = new ProductCategoriesModel();
        $productCategoryId = $this->request->getPost('category_id');

        if (!$this->validate($productCategoriesModel->getValidationRules())) {
            return view('back-end/ecommerce/product-categories/edit-product-category', ['validation' => $this->validator, 'category_data' => $productCategoriesModel->find($productCategoryId)]);
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

        if ($productCategoriesModel->updateProductCategory($productCategoryId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PRODUCT_CATEGORY_UPDATE, 'Product category updated with id: ' . $productCategoryId);
            return redirect()->to('/account/ecommerce/product-categories');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PRODUCT_CATEGORY_UPDATE, 'Failed to update product category with id: ' . $productCategoryId);
            return redirect()->to('/account/ecommerce/edit-product-category/' . $productCategoryId);
        }
    }
}

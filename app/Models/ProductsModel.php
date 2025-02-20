<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ProductsModel class
 *
 * Represents the model for the projects table in the database.
 */
class ProductsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_id',
        'title',
        'description',
        'short_description',
        'slug',
        'category', // set to: getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64")
        'sub_category', // set to: getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf")
        'brand',
        'model',
        'price',
        'sale_price',
        'currency',
        'price_note', // e.g., "starting from", "per piece", "per sq ft"
        'featured_image',
        'product_image_1',
        'product_image_2',
        'product_image_3',
        'product_image_4',
        'product_video',
        'is_featured',
        'specifications', // JSON array of key specifications
        /* Example specifications structure:
        {
            "size": "XL",
            "color": "Blue",
            "material": "Cotton",
            "weight": "300g",
            "dimensions": "10x20x30 cm"
        }
        */
        'attributes',     // JSON array of additional attributes
        /* Example attributes structure:
        {
            "features": ["Waterproof", "Dustproof"],
            "included_items": ["Manual", "Warranty Card"],
            "warranty": "1 Year Limited",
            "certifications": ["CE", "ISO 9001"]
        }
        */
        'seller_info',    // JSON object of seller details
        /* Example seller_info structure:
        {
            "name": "Store Name",
            "contact_person": "John Doe",
            "phone": "+1234567890",
            "email": "contact@store.com",
            "location": "City, Country"
        }
        */
        'purchase_options', // JSON array of purchase links/options
        /* Example purchase_options structure:
        [
            {
                "platform": "Amazon",
                "url": "https://amazon.com/product",
                "price": "299.99",
                "availability": "In Stock"
            },
            {
                "platform": "Official Store",
                "url": "https://store.com/product",
                "price": "285.99",
                "availability": "2-3 days"
            }
        ]
        */
        'tags',
        'status',// 1 = active, 0 = inactive/out of stock
        'order',
        'total_views',
        'created_by',
        'updated_by',
        'meta_title', 
        'meta_description', 
        'meta_keywords'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'description' => 'Description is required. Max of 1000 characters',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createProduct($param = array())
    {
        $productId = getGUID();
        $data = [
            'product_id' => $productId,
            'title' => $param['title'],
            'description' => $param['description'],
            'short_description' => $param['short_description'],
            'slug' => $param['slug'],
            'category' => $param['category'],
            'sub_category' => $param['sub_category'],
            'brand' => $param['brand'],
            'model' => $param['model'],
            'price' => $param['price'],
            'sale_price' => $param['sale_price'],
            'currency' => $param['currency'],
            'price_note' => $param['price_note'],
            'featured_image' => $param['featured_image'],
            'product_image_1' => $param['product_image_1'],
            'product_image_2' => $param['product_image_2'],
            'product_image_3' => $param['product_image_3'],
            'product_image_4' => $param['product_image_4'],
            'product_video' => $param['product_video'],
            'is_featured' => $param['is_featured'],
            'specifications' => $param['specifications'],
            'attributes' => $param['attributes'],
            'seller_info' => $param['seller_info'],
            'purchase_options' => $param['purchase_options'],
            'tags' => $param['tags'],
            'status' => $param['status'],
            'order' => $param['order'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords']
        ];
        $this->save($data);

        return true;
    }

    public function updateProduct($productId, $param = [])
    {
        // Check if record exists
        $existingProduct = $this->find($productId);
        if (!$existingProduct) {
            return false; // not found
        }

        // Update the fields
        $existingProduct['title'] = $param['title'];
        $existingProduct['description'] = $param['description'];
        $existingProduct['short_description'] = $param['short_description'];
        $existingProduct['slug'] = $param['slug'];
        $existingProduct['category'] = $param['category'];
        $existingProduct['sub_category'] = $param['sub_category'];
        $existingProduct['brand'] = $param['brand'];
        $existingProduct['model'] = $param['model'];
        $existingProduct['price'] = $param['price'];
        $existingProduct['sale_price'] = $param['sale_price'];
        $existingProduct['currency'] = $param['currency'];
        $existingProduct['price_note'] = $param['price_note'];
        $existingProduct['featured_image'] = $param['featured_image'];
        $existingProduct['product_image_1'] = $param['product_image_1'];
        $existingProduct['product_image_2'] = $param['product_image_2'];
        $existingProduct['product_image_3'] = $param['product_image_3'];
        $existingProduct['product_image_4'] = $param['product_image_4'];
        $existingProduct['product_video'] = $param['product_video'];
        $existingProduct['is_featured'] = $param['is_featured'];
        $existingProduct['specifications'] = $param['specifications'];
        $existingProduct['attributes'] = $param['attributes'];
        $existingProduct['seller_info'] = $param['seller_info'];
        $existingProduct['purchase_options'] = $param['purchase_options'];
        $existingProduct['tags'] = $param['tags'];
        $existingProduct['status'] = $param['status'];
        $existingProduct['order'] = $param['order'];
        $existingProduct['created_by'] = $param['created_by'];
        $existingProduct['updated_by'] = $param['updated_by'];
        $existingProduct['meta_title'] = $param['meta_title'];
        $existingProduct['meta_description'] = $param['meta_description'];
        $existingProduct['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingProduct);

        return true;
    }
}
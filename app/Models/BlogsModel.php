<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * BlogsModel class
 * 
 * Represents the model for the blogs table in the database.
 */
class BlogsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'blogs';
    protected $primaryKey       = 'blog_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'blog_id',
        'title',
        'slug',
        'featured_image',
        'excerpt',
        'content',
        'category', 
        'tags', 
        'is_featured',
        'status',
        'total_views',
        'meta_title', 
        'meta_description', 
        'meta_keywords',
        'created_by', 
        'updated_by'
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
        'slug' => 'required|max_length[255]',
        'content' => 'required',
        'category' => 'required|max_length[50]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'slug' => 'Slug is required',
        'content' => 'Content is required',
        'category' => 'Category is required',
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

    public function createBlog($param = array())
    {
        $blogId = getGUID();
        $data = [
            'blog_id' => $blogId,
            'title' => $param['title'],
            'slug' => $param['slug'],
            'featured_image' => $param['featured_image'],
            'excerpt' => $param['excerpt'],
            'content' => $param['content'],
            'category' => $param['category'],
            'tags' => $param['tags'],
            'is_featured' => $param['is_featured'],
            'status' => $param['status'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateBlog($blogId, $param = [])
    {
        // Check if record exists
        $existingBlog = $this->find($blogId);
        if (!$existingBlog) {
            return false; // not found
        }

        // Update the fields
        $existingBlog['title'] = $param['title'];
        $existingBlog['slug'] = $param['slug'];
        $existingBlog['featured_image'] = $param['featured_image'];
        $existingBlog['excerpt'] = $param['excerpt'];
        $existingBlog['content'] = $param['content'];
        $existingBlog['created_by'] = $param['created_by'];
        $existingBlog['updated_by'] = $param['updated_by'];
        $existingBlog['category'] = $param['category'];
        $existingBlog['tags'] = $param['tags'];
        $existingBlog['is_featured'] = $param['is_featured'];
        $existingBlog['status'] = $param['status'];
        $existingBlog['meta_title'] = $param['meta_title'];
        $existingBlog['meta_description'] = $param['meta_description'];
        $existingBlog['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingBlog);

        return true;
    }
}

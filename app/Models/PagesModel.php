<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PagesModel class
 *
 * Represents the model for the pages table in the database.
 */
class PagesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'pages';
    protected $primaryKey       = 'page_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'page_id',
        'title',
        'slug',
        'content',
        'group',
        'status',
        'total_views',
        'created_by',
        'updated_by',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_at',
        'updated_at',
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
        'slug' => 'required|max_length[255]|is_unique[blogs.slug]',
        'content' => 'required',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'slug' => 'Slug is required',
        'content' => 'Content is required',
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

    public function createPage($param = array())
    {
        $pageId = getGUID();
        $data = [
            'page_id' => $pageId,
            'title' => $param['title'],
            'slug' => $param['slug'],
            'content' => $param['content'],
            'group' => $param['group'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords']
        ];
        $this->save($data);

        return true;
    }

    public function updatePage($pageId, $param = [])
    {
        // Check if record exists
        $existingPage = $this->find($pageId);
        if (!$existingPage) {
            return false; // not found
        }

        // Update the fields
        $existingPage['title'] = $param['title'];
        $existingPage['slug'] = $param['slug'];
        $existingPage['content'] = $param['content'];
        $existingPage['group'] = $param['group'];
        $existingPage['status'] = $param['status'];
        $existingPage['created_by'] = $param['created_by'];
        $existingPage['updated_by'] = $param['updated_by'];
        $existingPage['meta_title'] = $param['meta_title'];
        $existingPage['meta_description'] = $param['meta_description'];
        $existingPage['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingPage);

        return true;
    }
}

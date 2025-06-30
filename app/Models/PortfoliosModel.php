<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PortfoliosModel class
 *
 * Represents the model for the portfolios table in the database.
 */
class PortfoliosModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'portfolios';
    protected $primaryKey       = 'portfolio_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'portfolio_id',
        'title',
        'description',
        'slug',
        'category',
        'category_filter',
        'group',
        'client',
        'project_date',
        'project_url',
        'featured_image',
        'details_image_1',
        'details_image_2',
        'details_image_3',
        'details_image_4',
        'content',
        'status',
        'total_views',
        'meta_title', 
        'meta_description', 
        'meta_keywords',
        'created_by',
        'updated_by',
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

    public function createPortfolio($param = array())
    {
        $portfolioId = getGUID();
        $data = [
            'portfolio_id' => $portfolioId,
            'title' => $param['title'],
            'description' => $param['description'],
            'slug' => $param['slug'],
            'category' => $param['category'],
            'category_filter' => $param['category_filter'],
            'group' => $param['group'],
            'client' => $param['client'],
            'project_date' => $param['project_date'],
            'project_url' => $param['project_url'],
            'featured_image' => $param['featured_image'],
            'details_image_1' => $param['details_image_1'],
            'details_image_2' => $param['details_image_2'],
            'details_image_3' => $param['details_image_3'],
            'details_image_4' => $param['details_image_4'],
            'content' => $param['content'],
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

    public function updatePortfolio($portfolioId, $param = [])
    {
        // Check if record exists
        $existingPortfolio = $this->find($portfolioId);
        if (!$existingPortfolio) {
            return false; // not found
        }

        // Update the fields
        $existingPortfolio['title'] = $param['title'];
        $existingPortfolio['description'] = $param['description'];
        $existingPortfolio['slug'] = $param['slug'];
        $existingPortfolio['category'] = $param['category'];
        $existingPortfolio['category_filter'] = $param['category_filter'];
        $existingPortfolio['group'] = $param['group'];
        $existingPortfolio['client'] = $param['client'];
        $existingPortfolio['project_date'] = $param['project_date'];
        $existingPortfolio['project_url'] = $param['project_url'];
        $existingPortfolio['featured_image'] = $param['featured_image'];
        $existingPortfolio['details_image_1'] = $param['details_image_1'];
        $existingPortfolio['details_image_2'] = $param['details_image_2'];
        $existingPortfolio['details_image_3'] = $param['details_image_3'];
        $existingPortfolio['details_image_4'] = $param['details_image_4'];
        $existingPortfolio['content'] = $param['content'];
        $existingPortfolio['status'] = $param['status'];
        $existingPortfolio['created_by'] = $param['created_by'];
        $existingPortfolio['updated_by'] = $param['updated_by'];
        $existingPortfolio['meta_title'] = $param['meta_title'];
        $existingPortfolio['meta_description'] = $param['meta_description'];
        $existingPortfolio['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingPortfolio);

        return true;
    }
}
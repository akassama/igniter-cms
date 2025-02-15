<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * CategoriesModel class
 * 
 * Represents the model for the categories table in the database.
 */
class CategoriesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'category_id', 
        'title', 
        'description',
        'group',
        'parent',
        'link',
        'new_tab',
        'order',
        'status',
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
        'title' => 'required|max_length[255]|min_length[2]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
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

    public function createCategory($param = array())
    {
        $categoryId = getGUID();
        $data = [
            'category_id' => $categoryId,
            'title' => $param['title'],
            'description' => $param['description'],
            'group' => $param['group'],
            'parent' => $param['parent'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'order' => $param['order'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateCategory($categoryId, $param = [])
    {
        // Check if record exists
        $existingCategory = $this->find($categoryId);
        if (!$existingCategory) {
            return false; // not found
        }
    
        // Update the fields
        $existingCategory['title'] = $param['title'];
        $existingCategory['description'] = $param['description'];
        $existingCategory['group'] = $param['group'];
        $existingCategory['parent'] = $param['parent'];
        $existingCategory['link'] = $param['link'];
        $existingCategory['new_tab'] = $param['new_tab'];
        $existingCategory['order'] = $param['order'];
        $existingCategory['status'] = $param['status'];
        $existingCategory['created_by'] = $param['created_by'];
        $existingCategory['updated_by'] = $param['updated_by'];
    
        // Save the updated data
        $this->save($existingCategory);
    
        return true;
    }    
}

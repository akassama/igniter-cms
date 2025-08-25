<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * NavigationsModel class
 * 
 * Represents the model for the navigations table in the database.
 */
class NavigationsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'navigations';
    protected $primaryKey       = 'navigation_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'navigation_id', 
        'title', 
        'description',
        'icon',
        'group',
        'order',
        'parent', 
        'link', 
        'new_tab',
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
        'link' => 'required|max_length[255]|min_length[1]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'link' => 'Link is required',
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

    public function createNavigation($param = array())
    {
        $navigationId = getGUID();
        $data = [
            'navigation_id' => $navigationId,
            'title' => $param['title'],
            'description' => $param['description'],
            'icon' => $param['icon'],
            'group' => $param['group'],
            'order' => $param['order'],
            'parent' => $param['parent'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateNavigation($navigationId, $param = [])
    {
        // Check if record exists
        $existingNavigation = $this->find($navigationId);
        if (!$existingNavigation) {
            return false; // not found
        }
    
        // Update the fields
        $existingNavigation['title'] = $param['title'];
        $existingNavigation['description'] = $param['description'];
        $existingNavigation['icon'] = $param['icon'];
        $existingNavigation['group'] = $param['group'];
        $existingNavigation['order'] = $param['order'];
        $existingNavigation['parent'] = $param['parent'];
        $existingNavigation['link'] = $param['link'];
        $existingNavigation['new_tab'] = $param['new_tab'];
        $existingNavigation['status'] = $param['status'];
        $existingNavigation['created_by'] = $param['created_by'];
        $existingNavigation['updated_by'] = $param['updated_by'];
    
        // Save the updated data
        $this->save($existingNavigation);
    
        return true;
    }    
}

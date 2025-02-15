<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppModuleModel class
 * 
 * Represents the model for the app_modules table in the database.
 */
class AppModulesModel extends Model
{
    protected $table            = 'app_modules';
    protected $primaryKey       = 'app_module_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'app_module_id', 
        'module_name', 
        'module_description',
        'module_search_terms',
        'module_roles',
        'module_link'
    ];
    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    /**
     * SearchController class
     * 
     * Handles search requests for app modules
     */
    public function searchModules($searchTerm, $userRole)
    {
        return $this->select('module_name, module_description, module_search_terms, module_link')
            ->groupStart()
                ->like('module_name', $searchTerm)
                ->orLike('module_description', $searchTerm)
                ->orLike('module_search_terms', $searchTerm)
            ->groupEnd()
            ->where("FIND_IN_SET('$userRole', module_roles) >", 0)
            ->get()
            ->getResultArray();
    }
}

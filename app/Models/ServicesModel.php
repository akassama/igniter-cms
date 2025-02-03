<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ServicesModel class
 * 
 * Represents the model for the services table in the database.
 */
class ServicesModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'service_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'service_id', 
        'title', 
        'description', 
        'image', 
        'icon', 
        'link', 
        'new_tab',
        'order',
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
    
    public function createService($param = array())
    {
        $serviceId = getGUID();
        $data = [
            'service_id' => $serviceId,
            'title' => $param['title'],
            'description' => $param['description'],
            'image' => $param['image'],
            'icon' => $param['icon'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'order' => $param['order'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateService($serviceId, $param = [])
    {
        // Check if record exists
        $existingService = $this->find($serviceId);
        if (!$existingService) {
            return false; // not found
        }

        // Update the fields
        $existingService['title'] = $param['title'];
        $existingService['description'] = $param['description'];
        $existingService['image'] = $param['image'];
        $existingService['icon'] = $param['icon'];
        $existingService['link'] = $param['link'];
        $existingService['new_tab'] = $param['new_tab'];
        $existingService['order'] = $param['order'];
        $existingService['created_by'] = $param['created_by'];
        $existingService['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingService);

        return true;
    }
}

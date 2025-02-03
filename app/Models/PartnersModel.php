<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PartnersModel class
 * 
 * Represents the model for the partners table in the database.
 */
class PartnersModel extends Model
{
    protected $table            = 'partners';
    protected $primaryKey       = 'partner_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'partner_id', 
        'title', 
        'logo',  
        'link', 
        'new_tab',
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

    public function createPartner($param = array())
    {
        $partnerId = getGUID();
        $data = [
            'partner_id' => $partnerId,
            'title' => $param['title'],
            'logo' => $param['logo'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updatePartner($partnerId, $param = [])
    {
        // Check if record exists
        $existingPartner = $this->find($partnerId);
        if (!$existingPartner) {
            return false; // not found
        }

        // Update the fields
        $existingPartner['title'] = $param['title'];
        $existingPartner['logo'] = $param['logo'];
        $existingPartner['link'] = $param['link'];
        $existingPartner['new_tab'] = $param['new_tab'];
        $existingPartner['created_by'] = $param['created_by'];
        $existingPartner['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingPartner);

        return true;
    }
}

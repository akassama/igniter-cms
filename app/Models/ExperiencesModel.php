<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ExperiencesModel class
 * 
 * Represents the model for the experiences table in the database.
 */
class ExperiencesModel extends Model
{
    protected $table            = 'experiences';
    protected $primaryKey       = 'experience_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'experience_id',
        'group',
        'company_name',
        'position',
        'start_date',
        'end_date',
        'current_job',
        'location',
        'description',
        'achievements',
        'company_logo',
        'company_url',
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
        'company_name' => 'required|max_length[250]',
        'position' => 'required',
        'start_date' => 'required',
    ];
    protected $validationMessages   = [
        'company_name' => 'Company name is required',
        'position' => 'Position is required',
        'start_date' => 'Start date is required',
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
    
    public function createExperience($param = array())
    {
        $experienceId = getGUID(); // Assuming getGUID() generates a unique ID
        $data = [
            'experience_id' => $experienceId,       
            'group' => $param['group'] ?? null,
            'company_name' => $param['company_name'] ?? '',
            'position' => $param['position'] ?? '',
            'start_date' => $param['start_date'] ?? null,
            'end_date' => $param['end_date'] ?? null,
            'current_job' => (bool)($param['current_job'] ?? false), // Cast to boolean
            'location' => $param['location'] ?? '',
            'description' => $param['description'] ?? '',
            'achievements' => $param['achievements'] ?? '',
            'company_logo' => $param['company_logo'] ?? '',
            'company_url' => $param['company_url'] ?? '',
            'order' => (int)($param['order'] ?? 0), // Cast to integer
            'status' => $param['status'] ?? 'active', 
            'created_by' => $param['created_by'] ?? '',
            'updated_by' => $param['created_by'] ?? '', 
        ];
        $this->save($data);
    
        return true;
    }
    
    public function updateExperience($experienceId, $param = [])
    {
        // Check if record exists
        $existingExperience = $this->find($experienceId);
        if (!$existingExperience) {
            return false; // not found
        }
    
        // Update the fields
        $existingExperience['group'] = $param['group'] ?? $existingExperience['group'];
        $existingExperience['company_name'] = $param['company_name'] ?? $existingExperience['company_name'];
        $existingExperience['position'] = $param['position'] ?? $existingExperience['position'];
        $existingExperience['start_date'] = $param['start_date'] ?? $existingExperience['start_date'];
        $existingExperience['end_date'] = $param['end_date'] ?? $existingExperience['end_date'];
        $existingExperience['current_job'] = (bool)($param['current_job'] ?? $existingExperience['current_job']); 
        $existingExperience['location'] = $param['location'] ?? $existingExperience['location'];
        $existingExperience['description'] = $param['description'] ?? $existingExperience['description'];
        $existingExperience['achievements'] = $param['achievements'] ?? $existingExperience['achievements'];
        $existingExperience['company_logo'] = $param['company_logo'] ?? $existingExperience['company_logo'];
        $existingExperience['company_url'] = $param['company_url'] ?? $existingExperience['company_url'];
        $existingExperience['order'] = (int)($param['order'] ?? $existingExperience['order']);
        $existingExperience['status'] = $param['status'] ?? $existingExperience['status'];
        $existingExperience['updated_by'] = $param['updated_by'] ?? ''; 
    
        // Save the updated data
        $this->save($existingExperience);
    
        return true;
    }
}

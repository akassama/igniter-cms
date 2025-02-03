<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * EducationsModel class
 * 
 * Represents the model for the education table in the database.
 */
class EducationsModel extends Model
{
    protected $table            = 'educations';
    protected $primaryKey       = 'education_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'education_id',
        'group',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
        'activities',
        'description',
        'institution_logo',
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
        'institution' => 'required|max_length[250]',
        'degree' => 'required',
        'start_date' => 'required',
    ];
    protected $validationMessages   = [
        'institution' => 'Institution is required',
        'degree' => 'Degree is required',
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

    
    public function createEducation($param = array())
    {
        $educationId = getGUID(); 
        $data = [
            'education_id' => $educationId,
            'group' => $param['group'] ?? null,
            'institution' => $param['institution'] ?? null,
            'degree' => $param['degree'] ?? null,
            'field_of_study' => $param['field_of_study'] ?? null,
            'start_date' => $param['start_date'] ?? null,
            'end_date' => $param['end_date'] ?? null,
            'grade' => $param['grade'] ?? null,
            'activities' => $param['activities'] ?? null,
            'description' => $param['description'] ?? null,
            'institution_logo' => $param['institution_logo'] ?? null,
            'order' => $param['order'] ?? 0, // Default order to 0
            'status' => $param['status'] ?? 'active', // Default status to 'active'
            'created_by' => $param['created_by'] ?? null,
            'updated_by' => $param['updated_by'] ?? null,
        ];

        $this->save($data);

        return true;
    }
    
    public function updateEducation($educationId, $param = [])
    {
        // Check if record exists
        $existingEducation = $this->find($educationId);
        if (!$existingEducation) {
            return false; // not found
        }
    
        // Update the fields
        $existingEducation['group'] = $param['group'] ?? $existingEducation['group'];
        $existingEducation['institution'] = $param['institution'] ?? $existingEducation['institution'];
        $existingEducation['degree'] = $param['degree'] ?? $existingEducation['degree'];
        $existingEducation['field_of_study'] = $param['field_of_study'] ?? $existingEducation['field_of_study'];
        $existingEducation['start_date'] = $param['start_date'] ?? $existingEducation['start_date'];
        $existingEducation['end_date'] = $param['end_date'] ?? $existingEducation['end_date'];
        $existingEducation['grade'] = $param['grade'] ?? $existingEducation['grade'];
        $existingEducation['activities'] = $param['activities'] ?? $existingEducation['activities'];
        $existingEducation['description'] = $param['description'] ?? $existingEducation['description'];
        $existingEducation['institution_logo'] = $param['institution_logo'] ?? $existingEducation['institution_logo'];
        $existingEducation['order'] = isset($param['order']) ? $param['order'] : $existingEducation['order'];
        $existingEducation['status'] = $param['status'] ?? $existingEducation['status'];
        $existingEducation['updated_by'] = $param['updated_by'] ?? null; 
    
        // Save the updated data
        $this->save($existingEducation);
    
        return true;
    }
}

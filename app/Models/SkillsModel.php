<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * SkillsModel class
 * 
 * Represents the model for the skills table in the database.
 */
class SkillsModel extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'skill_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'skill_id',
        'group',
        'category',
        'name',
        'proficiency_level',
        'years_experience',
        'description',
        'icon',
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
        'category' => 'required|max_length[250]',
        'name' => 'required',
    ];
    protected $validationMessages   = [
        'category' => 'Category is required',
        'name' => 'Name is required',
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

    
    public function createSkill($param = array())
    {
        $skillId = getGUID(); // Assuming getGUID() generates a unique ID
        $data = [
            'skill_id' => $skillId,
            'group' => $param['group'] ?? '',
            'category' => $param['category'] ?? '',
            'name' => $param['name'] ?? '',
            'proficiency_level' => $param['proficiency_level'] ?? '', 
            'years_experience' => (int)($param['years_experience'] ?? 0), 
            'description' => $param['description'] ?? '',
            'icon' => $param['icon'] ?? '',
            'order' => (int)($param['order'] ?? 0), 
            'status' => $param['status'] ?? 'active', 
            'created_by' => $param['created_by'] ?? '',
            'updated_by' => $param['created_by'] ?? '', 
        ];
        $this->save($data);
    
        return true;
    }
    
    public function updateSkill($skillId, $param = [])
    {
        // Check if record exists
        $existingSkill = $this->find($skillId);
        if (!$existingSkill) {
            return false; // not found
        }
    
        // Update the fields
        $existingSkill['group'] = $param['group'] ?? $existingSkill['group'];
        $existingSkill['category'] = $param['category'] ?? $existingSkill['category'];
        $existingSkill['name'] = $param['name'] ?? $existingSkill['name'];
        $existingSkill['proficiency_level'] = $param['proficiency_level'] ?? $existingSkill['proficiency_level'];
        $existingSkill['years_experience'] = (int)($param['years_experience'] ?? $existingSkill['years_experience']); 
        $existingSkill['description'] = $param['description'] ?? $existingSkill['description'];
        $existingSkill['icon'] = $param['icon'] ?? $existingSkill['icon'];
        $existingSkill['order'] = (int)($param['order'] ?? $existingSkill['order']);
        $existingSkill['status'] = $param['status'] ?? $existingSkill['status'];
        $existingSkill['updated_by'] = $param['updated_by'] ?? ''; 
    
        // Save the updated data
        $this->save($existingSkill);
    
        return true;
    }
}

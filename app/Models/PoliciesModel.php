<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PoliciesModel class
 *
 * Represents the model for the policies table in the database.
 */
class PoliciesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'policies';
    protected $primaryKey       = 'policy_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'policy_id',
        'policy_for',
        'title',
        'content',
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
        'title' => 'required|max_length[255]',
        'policy_for' => 'required|max_length[50]',
        'content' => 'required',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'policy_for' => 'Policy is required',
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

    public function createPolicy($param = array())
    {
        $policyId = getGUID();
        $data = [
            'policy_id' => $policyId,
            'policy_for' => $param['policy_for'],
            'title' => $param['title'],
            'content' => $param['content'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updatePolicy($policyId, $param = [])
    {
        // Check if record exists
        $existingPolicy = $this->find($policyId);
        if (!$existingPolicy) {
            return false; // not found
        }

        // Update the fields
        $existingPolicy['policy_for'] = $param['policy_for'];
        $existingPolicy['title'] = $param['title'];
        $existingPolicy['content'] = $param['content'];
        $existingPolicy['created_by'] = $param['created_by'];
        $existingPolicy['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingPolicy);

        return true;
    }
}

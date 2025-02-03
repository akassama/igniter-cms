<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * CodesModel class
 *
 * Represents the model for the codes table in the database.
 */
class CodesModel extends Model
{
    protected $table            = 'codes';
    protected $primaryKey       = 'code_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'code_id', 
        'code_for', 
        'code',
        'deletable',
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
        'code_for' => 'required|is_unique[codes.code_for]',
        'code' => 'required',
    ];
    protected $validationMessages   = [
        'code_for' => 'code_for is required',
        'code' => 'code is required',
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
    
    public function createCode($param = array())
    {
        $data = [
            'code_id' => getGUID(),
            'code_for' => $param['code_for'],
            'code' => $param['code'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateCode($codeId, $param = [])
    {
        // Check if record exists
        $existingCode = $this->find($codeId);
        if (!$existingCode) {
            return false; // not found
        }

        // Update the fields
        $existingCode['code_for'] = $param['code_for'];
        $existingCode['code'] = $param['code'];
        $existingCode['deletable'] = $param['deletable'];
        $existingCode['created_by'] = $param['created_by'];
        $existingCode['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingCode);

        return true;
    }
}

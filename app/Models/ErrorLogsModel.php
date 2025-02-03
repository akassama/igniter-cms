<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppModuleModel class
 * 
 * Represents the model for the app_modules table in the database.
 */
class ErrorLogsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'errorlogs';
    protected $primaryKey       = 'error_log_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'error_log_id', 
        'user', 
        'severity', 
        'error_message'
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
     * Logs an error in the system
     * 
     * @param {Object} param - An associative array containing error details
     * @param {string} param.user - The identifier of the user who encountered the error
     * @param {string} param.severity - The severity level of the error
     * @param {string} param.error_message - The description of the error
     * @return {boolean} Returns true if the error was successfully logged
     */
    public function logError($param = array())
    {
        // Generate a unique ID (UUID)
        $errorLogId = getGUID(); // Generates a 32-character hexadecimal ID
        $data = [
            'error_log_id' => $errorLogId,
            'user' => $param['user'],
            'severity' => $param['severity'],
            'error_message' => $param['error_message']
        ];
        $this->save($data);

        return true;
    }
}

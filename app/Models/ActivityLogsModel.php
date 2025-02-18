<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ActivityLogsModel class
 * 
 * Represents the model for the activity_logs table in the database.
 */
class ActivityLogsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'activity_logs';
    protected $primaryKey       = 'activity_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'activity_id', 
        'activity_by', 
        'activity_type', 
        'activity', 
        'ip_address', 
        'country', 
        'device'
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
     * Logs an activity in the system
     * 
     * @param {Object} param - An associative array containing activity details
     * @param {string} param.activity_type - The type of activity being logged
     * @param {string} param.activity - The description of the activity
     * @param {string} param.activity_by - The identifier of the user who performed the activity
     * @return {boolean} Returns true if the activity was successfully logged
     */
    public function logActivity($param = array())
    {
        // Generate a unique ID (UUID)
        $activityId = getGUID(); // Generates a 32-character hexadecimal ID
        $data = [
            'activity_id' => $activityId,
            'activity_type' => $param['activity_type'],
            'activity' => $param['activity'],
            'activity_by' => $param['activity_by'],
            'ip_address' => $param['ip_address'],
            'country' => $param['country'],
            'device' => $param['device']
        ];
        $this->save($data);

        return true;
    }
}

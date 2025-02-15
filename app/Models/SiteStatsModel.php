<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * SiteStatsModel class
 *
 * Represents the model for the site_stats table in the database.
 */
class SiteStatsModel extends Model
{
    protected $table            = 'site_stats';
    protected $primaryKey       = 'site_stat_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_stat_id',
        'ip_address',
        'device_type',
        'browser_type',
        'page_type',
        'page_visited_id',
        'page_visited_url',
        'referrer',
        'status_code',
        'user_id',
        'session_id',
        'request_method',
        'operating_system',
        'country',
        'screen_resolution',
        'user_agent',
        'other_params'
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
    

    public function logSiteStat($param = array())
    {
        // Generate a unique ID (UUID)
        $statId = getGUID();
        $data = [
            'site_stat_id' => $statId,
            'ip_address' => $param['ip_address'],
            'device_type' => $param['device_type'],
            'browser_type' => $param['browser_type'],
            'page_type' => $param['page_type'],
            'page_visited_id' => $param['page_visited_id'],
            'page_visited_url' => $param['page_visited_url'],
            'referrer' => $param['referrer'],
            'status_code' => $param['status_code'],
            'user_id' => $param['user_id'],
            'session_id' => $param['session_id'],
            'request_method' => $param['request_method'],
            'operating_system' => $param['operating_system'],
            'country' => $param['country'],
            'screen_resolution' => $param['screen_resolution'],
            'user_agent' => $param['user_agent'],
            'other_params' => $param['other_params']
        ];
        $this->save($data);
    
        return true;
    }
    
}

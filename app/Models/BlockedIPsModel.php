<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * BlockedIPsModel class
 *
 * Represents the model for the blocked_ips table in the database.
 */
class BlockedIPsModel extends Model
{    
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }
    
    protected $table            = 'blocked_ips';
    protected $primaryKey       = 'blocked_ip_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'blocked_ip_id',
        'ip_address',
        'country',
        'block_start_time',
        'block_end_time',
        'reason',
        'notes',
        'page_visited_url',
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
        'ip_address' => 'required|is_unique[blocked_ips.ip_address]',
        'block_end_time' => 'required',
    ];
    protected $validationMessages   = [
        'ip_address' => 'ip_address is required',
        'block_end_time' => 'block_end_time is required',
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

    public function createBlockedIP($param = array())
    {
        $tableNameBlackListed  = "blocked_ips";
        $ipExistsInBlackListedIps = recordExists($tableNameBlackListed, 'ip_address', $param['ip_address']);
        if (!$ipExistsInBlackListedIps) {
            // Generate a unique ID (UUID)
            $blockedIpId = getGUID();
            $data = [
                'blocked_ip_id' => $blockedIpId,
                'ip_address' => $param['ip_address'],
                'country' => $param['country'],
                'block_start_time' => $param['block_start_time'],
                'block_end_time' => $param['block_end_time'],
                'reason' => $param['reason'],
                'notes' => $param['notes'],
                'page_visited_url' => $param['page_visited_url'],
            ];
            $this->save($data);
        }
    
        return true;
    }

    public function updateBlockedIP($blockedIpId, $param = [])
    {
        // Check if record exists
        $existingBlockedIP = $this->find($blockedIpId);
        if (!$existingBlockedIP) {
            return false; // not found
        }

        // Update the fields
        $existingBlockedIP['ip_address'] = $param['ip_address'];
        $existingBlockedIP['country'] = $param['country'];
        $existingBlockedIP['block_start_time'] = $param['block_start_time'];
        $existingBlockedIP['block_end_time'] = $param['block_end_time'];
        $existingBlockedIP['reason'] = $param['reason'];
        $existingBlockedIP['notes'] = $param['notes'];
        $existingBlockedIP['created_by'] = $param['created_by'];
        $existingBlockedIP['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingBlockedIP);

        return true;
    }
}

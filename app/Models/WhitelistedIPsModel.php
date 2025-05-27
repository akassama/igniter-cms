<?php

namespace App\Models;

use CodeIgniter\Model;

class WhitelistedIPsModel extends Model
{
    protected $table            = 'whitelisted_ips';
    protected $primaryKey       = 'whitelisted_ip_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'whitelisted_ip_id',
        'ip_address',
        'reason',
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
        'ip_address' => 'required|is_unique[whitelisted_ips.ip_address]',
    ];
    protected $validationMessages   = [
        'ip_address' => 'ip_address is required',
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

    public function createWhitelistedIP($param = array())
    {
        // Generate a unique ID (UUID)
        $whitelistedIpId = getGUID();
        $data = [
            'whitelisted_ip_id' => $whitelistedIpId,
            'ip_address' => $param['ip_address'],
            'reason' => $param['reason'],
        ];
        $this->save($data);
    
        return true;
    }
}

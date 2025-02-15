<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscribersModel extends Model
{
    protected $table            = 'subscribers';
    protected $primaryKey       = 'subscriber_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'subscriber_id',
        'name',
        'email',
        'ip_address',
        'status',
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
        'email' => 'required|valid_email|is_unique[subscribers.email]',
    ];
    protected $validationMessages   = [
        'email' => 'Email is required',
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

    public function createSubscriber($param = array())
    {
        $subscriberId = getGUID();
        $data = [
            'subscriber_id' => $subscriberId,
            'name' => $param['name'],
            'email' => $param['email'],
            'ip_address' => $param['ip_address'],
            'status' => $param['status'],
        ];
        $this->save($data);

        return true;
    }

    public function updateSubscriber($subscriberId, $param = [])
    {
        // Check if record exists
        $existingSubscriber = $this->find($subscriberId);
        if (!$existingSubscriber) {
            return false; // not found
        }

        // Update the fields
        $existingSubscriber['name'] = $param['name'];
        $existingSubscriber['ip_address'] = $param['ip_address'];
        $existingSubscriber['status'] = $param['status'];

        // Save the updated data
        $this->save($existingSubscriber);

        return true;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionFormsModel extends Model
{
    protected $table            = 'subscription_form_submissions';
    protected $primaryKey       = 'subscription_form_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'subscription_form_id',
        'site_id',
        'list_name',
        'email',
        'name',
        'first_name',
        'last_name',
        'phone',
        'source',
        'status',
        'unsubscribed_at',
        'ip_address',
        'country',
        'created_at',
        'updated_at'
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
        'email'   => 'required|valid_email',
    ];

    protected $validationMessages = [
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
        ],
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

    public function createSubscriptionSubmission($param = [])
    {
        $subscriptionId = getGUID();

        $data = [
            'subscription_form_id' => $subscriptionId,
            'site_id'              => $param['site_id']      ?? null,
            'list_name'            => $param['list_name']    ?? null,
            'email'                => $param['email']        ?? null,
            'name'                 => $param['name']         ?? null,
            'first_name'           => $param['first_name']   ?? null,
            'last_name'            => $param['last_name']    ?? null,
            'phone'                => $param['phone']        ?? null,
            'source'               => $param['source']       ?? null,
            'status'               => $param['source']       ?? 0,
            'unsubscribed_at'      => $param['unsubscribed_at'] ?? null,
            'ip_address'           => $param['ip_address'] ?? (function_exists('getIPAddress') ? getIPAddress() : ($_SERVER['REMOTE_ADDR'] ?? null)),
            'country'      => $param['country'] ?? null,
        ];

        return $this->save($data);
    }

    public function updateSubscriptionSubmission($subscriptionId, $param = [])
    {
        // Check if record exists
        $existing = $this->find($subscriptionId);
        if (!$existing) {
            return false; // not found
        }

        $existing['site_id']            = $param['site_id']            ?? $existing['site_id'];
        $existing['list_name']          = $param['list_name']          ?? $existing['list_name'];
        $existing['email']              = $param['email']              ?? $existing['email'];
        $existing['name']               = $param['name']               ?? $existing['name'];
        $existing['first_name']         = $param['first_name']         ?? $existing['first_name'];
        $existing['last_name']          = $param['last_name']          ?? $existing['last_name'];
        $existing['phone']              = $param['phone']              ?? $existing['phone'];
        $existing['source']             = $param['source']             ?? $existing['source'];
        $existing['status']         = $param['status']         ?? $existing['status'];
        $existing['unsubscribed_at']    = $param['unsubscribed_at']    ?? $existing['unsubscribed_at'];
        $existing['ip_address']         = $param['ip_address']         ?? $existing['ip_address'];
        $existing['country']         = $param['country']         ?? $existing['country'];

        // Save the updated record
        $this->save($existing);

        return true;
    }

}

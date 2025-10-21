<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactFormsModel extends Model
{
    protected $table            = 'contact_form_submissions';
    protected $primaryKey       = 'contact_form_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'contact_form_id', 'site_id', 'form_name', 'name', 'email', 'phone', 'subject', 'message',
        'company', 'website', 'ip_address', 'country', 'user_agent', 'referrer',
        'is_read', 'is_archived', 'status', 'notes', 'created_at', 'updated_at'
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
        'message' => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
        ],
        'message' => [
            'required' => 'Message is required',
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

    public function createContactFormSubmission($param = [])
    {
        $contactId = getGUID();

        $data = [
            'contact_form_id' => $contactId,
            'site_id'         => $param['site_id'] ?? null,
            'form_name'       => $param['form_name'] ?? 'contact_form',
            'name'            => $param['name'] ?? null,
            'email'           => $param['email'] ?? null,
            'phone'           => $param['phone'] ?? null,
            'subject'         => $param['subject'] ?? null,
            'message'         => $param['message'] ?? null,
            'company'         => $param['company'] ?? null,
            'website'         => $param['website'] ?? null,
            'ip_address'      => $param['ip_address'] ?? getIPAddress(),
            'country'         => $param['country'] ?? getCountry(),
            'user_agent'      => $param['user_agent'] ?? ($_SERVER['HTTP_USER_AGENT'] ?? null),
            'referrer'        => $param['referrer'] ?? ($_SERVER['HTTP_REFERER'] ?? null),
            'is_read'         => 0,
            'is_archived'     => 0,
            'status'          => $param['status'] ?? 'new',
            'notes'           => $param['notes'] ?? null,
        ];

        return $this->save($data);
    }


    public function updateContactFormSubmission($contactId, $param = [])
    {
        // Check if record exists
        $existingMessage = $this->find($contactId);
        if (!$existingMessage) {
            return false; // not found
        }

        // Update only allowed fields safely
        $existingMessage['site_id']     = $param['site_id']     ?? $existingMessage['site_id'];
        $existingMessage['form_name']   = $param['form_name']   ?? $existingMessage['form_name'];
        $existingMessage['name']        = $param['name']        ?? $existingMessage['name'];
        $existingMessage['email']       = $param['email']       ?? $existingMessage['email'];
        $existingMessage['phone']       = $param['phone']       ?? $existingMessage['phone'];
        $existingMessage['subject']     = $param['subject']     ?? $existingMessage['subject'];
        $existingMessage['message']     = $param['message']     ?? $existingMessage['message'];
        $existingMessage['company']     = $param['company']     ?? $existingMessage['company'];
        $existingMessage['website']     = $param['website']     ?? $existingMessage['website'];
        $existingMessage['ip_address']  = $param['ip_address']  ?? $existingMessage['ip_address'];
        $existingMessage['user_agent']  = $param['user_agent']  ?? $existingMessage['user_agent'];
        $existingMessage['referrer']    = $param['referrer']    ?? $existingMessage['referrer'];
        $existingMessage['is_read']     = $param['is_read']     ?? $existingMessage['is_read'];
        $existingMessage['is_archived'] = $param['is_archived'] ?? $existingMessage['is_archived'];
        $existingMessage['status']      = $param['status']      ?? $existingMessage['status'];
        $existingMessage['notes']       = $param['notes']       ?? $existingMessage['notes'];
        $existingMessage['country']     = $param['country']     ?? $existingMessage['country'];

        // Save the updated record
        $this->save($existingMessage);

        return true;
    }

}

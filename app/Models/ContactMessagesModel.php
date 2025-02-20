<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ContactMessagesModel class
 *
 * Represents the model for the contact_messages table in the database.
 */
class ContactMessagesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'contact_messages';
    protected $primaryKey       = 'contact_message_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'contact_message_id', 
        'name', 
        'email', 
        'subject', 
        'is_read', 
        'message', 
        'ip_address',
        'country', 
        'device'
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
        'name' => 'required|max_length[50]',
        'email' => 'required|valid_email',
        'subject' => 'required|max_length[50]',
        'message' => 'required|max_length[1000]',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
        'email' => 'Email is required',
        'subject' => 'Subject is required',
        'message' => 'Message is required. Max of 1000 characters',
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

    public function createContactMessage($param = array())
    {
        $contactId = getGUID();
        $data = [
            'contact_message_id' => $contactId,
            'name' => $param['name'],
            'email' => $param['email'],
            'subject' => $param['subject'],
            'ip_address' => $param['ip_address'] ?? getIPAddress(),
            'country' => $param['country'] ?? getCountry(),
            'message' => $param['message']
        ];
        $this->save($data);

        return true;
    }
}

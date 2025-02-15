<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ContactsModel class
 * 
 * Represents the model for the contacts table in the database.
 */
class ContactsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'contacts';
    protected $primaryKey       = 'contact_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'contact_id', 
        'contact_name', 
        'contact_picture', 
        'contact_document', 
        'contact_audio', 
        'contact_video', 
        'other_document', 
        'contact_email', 
        'contact_number', 
        'contact_address'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'contact_name' => 'required|max_length[50]|min_length[2]',
        'contact_picture' => 'required',
        'contact_document' => 'permit_empty',
        'contact_audio' => 'permit_empty',
        'contact_video' => 'permit_empty',
        'other_document' => 'permit_empty',
        'contact_email' => 'required|max_length[50]|min_length[3]|valid_email',
        'contact_number' => 'required|max_length[20]|min_length[6]|is_unique[contacts.contact_number]',
        'contact_address' => 'required|max_length[255]|min_length[2]',
    ];
    protected $validationMessages   = [
        'contact_name' => 'Contact name is required',
        'contact_email' => 'Contact email is required',
        'contact_number' => 'Contact number name is required',
        'contact_address' => 'Username is required',
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

    /**
     * Creates a new contact in the system
     * 
     * @param {Object} param - An associative array containing contact details
     * @param {string} param.contact_name - The name of the contact
     * @param {string} [param.contact_picture] - The picture of the contact (optional)
     * @param {string} param.contact_email - The email address of the contact
     * @param {string} param.contact_number - The phone number of the contact
     * @param {string} param.contact_address - The address of the contact
     * @return {boolean} Returns true if the contact was successfully created
     */
    public function createContact($param = array())
    {
        $contactId = getGUID();
        $data = [
            'contact_id' => $contactId,
            'contact_name' => $param['contact_name'],
            'contact_picture' => $param['contact_picture'],
            'contact_document' => $param['contact_document'],
            'contact_audio' => $param['contact_audio'],
            'contact_video' => $param['contact_video'],
            'other_document' => $param['other_document'],
            'contact_email' => $param['contact_email'],
            'contact_number' => $param['contact_number'],
            'contact_address' => $param['contact_address']
        ];
        $this->save($data);

        return true;
    }

    /**
     * Updates a contact record with the provided query parameters.
     *
     * @param {number} contactId - The ID of the contact to update.
     * @param {object} [param={}] - An object containing the updated contact information.
     * @param {string} param.contact_name - The updated contact name.
     * @param {string} param.contact_document - The updated contact document.
     * @param {string} param.contact_audio - The updated contact audio.
     * @param {string} param.contact_video - The updated contact video.
     * @param {string} param.other_document - The updated other document.
     * @param {string} param.contact_number - The updated contact number.
     * @param {string} param.contact_address - The updated contact address.
     * @param {string} param.contact_picture - The updated contact picture.
     * @param {string} param.contact_email - The updated contact email.
     *
     * @returns {boolean} - True if the update was successful, false otherwise.
     */
    public function updateContact($contactId, $param = [])
    {
        // Check if contact exists
        $existingContact = $this->find($contactId);
        if (!$existingContact) {
            return false; // Contact not found
        }

        // Update the fields
        $existingContact['contact_name'] = $param['contact_name'];
        $existingContact['contact_picture'] = $param['contact_picture'];
        $existingContact['contact_document'] = $param['contact_document'];
        $existingContact['contact_audio'] = $param['contact_audio'];
        $existingContact['contact_video'] = $param['contact_video'];
        $existingContact['other_document'] = $param['other_document'];
        $existingContact['contact_email'] = $param['contact_email'];
        $existingContact['contact_number'] = $param['contact_number'];
        $existingContact['contact_address'] = $param['contact_address'];

        // Save the updated data
        $this->save($existingContact);

        return true;
    }

    /**
     * Updates a contact record with the provided query parameters.
     *
     * @param {number} contactId - The ID of the contact to update.
     * @param {object} [param={}] - An object containing the updated contact information.
     * @param {string} param.contact_name - The updated contact name.
     * @param {string} param.contact_document - The updated contact document.
     * @param {string} param.contact_audio - The updated contact audio.
     * @param {string} param.contact_video - The updated contact video.
     * @param {string} param.other_document - The updated other document.
     * @param {string} param.contact_number - The updated contact number.
     * @param {string} param.contact_address - The updated contact address.
     * @param {string} param.contact_picture - The updated contact picture.
     * @param {string} param.contact_email - The updated contact email.
     *
     * @returns {boolean} - True if the update was successful, false otherwise.
     */
    public function updateContactWithQuery($contactId, $param = [])
    {
        // First, update all fields except contact_picture and contact_email
        $data = [
            'contact_name' => $param['contact_name'],
            'contact_document' => $param['contact_document'],
            'contact_audio' => $param['contact_audio'],
            'contact_video' => $param['contact_video'],
            'other_document' => $param['other_document'],
            'contact_number' => $param['contact_number'],
            'contact_address' => $param['contact_address']
        ];

        $this->update($contactId, $data);

        // Now, use query builder to update contact_picture and contact_email due to bug
        $this->db->table($this->table)
            ->where('contact_id', $contactId)
            ->set('contact_picture', $param['contact_picture'])
            ->set('contact_email', $param['contact_email'])
            ->update();

        return true;
    }
}

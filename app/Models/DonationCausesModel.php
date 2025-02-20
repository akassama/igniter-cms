<?php

namespace App\Models;

use CodeIgniter\Model;

class DonationCausesModel extends Model
{
    protected $table            = 'donation_causes';
    protected $primaryKey       = 'donation_cause_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'donation_cause_id',
        'title',
        'description',
        'slug',
        'image',
        'content',
        'link_title',
        'link',
        'new_tab',
        'embedded_page_title',
        'embedded_page',
        'status',
        'total_views',
        'meta_title', 
        'meta_description', 
        'meta_keywords'
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
        'title' => 'required|max_length[255]',
        'description' => 'required',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'description' => 'Description is required',
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

    public function createDonationCause($param = array())
    {
        $donationId = getGUID();
        $data = [
            'donation_cause_id' => $donationId,
            'title' => $param['title'],
            'description' => $param['description'],
            'slug' => $param['slug'],
            'image' => $param['image'],
            'content' => $param['content'],
            'link_title' => $param['link_title'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'embedded_page_title' => $param['embedded_page_title'],
            'embedded_page' => $param['embedded_page'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateDonationCause($donationId, $param = [])
    {
        // Check if record exists
        $existingDonationCause = $this->find($donationId);
        if (!$existingDonationCause) {
            return false; // not found
        }

        // Update the fields
        $existingDonationCause['title'] = $param['title'];
        $existingDonationCause['description'] = $param['description'];
        $existingDonationCause['slug'] = $param['slug'];
        $existingDonationCause['image'] = $param['image'];
        $existingDonationCause['content'] = $param['content'];
        $existingDonationCause['link_title'] = $param['link_title'];
        $existingDonationCause['link'] = $param['link'];
        $existingDonationCause['new_tab'] = $param['new_tab'];
        $existingDonationCause['embedded_page_title'] = $param['embedded_page_title'];
        $existingDonationCause['embedded_page'] = $param['embedded_page'];
        $existingDonationCause['created_by'] = $param['created_by'];
        $existingDonationCause['updated_by'] = $param['updated_by'];
        $existingDonationCause['meta_title'] = $param['meta_title'];
        $existingDonationCause['meta_description'] = $param['meta_description'];
        $existingDonationCause['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingDonationCause);

        return true;
    }
}

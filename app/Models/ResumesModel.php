<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ResumesModel class
 * 
 * Represents the model for the resumes table in the database.
 */
class ResumesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'resumes';
    protected $primaryKey       = 'resume_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
            'resume_id',
            'full_name',
            'title',
            'summary',
            'email',
            'phone',
            'address',
            'website',
            'linkedin_url',
            'github_url',
            'twitter_url',
            'image',
            'cv_file',
            'status',
            'total_views',
            'created_by',
            'updated_by',
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
        'full_name' => 'required|max_length[255]',
        'email' => 'required|valid_email|max_length[255]',
        'summary' => 'permit_empty|max_length[1000]'
    ];
    protected $validationMessages   = [
        'full_name' => 'Name is required',
        'email' => 'Email is required',
        'summary' => 'Email is required',
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

    public function createResume($param = array())
    {
        $resumeId = getGUID();
        $data = [
            'resume_id' => $resumeId,
            'full_name' => $param['full_name'],
            'title' => $param['title'],
            'summary' => $param['summary'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'address' => $param['address'],
            'website' => $param['website'],
            'linkedin_url' => $param['linkedin_url'],
            'github_url' => $param['github_url'],
            'twitter_url' => $param['twitter_url'],
            'image' => $param['image'],
            'cv_file' => $param['cv_file'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords'],
        ];
        $this->save($data);
        return true;
    }
    
    public function updateResume($resumeId, $param = [])
    {
        // Check if record exists
        $existingResume = $this->find($resumeId);
        if (!$existingResume) {
            return false; // not found
        }

        // Update the fields
        $existingResume['full_name'] = $param['full_name'];
        $existingResume['title'] = $param['title'];
        $existingResume['summary'] = $param['summary'];
        $existingResume['email'] = $param['email'];
        $existingResume['phone'] = $param['phone'];
        $existingResume['address'] = $param['address'];
        $existingResume['website'] = $param['website'];
        $existingResume['linkedin_url'] = $param['linkedin_url'];
        $existingResume['github_url'] = $param['github_url'];
        $existingResume['twitter_url'] = $param['twitter_url'];
        $existingResume['image'] = $param['image'];
        $existingResume['cv_file'] = $param['cv_file'];
        $existingResume['status'] = $param['status'];
        $existingResume['created_by'] = $param['created_by'];
        $existingResume['updated_by'] = $param['updated_by'];
        $existingResume['meta_title'] = $param['meta_title'];
        $existingResume['meta_description'] = $param['meta_description'];
        $existingResume['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingResume);

        return true;
    }
}

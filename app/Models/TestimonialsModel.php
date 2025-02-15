<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppModuleModel class
 * 
 * Represents the model for the app_modules table in the database.
 */
class TestimonialsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'testimonials';
    protected $primaryKey       = 'testimonial_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'testimonial_id',
        'name',
        'title',
        'company',
        'image',
        'testimonial',
        'rating',
        'link',
        'new_tab',
        'created_by',
        'updated_by',
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
        'title' => 'required|max_length[255]',
        'company' => 'required|max_length[50]',
        'testimonial' => 'required|max_length[500]',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
        'title' => 'Title is required',
        'company' => 'Company is required',
        'testimonial' => 'Testimonial is required. Max of 1000 characters',
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

    public function createTestimonial($param = array())
    {
        $testimonialId = getGUID();
        $data = [
            'testimonial_id' => $testimonialId,
            'name' => $param['name'],
            'title' => $param['title'],
            'company' => $param['company'],
            'image' => $param['image'],
            'testimonial' => $param['testimonial'],
            'rating' => $param['rating'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateTestimonial($testimonialId, $param = [])
    {
        // Check if record exists
        $existingTestimonial = $this->find($testimonialId);
        if (!$existingTestimonial) {
            return false; // not found
        }

        // Update the fields
        $existingTestimonial['name'] = $param['name'];
        $existingTestimonial['title'] = $param['title'];
        $existingTestimonial['company'] = $param['company'];
        $existingTestimonial['image'] = $param['image'];
        $existingTestimonial['testimonial'] = $param['testimonial'];
        $existingTestimonial['rating'] = $param['rating'];
        $existingTestimonial['link'] = $param['link'];
        $existingTestimonial['new_tab'] = $param['new_tab'];
        $existingTestimonial['created_by'] = $param['created_by'];
        $existingTestimonial['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingTestimonial);

        return true;
    }
}

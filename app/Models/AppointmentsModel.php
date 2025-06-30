<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppointmentsModel class
 *
 * Represents the model for the appointments table in the database.
 */
class AppointmentsModel extends Model
{
    protected $table            = 'appointments';
    protected $primaryKey       = 'appointment_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'appointment_id', 
        'title',
        'description',
        'image',
        'slug', 
        'appointment_type',
        'embed_url',
        'embed_script',
        'widget_height',
        'widget_min_width',
        'status',
        'total_views',
        'meta_title', 
        'meta_description', 
        'meta_keywords',
        'created_by',
        'updated_by'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title'              => 'required|min_length[3]|max_length[255]',
        'appointment_type'   => 'required|in_list[calendly,setmore,simplybook]', //TODO implement rest
        'embed_url'          => 'permit_empty|valid_url',
        'embed_script'       => 'permit_empty',
        'widget_height'      => 'permit_empty|string|max_length[20]',
        'widget_min_width'   => 'permit_empty|string|max_length[20]',
        'theme_name'         => 'permit_empty|string|max_length[50]',
        'language_code'      => 'permit_empty|string|max_length[10]',
        'custom_parameters'  => 'permit_empty|string|max_length[1000]',
        'description'        => 'permit_empty|string|max_length[1000]',
        'status'          => 'required|in_list[0,1]',
    ];
    protected $validationMessages   = [
        'title' => [
            'required'    => 'The appointment title is required.',
            'min_length'  => 'The appointment title must be at least 3 characters long.',
            'max_length'  => 'The appointment title cannot exceed 255 characters.',
            'is_unique'   => 'An appointment with this title already exists.'
        ],
        'slug' => 'required|max_length[255]',
        'appointment_type' => [
            'required'  => 'The appointment type is required.',
            'in_list'   => 'Invalid appointment type provided.'
        ],
        'embed_url' => [
            'valid_url' => 'The embed URL must be a valid URL format.'
        ],
        'status' => [
            'required' => 'The active status is required.',
            'in_list'  => 'Invalid active status. Must be 0 or 1.'
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

    public function createAppointment($param = array())
    {
        $data = [
            'appointment_id' => getGUID(),
            'title'              => $param['title'] ?? null,
            'description'        => $param['description'] ?? null,
            'image'              => $param['image'] ?? null,
            'slug'              => $param['slug'] ?? null,
            'appointment_type'   => $param['appointment_type'] ?? null,
            'embed_url'          => $param['embed_url'] ?? null,
            'embed_script'       => $param['embed_script'] ?? null,
            'widget_height'      => $param['widget_height'] ?? null,
            'widget_min_width'   => $param['widget_min_width'] ?? null,
            'status'          => $param['status'] ?? 1,
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords'],
            'created_by'         => $param['created_by'] ?? null,
            'updated_by'         => $param['updated_by'] ?? null,
        ];
        $this->save($data);

        return true;
    }

    public function updateAppointment($appointmentId, $param = [])
    {
        // Check if record exists
        $existingAppointment = $this->find($appointmentId);
        if (!$existingAppointment) {
            return false; // not found
        }

        // Update the fields
        $existingAppointment['title']             = $param['title'] ?? $existingAppointment['title'];
        $existingAppointment['description']       = $param['description'] ?? $existingAppointment['description'];
        $existingAppointment['image']             = $param['image'] ?? $existingAppointment['image'];
        $existingAppointment['slug']             = $param['slug'] ?? $existingAppointment['slug'];
        $existingAppointment['appointment_type']  = $param['appointment_type'] ?? $existingAppointment['appointment_type'];
        $existingAppointment['embed_url']         = $param['embed_url'] ?? $existingAppointment['embed_url'];
        $existingAppointment['embed_script']      = $param['embed_script'] ?? $existingAppointment['embed_script'];
        $existingAppointment['widget_height']     = $param['widget_height'] ?? $existingAppointment['widget_height'];
        $existingAppointment['widget_min_width']  = $param['widget_min_width'] ?? $existingAppointment['widget_min_width'];
        $existingAppointment['status']            = $param['status'] ?? $existingAppointment['status'];
        $existingAppointment['meta_title']        = $param['meta_title'] ?? $existingAppointment['meta_title'];
        $existingAppointment['meta_description']  = $param['meta_description'] ?? $existingAppointment['meta_description'];
        $existingAppointment['meta_keywords']     = $param['meta_keywords'] ?? $existingAppointment['meta_keywords'];
        $existingAppointment['created_by']        = $param['created_by'] ?? $existingAppointment['created_by'];
        $existingAppointment['updated_by']        = $param['updated_by'] ?? $existingAppointment['updated_by']; 

        // Save the updated data
        $this->save($existingAppointment);

        return true;
    }
}

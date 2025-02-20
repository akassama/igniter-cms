<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * EventsModel class
 *
 * Represents the model for the events table in the database.
 */
class EventsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'events';
    protected $primaryKey       = 'event_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'event_id', 
        'title', 
        'description',
        'slug',
        'image',
        'content', 
        'location', 
        'start_date',
        'start_time', 
        'end_date', 
        'end_time',
        'registration_link_label', 
        'registration_link',
        'new_tab',
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
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|max_length[255]|min_length[2]',
        'description' => 'permit_empty|max_length[255]',
        'slug' => 'required|max_length[255]',
        'content' => 'required',
        'start_date' => 'required|max_length[50]',
        'end_date' => 'required|max_length[50]',
        'location' => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'slug' => 'Slug is required',
        'content' => 'Content is required',
        'start_date' => 'Start date is required',
        'end_date' => 'End date is required',
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

    public function createEvent($param = array())
    {
        $eventId = getGUID();
        $data = [
            'event_id' => $eventId,
            'title' => $param['title'],
            'description' => $param['description'],
            'slug' => $param['slug'],
            'image' => $param['image'],
            'content' => $param['content'],
            'start_date' => $param['start_date'],
            'start_time' => $param['start_time'],
            'end_date' => $param['end_date'],
            'end_time' => $param['end_time'],
            'location' => $param['location'],
            'registration_link_label' => $param['registration_link_label'],
            'registration_link' => $param['registration_link'],
            'new_tab' => $param['new_tab'],
            'status' => $param['status'],
            'meta_title' => $param['meta_title'],
            'meta_description' => $param['meta_description'],
            'meta_keywords' => $param['meta_keywords'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateEvent($eventId, $param = [])
    {
        // Check if record exists
        $existingEvent = $this->find($eventId);
        if (!$existingEvent) {
            return false; // not found
        }

        // Update the fields
        $existingEvent['title'] = $param['title'];
        $existingEvent['description'] = $param['description'];
        $existingEvent['image'] = $param['image'];
        $existingEvent['content'] = $param['content'];
        $existingEvent['start_date'] = $param['start_date'];
        $existingEvent['start_time'] = $param['start_time'];
        $existingEvent['end_date'] = $param['end_date'];
        $existingEvent['end_time'] = $param['end_time'];
        $existingEvent['location'] = $param['location'];
        $existingEvent['registration_link_label'] = $param['registration_link_label'];
        $existingEvent['registration_link'] = $param['registration_link'];
        $existingEvent['new_tab'] = $param['new_tab'];
        $existingEvent['status'] = $param['status'];
        $existingEvent['created_by'] = $param['created_by'];
        $existingEvent['updated_by'] = $param['updated_by'];
        $existingEvent['meta_title'] = $param['meta_title'];
        $existingEvent['meta_description'] = $param['meta_description'];
        $existingEvent['meta_keywords'] = $param['meta_keywords'];

        // Save the updated data
        $this->save($existingEvent);

        return true;
    }
}

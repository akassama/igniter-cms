<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * HomePageModel class
 *
 * Represents the model for the home_page table in the database.
 */
class HomePageModel extends Model
{
    protected $table            = 'home_page';
    protected $primaryKey       = 'home_page_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'home_page_id',
        'section',
        'section_title',
        'section_description',
        'section_image',
        'section_image_2',
        'section_image_3',
        'section_image_4',
        'section_video',
        'section_audio',
        'section_file',
        'content_blocks',
        'section_link',
        'new_tab',
        'status',
        'order',
        'deletable',
        'created_by',
        'updated_by',
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
        'section' => 'required|is_unique[home_page.section]',
        'section_title' => 'required|max_length[255]',
        'status' => 'required|max_length[1]',
        'order' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [
        'section' => 'section is required',
        'section_title' => 'section_title is required',
        'status' => 'status is required',
        'order' => 'order is required',
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

    public function createHomePage($param = array())
    {
        $data = [
            'home_page_id' => getGUID(),
            'section' => $param['section'],
            'section_title' => $param['section_title'],
            'section_description' => $param['section_description'],
            'section_image' => $param['section_image'],
            'section_image_2' => $param['section_image_2'],
            'section_image_3' => $param['section_image_3'],
            'section_image_4' => $param['section_image_4'],
            'section_video' => $param['section_video'],
            'section_audio' => $param['section_audio'],
            'section_file' => $param['section_file'],
            'content_blocks' => $param['content_blocks'],
            'section_link' => $param['section_link'],
            'new_tab' => $param['new_tab'],
            'status' => $param['status'],
            'order' => $param['order'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateHomePage($homePageId, $param = [])
    {
        // Check if record exists
        $existingHomePage = $this->find($homePageId);
        if (!$existingHomePage) {
            return false; // not found
        }

        // Update the fields
        $existingHomePage['section'] = $param['section'];
        $existingHomePage['section_title'] = $param['section_title'];
        $existingHomePage['section_description'] = $param['section_description'];
        $existingHomePage['section_image'] = $param['section_image'];
        $existingHomePage['section_image_2'] = $param['section_image_2'];
        $existingHomePage['section_image_3'] = $param['section_image_3'];
        $existingHomePage['section_image_4'] = $param['section_image_4'];
        $existingHomePage['section_video'] = $param['section_video'];
        $existingHomePage['section_audio'] = $param['section_audio'];
        $existingHomePage['section_file'] = $param['section_file'];
        $existingHomePage['content_blocks'] = $param['content_blocks'];
        $existingHomePage['section_link'] = $param['section_link'];
        $existingHomePage['new_tab'] = $param['new_tab'];
        $existingHomePage['status'] = $param['status'];
        $existingHomePage['order'] = $param['order'];
        $existingHomePage['deletable'] = $param['deletable'];
        $existingHomePage['created_by'] = $param['created_by'];
        $existingHomePage['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingHomePage);

        return true;
    }
}

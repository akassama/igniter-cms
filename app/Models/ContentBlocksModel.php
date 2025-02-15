<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ContentBlocksModel class
 * 
 * Represents the model for the content_blocks table in the database.
 */
class ContentBlocksModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'content_blocks';
    protected $primaryKey       = 'content_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'content_id', 
        'identifier', 
        'author', 
        'title', 
        'description', 
        'content', 
        'icon',
        'group',
        'image', 
        'link', 
        'new_tab',
        'order', 
        'custom_field',
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
        'identifier' => 'required|max_length[25]|min_length[6]',
        'title' => 'required|max_length[255]|min_length[2]',
    ];
    protected $validationMessages   = [
        'identifier' => 'Content identifier is required',
        'title' => 'Content title is required',
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

    public function createContentBlock($param = array())
    {
        $contentId = getGUID();
        $data = [
            'content_id' => $contentId,
            'identifier' => $param['identifier'],
            'author' => $param['author'],
            'title' => $param['title'],
            'description' => $param['description'],
            'content' => $param['content'],
            'icon' => $param['icon'],
            'group' => $param['group'],
            'image' => $param['image'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'order' => $param['order'],
            'custom_field' => $param['custom_field'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateContentBlock($contentId, $param = [])
    {
        // Check if record exists
        $existingContentBlock = $this->find($contentId);
        if (!$existingContentBlock) {
            return false; // not found
        }

        // Update the fields
        $existingContentBlock['identifier'] = $param['identifier'];
        $existingContentBlock['author'] = $param['author'];
        $existingContentBlock['title'] = $param['title'];
        $existingContentBlock['description'] = $param['description'];
        $existingContentBlock['content'] = $param['content'];
        $existingContentBlock['icon'] = $param['icon'];
        $existingContentBlock['group'] = $param['group'];
        $existingContentBlock['image'] = $param['image'];
        $existingContentBlock['link'] = $param['link'];
        $existingContentBlock['new_tab'] = $param['new_tab'];
        $existingContentBlock['order'] = $param['order'];
        $existingContentBlock['custom_field'] = $param['custom_field'];
        $existingContentBlock['created_by'] = $param['created_by'];
        $existingContentBlock['updated_by'] = $param['updated_by'];


        // Save the updated data
        $this->save($existingContentBlock);

        return true;
    }
}

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
        'video',
        'file',
        'link',
        'new_tab',
        'order',
        'custom_field_1',
        'custom_field_2',
        'custom_field_3',
        'custom_field_4',
        'custom_field_5',
        'custom_field_6',
        'custom_field_7',
        'custom_field_8',
        'custom_field_9',
        'custom_field_10',
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

    public function createContentBlock($param = [])
    {
        $contentId = getGUID();
        $data = [
            'content_id'      => $contentId,
            'identifier'      => $param['identifier'] ?? '',
            'author'          => $param['author'] ?? '',
            'title'           => $param['title'] ?? '',
            'description'     => $param['description'] ?? '',
            'content'         => $param['content'] ?? '',
            'icon'            => $param['icon'] ?? '',
            'group'           => $param['group'] ?? '',
            'image'           => $param['image'] ?? '',
            'video'           => $param['video'] ?? '',
            'file'            => $param['file'] ?? '', // Fixed: was using 'image' again
            'link'            => $param['link'] ?? '',
            'new_tab'         => $param['new_tab'] ?? 0,
            'order'           => $param['order'] ?? 0,
            'custom_field_1'  => $param['custom_field_1'] ?? '',
            'custom_field_2'  => $param['custom_field_2'] ?? '',
            'custom_field_3'  => $param['custom_field_3'] ?? '',
            'custom_field_4'  => $param['custom_field_4'] ?? '',
            'custom_field_5'  => $param['custom_field_5'] ?? '',
            'custom_field_6'  => $param['custom_field_6'] ?? '',
            'custom_field_7'  => $param['custom_field_7'] ?? '',
            'custom_field_8'  => $param['custom_field_8'] ?? '',
            'custom_field_9'  => $param['custom_field_9'] ?? '',
            'custom_field_10' => $param['custom_field_10'] ?? '',
            'created_by'      => $param['created_by'] ?? null,
            'updated_by'      => $param['updated_by'] ?? null,
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
        $existingContentBlock['video'] = $param['video'];
        $existingContentBlock['file'] = $param['file'];
        $existingContentBlock['link'] = $param['link'];
        $existingContentBlock['new_tab'] = $param['new_tab'];
        $existingContentBlock['order'] = $param['order'];
        $existingContentBlock['custom_field_1'] = $param['custom_field_1'];
        $existingContentBlock['custom_field_2'] = $param['custom_field_2'];
        $existingContentBlock['custom_field_3'] = $param['custom_field_3'];
        $existingContentBlock['custom_field_4'] = $param['custom_field_4'];
        $existingContentBlock['custom_field_5'] = $param['custom_field_5'];
        $existingContentBlock['custom_field_6'] = $param['custom_field_6'];
        $existingContentBlock['custom_field_7'] = $param['custom_field_7'];
        $existingContentBlock['custom_field_8'] = $param['custom_field_8'];
        $existingContentBlock['custom_field_9'] = $param['custom_field_9'];
        $existingContentBlock['custom_field_10'] = $param['custom_field_10'];
        $existingContentBlock['created_by'] = $param['created_by'];
        $existingContentBlock['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingContentBlock);

        return true;
    }
}

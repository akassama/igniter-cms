<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * GalleryModel class
 *
 * Represents the model for the galleries table in the database.
 */
class GalleryModel extends Model
{
    protected $table            = 'galleries';
    protected $primaryKey       = 'gallery_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'gallery_id',
        'title',
        'caption',
        'category_filter',
        'group',
        'image',
        'status',
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
        'image' => 'required',
    ];
    protected $validationMessages   = [
        'image' => 'Image is required',
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

    public function createGallery($param = array())
    {
        $galletyId = getGUID();
        $data = [
            'gallery_id' => $galletyId,
            'title' => $param['title'],
            'caption' => $param['caption'],
            'category_filter' => $param['category_filter'],
            'group' => $param['group'],
            'image' => $param['image'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateGallery($galletyId, $param = [])
    {
        // Check if record exists
        $existingGallery = $this->find($galletyId);
        if (!$existingGallery) {
            return false; // not found
        }

        // Update the fields
        $existingGallery['title'] = $param['title'];
        $existingGallery['caption'] = $param['caption'];
        $existingGallery['category_filter'] = $param['category_filter'];
        $existingGallery['group'] = $param['group'];
        $existingGallery['image'] = $param['image'];
        $existingGallery['status'] = $param['status'];
        $existingGallery['created_by'] = $param['created_by'];
        $existingGallery['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingGallery);

        return true;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * SocialsModel class
 * 
 * Represents the model for the socials table in the database.
 */
class SocialsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'socials';
    protected $primaryKey       = 'social_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'social_id',
        'name',
        'icon',
        'link',
        'new_tab',
        'order',
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
        'name' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
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

    public function createSocial($param = array())
    {
        $socialId = getGUID();
        $data = [
            'social_id' => $socialId,
            'name' => $param['name'],
            'icon' => $param['icon'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'order' => $param['order'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateSocial($socialId, $param = [])
    {
        // Check if record exists
        $existingSocial = $this->find($socialId);
        if (!$existingSocial) {
            return false; // not found
        }

        // Update the fields
        $existingSocial['name'] = $param['name'];
        $existingSocial['icon'] = $param['icon'];
        $existingSocial['link'] = $param['link'];
        $existingSocial['new_tab'] = $param['new_tab'];
        $existingSocial['order'] = $param['order'];
        $existingSocial['created_by'] = $param['created_by'];
        $existingSocial['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingSocial);

        return true;
    }
}

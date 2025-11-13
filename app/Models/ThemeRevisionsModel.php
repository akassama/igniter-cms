<?php

namespace App\Models;

use CodeIgniter\Model;

class ThemeRevisionsModel extends Model
{
    protected $table            = 'theme_revisions';
    protected $primaryKey       = 'theme_revision_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'theme_revision_id', 
        'theme_name',
        'file_path',
        'file_content',
        'revision_note',
        'created_by',
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
        'theme_name' => 'required|max_length[100]',
        'file_path' => 'required|max_length[255]',
        'file_content' => 'required',
        'created_by' => 'required',
    ];
    protected $validationMessages   = [
        'theme_name' => 'theme_name is required',
        'file_path' => 'file_path is required',
        'file_content' => 'file_content is required',
        'created_by' => 'file_content is required',
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
    
    public function createThemeRevision($param = array())
    {
        $data = [
            'theme_revision_id' => getGUID(),
            'theme_name' => $param['theme_name'],
            'file_path' => $param['file_path'],
            'file_content' => $param['file_content'],
            'revision_note' => $param['revision_note'],
            'created_by' => $param['created_by'],
        ];
        $this->save($data);

        return true;
    }
}

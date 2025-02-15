<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * BackupsModel class
 * 
 * Represents the model for the backups table in the database.
 */
class BackupsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }
    
    protected $table            = 'backups';
    protected $primaryKey       = 'backup_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'backup_id',
        'backup_file_path',
        'created_by'
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
    'backup_file_path' => 'required',
    ];
    protected $validationMessages   = [
        'backup_file_path' => 'Backup file is required',
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

    public function createBackup($param = array())
    {
        $backupId = getGUID();
        $data = [
            'backup_id' => $backupId,
            'backup_file_path' => $param['backup_file_path'],
            'created_by' => $param['created_by']
        ];
        $this->save($data);

        return true;
    }
}

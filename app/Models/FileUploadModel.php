<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * FileUploadModel class
 * 
 * Represents the model for the file_uploads table in the database.
 */
class FileUploadModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'file_uploads';
    protected $primaryKey       = 'file_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'file_id', 
        'user_id', 
        'file_name', 
        'file_type', 
        'file_size', 
        'upload_path',
        'unique_identifier',
        'group',
        'deletable'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'unique_identifier' => 'is_unique[file_uploads.unique_identifier]',
        'upload_file' => [
            'uploaded[upload_file]',
            'mime_in[upload_file,application/manifest+json,application/webmanifest+json,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,text/plain,application/rtf,application/vnd.oasis.opendocument.text,image/jpeg,image/png,image/gif,audio/mpeg,audio/wav,audio/ogg,video/mp4,video/x-msvideo,video/quicktime,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,application/zip,application/xml,text/xml,text/html,audio/wav,application/json,image/vnd.microsoft.icon,video/webm,video/x-ms-wmv]',
            'max_size[upload_file,5120]', // Maximum size in kilobytes (5MB)
        ],
    ];
    protected $validationMessages = [
        'upload_file' => [
            'uploaded' => 'Please select a file to upload.',
            'mime_in' => 'Invalid file type. Please upload a .doc, .docx, .pdf, .txt, .rtf, .odt, .jpg, .jpeg, .png, .gif, .mp3, .wav, .ogg, .mp4, .avi, .mov, .xls, .xlsx, .csv, .zip, .xml, .json, .ico, .webm, .wmv, or .webmanifest file.',
            'max_size' => 'The file size exceeds the maximum limit of 5MB.',
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

    public function saveFile($param = array())
    {
        // Generate a unique ID (UUID)
        $fileId = getGUID();
        $data = [
            'file_id' => $fileId,
            'user_id' => $param['user_id'],
            'file_name' => $param['file_name'],
            'file_type' => $param['file_type'],
            'file_size' => $param['file_size'],
            'caption' => $param['caption'],
            'upload_path' => $param['upload_path'],
            'unique_identifier' => $param['unique_identifier'],
            'group' => $param['group'],
            'deletable' => $param['deletable']
        ];
        $this->save($data);

        return true;
    }

    public function getFiles()
    {
        return $this->findAll();
    }
}

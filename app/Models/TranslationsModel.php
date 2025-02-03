<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TranslationsModel class
 * 
 * Represents the model for the translations table in the database.
 */
class TranslationsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'translations';
    protected $primaryKey       = 'translation_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'translation_id',
        'language',
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
        'language' => 'required|max_length[50]|is_unique[translations.language]',
    ];
    protected $validationMessages   = [
        'language' => 'Language is required',
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

    public function createTranslation($param = array())
    {
        $translationId = getGUID();
        $data = [
            'translation_id' => $translationId,
            'language' => $param['language'],
            'created_by' => $param['created_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateTranslation($translationId, $param = [])
    {
        // Check if record exists
        $existingTranslation = $this->find($translationId);
        if (!$existingTranslation) {
            return false; // not found
        }

        // Update the fields
        $existingTranslation['title'] = $param['title'];
        $existingTranslation['language'] = $param['language'];
        $existingTranslation['created_by'] = $param['created_by'];

        // Save the updated data
        $this->save($existingTranslation);

        return true;
    }
}

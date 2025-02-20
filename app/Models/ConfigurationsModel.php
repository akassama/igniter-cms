<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ConfigurationsModel class
 *
 * Represents the model for the configurations table in the database.
 */
class ConfigurationsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'configurations';
    protected $primaryKey       = 'config_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'config_id',
        'config_for',
        'description',
        'config_value',
        'icon',
        'group',
        'data_type',
        'options',
        'default_value',
        'custom_class',
        'search_terms',
        'deletable',
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
        'config_for' => 'required|is_unique[configurations.config_for]',
        'config_value' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [
        'config_for' => 'config_for is required',
        'config_value' => 'config_value is required',
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

    public function createConfiguration($param = array())
    {
        $data = [
            'config_id' => getGUID(),
            'config_for' => $param['config_for'],
            'description' => $param['description'],
            'config_value' => $param['config_value'],
            'group' => $param['group'],
            'icon' => $param['icon'],
            'data_type' => $param['data_type'],
            'options' => $param['options'],
            'default_value' => $param['default_value'],
            'custom_class' => $param['custom_class'],
            'search_terms' => $param['search_terms'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateConfiguration($configurationId, $param = [])
    {
        // Check if record exists
        $existingConfiguration = $this->find($configurationId);
        if (!$existingConfiguration) {
            return false; // not found
        }

        // Update the fields
        $existingConfiguration['config_for'] = $param['config_for'];
        $existingConfiguration['description'] = $param['description'];
        $existingConfiguration['config_value'] = $param['config_value'];
        $existingConfiguration['group'] = $param['group'];
        $existingConfiguration['icon'] = $param['icon'];
        $existingConfiguration['data_type'] = $param['data_type'];
        $existingConfiguration['options'] = $param['options'];
        $existingConfiguration['default_value'] = $param['default_value'];
        $existingConfiguration['custom_class'] = $param['custom_class'];
        $existingConfiguration['search_terms'] = $param['search_terms'];
        $existingConfiguration['deletable'] = $param['deletable'];
        $existingConfiguration['created_by'] = $param['created_by'];
        $existingConfiguration['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingConfiguration);

        return true;
    }
}

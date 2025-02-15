<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * CountersModel class
 * 
 * Represents the model for the counters table in the database.
 */
class CountersModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'counters';
    protected $primaryKey       = 'counter_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'counter_id',
        'title',
        'description',
        'icon',
        'initial_value',
        'final_value',
        'extra_text',
        'link', 
        'new_tab',
        'created_by',
        'updated_by'
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
        'title' => 'required|max_length[255]|min_length[2]',
        'final_value' => 'required|max_length[50]|min_length[1]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'final_value' => 'Final value is required',
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

    public function createCounter($param = array())
    {
        $counterId = getGUID();
        $data = [
            'counter_id' => $counterId,
            'title' => $param['title'],
            'description' => $param['description'],
            'icon' => $param['icon'],
            'initial_value' => $param['initial_value'],
            'final_value' => $param['final_value'],
            'extra_text' => $param['extra_text'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateCounter($counterId, $param = [])
    {
        // Check if record exists
        $existingCounter = $this->find($counterId);
        if (!$existingCounter) {
            return false; // not found
        }

        // Update the fields
        $existingCounter['title'] = $param['title'];
        $existingCounter['description'] = $param['description'];
        $existingCounter['icon'] = $param['icon'];
        $existingCounter['initial_value'] = $param['initial_value'];
        $existingCounter['final_value'] = $param['final_value'];
        $existingCounter['extra_text'] = $param['extra_text'];
        $existingCounter['link'] = $param['link'];
        $existingCounter['new_tab'] = $param['new_tab'];
        $existingCounter['created_by'] = $param['created_by'];
        $existingCounter['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingCounter);

        return true;
    }
}

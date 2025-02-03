<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TeamsModel class
 * 
 * Represents the model for the teams table in the database.
 */
class TeamsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'teams';
    protected $primaryKey       = 'team_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'team_id',
        'name',
        'title',
        'image',
        'summary',
        'social_link_1',
        'social_link_2',
        'social_link_3',
        'social_link_4',
        'social_link_5',
        'social_link_6',
        'details_link',
        'new_tab',
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
        'name' => 'required|max_length[50]',
        'title' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
        'title' => 'Title is required',
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

    public function createTeam($param = array())
    {
        $teamId = getGUID();
        $data = [
            'team_id' => $teamId,
            'name' => $param['name'],
            'title' => $param['title'],
            'image' => $param['image'],
            'summary' => $param['summary'],
            'social_link_1' => $param['social_link_1'],
            'social_link_2' => $param['social_link_1'],
            'social_link_3' => $param['social_link_3'],
            'social_link_4' => $param['social_link_4'],
            'social_link_5' => $param['social_link_5'],
            'social_link_6' => $param['social_link_6'],
            'details_link' => $param['details_link'],
            'new_tab' => $param['new_tab'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateTeam($teamId, $param = [])
    {
        // Check if record exists
        $existingTeam = $this->find($teamId);
        if (!$existingTeam) {
            return false; // not found
        }

        // Update the fields
        $existingTeam['name'] = $param['name'];
        $existingTeam['title'] = $param['title'];
        $existingTeam['image'] = $param['image'];
        $existingTeam['summary'] = $param['summary'];
        $existingTeam['social_link_1'] = $param['social_link_1'];
        $existingTeam['social_link_2'] = $param['social_link_2'];
        $existingTeam['social_link_3'] = $param['social_link_3'];
        $existingTeam['social_link_4'] = $param['social_link_4'];
        $existingTeam['social_link_5'] = $param['social_link_5'];
        $existingTeam['social_link_6'] = $param['social_link_6'];
        $existingTeam['details_link'] = $param['details_link'];
        $existingTeam['new_tab'] = $param['new_tab'];
        $existingTeam['created_by'] = $param['created_by'];
        $existingTeam['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingTeam);

        return true;
    }
}

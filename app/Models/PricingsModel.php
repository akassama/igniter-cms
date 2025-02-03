<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PricingsModel class
 *
 * Represents the model for the pricings table in the database.
 */
class PricingsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'pricings';
    protected $primaryKey       = 'pricing_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pricing_id',
        'title',
        'description',
        'currency',
        'amount',
        'period',
        'is_popular',
        'included_features_list',
        'excluded_features_list',
        'link_title',
        'link',
        'new_tab',
        'order',
        'other_label',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
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
        'title' => 'required|max_length[255]',
        'currency' => 'required|max_length[50]',
        'amount' => 'required|max_length[255]',
        'period' => 'required|max_length[50]',
    ];
    protected $validationMessages   = [
        'title' => 'Title is required',
        'currency' => 'Currency is required',
        'amount' => 'Amount is required',
        'period' => 'Period is required',
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

    public function createPricing($param = array())
    {
        $ricingId = getGUID();
        $data = [
            'pricing_id' => $ricingId,
            'title' => $param['title'],
            'description' => $param['description'],
            'currency' => $param['currency'],
            'amount' => $param['amount'],
            'period' => $param['period'],
            'is_popular' => $param['is_popular'],
            'included_features_list' => $param['included_features_list'],
            'excluded_features_list' => $param['excluded_features_list'],
            'link_title' => $param['link_title'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'order' => $param['order'],
            'other_label' => $param['other_label'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updatePricing($ricingId, $param = [])
    {
        // Check if record exists
        $existingPricing = $this->find($ricingId);
        if (!$existingPricing) {
            return false; // not found
        }

        // Update the fields
        $existingPricing['title'] = $param['title'];
        $existingPricing['description'] = $param['description'];
        $existingPricing['currency'] = $param['currency'];
        $existingPricing['amount'] = $param['amount'];
        $existingPricing['period'] = $param['period'];
        $existingPricing['is_popular'] = $param['is_popular'];
        $existingPricing['included_features_list'] = $param['included_features_list'];
        $existingPricing['excluded_features_list'] = $param['excluded_features_list'];
        $existingPricing['link_title'] = $param['link_title'];
        $existingPricing['link'] = $param['link'];
        $existingPricing['new_tab'] = $param['new_tab'];
        $existingPricing['order'] = $param['order'];
        $existingPricing['other_label'] = $param['other_label'];
        $existingPricing['created_by'] = $param['created_by'];
        $existingPricing['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingPricing);

        return true;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * FrequentlyAskedQuestionsModel class
 *
 * Represents the model for the faqs table in the database.
 */
class FrequentlyAskedQuestionsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'faqs';
    protected $primaryKey       = 'faq_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'faq_id', 
        'question', 
        'answer', 
        'order', 
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
        'question' => 'required|max_length[255]|min_length[2]',
        'answer' => 'required|max_length[1000]',
    ];
    protected $validationMessages   = [
        'question' => 'Question is required',
        'answer' => 'Answer is required. Max of 1000 characters',
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

    public function createFaq($param = array())
    {
        $faqId = getGUID();
        $data = [
            'faq_id' => $faqId,
            'question' => $param['question'],
            'answer' => $param['answer'],
            'order' => $param['order'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateFaq($faqId, $param = [])
    {
        // Check if record exists
        $existingFaq = $this->find($faqId);
        if (!$existingFaq) {
            return false; // not found
        }

        // Update the fields
        $existingFaq['question'] = $param['question'];
        $existingFaq['answer'] = $param['answer'];
        $existingFaq['order'] = $param['order'];
        $existingFaq['created_by'] = $param['created_by'];
        $existingFaq['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingFaq);

        return true;
    }
}

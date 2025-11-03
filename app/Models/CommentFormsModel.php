<?php

namespace App\Models;

use CodeIgniter\Model;


/**
 * CommentFormsModel class
 *
 * Represents the model for the comments table in the database.
 */
class CommentFormsModel extends Model
{
    protected $table            = 'comment_form_submissions';
    protected $primaryKey       = 'comment_form_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'comment_form_id', 
        'name',
        'email',
        'gravatar',
        'comment',
        'page_id',
        'page_url',
        'ip_address',
        'country',
        'browser_signature',
        'is_reply',
        'reply_comment_form_id',
        'remember_me',
        'status',
        'last_updated_by'
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
        'name' => 'required',
        'email' => 'required|valid_email',
        'comment' => 'required',
    ];
    protected $validationMessages   = [
        'name' => 'name is required',
        'email' => 'email is required',
        'comment' => 'comment is required',
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

    /**
     * Create a new comment record
     *
     * @param array $param
     * @return bool
     */
    public function createComment($param = [])
    {
        $data = [
            'comment_form_id'        => getGUID(),
            'name'              => $param['name'],
            'email'             => $param['email'],
            'gravatar'          => $param['gravatar'] ?? null,
            'comment'           => $param['comment'],
            'page_id'           => $param['page_id'] ?? null,
            'page_url'           => $param['page_url'] ?? null,
            'ip_address'        => $param['ip_address'] ?? null,
            'country'           => $param['country'] ?? null,
            'browser_signature' => $param['browser_signature'] ?? null,
            'is_reply'          => $param['is_reply'] ?? 0,
            'reply_comment_form_id'  => $param['reply_comment_form_id'] ?? null,
            'remember_me'       => $param['remember_me'] ?? 0,
            'status'            => $param['status'] ?? 0,
            'created_by'        => $param['created_by'] ?? null,
            'last_updated_by'        => $param['last_updated_by'] ?? null,
        ];

        $this->save($data);
        return true;
    }

    /**
     * Update an existing comment record
     *
     * @param string $commentId
     * @param array $param
     * @return bool
     */
    public function updateComment($commentId, $param = [])
    {
        // Check if the comment exists
        $existingComment = $this->find($commentId);
        if (!$existingComment) {
            return false; 
        }

        // Update the fields
        $existingComment['name']              = $param['name'] ?? $existingComment['name'];
        $existingComment['email']             = $param['email'] ?? $existingComment['email'];
        $existingComment['gravatar']          = $param['gravatar'] ?? $existingComment['gravatar'];
        $existingComment['comment']           = $param['comment'] ?? $existingComment['comment'];
        $existingComment['page_id']           = $param['page_id'] ?? $existingComment['page_id'];
        $existingComment['page_url']           = $param['page_url'] ?? $existingComment['page_url'];
        $existingComment['ip_address']        = $param['ip_address'] ?? $existingComment['ip_address'];
        $existingComment['country']           = $param['country'] ?? $existingComment['country'];
        $existingComment['browser_signature'] = $param['browser_signature'] ?? $existingComment['browser_signature'];
        $existingComment['is_reply']          = $param['is_reply'] ?? $existingComment['is_reply'];
        $existingComment['reply_comment_form_id']  = $param['reply_comment_form_id'] ?? $existingComment['reply_comment_form_id'];
        $existingComment['remember_me']       = $param['remember_me'] ?? $existingComment['remember_me'];
        $existingComment['status']            = $param['status'] ?? $existingComment['status'];
        $existingComment['last_updated_by']   = $param['last_updated_by'] ?? $existingComment['last_updated_by'];

        // Save updated record
        $this->save($existingComment);

        return true;
    }
}

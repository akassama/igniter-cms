<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AppModuleModel class
 * 
 * Represents the model for the app_modules table in the database.
 */
class UsersModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        helper('data'); // Load the helper here
    }

    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id', 
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'password', 
        'status',
        'role',
        'upload_directory',
        'profile_picture', 
        'twitter_link', 
        'facebook_link', 
        'instagram_link', 
        'linkedin_link', 
        'about_summary',
        'password_change_required',
        'remember_token',
        'expires_at',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'first_name' => 'required|max_length[50]',
        'last_name' => 'required|max_length[50]',
        'username' => 'required|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$/]',
    ];
    protected $validationMessages   = [
        'first_name' => 'First name is required',
        'last_name' => 'Last name is required',
        'username' => 'Username is required',
        'email' => 'Email is required',
        'password' => 'Password is required, must be at least 6 characters long. Contain at least one letter, one digit, and one special character.',
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
     * Creates a new user in the system
     * 
     * @param {Object} param - An associative array containing user details
     * @param {string} param.first_name - The first name of the user
     * @param {string} param.last_name - The last name of the user
     * @param {string} param.username - The username for the new user
     * @param {string} param.email - The email address of the user
     * @param {string} param.password - The password for the new user (will be hashed)
     * @return {boolean} Returns true if the user was successfully created
     */
    public function createUser($param = array())
    {
        // Generate a unique user ID (UUID)
        $userId = getGUID(); // Generates a 32-character hexadecimal ID
        $password = password_hash($param['password'], PASSWORD_DEFAULT);
        $defaultStatus = 0;
        $defaultRole = 'User';
        $data = [
            'user_id' => $userId,
            'first_name' => $param['first_name'],
            'last_name' => $param['last_name'],
            'username' => $param['username'],
            'email' => $param['email'],
            'password' => $password,
            'status' => $defaultStatus,
            'role' => $defaultRole,    
            'upload_directory' => generateUserDirectory($param['username']),
            'profile_picture' => $param['profile_picture'] ?? null,
            'twitter_link' => $param['twitter_link'] ?? null,
            'facebook_link' => $param['facebook_link'] ?? null,
            'instagram_link' => $param['instagram_link'] ?? null,
            'linkedin_link' => $param['linkedin_link'] ?? null,
            'about_summary' => $param['about_summary'] ?? null,
            'password_change_required' => $param['password_change_required'] ?? false
        ];
        $this->save($data);

        return true;
    }

    /**
     * Updates an existing user's details in the system
     * 
     * @param {string} userId - The unique identifier of the user to update
     * @param {Object} param - An associative array containing updated user details
     * @param {string} param.first_name - The updated first name of the user
     * @param {string} param.last_name - The updated last name of the user
     * @return {boolean} Returns true if the user was successfully updated, false if the user was not found
     */
    public function updateUser($userId, $param = [])
    {
        // Check if user exists
        $existingUser = $this->find($userId);
        if (!$existingUser) {
            return false; // User not found
        }

        // Update the fields
        $existingUser['first_name'] = $param['first_name'] ?? $existingUser['first_name'];
        $existingUser['last_name'] = $param['last_name'] ?? $existingUser['last_name'];
        $existingUser['profile_picture'] = $param['profile_picture'] ?? $existingUser['profile_picture'];
        $existingUser['twitter_link'] = $param['twitter_link'] ?? $existingUser['twitter_link'];
        $existingUser['facebook_link'] = $param['facebook_link'] ?? $existingUser['facebook_link'];
        $existingUser['instagram_link'] = $param['instagram_link'] ?? $existingUser['instagram_link'];
        $existingUser['linkedin_link'] = $param['linkedin_link'] ?? $existingUser['linkedin_link'];
        $existingUser['about_summary'] = $param['about_summary'] ?? $existingUser['about_summary'];
        $existingUser['password_change_required'] = $param['password_change_required'] ?? $existingUser['password_change_required'];

        // Save the updated data
        $this->save($existingUser);

        return true;
    }

    /**
     * Updates the role of an existing user in the system
     * 
     * @param {string} userId - The unique identifier of the user to update
     * @param {string} role - The new role to assign to the user
     * @return {boolean} Returns true if the user's role was successfully updated, false if the user was not found
     */
    public function updateUserRole($userId, $role)
    {
        // Check if user exists
        $existingUser = $this->find($userId);
        if (!$existingUser) {
            return false; // User not found
        }

        // Update the role
        $existingUser['role'] = $role;

        // Save the updated data
        $this->save($existingUser);

        return true;
    }

    /**
     * Validates a user's login credentials
     * 
     * @param {string} login - The user's email or username
     * @param {string} password - The user's password
     * @return {Object|boolean} Returns the user data if login is successful, false otherwise
     */
    public function validateLogin($login, $password)
    {
        // Check if the login is an email or username
        $user = $this->where('email', $login)
            ->orWhere('username', $login)
            ->first();

        // If user not found, return false
        if (!$user) {
            return false;
        }

        // Verify the password
        if (!password_verify($password, $user['password'])) {
            return false;
        }

        // Password is valid, return the user data
        return $user;
    }

}

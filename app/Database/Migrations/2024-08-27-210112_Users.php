<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        // Load the CustomConfig
        $customConfig = config('CustomConfig');

        $this->forge->addField([
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => getDefaultProfileImagePath(),
            ],
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => '',
                'null' => true,
            ],
            'twitter_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
                'null' => true,
            ],
            'facebook_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
                'null' => true,
            ],
            'instagram_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
                'null' => true,
            ],
            'linkedin_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
                'null' => true,
            ],
            'about_summary' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'default' => null,
                'null' => true,
            ],
            'upload_directory' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => generateUserDirectory('user'),
            ],
            'password_change_required' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'remember_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
                'null' => true,
            ],
            'expires_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('user_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('first_name');
        $this->forge->addKey('last_name');
        $this->forge->addKey('username');
        $this->forge->addKey('email');
        $this->forge->addKey('profile_picture');
        $this->forge->addKey('created_at');

        $this->forge->createTable('users');

        //Insert default record
        $data = [
            [
                'user_id' => getGUID(getDefaultAdminGUID()),
                'first_name'    => 'Admin',
                'last_name'    => 'User',
                'username'    => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('Admin@1', PASSWORD_DEFAULT),
                'status'    => 1,
                'role'    => $customConfig->userRoles['Admin'],
                'profile_picture'    => getDefaultProfileImagePath(),
                'twitter_link'    => 'https://twitter.com/?admin-user',
                'facebook_link'    => 'https://www.facebook..com/?admin-user',
                'instagram_link'    => 'https://instagram..com/?admin-user',
                'linkedin_link'    => 'https://www.linkedin.com/in/?admin-user',
                'about_summary'    => 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!',
                'upload_directory' => "admin_8J0IM",
                'password_change_required' => true
            ],
            [
                'user_id' => getGUID(),
                'first_name'    => 'Manager',
                'last_name'    => 'User',
                'username'    => 'manager',
                'email'    => 'manager@example.com',
                'password' => password_hash('Manager@1', PASSWORD_DEFAULT),
                'status'    => 1,
                'role'    => $customConfig->userRoles['Manager'],
                'profile_picture'    => getDefaultProfileImagePath(),
                'twitter_link'    => 'https://twitter..com/?manager-user',
                'facebook_link'    => 'https://www.facebook..com/?manager-user',
                'instagram_link'    => 'https://instagram..com/?manager-user',
                'linkedin_link'    => 'https://www.linkedin.com/in/?manager-user',
                'about_summary'    => 'Hello! I\'m Manager User, the manager of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!',
                'upload_directory' => "manager_10BYZL",
                'password_change_required' => false
            ],
            [
                'user_id' => getGUID(),
                'first_name'    => 'Test',
                'last_name'    => 'User',
                'username'    => 'test',
                'email'    => 'test@example.com',
                'password' => password_hash('Test@1', PASSWORD_DEFAULT),
                'status'    => 1,
                'role'    => $customConfig->userRoles['User'],
                'profile_picture'    => getDefaultProfileImagePath(),
                'twitter_link'    => 'https://twitter..com/?test-user',
                'facebook_link'    => 'https://www.facebook..com/?test-user',
                'instagram_link'    => 'https://instagram..com/?test-user',
                'linkedin_link'    => 'https://www.linkedin.com/in/?test-user',
                'about_summary'    => 'Hello! I\'m Manager User, the test of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!',
                'upload_directory' => "test_10BYZL",
                'password_change_required' => false
            ]
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
    
}

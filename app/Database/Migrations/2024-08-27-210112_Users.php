<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        // Load custom helper
        helper('data_helper');

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
            ],
            'twitter_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'facebook_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'instagram_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'linkedin_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => null,
            ],
            'about_summary' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'default' => null,
            ],
            'upload_directory' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => generateUserDirectory('user'),
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');

        //Insert default record
        $data = [
            'user_id' => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
            'first_name'    => 'Admin',
            'last_name'    => 'User',
            'username'    => 'admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('Admin@1', PASSWORD_DEFAULT),
            'status'    => 1,
            'role'    => 'Admin',
            'profile_picture'    => getDefaultProfileImagePath(),
            'twitter_link'    => 'https://twitter.com/admin-user',
            'facebook_link'    => 'https://www.facebook.com/admin-user',
            'instagram_link'    => 'https://instagram.com/admin-user',
            'linkedin_link'    => 'https://www.linkedin.com/in/admin-user',
            'about_summary'    => 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!',
            'upload_directory' => "admin_8J0IM"
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
    
}

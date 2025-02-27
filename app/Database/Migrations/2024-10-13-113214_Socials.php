<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Socials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'social_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'null' => true,
                'default' => 10,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('social_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('name');
        $this->forge->addKey('link');

        $this->forge->createTable('socials');

                //insert default records
        //----------------------
        $data = [
            [
                'social_id' => getGUID('ca514840-7670-4d9a-ba48-5ebf87d3c700'),
                'name' => 'Facebook',
                'icon' => 'ri-facebook-fill',
                'link' => 'https://www.facebook.com/yourpage',
                'new_tab' => true,
                'order'    => 2,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null
            ],
            [
                'social_id' => getGUID('f16a7d6d-f44e-47db-b61d-8a478a6d022d'),
                'name' => 'Twitter',
                'icon' => 'ri-twitter-x-line',
                'link' => 'https://www.twitter.com/yourprofile',
                'new_tab' => true,
                'order'    => 4,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null
            ],
            [
                'social_id' => getGUID('b5ea5158-9af9-4f7d-afbe-7c2d517f8936'),
                'name' => 'LinkedIn',
                'icon' => 'ri-linkedin-fill',
                'link' => 'https://www.linkedin.com/in/yourprofile',
                'new_tab' => true,
                'order'    => 6,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null
            ],
            [
                'social_id' => getGUID('b01431ab-814f-4809-920f-dde53fe5c1d6'),
                'name' => 'Instagram',
                'icon' => 'ri-instagram-line',
                'link' => 'https://www.instagram.com/yourprofile',
                'new_tab' => true,
                'order'    => 8,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null
            ]
        ];

        // Using Query Builder
        $this->db->table('socials')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('socials');
    }
}

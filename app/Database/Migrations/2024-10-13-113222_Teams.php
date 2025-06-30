<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'team_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'social_link_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'social_link_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'social_link_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'social_link_4' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'social_link_5' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'social_link_6' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'details_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
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
        $this->forge->addKey('team_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('name');
        $this->forge->addKey('title');
        $this->forge->addKey('image');

        $this->forge->createTable('teams');

        //insert default records
        //----------------------
        $data = [
            [
                'team_id' => getGUID("3fa85f64-5717-4562-b3fc-2c963f66afa1"),
                'name' => 'Bob Johnson',
                'title' => 'CEO',
                'image' => 'public/uploads/files/team-1.jpg',
                'summary' => 'Bob is the visionary leader of our company, with over 20 years of experience in the industry.',
                'social_link_1' => 'https://www.facebook.com/bob-smith',
                'social_link_2' => 'https://twitter.com/bobsmith',
                'social_link_3' => 'https://instagram.com/bobsmith',
                'social_link_4' => '',
                'social_link_5' => 'https://github.com/bobsmith',
                'social_link_6' => '',
                'details_link' => 'https://example.com/team/bob-smith',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'team_id' => getGUID("3fa85f64-5717-4562-b3fc-2c963f66afa2"),
                'name' => 'Alice Smith',
                'title' => 'CTO',
                'image' => 'public/uploads/files/team-2.jpg',
                'summary' => 'Alice is the tech guru behind our innovative solutions, leading the development team with expertise.',
                'social_link_1' => '',
                'social_link_2' => 'https://twitter.com/alicejohnson',
                'social_link_3' => 'https://instagram.com/alicejohnson',
                'social_link_4' => 'https://www.linkedin.com/in/alicejohnson',
                'social_link_5' => 'https://github.com/alicejohnson',
                'social_link_6' => '',
                'details_link' => 'https://example.com/team/alice-johnson',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'team_id' => getGUID("3fa85f64-5717-4562-b3fc-2c963f66afa3"),
                'name' => 'David White',
                'title' => 'CFO',
                'image' => 'public/uploads/files/team-3.jpg',
                'summary' => 'David manages the financial health of our company, ensuring sustainable growth and profitability.',
                'social_link_1' => 'https://www.facebook.com/davidwhite',
                'social_link_2' => 'https://twitter.com/davidwhite',
                'social_link_3' => '',
                'social_link_4' => 'https://www.linkedin.com/in/davidwhite',
                'social_link_5' => 'https://github.com/davidwhite',
                'social_link_6' => '',
                'details_link' => 'https://example.com/team/david-white',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'team_id' => getGUID("3fa85f64-5717-4562-b3fc-2c963f66afa4"),
                'name' => 'Carol Brown',
                'title' => 'COO',
                'image' => 'public/uploads/files/team-4.jpg',
                'summary' => 'Carol oversees the company\'s operations, ensuring efficiency and excellence in all we do.',
                'social_link_1' => 'https://www.facebook.com/carolbrown',
                'social_link_2' => 'https://twitter.com/carolbrown',
                'social_link_3' => 'https://instagram.com/carolbrown',
                'social_link_4' => 'https://www.linkedin.com/in/carolbrown',
                'social_link_5' => '',
                'social_link_6' => '',
                'details_link' => 'https://example.com/team/carol-brown',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ]
        ];

        // Using Query Builder
        $this->db->table('teams')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('teams');
    }
}

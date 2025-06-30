<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'parent' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'default' => 10,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('category_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('title');
        $this->forge->addKey('group');
        $this->forge->addKey('parent');
        $this->forge->addKey('status');
        $this->forge->addKey('created_by');

        $this->forge->createTable('categories');

        //Insert default record
        $data = [
            [
                'category_id' => getGUID("f0b860dc-624c-439a-9de8-f3164c981b08"),
                'title'    => 'Technology',
                'description'    => 'Technology category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'technology',
                'new_tab'    => false,
                'order'    => 6,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("11b3016f-4944-4467-ba98-9de4031ffe21"),
                'title'    => 'AI',
                'description'    => 'AI category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'ai',
                'new_tab'    => false,
                'order'    => 2,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("181dd10c-49d4-49bb-b3c0-f81ff69a35f6"),
                'title'    => 'Miscellaneous',
                'description'    => 'Miscellaneous category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'miscellaneous',
                'new_tab'    => false,
                'order'    => 4,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'title'    => 'Business & Career',
                'description'    => 'Articles about business strategies, career development, and workplace trends',
                'group'    => null,
                'parent'    => null,
                'link'    => 'business-career',
                'new_tab'    => false,
                'order'    => 1,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab"),
                'title'    => 'Technology & Innovation',
                'description'    => 'Cutting-edge technology trends, AI developments, and digital innovations',
                'group'    => null,
                'parent'    => null,
                'link'    => 'technology-innovation',
                'new_tab'    => false,
                'order'    => 2,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'title'    => 'Lifestyle & Wellness',
                'description'    => 'Tips for healthy living, mindfulness practices, and personal development',
                'group'    => null,
                'parent'    => null,
                'link'    => 'lifestyle-wellness',
                'new_tab'    => false,
                'order'    => 3,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("a1b2c3d4-e5f6-7890-1234-567890abcdef"), // New GUID for Sustainability
                'title'    => 'Sustainability',
                'description'    => 'Eco-friendly living, environmental awareness, and sustainable practices',
                'group'    => null,
                'parent'    => null,
                'link'    => 'sustainability',
                'new_tab'    => false,
                'order'    => 4,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("b2c3d4e5-f6a7-8901-2345-67890abcdef1"), // New GUID for Finance
                'title'    => 'Personal Finance',
                'description'    => 'Money management, investing tips, and financial planning strategies',
                'group'    => null,
                'parent'    => null,
                'link'    => 'personal-finance',
                'new_tab'    => false,
                'order'    => 5,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ]
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('categories');
    }    
}

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
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
                'category_id' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
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

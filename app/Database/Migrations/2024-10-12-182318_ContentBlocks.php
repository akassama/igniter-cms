<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentBlocks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'content_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'identifier' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'author' => [
                'type' => 'INT',
                'null' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'image' => [
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
            'custom_field' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'null' => true,
                'default' => 10,
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
        $this->forge->addKey('content_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('identifier');
        $this->forge->addKey('author');
        $this->forge->addKey('title');
        $this->forge->addKey('group');
        $this->forge->addKey('created_by');

        $this->forge->createTable('content_blocks');

        //insert default records
        //----------------------
        $data = [
            [
                'content_id' => getGUID(),
                'identifier'    => 'BusinessServices',
                'author'    => getGUID(getDefaultAdminGUID()),
                'title'    => 'Business Services',
                'description'    => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content'    => null,
                'icon'    => 'ri-database-2-line',
                'group'    => 'theme',
                'image'    => null,
                'new_tab'    => false,
                'custom_field'    => null,
                'order'    => 2,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'content_id' => getGUID(),
                'identifier'    => 'SavingInvestments',
                'author'    => getGUID(getDefaultAdminGUID()),
                'title'    => 'Saving Investments',
                'description'    => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content'    => null,
                'icon'    => 'ri-reactjs-fill',
                'group'    => 'theme',
                'image'    => null,
                'new_tab'    => false,
                'custom_field'    => null,
                'order'    => 4,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'content_id' => getGUID(),
                'identifier'    => 'OnlineConsulting',
                'author'    => getGUID(getDefaultAdminGUID()),
                'title'    => 'Online Consulting',
                'description'    => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content'    => null,
                'icon'    => 'ri-global-line',
                'group'    => 'theme',
                'image'    => null,
                'new_tab'    => false,
                'custom_field'    => null,
                'order'    => 6,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
        ];

        // Using Query Builder
        $this->db->table('content_blocks')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('content_blocks');
    }  
}

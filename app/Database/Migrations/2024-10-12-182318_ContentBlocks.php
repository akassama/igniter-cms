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
                'constraint' => '1000',
                'null' => true,
                'default' => null,
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
                'constraint' => 100,
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
                'content_id' => getGUID('8690E6CA-1CA7-4103-897B-07BC97F65FBF'),
                'identifier' => 'BusinessServices',
                'author' => getGUID(getDefaultAdminGUID()),
                'title' => 'Business Services',
                'description' => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content' => '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>',
                'icon' => 'ri-database-2-line',
                'group' => 'theme',
                'image' => 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services',
                'link' => 'https://example.com/business-services',
                'new_tab' => true,
                'custom_field' => '{"color": "#007bff", "priority": "high"}',
                'order' => 2,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'content_id' => getGUID('C73FE963-71E6-4F00-86D4-CFB54AD813A9'),
                'identifier' => 'SavingInvestments',
                'author' => getGUID(getDefaultAdminGUID()),
                'title' => 'Saving Investments',
                'description' => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content' => 'Learn how our investment strategies can maximize your returns while minimizing risks.',
                'icon' => 'ri-reactjs-fill',
                'group' => 'theme',
                'image' => 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments',
                'link' => 'https://example.com/saving-investments',
                'new_tab' => false,
                'custom_field' => '{"color": "#28a745", "priority": "medium"}',
                'order' => 4,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'content_id' => getGUID('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD'),
                'identifier' => 'OnlineConsulting',
                'author' => getGUID(getDefaultAdminGUID()),
                'title' => 'Online Consulting',
                'description' => 'Exhaustive technology of implementing multi purpose projects is putting your project successful.',
                'content' => '<p>Access expert advice from anywhere with our virtual consulting services.</p>',
                'icon' => 'ri-global-line',
                'group' => 'theme',
                'image' => 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting',
                'link' => 'https://example.com/online-consulting',
                'new_tab' => true,
                'custom_field' => '{"color": "#dc3545", "priority": "low"}',
                'order' => 6,
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

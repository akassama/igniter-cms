<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Codes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'code_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'code_for' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'code' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'deletable' => [
                'type' => 'INT',
                'default' => 1,
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
        $this->forge->addKey('code_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('code');

        $this->forge->createTable('codes');

        //Insert default record
        $data = [
            [
                'code_id' => getGUID(),
                'code_for'    => 'CSS',
                'code'    => '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }',
                'deletable'    => 0,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435')
            ],
            [
                'code_id' => getGUID(),
                'code_for'    => 'HeaderJS',
                'code'    => "<script>console.log('Head script loaded');</script>",
                'deletable'    => 0,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435')
            ],
            [
                'code_id' => getGUID(),
                'code_for'    => 'FooterJS',
                'code'    => "<script>console.log('Footer script loaded');</script>",
                'deletable'    => 0,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435')
            ],
        ];

        // Using Query Builder
        $this->db->table('codes')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('codes');
    }
}

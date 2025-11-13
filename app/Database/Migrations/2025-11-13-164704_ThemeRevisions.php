<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ThemeRevisions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'theme_revision_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'theme_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'file_content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'revision_note' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, 
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('code_id', true);

        $this->forge->createTable('theme_revisions');
    }

    public function down()
    {
        $this->forge->dropTable('theme_revisions');
    }
}

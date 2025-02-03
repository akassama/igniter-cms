<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ErrorLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'error_log_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'user' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'severity' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => false,
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('error_log_id', true);
        $this->forge->createTable('error_logs');
    }

    public function down()
    {
        $this->forge->dropTable('error_logs');
    }
}

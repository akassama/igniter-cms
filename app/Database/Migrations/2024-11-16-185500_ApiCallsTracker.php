<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiCallsTracker extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'api_call_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('api_call_id', true);
        $this->forge->createTable('api_calls_tracker');
    }

    public function down()
    {
        $this->forge->dropTable('api_calls_tracker');
    }
}

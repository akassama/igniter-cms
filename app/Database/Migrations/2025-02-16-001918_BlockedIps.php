<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlockedIps extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'blocked_ip_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'block_start_time' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'block_end_time' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'page_visited_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('blocked_ip_id', true);
        $this->forge->createTable('blocked_ips');
    }

    public function down()
    {
        $this->forge->dropTable('blocked_ips');
    }
}

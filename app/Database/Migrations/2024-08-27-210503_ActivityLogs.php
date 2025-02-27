<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActivityLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'activity_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'activity_by' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'activity_type' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
                'after' => 'activity'
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'ip_address'
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('activity_id', true);
        
        // Custom Optimization - Indexing
        $this->forge->addKey('activity_by');
        $this->forge->addKey('created_at');
        
        $this->forge->createTable('activity_logs');
    }

    public function down()
    {
        $this->forge->dropTable('activity_logs');
    }
}

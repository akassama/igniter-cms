<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Plugins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'plugin_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'plugin_key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'status' => [
                'type' => 'TINYINT',
                'default' => 0,
                'null' => false,
            ],
            'update_available' => [
                'type' => 'TINYINT',
                'default' => 0,
                'null' => false,
            ],
            'load' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
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
        $this->forge->addKey('plugin_id', true);

        $this->forge->createTable('plugins');
    }

    public function down()
    {
        $this->forge->dropTable('plugins');
    }
}

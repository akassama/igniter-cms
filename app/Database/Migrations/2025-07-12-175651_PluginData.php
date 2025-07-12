<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PluginData extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'plugin_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'plugin_data_1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_3' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_4' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_5' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_6' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_7' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_8' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_9' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_10' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_11' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plugin_data_12' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('plugin_data');
    }

    public function down()
    {
        $this->forge->dropTable('plugin_data');
    }
}

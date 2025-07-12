<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PluginConfigs extends Migration
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
            'config_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'config_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['plugin_slug', 'config_key'], 'unique_plugin_config');
        $this->forge->createTable('plugin_configs');
    }

    public function down()
    {
        $this->forge->dropTable('plugin_configs');
    }
}

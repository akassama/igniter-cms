<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WhitelistedIps extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'whitelisted_ip_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('whitelisted_ip_id', true);
        $this->forge->createTable('whitelisted_ips');
    }

    public function down()
    {
        $this->forge->dropTable('whitelisted_ips');
    }
}

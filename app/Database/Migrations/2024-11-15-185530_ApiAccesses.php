<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiAccesses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'api_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'assigned_to' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('api_id', true);
        $this->forge->createTable('api_accesses');

        //Insert default record
        $data = [
            'api_id' => getGUID(),
            'api_key' => generateApiKey(),
            'assigned_to' => getGUID(getDefaultAdminGUID()),
            'status' => 1,
            'created_by' => getGUID(getDefaultAdminGUID()),
            'updated_by' => null
        ];

        // Using Query Builder
        $this->db->table('api_accesses')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('api_accesses');
    }
}

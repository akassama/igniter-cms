<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subscribers extends Migration
{
    public function up()
    {
        // Load custom helper
        helper('data_helper');

        $this->forge->addField([
            'subscriber_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('subscriber_id', true);
        $this->forge->createTable('subscribers');

        //Insert default record
        $data = [
            [
                'subscriber_id' => getGUID(),
                'name'    => 'John Doe',
                'email'    => 'user@example.com',
                'ip_address'    => '192.168.1.1',
                'country'    => 'GM',
                'status'    => 1,
            ],
            [
                'subscriber_id' => getGUID(),
                'name'    => 'Mary Jane',
                'email'    => 'subscriber@example.com',
                'ip_address'    => '192.168.1.1',
                'country'    => 'GM',
                'status'    => 1,
            ],
            [
                'subscriber_id' => getGUID(),
                'name'    => 'Mr Foo',
                'email'    => 'example@subscriber.com',
                'ip_address'    => '192.168.1.1',
                'country'    => 'GM',
                'status'    => 0,
            ]
        ];

        // Using Query Builder
        $this->db->table('subscribers')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('subscribers');
    }
}

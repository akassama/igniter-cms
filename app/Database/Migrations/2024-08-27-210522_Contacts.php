<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contacts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'contact_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'contact_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'contact_picture' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'contact_document' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'contact_audio' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'contact_video' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'other_document' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'contact_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'contact_number' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'contact_address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('contact_id', true);
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}

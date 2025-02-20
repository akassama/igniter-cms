<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContactMessages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'contact_message_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'subject' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_read' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('contact_message_id', true);
        $this->forge->createTable('contact_messages');

        //Insert default record
        $data = [
            [
                'contact_message_id' => getGUID(),
                'name'             => 'John Doe',
                'email'            => 'john.doe@example.com',
                'subject'          => 'Website Inquiry',
                'is_read'          => 0,
                'message'          => 'This is a test message from John Doe.',
                'ip_address'       => '192.168.1.1',
                'country'          => 'US',
                'device'           => 'Desktop',
            ],
            [
                'contact_message_id' => getGUID(),
                'name'             => 'Jane Smith',
                'email'            => 'jane.smith@example.com',
                'subject'          => 'Product Question',
                'is_read'          => 0,
                'message'          => 'I have a question about your product.',
                'ip_address'       => '10.0.0.1',
                'country'          => 'CA',
                'device'           => 'Mobile',
            ],
            [
                'contact_message_id' => getGUID(),
                'name'             => 'Peter Jones',
                'email'            => 'peter.jones@example.com',
                'subject'          => 'Feedback',
                'is_read'          => 0,
                'message'          => 'I wanted to provide some feedback.',
                'ip_address'       => '172.16.0.1',
                'country'          => 'GB',
                'device'           => 'Tablet',
            ],
        ];

        // Using Query Builder
        $this->db->table('contact_messages')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('contact_messages');
    }    
}

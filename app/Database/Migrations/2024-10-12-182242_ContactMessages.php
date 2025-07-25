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
        
        // Custom Optimization - Indexing
        $this->forge->addKey('name');
        $this->forge->addKey('email');
        $this->forge->addKey('subject');
        $this->forge->addKey('country');

        $this->forge->createTable('contact_messages');

        //Insert default record
        $data = [
            [
                'contact_message_id' => getGUID("7b7978d1-0fb5-442e-8f24-de1a2fd560f5"),
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
                'contact_message_id' => getGUID("9b7b0332-bd6f-4f2b-b003-0c9caf96119c"),
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
                'contact_message_id' => getGUID("dbed80e0-eb45-4bff-862c-46bd7587e892"),
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

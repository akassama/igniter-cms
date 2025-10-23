<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContactForms extends Migration
{
 public function up()
    {
        $this->forge->addField([
            'contact_form_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'site_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'form_name' => [ // Allows multiple contact forms per site
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'message' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'company' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'user_agent' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'referrer' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'is_read' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_archived' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // e.g., 'New', 'In Progress', 'Resolved'
                'default'    => 'New',
            ],
            'notes' => [
                'type'       => 'TEXT',
                'null'       => true, // Internal admin notes
            ],
            'last_updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('contact_form_id', true);
        $this->forge->addKey('site_id');
        $this->forge->addKey('email');
        $this->forge->addKey('status');
        $this->forge->createTable('contact_form_submissions');
    }

    public function down()
    {
        $this->forge->dropTable('contact_form_submissions');
    }
}

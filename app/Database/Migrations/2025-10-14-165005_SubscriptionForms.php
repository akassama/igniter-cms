<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubscriptionForms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'subscription_form_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'form_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'site_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'list_name' => [ // Which mailing list they subscribed to
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'source' => [ // How the user subscribed (e.g., 'Homepage', 'Blog X')
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // e.g., 'Pending Confirmation', 'Active', 'Unsubscribed', 'Bounced'
                'default'    => 'Pending Confirmation',
            ],
            'confirmation_token' => [ // For double opt-in
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'confirmed_at' => [ // Timestamp when confirmed
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'unsubscribed_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'last_updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('subscription_form_id', true);
        $this->forge->addKey('site_id');
        $this->forge->addKey('email');
        $this->forge->addKey('status');
        $this->forge->createTable('subscription_form_submissions');
    }

    public function down()
    {
        $this->forge->dropTable('subscription_form_submissions');
    }
}

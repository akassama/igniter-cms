<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BookingForms extends Migration
{
public function up()
    {
        $this->forge->addField([
            'booking_form_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'site_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'form_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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
            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'service_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'appointment_date' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'appointment_time' => [
                'type'       => 'TIME',
                'null'       => true,
            ],
            'duration' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true, // Duration in minutes
            ],
            'number_of_attendees' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'message' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // e.g., 'Pending', 'Confirmed', 'Cancelled'
                'default'    => 'Pending',
            ],
            'confirmation_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'notes' => [
                'type'       => 'TEXT',
                'null'       => true, // Internal admin notes
            ],
            'resource_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'resource_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'payment_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // e.g., 'None','Unpaid', 'Paid', 'Refunded'
                'default'    => 'Unpaid',
            ],
            'payment_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'country' => [ // Added based on your contact form suggestion
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

        $this->forge->addKey('booking_form_id', true);
        $this->forge->addKey('site_id');
        $this->forge->addKey('email');
        $this->forge->addKey('appointment_date');
        $this->forge->addKey('status');
        $this->forge->createTable('booking_form_submissions');
    }

    public function down()
    {
        $this->forge->dropTable('booking_form_submissions');
    }
}

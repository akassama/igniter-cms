<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bookings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'booking_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'booking_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'booking_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'no_of_people' => [
                'type' => 'INT',
                'null' => true,
                'default' => 1,
            ],
            'message' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'other' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
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
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('booking_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('name');

        $this->forge->createTable('bookings');

        // Insert sample records
        $data = [
            [
                'booking_id' => getGUID(),
                'name'    => 'John Doe',
                'email'    => 'johndoe@example.com',
                'phone'    => '1234567890',
                'booking_date'    => date('Y-m-d'),
                'booking_time'    => '12:00',
                'no_of_people'    => 2,
                'message'    => 'Looking forward to the meal!',
                'other'    => '',
                'ip_address'       => '192.168.1.1',
                'country'          => 'US',
                'device'           => 'Desktop',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'booking_id' => getGUID(),
                'name'    => 'Jane Smith',
                'email'    => 'janesmith@example.com',
                'phone'    => '0987654321',
                'booking_date'    => date('Y-m-d', strtotime('+1 day')),
                'booking_time'    => '18:30',
                'no_of_people'    => 4,
                'message'    => 'Celebrating a birthday!',
                'other'    => '',
                'ip_address'       => '10.0.0.1',
                'country'          => 'CA',
                'device'           => 'Mobile',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'booking_id' => getGUID(),
                'name'    => 'Alex Johnson',
                'email'    => 'alexjohnson@example.com',
                'phone'    => '1122334455',
                'booking_date'    => date('Y-m-d', strtotime('-5 days')),
                'booking_time'    => '14:15',
                'no_of_people'    => 1,
                'message'    => 'Business lunch reservation.',
                'other'    => '',
                'ip_address'       => '172.16.0.1',
                'country'          => 'GB',
                'device'           => 'Tablet',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'booking_id' => getGUID(),
                'name'    => 'Emily Carter',
                'email'    => 'emilycarter@example.com',
                'phone'    => '5566778899',
                'booking_date'    => date('Y-m-d', strtotime('+3 days')),
                'booking_time'    => '11:00',
                'no_of_people'    => 3,
                'message'    => 'Lunch meeting with colleagues.',
                'other'    => '',
                'ip_address'       => '172.16.0.1',
                'country'          => 'GB',
                'device'           => 'Tablet',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'booking_id' => getGUID(),
                'name'    => 'Michael Brown',
                'email'    => 'michaelbrown@example.com',
                'phone'    => '6677889900',
                'booking_date'    => date('Y-m-d', strtotime('+10 days')),
                'booking_time'    => '19:45',
                'no_of_people'    => 6,
                'message'    => 'Family dinner.',
                'other'    => '',
                'ip_address'       => '10.0.0.1',
                'country'          => 'CA',
                'device'           => 'Mobile',
                'created_by' => getGUID(getDefaultAdminGUID())
            ]
        ];

        // Using Query Builder
        $this->db->table('bookings')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}

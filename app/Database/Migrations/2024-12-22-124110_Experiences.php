<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Experiences extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'experience_id' => [
                'type' => 'VARCHAR',
                'constraint' => 36
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'start_date' => [
                'type' => 'DATE'
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true
            ],
            'current_job' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'achievements' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'company_logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'company_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],            
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'null' => true
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('experience_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('company_name');
        $this->forge->addKey('position');

        $this->forge->createTable('experiences');

        //Insert default record
        $data = [
            [
                'experience_id' => getGUID(),
                'group' => 'Professional',
                'company_name' => 'Example Corp',
                'position' => 'Software Engineer',
                'start_date' => '2019-07-01',
                'end_date' => '2023-01-01',
                'current_job' => false,
                'location' => 'New York, NY',
                'description' => 'Developed and maintained scalable web applications using modern frameworks.',
                'achievements' => 'Implemented a new feature that increased user engagement by 20%.',
                'company_logo' => 'public/uploads/files/company-logo.jpg',
                'company_url' => 'https://example.com', 
                'order' => 1,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'experience_id' => getGUID(),
                'group' => 'Professional',
                'company_name' => 'TechNova Inc.',
                'position' => 'Senior Developer',
                'start_date' => '2017-03-15',
                'end_date' => '2019-06-30',
                'current_job' => false,
                'location' => 'San Francisco, CA',
                'description' => 'Led frontend development for enterprise-level clients, focusing on performance and scalability.',
                'achievements' => 'Optimized application load time by 35%, improving overall client satisfaction.',
                'company_logo' => 'public/uploads/files/technova-logo.png',
                'company_url' => 'https://technova.com', 
                'order' => 2,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'experience_id' => getGUID(),
                'group' => 'Professional',
                'company_name' => 'InnovateX Solutions',
                'position' => 'Full Stack Developer',
                'start_date' => '2023-02-01',
                'end_date' => '',
                'current_job' => true,
                'location' => 'Remote',
                'description' => 'Building cloud-native applications with React, Node.js, and AWS services.',
                'achievements' => 'Launched an internal tool that reduced deployment times by 50%.',
                'company_logo' => 'public/uploads/files/innovatex-logo.png',
                'company_url' => 'https://innovatex.io', 
                'order' => 3,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ]
        ];


        // Using Query Builder
        $this->db->table('experiences')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('experiences');
    }
}

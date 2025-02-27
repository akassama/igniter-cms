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
                'constraint' => 255,
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
                'null' => true
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
            'experience_id' => getGUID(),
            'group' => 'Professional',
            'company_name' => 'Example Corp',
            'position' => 'Software Engineer',
            'start_date' => '2019-07-01',
            'end_date' => '2023-01-01',
            'current_job' => false,
            'location' => 'New York, NY',
            'description' => 'Developed and maintained web applications.',
            'achievements' => 'Implemented a new feature that increased user engagement by 20%.',
            'company_logo' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/company-logo.jpg',
            'company_url' => 'https://example.com',
            'order' => 1,
            'status' => 1,
            'created_by' => getGUID(getDefaultAdminGUID()),
            'updated_by' => getGUID(getDefaultAdminGUID())
        ];

        // Using Query Builder
        $this->db->table('experiences')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('experiences');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Educations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'education_id' => [
                'type' => 'VARCHAR',
                'constraint' => 36
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'institution' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'field_of_study' => [
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
            'grade' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'activities' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'institution_logo' => [
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
        $this->forge->addKey('education_id', true);
        $this->forge->createTable('educations');

        //Insert default record
        $data = [
            [
                'education_id' => getGUID(),
                'group' => 'Undergraduate',
                'institution' => 'University of Example',
                'degree' => 'Bachelor of Science',
                'field_of_study' => 'Computer Science',
                'start_date' => '2015-09-01',
                'end_date' => '2019-06-01',
                'grade' => 'A-',
                'activities' => 'Member of the Computer Science Club',
                'description' => 'Focused on software development and data structures.',
                'institution_logo' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-logo.jpg',
                'order' => 1,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'education_id' => getGUID(),
                'group' => 'Graduate',
                'institution' => 'Example University',
                'degree' => 'Master of Science',
                'field_of_study' => 'Software Engineering',
                'start_date' => '2020-09-01',
                'end_date' => '2022-06-01',
                'grade' => 'A',
                'activities' => 'Research Assistant in the Software Engineering Lab',
                'description' => 'Specialized in advanced software engineering principles and practices.',
                'institution_logo' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-education-logo.jpg',
                'order' => 2,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ]
        ];

        // Using Query Builder
        $this->db->table('educations')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('educations');
    }
}

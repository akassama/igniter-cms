<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Resumes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'resume_id' => [
                'type' => 'VARCHAR',
                'constraint' => 36
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'dob' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'linkedin_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'github_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'twitter_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'additional_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'certifications' => [
                'type' => 'TEXT',
                'constraint' => 1000,
                'null' => true
            ],
            'cv_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],            
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'total_views' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'meta_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'meta_description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'meta_keywords' => [
                'type' => 'TEXT',
                'null' => true
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
        $this->forge->addKey('resume_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('full_name');
        $this->forge->addKey('title');

        $this->forge->createTable('resumes');

        //Insert default record
        $data = [
            'resume_id' => getGUID(),
            'full_name' => 'Mary Jane',
            'title' => 'Software Engineer',
            'summary' => 'Experienced software engineer with a passion for developing innovative programs that expedite the efficiency and effectiveness of organizational success.',
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'dob' => '2000-09-19',
            'address' => '123 Main St, Anytown, USA',
            'website' => 'https://example.com?johndoe',
            'linkedin_url' => 'https://www.linkedin.com/in/?johndoe',
            'github_url' => 'https://github.com/?johndoe',
            'twitter_url' => 'https://twitter.com/?johndoe',
            'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/resume-profile.jpg',
            'additional_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/resume-portrait.jpg',
            'cv_file' => 'public/uploads/cv_files/john_doe_cv.pdf',
            'certifications' => 'AWS Certified Developer,Google Cloud Professional,MongoDB Certified Developer',
            'status' => 1,
            'created_by' => getGUID(getDefaultAdminGUID()),
            'updated_by' => getGUID(getDefaultAdminGUID()),
            'meta_title' => 'Mary Jane - Software Engineer',
            'meta_description' => 'Mary Jane is an experienced software engineer with a passion for developing innovative programs.',
            'meta_keywords' => 'Mary Jane, Software Engineer, Developer, Programmer'
        ];

        // Using Query Builder
        $this->db->table('resumes')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('resumes');
    }
}

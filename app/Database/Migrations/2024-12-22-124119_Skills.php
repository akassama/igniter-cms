<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Skills extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'skill_id' => [
                'type' => 'VARCHAR',
                'constraint' => 36
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'proficiency_level' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'years_experience' => [
                'type' => 'FLOAT',
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'icon' => [
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
        $this->forge->addKey('skill_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('name');
        $this->forge->addKey('description');

        $this->forge->createTable('skills');

        //Insert default record
        $data = [
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'Programming Languages',
                'name' => 'JavaScript',
                'proficiency_level' => 'Advanced',
                'years_experience' => 5,
                'description' => 'Experienced in developing web applications using JavaScript.',
                'icon' => 'ri-robot-2-line',
                'order' => 1,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'Programming Languages',
                'name' => 'Python',
                'proficiency_level' => 'Advanced',
                'years_experience' => 4,
                'description' => 'Proficient in developing data analysis and machine learning applications using Python.',
                'icon' => 'ri-python-line',
                'order' => 2,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'Web Development',
                'name' => 'HTML & CSS',
                'proficiency_level' => 'Expert',
                'years_experience' => 6,
                'description' => 'Expert in creating responsive and accessible web designs using HTML and CSS.',
                'icon' => 'ri-html5-line',
                'order' => 3,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'Frameworks',
                'name' => 'React',
                'proficiency_level' => 'Advanced',
                'years_experience' => 3,
                'description' => 'Skilled in building dynamic and high-performance web applications using React.',
                'icon' => 'ri-reactjs-line',
                'order' => 4,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'Databases',
                'name' => 'SQL',
                'proficiency_level' => 'Intermediate',
                'years_experience' => 4,
                'description' => 'Experienced in designing and managing relational databases using SQL.',
                'icon' => 'ri-database-2-line',
                'order' => 5,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'skill_id' => getGUID(),
                'group' => 'Technical',
                'category' => 'DevOps',
                'name' => 'Docker',
                'proficiency_level' => 'Intermediate',
                'years_experience' => 2,
                'description' => 'Proficient in containerizing applications and managing containerized environments using Docker.',
                'icon' => 'ri-docker-line',
                'order' => 6,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => getGUID(getDefaultAdminGUID())
            ]
        ];

        // Using Query Builder
        $this->db->table('skills')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('skills');
    }
}

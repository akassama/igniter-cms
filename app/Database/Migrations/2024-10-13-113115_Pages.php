<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'content' => [
                'type' => 'TEXT',
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
            'meta_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'meta_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_keywords' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('page_id', true);
        $this->forge->createTable('pages');

        //Insert default record
        $data = [
            [
                'page_id' => getGUID("f7a8d40d-6b97-4c0b-a532-f535ac4c4af1"),
                'title' => 'About Us',
                'slug' => 'about-us',
                'status' => 1,
                'content' => '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>',
                'created_by' => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by' => null,
                'meta_title' => 'About Us - Our Company',
                'meta_description' => 'Learn more about our companys mission, values, and team',
                'meta_keywords' => 'about us, company, mission, values, team',
            ],
            [
                'page_id' => getGUID("0afb7c2f-5912-43ee-8df3-fa46982bf1c5"),
                'title' => 'Resources',
                'slug' => 'resources',
                'status' => 1,
                'content' => '<h2>Resources</h2> <p>Discover the power of our headless CMS. Explore insightful articles on our unique features, learn tips to streamline your projects, and stay updated on the latest trends in content management.</p>',
                'created_by' => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by' => null,
                'meta_title' => 'Resources - Get in Touch',
                'meta_description' => 'Discover the power of our headless CMS.',
                'meta_keywords' => 'headless cms, web, codeigniter',
            ]
        ];

        // Using Query Builder
        $this->db->table('pages')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('pages');
    }
}
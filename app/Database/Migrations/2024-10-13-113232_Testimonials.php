<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Testimonials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'testimonial_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'company' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'testimonial' => [
                'type' => 'TEXT',
            ],
            'rating' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
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
        $this->forge->addKey('testimonial_id', true);
        $this->forge->createTable('testimonials');

                //insert default records
        //----------------------
        $data = [       
            [
                'testimonial_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa2'),
                'name' => 'Franklin Harris',
                'title' => 'CEO',
                'company' => 'TechSolutions Ltd.',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-1.jpg',
                'testimonial' => 'Their team is highly skilled and delivered a top-notch product that exceeded our expectations.',
                'rating' => 5,
                'link' => 'https://techsolutions.com',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'testimonial_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa1'),
                'name' => 'Emily Clark',
                'title' => 'Marketing Director',
                'company' => 'MarketMakers Inc.',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-2.jpg',
                'testimonial' => 'This company provided exceptional service and helped us achieve our marketing goals with their innovative solutions.',
                'rating' => 5,
                'link' => 'https://marketmakers.com',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'testimonial_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa3'),
                'name' => 'Grace Lee',
                'title' => 'Product Manager',
                'company' => 'Innovatech',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-3.jpg',
                'testimonial' => 'We were impressed with their attention to detail and the quality of their work. Highly recommend!',
                'rating' => 4,
                'link' => 'https://innovatech.com',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'testimonial_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa4'),
                'name' => 'Henry Adams',
                'title' => 'CTO',
                'company' => 'WebWorks',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-4.jpg',
                'testimonial' => 'Their expertise in web development is unmatched. We are extremely satisfied with the end result.',
                'rating' => 5,
                'link' => 'https://webworks.com',
                'new_tab' => true,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ]
        ];

        // Using Query Builder
        $this->db->table('testimonials')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('testimonials');
    }
}
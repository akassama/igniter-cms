<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Portfolios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'portfolio_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'category_filter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'client' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'project_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'project_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'featured_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'details_image_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'details_image_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'details_image_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'details_image_4' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'content' => [
                'type' => 'TEXT',
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
                'constraint' => '255',
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
        $this->forge->addKey('portfolio_id', true);
        $this->forge->createTable('portfolios');

                //insert default records
        //----------------------
        $data = [
            [
                'portfolio_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa1'),
                'title' => 'Website Redesign',
                'description' => 'A complete overhaul of the client\'s existing website to improve user experience and update the design.',
                'slug' => 'website-redesign',
                'category' => 'Web Development',
                'category_filter' => 'web-development',
                'client' => 'TechCorp',
                'project_date' => '2024-01-15',
                'project_url' => 'https://techcorp.com/new-website',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-1.jpg',
                'details_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg',
                'details_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg',
                'details_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg',
                'details_image_4' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg',
                'content' => '<p>We worked closely with TechCorp to redesign their website, focusing on a modern look and feel, as well as improving the overall user experience. The project included a new responsive design, updated content structure, and enhanced performance.</p>',
                'status' => 1,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null,
                'meta_title' => 'Website Redesign for TechCorp',
                'meta_description' => 'Read about our project to redesign TechCorp\'s website, focusing on user experience and modern design.',
                'meta_keywords' => 'website redesign, web development, TechCorp, user experience, responsive design'
            ],
            [
                'portfolio_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa2'),
                'title' => 'Mobile App Development',
                'description' => 'Development of a cross-platform mobile app for a retail client to enhance their customer engagement.',
                'slug' => 'mobile-app-development',
                'category' => 'App Development',
                'category_filter' => 'app-development',
                'client' => 'RetailGiant',
                'project_date' => '2024-02-20',
                'project_url' => 'https://retailgiant.com/mobile-app',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-2.jpg',
                'details_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg',
                'details_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg',
                'details_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg',
                'details_image_4' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg',
                'content' => '<p>Our team developed a cross-platform mobile app for RetailGiant, designed to enhance customer engagement and provide a seamless shopping experience. The app includes features such as push notifications, in-app purchases, and loyalty rewards.</p>',
                'status' => 1,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null,
                'meta_title' => 'Mobile App Development for RetailGiant',
                'meta_description' => 'Discover how we developed a cross-platform mobile app for RetailGiant to enhance customer engagement.',
                'meta_keywords' => 'mobile app development, app development, RetailGiant, customer engagement, cross-platform'
            ],
            [
                'portfolio_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa3'),
                'title' => 'E-commerce Platform Launch',
                'description' => 'Launch of a new e-commerce platform for a fashion brand, including design, development, and deployment.',
                'slug' => 'ecommerce-platform-launch',
                'category' => 'E-commerce',
                'category_filter' => 'e-commerce',
                'client' => 'FashionHub',
                'project_date' => '2024-03-10',
                'project_url' => 'https://fashionhub.com',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-3.jpg',
                'details_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg',
                'details_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg',
                'details_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg',
                'details_image_4' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg',
                'content' => '<p>We partnered with FashionHub to launch a new e-commerce platform, providing end-to-end services from design and development to deployment. The platform offers a user-friendly interface, secure payment options, and an integrated inventory management system.</p>',
                'status' => 1,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null,
                'meta_title' => 'E-commerce Platform Launch for FashionHub',
                'meta_description' => 'Learn about our project to launch a new e-commerce platform for FashionHub, including design, development, and deployment.',
                'meta_keywords' => 'e-commerce platform, e-commerce, FashionHub, platform launch, web development'
            ],
            [
                'portfolio_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa4'),
                'title' => 'Digital Marketing Campaign',
                'description' => 'A comprehensive digital marketing campaign for a new product launch, including SEO, SEM, and social media marketing.',
                'slug' => 'digital-marketing-campaign',
                'category' => 'Marketing',
                'category_filter' => 'marketing',
                'client' => 'Innovatech',
                'project_date' => '2024-04-05',
                'project_url' => 'https://innovatech.com/new-product',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-4.jpg',
                'details_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg',
                'details_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg',
                'details_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg',
                'details_image_4' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg',
                'content' => '<p>Innovatech engaged us to run a digital marketing campaign for their new product launch. The campaign included SEO to improve search engine rankings, SEM for targeted advertising, and social media marketing to increase brand awareness and engagement.</p>',
                'status' => 1,
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
                'updated_by' => null,
                'meta_title' => 'Digital Marketing Campaign for Innovatech',
                'meta_description' => 'Explore our digital marketing campaign for Innovatech\'s new product launch, including SEO, SEM, and social media marketing.',
                'meta_keywords' => 'digital marketing, marketing campaign, Innovatech, SEO, SEM, social media marketing'
            ]
        ];

        // Using Query Builder
        $this->db->table('portfolios')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('portfolios');
    }
}

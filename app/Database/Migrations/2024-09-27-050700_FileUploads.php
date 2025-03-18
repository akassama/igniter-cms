<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FileUploads extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'file_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'file_size' => [
                'type' => 'FLOAT',
            ],
            'upload_path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'caption' => [
                'type' => 'VARCHAR',
                'default' => null,
                'constraint' => '255',
            ],
            'unique_identifier' => [
                'type' => 'VARCHAR',
                'default' => generateContentIdentifier("file"),
                'constraint' => '255',
            ],
            'group' => [
                'type' => 'VARCHAR',
                'default' => null,
                'constraint' => '255',
            ],
            'deletable' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('file_id', true);
        
        // Custom Optimization - Indexing
        $this->forge->addKey('user_id');
        $this->forge->addKey('file_name');
        $this->forge->addKey('file_type');
        $this->forge->addKey('unique_identifier');
        $this->forge->addKey('group');

        $this->forge->createTable('file_uploads');

        //insert default records
        //----------------------
        $data = [
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('client-1.png'),
                'file_type'    => 'png',
                'file_size'    => '3036',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-1.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('client-2.png'),
                'file_type'    => 'png',
                'file_size'    => '5150',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-2.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('client-3.png'),
                'file_type'    => 'png',
                'file_size'    => '5000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-3.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('client-4.png'),
                'file_type'    => 'png',
                'file_size'    => '4450',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-4.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('home-about.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '119000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/home-about.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('about-us.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '141000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/about-us.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('portfolio-image-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '65000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('portfolio-image-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '72000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('portfolio-image-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '41000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('portfolio-image-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '60500',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('team-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '63000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('team-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '33000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('team-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '25000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('team-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '53000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('testimonials-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '39000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('testimonials-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '56000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('testimonials-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '17000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('testimonials-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '19700',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('gallery-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '64000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('gallery-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '62000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('gallery-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '112000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('gallery-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '72000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('pexel-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '25000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('pexel-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '37000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('pexel-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '32000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('pexel-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '24000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('blog-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '104000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('blog-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '69000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('blog-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '89000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('event-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '30000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('event-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '26000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('page-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '381000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/page-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('page-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '123000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/page-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('ci-cms-logo.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '43000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('ci-cms-logo.png'),
                'file_type'    => 'png',
                'file_size'    => '43000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('favicon.ico'),
                'file_type'    => 'ico',
                'file_size'    => '14000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.ico',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('apple-touch-icon.png'),
                'file_type'    => 'png',
                'file_size'    => '36000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/apple-touch-icon.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('favicon-96x96.png'),
                'file_type'    => 'png',
                'file_size'    => '13000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon-96x96.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('web-app-manifest-192x192.png'),
                'file_type'    => 'png',
                'file_size'    => '40000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/web-app-manifest-192x192.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('web-app-manifest-512x512.png'),
                'file_type'    => 'png',
                'file_size'    => '188000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/web-app-manifest-512x512.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('favicon.svg'),
                'file_type'    => 'svg',
                'file_size'    => '183000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.svg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('site.webmanifest'),
                'file_type'    => 'webmanifest',
                'file_size'    => '183000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/site.webmanifest',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-bg-light.webp'),
                'file_type'    => 'webp',
                'file_size'    => '135000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-bg-light.webp',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('wDchsz8nmbo.mp4'),
                'file_type'    => 'mp4',
                'file_size'    => '220000',
                'upload_path'    => 'https://www.youtube.com/watch?v=wDchsz8nmbo',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('sQ22pm-xvrE.mp4'),
                'file_type'    => 'mp4',
                'file_size'    => '220000',
                'upload_path'    => 'https://www.youtube.com/watch?v=sQ22pm-xvrE',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('pexel-video-1.mp4'),
                'file_type'    => 'mp4',
                'file_size'    => '823000',
                'upload_path'  => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-video-1.mp4',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('sample-audio-1.mp3'),
                'file_type'    => 'mp3',
                'file_size'    => '716',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample-audio-1.mp3',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('sample-audio-1.ogg'),
                'file_type'    => 'ogg',
                'file_size'    => '980000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample-audio-1.ogg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-img.svg'),
                'file_type'    => 'svg',
                'file_size'    => '10600',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-img.svg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-carousel-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '325000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-carousel-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '290000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-carousel-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '325000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('skills.png'),
                'file_type'    => 'png',
                'file_size'    => '40700',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/skills.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('why-us.png'),
                'file_type'    => 'png',
                'file_size'    => '85000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/why-us.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hero-img.png'),
                'file_type'    => 'png',
                'file_size'    => '66600',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-img.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('sample.pdf'),
                'file_type'    => 'pdf',
                'file_size'    => '18300',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample.pdf',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('community_garden.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '439000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/community_garden.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('disaster_relief.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '668000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/disaster_relief.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('end_hunger.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '509000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/end_hunger.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            //
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('earbuds.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '264000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('earbuds-case.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '298000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-case.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('earbuds-side.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '419000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-side.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('earbuds-demo.mp4'),
                'file_type'    => 'mp4',
                'file_size'    => '1030000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-demo.mp4',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hat.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '445000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hat_back.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '322000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_back.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hat_closeup.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '36000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_closeup.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('hat_side.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '812000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_side.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('shirt.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '500000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('shirt-closeup.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '304000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-closeup.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('shirt-front.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '444000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-front.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('shirt-side.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '305000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-side.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '284000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker_back.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '422000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_back.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker_closeup.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '559000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_closeup.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker_front.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '385000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_front.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker_side.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '286000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_side.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('speaker_demo.mp4'),
                'file_type'    => 'mp4',
                'file_size'    => '856000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_demo.mp4',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-1.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '128000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-1-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '194000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-2.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '507000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-2-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '722000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-3.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '72000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-3-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '768000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-4.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '121000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-4-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '406000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-5.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '104000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-5-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '467000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-6.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '127000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-6-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '403000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-7.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '62000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-7-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '683000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('type-8-preview.png'),
                'file_type'    => 'jpg',
                'file_size'    => '20000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-8-preview.png',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('resume-profile.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '20000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/resume-profile.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('company-logo.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '8000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/company-logo.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('university-logo.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '13000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-logo.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
            [
                'file_id' => getGUID(),
                'user_id'    => getGUID(getDefaultAdminGUID()),
                'file_name' => getRandomFileName('university-education-logo.jpg'),
                'file_type'    => 'jpg',
                'file_size'    => '24000',
                'upload_path'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-education-logo.jpg',
                'unique_identifier' => generateContentIdentifier("file"),
                'deletable'    => 0
            ],
        ];

        // Using Query Builder
        $this->db->table('file_uploads')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('file_uploads');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Themes extends Migration
{
    public function up()
    {
        // Load the CustomConfig
        $customConfig = config('CustomConfig');

        $this->forge->addField([
            'theme_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'primary_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'secondary_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'background_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_bg_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_bg_video' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_bg_slider_image_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_bg_slider_image_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_bg_slider_image_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'theme_css' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'theme_js' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'footer_copyright' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'sub_category' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'selected' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'override_default_style' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'deletable' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'home_page' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'HomePage', //Options : 'HomePage,Blog,Shop,Portfolio,None'
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
        $this->forge->addKey('theme_id', true);
        $this->forge->createTable('themes');

        //Insert default record
        $data = [
            [
                'theme_id' => getGUID(),
                'name' => 'Default',
                'path' => '/default',
                'primary_color' => '#212529',
                'secondary_color' => '#0d6efd',
                'background_color' => '#f2f7f7',
                'image' => 'public/front-end/themes/default/assets/images/default-theme.png',
                'theme_url' => 'https://startbootstrap.com/previews/modern-business',
                'theme_bg_image' => '',
                'theme_bg_video' => '',
                'theme_bg_slider_image_1' => '',
                'theme_bg_slider_image_2' => '',
                'theme_bg_slider_image_3' => '',
                'theme_css' => "",
                'theme_js' => '',
                'footer_copyright' => "<p>Copyright &copy; Igniter CMS ". date('Y') ."</p>",
                'selected' => false,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['Business'],
                'sub_category' => $customConfig->themeCategories['Portfolio'],
                'deletable' => 0,
                'home_page' => 'HomePage',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'theme_id' => getGUID(),
                'name' => 'GizTech',
                'path' => '/giz-tech',
                'primary_color' => '#212529',
                'secondary_color' => '#0d6efd',
                'background_color' => '#ffffff',
                'image' => 'public/front-end/themes/giz-tech/assets/images/giz-tech-theme.png',
                'theme_url' => 'https://ignitercms.com/themes/giz-tech',
                'theme_bg_image' => '',
                'theme_bg_video' => '',
                'theme_bg_slider_image_1' => 'public/uploads/files/hero-carousel-1.jpg',
                'theme_bg_slider_image_2' => 'public/uploads/files/hero-carousel-2.jpg',
                'theme_bg_slider_image_3' => 'public/uploads/files/hero-carousel-3.jpg',
                'theme_css' => '',
                'theme_js' => '',
                'footer_copyright' => "<p>Copyright &copy; Igniter CMS ". date('Y') ."</p>",
                'selected' => true,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['Business'],
                'sub_category' => $customConfig->themeCategories['Portfolio'],
                'deletable' => 0,
                'home_page' => 'HomePage',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'theme_id' => getGUID(),
                'name' => 'LeRestaurant',
                'path' => '/le-restaurant',
                'primary_color' => '#212529',
                'secondary_color' => '#0d6efd',
                'background_color' => '#444342',
                'image' => 'public/front-end/themes/le-restaurant/assets/images/le-restaurant-theme.png',
                'theme_url' => 'https://ignitercms.com/themes/le-restaurant',
                'theme_bg_image' => 'public/uploads/files/hero-restaurant-1.jpg',
                'theme_bg_video' => '',
                'theme_bg_slider_image_1' => 'public/uploads/files/hero-restaurant-2.jpg',
                'theme_bg_slider_image_2' => 'public/uploads/files/hero-restaurant-3.jpg',
                'theme_bg_slider_image_3' => 'public/uploads/files/hero-restaurant-4.jpg',
                'theme_css' => '',
                'theme_js' => '',
                'footer_copyright' => "<div class='col-md-6'><p class='mb-0'>&copy; ". date('Y') ." Le-Restaurant Restaurant. All rights reserved.</p></div><div class='col-md-6 text-md-end'><p class='mb-0'>Designed with <i class='bi bi-heart-fill text-danger'></i> using Igniter CMS</p>",
                'selected' => false,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['Restaurant'],
                'sub_category' => $customConfig->themeCategories['Business'],
                'deletable' => 0,
                'home_page' => 'HomePage',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'theme_id' => getGUID(),
                'name' => 'BizNews',
                'path' => '/biz-news',
                'primary_color' => '#0d6efd',
                'secondary_color' => '#6c757d',
                'background_color' => '#ffffff',
                'image' => 'public/front-end/themes/biz-news/assets/images/biz-news-theme.png',
                'theme_url' => 'https://ignitercms.com/themes/biz-news',
                'theme_bg_image' => '',
                'theme_bg_video' => '',
                'theme_bg_slider_image_1' => '',
                'theme_bg_slider_image_2' => '',
                'theme_bg_slider_image_3' => '',
                'theme_css' => '',
                'theme_js' => '',
                'footer_copyright' => "<p>Copyright &copy; Igniter CMS ". date('Y') ."</p>",
                'selected' => false,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['News'],
                'sub_category' => $customConfig->themeCategories['Entertainment'],
                'deletable' => 0,
                'home_page' => 'Blog',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'theme_id' => getGUID(),
                'name' => 'EmFolio',
                'path' => '/em-folio',
                'primary_color' => '#6366f1',
                'secondary_color' => '#8b5cf6',
                'background_color' => '#06b6d4',
                'image' => 'public/front-end/themes/em-folio/assets/images/em-folio-theme.png',
                'theme_url' => 'https://ignitercms.com/themes/em-folio',
                'theme_bg_image' => '',
                'theme_bg_video' => '',
                'theme_bg_slider_image_1' => '',
                'theme_bg_slider_image_2' => '',
                'theme_bg_slider_image_3' => '',
                'theme_css' => '',
                'theme_js' => '',
                'footer_copyright' => "<div class='col-md-6'><p>&copy; ". date('Y') ." Igniter CMS. All rights reserved.</p></div><div class='col-md-6 text-md-end'><p>Built with <i class='ri-heart-fill text-danger'></i> using Igniter CMS</p></div>",
                'selected' => false,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['News'],
                'sub_category' => $customConfig->themeCategories['Entertainment'],
                'deletable' => 0,
                'home_page' => 'Portfolio',
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
        ];

        // Using Query Builder
        $this->db->table('themes')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('themes');
    }
}

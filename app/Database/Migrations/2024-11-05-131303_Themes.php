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
            'other_color' => [
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
                'other_color' => '#444342',
                'image' => 'public/front-end/themes/default/assets/images/default-theme.png',
                'theme_url' => 'https://startbootstrap.com/previews/modern-business',
                'theme_bg_image' => '',
                'theme_bg_video' => '',
                'footer_copyright' => "<p>Copyright &copy; Igniter CMS ". date('Y') ."</p>",
                'selected' => true,
                'category' => $customConfig->themeCategories['BusinessCorporate'],
                'sub_category' => $customConfig->themeCategories['PortfolioResume'],
                'deletable' => 0,
                'home_page' => 'HomePage',
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

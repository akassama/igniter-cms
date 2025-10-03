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
            'default_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'heading_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'accent_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'surface_color' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'contrast_color' => [
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
                'default_color' => '#6c757d',
                'heading_color' => '#212529',
                'accent_color' => '#0d6efd',
                'surface_color' => '#f8f9fa',
                'contrast_color' => '#0d6efd',
                'background_color' => '#ffffff',
                'image' => 'public/front-end/themes/default/assets/images/preview.png',
                'theme_url' => 'https://themes.ignitercms.com/demo/Default/',
                'selected' => true,
                'override_default_style' => false,
                'category' => $customConfig->themeCategories['Business'],
                'sub_category' => $customConfig->themeCategories['Agency'],
                'deletable' => 0,
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

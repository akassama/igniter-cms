<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Galleries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'gallery_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'caption' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'category_filter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'default' => 'gallery',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'status' => [
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
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('gallery_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('title');

        $this->forge->createTable('galleries');

        //insert default records
        //----------------------
        $data = [
            [
                'gallery_id' => getGUID(),
                'title' => 'Sunset Over the Ocean',
                'caption' => 'A breathtaking view of the sun dipping below the horizon, casting vibrant colors across the sky and sea.',
                'category_filter' => 'nature',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-1.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
            [
                'gallery_id' => getGUID(),
                'title' => 'Urban Night Lights',
                'caption' => 'The city comes alive after dark, with dazzling lights illuminating the towering buildings and bustling streets.',
                'category_filter' => 'cityscape',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-2.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
            [
                'gallery_id' => getGUID(),
                'title' => 'Mountain Majesty',
                'caption' => 'Snow-capped peaks pierce the clouds, showcasing the raw and majestic beauty of the mountains.',
                'category_filter' => 'landscape',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-3.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
            [
                'gallery_id' => getGUID(),
                'title' => 'Serene Forest Path',
                'caption' => 'A tranquil path winding through a lush green forest, inviting a sense of peace and exploration.',
                'category_filter' => 'nature',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-4.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
            [
                'gallery_id' => getGUID(),
                'title' => 'Abstract Art Colors',
                'caption' => 'A vibrant explosion of colors and shapes, creating a captivating and thought-provoking abstract composition.',
                'category_filter' => 'abstract',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-5.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
            [
                'gallery_id' => getGUID(),
                'title' => 'Historic Architecture',
                'caption' => 'An intricate facade of an old building, telling stories of history and craftsmanship.',
                'category_filter' => 'architecture',
                'group' => 'gallery',
                'image' => 'public/uploads/files/gallery-6.jpg',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
            ],
        ];

        // Using Query Builder
        $this->db->table('galleries')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('galleries');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'parent' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'default' => 10,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('category_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('title');
        $this->forge->addKey('description');

        $this->forge->createTable('product_categories');
        
        //Insert default record
        $data = [
            [
                'category_id' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"),
                'title'    => 'Apparel and Accessories',
                'description'    => 'Apparel and Accessories category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'apparel-accessories',
                'new_tab'    => false,
                'order'    => 2,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"),
                'title'    => 'Electronics',
                'description'    => 'Electronics category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'electronics',
                'new_tab'    => false,
                'order'    => 2,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"),
                'title'    => 'Beauty and Personal Care',
                'description'    => 'Beauty and Personal Care category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'beauty-personal-care',
                'new_tab'    => false,
                'order'    => 6,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("973e30cb-26e5-4fc2-bb12-d5750420f080"),
                'title'    => 'Books, Music, and Movies',
                'description'    => 'Books, Music, and Movies category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'books-music-movies',
                'new_tab'    => false,
                'order'    => 8,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"),
                'title'    => 'Health and Wellness',
                'description'    => 'Health and Wellness category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'health-wellness',
                'new_tab'    => false,
                'order'    => 10,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'category_id' => getGUID("abc9387d-dfbf-49cc-8781-f1e6de69d41d"),
                'title'    => 'Home Goods and Furniture',
                'description'    => 'Home Goods and Furniture category',
                'group'    => null,
                'parent'    => null,
                'link'    => 'home-goods-furniture',
                'new_tab'    => false,
                'order'    => 12,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
        ];

        // Using Query Builder
        $this->db->table('product_categories')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('product_categories');
    }    
}

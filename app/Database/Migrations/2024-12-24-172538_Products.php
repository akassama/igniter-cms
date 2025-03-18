<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
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
            'short_description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            'sub_category' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'brand' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'model' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'sale_price' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'price_note' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'featured_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'product_image_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'product_image_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'product_image_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'product_image_4' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'product_video' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'is_featured' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'specifications' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'attributes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'seller_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'purchase_options' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tags' => [
                'type' => 'TEXT',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
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
        $this->forge->addKey('product_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('slug');
        $this->forge->addKey('category');

        $this->forge->createTable('products');

        //insert default records
        //----------------------
        $data = [
            [
                'product_id' => getGUID(),
                'title' => 'Stylish Summer Hat',
                'description' => 'A lightweight and stylish summer hat for outdoor activities.',
                'short_description' => 'Stylish summer hat for outdoor fun.',
                'slug' => 'stylish-summer-hat',
                'category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'sub_category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics (example, adjust as needed)
                'brand' => 'FashionBrand',
                'model' => 'HAT123',
                'price' => 19.99,
                'sale_price' => 14.99,
                'currency' => '$',
                'price_note' => 'per piece',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat.jpg',
                'product_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_side.jpg',
                'product_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_back.jpg',
                'product_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_closeup.jpg',
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'size' => 'One Size Fits All',
                    'color' => 'Beige',
                    'material' => 'Straw',
                    'weight' => '200g',
                    'dimensions' => '12x10x5 inches',
                ]),
                'attributes' => json_encode([
                    'features' => ['Breathable', 'Lightweight'],
                    'included_items' => ['Hat'],
                    'warranty' => 'No Warranty',
                    'certifications' => ['Eco-friendly'],
                ]),
                'seller_info' => json_encode([
                    'name' => 'Sunshine Store',
                    'contact_person' => 'Jane Doe',
                    'phone' => '+1234567890',
                    'email' => 'contact@sunshine.com',
                    'location' => 'California, USA',
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/product/?hat',
                        'price' => '19.99',
                        'availability' => 'In Stock',
                    ],
                    [
                        'platform' => 'Official Store',
                        'url' => 'https://sunshine.com/product/?hat',
                        'price' => '14.99',
                        'availability' => 'In Stock',
                    ],
                ]),
                'tags' => 'summer,hat,outdoor',
                'status' => 1,
                'order' => 2,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Stylish Summer Hat - Sunshine Store',
                'meta_description' => 'Lightweight and stylish summer hat, perfect for outdoor activities.',
                'meta_keywords' => 'summer hat, fashion hat, outdoor wear',
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Portable Bluetooth Speaker',
                'description' => 'Compact and powerful Bluetooth speaker with excellent sound quality.',
                'short_description' => 'Compact Bluetooth speaker for music on the go.',
                'slug' => 'portable-bluetooth-speaker',
                'category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'sub_category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'brand' => 'SoundMax',
                'model' => 'SPK101',
                'price' => 59.99,
                'sale_price' => null,
                'currency' => '$',
                'price_note' => 'per piece',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker.jpg',
                'product_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_front.jpg',
                'product_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_side.jpg',
                'product_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_back.jpg',
                'product_image_4' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_closeup.jpg',
                'product_video' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_demo.mp4',
                'is_featured' => 1,
                'specifications' => json_encode([
                    'battery_life' => '10 hours',
                    'bluetooth_version' => '5.0',
                    'dimensions' => '5x3x2 inches',
                    'color' => 'Black',
                ]),
                'attributes' => json_encode([
                    'features' => ['Waterproof', 'Dustproof'],
                    'included_items' => ['Charging Cable', 'User Manual'],
                    'warranty' => '1 Year Limited',
                ]),
                'seller_info' => json_encode([
                    'name' => 'TechShop',
                    'contact_person' => 'Mike Smith',
                    'phone' => '+1234567891',
                    'email' => 'sales@techshop.com',
                    'location' => 'New York, USA',
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/product/?speaker',
                        'price' => '59.99',
                        'availability' => 'In Stock',
                    ],
                ]),
                'tags' => 'bluetooth,speaker,music',
                'status' => 1,
                'order' => 4,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Portable Bluetooth Speaker - SoundMax',
                'meta_description' => 'Compact and powerful Bluetooth speaker for music lovers.',
                'meta_keywords' => 'bluetooth speaker, portable speaker, music device',
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Men\'s Casual Shirt',
                'description' => 'High-quality cotton shirt, perfect for casual wear.',
                'short_description' => 'Comfortable casual shirt.',
                'slug' => 'mens-casual-shirt',
                'category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'sub_category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"),
                'brand' => 'BrandX',
                'model' => 'Model123',
                'price' => 49.99,
                'sale_price' => 39.99,
                'currency' => '$',
                'price_note' => 'per piece',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt.jpg',
                'product_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-front.jpg',
                'product_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-side.jpg',
                'product_image_3' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-closeup.jpg',
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'size' => 'M',
                    'color' => 'Blue',
                    'material' => 'Cotton',
                ]),
                'attributes' => json_encode([
                    'features' => ['Wrinkle-resistant', 'Breathable'],
                    'included_items' => ['Shirt', 'Tag'],
                ]),
                'seller_info' => json_encode([
                    'name' => 'Clothing Hub',
                    'contact_person' => 'Jane Doe',
                    'phone' => '+123456789',
                    'email' => 'sales@clothinghub.com',
                    'location' => 'New York, USA',
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/?mens-shirt',
                        'price' => '39.99',
                        'availability' => 'In Stock',
                    ],
                    [
                        'platform' => 'Etsy',
                        'url' => 'https://etsy.com/?mens-shirt',
                        'price' => '44.99',
                        'availability' => '2-3 days',
                    ],
                ]),
                'tags' => 'shirt, casual, blue',
                'status' => 1,
                'order' => 6,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Men\'s Casual Shirt - Blue',
                'meta_description' => 'Buy Men\'s Casual Shirt in Blue for casual wear.',
                'meta_keywords' => 'shirt, men, casual, blue',
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Wireless Bluetooth Earbuds',
                'description' => 'High-quality Bluetooth earbuds with noise cancellation.',
                'short_description' => 'Bluetooth earbuds for clear sound.',
                'slug' => 'wireless-bluetooth-earbuds',
                'category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'sub_category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"),
                'brand' => 'AudioTech',
                'model' => 'BT-1000',
                'price' => 79.99,
                'sale_price' => 69.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds.jpg',
                'product_image_1' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-side.jpg',
                'product_image_2' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-case.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-demo.mp4',
                'is_featured' => 1,
                'specifications' => json_encode([
                    'battery_life' => '12 hours',
                    'connectivity' => 'Bluetooth 5.0',
                    'weight' => '50g',
                ]),
                'attributes' => json_encode([
                    'features' => ['Noise Cancellation', 'Water-resistant'],
                    'included_items' => ['Earbuds', 'Charging Case', 'Manual'],
                    'warranty' => '1 Year',
                ]),
                'seller_info' => json_encode([
                    'name' => 'ElectroMart',
                    'contact_person' => 'John Smith',
                    'phone' => '+987654321',
                    'email' => 'info@electromart.com',
                    'location' => 'Los Angeles, USA',
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Best Buy',
                        'url' => 'https://bestbuy.com/?earbuds',
                        'price' => '79.99',
                        'availability' => 'In Stock',
                    ],
                ]),
                'tags' => 'earbuds, bluetooth, wireless',
                'status' => 1,
                'order' => 8,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Wireless Bluetooth Earbuds',
                'meta_description' => 'Experience crystal-clear sound with our wireless earbuds.',
                'meta_keywords' => 'earbuds, bluetooth, wireless',
            ],
        ];

        // Using Query Builder
        $this->db->table('products')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

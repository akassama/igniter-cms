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
                'constraint' => '1000',
                'null' => true,
                'default' => null,
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
                'featured_image' => 'public/uploads/files/hat.jpg',
                'product_image_1' => 'public/uploads/files/hat_side.jpg',
                'product_image_2' => 'public/uploads/files/hat_back.jpg',
                'product_image_3' => 'public/uploads/files/hat_closeup.jpg',
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
                'featured_image' => 'public/uploads/files/speaker.jpg',
                'product_image_1' => 'public/uploads/files/speaker_front.jpg',
                'product_image_2' => 'public/uploads/files/speaker_side.jpg',
                'product_image_3' => 'public/uploads/files/speaker_back.jpg',
                'product_image_4' => 'public/uploads/files/speaker_closeup.jpg',
                'product_video' => 'public/uploads/files/speaker_demo.mp4',
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
                'featured_image' => 'public/uploads/files/shirt.jpg',
                'product_image_1' => 'public/uploads/files/shirt-front.jpg',
                'product_image_2' => 'public/uploads/files/shirt-side.jpg',
                'product_image_3' => 'public/uploads/files/shirt-closeup.jpg',
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
                'featured_image' => 'public/uploads/files/earbuds.jpg',
                'product_image_1' => 'public/uploads/files/earbuds-side.jpg',
                'product_image_2' => 'public/uploads/files/earbuds-case.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => 'public/uploads/files/earbuds-demo.mp4',
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
            [
                'product_id' => getGUID(),
                'title' => 'Yoga Mat',
                'description' => 'Premium non-slip yoga mat with carrying strap, perfect for all types of yoga practice.',
                'short_description' => 'High-quality non-slip yoga mat.',
                'slug' => 'premium-yoga-mat',
                'category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'sub_category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'brand' => 'YogaLife',
                'model' => 'YM2023',
                'price' => 29.99,
                'sale_price' => 24.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/yogamat.jpg',
                'product_image_1' => 'public/uploads/files/yogamat_rolled.jpg',
                'product_image_2' => 'public/uploads/files/yogamat_texture.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 0,
                'specifications' => json_encode([
                    'material' => 'Eco-friendly TPE',
                    'thickness' => '6mm',
                    'length' => '72 inches',
                    'width' => '24 inches',
                    'weight' => '2.2 lbs',
                    'color' => 'Purple'
                ]),
                'attributes' => json_encode([
                    'features' => ['Non-slip', 'Eco-friendly', 'Lightweight'],
                    'included_items' => ['Yoga Mat', 'Carrying Strap'],
                    'warranty' => '6 months'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Fitness Gear',
                    'contact_person' => 'Sarah Johnson',
                    'phone' => '+1555123456',
                    'email' => 'support@fitnessgear.com',
                    'location' => 'Chicago, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/yogamat',
                        'price' => '29.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'yoga,mat,fitness,exercise',
                'status' => 1,
                'order' => 10,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Premium Yoga Mat - YogaLife',
                'meta_description' => 'High-quality non-slip yoga mat for all your fitness needs.',
                'meta_keywords' => 'yoga mat, fitness, exercise equipment'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Stainless Steel Water Bottle',
                'description' => 'Insulated stainless steel water bottle that keeps drinks cold for 24 hours or hot for 12 hours.',
                'short_description' => 'Premium insulated water bottle.',
                'slug' => 'stainless-steel-water-bottle',
                'category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'sub_category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'brand' => 'HydroFlask',
                'model' => 'HF500',
                'price' => 39.99,
                'sale_price' => 34.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/waterbottle.jpg',
                'product_image_1' => 'public/uploads/files/waterbottle_open.jpg',
                'product_image_2' => 'public/uploads/files/waterbottle_cap.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'capacity' => '32 oz',
                    'material' => '18/8 Stainless Steel',
                    'height' => '10.5 inches',
                    'diameter' => '3 inches',
                    'weight' => '1.2 lbs',
                    'color' => 'Matte Black'
                ]),
                'attributes' => json_encode([
                    'features' => ['BPA-free', 'Leak-proof', 'Double-walled insulation'],
                    'included_items' => ['Water Bottle', 'Flip Lid'],
                    'warranty' => 'Lifetime'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Outdoor Gear',
                    'contact_person' => 'Mike Thompson',
                    'phone' => '+1555234567',
                    'email' => 'sales@outdoorgear.com',
                    'location' => 'Denver, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'REI',
                        'url' => 'https://rei.com/waterbottle',
                        'price' => '39.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/waterbottle',
                        'price' => '34.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'water,bottle,hydration,outdoor',
                'status' => 1,
                'order' => 12,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Insulated Water Bottle - HydroFlask',
                'meta_description' => 'Premium stainless steel water bottle that keeps your drinks at the perfect temperature.',
                'meta_keywords' => 'water bottle, insulated, stainless steel'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Wireless Charging Pad',
                'description' => 'Qi-certified wireless charging pad compatible with all Qi-enabled smartphones.',
                'short_description' => 'Fast wireless charger for smartphones.',
                'slug' => 'wireless-charging-pad',
                'category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'sub_category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Electronics subcategory
                'brand' => 'ChargeTech',
                'model' => 'WC-100',
                'price' => 24.99,
                'sale_price' => 19.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/wirelesscharger.jpg',
                'product_image_1' => 'public/uploads/files/wirelesscharger_side.jpg',
                'product_image_2' => 'public/uploads/files/wirelesscharger_phone.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 0,
                'specifications' => json_encode([
                    'output' => '10W',
                    'input' => '5V/2A',
                    'compatibility' => 'Qi-enabled devices',
                    'color' => 'White',
                    'dimensions' => '3.5 x 3.5 x 0.5 inches'
                ]),
                'attributes' => json_encode([
                    'features' => ['Fast charging', 'LED indicator', 'Overheat protection'],
                    'included_items' => ['Charging Pad', 'USB Cable'],
                    'warranty' => '1 year'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Tech Accessories',
                    'contact_person' => 'David Chen',
                    'phone' => '+1555345678',
                    'email' => 'info@techaccessories.com',
                    'location' => 'San Francisco, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Best Buy',
                        'url' => 'https://bestbuy.com/wirelesscharger',
                        'price' => '24.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'wireless,charger,phone,accessory',
                'status' => 1,
                'order' => 14,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Qi Wireless Charging Pad - ChargeTech',
                'meta_description' => 'Fast wireless charging pad compatible with all Qi-enabled smartphones.',
                'meta_keywords' => 'wireless charger, phone accessory, qi charger'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Organic Cotton T-Shirt',
                'description' => '100% organic cotton t-shirt, ethically made and environmentally friendly.',
                'short_description' => 'Sustainable organic cotton t-shirt.',
                'slug' => 'organic-cotton-tshirt',
                'category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'sub_category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'brand' => 'EcoWear',
                'model' => 'OC100',
                'price' => 29.99,
                'sale_price' => null,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/tshirt.jpg',
                'product_image_1' => 'public/uploads/files/tshirt_back.jpg',
                'product_image_2' => 'public/uploads/files/tshirt_detail.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'material' => '100% Organic Cotton',
                    'sizes' => 'S, M, L, XL',
                    'color' => 'Natural',
                    'weight' => '180 gsm',
                    'origin' => 'USA'
                ]),
                'attributes' => json_encode([
                    'features' => ['Breathable', 'Hypoallergenic', 'Sustainable'],
                    'care_instructions' => 'Machine wash cold, tumble dry low',
                    'certifications' => ['GOTS Certified', 'OEKO-TEX Standard 100']
                ]),
                'seller_info' => json_encode([
                    'name' => 'Sustainable Apparel',
                    'contact_person' => 'Emily Wilson',
                    'phone' => '+1555456789',
                    'email' => 'hello@sustainableapparel.com',
                    'location' => 'Portland, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Our Website',
                        'url' => 'https://sustainableapparel.com/tshirt',
                        'price' => '29.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'tshirt,organic,cotton,sustainable',
                'status' => 1,
                'order' => 16,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Organic Cotton T-Shirt - EcoWear',
                'meta_description' => 'Sustainable and ethically made organic cotton t-shirt.',
                'meta_keywords' => 'organic tshirt, sustainable fashion, cotton shirt'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Digital Kitchen Scale',
                'description' => 'Precision digital kitchen scale with LCD display, perfect for baking and cooking.',
                'short_description' => 'Accurate digital kitchen scale.',
                'slug' => 'digital-kitchen-scale',
                'category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Home and Kitchen
                'sub_category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'brand' => 'PrecisionChef',
                'model' => 'KS-500',
                'price' => 22.99,
                'sale_price' => 18.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/kitchenscale.jpg',
                'product_image_1' => 'public/uploads/files/kitchenscale_measure.jpg',
                'product_image_2' => 'public/uploads/files/kitchenscale_units.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 0,
                'specifications' => json_encode([
                    'capacity' => '11 lbs (5 kg)',
                    'increments' => '0.1 oz / 1 g',
                    'units' => 'g, oz, lb, ml',
                    'power' => '2 AAA batteries (included)',
                    'platform_size' => '7 x 6 inches'
                ]),
                'attributes' => json_encode([
                    'features' => ['Tare function', 'Auto-off', 'Easy to clean'],
                    'included_items' => ['Scale', 'Batteries'],
                    'warranty' => '2 years'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Kitchen Essentials',
                    'contact_person' => 'Robert Brown',
                    'phone' => '+1555567890',
                    'email' => 'support@kitchenessentials.com',
                    'location' => 'Seattle, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/kitchenscale',
                        'price' => '22.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Walmart',
                        'url' => 'https://walmart.com/kitchenscale',
                        'price' => '18.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'scale,kitchen,cooking,baking',
                'status' => 1,
                'order' => 18,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Digital Kitchen Scale - PrecisionChef',
                'meta_description' => 'Precision digital scale for accurate measurements in cooking and baking.',
                'meta_keywords' => 'kitchen scale, digital scale, cooking scale'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Noise Cancelling Headphones',
                'description' => 'Premium over-ear headphones with active noise cancellation and 30-hour battery life.',
                'short_description' => 'High-quality noise cancelling headphones.',
                'slug' => 'noise-cancelling-headphones',
                'category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'sub_category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Electronics subcategory
                'brand' => 'AudioPro',
                'model' => 'NC-700',
                'price' => 199.99,
                'sale_price' => 179.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/headphones.jpg',
                'product_image_1' => 'public/uploads/files/headphones_case.jpg',
                'product_image_2' => 'public/uploads/files/headphones_folded.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => 'public/uploads/files/headphones_demo.mp4',
                'is_featured' => 1,
                'specifications' => json_encode([
                    'battery_life' => '30 hours (ANC on)',
                    'bluetooth' => '5.0',
                    'weight' => '9.2 oz',
                    'impedance' => '32 ohms',
                    'frequency_response' => '20Hz-20kHz'
                ]),
                'attributes' => json_encode([
                    'features' => ['Active Noise Cancellation', 'Built-in mic', 'Touch controls'],
                    'included_items' => ['Headphones', 'Carrying Case', 'Audio Cable'],
                    'warranty' => '1 year'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Audio Haven',
                    'contact_person' => 'James Wilson',
                    'phone' => '+1555678901',
                    'email' => 'sales@audiohaven.com',
                    'location' => 'Austin, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Best Buy',
                        'url' => 'https://bestbuy.com/headphones',
                        'price' => '199.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/headphones',
                        'price' => '179.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'headphones,audio,noise cancellation',
                'status' => 1,
                'order' => 20,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Noise Cancelling Headphones - AudioPro',
                'meta_description' => 'Premium over-ear headphones with active noise cancellation technology.',
                'meta_keywords' => 'headphones, noise cancelling, audio'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Smart LED Light Bulb',
                'description' => 'WiFi enabled smart LED bulb with adjustable color temperature and brightness, compatible with Alexa and Google Home.',
                'short_description' => 'Smart bulb with voice control.',
                'slug' => 'smart-led-light-bulb',
                'category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'sub_category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Electronics subcategory
                'brand' => 'SmartHome',
                'model' => 'SL-100',
                'price' => 24.99,
                'sale_price' => 19.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/smartbulb.jpg',
                'product_image_1' => 'public/uploads/files/smartbulb_colors.jpg',
                'product_image_2' => 'public/uploads/files/smartbulb_app.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 0,
                'specifications' => json_encode([
                    'wattage' => '9W (60W equivalent)',
                    'lumens' => '800',
                    'color_temp' => '2700K-6500K',
                    'life_span' => '25,000 hours',
                    'base_type' => 'E26'
                ]),
                'attributes' => json_encode([
                    'features' => ['Dimmable', 'Voice control', 'Energy efficient'],
                    'compatibility' => ['Alexa', 'Google Home', 'SmartThings'],
                    'warranty' => '2 years'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Smart Home Solutions',
                    'contact_person' => 'Lisa Zhang',
                    'phone' => '+1555789012',
                    'email' => 'info@smarthomesolutions.com',
                    'location' => 'San Diego, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/smartbulb',
                        'price' => '19.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'smart,bulb,lighting,home automation',
                'status' => 1,
                'order' => 22,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Smart LED Light Bulb - SmartHome',
                'meta_description' => 'Voice-controlled smart LED bulb with adjustable color and brightness.',
                'meta_keywords' => 'smart bulb, led, home automation'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Stainless Steel Cookware Set',
                'description' => '10-piece stainless steel cookware set with induction-compatible bottoms and tempered glass lids.',
                'short_description' => 'Premium stainless steel cookware set.',
                'slug' => 'stainless-steel-cookware-set',
                'category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Home and Kitchen
                'sub_category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'brand' => 'ChefSelect',
                'model' => 'CS-1000',
                'price' => 249.99,
                'sale_price' => 199.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/cookware.jpg',
                'product_image_1' => 'public/uploads/files/cookware_pieces.jpg',
                'product_image_2' => 'public/uploads/files/cookware_detail.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'material' => '18/10 Stainless Steel',
                    'pieces' => '10 (1.5qt saucepan, 3qt saucepan, 5qt Dutch oven, 8qt stockpot, 3 lids, 2 utensils)',
                    'compatibility' => 'Gas, electric, induction',
                    'dishwasher_safe' => 'Yes',
                    'oven_safe' => 'Yes (up to 500°F)'
                ]),
                'attributes' => json_encode([
                    'features' => ['Even heat distribution', 'Durable construction', 'Stay-cool handles'],
                    'included_items' => ['All cookware pieces', 'User manual'],
                    'warranty' => 'Lifetime'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Kitchen Warehouse',
                    'contact_person' => 'Michael Johnson',
                    'phone' => '+1555890123',
                    'email' => 'sales@kitchenwarehouse.com',
                    'location' => 'Dallas, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Our Website',
                        'url' => 'https://kitchenwarehouse.com/cookware',
                        'price' => '249.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/cookware',
                        'price' => '199.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'cookware,kitchen,stainless steel,cooking',
                'status' => 1,
                'order' => 24,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Stainless Steel Cookware Set - ChefSelect',
                'meta_description' => 'Premium 10-piece stainless steel cookware set for professional cooking results.',
                'meta_keywords' => 'cookware, stainless steel, kitchen set'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Fitness Tracker Watch',
                'description' => 'Water-resistant fitness tracker with heart rate monitor, sleep tracking, and smartphone notifications.',
                'short_description' => 'Smart fitness tracker with multiple features.',
                'slug' => 'fitness-tracker-watch',
                'category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'sub_category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'brand' => 'FitTrack',
                'model' => 'FT-200',
                'price' => 79.99,
                'sale_price' => 69.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/fitnesstracker.jpg',
                'product_image_1' => 'public/uploads/files/fitnesstracker_screen.jpg',
                'product_image_2' => 'public/uploads/files/fitnesstracker_app.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => 'public/uploads/files/fitnesstracker_demo.mp4',
                'is_featured' => 1,
                'specifications' => json_encode([
                    'display' => 'OLED touchscreen',
                    'battery_life' => '7 days',
                    'water_resistance' => '50 meters',
                    'connectivity' => 'Bluetooth 4.0',
                    'compatibility' => 'iOS & Android'
                ]),
                'attributes' => json_encode([
                    'features' => ['Heart rate monitor', 'Sleep tracking', 'Step counter', 'Calorie tracker'],
                    'included_items' => ['Fitness Tracker', 'Charging Cable', 'User Manual'],
                    'warranty' => '1 year'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Fitness Tech',
                    'contact_person' => 'Jessica Lee',
                    'phone' => '+1555901234',
                    'email' => 'support@fitnesstech.com',
                    'location' => 'Boston, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/fitnesstracker',
                        'price' => '79.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Best Buy',
                        'url' => 'https://bestbuy.com/fitnesstracker',
                        'price' => '69.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'fitness,tracker,watch,health',
                'status' => 1,
                'order' => 26,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Fitness Tracker Watch - FitTrack',
                'meta_description' => 'Track your fitness goals with this advanced fitness tracker watch.',
                'meta_keywords' => 'fitness tracker, smart watch, health monitor'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Ergonomic Office Chair',
                'description' => 'Premium ergonomic office chair with lumbar support, adjustable armrests, and breathable mesh back.',
                'short_description' => 'Comfortable ergonomic chair for long work sessions.',
                'slug' => 'ergonomic-office-chair',
                'category' => getGUID("7d513e35-f9c9-4901-9943-fa6037e3f484"), // Home and Kitchen
                'sub_category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'brand' => 'ComfortPro',
                'model' => 'OC-300',
                'price' => 299.99,
                'sale_price' => 249.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/officechair.jpg',
                'product_image_1' => 'public/uploads/files/officechair_side.jpg',
                'product_image_2' => 'public/uploads/files/officechair_adjustments.jpg',
                'product_image_3' => 'public/uploads/files/officechair_back.jpg',
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'material' => 'Mesh back, PU leather seat',
                    'weight_capacity' => '330 lbs',
                    'adjustments' => 'Seat height, armrests, tilt tension',
                    'dimensions' => '25.5"W x 27"D x 45-49"H',
                    'color' => 'Black'
                ]),
                'attributes' => json_encode([
                    'features' => ['Lumbar support', '360° swivel', 'Smooth-rolling casters'],
                    'assembly_required' => 'Yes (tools included)',
                    'warranty' => '5 years'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Office Solutions',
                    'contact_person' => 'Thomas Wright',
                    'phone' => '+1555012345',
                    'email' => 'sales@officesolutions.com',
                    'location' => 'Chicago, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Our Website',
                        'url' => 'https://officesolutions.com/chair',
                        'price' => '299.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/officechair',
                        'price' => '249.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'office,chair,ergonomic,furniture',
                'status' => 1,
                'order' => 28,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Ergonomic Office Chair - ComfortPro',
                'meta_description' => 'Premium ergonomic chair designed for all-day comfort and support.',
                'meta_keywords' => 'office chair, ergonomic, work from home'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Electric Toothbrush',
                'description' => 'Advanced electric toothbrush with 3 cleaning modes, pressure sensor, and 2-week battery life.',
                'short_description' => 'Professional-grade electric toothbrush.',
                'slug' => 'electric-toothbrush',
                'category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'sub_category' => getGUID("e2a2fc13-31da-4a4b-84fe-dfc5068d9faf"), // Electronics
                'brand' => 'OralCare',
                'model' => 'ET-500',
                'price' => 89.99,
                'sale_price' => 69.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/toothbrush.jpg',
                'product_image_1' => 'public/uploads/files/toothbrush_modes.jpg',
                'product_image_2' => 'public/uploads/files/toothbrush_charging.jpg',
                'product_image_3' => null,
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 0,
                'specifications' => json_encode([
                    'modes' => 'Clean, White, Sensitive',
                    'battery' => 'Lithium-ion (2 weeks per charge)',
                    'brush_head' => 'Replaceable (included)',
                    'timer' => '2-minute with 30-second intervals',
                    'color' => 'Blue'
                ]),
                'attributes' => json_encode([
                    'features' => ['Pressure sensor', 'Waterproof', 'Travel case included'],
                    'included_items' => ['Toothbrush', 'Brush head', 'Charger', 'Travel case'],
                    'warranty' => '2 years'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Dental Health',
                    'contact_person' => 'Dr. Sarah Miller',
                    'phone' => '+1555123456',
                    'email' => 'info@dentalhealth.com',
                    'location' => 'New York, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Amazon',
                        'url' => 'https://amazon.com/electrictoothbrush',
                        'price' => '89.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'Walmart',
                        'url' => 'https://walmart.com/electrictoothbrush',
                        'price' => '69.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'toothbrush,electric,dental,health',
                'status' => 1,
                'order' => 30,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Electric Toothbrush - OralCare',
                'meta_description' => 'Professional electric toothbrush with multiple cleaning modes for optimal dental care.',
                'meta_keywords' => 'electric toothbrush, dental care, oral health'
            ],
            [
                'product_id' => getGUID(),
                'title' => 'Compact Travel Backpack',
                'description' => 'Lightweight anti-theft travel backpack with USB charging port and multiple compartments.',
                'short_description' => 'Secure and functional travel backpack.',
                'slug' => 'compact-travel-backpack',
                'category' => getGUID("bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64"), // Apparel and Accessories
                'sub_category' => getGUID("80585a47-1cc3-4a63-901b-7670708f0040"), // Health and Wellness
                'brand' => 'TravelGear',
                'model' => 'TB-200',
                'price' => 59.99,
                'sale_price' => 49.99,
                'currency' => '$',
                'price_note' => null,
                'featured_image' => 'public/uploads/files/backpack.jpg',
                'product_image_1' => 'public/uploads/files/backpack_compartments.jpg',
                'product_image_2' => 'public/uploads/files/backpack_usb.jpg',
                'product_image_3' => 'public/uploads/files/backpack_wearing.jpg',
                'product_image_4' => null,
                'product_video' => null,
                'is_featured' => 1,
                'specifications' => json_encode([
                    'capacity' => '25L',
                    'material' => 'Water-resistant polyester',
                    'dimensions' => '18" x 12" x 7"',
                    'weight' => '1.5 lbs',
                    'color' => 'Charcoal gray'
                ]),
                'attributes' => json_encode([
                    'features' => ['Hidden zippers', 'USB port', 'Padded laptop compartment', 'Water bottle pocket'],
                    'compatibility' => 'Fits up to 15" laptop',
                    'warranty' => '1 year'
                ]),
                'seller_info' => json_encode([
                    'name' => 'Adventure Gear',
                    'contact_person' => 'Alex Carter',
                    'phone' => '+1555234567',
                    'email' => 'support@adventuregear.com',
                    'location' => 'Denver, USA'
                ]),
                'purchase_options' => json_encode([
                    [
                        'platform' => 'Our Website',
                        'url' => 'https://adventuregear.com/backpack',
                        'price' => '59.99',
                        'availability' => 'In Stock'
                    ],
                    [
                        'platform' => 'REI',
                        'url' => 'https://rei.com/travelbackpack',
                        'price' => '49.99',
                        'availability' => 'In Stock'
                    ]
                ]),
                'tags' => 'backpack,travel,anti-theft,usb',
                'status' => 1,
                'order' => 32,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Compact Travel Backpack - TravelGear',
                'meta_description' => 'Secure and functional anti-theft backpack perfect for travel and daily commute.',
                'meta_keywords' => 'travel backpack, anti-theft, usb charging'
            ]
        ];

        // Using Query Builder
        $this->db->table('products')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pricings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pricing_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'amount' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'period' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_popular' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'included_features_list' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'excluded_features_list' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'link_title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
            'order' => [
                'type' => 'INT',
                'default' => 10,
                'null' => true,
            ],
            'other_label' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addKey('pricing_id', true);
        $this->forge->createTable('pricings');

        //insert default records
        //----------------------
        $data = [
                    [
                        'pricing_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa6'),
                        'title' => 'Basic Plan',
                        'description' => 'A starter plan for individuals looking to explore our services.',
                        'currency' => '$',
                        'amount' => 9,
                        'period' => 'mo.',
                        'is_popular' => false,
                        'included_features_list' => 'Access to basic features, Email support, Community forums',
                        'excluded_features_list' => 'No customizations, Limited storage, No priority support',
                        'link_title' => 'Choose Basic',
                        'link' => '#choose-basic',
                        'new_tab' => true,
                        'order' => 2,
                        'other_label' => 'Best for individuals',
                        'created_by'    => getGUID(getDefaultAdminGUID()),
                        'updated_by'    => null
                    ],
                    [
                        'pricing_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa7'),
                        'title' => 'Pro Plan',
                        'description' => 'An advanced plan for professionals who need more features.',
                        'currency' => '$',
                        'amount' => 29,
                        'period' => 'mo.',
                        'is_popular' => true,
                        'included_features_list' => 'Access to all features, Priority email support, Increased storage, Customizations',
                        'excluded_features_list' => 'No phone support, No dedicated account manager',
                        'link_title' => 'Choose Pro',
                        'link' => '#choose-pro',
                        'new_tab' => true,
                        'order' => 4,
                        'other_label' => 'Most popular',
                        'created_by'    => getGUID(getDefaultAdminGUID()),
                        'updated_by'    => null
                    ],
                    [
                        'pricing_id' => getGUID('3fa85f64-5717-4562-b3fc-2c963f66afa8'),
                        'title' => 'Enterprise Plan',
                        'description' => 'A comprehensive plan for businesses that require advanced capabilities.',
                        'currency' => '$',
                        'amount' => 99,
                        'period' => 'mo.',
                        'is_popular' => false,
                        'included_features_list' => 'All Pro features, Dedicated account manager, Phone support, Unlimited storage',
                        'excluded_features_list' => 'No free trials',
                        'link_title' => 'Contact Sales',
                        'link' => '#contact-sales',
                        'new_tab' => true,
                        'order' => 6,
                        'other_label' => 'Best for businesses',
                        'created_by'    => getGUID(getDefaultAdminGUID()),
                        'updated_by'    => null
                    ]
                ];

        // Using Query Builder
        $this->db->table('pricings')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('pricings');
    }
}
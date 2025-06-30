<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DonationCauses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'donation_cause_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'content' => [
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
            'embedded_page_title' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'embedded_page' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('donation_cause_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('slug');
        $this->forge->createTable('donation_causes');

        //insert default records
        //----------------------
        $data = [
            [
                'donation_cause_id' => getGUID(),
                'title' => 'Plant a Seed of Hope: Support Urban Gardening',
                'description' => 'Help us create community gardens that provide fresh food and green spaces.',
                'slug' => 'urban-gardening-initiative',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/community_garden.jpg',
                'content' => '<p>Join us in cultivating a greener future! Your donation will help us establish and maintain urban gardens that offer access to fresh produce and foster a sense of community.</p>',
                'link_title' => 'Donate Now',
                'link' => 'https://seedofhope.org.uk/',
                'new_tab' => true,
                'embedded_page_title' => 'Donate and Make an Impact',
                'embedded_page' => '<script async src="https://donorbox.org/widget.js" paypalExpress="false"></script><iframe src="https://donorbox.org/embed/support-gexpotech?language=en-us" name="donorbox" allowpaymentrequest="allowpaymentrequest" seamless="seamless" frameborder="0" scrolling="no" height="900px" width="100%" style="max-width: 500px; min-width: 250px; max-height:none!important" allow="payment"></iframe>',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Plant a Seed of Hope : Support Urban Gardening',
                'meta_description' => 'Help create community gardens that provide fresh food and green spaces.',
                'meta_keywords' => 'urban gardening, community gardens, food access, environmental sustainability, donations'
            ],
            [
                'donation_cause_id' => getGUID(),
                'title' => 'Emergency Relief Fund : Supporting Disaster Victims',
                'description' => 'Provide critical aid to those affected by natural disasters.',
                'slug' => 'disaster-relief-fund',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/disaster_relief.jpg',
                'content' => '<p>In times of crisis, your support can make a real difference. Please consider donating to our Emergency Relief Fund to help those affected by natural disasters.</p>',
                'link_title' => 'Donate Now',
                'link' => 'https://shelterbox.org/',
                'new_tab' => true,
                'embedded_page_title' => 'How Your Donations Help',
                'embedded_page' => 'https://shelterbox.org/donate/',
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Emergency Relief Fund : Support Disaster Victims',
                'meta_description' => 'Provide critical aid to those affected by natural disasters.',
                'meta_keywords' => 'disaster relief, emergency aid, natural disasters, humanitarian aid, donations'
            ],
            [
                'donation_cause_id' => getGUID(),
                'title' => 'End Child Hunger in Our Community',
                'description' => 'Provide nutritious meals to children facing food insecurity.',
                'slug' => 'end-child-hunger',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/end_hunger.jpg',
                'content' => '<p>Childhood hunger is a serious issue in our community. Your donation will help provide meals to children who may otherwise go hungry.</p>',
                'link_title' => 'Donate Now',
                'link' => 'https://www.savethechildren.org.uk/',
                'new_tab' => true,
                'embedded_page_title' => null,
                'embedded_page' => null,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'End Child Hunger : Donate Today',
                'meta_description' => 'Support our mission to provide meals for children in need.',
                'meta_keywords' => 'child hunger, food insecurity, food bank, donations, charity'
            ],
        ];

        // Using Query Builder
        $this->db->table('donation_causes')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('donation_causes');
    }
}

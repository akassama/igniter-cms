<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AppointmentsModel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'appointment_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'appointment_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'embed_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'embed_script' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'widget_height' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'widget_min_width' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
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
            'total_views' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'meta_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addKey('appointment_id');
        $this->forge->createTable('appointments', true); 

        //insert default records
        //----------------------
        $data = [
            [
                'appointment_id' => getGUID("ebea6d8b-9544-4647-88cf-bb46cc80974f"),
                'title' => '30-Min Intro Call',
                'description' => 'A brief introductory meeting to understand your needs',
                'image' => 'public/uploads/files/appointment-1.jpg',
                'slug' => 'intro-call-calendly',
                'appointment_type' => 'calendly',
                'embed_url' => 'https://calendly.com/developerkassama/30min',
                'embed_script' => '<!-- Calendly inline widget begin --><div class="calendly-inline-widget" data-url="https://calendly.com/developerkassama/30min" style="min-width:320px;height:700px;"></div><script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script><!-- Calendly inline widget end -->',
                'widget_height' => 700,
                'widget_min_width' => 320,
                'status' => 1,
                'total_views' => 0,
                'meta_title' => 'Free 30-Min Igniter CMS App Intro Call ',
                'meta_description' => 'Book your free 30-min intro call with Igniter CMS App! Discover how our platform can boost your website\'s performance & simplify content management. ',
                'meta_keywords' => 'intro call, discovery call, consultation, 30 minute call, quick chat ',
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
        ];

        // Using Query Builder
        $this->db->table('appointments')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('appointments');
    }
}
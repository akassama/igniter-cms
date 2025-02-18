<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'service_id' => [
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
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'icon' => [
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
                'null' => true,
                'default' => 10,
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
        $this->forge->addKey('service_id', true);
        $this->forge->createTable('services');

        //insert default records
        //----------------------
        $data = [
            [
                'service_id' => getGUID(),
                'title'    => 'Portfolio Management',
                'description'    => 'Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit',
                'image'    => null,
                'icon'    => 'ri-team-line',
                'link'    => null,
                'new_tab'    => null,
                'order'    => 2,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'service_id' => getGUID(),
                'title'    => 'Productivity Improvement',
                'description'    => 'Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.',
                'image'    => null,
                'icon'    => 'ri-line-chart-fill',
                'link'    => null,
                'new_tab'    => null,
                'order'    => 4,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'service_id' => getGUID(),
                'title'    => 'Financial Consulting',
                'description'    => 'Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.',
                'image'    => null,
                'icon'    => 'ri-hand-coin-line',
                'link'    => null,
                'new_tab'    => null,
                'order'    => 6,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'service_id' => getGUID(),
                'title'    => 'Corporate Strategy',
                'description'    => 'Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.',
                'image'    => null,
                'icon'    => 'ri-bar-chart-box-line',
                'link'    => null,
                'new_tab'    => null,
                'order'    => 8,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
        ];

        // Using Query Builder
        $this->db->table('services')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}

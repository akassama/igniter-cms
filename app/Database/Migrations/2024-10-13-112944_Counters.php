<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Counters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'counter_id' => [
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
            'initial_value' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'final_value' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'extra_text' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('counter_id', true);
        $this->forge->createTable('counters');

        //insert default records
        //----------------------
        $data = [
            [
                'counter_id' => getGUID(),
                'title'    => 'Happy Clients',
                'description'    => null,
                'initial_value'    => 0,
                'final_value'    => 232,
                'extra_text'    => null,
                'icon'    => 'ri-user-smile-line flex-shrink-0',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by'    => null
            ],
            [
                'counter_id' => getGUID(),
                'title'    => 'Portfolios',
                'description'    => null,
                'initial_value'    => 0,
                'final_value'    => 521,
                'extra_text'    => null,
                'icon'    => 'ri-book-read-fill',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by'    => null
            ],
            [
                'counter_id' => getGUID(),
                'title'    => 'Hours Of Support',
                'description'    => null,
                'initial_value'    => 0,
                'final_value'    => 1463,
                'extra_text'    => null,
                'icon'    => 'ri-customer-service-fill',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by'    => null
            ],
            [
                'counter_id' => getGUID(),
                'title'    => 'Hard Workers',
                'description'    => null,
                'initial_value'    => 0,
                'final_value'    => 15,
                'extra_text'    => null,
                'icon'    => 'ri-group-line',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID("c9539038-7831-4904-8f6c-a5fd7720c435"),
                'updated_by'    => null
            ],
        ];

        // Using Query Builder
        $this->db->table('counters')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('counters');
    }
}
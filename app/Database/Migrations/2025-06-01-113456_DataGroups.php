<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'data_group_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'data_group_for' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'data_group_list' => [
                'type' => 'TEXT',
                'null' => false,
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
        $this->forge->addKey('data_group_id', true);

        $this->forge->createTable('data_groups');

        //Insert default record
        $data = [
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'Page',
                'data_group_list'    => 'general,site',
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'Category',
                'data_group_list'    => 'general,business,portfolio',
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'Navigation',
                'data_group_list'    => "general,top_nav,services,footer_nav",
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'ContentBlock',
                'data_group_list'    => 'general',
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'ContactFomrStatus',
                'data_group_list'    => "New,In Progress,Resolved,Archived",
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'BookingFomrStatus',
                'data_group_list'    => "Pending,Confirmed,Cancelled",
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'BookingFomrPaymentStatus',
                'data_group_list'    => "None,Unpain,Paid,Refunded",
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
            [
                'data_group_id' => getGUID(),
                'data_group_for'    => 'SubscriptionFomrStatus',
                'data_group_list'    => "Pending Confirmation,Active,Unsubscribed,Bounced",
                'deletable'    => 0,
                'created_by' => getGUID(getDefaultAdminGUID())
            ],
        ];

        // Using Query Builder
        $this->db->table('data_groups')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('data_groups');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Partners extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'partner_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'logo' => [
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
        $this->forge->addKey('partner_id', true);
        $this->forge->createTable('partners');

        //insert default records
        //----------------------
        $data = [
            [
                'partner_id' => getGUID(),
                'title'    => 'Trustly',
                'logo'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-1.png',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'partner_id' => getGUID(),
                'title'    => 'Myob',
                'logo'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-2.png',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'partner_id' => getGUID(),
                'title'    => 'Citrus',
                'logo'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-3.png',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'partner_id' => getGUID(),
                'title'    => 'Grabyo',
                'logo'    => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-4.png',
                'link'    => null,
                'new_tab'    => null,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
        ];

        // Using Query Builder
        $this->db->table('partners')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('partners');
    }
}

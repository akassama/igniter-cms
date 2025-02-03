<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Translations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'translation_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('translation_id', true);
        $this->forge->createTable('translations');

        //Insert default record
        $data = [
            [
                'translation_id' => getGUID(),
                'language'    => 'en',
                'created_at'    => date('Y/m/d h:i:s'),
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
            ],
            [
                'translation_id' => getGUID(),
                'language'    => 'ar',
                'created_at'    => date('Y/m/d h:i:s'),
                'created_by' => getGUID('c9539038-7831-4904-8f6c-a5fd7720c435'),
            ]
        ];

        // Using Query Builder
        $this->db->table('translations')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('translations');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Languages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'language_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('language_id', true);
        $this->forge->createTable('languages');

        //run query
        $sqlQuery = "INSERT INTO `languages` (`language_id`,`value`)VALUES('en', 'English'),('ar', 'Arabic'),('zh-CN', 'Simplified Chinese'),('es', 'Spanish'),('pt-PT', 'Portuguese'),('ru', 'Russian'),('de', 'German'),('np', 'Nigerian Pidgin'),('tr', 'Turkish'),('fr', 'French'),('ur', 'Urdu'),('hi', 'Hindi'),('id', 'Indonesian'),('ja', 'Japanese'),('af', 'Afrikaans'),('sw', 'Swahili'),('jm', 'Jamaican Creole English'),('ko', 'Korean'),('wo', 'Wolof');";
        $this->db->query($sqlQuery);
    }

    public function down()
    {
        $this->forge->dropTable('languages');
    }
}

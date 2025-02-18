<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Faqs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'faq_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'question' => [
                'type' => 'TEXT',
            ],
            'answer' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('faq_id', true);
        $this->forge->createTable('faqs');

        //insert default records
        //----------------------
        $data = [
            [
                'faq_id' => getGUID(),
                'question'    => 'What are the benefits of practicing mindfulness daily?',
                'answer'    => 'Practicing mindfulness daily can lead to numerous benefits, including reduced stress, improved focus, and enhanced emotional regulation. It encourages a non-judgmental awareness of the present moment, which can help individuals respond to situations more calmly and thoughtfully. Additionally, mindfulness has been linked to better physical health, as it can lower blood pressure and improve sleep quality.',
                'order'    => 1,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'faq_id' => getGUID(),
                'question'  => 'How does AI contribute to personalized learning in education?',
                'answer'  => 'AI contributes to personalized learning by analyzing student data to tailor educational content to individual needs. It can identify learning gaps, recommend resources, and adjust the pace of learning to suit each student. This personalized approach helps ensure that students receive the support they need to succeed, making education more inclusive and effective.',
                'order'    => 2,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'faq_id' => getGUID(),
                'question'  => 'What are the environmental benefits of electric vehicles (EVs)?',
                'answer'  => 'Electric vehicles (EVs) offer significant environmental benefits, including reduced greenhouse gas emissions and improved air quality. Since EVs produce zero tailpipe emissions, they help decrease the amount of harmful pollutants released into the atmosphere. Additionally, when charged with renewable energy sources, EVs can further reduce the carbon footprint associated with transportation.',
                'order'    => 3,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'faq_id' => getGUID(),
                'question'  => 'How can businesses ensure the ethical use of AI?',
                'answer'  => 'Businesses can ensure the ethical use of AI by implementing clear guidelines and principles that prioritize transparency, fairness, and accountability. It is important to regularly audit AI systems for biases and ensure that they are designed and used in a way that respects user privacy and autonomy. Engaging diverse teams in the development and oversight of AI can also help identify and mitigate potential ethical issues.',
                'order'    => 4,
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
        ];

        // Using Query Builder
        $this->db->table('faqs')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('faqs');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Events extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'event_id' => [
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
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'registration_link_label' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'registration_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'new_tab' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'status' => [
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
        $this->forge->addKey('event_id', true);
        $this->forge->createTable('events');

                //Insert default record
        //----------------------
        $data = [
            [
                'event_id' => getGUID(),
                'title' => 'Tech Innovators Conference 2024',
                'description' => 'Join us for a day of insightful talks and networking with industry leaders in technology and innovation.',
                'slug' => 'tech-innovators-conference-2024',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-1.jpg',
                'content' => '<h2>Tech Innovators Conference 2024</h2> <p>The Tech Innovators Conference is the premier event for professionals in the technology sector. This year, we are focusing on the latest advancements in AI, blockchain, and cybersecurity. Do not miss the opportunity to learn from and network with the brightest minds in the industry.</p> <h3>Keynote Speakers</h3> <ul> <li>Dr. Jane Smith - AI Ethics and Future</li> <li>John Doe - Blockchain Beyond Cryptocurrency</li> <li>Mary Johnson - Cybersecurity in the Modern World</li> </ul> <p>Register now to secure your spot at the forefront of technology innovation.</p>',
                'location' =>'Silicon Valley Conference Center, CA',
                'start_date' =>'2024-05-14 11:00:00',
                'start_time' =>'11:00:00',
                'end_date' =>'2024-05-16 17:00:00',
                'end_time' =>'17:00:00',
                'registration_link_label' =>'Register Now',
                'registration_link' =>'https://example.com/register-tech-conference',
                'new_tab' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Tech Innovators Conference 2024',
                'meta_description' => 'Join industry leaders at the Tech Innovators Conference 2024 for a day of insightful talks on AI, blockchain, and cybersecurity.',
                'meta_keywords' => 'tech conference, AI, blockchain, cybersecurity, innovation',
            ],
            [
                'event_id' => getGUID(),
                'title' => 'Mindfulness Retreat 2024',
                'description' => 'A weekend retreat to relax, reflect, and recharge through guided mindfulness and meditation sessions.',
                'slug' => 'mindfulness-retreat-2024',
                'image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-2.jpg',
                'content' => '<h2>Mindfulness Retreat 2024</h2> <p>Escape the hustle and bustle of daily life and join us for a weekend of mindfulness and meditation. Our retreat offers a peaceful environment to relax and recharge, with guided sessions led by experienced practitioners.</p> <h3>Activities Include</h3> <ul> <li>Guided Meditation</li> <li>Yoga Classes</li> <li>Nature Walks</li> <li>Mindful Eating Workshops</li> </ul> <p>Spaces are limited, so be sure to register early to secure your place.</p>',
                'location' =>'Tranquil Waters Retreat Center, VT',
                'start_date' =>'2024-06-20 09:00:00',
                'start_time' =>'09:00:00',
                'end_date' =>'2024-06-20 17:00:00',
                'end_time' =>'17:00:00',
                'registration_link_label' =>'Sign Up',
                'registration_link' =>'https://example.com/register-mindfulness-retreat',
                'new_tab' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Mindfulness Retreat 2024',
                'meta_description' => 'Join us for a weekend mindfulness retreat to relax, reflect, and recharge through guided meditation and yoga',
                'meta_keywords' => 'mindfulness, retreat, meditation, yoga, wellness',
            ],
        ];

        // Using Query Builder
        $this->db->table('events')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('events');
    }
}
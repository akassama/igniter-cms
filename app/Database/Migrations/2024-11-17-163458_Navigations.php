<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Navigations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'navigation_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => '1000',
                'null' => true,
                'default' => null,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'order' => [
                'type' => 'INT',
                'null' => true,
                'default' => 10,
            ],
            'parent' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
                'constraint' => 50,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('navigation_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('title');

        $this->forge->createTable('navigations');

        //Insert default record
        $data = [
            [
                'navigation_id' => getGUID("131c5798-d0b7-484c-bf21-e1768458632f"),
                'title'    => 'Home',
                'description'    => 'Home navigation',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 2,
                'parent'    => null,
                'link'    => 'home',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("4f4bb82e-e298-4d9f-bc78-30486dfdb2e3"),
                'title'    => 'About Us',
                'description'    => 'About us page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 4,
                'parent'    => null,
                'link'    => '#about',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("e1ae5499-4847-4abf-ae00-f402d56d0063"),
                'title'    => 'Services',
                'description'    => 'Services page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 6,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("ef1ee0ca-2420-47f3-ba8a-ad18d78ae424"),
                'title'    => 'Portfolio',
                'description'    => 'Portfolio page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 8,
                'parent'    => null,
                'link'    => '#portfolio',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("33df6a3e-197f-469e-a337-9da6a32c69c9"),
                'title'    => 'Team',
                'description'    => 'Team page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 10,
                'parent'    => null,
                'link'    => '#team',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9"),
                'title'    => 'Blogs',
                'description'    => 'Blogs page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 12,
                'parent'    => null,
                'link'    => 'blogs',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("70c54a4b-3201-4701-a6fe-094e533351fe"),
                'title'    => 'Contact Us',
                'description'    => 'Contact us page',
                'icon'    => '',
                'group'    => 'top_nav',
                'order'    => 20,
                'parent'    => null,
                'link'    => 'contact',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("f478adf7-74d8-4a2e-b3d4-30d159be6fa7"),
                'title'    => 'Web Design',
                'description'    => 'Web Design nav',
                'icon'    => '',
                'group'    => 'services',
                'order'    => 22,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("e6249c88-468b-44eb-92d6-9b8ef6ae68b5"),
                'title'    => 'Web Development',
                'description'    => 'Web Developmentns nav',
                'icon'    => '',
                'group'    => 'services',
                'order'    => 24,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("8f89db87-1f9d-428d-bdbd-a29cf75ec8d6"),
                'title'    => 'Product Management',
                'description'    => 'Product Management nav',
                'icon'    => '',
                'group'    => 'services',
                'order'    => 26,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("0adc27cd-8d08-4a83-bfe0-06381cb343d3"),
                'title'    => 'Marketing',
                'description'    => 'Marketing nav',
                'icon'    => '',
                'group'    => 'services',
                'order'    => 28,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("1e19eba9-1b42-4918-99c0-906792224645"),
                'title'    => 'Graphic Design',
                'description'    => 'Graphic Design nav',
                'icon'    => '',
                'group'    => 'services',
                'order'    => 30,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("7548ade6-c891-4f4c-a08b-fce04459a37c"),
                'title'    => 'Home',
                'description'    => 'Home navigation',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 32,
                'parent'    => null,
                'link'    => 'home',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("60ff9118-7044-4308-86ff-b19afe1cf9ee"),
                'title'    => 'About Us',
                'description'    => 'About us page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 34,
                'parent'    => null,
                'link'    => '#about',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("1b191836-b655-4e2a-9257-2b59e642e195"),
                'title'    => 'Services',
                'description'    => 'Services page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 36,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("204476df-0090-48de-829d-e5f30e2b85d6"),
                'title'    => 'Cookie Policy',
                'description'    => 'Cookie Policy page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 38,
                'parent'    => null,
                'link'    => '/cookie-policy',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("a5556828-689e-48fb-9f84-b59858a04e0a"),
                'title'    => 'Privacy Policy',
                'description'    => 'Privacy policy page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 40,
                'parent'    => null,
                'link'    => '/privacy-policy',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("5b2969a9-6d2f-431f-9a06-cebf924daa10"),
                'title'    => 'Sitemap',
                'description'    => 'Sitemap page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 42,
                'parent'    => null,
                'link'    => 'sitemap',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("07b6258b-1884-47af-892f-52d203d97d1e"),
                'title'    => 'RSS Feed',
                'description'    => 'RSS feed page',
                'icon'    => '',
                'group'    => 'footer_nav',
                'order'    => 44,
                'parent'    => null,
                'link'    => 'rss',
                'new_tab'    => false,
                'status'    => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ]
        ];

        // Using Query Builder
        $this->db->table('navigations')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('navigations');
    }
}

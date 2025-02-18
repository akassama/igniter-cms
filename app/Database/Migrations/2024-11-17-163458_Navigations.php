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
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('navigations');

        //Insert default record
        $data = [
            [
                'navigation_id' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'title'    => 'Home',
                'description'    => 'Home navigation',
                'group'    => 'top_nav',
                'order'    => 2,
                'parent'    => null,
                'link'    => 'home',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("4f4bb82e-e298-4d9f-bc78-30486dfdb2e3"),
                'title'    => 'About Us',
                'description'    => 'About us page',
                'group'    => 'top_nav',
                'order'    => 4,
                'parent'    => null,
                'link'    => '#about',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("e1ae5499-4847-4abf-ae00-f402d56d0063"),
                'title'    => 'Services',
                'description'    => 'Services page',
                'group'    => 'top_nav',
                'order'    => 6,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("ef1ee0ca-2420-47f3-ba8a-ad18d78ae424"),
                'title'    => 'Portfolio',
                'description'    => 'Portfolio page',
                'group'    => 'top_nav',
                'order'    => 8,
                'parent'    => null,
                'link'    => '#portfolio',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("33df6a3e-197f-469e-a337-9da6a32c69c9"),
                'title'    => 'Team',
                'description'    => 'Team page',
                'group'    => 'top_nav',
                'order'    => 10,
                'parent'    => null,
                'link'    => '#team',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9"),
                'title'    => 'Blogs',
                'description'    => 'Blogs page',
                'group'    => 'top_nav',
                'order'    => 12,
                'parent'    => null,
                'link'    => 'blogs',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("cb3badd1-b6df-420c-a74d-796e181b1228"),
                'title'    => 'Donate',
                'description'    => 'Donate nav',
                'group'    => 'top_nav',
                'order'    => 14,
                'parent'    => null,
                'link'    => 'donate',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("0a6d180e-96af-494d-b309-5cfa80e6c94f"),
                'title'    => 'Plant a Seed of Hope',
                'description'    => 'Donate Plant a Seed of Hope nav',
                'group'    => 'top_nav',
                'order'    => 16,
                'parent'    => getGUID("cb3badd1-b6df-420c-a74d-796e181b1228"),
                'link'    => 'donate/urban-gardening-initiative',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("875edb73-84ef-403c-9132-519a7fa62f79"),
                'title'    => 'Emergency Relief Fund',
                'description'    => 'Donate Emergency Relief Fund nav',
                'group'    => 'top_nav',
                'order'    => 18,
                'parent'    => getGUID("cb3badd1-b6df-420c-a74d-796e181b1228"),
                'link'    => 'donate/disaster-relief-fund',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("70c54a4b-3201-4701-a6fe-094e533351fe"),
                'title'    => 'Contact Us',
                'description'    => 'Contact us page',
                'group'    => 'top_nav',
                'order'    => 20,
                'parent'    => null,
                'link'    => 'contact',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("f478adf7-74d8-4a2e-b3d4-30d159be6fa7"),
                'title'    => 'Web Design',
                'description'    => 'Web Design nav',
                'group'    => 'services',
                'order'    => 22,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("e6249c88-468b-44eb-92d6-9b8ef6ae68b5"),
                'title'    => 'Web Development',
                'description'    => 'Web Developmentns nav',
                'group'    => 'services',
                'order'    => 24,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("8f89db87-1f9d-428d-bdbd-a29cf75ec8d6"),
                'title'    => 'Product Management',
                'description'    => 'Product Management nav',
                'group'    => 'services',
                'order'    => 26,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("0adc27cd-8d08-4a83-bfe0-06381cb343d3"),
                'title'    => 'Marketing',
                'description'    => 'Marketing nav',
                'group'    => 'services',
                'order'    => 28,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("1e19eba9-1b42-4918-99c0-906792224645"),
                'title'    => 'Graphic Design',
                'description'    => 'Graphic Design nav',
                'group'    => 'services',
                'order'    => 30,
                'parent'    => null,
                'link'    => '#!',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("7548ade6-c891-4f4c-a08b-fce04459a37c"),
                'title'    => 'Home',
                'description'    => 'Home navigation',
                'group'    => 'footer_nav',
                'order'    => 32,
                'parent'    => null,
                'link'    => 'home',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("60ff9118-7044-4308-86ff-b19afe1cf9ee"),
                'title'    => 'About Us',
                'description'    => 'About us page',
                'group'    => 'footer_nav',
                'order'    => 34,
                'parent'    => null,
                'link'    => '#about',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("1b191836-b655-4e2a-9257-2b59e642e195"),
                'title'    => 'Services',
                'description'    => 'Services page',
                'group'    => 'footer_nav',
                'order'    => 36,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("204476df-0090-48de-829d-e5f30e2b85d6"),
                'title'    => 'Terms of service',
                'description'    => 'Terms of service page',
                'group'    => 'footer_nav',
                'order'    => 38,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null
            ],
            [
                'navigation_id' => getGUID("a5556828-689e-48fb-9f84-b59858a04e0a"),
                'title'    => 'Privacy policy',
                'description'    => 'Privacy policy page',
                'group'    => 'footer_nav',
                'order'    => 40,
                'parent'    => null,
                'link'    => '#services',
                'new_tab'    => false,
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

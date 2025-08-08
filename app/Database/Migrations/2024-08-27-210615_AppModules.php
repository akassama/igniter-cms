<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AppModules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'app_module_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'module_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'module_description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'module_search_terms' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'module_roles' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'module_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('app_module_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('module_name');
        $this->forge->addKey('module_description');
        $this->forge->addKey('module_search_terms');
        
        $this->forge->createTable('app_modules');

        //insert default records
        //----------------------
        $data = [
            [
                'app_module_id' => getGUID(),
                'module_name'    => 'Dashboard',
                'module_description'    => 'View admin dashboard',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/dashboard',
                'module_search_terms' => 'dashboard,home,overview'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Account Details',
                'module_description'  => 'Update account details',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/settings/update-details',
                'module_search_terms' => 'account,profile,settings'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Change Password',
                'module_description'  => 'Change account password',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/settings/change-password',
                'module_search_terms' => 'password,security,change'
            ],
            //Themes
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Themes',
                'module_description'  => 'Manage themes',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/themes',
                'module_search_terms' => 'themes,appearance,design'
            ],
            //Admin
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Admin',
                'module_description'  => 'Administration',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin',
                'module_search_terms' => 'admin,control,management'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Users',
                'module_description'  => 'Manage application users',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/users',
                'module_search_terms' => 'users,accounts,people'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Configurations',
                'module_description'  => 'Manage configurations',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/configurations',
                'module_search_terms' => 'configurations,settings,preferences'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Codes',
                'module_description'  => 'Manage codes',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/codes',
                'module_search_terms' => 'codes,references,identifiers'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'API Keys',
                'module_description'  => 'Manage api keys',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/api-keys',
                'module_search_terms' => 'api,keys,access'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Activity Logs',
                'module_description'  => 'View activity logs',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/activity-logs',
                'module_search_terms' => 'logs,activity,tracking'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Error Logs',
                'module_description'  => 'View error logs',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/logs',
                'module_search_terms' => 'error logs,activity,tracking'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Visit Stats',
                'module_description'  => 'View visit statistics and charts',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/visit-stats',
                'module_search_terms' => 'stats,visits,analytics'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Blocked IP\'s',
                'module_description'  => 'View blocked ip addresses',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/blocked-ips',
                'module_search_terms' => 'block,blacklist,security,deny ip,spam'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Whitelisted IP\'s',
                'module_description'  => 'View whitelisted ip addresses',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/whitelisted-ips',
                'module_search_terms' => 'unblock,whitelist,security,allow ip'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Backup',
                'module_description'  => 'Manage backups',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/backups',
                'module_search_terms' => 'backup,restore,database'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'File Editor',
                'module_description'  => 'Edit and update theme files',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/file-editor',
                'module_search_terms' => 'themes,customize,ui'
            ],
            //FILE MANAGER
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'File Management',
                'module_description'  => 'Manage files and media (images, videos, documents)',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/file-manager',
                'module_search_terms' => 'files,media,storage'
            ],
            //CMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'File Management',
                'module_description'  => 'Manage files and media (images, videos, documents)',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/file-manager',
                'module_search_terms' => 'files,media,storage'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Blogs',
                'module_description'  => 'Manage blogs, posts, or articles',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/blogs',
                'module_search_terms' => 'blogs,articles,posts'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Navigations',
                'module_description'  => 'Manage navigations/menus',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/navigations',
                'module_search_terms' => 'navigations,menus,links'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Categories',
                'module_description'  => 'Manage categories',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/categories',
                'module_search_terms' => 'category,categories,post category'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Pages',
                'module_description'  => 'Manage pages',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/pages',
                'module_search_terms' => 'pages,content,publish'
            ],
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Content Blocks',
                'module_description'  => 'Manage content blocks',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/content-blocks',
                'module_search_terms' => 'content,blocks,widgets'
            ],
            //AI 
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'AI',
                'module_description'  => 'AI chatbot',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/policies',
                'module_search_terms' => 'artificial intelligence,chat gpt,claude, gemini, deepseek'
            ],
        ];
        

        // Using Query Builder
        $this->db->table('app_modules')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('app_modules');
    }
}

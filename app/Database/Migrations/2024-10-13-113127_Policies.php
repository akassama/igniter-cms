<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Policies extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'policy_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'policy_for' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'content' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('policy_id', true);
        $this->forge->createTable('policies');

        //insert default records
        //----------------------
        $data = [
            [
                'policy_id' => getGUID(),
                'policy_for'    => 'Privacy',
                'title'    => 'Privacy Policy',
                'content'    => '<h2>Privacy Policy</h2> <p>Your privacy is important to us. This privacy statement explains the personal data our company processes, how our company processes it, and for what purposes.</p> <h3>Personal Data We Collect</h3> <p>We collect data to provide the services you request, ease your navigation on our websites, communicate with you, and improve your experience using our services. The personal data we collect depends on the context of your interactions with us and the choices you make, including your privacy settings and the features you use.</p> <h3>How We Use Personal Data</h3> <p>We use the data we collect to provide you with rich, interactive experiences. In particular, we use data to:</p> <ul> <li>Provide our services, which includes updating, securing, and troubleshooting, as well as providing support. It also includes sharing data, when it is required to provide the service or carry out the transactions you request.</li> <li>Improve and develop our services.</li> <li>Personalize our services and make recommendations.</li> <li>Advertise and market to you, which includes sending promotional communications, targeting advertising, and presenting you with relevant offers.</li> </ul> <h3>Reasons We Share Personal Data</h3> <p>We share your personal data with your consent or to complete any transaction or provide any service you have requested or authorized. We also share data with our controlled affiliates and subsidiaries; with vendors working on our behalf; when required by law or to respond to legal process; to protect our customers; to protect lives; to maintain the security of our services; and to protect the rights or property of our company.</p> <h3>How to Access & Control Your Personal Data</h3> <p>You can also make choices about the collection and use of your data by our company. You can control your personal data that our company has obtained, and exercise your data protection rights, by contacting our company or using various tools we provide. How you can access or control your personal data will depend on which services you use.</p>',   
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'policy_id' => getGUID(),
                'policy_for'    => 'Cookie',
                'title'    => 'Cookie Policy',
                'content'    => '<h2>Cookie Policy</h2> <p>Our websites and online services use cookies and similar technologies to ensure the best user experience and provide you with personalized content. This policy explains what cookies are and how we use them.</p> <h3>What Are Cookies?</h3> <p>Cookies are small text files placed on your device to store data that can be recalled by a web server in the domain that placed the cookie. We use cookies and similar technologies to store and honor your preferences and settings, enable you to sign-in, provide interest-based advertising, combat fraud, analyze how our products perform, and fulfill other legitimate purposes.</p> <h3>How We Use Cookies</h3> <p>We use cookies for several purposes, depending on the context or service, including:</p> <ul> <li>Storing your preferences and settings. We use cookies to store your preferences and settings on your device, and to enhance your experiences. For example, if you enter your city or postal code to get local news or weather information on our websites, we store that data in a cookie so that you will see the relevant local information when you return to the site.</li> <li>Sign-in and authentication. We use cookies to authenticate you. When you sign in to our websites using your personal account, we store a unique ID number, and the time you signed in, in an encrypted cookie on your device. This cookie allows you to move from page to page within the site without having to sign in again on each page.</li> <li>Security. We use cookies to process information that helps us secure our products, as well as detect fraud and abuse.</li> <li>Storing information you provide to a website. We use cookies to remember information you shared. When you provide information to our company, for example, when you add products to a shopping cart on our websites, we store the data in a cookie to remember the products and information you have added.</li> <li>Social media. Some of our websites include social media cookies, including those that enable users who are logged in to the social media service to share content via that service.</li> <li>Feedback. Our company uses cookies to enable you to provide feedback on a website.</li> <li>Interest-based advertising. Our company uses cookies to collect data about your online activity and identify your interests so that we can provide advertising that is most relevant to you.</li> <li>Showing advertising. Our company uses cookies to record how many visitors have clicked on an advertisement and to record which advertisements you have seen so you don not see the same one repeatedly.</li> <li>Analytics. To provide our products, we use cookies and other identifiers to gather usage and performance data. For example, we use cookies to count the number of unique visitors to a webpage or service and to develop other statistics about the operations of our products.</li> </ul> <h3>How to Control Cookies</h3> <p>You can control and/or delete cookies as you wish – for details, see <a href="https://www.aboutcookies.org">aboutcookies.org</a>. You can delete all cookies that are already on your computer and you can set most browsers to prevent them from being placed. If you do this, however, you may have to manually adjust some preferences every time you visit a site and some services and functionalities may not work.</p>',
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
            [
                'policy_id' => getGUID(),
                'policy_for'    => 'Other',
                'title'  => 'Other Policy',
                'content'  => "Other Content",
                'created_by'    => getGUID(getDefaultAdminGUID()),
                'updated_by'    => null
            ],
        ];

        // Using Query Builder
        $this->db->table('policies')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('policies');
    }
}
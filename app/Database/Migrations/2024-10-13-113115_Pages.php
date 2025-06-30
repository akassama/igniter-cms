<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'default' => 'portfolio',
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'total_views' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'content' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('page_id', true);
        
        // Custom Optimization - Indexing
        $this->forge->addKey('title');
        $this->forge->addKey('slug');

        $this->forge->createTable('pages');

        //Insert default records
        $data = [
            [
                'page_id' => getGUID("f7a8d40d-6b97-4c0b-a532-f535ac4c4af1"),
                'title' => 'About Us',
                'slug' => 'about-us',
                'group' => 'business',
                'status' => 1,
                'content' => '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'About Us - Our Company',
                'meta_description' => 'Learn more about our companys mission, values, and team',
                'meta_keywords' => 'about us, company, mission, values, team',
            ],
            [
                'page_id' => getGUID("a1b2c3d4-e5f6-7890-1234-567890abcdef"),
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Cookie Policy',
                'meta_description' => 'Our Cookie Policy explains how we use cookies on our website.',
                'meta_keywords' => 'cookies, policy, privacy',
            ],
            [
                'page_id' => getGUID("fedcba98-7654-3210-0fed-cba987654321"),
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Our Privacy Policy describes how we collect, use, and share your personal information.',
                'meta_keywords' => 'privacy, policy, data, personal information',
            ],
            [
                'page_id' => getGUID("36e72b64-63e8-4f0d-983d-686154d8bf5d"),
                'title' => 'Careers',
                'slug' => 'careers',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Careers</h2><p>We are always looking for talented, driven individuals to join our team. Explore current openings and learn more about our company culture.</p><p>To apply or view available positions, please visit our Careers page or contact our HR department.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Careers',
                'meta_description' => 'Join our team and explore exciting career opportunities.',
                'meta_keywords' => 'careers, jobs, employment, work with us',
            ],
            [
                'page_id' => getGUID("70cf3ace-b59b-4e93-9639-35035db8c929"),
                'title' => 'Advertise',
                'slug' => 'advertise',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Advertise with Us</h2><p>Reach a broad and engaged audience by advertising with us. We offer a variety of advertising solutions to suit your needs.</p><p>For advertising inquiries, please contact our sales team.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Advertise with Us',
                'meta_description' => 'Promote your brand by advertising on our platform.',
                'meta_keywords' => 'advertising, promote, ads, media kit',
            ],
            [
                'page_id' => getGUID("55068831-a48c-448f-8593-95fc51582122"),
                'title' => 'Ethics Policy',
                'slug' => 'ethics-policy',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Ethics Policy</h2><p>Our team adheres to strict ethical standards in all aspects of our work. We strive for accuracy, fairness, and accountability in everything we publish.</p><p>We maintain editorial independence and ensure that all content meets our high standards of integrity.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Ethics Policy',
                'meta_description' => 'Read about our commitment to ethical standards in journalism and publishing.',
                'meta_keywords' => 'ethics, policy, integrity, standards',
            ],
            [
                'page_id' => getGUID("fd814385-9640-4d04-a9d7-fcf2f6c4ed2e"),
                'title' => 'Corrections',
                'slug' => 'corrections',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Corrections</h2><p>We are committed to transparency and accuracy. If we identify or are made aware of a significant error in our content, we will promptly issue a correction.</p><p>If you spot an error, please contact us so we can investigate and correct it.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Corrections',
                'meta_description' => 'Learn how we handle content corrections and how to report an error.',
                'meta_keywords' => 'corrections, accuracy, errors, transparency',
            ],
            [
                'page_id' => getGUID("eed0cfc6-ab27-499b-b3b8-d18f052f35cb"),
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'group' => 'general',
                'status' => 1,
                'content' => '<h2>Terms of Service</h2><p>By accessing or using our website, you agree to be bound by these Terms of Service. Please read them carefully.</p><p>The Terms outline your rights and responsibilities when using our services, and include disclaimers and limitations of liability.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Terms of Service',
                'meta_description' => 'Review the terms and conditions for using our website and services.',
                'meta_keywords' => 'terms, service, agreement, conditions, legal',
            ],
            // Ecommerce page
            [
                'page_id' => getGUID("e1c0mmer-ce4e-4a1b-9d3f-8e7d6c5b4a3f"),
                'title' => 'Online Store',
                'slug' => 'online-store',
                'group' => 'ecommerce',
                'status' => 1,
                'content' => '<h2>Our Online Store</h2><p>Welcome to our ecommerce platform where you can find a wide range of products at competitive prices. We offer secure checkout, fast delivery, and excellent customer service.</p><p>Browse our categories to find the perfect items for your needs. Don\'t hesitate to contact us if you have any questions about our products or services.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Online Store - Shop Now',
                'meta_description' => 'Browse our wide selection of products in our online store',
                'meta_keywords' => 'ecommerce, online store, shop, products',
            ],
            // Portfolio page
            [
                'page_id' => getGUID("p0rtf0l-io1a-2b3c-4d5e-6f7g8h9i0j1k"),
                'title' => 'Our Portfolio',
                'slug' => 'our-portfolio',
                'group' => 'portfolio',
                'status' => 1,
                'content' => '<h2>Our Work Portfolio</h2><p>Explore our collection of completed projects and creative works. This portfolio showcases our expertise and the quality of our services.</p><p>Each project represents our dedication to excellence and our ability to deliver outstanding results for our clients.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Our Portfolio - See Our Work',
                'meta_description' => 'View our portfolio of completed projects and creative works',
                'meta_keywords' => 'portfolio, work, projects, creative',
            ],
            // News page
            [
                'page_id' => getGUID("n3w5pag-e1d2-3f4g-5h6j-7k8l9m0n1o2p"),
                'title' => 'Latest News',
                'slug' => 'latest-news',
                'group' => 'news',
                'status' => 1,
                'content' => '<h2>News & Updates</h2><p>Stay informed with our latest news and announcements. This section keeps you updated on company developments, industry trends, and important events.</p><p>Check back regularly for new articles and updates about our organization and the communities we serve.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Latest News & Updates',
                'meta_description' => 'Stay updated with our latest news and announcements',
                'meta_keywords' => 'news, updates, announcements, articles',
            ],
            // Event page
            [
                'page_id' => getGUID("ev3ntpa-ge1d-2f3g-4h5j-6k7l8m9n0o1p"),
                'title' => 'Upcoming Events',
                'slug' => 'upcoming-events',
                'group' => 'event',
                'status' => 1,
                'content' => '<h2>Events Calendar</h2><p>Discover our upcoming events, workshops, and conferences. Join us for these exciting opportunities to learn, network, and grow.</p><p>Register early as spaces are often limited for our most popular events.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Upcoming Events Calendar',
                'meta_description' => 'Browse and register for our upcoming events and workshops',
                'meta_keywords' => 'events, calendar, workshops, conferences',
            ],
            // Educational page
            [
                'page_id' => getGUID("3ducat-ional-1a2b-3c4d-5e6f-7g8h9i0j1k2"),
                'title' => 'Learning Resources',
                'slug' => 'learning-resources',
                'group' => 'educational',
                'status' => 1,
                'content' => '<h2>Educational Materials</h2><p>Access our collection of educational resources designed to support learning and professional development.</p><p>We offer tutorials, guides, and reference materials to help you expand your knowledge and skills.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Educational Resources & Learning Materials',
                'meta_description' => 'Access our educational resources and learning materials',
                'meta_keywords' => 'education, learning, resources, materials',
            ],
            // Restaurant page
            [
                'page_id' => getGUID("r3stau-rant-1a2b-3c4d-5e6f-7g8h9i0j1k2"),
                'title' => 'Our Menu',
                'slug' => 'our-menu',
                'group' => 'restaurant',
                'status' => 1,
                'content' => '<h2>Restaurant Menu</h2><p>Explore our delicious offerings featuring fresh ingredients and authentic flavors. Our menu changes seasonally to bring you the best of what\'s available.</p><p>We accommodate various dietary preferences and are happy to customize dishes to your liking.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Restaurant Menu - Our Offerings',
                'meta_description' => 'Browse our restaurant menu featuring seasonal dishes',
                'meta_keywords' => 'restaurant, menu, food, dining',
            ],
            // Health page
            [
                'page_id' => getGUID("h34lth-page-1a2b-3c4d-5e6f-7g8h9i0j1k2"),
                'title' => 'Health Services',
                'slug' => 'health-services',
                'group' => 'health',
                'status' => 1,
                'content' => '<h2>Healthcare Information</h2><p>Learn about our health services, wellness programs, and medical resources. We are committed to providing quality care and health education.</p><p>Our team of professionals is dedicated to helping you achieve and maintain optimal health.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Health Services & Wellness Programs',
                'meta_description' => 'Information about our health services and wellness programs',
                'meta_keywords' => 'health, wellness, medical, services',
            ],
            // Directory page
            [
                'page_id' => getGUID("d1rect-ory1-2a3b-4c5d-6e7f-8g9h0i1j2k3"),
                'title' => 'Business Directory',
                'slug' => 'business-directory',
                'group' => 'directory',
                'status' => 1,
                'content' => '<h2>Directory Listings</h2><p>Browse our comprehensive directory of businesses, services, and professionals. Find what you need quickly and easily.</p><p>Listings are categorized and searchable to help you locate the right service providers.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Business Directory - Find Services',
                'meta_description' => 'Browse our directory of businesses and service providers',
                'meta_keywords' => 'directory, business, services, listings',
            ],
            // Entertainment page
            [
                'page_id' => getGUID("3nt3rt-ain1-2a3b-4c5d-6e7f-8g9h0i1j2k3"),
                'title' => 'Entertainment',
                'slug' => 'entertainment',
                'group' => 'entertainment',
                'status' => 1,
                'content' => '<h2>Entertainment Section</h2><p>Discover our entertainment offerings including events, media, and activities for all ages.</p><p>We provide quality entertainment options to enrich your leisure time and create memorable experiences.</p>',
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Entertainment Options & Events',
                'meta_description' => 'Explore our entertainment offerings and events',
                'meta_keywords' => 'entertainment, events, media, activities',
            ]
        ];

        // Using Query Builder
        $this->db->table('pages')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('pages');
    }
}
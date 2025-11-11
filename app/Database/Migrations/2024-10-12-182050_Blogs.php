<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Blogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'blog_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'featured_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'excerpt' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tags' => [
                'type' => 'TEXT',
                'constraint' => 255,
                'null' => true,
            ],
            'is_featured' => [
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
            'total_views' => [
                'type' => 'INT',
                'default' => 0,
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
        $this->forge->addKey('blog_id', true);
        
        // Custom Optimization - Indexing
        $this->forge->addKey('title');
        $this->forge->addKey('slug');
        $this->forge->addKey('category');
        $this->forge->addKey('created_by');

        $this->forge->createTable('blogs');

        //Insert default record
        //----------------------
        $data = [
            [
                'blog_id' => getGUID("7c4d3d90-08e0-451a-b79a-106d3150e6f3"),
                'title' => 'Exploring the Future of AI in Healthcare',
                'slug' => 'exploring-the-future-of-ai-in-healthcare',
                'featured_image' => 'https://assets.aktools.net/image-stocks/posts/blog-3.jpg',
                'excerpt' => 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field',
                'content' => '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>',
                'category' => getGUID("11b3016f-4944-4467-ba98-9de4031ffe21"),
                'tags' => 'AI, healthcare, technology, future',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'total_views' => 1,
                'meta_title' => 'Exploring the Future of AI in Healthcare',
                'meta_description' => 'This is a sample blog post for demonstration purposes.',
                'meta_keywords' => 'AI, healthcare, technology, future',                
            ],
            [
                'blog_id' => getGUID("d9a9ce79-1756-4eab-a900-3684b175670f"),
                'title' => 'How to attract top talent in competitive industries',
                'slug' => 'how-to-attract-top-talent-in-competitive-industries',
                'featured_image' => 'https://assets.aktools.net/image-stocks/posts/blog-1.jpg',
                'excerpt' => 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.',
                'content' => '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>',
                'category' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'tags' => 'office, stakes, competitive',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'total_views' => 1,
                'meta_title' => 'How to attract top talent in competitive industries',
                'meta_description' => 'Top talents there for the picking, regardless of industry.',
                'meta_keywords' => 'office, stakes, competitive',
            ],
            [
                'blog_id' => getGUID("a1b2c3d4-e5f6-7890-1234-567890abcdef"),
                'title' => 'Sustainable Living: Small Changes with Big Impact',
                'slug' => 'sustainable-living-small-changes',
                'featured_image' => 'https://assets.aktools.net/image-stocks/posts/blog-4.jpg',
                'excerpt' => 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.',
                'content' => '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>',
                'category' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'tags' => 'sustainability, eco-friendly, lifestyle',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'total_views' => 0,
                'meta_title' => 'Sustainable Living Tips',
                'meta_description' => 'Easy ways to reduce your environmental impact through daily choices.',
                'meta_keywords' => 'sustainability, eco-friendly, green living'
            ],
        ];

        // Using Query Builder
        $this->db->table('blogs')->insertBatch($data);
    }
    
    public function down()
    {
        $this->forge->dropTable('blogs');
    }    
}

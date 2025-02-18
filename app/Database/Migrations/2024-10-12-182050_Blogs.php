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
        $this->forge->createTable('blogs');

        //Insert default record
        //----------------------
        $data = [
            [
                'blog_id' => getGUID("d9a9ce79-1756-4eab-a900-3684b175670f"),
                'title' => 'How to attract top talent in competitive industries',
                'slug' => 'how-to-attract-top-talent-in-competitive-industries',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-1.jpg',
                'excerpt' => 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.',
                'content' => '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>',
                'category' => getGUID("f0b860dc-624c-439a-9de8-f3164c981b08"),
                'tags' => 'office, stakes, competitive',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'How to attract top talent in competitive industries',
                'meta_description' => 'Top talents there for the picking, regardless of industry.',
                'meta_keywords' => 'office, stakes, competitive',
            ],
            [
                'blog_id' => getGUID("f3a5bcef-6ebc-42ec-848e-9dc5d82f7200"),
                'title' => 'The Art of Mindful Gardening',
                'slug' => 'the-art-of-mindful-gardening',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-2.jpg',
                'excerpt' => 'Discover the therapeutic benefits of mindful gardening and how it can transform your outdoor space into a sanctuary of peace and tranquility.',
                'content' => '<h2>The Art of Mindful Gardening</h2> <p>In our fast-paced world, finding moments of peace can be challenging. Mindful gardening offers a serene escape, allowing you to connect with nature and cultivate a sense of calm. Here is how to transform your garden into a sanctuary:</p> <h3>1. Engage Your Senses</h3> <p>Take a moment to feel the soil, listen to the rustling leaves, and breathe in the floral scents. Engaging your senses helps ground you in the present moment.</p> <h3>2. Embrace the Process</h3> <p>Gardening is a journey, not a destination. Embrace the process of planting, watering, and nurturing your plants, and let go of the need for immediate results.</p> <h3>3. Create a Routine</h3> <p>Set aside time each day to tend to your garden. This routine can become a meditative practice, providing structure and tranquility to your day.</p> <h3>4. Reflect and Appreciate</h3> <p>Take time to reflect on the growth in your garden and in yourself. Appreciate the beauty of nature and the peace it brings to your life.</p> <p>Mindful gardening is more than a hobby; its a path to inner peace. Start small, be present, and watch your garden—and your mind—bloom.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'gardening, mindfulness, mental health, wellness',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'The Art of Mindful Gardening',
                'meta_description' => 'This is a sample blog post for demonstration purposes.',
                'meta_keywords' => 'gardening, mindfulness, mental health, wellness',                
            ],
            [
                'blog_id' => getGUID("7c4d3d90-08e0-451a-b79a-106d3150e6f3"),
                'title' => 'Exploring the Future of AI in Healthcare',
                'slug' => 'exploring-the-future-of-ai-in-healthcare',
                'featured_image' => 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-3.jpg',
                'excerpt' => 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field',
                'content' => '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>',
                'category' => getGUID("11b3016f-4944-4467-ba98-9de4031ffe21"),
                'tags' => 'AI, healthcare, technology, future',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'meta_title' => 'Exploring the Future of AI in Healthcare',
                'meta_description' => 'This is a sample blog post for demonstration purposes.',
                'meta_keywords' => 'AI, healthcare, technology, future',                
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

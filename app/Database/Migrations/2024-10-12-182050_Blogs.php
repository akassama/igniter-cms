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
                'featured_image' => 'public/uploads/files/blog-3.jpg',
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
                'featured_image' => 'public/uploads/files/blog-1.jpg',
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
                'blog_id' => getGUID("f3a5bcef-6ebc-42ec-848e-9dc5d82f7200"),
                'title' => 'The Art of Mindful Gardening',
                'slug' => 'the-art-of-mindful-gardening',
                'featured_image' => 'public/uploads/files/blog-2.jpg',
                'excerpt' => 'Discover the therapeutic benefits of mindful gardening and how it can transform your outdoor space into a sanctuary of peace and tranquility.',
                'content' => '<h2>The Art of Mindful Gardening</h2> <p>In our fast-paced world, finding moments of peace can be challenging. Mindful gardening offers a serene escape, allowing you to connect with nature and cultivate a sense of calm. Here is how to transform your garden into a sanctuary:</p> <h3>1. Engage Your Senses</h3> <p>Take a moment to feel the soil, listen to the rustling leaves, and breathe in the floral scents. Engaging your senses helps ground you in the present moment.</p> <h3>2. Embrace the Process</h3> <p>Gardening is a journey, not a destination. Embrace the process of planting, watering, and nurturing your plants, and let go of the need for immediate results.</p> <h3>3. Create a Routine</h3> <p>Set aside time each day to tend to your garden. This routine can become a meditative practice, providing structure and tranquility to your day.</p> <h3>4. Reflect and Appreciate</h3> <p>Take time to reflect on the growth in your garden and in yourself. Appreciate the beauty of nature and the peace it brings to your life.</p> <p>Mindful gardening is more than a hobby; its a path to inner peace. Start small, be present, and watch your garden—and your mind—bloom.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'gardening, mindfulness, mental health, wellness',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'total_views' => 0,
                'meta_title' => 'The Art of Mindful Gardening',
                'meta_description' => 'This is a sample blog post for demonstration purposes.',
                'meta_keywords' => 'gardening, mindfulness, mental health, wellness',                
            ],
            [
                'blog_id' => getGUID("a1b2c3d4-e5f6-7890-1234-567890abcdef"),
                'title' => 'Sustainable Living: Small Changes with Big Impact',
                'slug' => 'sustainable-living-small-changes',
                'featured_image' => 'public/uploads/files/blog-4.jpg',
                'excerpt' => 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.',
                'content' => '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>',
                'category' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'tags' => 'sustainability, eco-friendly, lifestyle',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 hours')),
                'total_views' => 0,
                'meta_title' => 'Sustainable Living Tips',
                'meta_description' => 'Easy ways to reduce your environmental impact through daily choices.',
                'meta_keywords' => 'sustainability, eco-friendly, green living'
            ],
            [
                'blog_id' => getGUID("b2c3d4e5-f6a7-8901-2345-67890abcdef1"),
                'title' => 'The Science of Productivity: Work Smarter, Not Harder',
                'slug' => 'science-of-productivity',
                'featured_image' => 'public/uploads/files/blog-5.jpg',
                'excerpt' => 'Evidence-based strategies to boost your productivity and achieve more in less time without burning out.',
                'content' => '<h2>The Science of Productivity</h2><p>Productivity isn\'t about working longer hours—it\'s about working smarter. Research-backed techniques can help you maximize efficiency:</p><h3>1. The Pomodoro Technique</h3><p>Work in focused 25-minute intervals with 5-minute breaks.</p><h3>2. Time Blocking</h3><p>Schedule specific blocks for different tasks to minimize context-switching.</p><h3>3. The Two-Minute Rule</h3><p>If a task takes less than two minutes, do it immediately.</p><h3>4. Deep Work</h3><p>Create distraction-free periods for cognitively demanding tasks.</p><h3>5. Rest Strategically</h3><p>Quality breaks boost subsequent productivity.</p><p>By implementing these methods, you can accomplish more while maintaining work-life balance.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'productivity, work, efficiency',
                'is_featured' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 hours')),
                'total_views' => 1,
                'meta_title' => 'Science-Backed Productivity Tips',
                'meta_description' => 'Research-proven methods to enhance your work efficiency.',
                'meta_keywords' => 'productivity, efficiency, time management'
            ],
            [
                'blog_id' => getGUID("c3d4e5f6-a7b8-9012-3456-7890abcdef12"),
                'title' => 'Urban Gardening: Growing Food in Small Spaces',
                'slug' => 'urban-gardening-small-spaces',
                'featured_image' => 'public/uploads/files/blog-6.jpg',
                'excerpt' => 'You don\'t need a backyard to grow your own food. Learn how to create a thriving garden in apartments and small urban spaces.',
                'content' => '<h2>Urban Gardening in Small Spaces</h2><p>Limited space doesn\'t mean you can\'t enjoy homegrown produce. Here\'s how to garden in urban environments:</p><h3>1. Container Gardening</h3><p>Use pots, buckets, or hanging planters for vegetables and herbs.</p><h3>2. Vertical Gardens</h3><p>Utilize wall space with trellises or pocket planters.</p><h3>3. Windowsill Gardens</h3><p>Grow herbs and microgreens right in your kitchen window.</p><h3>4. Community Gardens</h3><p>Join local gardening initiatives if you lack personal space.</p><h3>5. Best Plants for Small Spaces</h3><p>Try lettuce, cherry tomatoes, peppers, basil, and dwarf varieties.</p><p>Urban gardening brings fresh food and greenery to city living.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'gardening, urban, sustainability',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'total_views' => 0,
                'meta_title' => 'Urban Gardening Guide',
                'meta_description' => 'Tips for growing food in apartments and small urban spaces.',
                'meta_keywords' => 'urban gardening, container gardening, small space gardening'
            ],
            [
                'blog_id' => getGUID("d4e5f6a7-b8c9-0123-4567-890abcdef123"),
                'title' => 'The Future of Remote Work: Trends and Predictions',
                'slug' => 'future-of-remote-work',
                'featured_image' => 'public/uploads/files/blog-7.jpg',
                'excerpt' => 'How remote work is evolving and what professionals can expect in the coming years as workplace norms continue to change.',
                'content' => '<h2>The Future of Remote Work</h2><p>The remote work revolution is just beginning. Key trends shaping its future include:</p><h3>1. Hybrid Work Models</h3><p>Most companies will adopt flexible office/remote schedules.</p><h3>2. Digital Nomadism</h3><p>More professionals will work while traveling internationally.</p><h3>3. Results-Only Work Environments</h3><p>Focus will shift from hours logged to output produced.</p><h3>4. Virtual Collaboration Tools</h3><p>Continued innovation in remote team technologies.</p><h3>5. Workspace Flexibility</h3><p>Companies will offer stipends for home office setups.</p><h3>6. Global Talent Pools</h3><p>Location will matter less for hiring decisions.</p><p>Remote work is here to stay, but its form will continue evolving.</p>',
                'category' => getGUID("f0b860dc-624c-439a-9de8-f3164c981b08"),
                'tags' => 'remote work, future, career',
                'is_featured' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 hours')),
                'total_views' => 1,
                'meta_title' => 'Remote Work Future Trends',
                'meta_description' => 'How remote work is evolving and what to expect in coming years.',
                'meta_keywords' => 'remote work, future of work, digital nomad'
            ],
            [
                'blog_id' => getGUID("e5f6a7b8-c9d0-1234-5678-90abcdef1234"),
                'title' => 'Mindfulness Meditation for Beginners',
                'slug' => 'mindfulness-meditation-beginners',
                'featured_image' => 'public/uploads/files/blog-8.jpg',
                'excerpt' => 'A step-by-step guide to starting a mindfulness meditation practice, even if you\'ve never meditated before.',
                'content' => '<h2>Mindfulness Meditation for Beginners</h2><p>Mindfulness meditation is simple but powerful. Here\'s how to begin:</p><h3>1. Find a Quiet Space</h3><p>Start with just 5 minutes in a comfortable, distraction-free area.</p><h3>2. Focus on Your Breath</h3><p>Pay attention to the sensation of breathing in and out.</p><h3>3. Notice When Your Mind Wanders</h3><p>Gently return focus to your breath without judgment.</p><h3>4. Body Scan</h3><p>Progressively notice sensations throughout your body.</p><h3>5. Make It a Habit</h3><p>Consistency matters more than duration when starting.</p><h3>6. Use Guided Meditations</h3><p>Apps or recordings can help when beginning.</p><p>Regular practice reduces stress and increases focus. Be patient with yourself.</p>',
                'category' => getGUID("5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab"),
                'tags' => 'meditation, mindfulness, wellness',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 hours')),
                'total_views' => 0,
                'meta_title' => 'Beginner\'s Guide to Mindfulness',
                'meta_description' => 'Simple steps to start a mindfulness meditation practice.',
                'meta_keywords' => 'meditation, mindfulness, mental health'
            ],
            [
                'blog_id' => getGUID("f6a7b8c9-d0e1-2345-6789-0abcdef12345"),
                'title' => 'The Psychology of Color in Marketing',
                'slug' => 'psychology-of-color-marketing',
                'featured_image' => 'public/uploads/files/blog-9.jpg',
                'excerpt' => 'How different colors influence consumer behavior and what this means for your branding and marketing strategies.',
                'content' => '<h2>The Psychology of Color in Marketing</h2><p>Colors evoke emotions and influence decisions. Key insights:</p><h3>1. Red</h3><p>Creates urgency - often used for clearance sales.</p><h3>2. Blue</h3><p>Builds trust - favored by banks and tech companies.</p><h3>3. Green</h3><p>Associated with health and environment - used for organic products.</p><h3>4. Yellow</h3><p>Grabs attention - effective for window displays.</p><h3>5. Black</h3><p>Signifies luxury - common for high-end products.</p><h3>6. Cultural Differences</h3><p>Color meanings vary globally (e.g., white symbolizes mourning in some cultures).</p><p>Choose colors strategically based on your target audience and brand personality.</p>',
                'category' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'tags' => 'marketing, psychology, design',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 hours')),
                'total_views' => 1,
                'meta_title' => 'Color Psychology in Marketing',
                'meta_description' => 'How colors affect consumer perceptions and buying decisions.',
                'meta_keywords' => 'color psychology, marketing, branding'
            ],
            [
                'blog_id' => getGUID("a7b8c9d0-e1f2-3456-789a-bcdef1234567"),
                'title' => 'Essential Cybersecurity Practices for Small Businesses',
                'slug' => 'cybersecurity-small-businesses',
                'featured_image' => 'public/uploads/files/blog-10.jpg',
                'excerpt' => 'Practical security measures every small business should implement to protect against growing cyber threats.',
                'content' => '<h2>Essential Cybersecurity for Small Businesses</h2><p>Small businesses are frequent targets. Essential protections include:</p><h3>1. Strong Password Policies</h3><p>Require complex passwords and multi-factor authentication.</p><h3>2. Regular Software Updates</h3><p>Patch vulnerabilities in all systems and applications.</p><h3>3. Employee Training</h3><p>Educate staff on phishing and social engineering risks.</p><h3>4. Secure Backup Systems</h3><p>Maintain encrypted, off-site backups of critical data.</p><h3>5. Network Security</h3><p>Use firewalls and secure Wi-Fi networks.</p><h3>6. Incident Response Plan</h3><p>Prepare for potential breaches with clear protocols.</p><p>Investing in cybersecurity protects your business, customers, and reputation.</p>',
                'category' => getGUID("5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab"),
                'tags' => 'cybersecurity, business, technology',
                'is_featured' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 hours')),
                'total_views' => 1,
                'meta_title' => 'Small Business Cybersecurity',
                'meta_description' => 'Essential security practices for protecting small businesses.',
                'meta_keywords' => 'cybersecurity, small business, data protection'
            ],
            [
                'blog_id' => getGUID("b8c9d0e1-f2g3-4567-89ab-cdef12345678"),
                'title' => 'The Rise of Plant-Based Diets: Health and Environmental Benefits',
                'slug' => 'plant-based-diets-benefits',
                'featured_image' => 'public/uploads/files/blog-11.jpg',
                'excerpt' => 'Exploring the growing popularity of plant-based eating and its positive impacts on personal health and the planet.',
                'content' => '<h2>The Rise of Plant-Based Diets</h2><p>Plant-based eating offers significant benefits:</p><h3>1. Health Advantages</h3><p>Linked to lower risks of heart disease, diabetes, and certain cancers.</p><h3>2. Environmental Impact</h3><p>Requires fewer resources than animal agriculture.</p><h3>3. Getting Enough Protein</h3><p>Beans, lentils, tofu, and quinoa are excellent sources.</p><h3>4. Transition Tips</h3><p>Start with meatless Mondays or plant-based breakfasts.</p><h3>5. Nutritional Considerations</h3><p>Pay attention to vitamin B12, iron, and omega-3s.</p><h3>6. Global Cuisine Inspiration</h3><p>Explore Mediterranean, Indian, and East Asian plant-based dishes.</p><p>A plant-based diet can be nutritious, delicious, and sustainable.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'nutrition, health, sustainability',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 hours')),
                'total_views' => 1,
                'meta_title' => 'Benefits of Plant-Based Diets',
                'meta_description' => 'Health and environmental advantages of plant-based eating.',
                'meta_keywords' => 'plant-based, vegan, nutrition, sustainability'
            ],
            [
                'blog_id' => getGUID("c9d0e1f2-g3h4-5678-9abc-def123456789"),
                'title' => 'Financial Planning for Millennials: Building Wealth in Your 30s',
                'slug' => 'financial-planning-millennials',
                'featured_image' => 'public/uploads/files/blog-12.jpg',
                'excerpt' => 'Practical money management strategies to help millennials achieve financial stability and build long-term wealth.',
                'content' => '<h2>Financial Planning for Millennials</h2><p>Key strategies for financial health in your 30s:</p><h3>1. Pay Down High-Interest Debt</h3><p>Focus on credit cards and personal loans first.</p><h3>2. Build an Emergency Fund</h3><p>Aim for 3-6 months of living expenses.</p><h3>3. Start Investing Early</h3><p>Take advantage of compound growth in retirement accounts.</p><h3>4. Increase Retirement Contributions</h3><p>Boost your 401(k) or IRA contributions annually.</p><h3>5. Protect Your Income</h3><p>Consider disability insurance if you depend on your paycheck.</p><h3>6. Side Hustles for Extra Income</h3><p>Develop multiple income streams when possible.</p><p>Smart money habits now pay dividends for decades to come.</p>',
                'category' => getGUID("6b3c5c3e-6235-4ffa-b0be-db10e6444df5"),
                'tags' => 'finance, millennials, investing',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                'total_views' => 1,
                'meta_title' => 'Millennial Financial Planning',
                'meta_description' => 'Wealth-building strategies for millennials in their 30s.',
                'meta_keywords' => 'finance, millennials, retirement, investing'
            ],
            [
                'blog_id' => getGUID("d0e1f2g3-h4i5-6789-abcd-ef1234567890"),
                'title' => 'The Evolution of Social Media: What\'s Next?',
                'slug' => 'evolution-of-social-media',
                'featured_image' => 'public/uploads/files/blog-13.jpg',
                'excerpt' => 'How social media platforms have transformed communication and what emerging trends suggest about their future direction.',
                'content' => '<h2>The Evolution of Social Media</h2><p>Social media continues evolving rapidly:</p><h3>1. The Rise of Ephemeral Content</h3><p>Stories and disappearing messages dominate engagement.</p><h3>2. Video-First Platforms</h3><p>TikTok\'s success pushes all platforms toward video.</p><h3>3. Niche Communities</h3><p>Users seek smaller, interest-based networks.</p><h3>4. Commerce Integration</h3><p>Social platforms become shopping destinations.</p><h3>5. Augmented Reality Features</h3><p>Filters and virtual try-ons enhance user experience.</p><h3>6. Privacy Concerns</h3><p>Users demand more control over their data.</p><p>The future likely holds more immersive, personalized, and transactional experiences.</p>',
                'category' => getGUID("5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab"),
                'tags' => 'social media, technology, trends',
                'is_featured' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-13 hours')),
                'total_views' => 0,
                'meta_title' => 'Future of Social Media',
                'meta_description' => 'Emerging trends and the evolution of social platforms.',
                'meta_keywords' => 'social media, digital marketing, technology'
            ],
            [
                'blog_id' => getGUID("e1f2g3h4-i5j6-7890-bcde-f12345678901"),
                'title' => 'Minimalist Travel: Packing Light for Stress-Free Trips',
                'slug' => 'minimalist-travel-packing',
                'featured_image' => 'public/uploads/files/blog-14.jpg',
                'excerpt' => 'How to embrace minimalist packing techniques to make your travels easier, cheaper, and more enjoyable.',
                'content' => '<h2>Minimalist Travel: Packing Light</h2><p>Traveling with less brings more freedom:</p><h3>1. The Capsule Wardrobe Approach</h3><p>Pack versatile, mix-and-match clothing items.</p><h3>2. Toiletries Strategy</h3><p>Use small containers and multi-use products.</p><h3>3. Digital Documents</h3><p>Store tickets and reservations on your phone.</p><h3>4. The "Pack Half" Rule</h3><p>Lay out what you think you need, then remove half.</p><h3>5. Wear Your Bulkiest Items</h3><p>Jackets and heavy shoes should be worn, not packed.</p><h3>6. Laundry on the Road</h3><p>Plan to wash clothes rather than overpack.</p><p>With practice, you can travel comfortably with just carry-on luggage for any trip length.</p>',
                'category' => getGUID("4a886e81-a07d-4b7e-8750-25b5bd8f4e7a"),
                'tags' => 'travel, minimalism, lifestyle',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 hours')),
                'total_views' => 1,
                'meta_title' => 'Minimalist Packing Guide',
                'meta_description' => 'How to pack light for stress-free travel experiences.',
                'meta_keywords' => 'travel, packing, minimalism'
            ],
            [
                'blog_id' => getGUID("f2g3h4i5-j6k7-8901-cdef-234567890123"),
                'title' => 'The Science of Sleep: Optimizing Your Rest for Better Health',
                'slug' => 'science-of-sleep-optimization',
                'featured_image' => 'public/uploads/files/blog-15.jpg',
                'excerpt' => 'Evidence-based strategies to improve sleep quality and duration, leading to better physical and mental health.',
                'content' => '<h2>The Science of Sleep Optimization</h2><p>Quality sleep is foundational to health. Research shows:</p><h3>1. Consistent Sleep Schedule</h3><p>Going to bed and waking at the same time regulates your circadian rhythm.</p><h3>2. Ideal Sleep Environment</h3><p>Cool, dark, and quiet rooms promote better rest.</p><h3>3. Blue Light Reduction</h3><p>Avoid screens 1-2 hours before bedtime.</p><h3>4. Caffeine Timing</h3><p>Limit caffeine after 2pm for undisturbed sleep.</p><h3>5. The 20-Minute Rule</h3><p>If you can\'t sleep, get up and do something relaxing.</p><h3>6. Sleep Tracking</h3><p>Use technology judiciously to identify patterns.</p><p>Prioritizing sleep improves cognition, mood, immunity, and longevity.</p>',
                'category' => getGUID("5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab"),
                'tags' => 'sleep, health, wellness',
                'is_featured' => false,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 hours')),
                'total_views' => 1,
                'meta_title' => 'How to Improve Your Sleep',
                'meta_description' => 'Science-backed methods for better sleep and health.',
                'meta_keywords' => 'sleep, health, wellness, neuroscience'
            ],
            [
                'blog_id' => getGUID("8e98b4c1-7f41-46c4-97fd-b59ecb57cbe8"),
                'title' => 'AI and the Future of Learning',
                'slug' => 'ai-and-the-future-of-learning',
                'featured_image' => 'public/uploads/files/blog-16.jpg',
                'excerpt' => 'Artificial Intelligence is reshaping how students learn, teachers teach, and institutions adapt. Discover how AI is driving personalized and lifelong education.',
                'content' => '
                    <h2>AI and the Future of Learning</h2>
                    <p>Education is undergoing a quiet revolution—and AI is at the heart of it. From adaptive learning platforms to automated grading systems, artificial intelligence is redefining the classroom experience across the globe.</p>
                    
                    <h3>1. Personalized Learning Paths</h3>
                    <p>AI algorithms can analyze student performance and adjust content delivery in real-time. This ensures that each learner receives the right support, at the right pace, in the right way.</p>

                    <h3>2. Intelligent Tutoring Systems</h3>
                    <p>Virtual tutors powered by AI can now engage students in one-on-one learning, providing feedback, explanations, and encouragement just like a human teacher—but 24/7.</p>

                    <h3>3. Teacher Support Tools</h3>
                    <p>From automating administrative tasks to generating lesson plans, AI frees up educators to focus on what matters most: student engagement and creativity.</p>

                    <h3>4. Bridging Global Education Gaps</h3>
                    <p>AI-driven platforms can reach remote and underserved communities, offering quality education in multiple languages and contexts.</p>

                    <p>As we look ahead, AI will not replace teachers—it will empower them to teach more effectively and inclusively. The classroom of tomorrow is already here, and it’s powered by intelligent technology.</p>
                ',
                'category' => getGUID("11b3016f-4944-4467-ba98-9de4031ffe21"),
                'tags' => 'AI, education, learning, edtech, innovation',
                'is_featured' => true,
                'status' => 1,
                'created_by' => getGUID(getDefaultAdminGUID()),
                'updated_by' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 hour')),
                'total_views' => 3,
                'meta_title' => 'AI and the Future of Learning',
                'meta_description' => 'Explore how AI is reshaping education through personalized learning, intelligent tutoring, and global accessibility.',
                'meta_keywords' => 'AI, education, edtech, personalized learning, future of education, artificial intelligence in schools',
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

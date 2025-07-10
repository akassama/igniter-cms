-- Database Backup
-- Generated: 2025-07-09 18:15:46
-- Server: localhost
-- Database: igniter_cms_db



-- Table structure for table `activity_logs`

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `activity_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`),
  UNIQUE KEY `activity_id` (`activity_id`),
  KEY `activity_by` (`activity_by`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `activity_logs`
INSERT INTO `activity_logs` VALUES ('686e7127457b6', '2646D733-A3C2-47BC-9C5D-E04DD8FCA077', 'user_logout', 'User Logout: User with id: 2646D733-A3C2-47BC-9C5D-E04DD8FCA077 logged out.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 14:39:51', '2025-07-09 14:39:51');
INSERT INTO `activity_logs` VALUES ('686e7132e4ef0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'user_login', 'User Login: User logged in with id: 57E1F579-8693-41E8-89D3-18CCC9CC93F9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 14:40:03', '2025-07-09 14:40:03');
INSERT INTO `activity_logs` VALUES ('686e72830d571', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_updated', 'Theme Updated: Theme updated with id: 5D94E549-D89E-4293-BCB6-D74BC11D666C', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 14:45:40', '2025-07-09 14:45:40');
INSERT INTO `activity_logs` VALUES ('686e9475df294', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_created', 'Theme Created: Theme added to database: Giz Tech', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 17:10:30', '2025-07-09 17:10:30');
INSERT INTO `activity_logs` VALUES ('686e94ddd4821', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_updated', 'Theme Updated: Theme with id: 44499E14-EC4A-4F57-B0DB-80BD0AC56C61set as active.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 17:12:14', '2025-07-09 17:12:14');
INSERT INTO `activity_logs` VALUES ('686e94f361099', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_updated', 'Theme Updated: Theme with id: 5D94E549-D89E-4293-BCB6-D74BC11D666Cset as active.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 17:12:36', '2025-07-09 17:12:36');
INSERT INTO `activity_logs` VALUES ('686ea8cf506b7', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_updated', 'Theme Updated: Theme with id: 44499E14-EC4A-4F57-B0DB-80BD0AC56C61set as active.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 18:37:20', '2025-07-09 18:37:20');
INSERT INTO `activity_logs` VALUES ('686ea8dc6ad7f', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_updated', 'Theme Updated: Theme with id: 5D94E549-D89E-4293-BCB6-D74BC11D666Cset as active.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 18:37:33', '2025-07-09 18:37:33');
INSERT INTO `activity_logs` VALUES ('686ead6370a0e', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_created', 'Theme Created: Theme added to database: Giz Tech', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 18:56:52', '2025-07-09 18:56:52');
INSERT INTO `activity_logs` VALUES ('686eaf150db90', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_created', 'Theme Created: Theme added to database: Giz Tech', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:04:06', '2025-07-09 19:04:06');
INSERT INTO `activity_logs` VALUES ('686eb090d8f22', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'failed_delete_log', 'Failed Delete Action: User with id: 57E1F579-8693-41E8-89D3-18CCC9CC93F9 failed to delete theme for table name: themes with path: giz-tech. Error: Theme not found', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:10:26', '2025-07-09 19:10:26');
INSERT INTO `activity_logs` VALUES ('686eb0ccbb069', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_created', 'Theme Created: Theme added to database: Giz Tech', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:11:26', '2025-07-09 19:11:26');
INSERT INTO `activity_logs` VALUES ('686eb0e4a7fd6', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'theme_delete', 'Theme Deletion: User with id: 57E1F579-8693-41E8-89D3-18CCC9CC93F9 deleted theme for table name: themes with path: giz-tech', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:11:49', '2025-07-09 19:11:49');
INSERT INTO `activity_logs` VALUES ('686eb18586948', 'admin@example.com', 'module_search', 'Module Search: User with email: admin@example.com made a search for: portfolio', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:14:30', '2025-07-09 19:14:30');
INSERT INTO `activity_logs` VALUES ('686eb193934e8', 'admin@example.com', 'module_search', 'Module Search: User with email: admin@example.com made a search for: theme', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-07-09 19:14:44', '2025-07-09 19:14:44');


-- Table structure for table `api_accesses`

DROP TABLE IF EXISTS `api_accesses`;
CREATE TABLE `api_accesses` (
  `api_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `api_accesses`
INSERT INTO `api_accesses` VALUES ('6346A778-9B41-4DE5-81AE-BBF21B1C3C15', '174185718f12605b01578866ac856b9050879a87fbdcdc288a57aa4d6bf221d0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');


-- Table structure for table `api_calls_tracker`

DROP TABLE IF EXISTS `api_calls_tracker`;
CREATE TABLE `api_calls_tracker` (
  `api_call_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`api_call_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `app_modules`

DROP TABLE IF EXISTS `app_modules`;
CREATE TABLE `app_modules` (
  `app_module_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `module_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `module_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_search_terms` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_roles` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`app_module_id`),
  UNIQUE KEY `app_module_id` (`app_module_id`),
  KEY `module_name` (`module_name`),
  KEY `module_description` (`module_description`),
  KEY `module_search_terms` (`module_search_terms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `app_modules`
INSERT INTO `app_modules` VALUES ('16CEA4C5-6B61-421D-B47C-8DCCA6645AFA', 'Configurations', 'Manage configurations', 'configurations,settings,preferences', 'Admin', 'account/admin/configurations', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('27AF2A75-328B-4BD1-B755-AEF0CA45F0EA', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics', 'Admin', 'account/admin/visit-stats', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('2E677D52-7AE6-42EF-9383-EA9C8FE0E4A8', 'Pages', 'Manage pages', 'pages,content,publish', 'Admin,Manager,User', 'account/cms/pages', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('2FDAD312-1E13-42FE-8E84-97353FB71A2C', 'Change Password', 'Change account password', 'password,security,change', 'Admin,Manager,User', 'account/settings/change-password', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('36B6E557-B462-4A70-BE93-25FFAB1E40B7', 'Users', 'Manage application users', 'users,accounts,people', 'Admin', 'account/admin/users', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('475280D6-05D6-42AD-B013-34066F8F6607', 'Categories', 'Manage categories', 'category,categories,post category', 'Admin,Manager,User', 'account/cms/categories', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('4DC21F90-556C-47D0-9AFA-12B88A65E378', 'Themes', 'Manage themes', 'themes,appearance,design', 'Admin', 'account/themes', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('534621E5-643B-4A62-BFDC-C81D80FB6B9A', 'Translations', 'Manage translations', 'translations,language,localization', 'Admin', 'account/admin/translations', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('5F6B5248-985B-442E-B249-FFD6526109AA', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'unblock,whitelist,security,allow ip', 'Admin', 'account/admin/whitelisted-ips', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('7C970FB8-FD5E-44DB-8C7C-713266A74F18', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny ip,spam', 'Admin', 'account/admin/blocked-ips', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('812E13FE-F5DE-4FD8-AB2D-31181C73DC73', 'Backup', 'Manage backups', 'backup,restore,database', 'Admin', 'account/admin/backups', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('8CB2C1B1-C750-41AC-8E8E-9CAE3F3EC12B', 'Activity Logs', 'View activity logs', 'logs,activity,tracking', 'Admin', 'account/admin/activity-logs', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('9EC01667-2938-4346-B673-740BDC42CEB0', 'Error Logs', 'View error logs', 'error logs,activity,tracking', 'Admin', 'account/admin/logs', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('A7390D34-0C01-400E-8EF1-96DDC3F25E21', 'Account Details', 'Update account details', 'account,profile,settings', 'Admin,Manager,User', 'account/settings/update-details', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('AF50FF5C-C64A-4D35-A5D5-8898987BAD38', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links', 'Admin,Manager,User', 'account/cms/navigations', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('AF634DF8-6247-480A-A174-114BCC864BF0', 'Admin', 'Administration', 'admin,control,management', 'Admin', 'account/admin', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('B13958D8-61A1-4583-9641-13BDF222BA7F', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview', 'Admin,Manager,User', 'account/dashboard', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('B5C45225-3568-4F1F-A72E-45A07BFE103F', 'API Keys', 'Manage api keys', 'api,keys,access', 'Admin', 'account/admin/api-keys', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('E81F9C62-44C6-4105-8F50-3F85FA6DBB7A', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts', 'Admin,Manager,User', 'account/cms/blogs', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('E9D78FB4-8E94-432D-8335-8ABECDA8FB0C', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets', 'Admin,Manager,User', 'account/cms/content-blocks', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('F38B4C55-2E6B-406B-9B42-52CE6C47560B', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('F3E19CF1-96B9-4205-9D74-41C72B104F04', 'File Editor', 'Edit and update theme files', 'themes,customize,ui', 'Admin', 'account/admin/file-editor', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('F42C3C45-86B4-495D-9674-8778468E9F8E', 'Codes', 'Manage codes', 'codes,references,identifiers', 'Admin', 'account/admin/codes', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `app_modules` VALUES ('F911E5EB-655A-4E99-AE45-F138BF08BD9A', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude, gemini, deepseek', 'Admin,Manager,User', 'account/cms/policies', '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `backups`

DROP TABLE IF EXISTS `backups`;
CREATE TABLE `backups` (
  `backup_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `backup_file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `blocked_ips`

DROP TABLE IF EXISTS `blocked_ips`;
CREATE TABLE `blocked_ips` (
  `blocked_ip_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `block_start_time` timestamp NULL DEFAULT NULL,
  `block_end_time` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `page_visited_url` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`blocked_ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `blogs`

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `excerpt` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_general_ci,
  `is_featured` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_views` int DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_general_ci,
  `meta_keywords` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`blog_id`),
  KEY `title` (`title`),
  KEY `slug` (`slug`),
  KEY `category` (`category`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `blogs`
INSERT INTO `blogs` VALUES ('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'public/uploads/files/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2025-07-09 12:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('8e98b4c1-7f41-46c4-97fd-b59ecb57cbe8', 'AI and the Future of Learning', 'ai-and-the-future-of-learning', 'public/uploads/files/blog-16.jpg', 'Artificial Intelligence is reshaping how students learn, teachers teach, and institutions adapt. Discover how AI is driving personalized and lifelong education.', '\r\n                    <h2>AI and the Future of Learning</h2>\r\n                    <p>Education is undergoing a quiet revolution—and AI is at the heart of it. From adaptive learning platforms to automated grading systems, artificial intelligence is redefining the classroom experience across the globe.</p>\r\n                    \r\n                    <h3>1. Personalized Learning Paths</h3>\r\n                    <p>AI algorithms can analyze student performance and adjust content delivery in real-time. This ensures that each learner receives the right support, at the right pace, in the right way.</p>\r\n\r\n                    <h3>2. Intelligent Tutoring Systems</h3>\r\n                    <p>Virtual tutors powered by AI can now engage students in one-on-one learning, providing feedback, explanations, and encouragement just like a human teacher—but 24/7.</p>\r\n\r\n                    <h3>3. Teacher Support Tools</h3>\r\n                    <p>From automating administrative tasks to generating lesson plans, AI frees up educators to focus on what matters most: student engagement and creativity.</p>\r\n\r\n                    <h3>4. Bridging Global Education Gaps</h3>\r\n                    <p>AI-driven platforms can reach remote and underserved communities, offering quality education in multiple languages and contexts.</p>\r\n\r\n                    <p>As we look ahead, AI will not replace teachers—it will empower them to teach more effectively and inclusively. The classroom of tomorrow is already here, and it’s powered by intelligent technology.</p>\r\n                ', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, education, learning, edtech, innovation', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '3', 'AI and the Future of Learning', 'Explore how AI is reshaping education through personalized learning, intelligent tutoring, and global accessibility.', 'AI, education, edtech, personalized learning, future of education, artificial intelligence in schools', '2025-07-09 08:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainable Living: Small Changes with Big Impact', 'sustainable-living-small-changes', 'public/uploads/files/blog-4.jpg', 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.', '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'sustainability, eco-friendly, lifestyle', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '0', 'Sustainable Living Tips', 'Easy ways to reduce your environmental impact through daily choices.', 'sustainability, eco-friendly, green living', '2025-07-09 09:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('a7b8c9d0-e1f2-3456-789a-bcdef1234567', 'Essential Cybersecurity Practices for Small Businesses', 'cybersecurity-small-businesses', 'public/uploads/files/blog-10.jpg', 'Practical security measures every small business should implement to protect against growing cyber threats.', '<h2>Essential Cybersecurity for Small Businesses</h2><p>Small businesses are frequent targets. Essential protections include:</p><h3>1. Strong Password Policies</h3><p>Require complex passwords and multi-factor authentication.</p><h3>2. Regular Software Updates</h3><p>Patch vulnerabilities in all systems and applications.</p><h3>3. Employee Training</h3><p>Educate staff on phishing and social engineering risks.</p><h3>4. Secure Backup Systems</h3><p>Maintain encrypted, off-site backups of critical data.</p><h3>5. Network Security</h3><p>Use firewalls and secure Wi-Fi networks.</p><h3>6. Incident Response Plan</h3><p>Prepare for potential breaches with clear protocols.</p><p>Investing in cybersecurity protects your business, customers, and reputation.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'cybersecurity, business, technology', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Small Business Cybersecurity', 'Essential security practices for protecting small businesses.', 'cybersecurity, small business, data protection', '2025-07-09 03:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'The Science of Productivity: Work Smarter, Not Harder', 'science-of-productivity', 'public/uploads/files/blog-5.jpg', 'Evidence-based strategies to boost your productivity and achieve more in less time without burning out.', '<h2>The Science of Productivity</h2><p>Productivity isn\'t about working longer hours—it\'s about working smarter. Research-backed techniques can help you maximize efficiency:</p><h3>1. The Pomodoro Technique</h3><p>Work in focused 25-minute intervals with 5-minute breaks.</p><h3>2. Time Blocking</h3><p>Schedule specific blocks for different tasks to minimize context-switching.</p><h3>3. The Two-Minute Rule</h3><p>If a task takes less than two minutes, do it immediately.</p><h3>4. Deep Work</h3><p>Create distraction-free periods for cognitively demanding tasks.</p><h3>5. Rest Strategically</h3><p>Quality breaks boost subsequent productivity.</p><p>By implementing these methods, you can accomplish more while maintaining work-life balance.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'productivity, work, efficiency', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Science-Backed Productivity Tips', 'Research-proven methods to enhance your work efficiency.', 'productivity, efficiency, time management', '2025-07-09 08:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('b8c9d0e1-f2g3-4567-89ab-cdef12345678', 'The Rise of Plant-Based Diets: Health and Environmental Benefits', 'plant-based-diets-benefits', 'public/uploads/files/blog-11.jpg', 'Exploring the growing popularity of plant-based eating and its positive impacts on personal health and the planet.', '<h2>The Rise of Plant-Based Diets</h2><p>Plant-based eating offers significant benefits:</p><h3>1. Health Advantages</h3><p>Linked to lower risks of heart disease, diabetes, and certain cancers.</p><h3>2. Environmental Impact</h3><p>Requires fewer resources than animal agriculture.</p><h3>3. Getting Enough Protein</h3><p>Beans, lentils, tofu, and quinoa are excellent sources.</p><h3>4. Transition Tips</h3><p>Start with meatless Mondays or plant-based breakfasts.</p><h3>5. Nutritional Considerations</h3><p>Pay attention to vitamin B12, iron, and omega-3s.</p><h3>6. Global Cuisine Inspiration</h3><p>Explore Mediterranean, Indian, and East Asian plant-based dishes.</p><p>A plant-based diet can be nutritious, delicious, and sustainable.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'nutrition, health, sustainability', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Benefits of Plant-Based Diets', 'Health and environmental advantages of plant-based eating.', 'plant-based, vegan, nutrition, sustainability', '2025-07-09 02:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('c3d4e5f6-a7b8-9012-3456-7890abcdef12', 'Urban Gardening: Growing Food in Small Spaces', 'urban-gardening-small-spaces', 'public/uploads/files/blog-6.jpg', 'You don\'t need a backyard to grow your own food. Learn how to create a thriving garden in apartments and small urban spaces.', '<h2>Urban Gardening in Small Spaces</h2><p>Limited space doesn\'t mean you can\'t enjoy homegrown produce. Here\'s how to garden in urban environments:</p><h3>1. Container Gardening</h3><p>Use pots, buckets, or hanging planters for vegetables and herbs.</p><h3>2. Vertical Gardens</h3><p>Utilize wall space with trellises or pocket planters.</p><h3>3. Windowsill Gardens</h3><p>Grow herbs and microgreens right in your kitchen window.</p><h3>4. Community Gardens</h3><p>Join local gardening initiatives if you lack personal space.</p><h3>5. Best Plants for Small Spaces</h3><p>Try lettuce, cherry tomatoes, peppers, basil, and dwarf varieties.</p><p>Urban gardening brings fresh food and greenery to city living.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'gardening, urban, sustainability', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '0', 'Urban Gardening Guide', 'Tips for growing food in apartments and small urban spaces.', 'urban gardening, container gardening, small space gardening', '2025-07-09 07:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('c9d0e1f2-g3h4-5678-9abc-def123456789', 'Financial Planning for Millennials: Building Wealth in Your 30s', 'financial-planning-millennials', 'public/uploads/files/blog-12.jpg', 'Practical money management strategies to help millennials achieve financial stability and build long-term wealth.', '<h2>Financial Planning for Millennials</h2><p>Key strategies for financial health in your 30s:</p><h3>1. Pay Down High-Interest Debt</h3><p>Focus on credit cards and personal loans first.</p><h3>2. Build an Emergency Fund</h3><p>Aim for 3-6 months of living expenses.</p><h3>3. Start Investing Early</h3><p>Take advantage of compound growth in retirement accounts.</p><h3>4. Increase Retirement Contributions</h3><p>Boost your 401(k) or IRA contributions annually.</p><h3>5. Protect Your Income</h3><p>Consider disability insurance if you depend on your paycheck.</p><h3>6. Side Hustles for Extra Income</h3><p>Develop multiple income streams when possible.</p><p>Smart money habits now pay dividends for decades to come.</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'finance, millennials, investing', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Millennial Financial Planning', 'Wealth-building strategies for millennials in their 30s.', 'finance, millennials, retirement, investing', '2025-07-09 01:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('d0e1f2g3-h4i5-6789-abcd-ef1234567890', 'The Evolution of Social Media: What\'s Next?', 'evolution-of-social-media', 'public/uploads/files/blog-13.jpg', 'How social media platforms have transformed communication and what emerging trends suggest about their future direction.', '<h2>The Evolution of Social Media</h2><p>Social media continues evolving rapidly:</p><h3>1. The Rise of Ephemeral Content</h3><p>Stories and disappearing messages dominate engagement.</p><h3>2. Video-First Platforms</h3><p>TikTok\'s success pushes all platforms toward video.</p><h3>3. Niche Communities</h3><p>Users seek smaller, interest-based networks.</p><h3>4. Commerce Integration</h3><p>Social platforms become shopping destinations.</p><h3>5. Augmented Reality Features</h3><p>Filters and virtual try-ons enhance user experience.</p><h3>6. Privacy Concerns</h3><p>Users demand more control over their data.</p><p>The future likely holds more immersive, personalized, and transactional experiences.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'social media, technology, trends', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '0', 'Future of Social Media', 'Emerging trends and the evolution of social platforms.', 'social media, digital marketing, technology', '2025-07-09 00:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('d4e5f6a7-b8c9-0123-4567-890abcdef123', 'The Future of Remote Work: Trends and Predictions', 'future-of-remote-work', 'public/uploads/files/blog-7.jpg', 'How remote work is evolving and what professionals can expect in the coming years as workplace norms continue to change.', '<h2>The Future of Remote Work</h2><p>The remote work revolution is just beginning. Key trends shaping its future include:</p><h3>1. Hybrid Work Models</h3><p>Most companies will adopt flexible office/remote schedules.</p><h3>2. Digital Nomadism</h3><p>More professionals will work while traveling internationally.</p><h3>3. Results-Only Work Environments</h3><p>Focus will shift from hours logged to output produced.</p><h3>4. Virtual Collaboration Tools</h3><p>Continued innovation in remote team technologies.</p><h3>5. Workspace Flexibility</h3><p>Companies will offer stipends for home office setups.</p><h3>6. Global Talent Pools</h3><p>Location will matter less for hiring decisions.</p><p>Remote work is here to stay, but its form will continue evolving.</p>', 'f0b860dc-624c-439a-9de8-f3164c981b08', 'remote work, future, career', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Remote Work Future Trends', 'How remote work is evolving and what to expect in coming years.', 'remote work, future of work, digital nomad', '2025-07-09 06:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'public/uploads/files/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'office, stakes, competitive', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2025-07-09 11:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('e1f2g3h4-i5j6-7890-bcde-f12345678901', 'Minimalist Travel: Packing Light for Stress-Free Trips', 'minimalist-travel-packing', 'public/uploads/files/blog-14.jpg', 'How to embrace minimalist packing techniques to make your travels easier, cheaper, and more enjoyable.', '<h2>Minimalist Travel: Packing Light</h2><p>Traveling with less brings more freedom:</p><h3>1. The Capsule Wardrobe Approach</h3><p>Pack versatile, mix-and-match clothing items.</p><h3>2. Toiletries Strategy</h3><p>Use small containers and multi-use products.</p><h3>3. Digital Documents</h3><p>Store tickets and reservations on your phone.</p><h3>4. The \"Pack Half\" Rule</h3><p>Lay out what you think you need, then remove half.</p><h3>5. Wear Your Bulkiest Items</h3><p>Jackets and heavy shoes should be worn, not packed.</p><h3>6. Laundry on the Road</h3><p>Plan to wash clothes rather than overpack.</p><p>With practice, you can travel comfortably with just carry-on luggage for any trip length.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'travel, minimalism, lifestyle', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Minimalist Packing Guide', 'How to pack light for stress-free travel experiences.', 'travel, packing, minimalism', '2025-07-08 23:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('e5f6a7b8-c9d0-1234-5678-90abcdef1234', 'Mindfulness Meditation for Beginners', 'mindfulness-meditation-beginners', 'public/uploads/files/blog-8.jpg', 'A step-by-step guide to starting a mindfulness meditation practice, even if you\'ve never meditated before.', '<h2>Mindfulness Meditation for Beginners</h2><p>Mindfulness meditation is simple but powerful. Here\'s how to begin:</p><h3>1. Find a Quiet Space</h3><p>Start with just 5 minutes in a comfortable, distraction-free area.</p><h3>2. Focus on Your Breath</h3><p>Pay attention to the sensation of breathing in and out.</p><h3>3. Notice When Your Mind Wanders</h3><p>Gently return focus to your breath without judgment.</p><h3>4. Body Scan</h3><p>Progressively notice sensations throughout your body.</p><h3>5. Make It a Habit</h3><p>Consistency matters more than duration when starting.</p><h3>6. Use Guided Meditations</h3><p>Apps or recordings can help when beginning.</p><p>Regular practice reduces stress and increases focus. Be patient with yourself.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'meditation, mindfulness, wellness', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '0', 'Beginner\'s Guide to Mindfulness', 'Simple steps to start a mindfulness meditation practice.', 'meditation, mindfulness, mental health', '2025-07-09 05:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('f2g3h4i5-j6k7-8901-cdef-234567890123', 'The Science of Sleep: Optimizing Your Rest for Better Health', 'science-of-sleep-optimization', 'public/uploads/files/blog-15.jpg', 'Evidence-based strategies to improve sleep quality and duration, leading to better physical and mental health.', '<h2>The Science of Sleep Optimization</h2><p>Quality sleep is foundational to health. Research shows:</p><h3>1. Consistent Sleep Schedule</h3><p>Going to bed and waking at the same time regulates your circadian rhythm.</p><h3>2. Ideal Sleep Environment</h3><p>Cool, dark, and quiet rooms promote better rest.</p><h3>3. Blue Light Reduction</h3><p>Avoid screens 1-2 hours before bedtime.</p><h3>4. Caffeine Timing</h3><p>Limit caffeine after 2pm for undisturbed sleep.</p><h3>5. The 20-Minute Rule</h3><p>If you can\'t sleep, get up and do something relaxing.</p><h3>6. Sleep Tracking</h3><p>Use technology judiciously to identify patterns.</p><p>Prioritizing sleep improves cognition, mood, immunity, and longevity.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'sleep, health, wellness', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'How to Improve Your Sleep', 'Science-backed methods for better sleep and health.', 'sleep, health, wellness, neuroscience', '2025-07-08 22:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('f3a5bcef-6ebc-42ec-848e-9dc5d82f7200', 'The Art of Mindful Gardening', 'the-art-of-mindful-gardening', 'public/uploads/files/blog-2.jpg', 'Discover the therapeutic benefits of mindful gardening and how it can transform your outdoor space into a sanctuary of peace and tranquility.', '<h2>The Art of Mindful Gardening</h2> <p>In our fast-paced world, finding moments of peace can be challenging. Mindful gardening offers a serene escape, allowing you to connect with nature and cultivate a sense of calm. Here is how to transform your garden into a sanctuary:</p> <h3>1. Engage Your Senses</h3> <p>Take a moment to feel the soil, listen to the rustling leaves, and breathe in the floral scents. Engaging your senses helps ground you in the present moment.</p> <h3>2. Embrace the Process</h3> <p>Gardening is a journey, not a destination. Embrace the process of planting, watering, and nurturing your plants, and let go of the need for immediate results.</p> <h3>3. Create a Routine</h3> <p>Set aside time each day to tend to your garden. This routine can become a meditative practice, providing structure and tranquility to your day.</p> <h3>4. Reflect and Appreciate</h3> <p>Take time to reflect on the growth in your garden and in yourself. Appreciate the beauty of nature and the peace it brings to your life.</p> <p>Mindful gardening is more than a hobby; its a path to inner peace. Start small, be present, and watch your garden—and your mind—bloom.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'gardening, mindfulness, mental health, wellness', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '0', 'The Art of Mindful Gardening', 'This is a sample blog post for demonstration purposes.', 'gardening, mindfulness, mental health, wellness', '2025-07-09 10:39:36', '2025-07-09 14:39:36');
INSERT INTO `blogs` VALUES ('f6a7b8c9-d0e1-2345-6789-0abcdef12345', 'The Psychology of Color in Marketing', 'psychology-of-color-marketing', 'public/uploads/files/blog-9.jpg', 'How different colors influence consumer behavior and what this means for your branding and marketing strategies.', '<h2>The Psychology of Color in Marketing</h2><p>Colors evoke emotions and influence decisions. Key insights:</p><h3>1. Red</h3><p>Creates urgency - often used for clearance sales.</p><h3>2. Blue</h3><p>Builds trust - favored by banks and tech companies.</p><h3>3. Green</h3><p>Associated with health and environment - used for organic products.</p><h3>4. Yellow</h3><p>Grabs attention - effective for window displays.</p><h3>5. Black</h3><p>Signifies luxury - common for high-end products.</p><h3>6. Cultural Differences</h3><p>Color meanings vary globally (e.g., white symbolizes mourning in some cultures).</p><p>Choose colors strategically based on your target audience and brand personality.</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'marketing, psychology, design', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '1', 'Color Psychology in Marketing', 'How colors affect consumer perceptions and buying decisions.', 'color psychology, marketing, branding', '2025-07-09 04:39:36', '2025-07-09 14:39:36');


-- Table structure for table `categories`

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `order` int DEFAULT '10',
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  KEY `title` (`title`),
  KEY `group` (`group`),
  KEY `parent` (`parent`),
  KEY `status` (`status`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` VALUES ('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', '0', '2', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('181dd10c-49d4-49bb-b3c0-f81ff69a35f6', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', '0', '4', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Lifestyle & Wellness', 'Tips for healthy living, mindfulness practices, and personal development', NULL, NULL, 'lifestyle-wellness', '0', '3', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'Technology & Innovation', 'Cutting-edge technology trends, AI developments, and digital innovations', NULL, NULL, 'technology-innovation', '0', '2', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Business & Career', 'Articles about business strategies, career development, and workplace trends', NULL, NULL, 'business-career', '0', '1', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainability', 'Eco-friendly living, environmental awareness, and sustainable practices', NULL, NULL, 'sustainability', '0', '4', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'Personal Finance', 'Money management, investing tips, and financial planning strategies', NULL, NULL, 'personal-finance', '0', '5', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `categories` VALUES ('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', '0', '6', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `codes`

DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `code_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `code_for` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `code` text COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`code_id`),
  UNIQUE KEY `code_for` (`code_for`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `codes`
INSERT INTO `codes` VALUES ('128EDAD6-A12E-4556-8512-D97D4D986EAD', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `codes` VALUES ('48A0B539-72EE-4849-8C6E-AF294FCC5314', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `codes` VALUES ('D9664724-9C8E-4336-8FB7-86483F21CF6E', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');


-- Table structure for table `configurations`

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `config_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `config_for` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `config_value` text COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Text',
  `options` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `default_value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom_class` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `search_terms` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `config_id` (`config_id`),
  UNIQUE KEY `config_for` (`config_for`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `configurations`
INSERT INTO `configurations` VALUES ('0BBAA330-E9FF-4EE5-8820-38653EF0C6B0', 'MetaTitle', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('0C35F1C9-BFA0-44FC-AD7A-1CB6B0E0E6DD', 'MaintenanceMode', 'Enable or disable maintenance mode for the site.', 'No', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'No', '', 'maintenance,mode,status,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('0C470778-7424-4438-AA65-16B1B5830644', 'CompanyName', 'Name of the company or organization.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('1333574D-BBC0-40AC-BE84-E509DFEFFC57', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'public/uploads/files/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('1A12F784-18C7-49E1-98EA-91C8DA3CA21C', 'BlogsPageMetaKeywords', 'Meta keywords for the blogs page.', 'blog, news, articles, insights, updates, expert opinions', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'blog,meta,keywords,tags', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('2015F047-2851-42B1-8606-F1CD1AE287A6', 'PostHogCode', 'Add this snippet to your website within the <head> tag and you\'ll be ready to start using PostHog. Learn more: https://posthog.com/', '<script>!function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(t,o,n){    function i(t,e){var o=e.split(\".\");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){    t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}var s=e;for(void 0!==n?s=e[n]=[]:n=\"posthog\",    s.people=s.people||[],s.toString=function(t){var e=\"posthog\";return\"posthog\"!==n&&(e+=\".\"+n),t||(e+=\" (stub)\"),e},    s.people.toString=function(){return s.toString(1)+\".people (stub)\"};p=\"capture identify alias people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user\".split(\" \"),    r=0;r<p.length;r++)i(s,p[r]);e._i.push([t,o,n])},e.__SV=1.0,o=t.createElement(\"script\"),    o.type=\"text/javascript\",o.async=!0,o.src=\"https://cdn.posthog.com/posthog.js\",n=t.getElementsByTagName(\"script\")[0],    n.parentNode.insertBefore(o,n))}(document,window.posthog||[]);    posthog.init(\"YOUR_PROJECT_API_KEY\", {api_host: \"https://app.posthog.com\"});</script>', 'ri-line-chart-fill', 'share', 'Code', NULL, NULL, '', 'analytics,posthog,script', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('21998B95-672E-417A-B02E-54A3DF43388B', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('2CADB467-7D44-4923-BFBD-4C84331F5656', 'HCaptchaSecretKey', 'hCaptcha is a platform that stops online fraud and abuse with no personal information. It offers high accuracy, low friction, and universal compatibility for web, mobile, and server-side use cases. Learn more: https://www.hcaptcha.com/', 'xjX2pC/0ijGGZ7/PUFxOQ2NmL0V1aDBaa0FPOEVFOGxsdzhUOC9LbTFYRjMyZ1M3K1dXeEREVCtNdEk9', 'ri-key-line', 'security', 'Secret', NULL, NULL, '', 'recaptcha,secret,key,hcaptcha', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('2D0B675C-CC98-4143-8E64-80A38217455F', 'EnableGoogleTranslate', 'Enable or disable Google Translate feature.', 'No', 'ri-earth-line', 'site', 'Select', 'Yes,No', 'No', '', 'translate,google,language', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('2F6F8559-E724-44E1-8F30-891E6D165997', 'MaintenanceModeTitle', 'Title displayed during maintenance mode.', 'We\'ll Be Back Soon!', 'ri-settings-line', 'site', 'Text', NULL, NULL, 'title-text', 'maintenance,mode,status,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('32346A26-E3F4-4530-B090-B9F773561587', 'CompanyAddress', 'Physical address of the company office.', '123 Maple Street<br/> Watford, Hertfordshire<br/> WD17 1AA<br/> United Kingdom', 'ri-map-pin-line', 'site', 'Text', NULL, NULL, 'title-text', 'address,location,office', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('32F15660-2333-4F7E-8AD2-892028E9C395', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('336CDA09-4848-44B4-8B8A-5E149D5A55D0', 'EnableDisqusComments', 'Disqus offers the best add-on tools for websites to increase engagement. Learn more: https://www.disqus.com/', 'Yes', 'ri-disqus-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'disqus,comments,discussion,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('35E1914C-8FF4-4583-8B29-37CD882DBB93', 'EnableDisqusCommentCount', 'Disqus offers the best add-on tools for websites to increase engagement. Learn more: https://www.disqus.com/', 'Yes', 'ri-disqus-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'disqus,comments,discussion,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('3C9DF8C4-0128-40A4-A1A6-020F6AF70470', 'DisqusShortName', 'Provide your disqus shortname link here (e.g. https://your-disqus-shortname.disqus.com/). Do not include \"/embed.js\" or \"/count.js\". Learn more: https://www.disqus.com/', 'https://your-disqus-shortname.disqus.com/', 'ri-disqus-line', 'comment', 'Text', NULL, NULL, '', 'disqus,comments,discussion,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('4066339F-BBC4-41B7-8079-547C58F04AFD', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '1', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('4131A549-7A59-459A-87F7-EF6A458A0D2A', 'GoogleAnalyticsCode', 'Embed code for Google Analytics tracking.', '<!--Google Tag Manager--><script async src=\'https://www.googletagmanager.com/gtag/js?id=YOUR_MEASUREMENT_ID\'></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag(\'js\', new Date());gtag(\'config\', \'YOUR_MEASUREMENT_ID\');</script><!--End Google Tag Manager-->', 'ri-google-line', 'analytics', 'Code', NULL, NULL, '', 'analytics,google,tag manager', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('42CD6A5B-78DF-4A40-B94D-9E70AC890097', 'MetaDescription', 'Description for SEO and meta tags', 'A robust and user-friendly CodeIgniter-based CMS to effortlessly manage your website content.', 'ri-text', 'meta_seo', 'Text', NULL, NULL, '', 'meta,description,seo,page', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('4511F22C-7CB1-442A-840C-D55DE7001001', 'UseCookieConcent', 'Enable or disable cookie consent banner.', 'Yes', 'ri-shield-check-line', 'security', 'Select', 'Yes,No', 'Yes', '', 'security,cookie,consent', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('4EAF2C8B-5B6B-4AD7-8792-ED7CFC6443CD', 'SiteFaviconLinkAppleTouch', 'Apple touch icon link for the frontend interface.', 'public/uploads/files/favicon/apple-touch-icon.png', 'ri-apple-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,apple,touch,icon', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('5653BCDC-BE5C-4665-B073-08929C4A050A', 'SearchFilterPageMetaDescription', 'Meta description for the filtered search results page.', 'Refine your search results using our filter options. Narrow down the results to find exactly what you\'re looking for quickly and easily.', 'ri-filter-2-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'search,filter,meta,description,seo', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('56EE22F8-9528-4CAF-B1E3-7D16693693C8', 'MaintenanceModeText', 'Message displayed during maintenance mode.', 'Our website is currently undergoing scheduled maintenance. <br> Thank you for your patience. Please check back later.', 'ri-settings-line', 'site', 'Textarea', NULL, NULL, '', 'maintenance,mode,status,settings', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('5A3CEACF-922A-4162-AF45-1031E082EB7F', 'CompanySecondaryNumber', 'Secondary contact phone number for the company.', '+44 7911 654321', 'ri-phone-line', 'site', 'Text', NULL, NULL, 'phone-number', 'phone,contact,number,telephone,secondary', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('5F2B41D0-6C68-40E1-9C2E-8835B9E3461E', 'GeminiAPIKey', 'API key for the AI service to use (e.g., Gemini).', '', 'ri-robot-2-fill', 'ai', 'Text', NULL, '', '', 'ai,chat,help,gemini,deepseek,qwen,gpt', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('635B96A2-110E-4C6B-9FFA-012B7E9653A1', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'public/uploads/files/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('6507F9E4-3AA1-433F-914A-27AE9807F6A8', 'SiteLogoTwoLink', 'Logo link for the frontend interface (JPG format).', 'public/uploads/files/ci-cms-logo-horizontal.jpg', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('66EE754B-DCE0-4340-B121-6052169B5C52', 'SearchPageMetaDescription', 'Meta description for the search results page.', 'Use our search page to find the information you need. Browse through the search results to locate the content you\'re looking for.', 'ri-file-search-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'search,meta,description,seo', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('73B4B959-FFAE-436B-9703-3AEB79F09A98', 'SearchPageMetaTitle', 'Meta title for the search results page.', 'Search Results | Find What You\'re Looking For', 'ri-search-line', 'meta_seo', 'Text', NULL, NULL, '', 'search,meta,title,seo', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('7557F5CA-FDC3-4907-832B-ED394C886E46', 'BlogsPageMetaDescription', 'Meta description for the blogs page.', 'Stay updated with the latest news, insights, and articles from our experts. Explore a wide range of topics and join the conversation.', 'ri-file-text-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'blog,meta,description,seo', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('773B8055-4596-491B-A9A2-4270FCEBC640', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('7C8A3DE8-DEA5-4EFC-9A77-7E98ABE616C4', 'InstallationTracked', 'Checks if installation is tracked.', 'Yes', 'ri-line-chart-fill', 'site', 'Select', 'Yes,No', 'No', '', 'tracking,installation,stat', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:54');
INSERT INTO `configurations` VALUES ('7F5131E9-9798-4206-8376-17DA84CCEBCD', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('85D26283-8F20-402D-A4A0-F6C184E83B33', 'CompanyAddressMap', 'Embedded map code to display the company location.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus\" frameborder=\"0\" style=\"border:0; width: 100%; height: 270px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'ri-map-2-line', 'site', 'Code', NULL, NULL, '', 'map,location,directions,address', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('8813ABD1-0245-43F5-98D2-F3430EC4BE7E', 'HCaptchaSiteKey', 'hCaptcha is a platform that stops online fraud and abuse with no personal information. It offers high accuracy, low friction, and universal compatibility for web, mobile, and server-side use cases. Learn more: https://www.hcaptcha.com/', '', 'ri-key-2-line', 'security', 'Text', NULL, NULL, '', 'recaptcha,key,site,hcaptcha', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('8DB8786F-43EB-43D5-BB11-71241F7A26FB', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('94E924F7-0C42-44A0-B9DC-FCAEFB73CBB8', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'public/uploads/files/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('9A50BF27-743F-469C-A9E5-47072BD34D77', 'EnableIgniterNewsFeed', 'Get latest news, features, and security update feeds from Igniter CMS.', 'Yes', 'ri-newspaper-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'igniter-cms,news feed,security updates', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('9C71F20A-09DF-498E-AD53-19092B6C19AD', 'UseCaptcha', 'Enable or disable CAPTCHA for forms.', 'No', 'ri-shield-check-line', 'forms', 'Select', 'Yes,No', 'Yes', '', 'captcha,security,forms,spam', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('A23C9165-7171-45AA-AF0B-73753488C331', 'MetaOgImage', 'Open Graph image for social media sharing.', 'public/uploads/files/ci-cms-logo.jpg', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'meta,og,image,social', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('A2C82330-3474-4E05-89BD-88DADC0A80C7', 'EnableInstallationTracking', 'Enable or disable installation tracking. Only executed once if yes.', 'No', 'ri-line-chart-fill', 'site', 'Select', 'Yes,No', 'Yes', '', 'tracking,installation,stat', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:54');
INSERT INTO `configurations` VALUES ('A3211D2B-DF48-4514-8F06-F1FBC8DD1296', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ConfigurationsModel,, ContentBlocksModel, CountriesModel, LanguagesModel, NavigationsModel, PagesModel, ThemesModel, TranslationsModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('A3750818-CEB3-4AB3-8052-A47567B4669B', 'GeminiBaseURL', 'Base URL for the API AI service to use (e.g., Gemini).', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', 'ri-robot-2-fill', 'ai', 'Text', NULL, 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', '', 'ai,base url,chat,help,gemini,deepseek,qwen,gpt', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('A504E872-584D-49AF-9B09-640347B23F41', 'ShareThisCode', 'You can install the ShareThis share button on your HTML website in a few easy steps. Navigate to the setup page and choose your preference of Inline Buttons or Sticky Buttons. Learn more: https://sharethis.com/', '<script type=\"text/javascript\" src=\"https://platform-api.sharethis.com/js/sharethis.js#property=6XXXXXXXXXXXXXXXXXX&product=sticky-share-buttons&source=platform\" async=\"async\"></script>', 'ri-share-line', 'share', 'Code', NULL, NULL, '', 'share,code,script', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('B222DE44-33DD-4F84-A0EB-10046AD96C5A', 'CookieConcentCode', 'Cookie Consent solution for your website to comply with ePrivacy Directive & GDPR. See options: https://termly.io/, https://www.freeprivacypolicy.com/free-cookie-consent/', '<!-- Cookie Consent by TermsFeed https://www.TermsFeed.com --><script type=\"text/javascript\" src=\"https://www.termsfeed.com/public/cookie-consent/4.2.0/cookie-consent.js\" charset=\"UTF-8\"></script><script type=\"text/javascript\" charset=\"UTF-8\">document.addEventListener(\"DOMContentLoaded\", function () {cookieconsent.run({\"notice_banner_type\":\"simple\",\"consent_type\":\"express\",\"palette\":\"light\",\"language\":\"en\",\"page_load_consent_levels\":[\"strictly-necessary\"],\"notice_banner_reject_button_hide\":false,\"preferences_center_close_button_hide\":false,\"page_refresh_confirmation_buttons\":false,\"website_name\":\"Igniter CMS\"});});</script><noscript>Free cookie consent management tool by <a href=\"https://www.termsfeed.com/\">TermsFeed Generator</a></noscript><!-- End Cookie Consent by TermsFeed https://www.TermsFeed.com --><a href=\"#\" id=\"open_preferences_center\">Update cookies preferences</a>', 'ri-shield-check-line', 'security', 'Code', NULL, NULL, '', 'security,cookie,consent', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('B7203523-C135-48D6-BE5D-C72073B395FA', 'SearchPageMetaKeywords', 'Meta keywords for the search results page.', 'search, search results, find information, browse content, locate content', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'search,meta,keywords,tags', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('B9EB3B0E-FBA9-467A-B46D-05C910211EA2', 'SearchFilterPageMetaKeywords', 'Meta keywords for the filtered search results page.', 'search filter, refine search, filtered results, narrow down, find exactly, search options', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'search,filter,meta,keywords,tags', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('BFC80A9C-2B6E-4B8B-A518-167622B01B1E', 'ChatbotCode', 'Integrate chatbots and monitor customer activity in real time. See options like: https://www.tawk.to/, https://zapier.com/, https://botpress.com/, https://webagent.ai/, https://botpenguin.com/', '<!--Start of Tawk.to Script--><script type=\"text/javascript\">var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();(function(){var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];s1.async=true;s1.src=\"https://embed.tawk.to/[tawk.to.code]\";s1.charset=\"UTF-8\";s1.setAttribute(\"crossorigin\",\"*\");s0.parentNode.insertBefore(s1,s0);})();</script><!--End of Tawk.to Script-->', 'ri-robot-2-line', 'chatbot', 'Code', NULL, NULL, '', 'chatbot,tawk.to', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('C71EEC7A-87F7-4530-98DA-8347412F7302', 'UsePostHog', 'Enable or disable PostHog analytics script.', 'No', 'ri-line-chart-fill', 'forms', 'Select', 'Yes,No', 'No', '', 'analytics,posthog,script', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('C8EDA1EB-5E64-4D98-8A68-5F81483029C4', 'TwitterFeedCode', 'Embed X/Twitter feeds in your web page. See options : https://publish.twitter.com/', '<blockquote class=\"twitter-tweet\" data-dnt=\"true\" align=\"center\"><p lang=\"en\" dir=\"ltr\">It&#39;s pretty awesome how dancing makes robots less intimidating. Looking forward to seeing more nontrivial Machine Learning on these robots. Credit: Boston Dynamics. <a href=\"https://t.co/wnB2i9qhdQ\">pic.twitter.com/wnB2i9qhdQ</a></p>&mdash; Reza Zadeh (@Reza_Zadeh) <a href=\"https://twitter.com/Reza_Zadeh/status/1344009123004747778?ref_src=twsrc%5Etfw\">December 29, 2020</a></blockquote><script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', 'ri-twitter-line', 'security', 'Code', NULL, NULL, '', 'analytics,twitter,feed', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CAAFBAF6-4AED-411A-A144-710CD4B7221C', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CD302EF8-C277-4A43-9FE7-957480E764D6', 'BackendLogoLink', 'Logo link for the backend interface.', 'public/uploads/files/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CD5D2FFE-A628-4055-898A-DAB3797EECE6', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CDEE5FC4-4127-4C1D-8A9B-D1E0A241496A', 'CompanyEnquiryEmail', 'Email address for receiving general enquiries or contact form submissions.', 'contact.us@mail.com', 'ri-customer-service-line', 'site', 'Text', NULL, NULL, 'email', 'email,enquiry,contact,support', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CE3DF37C-6EA0-4554-8B80-93965D673795', 'MetaKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('CE51418E-218E-45D5-A472-6C4990210A50', 'BlogsPageMetaTitle', 'Meta title for the blogs page.', 'Our Blog | Latest News and Insights', 'ri-article-line', 'meta_seo', 'Text', NULL, NULL, '', 'blog,meta,title,seo,page', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('D5247726-7160-4386-912B-7D173E31AA5E', 'SiteFaviconManifestLink', 'Web manifest file link for the frontend interface.', 'public/uploads/files/favicon/site.webmanifest', 'ri-file-list-3-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,manifest,site,web', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('D61ED13A-43D7-4B83-A16A-8344015D53C7', 'SearchFilterPageMetaTitle', 'Meta title for the filtered search results page.', 'Filtered Search Results | Refine Your Search', 'ri-filter-line', 'meta_seo', 'Text', NULL, NULL, '', 'search,filter,meta,title,seo', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('D959C4ED-1A66-4E2B-A692-5F64804F7A83', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('DEED1646-F63D-43EA-8113-ED546EBDABB7', 'SiteFaviconLink96', 'Favicon link for the frontend interface (96x96 size).', 'public/uploads/files/favicon/favicon-96x96.png', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,96,site,icon', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('E2C2B187-E202-4108-83F1-8A186BC4DFF2', 'MetaAuthor', 'Author information for SEO and meta tags', 'Igniter CMS App', 'ri-user-line', 'meta_seo', 'Text', NULL, NULL, '', 'meta,author,seo,page', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('E5AC9C79-6352-4729-922C-9AD552859829', 'CompanySecondaryEmail', 'Secondary contact email for support or general inquiries.', 'igniter.support@mail.com', 'ri-mail-line', 'site', 'Text', NULL, NULL, 'email', 'email,contact,support,communication', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('E6DD548A-8D67-4955-8C38-673F50F56D02', 'CompanyOpeningHours', 'Operating hours of the company.', 'Mon-Fri: 09AM - 05PM', 'ri-time-line', 'site', 'Text', NULL, NULL, '', 'address,location,office', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('EB076F17-4192-43AC-80A4-8E8F29BBFA25', 'CompanyEmail', 'Primary contact email for the company.', 'igniter@mail.com', 'ri-mail-line', 'site', 'Text', NULL, NULL, 'email', 'email,contact,communication', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F1D2EE1A-3641-44D6-9FDB-F4AAF58E8E66', 'UseTwitterFeed', 'Enable or disable Twitter feed integration.', 'Yes', 'ri-twitter-line', 'analytics', 'Select', 'Yes,No', 'Yes', '', 'analytics,twitter,feed', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F1DB0382-D7CA-4867-BB5E-D45F6FEAC2E6', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F21D08B0-31B5-4E7B-8576-A0E08F6914F3', 'UseGoogleAnalytics', 'Enable or disable Google Analytics tracking.', 'Yes', 'ri-bar-chart-line', 'analytics', 'Select', 'Yes,No', 'Yes', '', 'analytics,google,tracking', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F2695710-80B8-424E-B534-70C441655460', 'UseShareThis', 'ShareThis official site. Digital data solutions for media planning, targeting, and measurement. Website tools to grow online audiences. Learn more: https://sharethis.com/', 'Yes', 'ri-share-line', 'share', 'Select', 'Yes,No', 'Yes', '', 'share,social,buttons,sharing', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F3479B70-2E23-4FC0-837B-047DDF1D999F', 'CompanyNumber', 'Primary contact phone number for the company.', '+44 7911 123456', 'ri-phone-line', 'site', 'Text', NULL, NULL, 'phone-number', 'phone,contact,number,telephone', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('F96AB71B-F799-44B6-83A3-FB4420F9235E', 'EnableGlobalSearchIcon', 'Enable or disable global search icon feature.', 'Yes', 'ri-search-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'search,global search,search modal', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `configurations` VALUES ('FFBB2B04-B0E2-4FF3-8070-78E4D067ED95', 'EnableChatbot', 'Enable or disable chatbot integration.', 'Yes', 'ri-robot-2-line', 'chatbot', 'Select', 'Yes,No', 'No', '', 'chatbot,enable', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `content_blocks`

DROP TABLE IF EXISTS `content_blocks`;
CREATE TABLE `content_blocks` (
  `content_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `custom_field` text COLLATE utf8mb4_general_ci,
  `order` int DEFAULT '10',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`content_id`),
  KEY `identifier` (`identifier`),
  KEY `author` (`author`),
  KEY `title` (`title`),
  KEY `group` (`group`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `content_blocks`
INSERT INTO `content_blocks` VALUES ('8690E6CA-1CA7-4103-897B-07BC97F65FBF', 'BusinessServices', '570', 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>', 'ri-database-2-line', 'theme', 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services', 'https://example.com/business-services', '1', '{\"color\": \"#007bff\", \"priority\": \"high\"}', '2', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `content_blocks` VALUES ('C73FE963-71E6-4F00-86D4-CFB54AD813A9', 'SavingInvestments', '570', 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', 'Learn how our investment strategies can maximize your returns while minimizing risks.', 'ri-reactjs-fill', 'theme', 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments', 'https://example.com/saving-investments', '0', '{\"color\": \"#28a745\", \"priority\": \"medium\"}', '4', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `content_blocks` VALUES ('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD', 'OnlineConsulting', '570', 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Access expert advice from anywhere with our virtual consulting services.</p>', 'ri-global-line', 'theme', 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting', 'https://example.com/online-consulting', '1', '{\"color\": \"#dc3545\", \"priority\": \"low\"}', '6', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `countries`

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iso` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nicename` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iso3` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numcode` int DEFAULT NULL,
  `phonecode` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iso` (`iso`),
  KEY `name` (`name`),
  KEY `nicename` (`nicename`),
  KEY `iso3` (`iso3`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `countries`
INSERT INTO `countries` VALUES ('1', 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', '4', '93');
INSERT INTO `countries` VALUES ('2', 'AL', 'ALBANIA', 'Albania', 'ALB', '8', '355');
INSERT INTO `countries` VALUES ('3', 'DZ', 'ALGERIA', 'Algeria', 'DZA', '12', '213');
INSERT INTO `countries` VALUES ('4', 'AS', 'AMERICANSAMOA', 'AmericanSamoa', 'ASM', '16', '1684');
INSERT INTO `countries` VALUES ('5', 'AD', 'ANDORRA', 'Andorra', 'AND', '20', '376');
INSERT INTO `countries` VALUES ('6', 'AO', 'ANGOLA', 'Angola', 'AGO', '24', '244');
INSERT INTO `countries` VALUES ('7', 'AI', 'ANGUILLA', 'Anguilla', 'AIA', '660', '1264');
INSERT INTO `countries` VALUES ('8', 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, '0');
INSERT INTO `countries` VALUES ('9', 'AG', 'ANTIGUAANDBARBUDA', 'AntiguaandBarbuda', 'ATG', '28', '1268');
INSERT INTO `countries` VALUES ('10', 'AR', 'ARGENTINA', 'Argentina', 'ARG', '32', '54');
INSERT INTO `countries` VALUES ('11', 'AM', 'ARMENIA', 'Armenia', 'ARM', '51', '374');
INSERT INTO `countries` VALUES ('12', 'AW', 'ARUBA', 'Aruba', 'ABW', '533', '297');
INSERT INTO `countries` VALUES ('13', 'AU', 'AUSTRALIA', 'Australia', 'AUS', '36', '61');
INSERT INTO `countries` VALUES ('14', 'AT', 'AUSTRIA', 'Austria', 'AUT', '40', '43');
INSERT INTO `countries` VALUES ('15', 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', '31', '994');
INSERT INTO `countries` VALUES ('16', 'BS', 'BAHAMAS', 'Bahamas', 'BHS', '44', '1242');
INSERT INTO `countries` VALUES ('17', 'BH', 'BAHRAIN', 'Bahrain', 'BHR', '48', '973');
INSERT INTO `countries` VALUES ('18', 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', '50', '880');
INSERT INTO `countries` VALUES ('19', 'BB', 'BARBADOS', 'Barbados', 'BRB', '52', '1246');
INSERT INTO `countries` VALUES ('20', 'BY', 'BELARUS', 'Belarus', 'BLR', '112', '375');
INSERT INTO `countries` VALUES ('21', 'BE', 'BELGIUM', 'Belgium', 'BEL', '56', '32');
INSERT INTO `countries` VALUES ('22', 'BZ', 'BELIZE', 'Belize', 'BLZ', '84', '501');
INSERT INTO `countries` VALUES ('23', 'BJ', 'BENIN', 'Benin', 'BEN', '204', '229');
INSERT INTO `countries` VALUES ('24', 'BM', 'BERMUDA', 'Bermuda', 'BMU', '60', '1441');
INSERT INTO `countries` VALUES ('25', 'BT', 'BHUTAN', 'Bhutan', 'BTN', '64', '975');
INSERT INTO `countries` VALUES ('26', 'BO', 'BOLIVIA', 'Bolivia', 'BOL', '68', '591');
INSERT INTO `countries` VALUES ('27', 'BA', 'BOSNIAANDHERZEGOVINA', 'BosniaandHerzegovina', 'BIH', '70', '387');
INSERT INTO `countries` VALUES ('28', 'BW', 'BOTSWANA', 'Botswana', 'BWA', '72', '267');
INSERT INTO `countries` VALUES ('29', 'BV', 'BOUVETISLAND', 'BouvetIsland', NULL, NULL, '0');
INSERT INTO `countries` VALUES ('30', 'BR', 'BRAZIL', 'Brazil', 'BRA', '76', '55');
INSERT INTO `countries` VALUES ('31', 'IO', 'BRITISHINDIANOCEANTERRITORY', 'BritishIndianOceanTerritory', NULL, NULL, '246');
INSERT INTO `countries` VALUES ('32', 'BN', 'BRUNEIDARUSSALAM', 'BruneiDarussalam', 'BRN', '96', '673');
INSERT INTO `countries` VALUES ('33', 'BG', 'BULGARIA', 'Bulgaria', 'BGR', '100', '359');
INSERT INTO `countries` VALUES ('34', 'BF', 'BURKINAFASO', 'BurkinaFaso', 'BFA', '854', '226');
INSERT INTO `countries` VALUES ('35', 'BI', 'BURUNDI', 'Burundi', 'BDI', '108', '257');
INSERT INTO `countries` VALUES ('36', 'KH', 'CAMBODIA', 'Cambodia', 'KHM', '116', '855');
INSERT INTO `countries` VALUES ('37', 'CM', 'CAMEROON', 'Cameroon', 'CMR', '120', '237');
INSERT INTO `countries` VALUES ('38', 'CA', 'CANADA', 'Canada', 'CAN', '124', '1');
INSERT INTO `countries` VALUES ('39', 'CV', 'CAPEVERDE', 'CapeVerde', 'CPV', '132', '238');
INSERT INTO `countries` VALUES ('40', 'KY', 'CAYMANISLANDS', 'CaymanIslands', 'CYM', '136', '1345');
INSERT INTO `countries` VALUES ('41', 'CF', 'CENTRALAFRICANREPUBLIC', 'CentralAfricanRepublic', 'CAF', '140', '236');
INSERT INTO `countries` VALUES ('42', 'TD', 'CHAD', 'Chad', 'TCD', '148', '235');
INSERT INTO `countries` VALUES ('43', 'CL', 'CHILE', 'Chile', 'CHL', '152', '56');
INSERT INTO `countries` VALUES ('44', 'CN', 'CHINA', 'China', 'CHN', '156', '86');
INSERT INTO `countries` VALUES ('45', 'CX', 'CHRISTMASISLAND', 'ChristmasIsland', NULL, NULL, '61');
INSERT INTO `countries` VALUES ('46', 'CC', 'COCOS(KEELING)ISLANDS', 'Cocos(Keeling)Islands', NULL, NULL, '672');
INSERT INTO `countries` VALUES ('47', 'CO', 'COLOMBIA', 'Colombia', 'COL', '170', '57');
INSERT INTO `countries` VALUES ('48', 'KM', 'COMOROS', 'Comoros', 'COM', '174', '269');
INSERT INTO `countries` VALUES ('49', 'CG', 'CONGO', 'Congo', 'COG', '178', '242');
INSERT INTO `countries` VALUES ('50', 'CD', 'CONGO,THEDEMOCRATICREPUBLICOFTHE', 'Congo,theDemocraticRepublicofthe', 'COD', '180', '242');
INSERT INTO `countries` VALUES ('51', 'CK', 'COOKISLANDS', 'CookIslands', 'COK', '184', '682');
INSERT INTO `countries` VALUES ('52', 'CR', 'COSTARICA', 'CostaRica', 'CRI', '188', '506');
INSERT INTO `countries` VALUES ('53', 'CI', 'COTED\'IVOIRE', 'CoteD\'Ivoire', 'CIV', '384', '225');
INSERT INTO `countries` VALUES ('54', 'HR', 'CROATIA', 'Croatia', 'HRV', '191', '385');
INSERT INTO `countries` VALUES ('55', 'CU', 'CUBA', 'Cuba', 'CUB', '192', '53');
INSERT INTO `countries` VALUES ('56', 'CY', 'CYPRUS', 'Cyprus', 'CYP', '196', '357');
INSERT INTO `countries` VALUES ('57', 'CZ', 'CZECHREPUBLIC', 'CzechRepublic', 'CZE', '203', '420');
INSERT INTO `countries` VALUES ('58', 'DK', 'DENMARK', 'Denmark', 'DNK', '208', '45');
INSERT INTO `countries` VALUES ('59', 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', '262', '253');
INSERT INTO `countries` VALUES ('60', 'DM', 'DOMINICA', 'Dominica', 'DMA', '212', '1767');
INSERT INTO `countries` VALUES ('61', 'DO', 'DOMINICANREPUBLIC', 'DominicanRepublic', 'DOM', '214', '1809');
INSERT INTO `countries` VALUES ('62', 'EC', 'ECUADOR', 'Ecuador', 'ECU', '218', '593');
INSERT INTO `countries` VALUES ('63', 'EG', 'EGYPT', 'Egypt', 'EGY', '818', '20');
INSERT INTO `countries` VALUES ('64', 'SV', 'ELSALVADOR', 'ElSalvador', 'SLV', '222', '503');
INSERT INTO `countries` VALUES ('65', 'GQ', 'EQUATORIALGUINEA', 'EquatorialGuinea', 'GNQ', '226', '240');
INSERT INTO `countries` VALUES ('66', 'ER', 'ERITREA', 'Eritrea', 'ERI', '232', '291');
INSERT INTO `countries` VALUES ('67', 'EE', 'ESTONIA', 'Estonia', 'EST', '233', '372');
INSERT INTO `countries` VALUES ('68', 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', '231', '251');
INSERT INTO `countries` VALUES ('69', 'FK', 'FALKLANDISLANDS(MALVINAS)', 'FalklandIslands(Malvinas)', 'FLK', '238', '500');
INSERT INTO `countries` VALUES ('70', 'FO', 'FAROEISLANDS', 'FaroeIslands', 'FRO', '234', '298');
INSERT INTO `countries` VALUES ('71', 'FJ', 'FIJI', 'Fiji', 'FJI', '242', '679');
INSERT INTO `countries` VALUES ('72', 'FI', 'FINLAND', 'Finland', 'FIN', '246', '358');
INSERT INTO `countries` VALUES ('73', 'FR', 'FRANCE', 'France', 'FRA', '250', '33');
INSERT INTO `countries` VALUES ('74', 'GF', 'FRENCHGUIANA', 'FrenchGuiana', 'GUF', '254', '594');
INSERT INTO `countries` VALUES ('75', 'PF', 'FRENCHPOLYNESIA', 'FrenchPolynesia', 'PYF', '258', '689');
INSERT INTO `countries` VALUES ('76', 'TF', 'FRENCHSOUTHERNTERRITORIES', 'FrenchSouthernTerritories', NULL, NULL, '0');
INSERT INTO `countries` VALUES ('77', 'GA', 'GABON', 'Gabon', 'GAB', '266', '241');
INSERT INTO `countries` VALUES ('78', 'GM', 'GAMBIA', 'Gambia', 'GMB', '270', '220');
INSERT INTO `countries` VALUES ('79', 'GE', 'GEORGIA', 'Georgia', 'GEO', '268', '995');
INSERT INTO `countries` VALUES ('80', 'DE', 'GERMANY', 'Germany', 'DEU', '276', '49');
INSERT INTO `countries` VALUES ('81', 'GH', 'GHANA', 'Ghana', 'GHA', '288', '233');
INSERT INTO `countries` VALUES ('82', 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', '292', '350');
INSERT INTO `countries` VALUES ('83', 'GR', 'GREECE', 'Greece', 'GRC', '300', '30');
INSERT INTO `countries` VALUES ('84', 'GL', 'GREENLAND', 'Greenland', 'GRL', '304', '299');
INSERT INTO `countries` VALUES ('85', 'GD', 'GRENADA', 'Grenada', 'GRD', '308', '1473');
INSERT INTO `countries` VALUES ('86', 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', '312', '590');
INSERT INTO `countries` VALUES ('87', 'GU', 'GUAM', 'Guam', 'GUM', '316', '1671');
INSERT INTO `countries` VALUES ('88', 'GT', 'GUATEMALA', 'Guatemala', 'GTM', '320', '502');
INSERT INTO `countries` VALUES ('89', 'GN', 'GUINEA', 'Guinea', 'GIN', '324', '224');
INSERT INTO `countries` VALUES ('90', 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', '624', '245');
INSERT INTO `countries` VALUES ('91', 'GY', 'GUYANA', 'Guyana', 'GUY', '328', '592');
INSERT INTO `countries` VALUES ('92', 'HT', 'HAITI', 'Haiti', 'HTI', '332', '509');
INSERT INTO `countries` VALUES ('93', 'HM', 'HEARDISLANDANDMCDONALDISLANDS', 'HeardIslandandMcdonaldIslands', NULL, NULL, '0');
INSERT INTO `countries` VALUES ('94', 'VA', 'HOLYSEE(VATICANCITYSTATE)', 'HolySee(VaticanCityState)', 'VAT', '336', '39');
INSERT INTO `countries` VALUES ('95', 'HN', 'HONDURAS', 'Honduras', 'HND', '340', '504');
INSERT INTO `countries` VALUES ('96', 'HK', 'HONGKONG', 'HongKong', 'HKG', '344', '852');
INSERT INTO `countries` VALUES ('97', 'HU', 'HUNGARY', 'Hungary', 'HUN', '348', '36');
INSERT INTO `countries` VALUES ('98', 'IS', 'ICELAND', 'Iceland', 'ISL', '352', '354');
INSERT INTO `countries` VALUES ('99', 'IN', 'INDIA', 'India', 'IND', '356', '91');
INSERT INTO `countries` VALUES ('100', 'ID', 'INDONESIA', 'Indonesia', 'IDN', '360', '62');
INSERT INTO `countries` VALUES ('101', 'IR', 'IRAN,ISLAMICREPUBLICOF', 'Iran,IslamicRepublicof', 'IRN', '364', '98');
INSERT INTO `countries` VALUES ('102', 'IQ', 'IRAQ', 'Iraq', 'IRQ', '368', '964');
INSERT INTO `countries` VALUES ('103', 'IE', 'IRELAND', 'Ireland', 'IRL', '372', '353');
INSERT INTO `countries` VALUES ('104', 'IL', 'ISRAEL', 'Israel', 'ISR', '376', '972');
INSERT INTO `countries` VALUES ('105', 'IT', 'ITALY', 'Italy', 'ITA', '380', '39');
INSERT INTO `countries` VALUES ('106', 'JM', 'JAMAICA', 'Jamaica', 'JAM', '388', '1876');
INSERT INTO `countries` VALUES ('107', 'JP', 'JAPAN', 'Japan', 'JPN', '392', '81');
INSERT INTO `countries` VALUES ('108', 'JO', 'JORDAN', 'Jordan', 'JOR', '400', '962');
INSERT INTO `countries` VALUES ('109', 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', '398', '7');
INSERT INTO `countries` VALUES ('110', 'KE', 'KENYA', 'Kenya', 'KEN', '404', '254');
INSERT INTO `countries` VALUES ('111', 'KI', 'KIRIBATI', 'Kiribati', 'KIR', '296', '686');
INSERT INTO `countries` VALUES ('112', 'KP', 'KOREA,DEMOCRATICPEOPLE\'SREPUBLICOF', 'Korea,DemocraticPeople\'sRepublicof', 'PRK', '408', '850');
INSERT INTO `countries` VALUES ('113', 'KR', 'KOREA,REPUBLICOF', 'Korea,Republicof', 'KOR', '410', '82');
INSERT INTO `countries` VALUES ('114', 'KW', 'KUWAIT', 'Kuwait', 'KWT', '414', '965');
INSERT INTO `countries` VALUES ('115', 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', '417', '996');
INSERT INTO `countries` VALUES ('116', 'LA', 'LAOPEOPLE\'SDEMOCRATICREPUBLIC', 'LaoPeople\'sDemocraticRepublic', 'LAO', '418', '856');
INSERT INTO `countries` VALUES ('117', 'LV', 'LATVIA', 'Latvia', 'LVA', '428', '371');
INSERT INTO `countries` VALUES ('118', 'LB', 'LEBANON', 'Lebanon', 'LBN', '422', '961');
INSERT INTO `countries` VALUES ('119', 'LS', 'LESOTHO', 'Lesotho', 'LSO', '426', '266');
INSERT INTO `countries` VALUES ('120', 'LR', 'LIBERIA', 'Liberia', 'LBR', '430', '231');
INSERT INTO `countries` VALUES ('121', 'LY', 'LIBYANARABJAMAHIRIYA', 'LibyanArabJamahiriya', 'LBY', '434', '218');
INSERT INTO `countries` VALUES ('122', 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', '438', '423');
INSERT INTO `countries` VALUES ('123', 'LT', 'LITHUANIA', 'Lithuania', 'LTU', '440', '370');
INSERT INTO `countries` VALUES ('124', 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', '442', '352');
INSERT INTO `countries` VALUES ('125', 'MO', 'MACAO', 'Macao', 'MAC', '446', '853');
INSERT INTO `countries` VALUES ('126', 'MK', 'MACEDONIA,THEFORMERYUGOSLAVREPUBLICOF', 'Macedonia,theFormerYugoslavRepublicof', 'MKD', '807', '389');
INSERT INTO `countries` VALUES ('127', 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', '450', '261');
INSERT INTO `countries` VALUES ('128', 'MW', 'MALAWI', 'Malawi', 'MWI', '454', '265');
INSERT INTO `countries` VALUES ('129', 'MY', 'MALAYSIA', 'Malaysia', 'MYS', '458', '60');
INSERT INTO `countries` VALUES ('130', 'MV', 'MALDIVES', 'Maldives', 'MDV', '462', '960');
INSERT INTO `countries` VALUES ('131', 'ML', 'MALI', 'Mali', 'MLI', '466', '223');
INSERT INTO `countries` VALUES ('132', 'MT', 'MALTA', 'Malta', 'MLT', '470', '356');
INSERT INTO `countries` VALUES ('133', 'MH', 'MARSHALLISLANDS', 'MarshallIslands', 'MHL', '584', '692');
INSERT INTO `countries` VALUES ('134', 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', '474', '596');
INSERT INTO `countries` VALUES ('135', 'MR', 'MAURITANIA', 'Mauritania', 'MRT', '478', '222');
INSERT INTO `countries` VALUES ('136', 'MU', 'MAURITIUS', 'Mauritius', 'MUS', '480', '230');
INSERT INTO `countries` VALUES ('137', 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, '269');
INSERT INTO `countries` VALUES ('138', 'MX', 'MEXICO', 'Mexico', 'MEX', '484', '52');
INSERT INTO `countries` VALUES ('139', 'FM', 'MICRONESIA,FEDERATEDSTATESOF', 'Micronesia,FederatedStatesof', 'FSM', '583', '691');
INSERT INTO `countries` VALUES ('140', 'MD', 'MOLDOVA,REPUBLICOF', 'Moldova,Republicof', 'MDA', '498', '373');
INSERT INTO `countries` VALUES ('141', 'MC', 'MONACO', 'Monaco', 'MCO', '492', '377');
INSERT INTO `countries` VALUES ('142', 'MN', 'MONGOLIA', 'Mongolia', 'MNG', '496', '976');
INSERT INTO `countries` VALUES ('143', 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', '500', '1664');
INSERT INTO `countries` VALUES ('144', 'MA', 'MOROCCO', 'Morocco', 'MAR', '504', '212');
INSERT INTO `countries` VALUES ('145', 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', '508', '258');
INSERT INTO `countries` VALUES ('146', 'MM', 'MYANMAR', 'Myanmar', 'MMR', '104', '95');
INSERT INTO `countries` VALUES ('147', 'NA', 'NAMIBIA', 'Namibia', 'NAM', '516', '264');
INSERT INTO `countries` VALUES ('148', 'NR', 'NAURU', 'Nauru', 'NRU', '520', '674');
INSERT INTO `countries` VALUES ('149', 'NP', 'NEPAL', 'Nepal', 'NPL', '524', '977');
INSERT INTO `countries` VALUES ('150', 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', '528', '31');
INSERT INTO `countries` VALUES ('151', 'AN', 'NETHERLANDSANTILLES', 'NetherlandsAntilles', 'ANT', '530', '599');
INSERT INTO `countries` VALUES ('152', 'NC', 'NEWCALEDONIA', 'NewCaledonia', 'NCL', '540', '687');
INSERT INTO `countries` VALUES ('153', 'NZ', 'NEWZEALAND', 'NewZealand', 'NZL', '554', '64');
INSERT INTO `countries` VALUES ('154', 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', '558', '505');
INSERT INTO `countries` VALUES ('155', 'NE', 'NIGER', 'Niger', 'NER', '562', '227');
INSERT INTO `countries` VALUES ('156', 'NG', 'NIGERIA', 'Nigeria', 'NGA', '566', '234');
INSERT INTO `countries` VALUES ('157', 'NU', 'NIUE', 'Niue', 'NIU', '570', '683');
INSERT INTO `countries` VALUES ('158', 'NF', 'NORFOLKISLAND', 'NorfolkIsland', 'NFK', '574', '672');
INSERT INTO `countries` VALUES ('159', 'MP', 'NORTHERNMARIANAISLANDS', 'NorthernMarianaIslands', 'MNP', '580', '1670');
INSERT INTO `countries` VALUES ('160', 'NO', 'NORWAY', 'Norway', 'NOR', '578', '47');
INSERT INTO `countries` VALUES ('161', 'OM', 'OMAN', 'Oman', 'OMN', '512', '968');
INSERT INTO `countries` VALUES ('162', 'PK', 'PAKISTAN', 'Pakistan', 'PAK', '586', '92');
INSERT INTO `countries` VALUES ('163', 'PW', 'PALAU', 'Palau', 'PLW', '585', '680');
INSERT INTO `countries` VALUES ('164', 'PS', 'PALESTINIANTERRITORY,OCCUPIED', 'PalestinianTerritory,Occupied', NULL, NULL, '970');
INSERT INTO `countries` VALUES ('165', 'PA', 'PANAMA', 'Panama', 'PAN', '591', '507');
INSERT INTO `countries` VALUES ('166', 'PG', 'PAPUANEWGUINEA', 'PapuaNewGuinea', 'PNG', '598', '675');
INSERT INTO `countries` VALUES ('167', 'PY', 'PARAGUAY', 'Paraguay', 'PRY', '600', '595');
INSERT INTO `countries` VALUES ('168', 'PE', 'PERU', 'Peru', 'PER', '604', '51');
INSERT INTO `countries` VALUES ('169', 'PH', 'PHILIPPINES', 'Philippines', 'PHL', '608', '63');
INSERT INTO `countries` VALUES ('170', 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', '612', '0');
INSERT INTO `countries` VALUES ('171', 'PL', 'POLAND', 'Poland', 'POL', '616', '48');
INSERT INTO `countries` VALUES ('172', 'PT', 'PORTUGAL', 'Portugal', 'PRT', '620', '351');
INSERT INTO `countries` VALUES ('173', 'PR', 'PUERTORICO', 'PuertoRico', 'PRI', '630', '1787');
INSERT INTO `countries` VALUES ('174', 'QA', 'QATAR', 'Qatar', 'QAT', '634', '974');
INSERT INTO `countries` VALUES ('175', 'RE', 'REUNION', 'Reunion', 'REU', '638', '262');
INSERT INTO `countries` VALUES ('176', 'RO', 'ROMANIA', 'Romania', 'ROM', '642', '40');
INSERT INTO `countries` VALUES ('177', 'RU', 'RUSSIANFEDERATION', 'RussianFederation', 'RUS', '643', '70');
INSERT INTO `countries` VALUES ('178', 'RW', 'RWANDA', 'Rwanda', 'RWA', '646', '250');
INSERT INTO `countries` VALUES ('179', 'SH', 'SAINTHELENA', 'SaintHelena', 'SHN', '654', '290');
INSERT INTO `countries` VALUES ('180', 'KN', 'SAINTKITTSANDNEVIS', 'SaintKittsandNevis', 'KNA', '659', '1869');
INSERT INTO `countries` VALUES ('181', 'LC', 'SAINTLUCIA', 'SaintLucia', 'LCA', '662', '1758');
INSERT INTO `countries` VALUES ('182', 'PM', 'SAINTPIERREANDMIQUELON', 'SaintPierreandMiquelon', 'SPM', '666', '508');
INSERT INTO `countries` VALUES ('183', 'VC', 'SAINTVINCENTANDTHEGRENADINES', 'SaintVincentandtheGrenadines', 'VCT', '670', '1784');
INSERT INTO `countries` VALUES ('184', 'WS', 'SAMOA', 'Samoa', 'WSM', '882', '684');
INSERT INTO `countries` VALUES ('185', 'SM', 'SANMARINO', 'SanMarino', 'SMR', '674', '378');
INSERT INTO `countries` VALUES ('186', 'ST', 'SAOTOMEANDPRINCIPE', 'SaoTomeandPrincipe', 'STP', '678', '239');
INSERT INTO `countries` VALUES ('187', 'SA', 'SAUDIARABIA', 'SaudiArabia', 'SAU', '682', '966');
INSERT INTO `countries` VALUES ('188', 'SN', 'SENEGAL', 'Senegal', 'SEN', '686', '221');
INSERT INTO `countries` VALUES ('189', 'CS', 'SERBIAANDMONTENEGRO', 'SerbiaandMontenegro', NULL, NULL, '381');
INSERT INTO `countries` VALUES ('190', 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', '690', '248');
INSERT INTO `countries` VALUES ('191', 'SL', 'SIERRALEONE', 'SierraLeone', 'SLE', '694', '232');
INSERT INTO `countries` VALUES ('192', 'SG', 'SINGAPORE', 'Singapore', 'SGP', '702', '65');
INSERT INTO `countries` VALUES ('193', 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', '703', '421');
INSERT INTO `countries` VALUES ('194', 'SI', 'SLOVENIA', 'Slovenia', 'SVN', '705', '386');
INSERT INTO `countries` VALUES ('195', 'SB', 'SOLOMONISLANDS', 'SolomonIslands', 'SLB', '90', '677');
INSERT INTO `countries` VALUES ('196', 'SO', 'SOMALIA', 'Somalia', 'SOM', '706', '252');
INSERT INTO `countries` VALUES ('197', 'ZA', 'SOUTHAFRICA', 'SouthAfrica', 'ZAF', '710', '27');
INSERT INTO `countries` VALUES ('198', 'GS', 'SOUTHGEORGIAANDTHESOUTHSANDWICHISLANDS', 'SouthGeorgiaandtheSouthSandwichIslands', NULL, NULL, '0');
INSERT INTO `countries` VALUES ('199', 'ES', 'SPAIN', 'Spain', 'ESP', '724', '34');
INSERT INTO `countries` VALUES ('200', 'LK', 'SRILANKA', 'SriLanka', 'LKA', '144', '94');
INSERT INTO `countries` VALUES ('201', 'SD', 'SUDAN', 'Sudan', 'SDN', '736', '249');
INSERT INTO `countries` VALUES ('202', 'SR', 'SURINAME', 'Suriname', 'SUR', '740', '597');
INSERT INTO `countries` VALUES ('203', 'SJ', 'SVALBARDANDJANMAYEN', 'SvalbardandJanMayen', 'SJM', '744', '47');
INSERT INTO `countries` VALUES ('204', 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', '748', '268');
INSERT INTO `countries` VALUES ('205', 'SE', 'SWEDEN', 'Sweden', 'SWE', '752', '46');
INSERT INTO `countries` VALUES ('206', 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', '756', '41');
INSERT INTO `countries` VALUES ('207', 'SY', 'SYRIANARABREPUBLIC', 'SyrianArabRepublic', 'SYR', '760', '963');
INSERT INTO `countries` VALUES ('208', 'TW', 'TAIWAN,PROVINCEOFCHINA', 'Taiwan,ProvinceofChina', 'TWN', '158', '886');
INSERT INTO `countries` VALUES ('209', 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', '762', '992');
INSERT INTO `countries` VALUES ('210', 'TZ', 'TANZANIA,UNITEDREPUBLICOF', 'Tanzania,UnitedRepublicof', 'TZA', '834', '255');
INSERT INTO `countries` VALUES ('211', 'TH', 'THAILAND', 'Thailand', 'THA', '764', '66');
INSERT INTO `countries` VALUES ('212', 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, '670');
INSERT INTO `countries` VALUES ('213', 'TG', 'TOGO', 'Togo', 'TGO', '768', '228');
INSERT INTO `countries` VALUES ('214', 'TK', 'TOKELAU', 'Tokelau', 'TKL', '772', '690');
INSERT INTO `countries` VALUES ('215', 'TO', 'TONGA', 'Tonga', 'TON', '776', '676');
INSERT INTO `countries` VALUES ('216', 'TT', 'TRINIDADANDTOBAGO', 'TrinidadandTobago', 'TTO', '780', '1868');
INSERT INTO `countries` VALUES ('217', 'TN', 'TUNISIA', 'Tunisia', 'TUN', '788', '216');
INSERT INTO `countries` VALUES ('218', 'TR', 'TURKEY', 'Turkey', 'TUR', '792', '90');
INSERT INTO `countries` VALUES ('219', 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', '795', '7370');
INSERT INTO `countries` VALUES ('220', 'TC', 'TURKSANDCAICOSISLANDS', 'TurksandCaicosIslands', 'TCA', '796', '1649');
INSERT INTO `countries` VALUES ('221', 'TV', 'TUVALU', 'Tuvalu', 'TUV', '798', '688');
INSERT INTO `countries` VALUES ('222', 'UG', 'UGANDA', 'Uganda', 'UGA', '800', '256');
INSERT INTO `countries` VALUES ('223', 'UA', 'UKRAINE', 'Ukraine', 'UKR', '804', '380');
INSERT INTO `countries` VALUES ('224', 'AE', 'UNITEDARABEMIRATES', 'UnitedArabEmirates', 'ARE', '784', '971');
INSERT INTO `countries` VALUES ('225', 'GB', 'UNITEDKINGDOM', 'UnitedKingdom', 'GBR', '826', '44');
INSERT INTO `countries` VALUES ('226', 'US', 'UNITEDSTATES', 'UnitedStates', 'USA', '840', '1');
INSERT INTO `countries` VALUES ('227', 'UM', 'UNITEDSTATESMINOROUTLYINGISLANDS', 'UnitedStatesMinorOutlyingIslands', NULL, NULL, '1');
INSERT INTO `countries` VALUES ('228', 'UY', 'URUGUAY', 'Uruguay', 'URY', '858', '598');
INSERT INTO `countries` VALUES ('229', 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', '860', '998');
INSERT INTO `countries` VALUES ('230', 'VU', 'VANUATU', 'Vanuatu', 'VUT', '548', '678');
INSERT INTO `countries` VALUES ('231', 'VE', 'VENEZUELA', 'Venezuela', 'VEN', '862', '58');
INSERT INTO `countries` VALUES ('232', 'VN', 'VIETNAM', 'VietNam', 'VNM', '704', '84');
INSERT INTO `countries` VALUES ('233', 'VG', 'VIRGINISLANDS,BRITISH', 'VirginIslands,British', 'VGB', '92', '1284');
INSERT INTO `countries` VALUES ('234', 'VI', 'VIRGINISLANDS,U.S.', 'VirginIslands,U.s.', 'VIR', '850', '1340');
INSERT INTO `countries` VALUES ('235', 'WF', 'WALLISANDFUTUNA', 'WallisandFutuna', 'WLF', '876', '681');
INSERT INTO `countries` VALUES ('236', 'EH', 'WESTERNSAHARA', 'WesternSahara', 'ESH', '732', '212');
INSERT INTO `countries` VALUES ('237', 'YE', 'YEMEN', 'Yemen', 'YEM', '887', '967');
INSERT INTO `countries` VALUES ('238', 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', '894', '260');
INSERT INTO `countries` VALUES ('239', 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', '716', '263');


-- Table structure for table `data_groups`

DROP TABLE IF EXISTS `data_groups`;
CREATE TABLE `data_groups` (
  `data_group_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_for` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_list` text COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`data_group_id`),
  UNIQUE KEY `data_group_for` (`data_group_for`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `data_groups`
INSERT INTO `data_groups` VALUES ('26F20CCB-B1D5-444D-A528-726349752701', 'ContentBlock', 'business,ecommerce,restaurant,general', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `data_groups` VALUES ('4DC02C81-F81F-4863-B51A-FDF7C445A351', 'Category', 'business,ecommerce,restaurant,general', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `data_groups` VALUES ('BAA9524D-B3AE-4E3F-8DBE-0AF6F74669AC', 'Page', 'business,ecommerce,restaurant,general', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `data_groups` VALUES ('DFADBD99-B2B7-4B24-90B7-92A193AC1AC4', 'Navigation', 'top_nav,charity,services,footer_nav,business,ecommerce,restaurant,general', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');


-- Table structure for table `error_logs`

DROP TABLE IF EXISTS `error_logs`;
CREATE TABLE `error_logs` (
  `error_log_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `severity` int NOT NULL,
  `error_message` text COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`error_log_id`),
  UNIQUE KEY `error_log_id` (`error_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `languages`

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `language_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `languages`
INSERT INTO `languages` VALUES ('af', 'Afrikaans');
INSERT INTO `languages` VALUES ('ar', 'Arabic');
INSERT INTO `languages` VALUES ('de', 'German');
INSERT INTO `languages` VALUES ('en', 'English');
INSERT INTO `languages` VALUES ('es', 'Spanish');
INSERT INTO `languages` VALUES ('fr', 'French');
INSERT INTO `languages` VALUES ('hi', 'Hindi');
INSERT INTO `languages` VALUES ('id', 'Indonesian');
INSERT INTO `languages` VALUES ('ja', 'Japanese');
INSERT INTO `languages` VALUES ('jm', 'Jamaican Creole English');
INSERT INTO `languages` VALUES ('ko', 'Korean');
INSERT INTO `languages` VALUES ('np', 'Nigerian Pidgin');
INSERT INTO `languages` VALUES ('pt-PT', 'Portuguese');
INSERT INTO `languages` VALUES ('ru', 'Russian');
INSERT INTO `languages` VALUES ('sw', 'Swahili');
INSERT INTO `languages` VALUES ('tr', 'Turkish');
INSERT INTO `languages` VALUES ('ur', 'Urdu');
INSERT INTO `languages` VALUES ('wo', 'Wolof');
INSERT INTO `languages` VALUES ('zh-CN', 'Simplified Chinese');


-- Table structure for table `migrations`

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` VALUES ('1', '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('2', '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('3', '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('4', '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('5', '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('6', '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('7', '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('8', '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('9', '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('10', '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('11', '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('12', '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', '1752068376', '1');
INSERT INTO `migrations` VALUES ('13', '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('14', '2024-10-13-113248', 'App\\Database\\Migrations\\Translations', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('15', '2024-11-02-212632', 'App\\Database\\Migrations\\Languages', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('16', '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('17', '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('18', '2024-11-12-143627', '\\SiteStats', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('19', '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('20', '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('21', '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('22', '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('23', '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('24', '2025-06-01-113456', 'App\\Database\\Migrations\\DataGroups', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('25', '2025-06-20-151038', 'App\\Database\\Migrations\\Plugins', 'default', 'App', '1752068377', '1');
INSERT INTO `migrations` VALUES ('26', '2025-07-01-161418', 'App\\Database\\Migrations\\PluginConfigs', 'default', 'App', '1752068377', '1');


-- Table structure for table `navigations`

DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `navigation_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order` int DEFAULT '10',
  `parent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`navigation_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `navigations`
INSERT INTO `navigations` VALUES ('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', 'footer_nav', '44', NULL, 'rss', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('0a6d180e-96af-494d-b309-5cfa80e6c94f', 'Plant a Seed of Hope', 'Donate Plant a Seed of Hope nav', 'charity', '16', 'cb3badd1-b6df-420c-a74d-796e181b1228', 'donate/urban-gardening-initiative', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', 'services', '28', NULL, '#!', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('131c5798-d0b7-484c-bf21-e1768458632f', 'Home', 'Home navigation', 'top_nav', '2', NULL, 'home', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', 'footer_nav', '36', NULL, '#services', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', 'services', '30', NULL, '#!', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', 'footer_nav', '38', NULL, '/cookie-policy', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', 'top_nav', '10', NULL, '#team', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', 'top_nav', '4', NULL, '#about', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', 'footer_nav', '42', NULL, 'sitemap', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', 'footer_nav', '34', NULL, '#about', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', 'top_nav', '20', NULL, 'contact', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', 'footer_nav', '32', NULL, 'home', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('7b7c170f-d6a2-40d0-80ff-6d5b3f88dbce', 'Book Now', 'Appointment page', 'top_nav', '19', NULL, 'appointment/intro-call-calendly', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('875edb73-84ef-403c-9132-519a7fa62f79', 'Emergency Relief Fund', 'Donate Emergency Relief Fund nav', 'charity', '18', 'cb3badd1-b6df-420c-a74d-796e181b1228', 'donate/disaster-relief-fund', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', 'services', '26', NULL, '#!', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', 'footer_nav', '40', NULL, '/privacy-policy', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('cb3badd1-b6df-420c-a74d-796e181b1228', 'Donate', 'Donate nav', 'charity', '14', NULL, 'donate', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', 'top_nav', '12', NULL, 'blogs', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', 'top_nav', '6', NULL, '#services', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', 'services', '24', NULL, '#!', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', 'top_nav', '8', NULL, '#portfolio', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `navigations` VALUES ('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', 'services', '22', NULL, '#!', '0', '1', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, '2025-07-09 14:39:37', '2025-07-09 14:39:37');


-- Table structure for table `pages`

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'portfolio',
  `status` int DEFAULT '0',
  `total_views` int DEFAULT '0',
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_general_ci,
  `meta_keywords` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`),
  KEY `title` (`title`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `pages`
INSERT INTO `pages` VALUES ('36e72b64-63e8-4f0d-983d-686154d8bf5d', 'Careers', 'careers', 'general', '1', '0', '<h2>Careers</h2><p>We are always looking for talented, driven individuals to join our team. Explore current openings and learn more about our company culture.</p><p>To apply or view available positions, please visit our Careers page or contact our HR department.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Careers', 'Join our team and explore exciting career opportunities.', 'careers, jobs, employment, work with us', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('3ducat-ional-1a2b-3c4d-5e6f-7g8h9i0j1k2', 'Learning Resources', 'learning-resources', 'educational', '1', '0', '<h2>Educational Materials</h2><p>Access our collection of educational resources designed to support learning and professional development.</p><p>We offer tutorials, guides, and reference materials to help you expand your knowledge and skills.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Educational Resources & Learning Materials', 'Access our educational resources and learning materials', 'education, learning, resources, materials', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('3nt3rt-ain1-2a3b-4c5d-6e7f-8g9h0i1j2k3', 'Entertainment', 'entertainment', 'entertainment', '1', '0', '<h2>Entertainment Section</h2><p>Discover our entertainment offerings including events, media, and activities for all ages.</p><p>We provide quality entertainment options to enrich your leisure time and create memorable experiences.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Entertainment Options & Events', 'Explore our entertainment offerings and events', 'entertainment, events, media, activities', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('55068831-a48c-448f-8593-95fc51582122', 'Ethics Policy', 'ethics-policy', 'general', '1', '0', '<h2>Ethics Policy</h2><p>Our team adheres to strict ethical standards in all aspects of our work. We strive for accuracy, fairness, and accountability in everything we publish.</p><p>We maintain editorial independence and ensure that all content meets our high standards of integrity.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Ethics Policy', 'Read about our commitment to ethical standards in journalism and publishing.', 'ethics, policy, integrity, standards', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('70cf3ace-b59b-4e93-9639-35035db8c929', 'Advertise', 'advertise', 'general', '1', '0', '<h2>Advertise with Us</h2><p>Reach a broad and engaged audience by advertising with us. We offer a variety of advertising solutions to suit your needs.</p><p>For advertising inquiries, please contact our sales team.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Advertise with Us', 'Promote your brand by advertising on our platform.', 'advertising, promote, ads, media kit', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', 'general', '1', '0', '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('d1rect-ory1-2a3b-4c5d-6e7f-8g9h0i1j2k3', 'Business Directory', 'business-directory', 'directory', '1', '0', '<h2>Directory Listings</h2><p>Browse our comprehensive directory of businesses, services, and professionals. Find what you need quickly and easily.</p><p>Listings are categorized and searchable to help you locate the right service providers.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Business Directory - Find Services', 'Browse our directory of businesses and service providers', 'directory, business, services, listings', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('e1c0mmer-ce4e-4a1b-9d3f-8e7d6c5b4a3f', 'Online Store', 'online-store', 'ecommerce', '1', '0', '<h2>Our Online Store</h2><p>Welcome to our ecommerce platform where you can find a wide range of products at competitive prices. We offer secure checkout, fast delivery, and excellent customer service.</p><p>Browse our categories to find the perfect items for your needs. Don\'t hesitate to contact us if you have any questions about our products or services.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Online Store - Shop Now', 'Browse our wide selection of products in our online store', 'ecommerce, online store, shop, products', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('eed0cfc6-ab27-499b-b3b8-d18f052f35cb', 'Terms of Service', 'terms-of-service', 'general', '1', '0', '<h2>Terms of Service</h2><p>By accessing or using our website, you agree to be bound by these Terms of Service. Please read them carefully.</p><p>The Terms outline your rights and responsibilities when using our services, and include disclaimers and limitations of liability.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Terms of Service', 'Review the terms and conditions for using our website and services.', 'terms, service, agreement, conditions, legal', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('ev3ntpa-ge1d-2f3g-4h5j-6k7l8m9n0o1p', 'Upcoming Events', 'upcoming-events', 'event', '1', '0', '<h2>Events Calendar</h2><p>Discover our upcoming events, workshops, and conferences. Join us for these exciting opportunities to learn, network, and grow.</p><p>Register early as spaces are often limited for our most popular events.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Upcoming Events Calendar', 'Browse and register for our upcoming events and workshops', 'events, calendar, workshops, conferences', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'About Us', 'about-us', 'business', '1', '0', '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'About Us - Our Company', 'Learn more about our companys mission, values, and team', 'about us, company, mission, values, team', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('fd814385-9640-4d04-a9d7-fcf2f6c4ed2e', 'Corrections', 'corrections', 'general', '1', '0', '<h2>Corrections</h2><p>We are committed to transparency and accuracy. If we identify or are made aware of a significant error in our content, we will promptly issue a correction.</p><p>If you spot an error, please contact us so we can investigate and correct it.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Corrections', 'Learn how we handle content corrections and how to report an error.', 'corrections, accuracy, errors, transparency', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', 'general', '1', '0', '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('h34lth-page-1a2b-3c4d-5e6f-7g8h9i0j1k2', 'Health Services', 'health-services', 'health', '1', '0', '<h2>Healthcare Information</h2><p>Learn about our health services, wellness programs, and medical resources. We are committed to providing quality care and health education.</p><p>Our team of professionals is dedicated to helping you achieve and maintain optimal health.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Health Services & Wellness Programs', 'Information about our health services and wellness programs', 'health, wellness, medical, services', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('n3w5pag-e1d2-3f4g-5h6j-7k8l9m0n1o2p', 'Latest News', 'latest-news', 'news', '1', '0', '<h2>News & Updates</h2><p>Stay informed with our latest news and announcements. This section keeps you updated on company developments, industry trends, and important events.</p><p>Check back regularly for new articles and updates about our organization and the communities we serve.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Latest News & Updates', 'Stay updated with our latest news and announcements', 'news, updates, announcements, articles', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('p0rtf0l-io1a-2b3c-4d5e-6f7g8h9i0j1k', 'Our Portfolio', 'our-portfolio', 'portfolio', '1', '0', '<h2>Our Work Portfolio</h2><p>Explore our collection of completed projects and creative works. This portfolio showcases our expertise and the quality of our services.</p><p>Each project represents our dedication to excellence and our ability to deliver outstanding results for our clients.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Our Portfolio - See Our Work', 'View our portfolio of completed projects and creative works', 'portfolio, work, projects, creative', '2025-07-09 14:39:37', '2025-07-09 14:39:37');
INSERT INTO `pages` VALUES ('r3stau-rant-1a2b-3c4d-5e6f-7g8h9i0j1k2', 'Our Menu', 'our-menu', 'restaurant', '1', '0', '<h2>Restaurant Menu</h2><p>Explore our delicious offerings featuring fresh ingredients and authentic flavors. Our menu changes seasonally to bring you the best of what\'s available.</p><p>We accommodate various dietary preferences and are happy to customize dishes to your liking.</p>', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', NULL, 'Restaurant Menu - Our Offerings', 'Browse our restaurant menu featuring seasonal dishes', 'restaurant, menu, food, dining', '2025-07-09 14:39:37', '2025-07-09 14:39:37');


-- Table structure for table `password_resets`

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `reset_id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `plugin_configs`

DROP TABLE IF EXISTS `plugin_configs`;
CREATE TABLE `plugin_configs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `plugin_slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `config_key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `config_value` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_plugin_config` (`plugin_slug`,`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `plugins`

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE `plugins` (
  `plugin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `plugin_key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `update_available` int DEFAULT '0',
  `load` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `roles`

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `roles`
INSERT INTO `roles` VALUES ('8B16CDBD-92FE-4506-9C16-6C95403733E6', 'Admin', 'Admin role', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `roles` VALUES ('9EA49D99-D914-4CBA-9BC5-53E9745EC9AC', 'Manager', 'Manager Role', '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `site_stats`

DROP TABLE IF EXISTS `site_stats`;
CREATE TABLE `site_stats` (
  `site_stat_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `browser_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_visited_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_visited_url` text COLLATE utf8mb4_general_ci,
  `referrer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_code` int DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_method` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operating_system` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `screen_resolution` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `other_params` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`site_stat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `site_stats`
INSERT INTO `site_stats` VALUES ('00955619-A5D3-450B-AA08-8C7FD2AD3662', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '8EEF2F4A-8D24-452E-8DC4-3EF4756E54D3', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'F3BD1474-B908-4D7D-B26D-68C343D48731', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-01-01 00:00:00');
INSERT INTO `site_stats` VALUES ('0B33F7E1-2816-499F-A8FB-D02A65206B4F', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '4F5C8E36-F83E-45DC-ACFB-4A9C95EE188F', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'B2929BF1-8798-4A92-A35F-3624ADCDF1C9', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-04-01 00:00:00');
INSERT INTO `site_stats` VALUES ('15B4645A-9D11-44A8-9878-74A1E4578A2C', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', '', '200', '', '314b4629d36e78d3bddfed0d76768c20', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, '2025-07-09 14:39:53');
INSERT INTO `site_stats` VALUES ('29693855-D5AA-4AFE-AE96-616A88213EBF', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'front-end/themes/giz-tech/assets/images/preview.png', 'http://localhost/apps/igniter-cms/front-end/themes/giz-tech/assets/images/preview.png', '', '404', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'a3fd4906decf1473694deaceaefdfb4f', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, '2025-07-09 18:57:29');
INSERT INTO `site_stats` VALUES ('2FF1B083-18C6-4745-9938-AAFFE0C0F7B6', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '238FEAE3-0059-4E62-8BB8-EDF6E027E211', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '82774413-D33F-4183-87C1-7A1362137196', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-07-06 13:39:37');
INSERT INTO `site_stats` VALUES ('303C5BD9-11B2-451B-B76D-8C7A4F9F5D6B', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '45F3A79A-D558-4431-ADDF-27277ABF2891', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'C5F2871C-BCA3-46A5-B70E-58F03380AEFE', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-05-01 00:00:00');
INSERT INTO `site_stats` VALUES ('32ACB5A3-87E4-4C02-B16F-2815047A82C8', '192.168.1.1', 'mobile', 'Safari', 'Page', '5346D4F2-EA6B-4126-B3B0-EB7BBE0A63AD', 'http://localhost/apps/igniter-cms/about', 'POST', '201', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'session-686e711943c00', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2025-07-09 13:39:37');
INSERT INTO `site_stats` VALUES ('3A39391E-6217-4E66-A924-D5BB6070742E', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '58E150F5-E07B-433C-9BAE-D7139B022939', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'C9E8FDEF-ED4F-4613-8318-B6E55AD58E43', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2025-07-04 13:39:37');
INSERT INTO `site_stats` VALUES ('4F846F88-C9E0-415C-A27E-0E4AAE30BB57', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'EA6B94C1-8C41-4D93-9917-E05DECABE7F9', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'D1AC2189-13D6-4FB7-A292-6182DD50F3D3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-04-01 00:00:00');
INSERT INTO `site_stats` VALUES ('5D99BD91-1363-4F58-8A53-B9690BEE4D4D', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost/apps/igniter-cms/', '', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '7ff65145295dc7938011786a67e642f4', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, '2025-07-09 17:12:26');
INSERT INTO `site_stats` VALUES ('896D4F2E-E64B-439C-B257-C874EAC6DB53', '192.168.2.1', 'mobile', 'Opera', 'Page', '3F1199D7-3D43-4366-BEDD-0531DE5E4FEC', 'http://localhost/apps/igniter-cms/blog', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '4371667D-09B0-46FB-819F-082F0965FBCB', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-07-05 13:39:37');
INSERT INTO `site_stats` VALUES ('A1F421B5-DB86-455F-9626-0A9B2742FA67', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '038F003F-F882-4419-BF67-AB1FA155DF5B', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'F5A12E5B-750D-4CA1-B152-C7FAFA6A6AA7', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-03-01 00:00:00');
INSERT INTO `site_stats` VALUES ('BAFBD15B-194D-47D4-9831-A8D683A91F57', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'ED283367-6ED9-449E-BCA6-459AB17CB0A6', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'ECFDC41D-A991-4922-964B-58D523B818E3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2025-07-03 13:39:37');
INSERT INTO `site_stats` VALUES ('BC610E94-680C-4EC3-9F17-7F478F3DC61A', '172.16.0.1', 'mobile', 'Edge', 'Page', 'F8BD96FA-6625-4A47-9B49-93A1663B146C', 'http://localhost/apps/igniter-cms/', 'POST', '204', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '361F6F0B-CA9C-452C-AD96-855950C038D3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-07-07 13:39:37');
INSERT INTO `site_stats` VALUES ('BCD7D792-77A3-4DEB-B6CC-CAD8A659958C', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '607DB07F-45E7-45BD-BECA-BA6BA3177952', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '81155D50-EC3B-491F-A787-E84A8EAB7BF5', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-06-01 00:00:00');
INSERT INTO `site_stats` VALUES ('D9E6DE9F-A75A-47CA-9691-01B1E9B96B5A', '10.0.0.1', 'tablet', 'Firefox', 'Page', '46193120-BF39-426E-8608-B914076E0B9B', 'http://localhost/apps/igniter-cms/contact', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '924C8052-15AD-4597-950E-69D319791251', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-07-08 13:39:37');
INSERT INTO `site_stats` VALUES ('FC50E5A2-5DC8-46D3-AB76-BFAFDD4E735A', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '817938D0-D975-40A9-BD7C-0FF74EB913B3', 'http://localhost/apps/igniter-cms/', 'GET', '200', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '841A69E0-C706-4640-9555-A98192BB0137', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-02-01 00:00:00');


-- Table structure for table `themes`

DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `theme_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `theme_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `selected` tinyint(1) DEFAULT '0',
  `override_default_style` tinyint(1) DEFAULT '0',
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `themes`
INSERT INTO `themes` VALUES ('5D94E549-D89E-4293-BCB6-D74BC11D666C', 'Default', '/default', '#212529', '#0d6efd', '#f2f7f7', 'public/front-end/themes/default/assets/images/default-theme.png', 'https://startbootstrap.com/previews/modern-business', 'Business & Corporate', 'Portfolio & Resume', '1', '0', '0', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '2025-07-09 14:39:37', '2025-07-09 18:37:32');


-- Table structure for table `translations`

DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations` (
  `translation_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `translations`
INSERT INTO `translations` VALUES ('2BD1FD01-67EA-4A02-A80B-650CA520ED34', 'ar', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '2025-07-09 01:39:37', '2025-07-09 14:39:37');
INSERT INTO `translations` VALUES ('9FF2D679-6F72-49B0-8813-86937E76E89B', 'en', '57E1F579-8693-41E8-89D3-18CCC9CC93F9', '2025-07-09 01:39:37', '2025-07-09 14:39:37');


-- Table structure for table `users`

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'public/uploads/files/default/default-profile.png',
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `twitter_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about_summary` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `upload_directory` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user_4KW6E',
  `password_change_required` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `profile_picture` (`profile_picture`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` VALUES ('57E1F579-8693-41E8-89D3-18CCC9CC93F9', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$52Ilr/8s9fOQOZ8yUIj9oeAVklAKx6p7oJjc1//G5H9t8ALeREBDm', '1', 'Admin', 'public/uploads/files/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', '1', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `users` VALUES ('8101A15B-5637-435F-9228-18BEE961DD5B', 'Test', 'User', 'test', 'test@example.com', '$2y$10$aWUhKssJ8BAPsmfjZHjA/u2b2oWBNFweWCwGW0jX.YOLt0faLpV7G', '1', 'User', 'public/uploads/files/default/default-profile.png', 'https://twitter..com/?test-user', 'https://www.facebook..com/?test-user', 'https://instagram..com/?test-user', 'https://www.linkedin.com/in/?test-user', 'Hello! I\'m Manager User, the test of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'test_10BYZL', '0', '2025-07-09 14:39:36', '2025-07-09 14:39:36');
INSERT INTO `users` VALUES ('8F3E6B2E-21DA-4639-83DD-B77C5C3DDE3F', 'Manager', 'User', 'manager', 'manager@example.com', '$2y$10$bsJPk7OpERynY/jroXO.mO62ROW9o3Y9F/5ch9zmbSYIaml2BuL9i', '1', 'Manager', 'public/uploads/files/default/default-profile.png', 'https://twitter..com/?manager-user', 'https://www.facebook..com/?manager-user', 'https://instagram..com/?manager-user', 'https://www.linkedin.com/in/?manager-user', 'Hello! I\'m Manager User, the manager of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'manager_10BYZL', '0', '2025-07-09 14:39:36', '2025-07-09 14:39:36');


-- Table structure for table `whitelisted_ips`

DROP TABLE IF EXISTS `whitelisted_ips`;
CREATE TABLE `whitelisted_ips` (
  `whitelisted_ip_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`whitelisted_ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


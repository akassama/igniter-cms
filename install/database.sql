-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2025 at 11:54 AM
-- Server version: 8.0.42
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igniter_cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `activity_by`, `activity_type`, `activity`, `ip_address`, `country`, `device`, `updated_at`, `created_at`) VALUES
('68b5a771026ab', '72638807-85B3-4BE8-A88D-A76084865A1A', 'user_login', 'User Login: User logged in with id: 72638807-85B3-4BE8-A88D-A76084865A1A', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-01 15:02:26', '2025-09-01 15:02:26'),
('68b6e9f603545', '72638807-85B3-4BE8-A88D-A76084865A1A', 'config_updated', 'Config Update: Config updated with id: E6DFFF50-33E3-4EB1-94E9-E86915BCC621', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:58:30', '2025-09-02 13:58:30'),
('68b6ea0c54b85', '72638807-85B3-4BE8-A88D-A76084865A1A', 'config_updated', 'Config Update: Config updated with id: 5ABF9EE0-18AC-443B-94D2-D843B41CB5BD', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:58:52', '2025-09-02 13:58:52'),
('68b6ea3341abb', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Plugin file moved to temp: C:\\Program Files\\Ampps\\www\\apps\\igniter-cms\\writable\\uploads/1756817971_3ed25a14fafd7fe8e7bd.zip', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:32', '2025-09-02 13:59:32'),
('68b6ea345cfa8', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Plugin extracted to: C:\\Program Files\\Ampps\\www\\apps\\igniter-cms\\app\\Plugins/seo-master', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:33', '2025-09-02 13:59:33'),
('68b6ea3523210', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Dropped existing table: icp_seo_master_config', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:33', '2025-09-02 13:59:33'),
('68b6ea35d4c31', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Executed create table query for: seo-master', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:34', '2025-09-02 13:59:34'),
('68b6ea3674d37', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Executed insert table data query for: seo-master', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:35', '2025-09-02 13:59:35'),
('68b6ea371ba87', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Plugin uploaded: seo-master', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:35', '2025-09-02 13:59:35'),
('68b6ea37a8656', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_created', 'Plugin Deletion: Plugin added to database: seo-master', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:36', '2025-09-02 13:59:36'),
('68b6ea40b35e0', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_updated', 'Plugin Updated: Plugin seo-master activated.', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 13:59:45', '2025-09-02 13:59:45'),
('68b6eb198e4d6', '72638807-85B3-4BE8-A88D-A76084865A1A', 'plugin_updated', 'Plugin Updated: Plugin data for seo-master updated.', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '2025-09-02 14:03:22', '2025-09-02 14:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `api_accesses`
--

CREATE TABLE `api_accesses` (
  `api_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_accesses`
--

INSERT INTO `api_accesses` (`api_id`, `api_key`, `assigned_to`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('038FD78F-9951-4AE6-9BE0-A4CD3C0303F6', '126941e4076c9b00bff13999645c42a73a067217939abc7f0f7704d37b60b50b', '72638807-85B3-4BE8-A88D-A76084865A1A', 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `api_calls_tracker`
--

CREATE TABLE `api_calls_tracker` (
  `api_call_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_modules`
--

CREATE TABLE `app_modules` (
  `app_module_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `module_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `module_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_search_terms` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_roles` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_modules`
--

INSERT INTO `app_modules` (`app_module_id`, `module_name`, `module_description`, `module_search_terms`, `module_roles`, `module_link`, `updated_at`, `created_at`) VALUES
('02CCBF40-4BFF-4338-B9F1-CCE92D2E7959', 'Change Password', 'Change account password', 'password,security,change', 'Admin,Manager,User', 'account/settings/change-password', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('293CE055-9F1E-43D9-9723-C813A154E69A', 'Admin', 'Administration', 'admin,control,management', 'Admin', 'account/admin', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('2CBDDA7D-D6F3-454D-BCB8-1528C6147BCE', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'unblock,whitelist,security,allow ip', 'Admin', 'account/admin/whitelisted-ips', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('35730145-997A-411A-846E-9ED564FC60A5', 'Configurations', 'Manage configurations', 'configurations,settings,preferences', 'Admin', 'account/admin/configurations', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('3E3AF874-C419-4EAE-8A16-B667825AD9C0', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets', 'Admin,Manager,User', 'account/cms/content-blocks', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('400FD173-137B-4A05-8F9F-6C5161EC8AAB', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude, gemini, deepseek', 'Admin,Manager,User', 'account/cms/policies', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('4E0D0AF5-CC98-44DD-A992-A710A0D6976A', 'Backup', 'Manage backups', 'backup,restore,database', 'Admin', 'account/admin/backups', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('54E21645-BCDF-42DF-8C3A-A15EC2E67E01', 'Themes', 'Manage themes', 'themes,appearance,design', 'Admin', 'account/themes', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('5C92E5B6-8D0E-4EA1-8579-3BF8034B299F', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('5F6CCAB9-5D16-43B5-BE4B-F2D570F20479', 'Activity Logs', 'View activity logs', 'logs,activity,tracking', 'Admin', 'account/admin/activity-logs', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('5FF3C8E0-556E-48CD-B109-809475D5A8D5', 'Categories', 'Manage categories', 'category,categories,post category', 'Admin,Manager,User', 'account/cms/categories', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('62BC147C-9826-4C82-B9CB-9616BB42BCDC', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview', 'Admin,Manager,User', 'account/dashboard', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('69021A9B-E2FD-4B53-8582-C1B1450EDD53', 'Codes', 'Manage codes', 'codes,references,identifiers', 'Admin', 'account/admin/codes', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('6AEA64D7-1C2A-46F4-9257-922A07BBE3A0', 'API Keys', 'Manage api keys', 'api,keys,access', 'Admin', 'account/admin/api-keys', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('6D874A31-D1A1-4B3B-BA69-D79BAEFDC222', 'Users', 'Manage application users', 'users,accounts,people', 'Admin', 'account/admin/users', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('8C2C54BD-48F8-44C2-9FD8-6011917AEE95', 'Account Details', 'Update account details', 'account,profile,settings', 'Admin,Manager,User', 'account/settings/update-details', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('9128DB39-C972-4A51-AF4A-A4E37B2A097A', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny ip,spam', 'Admin', 'account/admin/blocked-ips', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('9C5AFAA4-4576-43EC-B13E-95B1876793A6', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links', 'Admin,Manager,User', 'account/cms/navigations', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('9C8389A2-EF63-491E-AF31-706A2613C6FE', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics', 'Admin', 'account/admin/visit-stats', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('AF4A735D-4E2D-4D41-82F5-F58EF9AED987', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts', 'Admin,Manager,User', 'account/cms/blogs', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('D3425BE5-8762-4EF8-9679-976B44664E40', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('D448AB3F-EA84-4ADD-887E-04325363C121', 'Error Logs', 'View error logs', 'error logs,activity,tracking', 'Admin', 'account/admin/logs', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('E540CEBE-73F0-4F83-85FF-7195FC8FEF7A', 'File Editor', 'Edit and update theme files', 'themes,customize,ui', 'Admin', 'account/admin/file-editor', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('E5FBBA41-8A40-4009-BE7F-78666A1762F3', 'Pages', 'Manage pages', 'pages,content,publish', 'Admin,Manager,User', 'account/cms/pages', '2025-09-01 15:01:59', '2025-09-01 15:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `backup_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `backup_file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_ips`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `slug`, `featured_image`, `excerpt`, `content`, `category`, `tags`, `is_featured`, `status`, `created_by`, `updated_by`, `total_views`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'public/uploads/files/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2025-09-01 13:02:00', '2025-09-01 15:02:00'),
('8e98b4c1-7f41-46c4-97fd-b59ecb57cbe8', 'AI and the Future of Learning', 'ai-and-the-future-of-learning', 'public/uploads/files/blog-16.jpg', 'Artificial Intelligence is reshaping how students learn, teachers teach, and institutions adapt. Discover how AI is driving personalized and lifelong education.', '\r\n                    <h2>AI and the Future of Learning</h2>\r\n                    <p>Education is undergoing a quiet revolution—and AI is at the heart of it. From adaptive learning platforms to automated grading systems, artificial intelligence is redefining the classroom experience across the globe.</p>\r\n                    \r\n                    <h3>1. Personalized Learning Paths</h3>\r\n                    <p>AI algorithms can analyze student performance and adjust content delivery in real-time. This ensures that each learner receives the right support, at the right pace, in the right way.</p>\r\n\r\n                    <h3>2. Intelligent Tutoring Systems</h3>\r\n                    <p>Virtual tutors powered by AI can now engage students in one-on-one learning, providing feedback, explanations, and encouragement just like a human teacher—but 24/7.</p>\r\n\r\n                    <h3>3. Teacher Support Tools</h3>\r\n                    <p>From automating administrative tasks to generating lesson plans, AI frees up educators to focus on what matters most: student engagement and creativity.</p>\r\n\r\n                    <h3>4. Bridging Global Education Gaps</h3>\r\n                    <p>AI-driven platforms can reach remote and underserved communities, offering quality education in multiple languages and contexts.</p>\r\n\r\n                    <p>As we look ahead, AI will not replace teachers—it will empower them to teach more effectively and inclusively. The classroom of tomorrow is already here, and it’s powered by intelligent technology.</p>\r\n                ', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, education, learning, edtech, innovation', 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 3, 'AI and the Future of Learning', 'Explore how AI is reshaping education through personalized learning, intelligent tutoring, and global accessibility.', 'AI, education, edtech, personalized learning, future of education, artificial intelligence in schools', '2025-09-01 09:02:00', '2025-09-01 15:02:00'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainable Living: Small Changes with Big Impact', 'sustainable-living-small-changes', 'public/uploads/files/blog-4.jpg', 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.', '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'sustainability, eco-friendly, lifestyle', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 0, 'Sustainable Living Tips', 'Easy ways to reduce your environmental impact through daily choices.', 'sustainability, eco-friendly, green living', '2025-09-01 10:02:00', '2025-09-01 15:02:00'),
('a7b8c9d0-e1f2-3456-789a-bcdef1234567', 'Essential Cybersecurity Practices for Small Businesses', 'cybersecurity-small-businesses', 'public/uploads/files/blog-10.jpg', 'Practical security measures every small business should implement to protect against growing cyber threats.', '<h2>Essential Cybersecurity for Small Businesses</h2><p>Small businesses are frequent targets. Essential protections include:</p><h3>1. Strong Password Policies</h3><p>Require complex passwords and multi-factor authentication.</p><h3>2. Regular Software Updates</h3><p>Patch vulnerabilities in all systems and applications.</p><h3>3. Employee Training</h3><p>Educate staff on phishing and social engineering risks.</p><h3>4. Secure Backup Systems</h3><p>Maintain encrypted, off-site backups of critical data.</p><h3>5. Network Security</h3><p>Use firewalls and secure Wi-Fi networks.</p><h3>6. Incident Response Plan</h3><p>Prepare for potential breaches with clear protocols.</p><p>Investing in cybersecurity protects your business, customers, and reputation.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'cybersecurity, business, technology', 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Small Business Cybersecurity', 'Essential security practices for protecting small businesses.', 'cybersecurity, small business, data protection', '2025-09-01 04:02:00', '2025-09-01 15:02:00'),
('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'The Science of Productivity: Work Smarter, Not Harder', 'science-of-productivity', 'public/uploads/files/blog-5.jpg', 'Evidence-based strategies to boost your productivity and achieve more in less time without burning out.', '<h2>The Science of Productivity</h2><p>Productivity isn\'t about working longer hours—it\'s about working smarter. Research-backed techniques can help you maximize efficiency:</p><h3>1. The Pomodoro Technique</h3><p>Work in focused 25-minute intervals with 5-minute breaks.</p><h3>2. Time Blocking</h3><p>Schedule specific blocks for different tasks to minimize context-switching.</p><h3>3. The Two-Minute Rule</h3><p>If a task takes less than two minutes, do it immediately.</p><h3>4. Deep Work</h3><p>Create distraction-free periods for cognitively demanding tasks.</p><h3>5. Rest Strategically</h3><p>Quality breaks boost subsequent productivity.</p><p>By implementing these methods, you can accomplish more while maintaining work-life balance.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'productivity, work, efficiency', 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Science-Backed Productivity Tips', 'Research-proven methods to enhance your work efficiency.', 'productivity, efficiency, time management', '2025-09-01 09:02:00', '2025-09-01 15:02:00'),
('b8c9d0e1-f2g3-4567-89ab-cdef12345678', 'The Rise of Plant-Based Diets: Health and Environmental Benefits', 'plant-based-diets-benefits', 'public/uploads/files/blog-11.jpg', 'Exploring the growing popularity of plant-based eating and its positive impacts on personal health and the planet.', '<h2>The Rise of Plant-Based Diets</h2><p>Plant-based eating offers significant benefits:</p><h3>1. Health Advantages</h3><p>Linked to lower risks of heart disease, diabetes, and certain cancers.</p><h3>2. Environmental Impact</h3><p>Requires fewer resources than animal agriculture.</p><h3>3. Getting Enough Protein</h3><p>Beans, lentils, tofu, and quinoa are excellent sources.</p><h3>4. Transition Tips</h3><p>Start with meatless Mondays or plant-based breakfasts.</p><h3>5. Nutritional Considerations</h3><p>Pay attention to vitamin B12, iron, and omega-3s.</p><h3>6. Global Cuisine Inspiration</h3><p>Explore Mediterranean, Indian, and East Asian plant-based dishes.</p><p>A plant-based diet can be nutritious, delicious, and sustainable.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'nutrition, health, sustainability', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Benefits of Plant-Based Diets', 'Health and environmental advantages of plant-based eating.', 'plant-based, vegan, nutrition, sustainability', '2025-09-01 03:02:00', '2025-09-01 15:02:00'),
('c3d4e5f6-a7b8-9012-3456-7890abcdef12', 'Urban Gardening: Growing Food in Small Spaces', 'urban-gardening-small-spaces', 'public/uploads/files/blog-6.jpg', 'You don\'t need a backyard to grow your own food. Learn how to create a thriving garden in apartments and small urban spaces.', '<h2>Urban Gardening in Small Spaces</h2><p>Limited space doesn\'t mean you can\'t enjoy homegrown produce. Here\'s how to garden in urban environments:</p><h3>1. Container Gardening</h3><p>Use pots, buckets, or hanging planters for vegetables and herbs.</p><h3>2. Vertical Gardens</h3><p>Utilize wall space with trellises or pocket planters.</p><h3>3. Windowsill Gardens</h3><p>Grow herbs and microgreens right in your kitchen window.</p><h3>4. Community Gardens</h3><p>Join local gardening initiatives if you lack personal space.</p><h3>5. Best Plants for Small Spaces</h3><p>Try lettuce, cherry tomatoes, peppers, basil, and dwarf varieties.</p><p>Urban gardening brings fresh food and greenery to city living.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'gardening, urban, sustainability', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 0, 'Urban Gardening Guide', 'Tips for growing food in apartments and small urban spaces.', 'urban gardening, container gardening, small space gardening', '2025-09-01 08:02:00', '2025-09-01 15:02:00'),
('c9d0e1f2-g3h4-5678-9abc-def123456789', 'Financial Planning for Millennials: Building Wealth in Your 30s', 'financial-planning-millennials', 'public/uploads/files/blog-12.jpg', 'Practical money management strategies to help millennials achieve financial stability and build long-term wealth.', '<h2>Financial Planning for Millennials</h2><p>Key strategies for financial health in your 30s:</p><h3>1. Pay Down High-Interest Debt</h3><p>Focus on credit cards and personal loans first.</p><h3>2. Build an Emergency Fund</h3><p>Aim for 3-6 months of living expenses.</p><h3>3. Start Investing Early</h3><p>Take advantage of compound growth in retirement accounts.</p><h3>4. Increase Retirement Contributions</h3><p>Boost your 401(k) or IRA contributions annually.</p><h3>5. Protect Your Income</h3><p>Consider disability insurance if you depend on your paycheck.</p><h3>6. Side Hustles for Extra Income</h3><p>Develop multiple income streams when possible.</p><p>Smart money habits now pay dividends for decades to come.</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'finance, millennials, investing', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Millennial Financial Planning', 'Wealth-building strategies for millennials in their 30s.', 'finance, millennials, retirement, investing', '2025-09-01 02:02:00', '2025-09-01 15:02:00'),
('d0e1f2g3-h4i5-6789-abcd-ef1234567890', 'The Evolution of Social Media: What\'s Next?', 'evolution-of-social-media', 'public/uploads/files/blog-13.jpg', 'How social media platforms have transformed communication and what emerging trends suggest about their future direction.', '<h2>The Evolution of Social Media</h2><p>Social media continues evolving rapidly:</p><h3>1. The Rise of Ephemeral Content</h3><p>Stories and disappearing messages dominate engagement.</p><h3>2. Video-First Platforms</h3><p>TikTok\'s success pushes all platforms toward video.</p><h3>3. Niche Communities</h3><p>Users seek smaller, interest-based networks.</p><h3>4. Commerce Integration</h3><p>Social platforms become shopping destinations.</p><h3>5. Augmented Reality Features</h3><p>Filters and virtual try-ons enhance user experience.</p><h3>6. Privacy Concerns</h3><p>Users demand more control over their data.</p><p>The future likely holds more immersive, personalized, and transactional experiences.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'social media, technology, trends', 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 0, 'Future of Social Media', 'Emerging trends and the evolution of social platforms.', 'social media, digital marketing, technology', '2025-09-01 01:02:00', '2025-09-01 15:02:00'),
('d4e5f6a7-b8c9-0123-4567-890abcdef123', 'The Future of Remote Work: Trends and Predictions', 'future-of-remote-work', 'public/uploads/files/blog-7.jpg', 'How remote work is evolving and what professionals can expect in the coming years as workplace norms continue to change.', '<h2>The Future of Remote Work</h2><p>The remote work revolution is just beginning. Key trends shaping its future include:</p><h3>1. Hybrid Work Models</h3><p>Most companies will adopt flexible office/remote schedules.</p><h3>2. Digital Nomadism</h3><p>More professionals will work while traveling internationally.</p><h3>3. Results-Only Work Environments</h3><p>Focus will shift from hours logged to output produced.</p><h3>4. Virtual Collaboration Tools</h3><p>Continued innovation in remote team technologies.</p><h3>5. Workspace Flexibility</h3><p>Companies will offer stipends for home office setups.</p><h3>6. Global Talent Pools</h3><p>Location will matter less for hiring decisions.</p><p>Remote work is here to stay, but its form will continue evolving.</p>', 'f0b860dc-624c-439a-9de8-f3164c981b08', 'remote work, future, career', 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Remote Work Future Trends', 'How remote work is evolving and what to expect in coming years.', 'remote work, future of work, digital nomad', '2025-09-01 07:02:00', '2025-09-01 15:02:00'),
('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'public/uploads/files/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'office, stakes, competitive', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2025-09-01 12:02:00', '2025-09-01 15:02:00'),
('e1f2g3h4-i5j6-7890-bcde-f12345678901', 'Minimalist Travel: Packing Light for Stress-Free Trips', 'minimalist-travel-packing', 'public/uploads/files/blog-14.jpg', 'How to embrace minimalist packing techniques to make your travels easier, cheaper, and more enjoyable.', '<h2>Minimalist Travel: Packing Light</h2><p>Traveling with less brings more freedom:</p><h3>1. The Capsule Wardrobe Approach</h3><p>Pack versatile, mix-and-match clothing items.</p><h3>2. Toiletries Strategy</h3><p>Use small containers and multi-use products.</p><h3>3. Digital Documents</h3><p>Store tickets and reservations on your phone.</p><h3>4. The \"Pack Half\" Rule</h3><p>Lay out what you think you need, then remove half.</p><h3>5. Wear Your Bulkiest Items</h3><p>Jackets and heavy shoes should be worn, not packed.</p><h3>6. Laundry on the Road</h3><p>Plan to wash clothes rather than overpack.</p><p>With practice, you can travel comfortably with just carry-on luggage for any trip length.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'travel, minimalism, lifestyle', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Minimalist Packing Guide', 'How to pack light for stress-free travel experiences.', 'travel, packing, minimalism', '2025-09-01 00:02:00', '2025-09-01 15:02:00'),
('e5f6a7b8-c9d0-1234-5678-90abcdef1234', 'Mindfulness Meditation for Beginners', 'mindfulness-meditation-beginners', 'public/uploads/files/blog-8.jpg', 'A step-by-step guide to starting a mindfulness meditation practice, even if you\'ve never meditated before.', '<h2>Mindfulness Meditation for Beginners</h2><p>Mindfulness meditation is simple but powerful. Here\'s how to begin:</p><h3>1. Find a Quiet Space</h3><p>Start with just 5 minutes in a comfortable, distraction-free area.</p><h3>2. Focus on Your Breath</h3><p>Pay attention to the sensation of breathing in and out.</p><h3>3. Notice When Your Mind Wanders</h3><p>Gently return focus to your breath without judgment.</p><h3>4. Body Scan</h3><p>Progressively notice sensations throughout your body.</p><h3>5. Make It a Habit</h3><p>Consistency matters more than duration when starting.</p><h3>6. Use Guided Meditations</h3><p>Apps or recordings can help when beginning.</p><p>Regular practice reduces stress and increases focus. Be patient with yourself.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'meditation, mindfulness, wellness', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 0, 'Beginner\'s Guide to Mindfulness', 'Simple steps to start a mindfulness meditation practice.', 'meditation, mindfulness, mental health', '2025-09-01 06:02:00', '2025-09-01 15:02:00'),
('f2g3h4i5-j6k7-8901-cdef-234567890123', 'The Science of Sleep: Optimizing Your Rest for Better Health', 'science-of-sleep-optimization', 'public/uploads/files/blog-15.jpg', 'Evidence-based strategies to improve sleep quality and duration, leading to better physical and mental health.', '<h2>The Science of Sleep Optimization</h2><p>Quality sleep is foundational to health. Research shows:</p><h3>1. Consistent Sleep Schedule</h3><p>Going to bed and waking at the same time regulates your circadian rhythm.</p><h3>2. Ideal Sleep Environment</h3><p>Cool, dark, and quiet rooms promote better rest.</p><h3>3. Blue Light Reduction</h3><p>Avoid screens 1-2 hours before bedtime.</p><h3>4. Caffeine Timing</h3><p>Limit caffeine after 2pm for undisturbed sleep.</p><h3>5. The 20-Minute Rule</h3><p>If you can\'t sleep, get up and do something relaxing.</p><h3>6. Sleep Tracking</h3><p>Use technology judiciously to identify patterns.</p><p>Prioritizing sleep improves cognition, mood, immunity, and longevity.</p>', '5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'sleep, health, wellness', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'How to Improve Your Sleep', 'Science-backed methods for better sleep and health.', 'sleep, health, wellness, neuroscience', '2025-08-31 23:02:00', '2025-09-01 15:02:00'),
('f3a5bcef-6ebc-42ec-848e-9dc5d82f7200', 'The Art of Mindful Gardening', 'the-art-of-mindful-gardening', 'public/uploads/files/blog-2.jpg', 'Discover the therapeutic benefits of mindful gardening and how it can transform your outdoor space into a sanctuary of peace and tranquility.', '<h2>The Art of Mindful Gardening</h2> <p>In our fast-paced world, finding moments of peace can be challenging. Mindful gardening offers a serene escape, allowing you to connect with nature and cultivate a sense of calm. Here is how to transform your garden into a sanctuary:</p> <h3>1. Engage Your Senses</h3> <p>Take a moment to feel the soil, listen to the rustling leaves, and breathe in the floral scents. Engaging your senses helps ground you in the present moment.</p> <h3>2. Embrace the Process</h3> <p>Gardening is a journey, not a destination. Embrace the process of planting, watering, and nurturing your plants, and let go of the need for immediate results.</p> <h3>3. Create a Routine</h3> <p>Set aside time each day to tend to your garden. This routine can become a meditative practice, providing structure and tranquility to your day.</p> <h3>4. Reflect and Appreciate</h3> <p>Take time to reflect on the growth in your garden and in yourself. Appreciate the beauty of nature and the peace it brings to your life.</p> <p>Mindful gardening is more than a hobby; its a path to inner peace. Start small, be present, and watch your garden—and your mind—bloom.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'gardening, mindfulness, mental health, wellness', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 0, 'The Art of Mindful Gardening', 'This is a sample blog post for demonstration purposes.', 'gardening, mindfulness, mental health, wellness', '2025-09-01 11:02:00', '2025-09-01 15:02:00'),
('f6a7b8c9-d0e1-2345-6789-0abcdef12345', 'The Psychology of Color in Marketing', 'psychology-of-color-marketing', 'public/uploads/files/blog-9.jpg', 'How different colors influence consumer behavior and what this means for your branding and marketing strategies.', '<h2>The Psychology of Color in Marketing</h2><p>Colors evoke emotions and influence decisions. Key insights:</p><h3>1. Red</h3><p>Creates urgency - often used for clearance sales.</p><h3>2. Blue</h3><p>Builds trust - favored by banks and tech companies.</p><h3>3. Green</h3><p>Associated with health and environment - used for organic products.</p><h3>4. Yellow</h3><p>Grabs attention - effective for window displays.</p><h3>5. Black</h3><p>Signifies luxury - common for high-end products.</p><h3>6. Cultural Differences</h3><p>Color meanings vary globally (e.g., white symbolizes mourning in some cultures).</p><p>Choose colors strategically based on your target audience and brand personality.</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'marketing, psychology, design', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 1, 'Color Psychology in Marketing', 'How colors affect consumer perceptions and buying decisions.', 'color psychology, marketing, branding', '2025-09-01 05:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `description`, `group`, `parent`, `link`, `new_tab`, `order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', 0, 2, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('181dd10c-49d4-49bb-b3c0-f81ff69a35f6', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', 0, 4, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Lifestyle & Wellness', 'Tips for healthy living, mindfulness practices, and personal development', NULL, NULL, 'lifestyle-wellness', 0, 3, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'Technology & Innovation', 'Cutting-edge technology trends, AI developments, and digital innovations', NULL, NULL, 'technology-innovation', 0, 2, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Business & Career', 'Articles about business strategies, career development, and workplace trends', NULL, NULL, 'business-career', 0, 1, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainability', 'Eco-friendly living, environmental awareness, and sustainable practices', NULL, NULL, 'sustainability', 0, 4, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'Personal Finance', 'Money management, investing tips, and financial planning strategies', NULL, NULL, 'personal-finance', 0, 5, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', 0, 6, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `code_for` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `code` text COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`code_id`, `code_for`, `code`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1037D161-A760-4A5D-BBEE-39F8B0C65092', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('235CC95A-6759-4E33-AE62-BBC4695CC446', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('BBDD5A2F-4921-41E6-AD40-B0A0ED053884', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`config_id`, `config_for`, `description`, `config_value`, `icon`, `group`, `data_type`, `options`, `default_value`, `custom_class`, `search_terms`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0648522D-4FE3-4874-9D0A-D93A1D7E3DB0', 'SiteKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('0812E763-6AA3-411C-BEFD-10B588828207', 'GeminiBaseURL', 'Base URL for the API AI service to use (e.g., Gemini).', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', 'ri-robot-2-fill', 'ai', 'Text', NULL, 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', '', 'ai,base url,chat,help,gemini,deepseek,qwen,gpt', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('0EC2317D-3E53-4C3C-A220-745DD67A6A6A', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('12ED0EE7-481B-4E08-9661-7EEEFB940267', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('27AAEC2E-7AE3-4DBC-A31A-FAE1BA61091D', 'BackendLogoLink', 'Logo link for the backend interface.', 'public/uploads/files/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('365AD41E-9EF8-43E8-AAA0-ADBC6ABA58D2', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('3AC5E23C-E4E2-43CF-9B26-91FA7E679FC0', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('5689D39A-935D-46D0-AABD-2A68FEE4592A', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('572A7628-136E-47EE-A676-B9A2BEDF228C', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '1', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('5ABF9EE0-18AC-443B-94D2-D843B41CB5BD', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'public/uploads/files/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', '', '', '', 'favicon,site,icon,browser', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', '72638807-85B3-4BE8-A88D-A76084865A1A', '2025-09-01 15:02:00', '2025-09-02 13:58:52'),
('5D4DB7FA-F21B-4073-8E72-C9789DC257D6', 'EnableIgniterNewsFeed', 'Get latest news, features, and security update feeds from Igniter CMS.', 'Yes', 'ri-newspaper-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'igniter-cms,news feed,security updates', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('68E88E9C-AF7E-4C6B-9F3A-67A95107EF8D', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('7C720C1C-150D-4E68-AF25-EF2E30A43736', 'InstallationTracked', 'Checks if installation is tracked.', 'Yes', 'ri-line-chart-fill', 'site', 'Select', 'Yes,No', 'No', '', 'tracking,installation,stat', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:13'),
('7DBD6E89-3812-4ACD-BD0B-05EB6BF81A7C', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('83A8F5D6-81DE-424F-8FDA-D93AD30E5D98', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'public/uploads/files/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('9095049D-770F-4A5B-83E2-8E92D13FAED4', 'SiteName', 'Name of the company or organization.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('937005CB-8B7D-4C8D-B65C-73B611CCCDED', 'EnableInstallationTracking', 'Enable or disable installation tracking. Only executed once if yes.', 'No', 'ri-line-chart-fill', 'site', 'Select', 'Yes,No', 'Yes', '', 'tracking,installation,stat', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:13'),
('CB53B4C7-B927-41EC-8505-8FFEFA55D3B1', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('CCA54C46-84FE-4D67-96D2-0B1FCB3195E2', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ContentBlocksModel, NavigationsModel, PagesModel, ThemesModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('DA13BE26-225D-42A6-A824-24CF613533CC', 'SiteDescription', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('E4824DCB-0B19-423D-A2E7-786B73B44EFF', 'GeminiAPIKey', 'API key for the AI service to use (e.g., Gemini).', '', 'ri-robot-2-fill', 'ai', 'Text', NULL, '', '', 'ai,chat,help,gemini,deepseek,qwen,gpt', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('E6DFFF50-33E3-4EB1-94E9-E86915BCC621', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'public/uploads/files/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', '', '', '', 'favicon,site,icon,browser', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', '72638807-85B3-4BE8-A88D-A76084865A1A', '2025-09-01 15:02:00', '2025-09-02 13:58:29'),
('ECBE7E6A-F523-4002-9149-F71B66EDFAAE', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('F0530265-CAC8-4E52-9E6D-37FF57D622C6', 'EnableGlobalSearchIcon', 'Enable or disable global search icon feature.', 'Yes', 'ri-search-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'search,global search,search modal', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_blocks`
--

INSERT INTO `content_blocks` (`content_id`, `identifier`, `author`, `title`, `description`, `content`, `icon`, `group`, `image`, `link`, `new_tab`, `custom_field`, `order`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('8690E6CA-1CA7-4103-897B-07BC97F65FBF', 'BusinessServices', 72638807, 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>', 'ri-database-2-line', 'theme', 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services', 'https://example.com/business-services', 1, '{\"color\": \"#007bff\", \"priority\": \"high\"}', 2, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('C73FE963-71E6-4F00-86D4-CFB54AD813A9', 'SavingInvestments', 72638807, 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', 'Learn how our investment strategies can maximize your returns while minimizing risks.', 'ri-reactjs-fill', 'theme', 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments', 'https://example.com/saving-investments', 0, '{\"color\": \"#28a745\", \"priority\": \"medium\"}', 4, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD', 'OnlineConsulting', 72638807, 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Access expert advice from anywhere with our virtual consulting services.</p>', 'ri-global-line', 'theme', 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting', 'https://example.com/online-consulting', 1, '{\"color\": \"#dc3545\", \"priority\": \"low\"}', 6, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `iso` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nicename` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iso3` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numcode` int DEFAULT NULL,
  `phonecode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICANSAMOA', 'AmericanSamoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUAANDBARBUDA', 'AntiguaandBarbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIAANDHERZEGOVINA', 'BosniaandHerzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVETISLAND', 'BouvetIsland', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISHINDIANOCEANTERRITORY', 'BritishIndianOceanTerritory', NULL, NULL, 246),
(32, 'BN', 'BRUNEIDARUSSALAM', 'BruneiDarussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINAFASO', 'BurkinaFaso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPEVERDE', 'CapeVerde', 'CPV', 132, 238),
(40, 'KY', 'CAYMANISLANDS', 'CaymanIslands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRALAFRICANREPUBLIC', 'CentralAfricanRepublic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMASISLAND', 'ChristmasIsland', NULL, NULL, 61),
(46, 'CC', 'COCOS(KEELING)ISLANDS', 'Cocos(Keeling)Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO,THEDEMOCRATICREPUBLICOFTHE', 'Congo,theDemocraticRepublicofthe', 'COD', 180, 242),
(51, 'CK', 'COOKISLANDS', 'CookIslands', 'COK', 184, 682),
(52, 'CR', 'COSTARICA', 'CostaRica', 'CRI', 188, 506),
(53, 'CI', 'COTED\'IVOIRE', 'CoteD\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECHREPUBLIC', 'CzechRepublic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICANREPUBLIC', 'DominicanRepublic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'ELSALVADOR', 'ElSalvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIALGUINEA', 'EquatorialGuinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLANDISLANDS(MALVINAS)', 'FalklandIslands(Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROEISLANDS', 'FaroeIslands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCHGUIANA', 'FrenchGuiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCHPOLYNESIA', 'FrenchPolynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCHSOUTHERNTERRITORIES', 'FrenchSouthernTerritories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARDISLANDANDMCDONALDISLANDS', 'HeardIslandandMcdonaldIslands', NULL, NULL, 0),
(94, 'VA', 'HOLYSEE(VATICANCITYSTATE)', 'HolySee(VaticanCityState)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONGKONG', 'HongKong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN,ISLAMICREPUBLICOF', 'Iran,IslamicRepublicof', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA,DEMOCRATICPEOPLE\'SREPUBLICOF', 'Korea,DemocraticPeople\'sRepublicof', 'PRK', 408, 850),
(113, 'KR', 'KOREA,REPUBLICOF', 'Korea,Republicof', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAOPEOPLE\'SDEMOCRATICREPUBLIC', 'LaoPeople\'sDemocraticRepublic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYANARABJAMAHIRIYA', 'LibyanArabJamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA,THEFORMERYUGOSLAVREPUBLICOF', 'Macedonia,theFormerYugoslavRepublicof', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALLISLANDS', 'MarshallIslands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA,FEDERATEDSTATESOF', 'Micronesia,FederatedStatesof', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA,REPUBLICOF', 'Moldova,Republicof', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDSANTILLES', 'NetherlandsAntilles', 'ANT', 530, 599),
(152, 'NC', 'NEWCALEDONIA', 'NewCaledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEWZEALAND', 'NewZealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLKISLAND', 'NorfolkIsland', 'NFK', 574, 672),
(159, 'MP', 'NORTHERNMARIANAISLANDS', 'NorthernMarianaIslands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIANTERRITORY,OCCUPIED', 'PalestinianTerritory,Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUANEWGUINEA', 'PapuaNewGuinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTORICO', 'PuertoRico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIANFEDERATION', 'RussianFederation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINTHELENA', 'SaintHelena', 'SHN', 654, 290),
(180, 'KN', 'SAINTKITTSANDNEVIS', 'SaintKittsandNevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINTLUCIA', 'SaintLucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINTPIERREANDMIQUELON', 'SaintPierreandMiquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINTVINCENTANDTHEGRENADINES', 'SaintVincentandtheGrenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SANMARINO', 'SanMarino', 'SMR', 674, 378),
(186, 'ST', 'SAOTOMEANDPRINCIPE', 'SaoTomeandPrincipe', 'STP', 678, 239),
(187, 'SA', 'SAUDIARABIA', 'SaudiArabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIAANDMONTENEGRO', 'SerbiaandMontenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRALEONE', 'SierraLeone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMONISLANDS', 'SolomonIslands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTHAFRICA', 'SouthAfrica', 'ZAF', 710, 27),
(198, 'GS', 'SOUTHGEORGIAANDTHESOUTHSANDWICHISLANDS', 'SouthGeorgiaandtheSouthSandwichIslands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRILANKA', 'SriLanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARDANDJANMAYEN', 'SvalbardandJanMayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIANARABREPUBLIC', 'SyrianArabRepublic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN,PROVINCEOFCHINA', 'Taiwan,ProvinceofChina', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA,UNITEDREPUBLICOF', 'Tanzania,UnitedRepublicof', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDADANDTOBAGO', 'TrinidadandTobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKSANDCAICOSISLANDS', 'TurksandCaicosIslands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITEDARABEMIRATES', 'UnitedArabEmirates', 'ARE', 784, 971),
(225, 'GB', 'UNITEDKINGDOM', 'UnitedKingdom', 'GBR', 826, 44),
(226, 'US', 'UNITEDSTATES', 'UnitedStates', 'USA', 840, 1),
(227, 'UM', 'UNITEDSTATESMINOROUTLYINGISLANDS', 'UnitedStatesMinorOutlyingIslands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIETNAM', 'VietNam', 'VNM', 704, 84),
(233, 'VG', 'VIRGINISLANDS,BRITISH', 'VirginIslands,British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGINISLANDS,U.S.', 'VirginIslands,U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLISANDFUTUNA', 'WallisandFutuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERNSAHARA', 'WesternSahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `data_groups`
--

CREATE TABLE `data_groups` (
  `data_group_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_for` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_list` text COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_groups`
--

INSERT INTO `data_groups` (`data_group_id`, `data_group_for`, `data_group_list`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('25294D89-991E-430B-9606-599E27064653', 'Navigation', 'top_nav,charity,services,footer_nav,business,ecommerce,restaurant,general', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('3A48D215-D239-40CB-B161-7AA90C91B644', 'Category', 'business,ecommerce,restaurant,general', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('3F633C68-0A39-4D3C-B630-DAFCFB1B0BD8', 'Page', 'business,ecommerce,restaurant,general', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('672BB302-34AA-48BA-B6A3-94B841685523', 'ContentBlock', 'business,ecommerce,restaurant,general', 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `error_log_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `severity` int NOT NULL,
  `error_message` text COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `icp_seo_master_config`
--

CREATE TABLE `icp_seo_master_config` (
  `id` int UNSIGNED NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `schema_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `og_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `default_meta_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `default_meta_description` text COLLATE utf8mb4_general_ci,
  `default_meta_keywords` text COLLATE utf8mb4_general_ci,
  `facebook_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `robots_indexing` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `og_locale` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `favicon_16` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `favicon_32` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `favicon_apple_touch` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icp_seo_master_config`
--

INSERT INTO `icp_seo_master_config` (`id`, `enabled`, `schema_enabled`, `og_image`, `default_meta_title`, `default_meta_description`, `default_meta_keywords`, `facebook_url`, `twitter_url`, `instagram_url`, `robots_indexing`, `og_locale`, `language`, `favicon_16`, `favicon_32`, `favicon_apple_touch`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '/public/uploads/files/favicon.ico', 'Welcome to Example.com', 'Explore our content, blogs, and more at Example.com.', 'example,website,content', 'https://facebook.com/example', 'https://twitter.com/example', 'https://instagram.com/example', 'index, follow', 'en_US', 'en', '/public/uploads/files/favicon-96x96.png', '/public/uploads/files/web-app-manifest-192x192.png', '/public/uploads/files/apple-touch-icon.png', '2025-09-02 13:59:34', '2025-09-02 14:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', 1756735319, 1),
(2, '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', 1756735319, 1),
(3, '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1756735319, 1),
(4, '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', 1756735319, 1),
(5, '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', 1756735319, 1),
(6, '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', 1756735319, 1),
(7, '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', 1756735319, 1),
(8, '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', 1756735320, 1),
(9, '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', 1756735320, 1),
(10, '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', 1756735320, 1),
(11, '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1756735320, 1),
(12, '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', 1756735320, 1),
(13, '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', 1756735320, 1),
(14, '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', 1756735320, 1),
(15, '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', 1756735321, 1),
(16, '2024-11-12-143627', '\\SiteStats', 'default', 'App', 1756735321, 1),
(17, '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', 1756735321, 1),
(18, '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', 1756735321, 1),
(19, '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', 1756735321, 1),
(20, '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', 1756735321, 1),
(21, '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', 1756735321, 1),
(22, '2025-06-01-113456', 'App\\Database\\Migrations\\DataGroups', 'default', 'App', 1756735321, 1),
(23, '2025-06-20-151038', 'App\\Database\\Migrations\\Plugins', 'default', 'App', 1756735322, 1),
(24, '2025-07-01-161418', 'App\\Database\\Migrations\\PluginConfigs', 'default', 'App', 1756735322, 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `navigation_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order` int DEFAULT '10',
  `parent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`navigation_id`, `title`, `description`, `icon`, `group`, `order`, `parent`, `link`, `new_tab`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', '', 'footer_nav', 44, NULL, 'rss', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', '', 'services', 28, NULL, '#!', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('131c5798-d0b7-484c-bf21-e1768458632f', 'Home', 'Home navigation', '', 'top_nav', 2, NULL, 'home', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', '', 'footer_nav', 36, NULL, '#services', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', '', 'services', 30, NULL, '#!', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', '', 'footer_nav', 38, NULL, '/cookie-policy', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', '', 'top_nav', 10, NULL, '#team', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', '', 'top_nav', 4, NULL, '#about', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', '', 'footer_nav', 42, NULL, 'sitemap', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', '', 'footer_nav', 34, NULL, '#about', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', '', 'top_nav', 20, NULL, 'contact', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', '', 'footer_nav', 32, NULL, 'home', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', '', 'services', 26, NULL, '#!', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', '', 'footer_nav', 40, NULL, '/privacy-policy', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', '', 'top_nav', 12, NULL, 'blogs', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', '', 'top_nav', 6, NULL, '#services', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', '', 'services', 24, NULL, '#!', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', '', 'top_nav', 8, NULL, '#portfolio', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01'),
('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', '', 'services', 22, NULL, '#!', 0, 1, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `slug`, `group`, `status`, `total_views`, `content`, `created_by`, `updated_by`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', 'general', 1, 0, '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'About Us', 'about-us', 'business', 1, 0, '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>', '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 'About Us - Our Company', 'Learn more about our companys mission, values, and team', 'about us, company, mission, values, team', '2025-09-01 15:02:00', '2025-09-01 15:02:00'),
('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', 'general', 1, 0, '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2025-09-01 15:02:00', '2025-09-01 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` char(36) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `plugin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `plugin_key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `update_available` int DEFAULT '0',
  `load` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`plugin_id`, `plugin_key`, `status`, `update_available`, `load`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('7B1EC1E6-B7B2-45E9-8072-2402E759DFC6', 'seo-master', 1, 0, 'header,meta', '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-02 13:59:35', '2025-09-02 13:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `plugin_configs`
--

CREATE TABLE `plugin_configs` (
  `id` int UNSIGNED NOT NULL,
  `plugin_slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `config_key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `config_value` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `role_description`, `updated_at`, `created_at`) VALUES
('B910F6B3-507F-4C63-8AF6-6995484F6A97', 'Manager', 'Manager Role', '2025-09-01 15:01:59', '2025-09-01 15:01:59'),
('EAF61AF5-C30B-4B0B-A2F5-9E7149C4C4B8', 'Admin', 'Admin role', '2025-09-01 15:01:59', '2025-09-01 15:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `site_stats`
--

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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_stats`
--

INSERT INTO `site_stats` (`site_stat_id`, `ip_address`, `device_type`, `browser_type`, `page_type`, `page_visited_id`, `page_visited_url`, `referrer`, `status_code`, `user_id`, `session_id`, `request_method`, `operating_system`, `country`, `screen_resolution`, `user_agent`, `other_params`, `created_at`) VALUES
('21FA6EDE-5D21-4FFB-A229-B6542E6A1B30', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', '', 200, '', 'ee988ef0f5555cc2c2a98716d98fd1da', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', NULL, '2025-09-01 15:02:12'),
('4DED6481-89FB-445D-AFE7-0B273BEF4840', '192.168.1.1', 'mobile', 'Safari', 'Page', '09C770E5-686F-4F01-BA40-E83E0C7B8AC0', 'http://localhost/apps/igniter-cms/about', 'POST', 201, '72638807-85B3-4BE8-A88D-A76084865A1A', 'session-68b5a759218c9', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2025-09-01 14:02:01'),
('5642CEDC-E69D-458B-954A-A36638FC26C9', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '0F0C9274-CDD1-4F35-8B88-77CBC7ECD34B', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '90589161-01C0-4DBD-B92E-1BC0126868A3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-06-01 00:00:00'),
('704B63AA-8B6C-4FED-90F6-7AE8E65B0C42', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'FA04FA02-33C4-4B19-A04C-64ABDC09D9E9', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '94E05E65-D3C6-467D-AB55-7890BBB43A35', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2025-08-26 14:02:01'),
('80FC8D56-0B5F-4534-9124-4EEF656A7A3E', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'A164EE39-1384-4950-BAF4-297D2E948C3C', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', 'E9FF1866-1DF8-445E-B24D-DE8A7AE6BF8E', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-06-01 00:00:00'),
('812DC8DD-6F32-4CD0-BAAA-5E8DF1FE2198', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'E96E021E-A4F3-4388-8DA9-E23E27970BA9', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '3FE52BA9-E5B8-4601-943C-16D35B88256A', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-29 14:02:01'),
('957F6A6B-A177-4989-A325-3EEB62399FB0', '172.16.0.1', 'mobile', 'Edge', 'Page', '25A8BEDA-5048-41A4-8E13-65C91523FC45', 'http://localhost/apps/igniter-cms/', 'POST', 204, '72638807-85B3-4BE8-A88D-A76084865A1A', '24E0CEE1-E583-4CF2-9687-16652C3AA7C8', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-08-30 14:02:01'),
('96F0E3E4-A347-4A35-9AAD-622C09070B77', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '58185422-8635-48B8-9C7D-2D9DB82EDE6B', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', 'CD78A72D-5817-46C5-8A9B-D62E4F9D3D18', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-03-01 00:00:00'),
('A980CF9B-A2C0-4B2C-8646-DD20AC8BFDA3', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '1C2338D0-3B35-43BF-A798-498C72653F0D', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '3246B0F8-F6FB-412F-B73D-6DCA38271A9D', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-04-01 00:00:00'),
('CDD4D437-85AA-4C8C-8C67-C0BCB8A026EE', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '5AB259B6-A4E2-4C89-A4E7-7A27C98F463E', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '30E4911F-4849-4D1D-A43F-412E1F20200F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-05-01 00:00:00'),
('CF61D2A7-B12C-4FB8-A373-33A539391A06', '10.0.0.1', 'tablet', 'Firefox', 'Page', 'E1D3A338-EE6E-4E34-863E-E4680443496B', 'http://localhost/apps/igniter-cms/contact', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '907F67FF-DF3F-4E36-AF92-27F628CFD525', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-31 14:02:01'),
('DFCEF77C-BE72-4731-8033-9C94C9D5C487', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'AEA66376-BF1C-4F68-8EFF-5C678A1795BE', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '769D2ABC-1B0F-4E32-81C0-7C86D2653609', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2025-08-27 14:02:01'),
('E89FB6ED-9414-4E50-B696-0F3DBFB3F734', '192.168.2.1', 'mobile', 'Opera', 'Page', 'A83F1056-96E1-443C-8DC3-A043B0947770', 'http://localhost/apps/igniter-cms/blog', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '4ED31A27-92A5-4D4A-BC58-EC687BEB8F68', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-08-28 14:02:01'),
('F3C85148-A180-4BF6-9B1C-3670FA67BA84', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '3C1BE765-F99B-409B-A1FD-28106806109F', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', '9CBE3C33-F6B1-4458-B58F-CD1F0DC34C4E', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-01 00:00:00'),
('FDE5ED9F-35FF-40A3-BE7C-92AD86A06D44', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '956F99D9-1BDE-40F8-8A33-FD1B6A294214', 'http://localhost/apps/igniter-cms/', 'GET', 200, '72638807-85B3-4BE8-A88D-A76084865A1A', 'FA427713-2952-4A76-B6AD-F5209EB2CDFD', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `name`, `path`, `primary_color`, `secondary_color`, `background_color`, `image`, `theme_url`, `category`, `sub_category`, `selected`, `override_default_style`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('46D1DD91-0DDE-40E6-BD79-0B6F75BAE032', 'Default', '/default', '#212529', '#0d6efd', '#f2f7f7', 'public/front-end/themes/default/assets/images/preview.png', 'https://themes.ignitercms.com/demo/Default/', 'Business & Corporate', 'Portfolio & Resume', 1, 0, 0, '72638807-85B3-4BE8-A88D-A76084865A1A', NULL, '2025-09-01 15:02:01', '2025-09-01 15:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'https://ignitercms.com/assets/img/default/default-profile.png',
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `twitter_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about_summary` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `upload_directory` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user_jrNLE',
  `password_change_required` tinyint(1) DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `status`, `role`, `profile_picture`, `twitter_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `about_summary`, `upload_directory`, `password_change_required`, `remember_token`, `expires_at`, `created_at`, `updated_at`) VALUES
('72638807-85B3-4BE8-A88D-A76084865A1A', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$WbUyrshZ8Im5.AG63rjUeO2ais.yMLhQ.55CKn/QxVZ7J/S6h2wpK', 1, 'Admin', 'https://ignitercms.com/assets/img/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', 1, '37B23841-AE3A-48ED-B296-EAAF56F5633D-24F18309-8146-4B1D-BDF4-96FBF0C8FBC0', '2025-09-04 13:02:24', '2025-09-01 15:01:59', '2025-09-01 15:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `whitelisted_ips`
--

CREATE TABLE `whitelisted_ips` (
  `whitelisted_ip_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`),
  ADD UNIQUE KEY `activity_id` (`activity_id`),
  ADD KEY `activity_by` (`activity_by`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `api_accesses`
--
ALTER TABLE `api_accesses`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `api_calls_tracker`
--
ALTER TABLE `api_calls_tracker`
  ADD PRIMARY KEY (`api_call_id`);

--
-- Indexes for table `app_modules`
--
ALTER TABLE `app_modules`
  ADD PRIMARY KEY (`app_module_id`),
  ADD UNIQUE KEY `app_module_id` (`app_module_id`),
  ADD KEY `module_name` (`module_name`),
  ADD KEY `module_description` (`module_description`),
  ADD KEY `module_search_terms` (`module_search_terms`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `blocked_ips`
--
ALTER TABLE `blocked_ips`
  ADD PRIMARY KEY (`blocked_ip_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `title` (`title`),
  ADD KEY `slug` (`slug`),
  ADD KEY `category` (`category`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `title` (`title`),
  ADD KEY `group` (`group`),
  ADD KEY `parent` (`parent`),
  ADD KEY `status` (`status`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code_id`),
  ADD UNIQUE KEY `code_for` (`code_for`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`config_id`),
  ADD UNIQUE KEY `config_id` (`config_id`),
  ADD UNIQUE KEY `config_for` (`config_for`);

--
-- Indexes for table `content_blocks`
--
ALTER TABLE `content_blocks`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `identifier` (`identifier`),
  ADD KEY `author` (`author`),
  ADD KEY `title` (`title`),
  ADD KEY `group` (`group`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iso` (`iso`),
  ADD KEY `name` (`name`),
  ADD KEY `nicename` (`nicename`),
  ADD KEY `iso3` (`iso3`);

--
-- Indexes for table `data_groups`
--
ALTER TABLE `data_groups`
  ADD PRIMARY KEY (`data_group_id`),
  ADD UNIQUE KEY `data_group_for` (`data_group_for`);

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`error_log_id`),
  ADD UNIQUE KEY `error_log_id` (`error_log_id`);

--
-- Indexes for table `icp_seo_master_config`
--
ALTER TABLE `icp_seo_master_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`navigation_id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `title` (`title`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`plugin_id`);

--
-- Indexes for table `plugin_configs`
--
ALTER TABLE `plugin_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_plugin_config` (`plugin_slug`,`config_key`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_id` (`role_id`);

--
-- Indexes for table `site_stats`
--
ALTER TABLE `site_stats`
  ADD PRIMARY KEY (`site_stat_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `path` (`path`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `profile_picture` (`profile_picture`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `whitelisted_ips`
--
ALTER TABLE `whitelisted_ips`
  ADD PRIMARY KEY (`whitelisted_ip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `icp_seo_master_config`
--
ALTER TABLE `icp_seo_master_config`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `plugin_configs`
--
ALTER TABLE `plugin_configs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

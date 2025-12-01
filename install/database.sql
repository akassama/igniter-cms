-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2025 at 04:39 PM
-- Server version: 8.0.44
-- PHP Version: 8.2.29

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
('8143FF2F-A419-49EB-82E5-7CFCB48C1066', 'c88dab26cec5c84d2a71cbf20c3bbdd8ca660d2ef06b3e8d50ceed05b3213623', '7B746E07-F591-4B85-9BBC-6A98B5951967', 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
('13A56B0C-0EF6-451D-AA87-6A2F39219075', 'Codes', 'Manage codes', 'codes,references,identifiers', 'Admin', 'account/admin/codes', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('35467F7B-0E1A-4F82-8982-5C5C1FBFBCC6', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts', 'Admin,Manager,User', 'account/cms/blogs', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('3B04E6E4-321A-4DC2-801C-0238A5A588E2', 'Account Details', 'Update account details', 'account,profile,settings', 'Admin,Manager,User', 'account/settings/update-details', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('3C5682C4-2399-4487-ACF9-C95614574E10', 'Categories', 'Manage categories', 'category,categories,post category', 'Admin,Manager,User', 'account/cms/categories', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('3F8A1A53-BBC8-47F0-9A63-150E51AA8E0A', 'Comment Forms', 'Manage comment forms', 'comments,feedback,forms', 'Admin,Manager,User', 'account/forms/comment-forms', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('4331C0EF-9EEB-4CD7-9ED4-1217740FAE6D', 'Change Password', 'Change account password', 'password,security,change', 'Admin,Manager,User', 'account/settings/change-password', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('469DD7AD-F02E-4040-B234-3583BCE7B963', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview', 'Admin,Manager,User', 'account/dashboard', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('46E1F07B-3545-4BB5-91C3-03BCF8195AEE', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude, gemini, deepseek', 'Admin,Manager,User', 'account/ask-ai', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('52F78232-B37B-44BD-81EE-622B6DAEC54B', 'Backup', 'Manage backups', 'backup,restore,database', 'Admin', 'account/admin/backups', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('573F295D-3683-47B8-A0D5-A3EEC6BAABEA', 'Booking Forms', 'Manage booking forms', 'booking,appointments,forms', 'Admin,Manager,User', 'account/forms/booking-forms', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('5EA03825-6C27-47AF-8EFA-9ED7AB2B426D', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny ip,spam', 'Admin', 'account/admin/blocked-ips', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('6411769A-AA98-4B11-AD75-D2726A197EE3', 'Configurations', 'Manage configurations', 'configurations,settings,preferences', 'Admin', 'account/admin/configurations', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('645ADE01-846C-4A61-B24E-72592725FF7D', 'Users', 'Manage application users', 'users,accounts,people', 'Admin', 'account/admin/users', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('6EBADCA7-911F-4317-8702-768C368199BA', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links', 'Admin,Manager,User', 'account/cms/navigations', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('77DDF84C-023B-4C33-9CFF-5C91D4282D59', 'Subscription Forms', 'Manage subscription forms', 'subscription,newsletter,forms', 'Admin,Manager,User', 'account/forms/contact-forms', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('7AA20A11-7EBA-4865-B975-A9897FABF02D', 'Forms', 'Manage forms', 'contact,forms', 'Admin,Manager,User', 'account/forms', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('8C997099-AF1D-4975-A7B7-2D26E0B8A26D', 'API Keys', 'Manage api keys', 'api,keys,access', 'Admin', 'account/admin/api-keys', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('8EC7D496-586D-443A-ABF1-C5D52438A81B', 'Admin', 'Administration', 'admin,control,management', 'Admin', 'account/admin', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('906A1155-05EC-4F57-B00C-E92C38EDCAF9', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('9897BA76-A1FD-4545-B25A-1526FEE5EA55', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics', 'Admin', 'account/admin/visit-stats', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('A020EF60-1211-4A08-9B4D-93090792115A', 'Themes', 'Manage themes', 'themes,appearance,design', 'Admin', 'account/appearance/themes', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('A3DF8669-C5A1-4ED9-AE88-3C9F46BA7DF5', 'Error Logs', 'View error logs', 'error logs,activity,tracking', 'Admin', 'account/admin/logs', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('B7F1BFC1-1F31-4551-97A8-E15627DDEAD0', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'unblock,whitelist,security,allow ip', 'Admin', 'account/admin/whitelisted-ips', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('BC3CBA23-BC34-4779-89B5-2EE0775E6DAC', 'Themes', 'Manage theme files', 'themes,appearance,design,the files', 'Admin', 'account/appearance/theme-editor', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('BEB1B339-B9CB-4F5F-B216-5067E9067E35', 'Pages', 'Manage pages', 'pages,content,publish', 'Admin,Manager,User', 'account/cms/pages', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('C0291670-BA55-4F51-BB3E-98EED1688C41', 'Data Groups', 'Manage dat groups', 'data,content,data-groups', 'Admin,Manager,User', 'account/cms/data-groups', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('E6F0872E-294E-494D-B07A-616CFFD3B1C3', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets', 'Admin,Manager,User', 'account/content-blocks', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('EC8F1AB6-D902-4198-BF86-58687D57ABAC', 'Contact Forms', 'Manage contact forms', 'contact,forms', 'Admin,Manager,User', 'account/forms/contact-forms', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('EDD3CBAD-9DD0-420A-AE8C-8B007258B7E6', 'Activity Logs', 'View activity logs', 'logs,activity,tracking', 'Admin', 'account/admin/activity-logs', '2025-11-19 16:39:25', '2025-11-19 16:39:25');

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
  `is_breaking` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `blogs` (`blog_id`, `title`, `slug`, `featured_image`, `excerpt`, `content`, `category`, `tags`, `is_featured`, `is_breaking`, `status`, `author`, `created_by`, `updated_by`, `total_views`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'https://assets.aktools.net/image-stocks/posts/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', 0, 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 1, 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2025-11-19 15:39:26', '2025-11-19 16:39:26'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainable Living: Small Changes with Big Impact', 'sustainable-living-small-changes', 'https://assets.aktools.net/image-stocks/posts/blog-4.jpg', 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.', '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'sustainability, eco-friendly, lifestyle', 0, 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 0, 'Sustainable Living Tips', 'Easy ways to reduce your environmental impact through daily choices.', 'sustainability, eco-friendly, green living', '2025-11-19 13:39:26', '2025-11-19 16:39:26'),
('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'https://assets.aktools.net/image-stocks/posts/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'office, stakes, competitive', 0, 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 1, 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2025-11-19 14:39:26', '2025-11-19 16:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `booking_form_submissions`
--

CREATE TABLE `booking_form_submissions` (
  `booking_form_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `number_of_attendees` int DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `confirmation_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `resource_id` int DEFAULT NULL,
  `resource_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', 0, 2, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('181dd10c-49d4-49bb-b3c0-f81ff69a35f6', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', 0, 4, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Lifestyle & Wellness', 'Tips for healthy living, mindfulness practices, and personal development', NULL, NULL, 'lifestyle-wellness', 0, 3, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'Technology & Innovation', 'Cutting-edge technology trends, AI developments, and digital innovations', NULL, NULL, 'technology-innovation', 0, 2, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Business & Career', 'Articles about business strategies, career development, and workplace trends', NULL, NULL, 'business-career', 0, 1, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainability', 'Eco-friendly living, environmental awareness, and sustainable practices', NULL, NULL, 'sustainability', 0, 4, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'Personal Finance', 'Money management, investing tips, and financial planning strategies', NULL, NULL, 'personal-finance', 0, 5, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', 0, 6, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
('453B1436-79FE-4E86-8331-906372BC24DD', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('9BEC5B7D-3F0B-4736-933D-F7F2D673EEF0', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('E06FB1C6-13E6-4816-A27A-46B611FD862D', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `comment_form_submissions`
--

CREATE TABLE `comment_form_submissions` (
  `comment_form_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `gravatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `page_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `browser_signature` text COLLATE utf8mb4_general_ci,
  `is_reply` tinyint(1) NOT NULL DEFAULT '0',
  `reply_comment_form_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_me` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_updated_by` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0863D3CF-ED17-460C-B733-7A03D1ADE3DF', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('0D6B8DC4-9504-465B-8409-2E94F3CCDB16', 'BackendLogoLink', 'Logo link for the backend interface.', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1372EC50-C3FE-4801-B56B-363597B15184', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1891B920-5D71-4E7C-9576-E8D9A50EB1F8', 'GeminiBaseURL', 'Base URL for the API AI service to use (e.g., Gemini).', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', 'ri-robot-2-fill', 'ai', 'Text', NULL, 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', '', 'ai,base url,chat,help,gemini,deepseek,qwen,gpt', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1E810F27-D621-4166-BEB7-F13086406C4F', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1EDA7357-5692-42B5-B4A8-6FB5C854066A', 'SiteAddress', 'Address of the company, organization or business.', '221B Baker Street, London NW1 6XE, United Kingdom', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,address,locationb,business,organization', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('2E139D72-7E91-45E2-8117-17691F680D5C', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('2F77E443-9F34-44A0-B450-6EB4496792F4', 'GeminiAPIKey', 'API key for the AI service to use (e.g., Gemini).', '', 'ri-robot-2-fill', 'ai', 'Text', NULL, '', '', 'ai,chat,help,gemini,deepseek,qwen,gpt', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('30792149-095D-49AB-933D-8CCD8CB72122', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('339F1956-CF76-4A9F-BC0F-4FE2BACF22A7', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('3999C380-A0B3-471B-BB15-8E1ED21856B3', 'SiteName', 'Name of the company, organization or business.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('416E4548-E1EF-47BA-98DB-3DAFC8952C8F', 'EnableIgniterNewsFeed', 'Get latest news, features, and security update feeds from Igniter CMS.', 'Yes', 'ri-newspaper-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'igniter-cms,news feed,security updates', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('542593C6-5F1D-4C39-84EC-26647B40620C', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('5C028C65-8A6E-4BC2-920B-027A817870BF', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '10', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('66E9CDCA-BC81-42CE-B19C-503B1EC49DE7', 'SiteDescription', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('7BE0429A-B9C0-467D-B7CC-756D6229BE2E', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('8C8EB011-5F77-4DE3-80F7-92ADF05D9BA9', 'SiteKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('90E6D0E9-F376-435C-8105-5E0BDD0D77C6', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('B2E32EB2-EDFB-4B53-A215-C4838ACADC51', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('CF46CE10-6637-497E-A879-6EEF3CF94104', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('DE3F8B7D-8F45-4E1D-B1ED-C9E2D395B0EF', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ContentBlocksModel, NavigationsModel, PagesModel, ThemesModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('FCFA7F2B-7686-40AF-890E-1649B96775F8', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

CREATE TABLE `contact_form_submissions` (
  `contact_form_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `company` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `referrer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'New',
  `notes` text COLLATE utf8mb4_general_ci,
  `last_updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('8690E6CA-1CA7-4103-897B-07BC97F65FBF', 'BusinessServices', 7, 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>', 'ri-database-2-line', 'theme', 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services', 'https://example.com/business-services', 1, '{\"color\": \"#007bff\", \"priority\": \"high\"}', 2, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('C73FE963-71E6-4F00-86D4-CFB54AD813A9', 'SavingInvestments', 7, 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', 'Learn how our investment strategies can maximize your returns while minimizing risks.', 'ri-reactjs-fill', 'theme', 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments', 'https://example.com/saving-investments', 0, '{\"color\": \"#28a745\", \"priority\": \"medium\"}', 4, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD', 'OnlineConsulting', 7, 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Access expert advice from anywhere with our virtual consulting services.</p>', 'ri-global-line', 'theme', 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting', 'https://example.com/online-consulting', 1, '{\"color\": \"#dc3545\", \"priority\": \"low\"}', 6, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
('30DEE651-B4C8-4D09-BD65-6B9D25273E09', 'ContactFormStatus', 'New,In Progress,Resolved,Archived', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('339CAF6D-8822-4D26-93A8-2A48646595D8', 'Navigation', 'general,top_nav,services,footer_nav', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('3C9456BA-93C9-4BF3-9D9D-C51C476A0A00', 'Page', 'general,site', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('44012032-AA4E-4B92-BDE5-2E699607BA1C', 'SubscriptionFormStatus', 'Pending Confirmation,Active,Unsubscribed,Bounced', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('A0566442-21BE-4FCE-B709-0994DCB23A0D', 'ContentBlock', 'general', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('BDBC9AF5-4768-4C1F-80DF-31B7B618246D', 'Category', 'general,business,portfolio', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('DFC9ECB5-E431-43D1-941A-1314248E07E6', 'BookingFormPaymentStatus', 'None,Unpain,Paid,Refunded', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('F6CBBC0C-EBAF-4EF8-AC11-92406414027D', 'BookingFormStatus', 'Pending,Confirmed,Cancelled', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
(1, '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', 1763570365, 1),
(2, '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', 1763570365, 1),
(3, '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1763570365, 1),
(4, '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', 1763570365, 1),
(5, '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', 1763570365, 1),
(6, '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', 1763570365, 1),
(7, '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', 1763570365, 1),
(8, '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', 1763570366, 1),
(9, '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', 1763570366, 1),
(10, '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', 1763570366, 1),
(11, '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1763570366, 1),
(12, '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', 1763570366, 1),
(13, '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', 1763570366, 1),
(14, '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', 1763570366, 1),
(15, '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', 1763570366, 1),
(16, '2024-11-12-143627', '\\SiteStats', 'default', 'App', 1763570366, 1),
(17, '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', 1763570366, 1),
(18, '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', 1763570366, 1),
(19, '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', 1763570366, 1),
(20, '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', 1763570366, 1),
(21, '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', 1763570366, 1),
(22, '2025-06-01-113456', 'App\\Database\\Migrations\\DataGroups', 'default', 'App', 1763570366, 1),
(23, '2025-06-20-151038', 'App\\Database\\Migrations\\Plugins', 'default', 'App', 1763570366, 1),
(24, '2025-07-01-161418', 'App\\Database\\Migrations\\PluginConfigs', 'default', 'App', 1763570366, 1),
(25, '2025-10-14-165005', 'App\\Database\\Migrations\\SubscriptionForms', 'default', 'App', 1763570366, 1),
(26, '2025-10-14-165035', 'App\\Database\\Migrations\\ContactForms', 'default', 'App', 1763570366, 1),
(27, '2025-10-14-165049', 'App\\Database\\Migrations\\BookingForms', 'default', 'App', 1763570366, 1),
(28, '2025-10-31-142255', 'App\\Database\\Migrations\\CommentForms', 'default', 'App', 1763570366, 1),
(29, '2025-11-13-164704', 'App\\Database\\Migrations\\ThemeRevisions', 'default', 'App', 1763570367, 1);

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
('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', '', 'footer_nav', 44, NULL, 'rss', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', '', 'services', 28, NULL, '#!', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('131c5798-d0b7-484c-bf21-e1768458632f', 'Home', 'Home navigation', '', 'top_nav', 2, NULL, 'home', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', '', 'footer_nav', 36, NULL, '#services', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', '', 'services', 30, NULL, '#!', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', '', 'footer_nav', 38, NULL, 'cookie-policy', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', '', 'top_nav', 10, NULL, '#team', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', '', 'top_nav', 4, NULL, 'about-us', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', '', 'footer_nav', 42, NULL, 'sitemap', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', '', 'footer_nav', 34, NULL, 'about-us', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', '', 'top_nav', 20, NULL, '#contact', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', '', 'footer_nav', 32, NULL, 'home', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', '', 'services', 26, NULL, '#!', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', '', 'footer_nav', 40, NULL, 'privacy-policy', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', '', 'top_nav', 12, NULL, 'blogs', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', '', 'top_nav', 6, NULL, '#services', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', '', 'services', 24, NULL, '#!', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', '', 'top_nav', 8, NULL, '#portfolio', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', '', 'services', 22, NULL, '#!', 0, 1, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `pages` (`page_id`, `title`, `slug`, `group`, `status`, `total_views`, `content`, `author`, `created_by`, `updated_by`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', 'general', 1, 0, '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'About Us', 'about-us', 'business', 1, 0, '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>', '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 'About Us - Our Company', 'Learn more about our companys mission, values, and team', 'about us, company, mission, values, team', '2025-11-19 16:39:26', '2025-11-19 16:39:26'),
('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', 'general', 1, 0, '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', '7B746E07-F591-4B85-9BBC-6A98B5951967', '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2025-11-19 16:39:26', '2025-11-19 16:39:26');

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
('1DE4FE6D-AFEA-4C5E-A137-B6D499FF8F08', 'Admin', 'Admin role', '2025-11-19 16:39:25', '2025-11-19 16:39:25'),
('496B1808-0E8A-44B2-B6FA-9C712AD69294', 'Manager', 'Manager Role', '2025-11-19 16:39:25', '2025-11-19 16:39:25');

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
('0E13BA4F-BE8B-4B4C-9540-D701176997B2', '10.0.0.1', 'tablet', 'Firefox', 'Page', 'C5D4C0CF-F92E-4F95-83CB-E87167B1D417', 'http://localhost/apps/igniter-cms/contact', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '51743B63-9CFE-457C-B812-A53C6084F275', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-11-18 16:39:26'),
('1A6DF9CF-9B49-42A9-9CA1-7354B4F9F937', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'DABD7D5E-DEAE-4F09-A397-7F9007516303', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '0A5F3E8D-B23F-4263-B4E7-C72A5420DEAF', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-01 00:00:00'),
('250E1E05-D403-48A3-A4F0-A5F64A859983', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'B54D768E-8A0A-4434-BAD1-07253AA65125', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', 'F0714B7F-A1F9-4CDB-883A-5BCAFE75B4D2', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-11-16 16:39:26'),
('34986201-C7A4-4569-8F7A-8EC990DFFCF0', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'FD18770A-FF26-4FC9-BF19-4CA16AE2F734', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '55AB313A-A716-401F-85B9-8F3CCCD210AA', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2025-11-13 16:39:26'),
('354125BF-840A-427A-9C7E-EAA4DFF15F2C', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'F0F7D2AE-E0BC-4D22-A0F9-B40BFFA7278A', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '749BF33F-A597-4D74-9A82-D04ABFA6845F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-07-01 00:00:00'),
('5954F3A5-BAAB-452C-B65C-2D0000191E04', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'E043606C-12A8-4A68-A7D6-CA6B1CA35502', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', 'D972BEF4-F0D7-467E-921A-235725170297', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2025-11-14 16:39:26'),
('5DB06ACD-2284-49D2-A7F8-408F7A6C8515', '192.168.2.1', 'mobile', 'Opera', 'Page', '17C27CE9-E315-4BD6-AB55-B73D6F16C855', 'http://localhost/apps/igniter-cms/blog', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '422751BA-406D-4A49-AFE3-05FE5CF92CEC', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-11-15 16:39:26'),
('63F21171-BA08-4F28-90CF-094A704DA499', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '58691A95-FFDF-4B75-A662-5244405B219B', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '5A565BF2-F8F7-4335-9C52-75802407938F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-01 00:00:00'),
('645C8BA2-ADE2-4DE6-92BE-09B99CDAAFA5', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '243D5863-E6D1-4812-A9F5-230B9C0B6952', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', 'A9B5AF38-7583-4AA3-BCE3-D6514AA4F0F0', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-06-01 00:00:00'),
('908441E9-DD84-4406-9CF4-8969F7178FDC', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '51931B4C-A3F5-4CAE-9FD9-13BA9C0A95E4', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '403C71E5-AD5C-4CEC-84F7-93196D2ABBF5', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-05-01 00:00:00'),
('9EBC942C-1B7E-4132-8315-EE029BD948F1', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '793F816E-E1C3-428C-B91B-30E7CDFF7923', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '3DC068D1-90FC-46DC-8C53-986C06DA8471', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-09-01 00:00:00'),
('BC613F65-F145-4C80-8773-A60316131DAB', '172.16.0.1', 'mobile', 'Edge', 'Page', '40BCB3F9-A09C-40F7-B6B5-91BAF7A6A056', 'http://localhost/apps/igniter-cms/', 'POST', 204, '7B746E07-F591-4B85-9BBC-6A98B5951967', '451129B6-67F4-4B00-98B3-9CE32585253F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-11-17 16:39:26'),
('D4429334-AAC9-4DFD-8F40-6946E9EFD54C', '192.168.1.1', 'mobile', 'Safari', 'Page', 'CF8BBD04-8889-4B00-8970-1DCD9982211C', 'http://localhost/apps/igniter-cms/about', 'POST', 201, '7B746E07-F591-4B85-9BBC-6A98B5951967', 'session-691df2be6c958', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2025-11-19 16:39:26'),
('EF414A16-6757-49B1-8EFB-E30D2F0F626C', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '24C88B3C-CAA3-45F5-B6D1-6C2814CF953F', 'http://localhost/apps/igniter-cms/', 'GET', 200, '7B746E07-F591-4B85-9BBC-6A98B5951967', '0CC6C76C-5C44-47A9-AB16-ABB97B251938', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-10-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_form_submissions`
--

CREATE TABLE `subscription_form_submissions` (
  `subscription_form_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `list_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending Confirmation',
  `confirmation_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unsubscribed_at` datetime DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `theme_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `default_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `heading_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `accent_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surface_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrast_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `theme_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `selected` tinyint(1) DEFAULT '0',
  `override_default_style` tinyint(1) DEFAULT '0',
  `use_static_theme_nav` tinyint(1) DEFAULT '0',
  `plugins_required` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `name`, `path`, `default_color`, `heading_color`, `accent_color`, `surface_color`, `contrast_color`, `background_color`, `image`, `theme_url`, `category`, `sub_category`, `selected`, `override_default_style`, `use_static_theme_nav`, `plugins_required`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('CE1B2BC2-6B50-4F93-8010-F658B77CB854', 'Default', '/default', '#6c757d', '#212529', '#0d6efd', '#f8f9fa', '#0d6efd', '#ffffff', 'public/front-end/themes/default/assets/images/preview.png', 'https://previews.ignitercms.com/Default/', 'Business & Corporate', 'Agency & Marketing', 1, 0, 0, '', 0, '7B746E07-F591-4B85-9BBC-6A98B5951967', NULL, '2025-11-19 16:39:26', '2025-11-19 16:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `theme_revisions`
--

CREATE TABLE `theme_revisions` (
  `theme_revision_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `theme_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `revision_note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `upload_directory` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user_XziJ9',
  `password_change_required` tinyint(1) DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `status`, `role`, `profile_picture`, `twitter_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `about_summary`, `upload_directory`, `password_change_required`, `remember_token`, `expires_at`, `last_login`, `created_at`, `updated_at`) VALUES
('7B746E07-F591-4B85-9BBC-6A98B5951967', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$hNm8n00A0ro2gNXNkeKztOBs7RUtQBC0YxBx3zTEJCb4LgihLpUNK', 1, 'Admin', 'https://ignitercms.com/assets/img/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', 1, NULL, NULL, NULL, '2025-11-19 16:39:25', '2025-11-19 16:39:25');

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
-- Indexes for table `booking_form_submissions`
--
ALTER TABLE `booking_form_submissions`
  ADD PRIMARY KEY (`booking_form_id`),
  ADD KEY `site_id` (`site_id`),
  ADD KEY `email` (`email`),
  ADD KEY `appointment_date` (`appointment_date`),
  ADD KEY `status` (`status`);

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
-- Indexes for table `comment_form_submissions`
--
ALTER TABLE `comment_form_submissions`
  ADD PRIMARY KEY (`comment_form_id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`config_id`),
  ADD UNIQUE KEY `config_id` (`config_id`),
  ADD UNIQUE KEY `config_for` (`config_for`);

--
-- Indexes for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  ADD PRIMARY KEY (`contact_form_id`),
  ADD KEY `site_id` (`site_id`),
  ADD KEY `email` (`email`),
  ADD KEY `status` (`status`);

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
-- Indexes for table `subscription_form_submissions`
--
ALTER TABLE `subscription_form_submissions`
  ADD PRIMARY KEY (`subscription_form_id`),
  ADD KEY `site_id` (`site_id`),
  ADD KEY `email` (`email`),
  ADD KEY `status` (`status`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `plugin_configs`
--
ALTER TABLE `plugin_configs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

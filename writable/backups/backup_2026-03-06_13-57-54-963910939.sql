-- Database Backup
-- Generated: 2026-03-06 13:57:54
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
  `url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auditable_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `old_values` text COLLATE utf8mb4_general_ci,
  `new_values` text COLLATE utf8mb4_general_ci,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`),
  UNIQUE KEY `activity_id` (`activity_id`),
  KEY `activity_by` (`activity_by`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `activity_logs`
INSERT INTO `activity_logs` VALUES ('02123DEB-87E7-441D-8A4E-6FA1CA289453', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-04 17:32:28', '2026-03-04 17:32:28');
INSERT INTO `activity_logs` VALUES ('0E2AF7F3-3B2B-446F-B955-7DA77E179C78', '3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', 'user_logout', 'User Logout: User with id: 3D005E49-A4A3-4D69-8EB0-00E1AF7567CC logged out.', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-03-04 17:32:24', '2026-03-04 17:32:24');
INSERT INTO `activity_logs` VALUES ('345823BF-4885-41E8-BFF8-0761B7EF9844', '3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', 'user_login', 'User Login: User logged in via Google with id: 3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-04 14:38:10', '2026-03-04 14:38:10');
INSERT INTO `activity_logs` VALUES ('5F9DBEEE-F7DF-4B8F-9E4E-DA8DF5EA2C17', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-06 13:57:25', '2026-03-06 13:57:25');
INSERT INTO `activity_logs` VALUES ('69a5bae279fe4', '3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', 'user_registration', 'User Registration: User registered via Google with id: 3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', '127.0.0.1', 'GB', 'Edge on Windows 10', '', '', '', '', '', '2026-03-03 10:19:14', '2026-03-02 16:29:22');
INSERT INTO `activity_logs` VALUES ('69a5c4a2726cf', 'B75605A4-96DE-4F70-BB58-B074E1F3682B', 'user_registration', 'User Registration: User registered via Google with id: B75605A4-96DE-4F70-BB58-B074E1F3682B', '127.0.0.1', 'US', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-03 10:19:19', '2026-03-02 17:10:58');
INSERT INTO `activity_logs` VALUES ('69a5c4a9e7a1b', 'B75605A4-96DE-4F70-BB58-B074E1F3682B', 'user_logout', 'User Logout: User with id: B75605A4-96DE-4F70-BB58-B074E1F3682B logged out.', '127.0.0.1', 'GM', 'Chrome on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-03-03 10:19:24', '2026-03-02 17:11:06');
INSERT INTO `activity_logs` VALUES ('69a5c6ab89d7f', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'SN', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-03 10:19:29', '2026-03-02 17:19:39');
INSERT INTO `activity_logs` VALUES ('69a6b59107856', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-03 10:22:42', '2026-03-03 10:18:57');
INSERT INTO `activity_logs` VALUES ('99AC37B1-EBF4-4C6D-B773-D2130E03EC52', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_logout', 'User Logout: User with id: 3D181A83-27B5-4D80-B786-84789F2DC319 logged out.', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-03-04 14:38:06', '2026-03-04 14:38:06');
INSERT INTO `activity_logs` VALUES ('A89B7156-7B6B-4D34-B90D-5EBEE177340A', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_logout', 'User Logout: User with id: 3D181A83-27B5-4D80-B786-84789F2DC319 logged out.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-03-03 12:00:53', '2026-03-03 12:00:53');
INSERT INTO `activity_logs` VALUES ('EEA4B952-8910-442A-AB22-6AADDBBF1E67', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-03 12:00:57', '2026-03-03 12:00:57');
INSERT INTO `activity_logs` VALUES ('F49F27F0-2C17-4B55-AB79-A8AA5CE5B3F0', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-03 23:44:49', '2026-03-03 23:44:49');
INSERT INTO `activity_logs` VALUES ('FEA753B7-BA1B-4B03-9747-CD0F58FF6174', '3D181A83-27B5-4D80-B786-84789F2DC319', 'user_login', 'User Login: User logged in with id: 3D181A83-27B5-4D80-B786-84789F2DC319', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-04 14:37:42', '2026-03-04 14:37:42');


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
INSERT INTO `api_accesses` VALUES ('08EAF784-1F4B-42B3-A0CD-827FF6CD4737', '36b8bcc7d5a27324e8bc1c27375e629090060053937e8e91f9321a003bed3168', 'default', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');


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
INSERT INTO `app_modules` VALUES ('00E3AF55-60A3-406D-B75A-917009391765', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts', 'Admin,Manager,User', 'account/cms/blogs', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('121C8DC2-E83E-4AA2-A0B9-DE0CA17B8A7D', 'Booking Forms', 'Manage booking forms', 'booking,appointments,forms', 'Admin,Manager,User', 'account/forms/booking-forms', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('1A7C4344-67C9-4AB5-BC67-E9124E430E79', 'Plugins', 'Manage plugins', 'extension,plugins,package', 'Admin', 'account/plugins', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('1DF26822-12BE-419B-9E83-A04383544AB1', 'Backup', 'Manage backups', 'backup,restore,database', 'Admin', 'account/admin/backups', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('1FAA4C6D-153F-43C7-9443-EE67E5606032', 'Admin', 'Administration', 'admin,control,management', 'Admin', 'account/admin', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('21717C79-245B-4929-A6E2-CE38A5AD15AF', 'Themes', 'Manage theme files', 'themes,appearance,design,the files', 'Admin,Manager,User', 'account/appearance/theme-editor', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('4190385E-D015-4FB9-993C-15FA232AFD3F', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview', 'Admin,Manager,User', 'account/dashboard', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('4AE941BE-6F23-4C27-9B20-E719C7BF2482', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics', 'Admin', 'account/admin/visit-stats', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('50CA50EB-E832-49AC-BFA1-CCE993477B3D', 'API Keys', 'Manage api keys', 'api,keys,access', 'Admin', 'account/admin/api-keys', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('50D0121C-0503-452C-8875-3BA32F0B8084', 'Activity Logs', 'View activity logs', 'logs,activity,tracking', 'Admin', 'account/admin/activity-logs', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('565F260F-217E-43DE-BDDD-12A9D19BDC41', 'Subscription Forms', 'Manage subscription forms', 'subscription,newsletter,forms', 'Admin,Manager,User', 'account/forms/contact-forms', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('628A23C5-075B-447A-83D7-FAA1239C8696', 'Configurations', 'Manage configurations', 'configurations,settings,preferences', 'Admin', 'account/admin/configurations', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('674649DF-B865-42E1-8687-1DBB2E8B439F', 'Contact Forms', 'Manage contact forms', 'contact,forms', 'Admin,Manager,User', 'account/forms/contact-forms', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('6E128F9F-6B94-4B0D-8BE6-165F334DD830', 'Pages', 'Manage pages', 'pages,content,publish', 'Admin,Manager,User', 'account/cms/pages', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('6F15CB54-6623-4794-A5D3-19ECE2AA35AE', 'Forms', 'Manage forms', 'contact,forms', 'Admin,Manager,User', 'account/forms', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('85D90FCC-81BC-454B-B83F-65483B4AE2BA', 'Themes', 'Manage themes', 'themes,appearance,design', 'Admin,Manager,User', 'account/appearance/themes', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('8FC2EA96-2FFB-484A-966D-96D52D7FF8B3', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude, gemini, deepseek', 'Admin,Manager,User', 'account/ask-ai', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('9AFAC193-59B7-4847-A430-AA25FA6F0DA2', 'Categories', 'Manage categories', 'category,categories,post category', 'Admin,Manager,User', 'account/cms/categories', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('A9CC9578-900F-4DE8-86A2-36F26B231A5A', 'Comment Forms', 'Manage comment forms', 'comments,feedback,forms', 'Admin,Manager,User', 'account/forms/comment-forms', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('B1691DD1-54C6-4FAA-A720-4A3D35F8A176', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny ip,spam', 'Admin', 'account/admin/blocked-ips', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('B8C155FA-6781-483A-9AC1-4A3685332CEC', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('BB04D9A3-779D-4F66-BFBB-D8B1947B6FE8', 'Codes', 'Manage codes', 'codes,references,identifiers', 'Admin', 'account/admin/codes', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('BC97935B-5A1F-4BD1-8E64-529EB727594D', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links', 'Admin,Manager,User', 'account/cms/navigations', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('BF694C3E-E35D-4B02-B89E-8C1DA1C42BE0', 'Change Password', 'Change account password', 'password,security,change', 'Admin,Manager,User', 'account/settings/change-password', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('C15D3C53-C1A5-4FBB-93C0-649C0AD75EDF', 'Data Groups', 'Manage dat groups', 'data,content,data-groups', 'Admin,Manager,User', 'account/cms/data-groups', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('C1EA0DFF-DBBC-4809-AA37-4A64CAB182A1', 'Error Logs', 'View error logs', 'error logs,activity,tracking', 'Admin', 'account/admin/logs', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('C54CD299-0E5F-435C-BC40-13689D231386', 'Users', 'Manage application users', 'users,accounts,people', 'Admin', 'account/admin/users', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('C9228588-A644-4974-A880-3B6D50CBDB4A', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'unblock,whitelist,security,allow ip', 'Admin', 'account/admin/whitelisted-ips', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('D0DE2A08-E41A-4840-B0F1-FBBEBD36651B', 'Account Details', 'Update account details', 'account,profile,settings', 'Admin,Manager,User', 'account/settings/update-details', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('D51AE11D-7CE9-4C7C-AFAE-3C3F8CDA4F28', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets', 'Admin,Manager,User', 'account/content-blocks', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `app_modules` VALUES ('FEF5EBB3-1725-4A96-AB93-B838F2C41849', 'Plugin Configurations', 'Manage plugin configurations', 'extension,plugins,package,configurations', 'Admin', 'account/plugins/configurations', '2026-02-27 15:28:05', '2026-02-27 15:28:05');


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
  `is_breaking` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `scheduled_date_time` timestamp NULL DEFAULT NULL,
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `blogs` VALUES ('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'https://assets.aktools.net/image-stocks/posts/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', '0', '0', '1', NULL, '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '1', 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2026-02-27 14:28:05', '2026-02-27 15:28:05');
INSERT INTO `blogs` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainable Living: Small Changes with Big Impact', 'sustainable-living-small-changes', 'https://assets.aktools.net/image-stocks/posts/blog-4.jpg', 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.', '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'sustainability, eco-friendly, lifestyle', '0', '0', '1', NULL, '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '0', 'Sustainable Living Tips', 'Easy ways to reduce your environmental impact through daily choices.', 'sustainability, eco-friendly, green living', '2026-02-27 12:28:05', '2026-02-27 15:28:05');
INSERT INTO `blogs` VALUES ('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'https://assets.aktools.net/image-stocks/posts/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'office, stakes, competitive', '0', '0', '1', NULL, '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '1', 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2026-02-27 13:28:05', '2026-02-27 15:28:05');


-- Table structure for table `booking_form_submissions`

DROP TABLE IF EXISTS `booking_form_submissions`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_form_id`),
  KEY `site_id` (`site_id`),
  KEY `email` (`email`),
  KEY `appointment_date` (`appointment_date`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
INSERT INTO `categories` VALUES ('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', '0', '2', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('181dd10c-49d4-49bb-b3c0-f81ff69a35f6', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', '0', '4', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Lifestyle & Wellness', 'Tips for healthy living, mindfulness practices, and personal development', NULL, NULL, 'lifestyle-wellness', '0', '3', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'Technology & Innovation', 'Cutting-edge technology trends, AI developments, and digital innovations', NULL, NULL, 'technology-innovation', '0', '2', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Business & Career', 'Articles about business strategies, career development, and workplace trends', NULL, NULL, 'business-career', '0', '1', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainability', 'Eco-friendly living, environmental awareness, and sustainable practices', NULL, NULL, 'sustainability', '0', '4', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'Personal Finance', 'Money management, investing tips, and financial planning strategies', NULL, NULL, 'personal-finance', '0', '5', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `categories` VALUES ('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', '0', '6', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');


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
INSERT INTO `codes` VALUES ('5453BEC5-A5F3-4A3E-B419-D7404F931265', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `codes` VALUES ('98A3FEBD-1547-4572-8DD8-93A0DB9F4FB2', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `codes` VALUES ('C8177546-84D8-4122-905B-B778D0DCC21E', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');


-- Table structure for table `comment_form_submissions`

DROP TABLE IF EXISTS `comment_form_submissions`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
INSERT INTO `configurations` VALUES ('014B8A4D-7A41-436D-A9CD-BF8DEEE809B8', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('1398FDD6-64EB-4651-8C94-AD597C813C12', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('1F026E0F-A4B0-40AA-AA72-EE8A7F9AFDE8', 'SiteKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('28DB9D4B-CA9B-467A-BB4F-035A3CB65DBC', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('3662C2FF-CA41-4203-A6C2-8C028496FC87', 'SiteName', 'Name of the company, organization or business.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('45D53645-0944-4D48-A4C0-AF0496BEC060', 'EnableIgniterNewsFeed', 'Get latest news, features, and security update feeds from Igniter CMS.', 'Yes', 'ri-newspaper-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'igniter-cms,news feed,security updates', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('4F5EC210-8DDD-412B-9ACF-D6096F744C90', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('554BAC3A-62E3-4738-9AA0-8FF2FD8F4FEB', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('7530AB48-913F-4B01-B6A2-B9399FF4C675', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('7D8A58CA-D06E-4270-90E1-CDC982CF02A0', 'SiteDescription', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('8488EF61-2621-4EC7-8BF9-696CD517558E', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ContentBlocksModel, NavigationsModel, PagesModel, ThemesModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('8AC9C1B8-93EC-461C-B2D2-C2DA4341D1BC', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('94FB3B2D-F78F-4F8B-8873-40A74ED3AECD', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('96067BA5-BAE8-439A-B93A-60A5FA6B9D09', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('D4BC8A2A-D9D2-4E5D-A2C4-3878587184F9', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('D52FCAB9-BD18-4C74-AB54-033CFAB277E0', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('DBBE8351-9BEE-4454-A3FB-06D8CB1B3A12', 'SiteAddress', 'Address of the company, organization or business.', '221B Baker Street, London NW1 6XE, United Kingdom', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,address,locationb,business,organization', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('DBE33FDC-DCFA-4841-8773-1DA572F08B20', 'BackendLogoLink', 'Logo link for the backend interface.', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('EE2E67D7-DF78-4083-8289-53AF21544452', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `configurations` VALUES ('F4E33527-6086-498F-8596-10F6F18CEE81', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '10', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');


-- Table structure for table `contact_form_submissions`

DROP TABLE IF EXISTS `contact_form_submissions`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_form_id`),
  KEY `site_id` (`site_id`),
  KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `custom_field_1` text COLLATE utf8mb4_general_ci,
  `custom_field_2` text COLLATE utf8mb4_general_ci,
  `custom_field_3` text COLLATE utf8mb4_general_ci,
  `custom_field_4` text COLLATE utf8mb4_general_ci,
  `custom_field_5` text COLLATE utf8mb4_general_ci,
  `custom_field_6` text COLLATE utf8mb4_general_ci,
  `custom_field_7` text COLLATE utf8mb4_general_ci,
  `custom_field_8` text COLLATE utf8mb4_general_ci,
  `custom_field_9` text COLLATE utf8mb4_general_ci,
  `custom_field_10` text COLLATE utf8mb4_general_ci,
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
INSERT INTO `content_blocks` VALUES ('8690E6CA-1CA7-4103-897B-07BC97F65FBF', 'BusinessServices', '3', 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>', 'ri-database-2-line', 'theme', 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services', NULL, NULL, 'https://example.com/business-services', '1', '{\"color\": \"#007bff\", \"priority\": \"high\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `content_blocks` VALUES ('C73FE963-71E6-4F00-86D4-CFB54AD813A9', 'SavingInvestments', '3', 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', 'Learn how our investment strategies can maximize your returns while minimizing risks.', 'ri-reactjs-fill', 'theme', 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments', NULL, NULL, 'https://example.com/saving-investments', '0', '{\"color\": \"#28a745\", \"priority\": \"medium\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `content_blocks` VALUES ('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD', 'OnlineConsulting', '3', 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Access expert advice from anywhere with our virtual consulting services.</p>', 'ri-global-line', 'theme', 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting', NULL, NULL, 'https://example.com/online-consulting', '1', '{\"color\": \"#dc3545\", \"priority\": \"low\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:05', '2026-02-27 15:28:05');


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
INSERT INTO `data_groups` VALUES ('00B2EC5D-CED9-46B8-BFB0-53F7F5055FC3', 'SubscriptionFormStatus', 'Pending Confirmation,Active,Unsubscribed,Bounced', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('0E03A093-E162-4DA5-974F-687B4EDE24FA', 'Category', 'general,business,portfolio', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('67DB7116-A20F-4497-884B-8A124372F3C6', 'Page', 'home,general,about,services,contact', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('9A8DE367-2887-412F-879C-CB4D308A6C33', 'ContactFormStatus', 'New,In Progress,Resolved,Archived', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('9D14DEF3-C927-4897-A9BF-0AABB63BC06A', 'BookingFormStatus', 'Pending,Confirmed,Cancelled', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('9E1752A5-B1DE-4108-9970-EA948279FF93', 'ContentBlock', 'general', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('AF786E9E-D493-4123-9FE2-51A73633F7A4', 'BookingFormPaymentStatus', 'None,Unpain,Paid,Refunded', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `data_groups` VALUES ('CE2ED5B7-689C-4518-9D43-834FDADA29C4', 'Navigation', 'general,top_nav,services,footer_nav', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');


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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` VALUES ('1', '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('2', '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('3', '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('4', '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('5', '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('6', '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('7', '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('8', '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('9', '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('10', '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('11', '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', '1772206085', '1');
INSERT INTO `migrations` VALUES ('12', '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('13', '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('14', '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('15', '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('16', '2024-11-12-143627', '\\SiteStats', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('17', '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('18', '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('19', '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('20', '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('21', '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('22', '2025-06-01-113456', 'App\\Database\\Migrations\\DataGroups', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('23', '2025-06-20-151038', 'App\\Database\\Migrations\\Plugins', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('24', '2025-07-01-161418', 'App\\Database\\Migrations\\PluginConfigs', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('25', '2025-10-14-165005', 'App\\Database\\Migrations\\SubscriptionForms', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('26', '2025-10-14-165035', 'App\\Database\\Migrations\\ContactForms', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('27', '2025-10-14-165049', 'App\\Database\\Migrations\\BookingForms', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('28', '2025-10-31-142255', 'App\\Database\\Migrations\\CommentForms', 'default', 'App', '1772206086', '1');
INSERT INTO `migrations` VALUES ('29', '2025-11-13-164704', 'App\\Database\\Migrations\\ThemeRevisions', 'default', 'App', '1772206087', '1');


-- Table structure for table `navigations`

DROP TABLE IF EXISTS `navigations`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`navigation_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `navigations`
INSERT INTO `navigations` VALUES ('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', '', 'footer_nav', '44', NULL, 'rss', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', '', 'services', '28', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('131c5798-d0b7-484c-bf21-e1768458632f', 'Home', 'Home navigation', '', 'top_nav', '2', NULL, 'home', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', '', 'footer_nav', '36', NULL, '#services', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', '', 'services', '30', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', '', 'footer_nav', '38', NULL, 'cookie-policy', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', '', 'top_nav', '10', NULL, '#team', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', '', 'top_nav', '4', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', '', 'footer_nav', '42', NULL, 'sitemap', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', '', 'footer_nav', '34', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', '', 'top_nav', '20', NULL, '#contact', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', '', 'footer_nav', '32', NULL, 'home', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', '', 'services', '26', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', '', 'footer_nav', '40', NULL, 'privacy-policy', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', '', 'top_nav', '12', NULL, 'blogs', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', '', 'top_nav', '6', NULL, '#services', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', '', 'services', '24', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', '', 'top_nav', '8', NULL, '#portfolio', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `navigations` VALUES ('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', '', 'services', '22', NULL, '#!', '0', '1', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');


-- Table structure for table `pages`

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'portfolio',
  `status` int DEFAULT '0',
  `is_home_page` int DEFAULT '0',
  `total_views` int DEFAULT '0',
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `pages` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', 'general', '1', '0', '0', '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `pages` VALUES ('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'Home', 'home', 'home', '1', '1', '0', '', '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, NULL, NULL, NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');
INSERT INTO `pages` VALUES ('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', 'general', '1', '0', '0', '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', '3D181A83-27B5-4D80-B786-84789F2DC319', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2026-02-27 15:28:06', '2026-02-27 15:28:06');


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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
INSERT INTO `roles` VALUES ('1C171DD9-AFA8-492E-B897-D1C2CE5B1DF1', 'User', 'User Role', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `roles` VALUES ('7563F456-6B7B-45CF-93D5-B2370713D348', 'Manager', 'Manager Role', '2026-02-27 15:28:05', '2026-02-27 15:28:05');
INSERT INTO `roles` VALUES ('8496F320-FEF9-4473-B45F-34AAACF79455', 'Admin', 'Admin role', '2026-02-27 15:28:05', '2026-02-27 15:28:05');


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
INSERT INTO `site_stats` VALUES ('0A0FDFF9-AD68-42FC-AD91-5C32627A5CBA', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-up', 'http://localhost/apps/igniter-cms/sign-up', '', '200', '', 'f744f679629759425092ce1fe1f4901b', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 17:10:10');
INSERT INTO `site_stats` VALUES ('0C2551E8-1949-42F1-B801-076D4F0585B4', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '61491FF4-B4E5-4311-99C6-05EF2387924A', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '8BE78B24-20D1-48E1-983B-361674CC87C9', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-12-01 00:00:00');
INSERT INTO `site_stats` VALUES ('0DA757D7-CF9E-4DC8-90D6-EDA7094B10BC', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/access-denied', '200', '', '03db4121bb6b13ae09c893f393cc4aed', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-04 17:32:25');
INSERT INTO `site_stats` VALUES ('0F886D04-ED4A-49AE-A460-935D225C63B5', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', '', '200', '', '42f4b8033f8f524c6c0d79896f0f531b', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 17:10:41');
INSERT INTO `site_stats` VALUES ('2015A7A1-20AF-41B8-B5F6-5BFB1A290F57', '192.168.2.1', 'mobile', 'Opera', 'Page', '21D9251A-FF29-44E7-8094-23DEF5DFDA17', 'http://localhost/apps/igniter-cms/blog', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', 'D024E459-1D48-48E5-A95F-1A1223A7A5AB', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2026-02-23 15:28:06');
INSERT INTO `site_stats` VALUES ('2108B27C-9BF1-4464-BC4F-DC433FD767D2', '127.0.0.1', 'mobile', 'Google Chrome', 'page', 'sign-up', 'http://localhost/apps/igniter-cms/sign-up', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fask-ai', '200', '', 'b936e16698cfdc3418462810cccd4b8e', 'GET', 'Linux', 'Unknown', 'NA', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Mobile Safari/537.36', NULL, '2026-03-02 17:10:18');
INSERT INTO `site_stats` VALUES ('22762BD8-87DC-48F5-8607-D2CEC8BD343B', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fdashboard', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/cms/categories', '200', '', 'f16872a8dc17e35035276d9bf9d3e867', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 11:00:11');
INSERT INTO `site_stats` VALUES ('2694B6AE-241D-4CFE-9BF4-02C4181A6C82', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fsettings%2Flanguage', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/settings/language', '200', '', '6cf09f913dd4f8bf3279d00f3e52b111', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-03 23:44:45');
INSERT INTO `site_stats` VALUES ('280AEC3E-ADE1-4161-9426-5A685DEE7828', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fsettings%2Flanguage', '200', '', '7388e9c371787a521dfba086fe403a90', 'POST', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-06 13:57:25');
INSERT INTO `site_stats` VALUES ('295FFF23-F49A-4B8B-A677-A6257FA98DE8', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '85FB2DF3-4460-4442-B666-FE59E3DD8977', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '09530FAC-27D1-49C8-8696-5F29CD83645B', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-09-01 00:00:00');
INSERT INTO `site_stats` VALUES ('40CDACCA-A31B-42D7-83EE-6137555BE7D2', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'A6472C11-84C3-4A84-9D42-8ABDE5C723E9', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '55778629-82A5-448B-82F7-157F393862F3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-11-01 00:00:00');
INSERT INTO `site_stats` VALUES ('4186BD41-6ACF-4EE0-B712-9191A31E54BC', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fask-ai', 'http://localhost/apps/igniter-cms/sign-in', '', '200', '', '8daff8f0abdb421fcbef71f7162450a3', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-04 17:06:01');
INSERT INTO `site_stats` VALUES ('48E75113-D897-4587-BF68-10D089768487', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fdashboard', '200', '', 'cff5e1ae3253b2389f3515c764930d53', 'POST', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-04 14:37:42');
INSERT INTO `site_stats` VALUES ('5DE55684-7007-409D-B915-63051633C711', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-up', '200', '', '79d4cd8ea2526eeb557ea6edfa84a805', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 17:10:33');
INSERT INTO `site_stats` VALUES ('60C75EB6-1471-4681-BC5B-0F27FD72DD99', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '740D8212-B873-47A3-BA5B-32F68676B057', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '3A04F403-5B1E-4E8C-9654-04A3701A6A3A', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-08-01 00:00:00');
INSERT INTO `site_stats` VALUES ('6C0EC5DA-F2CA-4952-A8EB-19F1331A7DA0', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-up', 'http://localhost/apps/igniter-cms/sign-up', '', '200', '', '79d4cd8ea2526eeb557ea6edfa84a805', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 17:10:26');
INSERT INTO `site_stats` VALUES ('6E71A7D2-4734-4BC6-90AE-AB9CF43479B8', '10.0.0.1', 'tablet', 'Firefox', 'Page', 'B406CCEB-7C7E-42DD-8FF7-5CB5968C898F', 'http://localhost/apps/igniter-cms/contact', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '022A4FFD-4141-41F5-89D8-C0E2459F116F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-02-26 15:28:06');
INSERT INTO `site_stats` VALUES ('70548835-F74F-4449-8177-CEC7146FA2A6', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fadmin%2Factivity-logs', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/admin/activity-logs/view-activity/69a5c6ab89d7f', '200', '', '30d74a131527c9b7e1e805fcd66aff19', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-03 10:18:49');
INSERT INTO `site_stats` VALUES ('75083FC9-27E4-4771-81BC-A09E3B27230C', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-up', '200', '', 'b936e16698cfdc3418462810cccd4b8e', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 17:10:49');
INSERT INTO `site_stats` VALUES ('7C6D29D3-60A8-453B-B2A9-172E1032F04C', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fadmin%2Factivity-logs', '200', '', '30d74a131527c9b7e1e805fcd66aff19', 'POST', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-03 10:18:56');
INSERT INTO `site_stats` VALUES ('8087DCC2-AB07-4B04-B5E0-A5B6DAE8E7CE', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'D1563953-4870-4D3E-8C86-A3D982E347E3', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', 'AC933701-1FBB-474A-8918-E201B70B7FC1', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-11-01 00:00:00');
INSERT INTO `site_stats` VALUES ('820A4D39-AFCF-43FD-AE12-AECC0C13D8A3', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/admin/activity-logs/view-activity/69a5c6ab89d7f', '200', '', '5d1d4cccd79265d7508fbe6b6eb3be9a', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-03 12:00:54');
INSERT INTO `site_stats` VALUES ('8223A184-0D11-4E4A-AA1A-74C1046C079B', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'AECD63FD-308A-4F62-B296-611124E97DE7', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '0D0D3866-615D-414D-8FC6-60D6BD95CAAF', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-10-01 00:00:00');
INSERT INTO `site_stats` VALUES ('83D64031-F6A9-402A-A3F1-31EE95865336', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '54DA5067-E05D-48A6-A9A3-C168186E7540', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '590A77ED-4B73-42F6-9C5D-27A426E9AA0C', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2026-02-22 15:28:06');
INSERT INTO `site_stats` VALUES ('8E0A4B8E-31B4-4184-85E5-D05F35C706AA', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fsettings%2Flanguage', '200', '', '6cf09f913dd4f8bf3279d00f3e52b111', 'POST', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-03 23:44:49');
INSERT INTO `site_stats` VALUES ('8F8A086E-315B-45BD-A0FB-DDBFA1EDF4A3', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fask-ai', 'http://localhost/apps/igniter-cms/sign-in', '', '200', '', '7ce37f62f7e7e15196dd743e4b3839c1', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 17:06:37');
INSERT INTO `site_stats` VALUES ('8FD54853-C8CE-4337-A0FB-02A0672BE27E', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/dashboard', '200', '', 'ff6ea7ea6f1274d7fb944f581dbd3080', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 17:11:06');
INSERT INTO `site_stats` VALUES ('9A36B28A-0023-4857-8802-55E4F78FA467', '172.16.0.1', 'mobile', 'Edge', 'Page', '22DCCA2C-756E-410D-BF44-8E44231A2D68', 'http://localhost/apps/igniter-cms/', 'POST', '204', '3D181A83-27B5-4D80-B786-84789F2DC319', '38065646-A005-405A-ACB0-47A7D0F6FC2E', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2026-02-25 15:28:06');
INSERT INTO `site_stats` VALUES ('AF132E9D-5635-4699-89B1-FAEF76C127DB', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fdashboard', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/', '200', '', 'cff5e1ae3253b2389f3515c764930d53', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-04 14:37:40');
INSERT INTO `site_stats` VALUES ('AF65C2EC-4550-4185-92E8-C6C02E27ABA3', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-up', 'http://localhost/apps/igniter-cms/sign-up', '', '200', '3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', 'bb7909f760773214916e6c15d463e434', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-02 17:08:45');
INSERT INTO `site_stats` VALUES ('B12DAF61-BE83-4FAD-94D4-A0153DDC2B41', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in', '200', '', 'e960be115b6e965c56411ec2cbb04dbb', 'POST', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 17:19:39');
INSERT INTO `site_stats` VALUES ('B32C12E2-C905-4274-AE51-C1881F426DEB', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '949C0391-337E-4E4C-91A8-4310B5E11642', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '9628EB89-4B57-4536-90C4-5F5E7AC3B1B3', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-02-24 15:28:06');
INSERT INTO `site_stats` VALUES ('B5C86EB7-241B-48B3-8B5B-9DED9768609E', '192.168.1.1', 'mobile', 'Safari', 'Page', '32EB1307-5C60-451A-8CAF-25754A2BDFF2', 'http://localhost/apps/igniter-cms/about', 'POST', '201', '3D181A83-27B5-4D80-B786-84789F2DC319', 'session-69a1b8063ed09', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2026-02-27 15:28:06');
INSERT INTO `site_stats` VALUES ('BD17B6A0-F0F3-44E2-AAFB-84482E445502', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fsettings%2Flanguage', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/settings/language', '200', '', 'd37b6349e003aceb826efa292ede4c0e', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-05 08:43:52');
INSERT INTO `site_stats` VALUES ('C3328709-C3E1-423E-BFDA-5C7CD3C7CB46', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fask-ai', 'http://localhost/apps/igniter-cms/sign-in', '', '200', '', 'b6381ac9382c97ded193a9e8bf375e35', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 16:50:04');
INSERT INTO `site_stats` VALUES ('DD3F7DC4-A6F3-4943-8CB8-9FA89D3FAAA3', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'BEA1A3A3-28AC-412B-98EA-42E466E85754', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '9368CF2C-9098-4894-835F-CBDE5ACC23C5', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2026-02-21 15:28:06');
INSERT INTO `site_stats` VALUES ('ED8C017E-BCDB-485B-B457-23EDEC3A14CC', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/admin/users', '200', '', '589a007aa422577672b7486d6babe9d7', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', NULL, '2026-03-04 14:38:06');
INSERT INTO `site_stats` VALUES ('F7E21E9F-B2C2-41B5-8199-C5626B31552D', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'A62AE099-661A-46C5-897A-8A9D5084CF56', 'http://localhost/apps/igniter-cms/', 'GET', '200', '3D181A83-27B5-4D80-B786-84789F2DC319', '62490BDA-073E-43E9-9F8E-8CD680B9A18A', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-01-01 00:00:00');
INSERT INTO `site_stats` VALUES ('F861D578-EB18-4385-A697-EE01696D70AD', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-up', 'http://localhost/apps/igniter-cms/sign-up', 'http://localhost/apps/igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%2Fapps%2Figniter-cms%2Faccount%2Fask-ai', '200', '', '7ce37f62f7e7e15196dd743e4b3839c1', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', NULL, '2026-03-02 17:08:33');


-- Table structure for table `subscription_form_submissions`

DROP TABLE IF EXISTS `subscription_form_submissions`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subscription_form_id`),
  KEY `site_id` (`site_id`),
  KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `theme_revisions`

DROP TABLE IF EXISTS `theme_revisions`;
CREATE TABLE `theme_revisions` (
  `theme_revision_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `theme_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `revision_note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `themes`

DROP TABLE IF EXISTS `themes`;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `themes`
INSERT INTO `themes` VALUES ('56A32822-CA27-41E2-8617-EE3011D1726F', 'Default', '/default', '#6c757d', '#212529', '#0d6efd', '#f8f9fa', '#0d6efd', '#ffffff', 'public/front-end/themes/default/assets/images/preview.png', 'https://previews.ignitercms.com/Default/', 'Business & Corporate', 'Agency & Marketing', '1', '0', '0', '', '0', '3D181A83-27B5-4D80-B786-84789F2DC319', NULL, '2026-02-27 15:28:06', '2026-02-27 15:28:06');


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
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `twitter_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about_summary` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `upload_directory` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user_T9uDj',
  `is_social_login` tinyint(1) DEFAULT '0',
  `password_change_required` tinyint(1) DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
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
INSERT INTO `users` VALUES ('3D005E49-A4A3-4D69-8EB0-00E1AF7567CC', 'Laiman', 'Kasman', 'laikasmantr2', 'laikasmantr2@gmail.com', '$2y$10$bExQT8RRlHWfsJ0eKGhTV.VICeftAMwUyRmJYoTy0zpAlmcl0Lhvu', '1', 'User', 'https://lh3.googleusercontent.com/a/ACg8ocKAEeZu5jlXJY8JpJWrMrJU4sSUwQlfuwgo1fASivbP-QQeEA=s96-c', NULL, NULL, NULL, NULL, NULL, 'laikasmantr2_xpIy4', '1', '0', NULL, NULL, '2026-03-04 14:38:10', '2026-03-02 16:29:22', '2026-03-04 14:38:10');
INSERT INTO `users` VALUES ('3D181A83-27B5-4D80-B786-84789F2DC319', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$f0ElL2xylxAKJG.TiB9l/uu/XmbC29qeh4Y238dux08gYw7nSmw5.', '1', 'Admin', 'public/uploads/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', '0', '1', NULL, NULL, '2026-03-06 13:57:25', '2026-02-27 15:28:05', '2026-03-06 13:57:25');
INSERT INTO `users` VALUES ('B75605A4-96DE-4F70-BB58-B074E1F3682B', 'Developer', 'Kassama', 'developerkassama', 'developerkassama@gmail.com', '$2y$10$TxCc1NounvW5bQPepkKP7OKbXC8gnKivEfENmr4fHR10qIzeQ5pC.', '1', 'User', 'https://lh3.googleusercontent.com/a/ACg8ocJxbNl269pyEGHssCaPWWmmzF4yWdWDb1CS5yTbsFcJSyrqY20=s96-c', NULL, NULL, NULL, NULL, NULL, 'developerkassama_PLBLb', '1', '0', NULL, NULL, '2026-03-02 17:10:58', '2026-03-02 17:10:58', '2026-03-02 17:10:58');


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


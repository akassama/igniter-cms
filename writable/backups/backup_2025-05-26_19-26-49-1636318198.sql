-- Database Backup
-- Generated: 2025-05-26 19:26:49
-- Server: localhost
-- Database: igniter_db



-- Table structure for table `activity_logs`

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `activity_id` varchar(255) NOT NULL,
  `activity_by` varchar(255) DEFAULT NULL,
  `activity_type` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`activity_id`),
  UNIQUE KEY `activity_id` (`activity_id`),
  KEY `activity_by` (`activity_by`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `activity_logs`
INSERT INTO `activity_logs` VALUES ('683098dc1cd9d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'user_login', 'User Login: User logged in with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-23 16:48:44', '2025-05-23 16:48:44');
INSERT INTO `activity_logs` VALUES ('6830c8cfd35dd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'user_login', 'User Login: User logged in with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-23 20:13:21', '2025-05-23 20:13:21');
INSERT INTO `activity_logs` VALUES ('683369188a6fa', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'user_login', 'User Login: User logged in with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-25 20:01:46', '2025-05-25 20:01:46');
INSERT INTO `activity_logs` VALUES ('68344a2818711', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'user_login', 'User Login: User logged in with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 12:02:03', '2025-05-26 12:02:03');
INSERT INTO `activity_logs` VALUES ('683499948c7dc', 'admin@example.com', 'failed_user_login', 'Failed User Login: User failed to log in with email: admin@example.com', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:40:53', '2025-05-26 17:40:53');
INSERT INTO `activity_logs` VALUES ('683499a9563d7', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'user_login', 'User Login: User logged in with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:41:14', '2025-05-26 17:41:14');
INSERT INTO `activity_logs` VALUES ('68349a12ccf0e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'config_updated', 'Config Update: Config updated with id: d9a7be1b-e91a-4440-8f90-a954e1f7046d', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:43:00', '2025-05-26 17:43:00');
INSERT INTO `activity_logs` VALUES ('68349a1aa15c7', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'config_updated', 'Config Update: Config updated with id: 56803a33-9553-4f2a-b05a-f219a80aaf51', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:43:09', '2025-05-26 17:43:09');
INSERT INTO `activity_logs` VALUES ('68349a413fcc9', NULL, 'search', 'Search: Search made for: Website Redesign', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:43:46', '2025-05-26 17:43:46');
INSERT INTO `activity_logs` VALUES ('68349a4e79433', NULL, 'search', 'Search: Search made for: Website', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:43:59', '2025-05-26 17:43:59');
INSERT INTO `activity_logs` VALUES ('68349a6cab4d1', NULL, 'sitemap', 'Sitemap: Sitemap accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 17:44:29', '2025-05-26 17:44:29');
INSERT INTO `activity_logs` VALUES ('68349e9ea4416', NULL, 'sitemap', 'Sitemap: Sitemap accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:02:23', '2025-05-26 18:02:23');
INSERT INTO `activity_logs` VALUES ('68349ecc8ffa7', NULL, 'robots', 'Robots: Robots txt accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:03:09', '2025-05-26 18:03:09');
INSERT INTO `activity_logs` VALUES ('68349edfd5223', NULL, 'rss', 'Rss: RSS feed accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:03:29', '2025-05-26 18:03:29');
INSERT INTO `activity_logs` VALUES ('68349f267c06b', NULL, 'rss', 'Rss: RSS feed accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:04:39', '2025-05-26 18:04:39');
INSERT INTO `activity_logs` VALUES ('68349f5d8dc6c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'config_updated', 'Config Update: Config updated with id: d9a7be1b-e91a-4440-8f90-a954e1f7046d', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:05:34', '2025-05-26 18:05:34');
INSERT INTO `activity_logs` VALUES ('68349f682c331', NULL, 'rss', 'Rss: RSS feed accessed', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:05:45', '2025-05-26 18:05:45');
INSERT INTO `activity_logs` VALUES ('68349f7a5b83a', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'config_updated', 'Config Update: Config updated with id: 56803a33-9553-4f2a-b05a-f219a80aaf51', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 18:06:03', '2025-05-26 18:06:03');
INSERT INTO `activity_logs` VALUES ('6834bffe201f4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'blocked_ip_created', 'Blocked IP Created: Blocked IP added with id: d9995cdb-11e3-47b5-92e7-ca891a0ef13d', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 20:24:47', '2025-05-26 20:24:47');
INSERT INTO `activity_logs` VALUES ('6834c015f2403', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'delete_log', 'Delete Action: User with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9 deleted record for table name: blocked_ips with id: d9995cdb-11e3-47b5-92e7-ca891a0ef13d', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 20:25:11', '2025-05-26 20:25:11');
INSERT INTO `activity_logs` VALUES ('6834c02bd4979', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'blocked_ip_created', 'Blocked IP Created: Blocked IP added with id: 86b14ed8-a3e8-4233-9301-e40a0deb2054', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 20:25:33', '2025-05-26 20:25:33');
INSERT INTO `activity_logs` VALUES ('6834c055c8d80', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'whitelisted_ip_created', 'Whitelisted IP Created: Whitelisted IP added with id: 2cbf2b9b-fef7-42f4-9c17-74b35e9b3c3d', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 20:26:15', '2025-05-26 20:26:15');
INSERT INTO `activity_logs` VALUES ('6834c06382b3e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'delete_log', 'Delete Action: User with id: b59363c6-08fa-46c4-9d99-d37b3eb18be9 deleted record for table name: blocked_ips with id: 86b14ed8-a3e8-4233-9301-e40a0deb2054', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '2025-05-26 20:26:28', '2025-05-26 20:26:28');


-- Table structure for table `announcement_popups`

DROP TABLE IF EXISTS `announcement_popups`;
CREATE TABLE `announcement_popups` (
  `popup_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
  `title` text NOT NULL,
  `text` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_color` varchar(255) DEFAULT NULL,
  `cancel_button_text` varchar(255) DEFAULT NULL,
  `cancel_button_color` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `delay` int(11) DEFAULT 1000,
  `image` varchar(255) DEFAULT NULL,
  `preview_image` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `backdrop_opacity` float DEFAULT 0.7,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `animation` varchar(50) DEFAULT NULL,
  `show_close_button` tinyint(1) DEFAULT 1,
  `enable_subscription` tinyint(1) DEFAULT 0,
  `subscription_placeholder` varchar(255) DEFAULT NULL,
  `subscription_success_message` text DEFAULT NULL,
  `enable_countdown` tinyint(1) DEFAULT 0,
  `countdown_end_date` datetime DEFAULT NULL,
  `countdown_format` varchar(50) DEFAULT NULL,
  `countdown_expired_text` text DEFAULT NULL,
  `order` int(11) DEFAULT 10,
  `status` int(11) DEFAULT 0,
  `frequency` float DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `show_on_pages` text DEFAULT NULL,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`popup_id`),
  KEY `name` (`name`),
  KEY `title` (`title`(768)),
  KEY `text` (`text`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `announcement_popups`
INSERT INTO `announcement_popups` VALUES ('41a06b54-1086-44f0-92cf-6ee83206e381', 'TypeSevenAdvert', '7', 'Flash Sale!', 'Huge discounts on premium packages', 'Shop Now', '#0484B2', 'Later', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=limited-time-offer', '1', '6000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', '', '', '1', '2025-05-26 15:44:57', 'DD:HH:MM:SS', '', '7', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('41f20a75-cd3e-4394-8acc-c85aa5d72b75', 'TypeFourAdvert', '4', 'Amazing Offer!', 'Don\'t miss out on our exclusive offer. Shop now and save big on your favorite items!', 'Leanr more', '#0484B2', 'Close', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=big-sale', '1', '3000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', '', '', '0', NULL, 'DD:HH:MM:SS', '', '4', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('59b67940-a3be-405e-b26a-938eae4a7539', 'TypeTwoAdvert', '2', 'Special Offer!', 'Get 30% off on all premium subscriptions', 'Get Offer Now', '#0484B2', 'Close', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=big-sale', '1', '3000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', '', '', '0', NULL, 'DD:HH:MM:SS', '', '2', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('61393a56-6d8f-46b5-8dc8-5700bafef699', 'TypeFiveAdvert', '5', 'Join Our Community', 'Subscribe to get exclusive updates and offers!', 'Subscribe', '#0484B2', 'No, thanks', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=subscribe-now', '1', '4000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5-preview.png', '#ffffff', '#000000', '0.7', '1000', '800', 'center', 'animate__fadeIn', '1', '1', 'Enter your email address', 'Thank you for subscribing!', '0', NULL, 'DD:HH:MM:SS', '', '5', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('85296de6-f904-430a-a523-d18c146305f9', 'TypeThreeAdvert', '3', 'Subscribe to Our Newsletter', 'Stay updated with our latest offers!', 'Subscribe Now', '#0484B2', 'Close', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=we-are-open', '1', '2000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', 'Enter your email', 'Thank you for subscribing!', '0', NULL, 'DD:HH:MM:SS', '', '3', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('cbda998e-581a-405e-828a-3ec32c78a894', 'TypeSixAdvert', '6', 'Limited Time Offer!', 'Don\'t miss out on this exclusive deal.', 'Claim Now', '#0484B2', 'Later', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=new-collection', '1', '5000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', '', '', '1', '2025-05-26 15:44:57', 'DD:HH:MM:SS', '', '6', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('f37a8674-4354-487a-ba29-81aee4df0c54', 'TypeEightAdvert', '8', 'Subscribe to Our Newsletter', 'Stay updated with our latest offers!', 'Subscribe Now', '#0484B2', 'Later', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=new-collection', '1', '5000', NULL, 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-8-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '1', 'Enter your email', 'Thank you for subscribing!', '0', NULL, 'DD:HH:MM:SS', '', '8', '0', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `announcement_popups` VALUES ('f9c07e22-7e3c-4a5d-bded-8f81bc04fb95', 'TypeOneAdvert', '1', 'Special Offer!', 'Discover our amazing products with exclusive discounts!', 'Shop Now', '#0484B2', 'Maybe Later', '#d33', 'http://localhost:8080/apps/ci-igniter-cms/shop?popup-id=we-are-open', '1', '2000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1-preview.png', '#ffffff', '#000000', '0.7', '900', '600', 'center', 'animate__fadeIn', '1', '0', '', '', '0', NULL, 'DD:HH:MM:SS', '', '1', '1', '1', '2025-05-23 15:44:57', '2025-05-30 15:44:57', 'home,pages,shop', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `api_accesses`

DROP TABLE IF EXISTS `api_accesses`;
CREATE TABLE `api_accesses` (
  `api_id` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `api_accesses`
INSERT INTO `api_accesses` VALUES ('d8fc6fbd-13fc-4c41-821e-ff616b58df82', 'e1672a25177d69f51e4912a8af186a788c60df91e968d9b4abb2e3cf7f7ccc45', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `api_calls_tracker`

DROP TABLE IF EXISTS `api_calls_tracker`;
CREATE TABLE `api_calls_tracker` (
  `api_call_id` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`api_call_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `app_modules`

DROP TABLE IF EXISTS `app_modules`;
CREATE TABLE `app_modules` (
  `app_module_id` varchar(255) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_description` varchar(255) DEFAULT NULL,
  `module_search_terms` varchar(255) DEFAULT NULL,
  `module_roles` varchar(100) DEFAULT NULL,
  `module_link` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`app_module_id`),
  UNIQUE KEY `app_module_id` (`app_module_id`),
  KEY `module_name` (`module_name`),
  KEY `module_description` (`module_description`),
  KEY `module_search_terms` (`module_search_terms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `app_modules`
INSERT INTO `app_modules` VALUES ('05622584-4d3a-4435-8f94-0d5654bb4d2d', 'Testimonials', 'Manage testimonials', 'reviews,testimonials,ratings', 'Admin,Manager,User', 'account/cms/testimonials', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('07734645-f4ad-42bd-87e9-497c694e9b9a', 'Subcribers', 'Manage email subcribers', 'subcribe,notification', 'Admin', 'account/admin/subscribers', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('0e307a19-dc14-4f54-a987-10c13588aff8', 'Categories', 'Manage categories', 'category,categories,post category', 'Admin,Manager,User', 'account/cms/categories', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('160ad284-2512-4594-bbf8-36f4a6fc240f', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets', 'Admin,Manager,User', 'account/cms/content-blocks', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('196c9b9b-8b66-4b0f-8019-178b047585f3', 'Users', 'Manage application users', 'users,accounts,people', 'Admin', 'account/admin/users', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('1a72608e-2dd8-40f4-a28f-a5105ff3564e', 'Product Categories', 'Manage product categories', 'products,product categories,sku,inventory,orders,customers', 'Admin,Manager,User', 'account/ecommerce/product-categories', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('1ae6eb8b-7f41-4dc8-9a63-b365fee6bf5f', 'Events', 'Manage events', 'events,calendar,schedule', 'Admin,Manager,User', 'account/cms/events', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('2f4ecbae-56be-4070-b685-aacf0948dff1', 'FAQs', 'Manage FAQs', 'faqs,questions,help', 'Admin,Manager,User', 'account/cms/faqs', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('39f0fe81-ae32-47a1-be41-12f0182c96cd', 'E-Commerce', 'Manage E-Commerce module (product, and categories)', 'ecommerce,shop,sell,online shopping,online store,marketplace', 'Admin,Manager,User', 'account/ecommerce', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('55c5b758-860c-4712-a17f-50cef86db9cb', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage', 'Admin,Manager,User', 'account/file-manager', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('574beef2-2495-427a-b203-0cecf6b3c566', 'Change Password', 'Change account password', 'password,security,change', 'Admin,Manager,User', 'account/settings/change-password', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('57b7946f-85ed-4201-9e49-93b43205ff04', 'Galleries', 'Manage galleries', 'galleries,images,photos', 'Admin,Manager,User', 'account/cms/galleries', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('5a6e33d3-26f0-4395-b739-f401efda5fbc', 'Admin', 'Administration', 'admin,control,management', 'Admin', 'account/admin', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('64742967-8ea6-497f-8e32-183b00b09dcb', 'Contacts', 'Manage contacts', 'contacts,address,people', 'Admin,Manager,User', 'account/contacts', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('69db5736-af67-406a-a2cf-ae1dbf091fc1', 'Codes', 'Manage codes', 'codes,references,identifiers', 'Admin', 'account/admin/codes', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('7597792b-a2cb-4d90-b834-8e3e66c9d453', 'Pages', 'Manage pages', 'pages,content,publish', 'Admin,Manager,User', 'account/cms/pages', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('78da80d5-40f6-443b-a569-0399fa6a620b', 'Content Management System (CMS)', 'Manage content', 'cms,content management', 'Admin,Manager,User', 'account/cms/blogs', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('7da8fe0f-5a25-4b22-922b-0dea81b332ad', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview', 'Admin,Manager,User', 'account/dashboard', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('820c019a-d0fb-4659-bc3f-6c9ceac2e2a2', 'Counters', 'Manage counters', 'counters,statistics,metrics', 'Admin,Manager,User', 'account/cms/counters', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('850cd914-0fe0-42ba-818d-ccd18a7648df', 'Account Details', 'Update account details', 'account,profile,settings', 'Admin,Manager,User', 'account/settings/update-details', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('884eeb5b-df22-4c45-bdd2-8f6626497cdd', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts', 'Admin,Manager,User', 'account/cms/blogs', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('92ed61d0-ff52-4e1e-81a8-9f48ccad5c80', 'Portfolios', 'Manage projects', 'portfolios,projects,work', 'Admin,Manager,User', 'account/cms/portfolios', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('934c5bfc-9b8e-49f8-9283-99450217b9a4', 'Configurations', 'Manage configurations', 'configurations,settings,preferences', 'Admin', 'account/admin/configurations', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('957e27ee-1f81-4410-9d7a-6db0764776d6', 'File Editor', 'Edit and update theme files', 'themes,customize,ui', 'Admin', 'account/admin/file-editor', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('958b725e-5042-4f23-97fe-d79b62d9cdaa', 'Activity Logs', 'View activity logs', 'logs,activity,tracking', 'Admin', 'account/admin/activity-logs', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('97f64822-92c0-42b1-9bb1-59fac7778520', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'unblock,whitelist,security,allow ip', 'Admin', 'account/admin/whitelisted-ips', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('9ee81111-a8f0-4914-8b78-cff1bd90a231', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny ip,spam', 'Admin', 'account/admin/blocked-ips', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('a6c559da-2340-4bdb-99f9-fbb7b7aa408e', 'Socials', 'Manage socials', 'socials,media,networks', 'Admin,Manager,User', 'account/cms/socials', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('ad37149a-2689-4734-9fed-5100c4f4d457', 'Teams', 'Manage teams', 'team,management,employees', 'Admin,Manager,User', 'account/cms/teams', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('cbcbf205-3137-4cc4-bae2-5ef9a7b80f2c', 'Translations', 'Manage translations', 'translations,language,localization', 'Admin', 'account/admin/translations', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('cdc98f44-1760-44d7-bd89-ff80d0f1b362', 'Pricings', 'Manage pricings', 'pricing,cost,payment', 'Admin,Manager,User', 'account/cms/pricings', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('d83ee0d3-7de6-4faf-ac00-0af743cd1afc', 'API Keys', 'Manage api keys', 'api,keys,access', 'Admin', 'account/admin/api-keys', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('dc737af9-a51e-47a7-b840-e2b6aac6a3e9', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude, gemini, deepseek', 'Admin,Manager,User', 'account/cms/policies', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('e2037198-633b-4172-8128-bc05a1ee2a77', 'Themes', 'Manage themes', 'themes,appearance,design', 'Admin', 'account/admin/themes', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('e20c6985-b7d7-40da-a02a-3ac04c01111d', 'Donation & Causes', 'Manage donation, causes and charity campaings', 'donate,donation,charity,ngo,fund raisong', 'Admin,Manager,User', 'account/admin/donation-causes', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('ec712675-1275-41af-9a97-8f07b82c0326', 'Popup Announcements', ' Announcement & Popups', 'announcement,popups,pop-up,modals,adverts', 'Admin,Manager,User', 'account/cms/popups', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('edb1aec7-af4c-4cd9-9e11-5cdb99e04b2c', 'Error Logs', 'View error logs', 'error logs,activity,tracking', 'Admin', 'account/admin/logs', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('f609278c-9560-4e77-8661-8ab5d5b30a0a', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics', 'Admin', 'account/admin/visit-stats', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('f796ffc6-6819-4786-9396-439275f8f8d5', 'Backup', 'Manage backups', 'backup,restore,database', 'Admin', 'account/admin/backups', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `app_modules` VALUES ('fdc47f51-c244-4c37-833b-26b0afa30917', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links', 'Admin,Manager,User', 'account/cms/navigations', '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `backups`

DROP TABLE IF EXISTS `backups`;
CREATE TABLE `backups` (
  `backup_id` varchar(255) NOT NULL,
  `backup_file_path` varchar(255) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `blocked_ips`

DROP TABLE IF EXISTS `blocked_ips`;
CREATE TABLE `blocked_ips` (
  `blocked_ip_id` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `block_start_time` timestamp NULL DEFAULT NULL,
  `block_end_time` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `page_visited_url` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`blocked_ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `blogs`

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `excerpt` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `total_views` int(11) DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`blog_id`),
  KEY `title` (`title`),
  KEY `slug` (`slug`),
  KEY `category` (`category`),
  KEY `tags` (`tags`(768)),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `blogs`
INSERT INTO `blogs` VALUES ('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', '0', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '0', 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `blogs` VALUES ('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', 'f0b860dc-624c-439a-9de8-f3164c981b08', 'office, stakes, competitive', '0', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '0', 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `blogs` VALUES ('f3a5bcef-6ebc-42ec-848e-9dc5d82f7200', 'The Art of Mindful Gardening', 'the-art-of-mindful-gardening', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-2.jpg', 'Discover the therapeutic benefits of mindful gardening and how it can transform your outdoor space into a sanctuary of peace and tranquility.', '<h2>The Art of Mindful Gardening</h2> <p>In our fast-paced world, finding moments of peace can be challenging. Mindful gardening offers a serene escape, allowing you to connect with nature and cultivate a sense of calm. Here is how to transform your garden into a sanctuary:</p> <h3>1. Engage Your Senses</h3> <p>Take a moment to feel the soil, listen to the rustling leaves, and breathe in the floral scents. Engaging your senses helps ground you in the present moment.</p> <h3>2. Embrace the Process</h3> <p>Gardening is a journey, not a destination. Embrace the process of planting, watering, and nurturing your plants, and let go of the need for immediate results.</p> <h3>3. Create a Routine</h3> <p>Set aside time each day to tend to your garden. This routine can become a meditative practice, providing structure and tranquility to your day.</p> <h3>4. Reflect and Appreciate</h3> <p>Take time to reflect on the growth in your garden and in yourself. Appreciate the beauty of nature and the peace it brings to your life.</p> <p>Mindful gardening is more than a hobby; its a path to inner peace. Start small, be present, and watch your garden—and your mind—bloom.</p>', '4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'gardening, mindfulness, mental health, wellness', '0', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '0', 'The Art of Mindful Gardening', 'This is a sample blog post for demonstration purposes.', 'gardening, mindfulness, mental health, wellness', '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `categories`

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`),
  KEY `title` (`title`),
  KEY `group` (`group`),
  KEY `parent` (`parent`),
  KEY `status` (`status`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` VALUES ('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', '0', '2', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `categories` VALUES ('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', '0', '4', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `categories` VALUES ('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', '0', '6', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `codes`

DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `code_id` varchar(100) NOT NULL,
  `code_for` varchar(100) NOT NULL,
  `code` text NOT NULL,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`code_id`),
  UNIQUE KEY `code_for` (`code_for`),
  KEY `code` (`code`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `codes`
INSERT INTO `codes` VALUES ('26f79a3e-7698-4b2f-a7fc-3b7cd9da3456', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `codes` VALUES ('b1f74050-5bc6-4cc1-97bb-890771d8a520', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `codes` VALUES ('bc23ae13-9ba6-4077-8fa4-ae613cc151dd', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `configurations`

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `config_id` varchar(255) NOT NULL,
  `config_for` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `config_value` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `data_type` varchar(255) NOT NULL DEFAULT 'Text',
  `options` varchar(255) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `custom_class` varchar(100) DEFAULT NULL,
  `search_terms` varchar(255) DEFAULT NULL,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `config_id` (`config_id`),
  UNIQUE KEY `config_for` (`config_for`),
  KEY `config_value` (`config_value`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `configurations`
INSERT INTO `configurations` VALUES ('01522777-00c1-4537-abbe-f47b10dd7ef4', 'SendGridSenderEmail', 'Sender email address for SendGrid email service.', 'sender-email', 'ri-mail-send-line', 'email', 'Text', NULL, NULL, '', 'sendgrid,sender,email,configuration', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('140fcafd-691b-4553-a1cc-637d1a63097b', 'ContactUsPageMetaKeywords', 'Meta keywords for the contact us page.', 'contact us, get in touch, customer support, inquiries, assistance, help', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'contact,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('186b58c3-2b9d-4234-a753-9ccb30d20095', 'MailjetApiKey', 'API key for Mailjet email service.', 'your-mailjet-api-key', 'ri-key-line', 'email', 'Text', NULL, NULL, '', 'mailjet,api,key,credentials', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('19dbd39d-1161-4b9d-9857-b4fc7ec8f213', 'UseShareThis', 'ShareThis official site. Digital data solutions for media planning, targeting, and measurement. Website tools to grow online audiences. Learn more: https://sharethis.com/', 'Yes', 'ri-share-line', 'share', 'Select', 'Yes,No', 'Yes', '', 'share,social,buttons,sharing', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('1bf67e17-a6c1-4ecb-8eb5-c4e09663607c', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('1f1b64c2-d100-434d-ad29-5969f3e085ac', 'PortfoliosPageMetaDescription', 'Meta description for the portfolios page.', 'Explore our portfolio and see the projects we\'ve worked on. Discover our expertise and the quality of our work across various industries.', 'ri-gallery-upload-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'portfolio,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('26558cfc-e8ef-4704-9843-8eebdb70797b', 'ShareThisCode', 'You can install the ShareThis share button on your HTML website in a few easy steps. Navigate to the setup page and choose your preference of Inline Buttons or Sticky Buttons. Learn more: https://sharethis.com/', '<script type=\"text/javascript\" src=\"https://platform-api.sharethis.com/js/sharethis.js#property=6XXXXXXXXXXXXXXXXXX&product=sticky-share-buttons&source=platform\" async=\"async\"></script>', 'ri-share-line', 'share', 'Code', NULL, NULL, '', 'share,code,script', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('27650d16-b6ff-4c26-95aa-5e97f5e4904f', 'SendGridApiKey', 'API key for SendGrid email service.', 'api-key', 'ri-key-line', 'email', 'Text', NULL, NULL, '', 'sendgrid,api,key,credentials', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('28d12c23-73fe-4233-82b0-8f8f7a0bfec2', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ConfigurationsModel, ContactsModel, ContactMessagesModel, ContentBlocksModel, CountersModel, CountriesModel, EventsModel, FaqsModel, FileUploadsModel, HomePageModel, LanguagesModel, NavigationsModel, PagesModel, PartnersModel, PortfoliosModel, PricingsModel, ServicesModel, SocialsModel, TeamsModel, TestimonialsModel, ThemesModel, TranslationsModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('28ef48a0-a422-4e20-a09f-c290791e7635', 'EnableShopFront', 'This configuration enables or disables the store front.', 'Yes', 'ri-shopping-cart-fill', 'site', 'Select', 'Yes,No', 'Yes', '', 'ecommerce,shop,products,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2a417123-5094-44b9-b573-36f6068f72e8', 'EnableChatbot', 'Enable or disable chatbot integration.', 'Yes', 'ri-robot-2-line', 'chatbot', 'Select', 'Yes,No', 'No', '', 'chatbot,enable', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2a57d900-8b6e-4027-bd8b-20de06f96a3f', 'CompanyEmail', 'Primary contact email for the company.', 'igniter@mail.com', 'ri-mail-line', 'site', 'Text', NULL, NULL, 'email', 'email,contact,communication', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2bcff97e-38f8-41e5-b63c-21834f519880', 'BlogsPageMetaDescription', 'Meta description for the blogs page.', 'Stay updated with the latest news, insights, and articles from our experts. Explore a wide range of topics and join the conversation.', 'ri-file-text-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'blog,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2e22e053-93b8-418c-8b17-9550187c6a1b', 'HCaptchaSiteKey', 'hCaptcha is a platform that stops online fraud and abuse with no personal information. It offers high accuracy, low friction, and universal compatibility for web, mobile, and server-side use cases. Learn more: https://www.hcaptcha.com/', '', 'ri-key-2-line', 'security', 'Text', NULL, NULL, '', 'recaptcha,key,site,hcaptcha', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2ee2b78f-c244-4781-a8d1-a915fd172250', 'GeminiBaseURL', 'Base URL for the API AI service to use (e.g., Gemini).', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', 'ri-robot-2-fill', 'ai', 'Text', NULL, 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=', '', 'ai,base url,chat,help,gemini,deepseek,qwen,gpt', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('2ef7b484-8c08-46ae-8023-f55f0e339dc6', 'PortfoliosPageMetaKeywords', 'Meta keywords for the portfolios page.', 'portfolio, projects, showcase, our work, expertise, quality projects', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'portfolio,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('303802f8-fe5e-4719-9b0e-e089424f051c', 'CompanyNumber', 'Primary contact phone number for the company.', '+44 7911 123456', 'ri-phone-line', 'site', 'Text', NULL, NULL, 'phone-number', 'phone,contact,number,telephone', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('32d8c150-cf43-4c4d-9db1-4fdae5c9769a', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('348cb5cd-9c06-413f-9df8-adcb28ee1493', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('353a5b55-3f19-4d2f-88d9-24ca2232c7d7', 'SMTPEncryption', 'Encryption method used for SMTP connection (SSL/TLS).', 'SSL', 'ri-lock-password-line', 'email', 'Text', NULL, NULL, '', 'smtp,encryption,ssl,tls,security', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('35c88f24-c2da-496f-806c-ea1dfb505d5e', 'EventsPageMetaTitle', 'Meta title for the events page.', 'Upcoming Events | Join Us for Exciting Events', 'ri-calendar-event-line', 'meta_seo', 'Text', NULL, NULL, '', 'events,meta,title,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('37ae0f3b-27e9-459f-93fd-2467bb34827d', 'MailgunApiKey', 'API key for Mailgun email service.', 'api-key', 'ri-key-line', 'email', 'Text', NULL, NULL, '', 'mailgun,api,key,credentials', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('3b6de7ca-767c-4f41-ad18-0c01bcd0c122', 'SMTPHost', 'SMTP server host for sending emails.', 'smtp.mail.com', 'ri-server-line', 'email', 'Text', NULL, NULL, '', 'smtp,host,server,email', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('40a35c87-5b68-4fa4-8a86-29a6839aa915', 'TwitterFeedCode', 'Embed X/Twitter feeds in your web page. See options : https://publish.twitter.com/', '<blockquote class=\"twitter-tweet\" data-dnt=\"true\" align=\"center\"><p lang=\"en\" dir=\"ltr\">It&#39;s pretty awesome how dancing makes robots less intimidating. Looking forward to seeing more nontrivial Machine Learning on these robots. Credit: Boston Dynamics. <a href=\"https://t.co/wnB2i9qhdQ\">pic.twitter.com/wnB2i9qhdQ</a></p>&mdash; Reza Zadeh (@Reza_Zadeh) <a href=\"https://twitter.com/Reza_Zadeh/status/1344009123004747778?ref_src=twsrc%5Etfw\">December 29, 2020</a></blockquote><script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', 'ri-twitter-line', 'security', 'Code', NULL, NULL, '', 'analytics,twitter,feed', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('41958b68-3913-4076-84e6-ecfb7b792e8c', 'MetaAuthor', 'Author information for SEO and meta tags', 'Igniter CMS App', 'ri-user-line', 'meta_seo', 'Text', NULL, NULL, '', 'meta,author,seo,page', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('41ba360c-d27b-4b96-992a-97cd6190a333', 'MailjetApiSecret', 'API secret for Mailjet email service.', 'your-mailjet-api-secret', 'ri-lock-password-line', 'email', 'Text', NULL, NULL, '', 'mailjet,api,secret,credentials', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('460c4246-a883-45eb-ae82-fb75fe348119', 'MaintenanceMode', 'Enable or disable maintenance mode for the site.', 'No', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'No', '', 'maintenance,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('4a56cc45-c82f-4aeb-a653-ed4f1a569073', 'MailgunDomain', 'Domain configured for Mailgun email service.', 'domain', 'ri-global-line', 'email', 'Text', NULL, NULL, '', 'mailgun,domain,email,configuration', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('4ebf154c-3150-4f2b-ac2c-2f9607e69853', 'UsePostHog', 'Enable or disable PostHog analytics script.', 'No', 'ri-line-chart-fill', 'forms', 'Select', 'Yes,No', 'No', '', 'analytics,posthog,script', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('50dcbac3-302e-416f-9668-7a2d8f823936', 'SiteFaviconLink96', 'Favicon link for the frontend interface (96x96 size).', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon-96x96.png', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,96,site,icon', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('5384cc4e-37b4-40d0-9ea8-a78254e380d4', 'SearchFilterPageMetaKeywords', 'Meta keywords for the filtered search results page.', 'search filter, refine search, filtered results, narrow down, find exactly, search options', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'search,filter,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('56803a33-9553-4f2a-b05a-f219a80aaf51', 'EnableEventsPage', 'This configuration enables or disables the events page.', 'Yes', 'ri-calendar-event-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'events,calendar,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2025-05-23 16:44:55', '2025-05-26 18:06:02');
INSERT INTO `configurations` VALUES ('5715e517-e0c7-4f1c-b244-9efd3009354a', 'EventsPageMetaKeywords', 'Meta keywords for the events page.', 'events, upcoming events, join us, experiences, event dates, event locations', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'events,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('588dcced-a056-4800-a731-3407fb1397d8', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('5956ad81-bd1a-438a-9c6f-9918b7c5e904', 'PostmarkSenderSignature', 'Sender signature for Postmark email service.', 'sender-signature', 'ri-file-list-line', 'email', 'Text', NULL, NULL, '', 'postmark,sender,signature,configuration', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('5bd3084d-f741-4250-ac2f-bc2415cb29e9', 'SendGridSenderName', 'Sender name for SendGrid email service.', 'sender-name', 'ri-user-line', 'email', 'Text', NULL, NULL, '', 'sendgrid,sender,name,configuration', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('5d7c42b6-2e4b-42c9-8e07-79ff9213a603', 'CompanyOpeningHours', 'Operating hours of the company.', 'Mon-Fri: 09AM - 05PM', 'ri-time-line', 'site', 'Text', NULL, NULL, '', 'address,location,office', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('5dd54c56-09be-49e3-bc2c-694221a4d01f', 'EnablePopupAds', 'This configuration enables or disables the popup ads for the home page.', 'Yes', 'ri-advertisement-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'popup,advert,alerts,announcements,pop-up', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('62c33292-02b6-4409-bbd1-402c380dae17', 'SiteFaviconLinkAppleTouch', 'Apple touch icon link for the frontend interface.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/apple-touch-icon.png', 'ri-apple-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,apple,touch,icon', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('646b6756-a156-44b7-9659-280861042587', 'MaintenanceModeTitle', 'Title displayed during maintenance mode.', 'We\'ll Be Back Soon!', 'ri-settings-line', 'site', 'Text', NULL, NULL, 'title-text', 'maintenance,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('651556f7-0b9e-4d75-8265-4cd2a47f001c', 'CompanyAddress', 'Physical address of the company office.', '123 Maple Street<br/> Watford, Hertfordshire<br/> WD17 1AA<br/> United Kingdom', 'ri-map-pin-line', 'site', 'Text', NULL, NULL, 'title-text', 'address,location,office', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('65c54d21-fcfe-42f9-be62-6aed742a7f09', 'MetaOgImage', 'Open Graph image for social media sharing.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.jpg', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'meta,og,image,social', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('6639666c-9f39-4fae-93cf-438d7491a326', 'CompanySecondaryNumber', 'Secondary contact phone number for the company.', '+44 7911 654321', 'ri-phone-line', 'site', 'Text', NULL, NULL, 'phone-number', 'phone,contact,number,telephone,secondary', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('6700181b-932b-4f74-b5fe-1f698ac9e9ef', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '1', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('6a529e2c-5f6f-4b14-9960-d06d0fef983f', 'EnableDonationsPage', 'This configuration enables or disables the donations and causes page.', 'Yes', 'ri-money-pound-circle-fill', 'site', 'Select', 'Yes,No', 'Yes', '', 'charity,donations,crowdfunding,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('6e637b6f-3a57-46bb-84f2-a95aff299b61', 'SearchFilterPageMetaDescription', 'Meta description for the filtered search results page.', 'Refine your search results using our filter options. Narrow down the results to find exactly what you\'re looking for quickly and easily.', 'ri-filter-2-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'search,filter,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('76d86f83-6fc9-4de8-9cd5-45c50dfe14d5', 'ContactUsPageMetaTitle', 'Meta title for the contact us page.', 'Contact Us | Get in Touch with Our Team', 'ri-contacts-line', 'meta_seo', 'Text', NULL, NULL, '', 'contact,meta,title,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('76d89ad9-d8d8-47ac-9bc2-fc0e1cb45a6b', 'CompanyName', 'Name of the company or organization.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('77a7c1ff-a0ca-4c16-a7a1-375a6aef7233', 'BlogsPageMetaKeywords', 'Meta keywords for the blogs page.', 'blog, news, articles, insights, updates, expert opinions', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'blog,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('7ccb808f-c241-40ea-9652-698c453fbf82', 'HomePageFormat', 'Enable or disable maintenance mode for the site.', 'HomePage', 'ri-pages-fill', 'site', 'Select', 'HomePage,Blog,Shop,Portfolio,None', 'HomePage', '', 'Home page,blogs,resumes,shops,portfolioslayout,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('7e361289-f571-4aaa-81ee-6984cfd64f2b', 'CompanyEnquiryEmail', 'Email address for receiving general enquiries or contact form submissions.', 'contact.us@mail.com', 'ri-customer-service-line', 'site', 'Text', NULL, NULL, 'email', 'email,enquiry,contact,support', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('821f9dcf-f67e-4c2d-82ad-01aff061e31c', 'MaintenanceModeText', 'Message displayed during maintenance mode.', 'Our website is currently undergoing scheduled maintenance. <br> Thank you for your patience. Please check back later.', 'ri-settings-line', 'site', 'Textarea', NULL, NULL, '', 'maintenance,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('8dbbf25f-eccf-4b1b-84ba-7a7890163826', 'PortfoliosPageMetaTitle', 'Meta title for the portfolios page.', 'Our Portfolio | Showcasing Our Projects', 'ri-gallery-line', 'meta_seo', 'Text', NULL, NULL, '', 'portfolio,meta,title,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('90a90684-c187-4455-9c02-ec04e6d86ac9', 'BackendLogoLink', 'Logo link for the backend interface.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('914311a8-c8c8-4c15-9301-536dc64bee49', 'SearchPageMetaDescription', 'Meta description for the search results page.', 'Use our search page to find the information you need. Browse through the search results to locate the content you\'re looking for.', 'ri-file-search-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'search,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('9194c5c2-529b-48fe-848f-7ea1685e2ab0', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('9421dd28-a87f-4eba-8ceb-09f6d691d49f', 'MailgunRegion', '', 'EU', 'ri-earth-line', 'email', 'Text', NULL, NULL, 'Region configured for Mailgun email service.', 'mailgun,region,location,configuration', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('9776df48-d877-478e-ad3b-c39b399b14bd', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('9db03074-5f20-41fe-b00e-27abdd9d5005', 'SiteFaviconManifestLink', 'Web manifest file link for the frontend interface.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/site.webmanifest', 'ri-file-list-3-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,manifest,site,web', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a26e96f3-16c3-419c-aaed-06cfcf48745c', 'ChatbotCode', 'Integrate chatbots and monitor customer activity in real time. See options like: https://www.tawk.to/, https://zapier.com/, https://botpress.com/, https://webagent.ai/, https://botpenguin.com/', '<!--Start of Tawk.to Script--><script type=\"text/javascript\">var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();(function(){var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];s1.async=true;s1.src=\"https://embed.tawk.to/[tawk.to.code]\";s1.charset=\"UTF-8\";s1.setAttribute(\"crossorigin\",\"*\");s0.parentNode.insertBefore(s1,s0);})();</script><!--End of Tawk.to Script-->', 'ri-robot-2-line', 'chatbot', 'Code', NULL, NULL, '', 'chatbot,tawk.to', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a396d19c-58c6-41bd-aadd-8a3aa85fd05d', 'PostHogCode', 'Add this snippet to your website within the <head> tag and you\'ll be ready to start using PostHog. Learn more: https://posthog.com/', '<script>!function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(t,o,n){    function i(t,e){var o=e.split(\".\");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){    t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}var s=e;for(void 0!==n?s=e[n]=[]:n=\"posthog\",    s.people=s.people||[],s.toString=function(t){var e=\"posthog\";return\"posthog\"!==n&&(e+=\".\"+n),t||(e+=\" (stub)\"),e},    s.people.toString=function(){return s.toString(1)+\".people (stub)\"};p=\"capture identify alias people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user\".split(\" \"),    r=0;r<p.length;r++)i(s,p[r]);e._i.push([t,o,n])},e.__SV=1.0,o=t.createElement(\"script\"),    o.type=\"text/javascript\",o.async=!0,o.src=\"https://cdn.posthog.com/posthog.js\",n=t.getElementsByTagName(\"script\")[0],    n.parentNode.insertBefore(o,n))}(document,window.posthog||[]);    posthog.init(\"YOUR_PROJECT_API_KEY\", {api_host: \"https://app.posthog.com\"});</script>', 'ri-line-chart-fill', 'share', 'Code', NULL, NULL, '', 'analytics,posthog,script', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a3ec8f08-4400-4953-8f4d-58e7f4cb180b', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a57e52d1-4634-45f6-a551-cc1a523a4c4f', 'EmailConfigType', '', 'Mailjet', 'ri-mail-settings-line', 'email', 'Select', 'SMTP,Mailjet,Mailgun,SendGrid,Postmark', NULL, 'Configuration type for email service (SMTP, Mailjet, etc.).', 'email,configuration,smtp,mailjet,mailgun,sendgrid,postmark', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a6a68a0a-146f-4fd7-be32-d0c9f39603cb', 'GoogleAnalyticsCode', 'Embed code for Google Analytics tracking.', '<!--Google Tag Manager--><script async src=\'https://www.googletagmanager.com/gtag/js?id=YOUR_MEASUREMENT_ID\'></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag(\'js\', new Date());gtag(\'config\', \'YOUR_MEASUREMENT_ID\');</script><!--End Google Tag Manager-->', 'ri-google-line', 'analytics', 'Code', NULL, NULL, '', 'analytics,google,tag manager', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a8fb4b98-b745-45cf-a4b7-0fdcc76faf1f', 'AppApiKey', 'API key for application integration.', 'your-app-api-key', 'ri-key-fill', 'site', 'Text', NULL, NULL, '', 'api,integration,middleware', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('a9dc626e-c7b0-4cfe-a955-2d46c9de7a48', 'CompanyAddressMap', 'Embedded map code to display the company location.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus\" frameborder=\"0\" style=\"border:0; width: 100%; height: 270px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'ri-map-2-line', 'site', 'Code', NULL, NULL, '', 'map,location,directions,address', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('b294eb99-ca60-4e2b-b541-19ea8fa14ba6', 'SMTPPassword', 'Password for SMTP server authentication.', 'SmtpPassword', 'ri-lock-line', 'email', 'Text', NULL, NULL, '', 'smtp,password,credentials,email', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('b5771ffd-ea93-4f1b-8de9-cf532e6bf479', 'SMTPUsername', 'Username for SMTP server authentication.', 'SmtpUsername', 'ri-user-line', 'email', 'Text', NULL, NULL, '', 'smtp,username,credentials,email', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('b6a7302c-3094-4836-9467-38a28883cd39', 'UseGoogleAnalytics', 'Enable or disable Google Analytics tracking.', 'Yes', 'ri-bar-chart-line', 'analytics', 'Select', 'Yes,No', 'Yes', '', 'analytics,google,tracking', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('b8498844-692a-4090-920f-46dd3ea9798c', 'UseTwitterFeed', 'Enable or disable Twitter feed integration.', 'Yes', 'ri-twitter-line', 'analytics', 'Select', 'Yes,No', 'Yes', '', 'analytics,twitter,feed', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('b92dee4b-5df9-4a31-a818-8c0a1acf37fa', 'SMTPPort', 'Port number for SMTP server connection.', '465', 'ri-router-line', 'email', 'Text', NULL, NULL, '', 'smtp,port,connection,email', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('bfc07141-463d-43bd-825a-e604b5556cbd', 'UseCaptcha', 'Enable or disable CAPTCHA for forms.', 'No', 'ri-shield-check-line', 'forms', 'Select', 'Yes,No', 'Yes', '', 'captcha,security,forms,spam', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('bfceab0b-9cfd-4213-9ca1-c0cbe86504a9', 'SiteLogoTwoLink', 'Logo link for the frontend interface (JPG format).', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo-horizontal.jpg', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('c0151b3b-3ab5-4c91-ac02-38cb21172919', 'SearchPageMetaKeywords', 'Meta keywords for the search results page.', 'search, search results, find information, browse content, locate content', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'search,meta,keywords,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('c5d3a896-eef3-449e-939a-7935d85b842b', 'SearchFilterPageMetaTitle', 'Meta title for the filtered search results page.', 'Filtered Search Results | Refine Your Search', 'ri-filter-line', 'meta_seo', 'Text', NULL, NULL, '', 'search,filter,meta,title,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('c9f2851e-f8a0-4ec5-852f-6b3f3105c8b0', 'MailgunSenderDomain', 'Sender domain configured for Mailgun email service', 'sender-domain', 'ri-mail-send-line', 'email', 'Text', NULL, NULL, '', 'mailgun,sender,domain,email', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('caa7e01c-2042-4042-a823-2f0aed93c1a6', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('cb725d78-0c86-42ad-a86d-871d87a85b74', 'PostmarkApiToken', 'API token for Postmark email service.', 'api-token', 'ri-key-line', 'email', 'Text', NULL, NULL, '', 'postmark,api,token,credentials', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('cbe84874-3950-4f91-af43-282d4cbd9337', 'MetaDescription', 'Description for SEO and meta tags', 'A robust and user-friendly CodeIgniter-based CMS to effortlessly manage your website content.', 'ri-text', 'meta_seo', 'Text', NULL, NULL, '', 'meta,description,seo,page', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('cd179d72-38ad-47cf-8ae7-c015be57ab4a', 'MetaKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('d03513c0-d3b4-44c4-a695-7674d8a42fbd', 'ContactUsPageMetaDescription', 'Meta description for the contact us page.', 'Have questions or need assistance? Get in touch with our team through our contact page. We\'re here to help you with any inquiries.', 'ri-chat-3-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'contact,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('d22ab4d3-7a4f-42ce-a408-d693b481a215', 'EventsPageMetaDescription', 'Meta description for the events page.', 'Discover our upcoming events and join us for exciting experiences. Stay informed about dates, locations, and how to participate.', 'ri-calendar-todo-line', 'meta_seo', 'Textarea', NULL, NULL, '', 'events,meta,description,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('d4568e76-3032-4827-93da-3e5f1082c52f', 'UseFacebookPixel', 'Enable or disable Facebook Pixel tracking.', 'No', 'ri-facebook-circle-line', 'analytics', 'Select', 'Yes,No', 'No', '', 'analytics,facebook,pixel', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('d49ec17b-e0fb-43c4-9174-bef85ac52bc1', 'HCaptchaSecretKey', 'hCaptcha is a platform that stops online fraud and abuse with no personal information. It offers high accuracy, low friction, and universal compatibility for web, mobile, and server-side use cases. Learn more: https://www.hcaptcha.com/', 'ES_XXXXXXXXXX', 'ri-key-line', 'security', 'Text', NULL, NULL, '', 'recaptcha,secret,key,hcaptcha', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('d9a7be1b-e91a-4440-8f90-a954e1f7046d', 'EnablePortfoliosPage', 'This configuration enables or disables the projects/portfolio page.', 'Yes', 'ri-gallery-view-2', 'site', 'Select', 'Yes,No', 'Yes', '', 'portfolios,project,mode,status,settings', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2025-05-23 16:44:55', '2025-05-26 18:05:33');
INSERT INTO `configurations` VALUES ('d9c141ba-cd51-4cfd-be9b-0d49025c8774', 'CookieConcentCode', 'Cookie Consent solution for your website to comply with ePrivacy Directive & GDPR. See options: https://termly.io/, https://www.freeprivacypolicy.com/free-cookie-consent/', '<!-- Cookie Consent by https://www.FreePrivacyPolicy.com --> <script type=\"text/javascript\" src=\"//www.freeprivacypolicy.com/public/cookie-consent/3.1.0/cookie-consent.js\"></script> <script type=\"text/javascript\"> document.addEventListener(’DOMContentLoaded’, function () { cookieconsent.run({\"notice_banner_type\":\"headline\",\"consent_type\":\"express\",\"palette\":\"light\",\"language\":\"en\",\"website_name\":\"YOUR WEBSITE NAME\"}); }); </script>', 'ri-shield-check-line', 'security', 'Code', NULL, NULL, '', 'security,cookie,consent', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('deef7db3-3af4-4373-abf9-f75a88406844', 'EnableGoogleTranslate', 'Enable or disable Google Translate feature.', 'No', 'ri-earth-line', 'site', 'Select', 'Yes,No', 'No', '', 'translate,google,language', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('df9622b5-a285-4c6a-be3d-4e7271254b0f', 'FacebookPixelCode', 'Embed code for Facebook Pixel tracking.', '<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');fbq(\'init\', \'YOUR_PIXEL_ID\');fbq(\'track\', \'PageView\');</script><noscript><img height=\"1\" width=\"1\" style=\"display:none\" src=\"https://www.facebook.com/tr?id=YOUR_PIXEL_ID&ev=PageView&noscript=1\" /></noscript>', 'ri-facebook-circle-line', 'analytics', 'Code', NULL, NULL, '', 'analytics,facebook,pixel', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('e4267c25-755f-456f-b62b-04ef971317ac', 'SearchPageMetaTitle', 'Meta title for the search results page.', 'Search Results | Find What You\'re Looking For', 'ri-search-line', 'meta_seo', 'Text', NULL, NULL, '', 'search,meta,title,seo', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('e7936ce3-4430-4abc-b8f9-d650b2b5d66f', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('eb8be625-5861-4dce-90c6-f627c4e9daf8', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('eef33e26-309d-4abf-807a-ae8c3b7db570', 'BlogsPageMetaTitle', 'Meta title for the blogs page.', 'Our Blog | Latest News and Insights', 'ri-article-line', 'meta_seo', 'Text', NULL, NULL, '', 'blog,meta,title,seo,page', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('ef56b653-9f99-4558-a2a5-65646c0b83d5', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('f0dcf35d-c5ee-4d22-bfcd-d825164e707e', 'GeminiAPIKey', 'API key for the AI service to use (e.g., Gemini).', '', 'ri-robot-2-fill', 'ai', 'Text', NULL, '', '', 'ai,chat,help,gemini,deepseek,qwen,gpt', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('f8ae5ef9-ea37-4f14-9c67-b6c3e3f97052', 'CompanySecondaryEmail', 'Secondary contact email for support or general inquiries.', 'igniter.support@mail.com', 'ri-mail-line', 'site', 'Text', NULL, NULL, 'email', 'email,contact,support,communication', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('f93b9638-eeab-46bc-a681-d3c99f394787', 'MetaTitle', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('fb34f86b-c549-48ff-874e-5a91bef31be3', 'UseCookieConcent', 'Enable or disable cookie consent banner.', 'Yes', 'ri-shield-check-line', 'security', 'Select', 'Yes,No', 'Yes', '', 'security,cookie,consent', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `configurations` VALUES ('fee1cfc7-22f1-4bba-a6f5-2b473f64c900', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `contact_messages`

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `contact_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`contact_message_id`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `subject` (`subject`),
  KEY `country` (`country`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `contact_messages`
INSERT INTO `contact_messages` VALUES ('1', 'John Doe', 'john.doe@example.com', 'Website Inquiry', '0', 'This is a test message from John Doe.', '192.168.1.1', 'US', 'Desktop', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `contact_messages` VALUES ('2', 'Jane Smith', 'jane.smith@example.com', 'Product Question', '0', 'I have a question about your product.', '10.0.0.1', 'CA', 'Mobile', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `contact_messages` VALUES ('8', 'Peter Jones', 'peter.jones@example.com', 'Feedback', '0', 'I wanted to provide some feedback.', '172.16.0.1', 'GB', 'Tablet', '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `contacts`

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `contact_id` varchar(255) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_picture` varchar(255) NOT NULL,
  `contact_document` varchar(255) DEFAULT NULL,
  `contact_audio` varchar(255) DEFAULT NULL,
  `contact_video` varchar(255) DEFAULT NULL,
  `other_document` varchar(255) DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`contact_id`),
  UNIQUE KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `content_blocks`

DROP TABLE IF EXISTS `content_blocks`;
CREATE TABLE `content_blocks` (
  `content_id` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `custom_field` text DEFAULT NULL,
  `order` int(11) DEFAULT 10,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`content_id`),
  KEY `identifier` (`identifier`),
  KEY `author` (`author`),
  KEY `title` (`title`),
  KEY `group` (`group`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `content_blocks`
INSERT INTO `content_blocks` VALUES ('222fc348-0e5d-45a8-a16e-8ff008c14ae9', 'SavingInvestments', '0', 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '', 'ri-reactjs-fill', 'theme', NULL, NULL, '0', NULL, '4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `content_blocks` VALUES ('66e60e46-0716-49c2-922f-f4c8ed7230d5', 'BusinessServices', '0', 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '', 'ri-database-2-line', 'theme', NULL, NULL, '0', NULL, '2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `content_blocks` VALUES ('dca191f3-6dd8-412e-9447-5eb3cf8e094b', 'OnlineConsulting', '0', 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '', 'ri-global-line', 'theme', NULL, NULL, '0', NULL, '6', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `counters`

DROP TABLE IF EXISTS `counters`;
CREATE TABLE `counters` (
  `counter_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `initial_value` int(11) DEFAULT 0,
  `final_value` int(11) DEFAULT 0,
  `extra_text` varchar(50) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`counter_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `counters`
INSERT INTO `counters` VALUES ('05a276bc-09d8-4254-8da6-a60bd3f3fa89', 'Hard Workers', NULL, '0', '15', NULL, 'ri-group-line', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `counters` VALUES ('8dff5635-0d8f-4ec1-a13f-22503ccba74e', 'Portfolios', NULL, '0', '521', NULL, 'ri-book-read-fill', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `counters` VALUES ('96428744-e087-4e3e-8755-1e48aeb8c65d', 'Happy Clients', NULL, '0', '232', NULL, 'ri-user-smile-line flex-shrink-0', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `counters` VALUES ('b2950eb5-b13c-4aa8-acc8-c95e98f6b0b9', 'Hours Of Support', NULL, '0', '1463', NULL, 'ri-customer-service-fill', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `countries`

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nicename` varchar(100) DEFAULT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` int(11) DEFAULT NULL,
  `phonecode` int(11) NOT NULL,
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


-- Table structure for table `donation_causes`

DROP TABLE IF EXISTS `donation_causes`;
CREATE TABLE `donation_causes` (
  `donation_cause_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `embedded_page_title` text DEFAULT NULL,
  `embedded_page` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`donation_cause_id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `donation_causes`
INSERT INTO `donation_causes` VALUES ('385e31cf-72b5-4802-a310-bbf2cbe176b6', 'Plant a Seed of Hope: Support Urban Gardening', 'urban-gardening-initiative', 'Help us create community gardens that provide fresh food and green spaces.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/community_garden.jpg', '<p>Join us in cultivating a greener future! Your donation will help us establish and maintain urban gardens that offer access to fresh produce and foster a sense of community.</p>', 'Donate Now', 'https://seedofhope.org.uk/', '1', 'Donate and Make an Impact', '<script async src=\"https://donorbox.org/widget.js\" paypalExpress=\"false\"></script><iframe src=\"https://donorbox.org/embed/support-gexpotech?language=en-us\" name=\"donorbox\" allowpaymentrequest=\"allowpaymentrequest\" seamless=\"seamless\" frameborder=\"0\" scrolling=\"no\" height=\"900px\" width=\"100%\" style=\"max-width: 500px; min-width: 250px; max-height:none!important\" allow=\"payment\"></iframe>', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Plant a Seed of Hope : Support Urban Gardening', 'Help create community gardens that provide fresh food and green spaces.', 'urban gardening, community gardens, food access, environmental sustainability, donations', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `donation_causes` VALUES ('ac0fa000-6dc2-40a4-81d9-f037c1d74bcf', 'End Child Hunger in Our Community', 'end-child-hunger', 'Provide nutritious meals to children facing food insecurity.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/end_hunger.jpg', '<p>Childhood hunger is a serious issue in our community. Your donation will help provide meals to children who may otherwise go hungry.</p>', 'Donate Now', 'https://www.savethechildren.org.uk/', '1', NULL, NULL, '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'End Child Hunger : Donate Today', 'Support our mission to provide meals for children in need.', 'child hunger, food insecurity, food bank, donations, charity', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `donation_causes` VALUES ('c6592377-a556-4655-a98e-b5b915713db1', 'Emergency Relief Fund : Supporting Disaster Victims', 'disaster-relief-fund', 'Provide critical aid to those affected by natural disasters.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/disaster_relief.jpg', '<p>In times of crisis, your support can make a real difference. Please consider donating to our Emergency Relief Fund to help those affected by natural disasters.</p>', 'Donate Now', 'https://shelterbox.org/', '1', 'How Your Donations Help', 'https://shelterbox.org/donate/', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Emergency Relief Fund : Support Disaster Victims', 'Provide critical aid to those affected by natural disasters.', 'disaster relief, emergency aid, natural disasters, humanitarian aid, donations', '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `educations`

DROP TABLE IF EXISTS `educations`;
CREATE TABLE `educations` (
  `education_id` varchar(36) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `institution` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `field_of_study` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `institution_logo` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`education_id`),
  KEY `institution` (`institution`),
  KEY `degree` (`degree`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `educations`
INSERT INTO `educations` VALUES ('973528ae-04eb-4c1a-9ffa-ce285341d88f', 'Undergraduate', 'University of Example', 'Bachelor of Science', 'Computer Science', '2015-09-01', '2019-06-01', 'A-', 'Member of the Computer Science Club', 'Focused on software development and data structures.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-logo.jpg', '1', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `educations` VALUES ('c0a4ad49-e8e3-4ca7-8476-54bb6f936d62', 'Graduate', 'Example University', 'Master of Science', 'Software Engineering', '2020-09-01', '2022-06-01', 'A', 'Research Assistant in the Software Engineering Lab', 'Specialized in advanced software engineering principles and practices.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-education-logo.jpg', '2', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);


-- Table structure for table `error_logs`

DROP TABLE IF EXISTS `error_logs`;
CREATE TABLE `error_logs` (
  `error_log_id` varchar(255) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `severity` int(10) NOT NULL,
  `error_message` text NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`error_log_id`),
  UNIQUE KEY `error_log_id` (`error_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `events`

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `event_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `registration_link_label` varchar(255) DEFAULT NULL,
  `registration_link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`event_id`),
  KEY `slug` (`slug`),
  KEY `start_date` (`start_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `events`
INSERT INTO `events` VALUES ('22ffef1f-8892-4c89-b77d-5b7417370dbd', 'Mindfulness Retreat 2024', 'A weekend retreat to relax, reflect, and recharge through guided mindfulness and meditation sessions.', 'mindfulness-retreat-2024', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-2.jpg', '<h2>Mindfulness Retreat 2024</h2> <p>Escape the hustle and bustle of daily life and join us for a weekend of mindfulness and meditation. Our retreat offers a peaceful environment to relax and recharge, with guided sessions led by experienced practitioners.</p> <h3>Activities Include</h3> <ul> <li>Guided Meditation</li> <li>Yoga Classes</li> <li>Nature Walks</li> <li>Mindful Eating Workshops</li> </ul> <p>Spaces are limited, so be sure to register early to secure your place.</p>', 'Tranquil Waters Retreat Center, VT', '2024-06-20', '09:00:00', '2024-06-20', '17:00:00', 'Sign Up', 'https://example.com/register-mindfulness-retreat', '1', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Mindfulness Retreat 2024', 'Join us for a weekend mindfulness retreat to relax, reflect, and recharge through guided meditation and yoga', 'mindfulness, retreat, meditation, yoga, wellness', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `events` VALUES ('af34fe90-9efc-462e-894e-8d88f317a56f', 'Tech Innovators Conference 2024', 'Join us for a day of insightful talks and networking with industry leaders in technology and innovation.', 'tech-innovators-conference-2024', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-1.jpg', '<h2>Tech Innovators Conference 2024</h2> <p>The Tech Innovators Conference is the premier event for professionals in the technology sector. This year, we are focusing on the latest advancements in AI, blockchain, and cybersecurity. Do not miss the opportunity to learn from and network with the brightest minds in the industry.</p> <h3>Keynote Speakers</h3> <ul> <li>Dr. Jane Smith - AI Ethics and Future</li> <li>John Doe - Blockchain Beyond Cryptocurrency</li> <li>Mary Johnson - Cybersecurity in the Modern World</li> </ul> <p>Register now to secure your spot at the forefront of technology innovation.</p>', 'Silicon Valley Conference Center, CA', '2024-05-14', '11:00:00', '2024-05-16', '17:00:00', 'Register Now', 'https://example.com/register-tech-conference', '1', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Tech Innovators Conference 2024', 'Join industry leaders at the Tech Innovators Conference 2024 for a day of insightful talks on AI, blockchain, and cybersecurity.', 'tech conference, AI, blockchain, cybersecurity, innovation', '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `experiences`

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE `experiences` (
  `experience_id` varchar(36) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `current_job` tinyint(1) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`experience_id`),
  KEY `company_name` (`company_name`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `experiences`
INSERT INTO `experiences` VALUES ('27116d0b-4429-4572-9f10-cde87f1b347f', 'Professional', 'Example Corp', 'Software Engineer', '2019-07-01', '2023-01-01', '0', 'New York, NY', 'Developed and maintained web applications.', 'Implemented a new feature that increased user engagement by 20%.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/company-logo.jpg', 'https://example.com', '1', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);


-- Table structure for table `faqs`

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `faq_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order` int(11) DEFAULT 10,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`faq_id`),
  KEY `question` (`question`(768)),
  KEY `answer` (`answer`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `faqs`
INSERT INTO `faqs` VALUES ('30c984ee-2c5a-402f-b9ab-a551704d6841', 'What are the benefits of practicing mindfulness daily?', 'Practicing mindfulness daily can lead to numerous benefits, including reduced stress, improved focus, and enhanced emotional regulation. It encourages a non-judgmental awareness of the present moment, which can help individuals respond to situations more calmly and thoughtfully. Additionally, mindfulness has been linked to better physical health, as it can lower blood pressure and improve sleep quality.', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `faqs` VALUES ('61bb06e1-1a73-494e-ab71-5a07aaee91f2', 'What are the environmental benefits of electric vehicles (EVs)?', 'Electric vehicles (EVs) offer significant environmental benefits, including reduced greenhouse gas emissions and improved air quality. Since EVs produce zero tailpipe emissions, they help decrease the amount of harmful pollutants released into the atmosphere. Additionally, when charged with renewable energy sources, EVs can further reduce the carbon footprint associated with transportation.', '3', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `faqs` VALUES ('670f0668-499a-4f5d-92e8-c4b20abd7921', 'How can businesses ensure the ethical use of AI?', 'Businesses can ensure the ethical use of AI by implementing clear guidelines and principles that prioritize transparency, fairness, and accountability. It is important to regularly audit AI systems for biases and ensure that they are designed and used in a way that respects user privacy and autonomy. Engaging diverse teams in the development and oversight of AI can also help identify and mitigate potential ethical issues.', '4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `faqs` VALUES ('6886ebce-7b51-4bfe-9ac0-76f4ea16df63', 'How does AI contribute to personalized learning in education?', 'AI contributes to personalized learning by analyzing student data to tailor educational content to individual needs. It can identify learning gaps, recommend resources, and adjust the pace of learning to suit each student. This personalized approach helps ensure that students receive the support they need to succeed, making education more inclusive and effective.', '2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `file_uploads`

DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE `file_uploads` (
  `file_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` float NOT NULL,
  `upload_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `unique_identifier` varchar(255) NOT NULL DEFAULT 'file-ym4fl',
  `group` varchar(255) DEFAULT NULL,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`),
  KEY `user_id` (`user_id`),
  KEY `file_name` (`file_name`),
  KEY `file_type` (`file_type`),
  KEY `unique_identifier` (`unique_identifier`),
  KEY `group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `file_uploads`
INSERT INTO `file_uploads` VALUES ('03253e71-307b-415a-8f62-007d52a2364a', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4139432798_1e28cbbe2f2115c869a7.type-1.jpg', 'jpg', '128000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1.jpg', NULL, 'file-qzfnc', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('044ffee7-d10f-42c9-beca-fbedebd90a16', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1814870899_2a1e69f713f557a144bd.blog-3.jpg', 'jpg', '89000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-3.jpg', NULL, 'file-x7wde', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('093b575e-5e94-437b-9b85-898018edf1fb', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7445466818_d9aac12c3f51cf2819fd.portfolio-image-2.jpg', 'jpg', '72000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-2.jpg', NULL, 'file-bdihs', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('09d9a209-f40b-49a0-850a-7fc2aff00770', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3766361079_fd90a41ea4190d0b5bc6.university-education-logo.jpg', 'jpg', '24000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-education-logo.jpg', NULL, 'file-avezs', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('12d6aef7-4265-484b-84e1-c46775e876c2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1154601093_1f88ce598ea1ccf512c1.pexel-2.jpg', 'jpg', '37000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-2.jpg', NULL, 'file-3nuql', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('13094188-7192-4933-8b78-f1d4e21f77cd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7901508512_36888c5baaf25cd71ea9.type-4.jpg', 'jpg', '121000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4.jpg', NULL, 'file-u6ihj', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('13fc5c9f-ca71-4e4b-9174-4f3f0ff61b34', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2564507938_14e1c1761f58147a6c4e.client-2.png', 'png', '5150', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-2.png', NULL, 'file-qtlh3', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('18e5b273-dfa5-48b3-a43a-87fefda2d6ba', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8996159544_d49bb7c2f98db73c1e25.pexel-3.jpg', 'jpg', '32000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-3.jpg', NULL, 'file-wltw8', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('1b704258-29d7-4d2f-88b1-02dd3557a78d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2088425589_cb9dac561ebfca6b0f81.type-2-preview.png', 'jpg', '722000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2-preview.png', NULL, 'file-387uk', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('1cd7d13a-b663-43ad-bb3a-fe396d37ff40', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1230664092_fff1c4ceb1a9af26ed70.type-3-preview.png', 'jpg', '768000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3-preview.png', NULL, 'file-43wel', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('2794a347-4017-4725-9310-816e39b3f04e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9606318477_2a442c7524b42ae31575.hero-bg-light.webp', 'webp', '135000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-bg-light.webp', NULL, 'file-g3qwl', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('2b558ab3-4140-40db-b5f1-97682a0a25cf', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1110908542_a5e99ecf7bac9eb7886f.disaster_relief.jpg', 'jpg', '668000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/disaster_relief.jpg', NULL, 'file-6h2a8', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('2cfd5a17-f7af-4914-8f90-091c289702a4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3810955954_e631433f4b7e21d9e386.earbuds-side.jpg', 'jpg', '419000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-side.jpg', NULL, 'file-l67e9', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('34814e55-effb-41c8-bc91-2be5fe2bcbba', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6028829707_9fab030e9666d1d3dfd7.client-3.png', 'png', '5000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-3.png', NULL, 'file-d8zei', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('3b1b0139-2dd4-45bd-8bbb-29878375b6a3', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1077923706_1ec30658690bd2d91084.portfolio-image-3.jpg', 'jpg', '41000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-3.jpg', NULL, 'file-ct374', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('3e341937-4acd-434c-af4c-c1aa5383d506', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5190408399_5066fbd2340edb207f04.team-4.jpg', 'jpg', '53000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-4.jpg', NULL, 'file-d370h', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('3e4d4b8c-9cbd-4ed6-9a29-c046632f9694', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4602412350_b2ba113834fe89246fb2.testimonials-2.jpg', 'jpg', '56000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-2.jpg', NULL, 'file-jhsu0', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('44260343-6fb3-4a5d-817d-39d1c9b4284b', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9849357803_2b6d9a26b4e38af239b7.hat_closeup.jpg', 'jpg', '36000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_closeup.jpg', NULL, 'file-o2vw6', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('4666aecc-cb1c-42a2-8499-85da4df955e9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4391537969_1eb4810c9a7b08223c82.speaker_demo.mp4', 'mp4', '856000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_demo.mp4', NULL, 'file-39maw', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('49e7f649-95dc-4e9b-aff0-f552a8114383', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4314674509_afcb142d389a3b16673c.pexel-1.jpg', 'jpg', '25000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-1.jpg', NULL, 'file-xxtpy', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('4a5efbdd-2382-4c89-9643-b3f8d602bea6', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4640444601_b698c901e557ae75ad8b.earbuds-case.jpg', 'jpg', '298000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-case.jpg', NULL, 'file-mm573', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('4e38802e-aa0d-467c-b43c-9461684270df', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5822214372_ba58ac6be864edf5824a.page-1.jpg', 'jpg', '123000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/page-2.jpg', NULL, 'file-7ncv3', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('4f3e1ae3-1272-42d0-8d1a-6939cff3a838', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2753256988_ca10cd5be2468316834e.skills.png', 'png', '40700', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/skills.png', NULL, 'file-2tqm2', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('4f577e07-c2e7-4250-8df7-dbc1745960e0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4057988722_182e3d45576e66fe6f6f.speaker_side.jpg', 'jpg', '286000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_side.jpg', NULL, 'file-3qfvq', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('517dea13-b129-49b2-8cba-0c3b7e8a3d84', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8904633912_b53137fdb81bc115d27c.type-6-preview.png', 'jpg', '403000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6-preview.png', NULL, 'file-jqtam', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('52a5364a-c2a0-4314-afed-619ecd4c96f1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3540266591_ea41ece98d9148253208.testimonials-1.jpg', 'jpg', '39000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-1.jpg', NULL, 'file-46aua', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('5389e8db-a6d7-4798-9d08-5adab87693a5', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8054571191_c572cd462593825ca4db.ci-cms-logo.png', 'png', '43000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.png', NULL, 'file-lsg8q', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('5ea13289-51dc-4002-8f0b-2ceff5e6ea1c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6885741937_7e70761f310abd98f9a5.about-us.jpg', 'jpg', '141000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/about-us.jpg', NULL, 'file-sjn1g', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('627ee481-d352-49d1-926a-ffa6a09b87dd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6433235545_6db012a90e3128f7d3d9.type-5-preview.png', 'jpg', '467000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5-preview.png', NULL, 'file-rcsoz', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('6380efa3-b3a0-4d6e-80a5-947ad713e02e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7581989314_e3ef66ddf5b058496ba9.home-about.jpg', 'jpg', '119000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/home-about.jpg', NULL, 'file-uhitz', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('660df427-7809-4967-adb1-206578182b49', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9913786993_4ac61b2fa0b84ad2806f.type-5.jpg', 'jpg', '104000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-5.jpg', NULL, 'file-9waxk', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('678c8b56-5bb5-43f9-8834-8dc5ddb90629', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3628234774_b6dde6abf6f14b724aa0.type-6.jpg', 'jpg', '127000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-6.jpg', NULL, 'file-j8q5r', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('69a0a0ec-83db-4593-b523-5b68cdc1d008', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4524939560_21441a034c2d2a9b558b.gallery-3.jpg', 'jpg', '112000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg', NULL, 'file-kzdgk', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('6a09f69d-ff9e-4c93-afc3-a544887c7cbb', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7761530764_7171e98dc09234e7ecad.page-1.jpg', 'jpg', '381000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/page-1.jpg', NULL, 'file-mnwad', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('6cf57a4a-fcc8-40a3-a4f1-16f666019d26', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4114008320_d088eaf56de8407d5cfe.gallery-4.jpg', 'jpg', '72000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg', NULL, 'file-gkz6w', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('6d4deb2a-c752-4b82-a0e1-41bb83f62ad5', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8920836152_92c1c9ebe82184f52bb5.portfolio-image-1.jpg', 'jpg', '65000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-1.jpg', NULL, 'file-fze7d', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('71f0db31-801e-4316-83b1-6c37daf6dd67', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8833763955_5f3df55d41cadf68a9d0.event-1.jpg', 'jpg', '30000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-1.jpg', NULL, 'file-9dokx', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('734b4f55-aaed-4c25-b14d-e3b3f86fd801', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2168039217_0d68cc10d4ea2287cb12.earbuds.jpg', 'jpg', '264000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds.jpg', NULL, 'file-j6cu5', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('74067c9f-e404-4746-b14f-594a351644eb', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3104543789_6f99b90622237f34ad32.blog-1.jpg', 'jpg', '104000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-1.jpg', NULL, 'file-a9s3d', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('75d6a737-6cc3-4d0c-a43f-1fa62c34693d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5438769083_d4e1a16db0fd6f417951.shirt.jpg', 'jpg', '500000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt.jpg', NULL, 'file-yclie', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('79943438-b919-49af-92fd-cb646dda0ee1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5953556832_59127eee3e047466fb76.favicon.svg', 'svg', '183000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.svg', NULL, 'file-imscp', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('799c8b53-b635-4c09-8243-ad3f0b8aed01', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3549844613_5e5f8899ddbd050a7ffa.hat_side.jpg', 'jpg', '812000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_side.jpg', NULL, 'file-131vu', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('79e58038-8252-476a-8a24-df4b2ba69eee', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3907508161_9aa4eaad8db1429312ac.team-3.jpg', 'jpg', '25000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-3.jpg', NULL, 'file-928gn', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('7bbd150b-3ce2-42ff-ade8-7fb8c32aa933', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1611467101_6f71ec45b0297f99e438.gallery-2.jpg', 'jpg', '62000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg', NULL, 'file-9iho5', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('7e873ffe-0956-4d6e-a4aa-cab50be3338d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3228116846_285a8c2e0f8e5ab89929.ci-cms-logo.jpg', 'jpg', '43000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/ci-cms-logo.jpg', NULL, 'file-4efe7', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('7efc4eae-60aa-4998-b99b-340395a18232', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1448810313_e366ba33089244c4b622.why-us.png', 'png', '85000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/why-us.png', NULL, 'file-cltx0', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('83b4a3a9-d42c-4adb-9e34-35f46a3225a6', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7673825153_db5c048f2baa6dff331c.hero-carousel-2.jpg', 'jpg', '290000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-2.jpg', NULL, 'file-dgvaz', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('84f74b92-7898-442b-b6ed-74e27244fa39', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7432987761_4abdf50aeb6c16af7ce1.speaker_back.jpg', 'jpg', '422000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_back.jpg', NULL, 'file-kz7h4', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('853b08e0-d93a-42e6-9e25-0ca7d6c98a50', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5884583618_e6ff620ea0eb07218d84.sample.pdf', 'pdf', '18300', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample.pdf', NULL, 'file-1xnki', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('881aa6c8-839f-4577-b9c3-0521eed92d59', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5758027640_f56aa6fce689a1960343.shirt-front.jpg', 'jpg', '444000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-front.jpg', NULL, 'file-bkpxu', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('8a727d8c-e7d4-42fa-b1ee-7213472fa2f2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2676139816_23fc28023753bcc270e5.type-4-preview.png', 'jpg', '406000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-4-preview.png', NULL, 'file-sghjj', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('8c537cd4-fa95-4301-8f41-9ed2079945f8', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7120746808_cd8f97b6a53b5d78b768.pexel-4.jpg', 'jpg', '24000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-4.jpg', NULL, 'file-07lmg', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('8d511892-5bfa-4d4a-b4c5-9ffbb778131c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5081670224_db34f3fff4c121c646f3.sQ22pm-xvrE.mp4', 'mp4', '220000', 'https://www.youtube.com/watch?v=sQ22pm-xvrE', NULL, 'file-2ur2j', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('9083da67-c4c5-43b1-b0f3-83f131a16f60', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5157651613_7581db509e4306c67951.shirt-side.jpg', 'jpg', '305000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-side.jpg', NULL, 'file-f25ct', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('9433cff5-47ec-4979-badc-da1c468af677', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5824909556_df789890d920772caeb1.team-1.jpg', 'jpg', '63000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-1.jpg', NULL, 'file-k2unb', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('95deae77-7b02-440c-baac-f937265d57bd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9051952035_94b0eff560ef73fd5b40.hero-img.svg', 'svg', '10600', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-img.svg', NULL, 'file-oyb51', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('963e2af9-fd8f-4f62-8806-e84c67cb358b', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4394638162_47833c8a1fe3b8c89632.portfolio-image-4.jpg', 'jpg', '60500', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-4.jpg', NULL, 'file-l2urb', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('96abbe31-3336-48df-b8ad-7e19fbab33f9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2980182881_c001b0d5769a37d465fa.favicon.ico', 'ico', '14000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon.ico', NULL, 'file-xzkr7', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('9851bcba-8942-4426-b0f2-5f59fbcc9d96', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9453060675_ace3ae690560e93fa756.event-2.jpg', 'jpg', '26000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/event-2.jpg', NULL, 'file-je97u', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('9b791c72-27c7-483f-8a13-87ca762bc4f1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3030765485_c780c91eabda1d4bf368.sample-audio-1.mp3', 'mp3', '716', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample-audio-1.mp3', NULL, 'file-ja1h5', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('a19412fa-fcec-46b8-8409-de5a694c2bb2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3645375921_cd58bcc82a4662d6acec.type-8-preview.png', 'jpg', '20000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-8-preview.png', NULL, 'file-385og', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('a377b3cf-8a26-475b-959e-8e9c58987672', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3364677052_b457e034fb2eaa4c00bd.wDchsz8nmbo.mp4', 'mp4', '220000', 'https://www.youtube.com/watch?v=wDchsz8nmbo', NULL, 'file-svfg8', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('a45e2b8c-69ae-4187-b6f4-cc42bbcce171', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5798766695_257426c666d073d1df00.hero-img.png', 'png', '66600', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-img.png', NULL, 'file-z3m9h', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('a471ab3b-3948-45c1-9b2f-dcebb7fb3490', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2868549665_5509f475e6ddd73c6bf5.client-4.png', 'png', '4450', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-4.png', NULL, 'file-mpsuf', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('a8399236-fd1a-484c-acdc-59d00e448e80', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7305543996_8161a99eaf5c88dbfcf9.company-logo.jpg', 'jpg', '8000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/company-logo.jpg', NULL, 'file-t7ick', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('aa26b6b5-cae5-45aa-aed0-ad7c12b5e4cb', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4623836757_893ee621874832b16246.shirt-closeup.jpg', 'jpg', '304000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-closeup.jpg', NULL, 'file-tzrxi', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('aa909ad2-b845-43be-b8cc-3b6c30164569', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3962191690_b3fe3f6c097d7f741a40.university-logo.jpg', 'jpg', '13000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/university-logo.jpg', NULL, 'file-otbet', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ab1b79ed-6c29-4b99-a417-26a67f5e8f45', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6116220225_7c1c0166c2b45e70999b.favicon-96x96.png', 'png', '13000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/favicon-96x96.png', NULL, 'file-i88e6', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ac4f8624-e7f1-4f73-a3c1-c4b426e570a8', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5811817965_6b13f097498d54092505.speaker_front.jpg', 'jpg', '385000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_front.jpg', NULL, 'file-x879r', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('afd48c34-4af0-4f5b-b82f-1db4baf89d87', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9364997487_3df6b4843ba83d4617b7.sample-audio-1.ogg', 'ogg', '980000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample-audio-1.ogg', NULL, 'file-p33ka', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('afe48fe5-9629-4a74-b3bf-21164a30ba1e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1720581938_a1c524f47f78d76c66d0.web-app-manifest-192x192.png', 'png', '40000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/web-app-manifest-192x192.png', NULL, 'file-b4ilx', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('b0692bd1-e343-4f2b-9bad-b4c4f0631e38', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8754111928_6002eb89ff7266471547.type-7.jpg', 'jpg', '62000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7.jpg', NULL, 'file-wny83', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('b2cf1ee8-e348-4326-a74a-403ca3b95abd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1736609509_e701095619dd78541919.team-2.jpg', 'jpg', '33000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-2.jpg', NULL, 'file-ep6xc', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('b9ee1c7e-7ce5-49a6-a9e1-3325f08da4e8', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '5819525253_a8fe75469a632332e6e1.gallery-1.jpg', 'jpg', '64000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg', NULL, 'file-9broe', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('bdfef44e-8561-4858-8f6c-24a9722f6d8c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6577002136_3ca92417ff0aacd773b1.hat.jpg', 'jpg', '445000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat.jpg', NULL, 'file-1qqvf', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('c0208051-8915-4882-8fdc-8a17187fdec4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9822182170_c33b29fdd206f8adec0c.community_garden.jpg', 'jpg', '439000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/community_garden.jpg', NULL, 'file-zktf2', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('c3076c4e-94b0-4fa6-aa55-f349fa5f9fcd', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9112863034_36045bd48c9cfd62284a.hero-carousel-3.jpg', 'jpg', '325000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-3.jpg', NULL, 'file-86eee', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('c9a01cb3-88bf-4ce3-b737-9f64aea2569b', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6690110427_04770728c216a941a2c0.earbuds-demo.mp4', 'mp4', '1030000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-demo.mp4', NULL, 'file-jx168', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('d71d3c6d-93af-4d3d-bb7f-82ed833073fe', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1352522577_c4e624a1192b564784e5.site.webmanifest', 'webmanifest', '183000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/site.webmanifest', NULL, 'file-6yk6i', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('d8e67648-8994-43b6-9dec-120525ab67ad', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9036913649_8fd4b4ea0df0757db33e.type-7-preview.png', 'jpg', '683000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-7-preview.png', NULL, 'file-s84z8', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('de468639-1050-4f89-b919-ac440fc64062', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4208736284_226613e9f37755a7c195.blog-2.jpg', 'jpg', '69000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/blog-2.jpg', NULL, 'file-tkcya', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('e3909a5e-33ae-4ecd-ab2b-96d4b5af09e4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2657271253_7d2da32ee388056a38ae.web-app-manifest-512x512.png', 'png', '188000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/web-app-manifest-512x512.png', NULL, 'file-tc7bo', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('e395c01b-3e5e-4dfa-9d7f-9f722058a58c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1747808954_04f081cc45fe2f91aee3.type-2.jpg', 'jpg', '507000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-2.jpg', NULL, 'file-hzn9p', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('e5a484c2-209e-4395-8061-f594b9788568', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '8747891285_f3ba335ec7797c647b7f.pexel-video-1.mp4', 'mp4', '823000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/pexel-video-1.mp4', NULL, 'file-2gaob', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('e608a278-f6b8-4a8f-b00c-52bffd754d8d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '4507562083_59f5f3240d9460b50907.apple-touch-icon.png', 'png', '36000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/logo/favicon/apple-touch-icon.png', NULL, 'file-amr2g', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('e6c2a47c-6e94-4e96-9087-c601567b8a05', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6669263040_9c66a623af79b4d60c39.client-1.png', 'png', '3036', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-1.png', NULL, 'file-6g80u', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('eb25f999-0f27-46f8-ab1d-d0aa248aef09', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6995859749_0a264f163d29beb7111a.speaker_closeup.jpg', 'jpg', '559000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_closeup.jpg', NULL, 'file-8j9uq', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('eb8f331a-c4eb-4398-b3a8-7d1084dc6c27', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3842518529_1e951f342c838f9b0817.type-1-preview.png', 'jpg', '194000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-1-preview.png', NULL, 'file-1w3fk', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ec274d46-0e94-4112-a6b1-57f6af0b8e54', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2735618985_32dbf1935fc720b971d7.type-3.jpg', 'jpg', '72000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/ad-modals/type-3.jpg', NULL, 'file-g1hi6', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ecce6997-ea61-481a-8327-8a7c035f8faa', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '3054791129_ee2df6cc79d9ae463d1e.hat_back.jpg', 'jpg', '322000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_back.jpg', NULL, 'file-q7pek', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ecdf7371-1d63-4d96-9987-a17d6d3ae874', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7111932190_ffa1b26b81563ffd4bfd.resume-profile.jpg', 'jpg', '20000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/resume-profile.jpg', NULL, 'file-g70xj', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('ed63246b-55fa-4578-9cfb-b6c57e2604d4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2957516285_d70d0b53c3a0ab8dea85.speaker.jpg', 'jpg', '284000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker.jpg', NULL, 'file-c8rbt', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('f037b974-beca-4f33-8f2a-762103718f50', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2144388727_15b66eecbf48f03c23d4.hero-carousel-1.jpg', 'jpg', '325000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-1.jpg', NULL, 'file-gu3km', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('f27389c9-2048-4fcb-aace-c7d5212d950e', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '7359698434_e13918e64dec72e2f5d6.end_hunger.jpg', 'jpg', '509000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/end_hunger.jpg', NULL, 'file-l8aj9', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('f5b3f19e-aa09-4aa0-a72d-4b47e5d8e11d', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '1344154924_e11f3b63f34769831077.testimonials-3.jpg', 'jpg', '17000', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-3.jpg', NULL, 'file-8bta1', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `file_uploads` VALUES ('fe2fb5c1-503b-499b-875e-37637a914a8c', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9346217717_1575c9c655afaea29656.testimonials-4.jpg', 'jpg', '19700', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-4.jpg', NULL, 'file-c4vvu', NULL, '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `home_page`

DROP TABLE IF EXISTS `home_page`;
CREATE TABLE `home_page` (
  `home_page_id` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `section_description` text DEFAULT NULL,
  `section_image` varchar(255) DEFAULT NULL,
  `section_image_2` varchar(255) DEFAULT NULL,
  `section_image_3` varchar(255) DEFAULT NULL,
  `section_image_4` varchar(255) DEFAULT NULL,
  `section_video` varchar(255) DEFAULT NULL,
  `section_audio` varchar(255) DEFAULT NULL,
  `section_file` varchar(255) DEFAULT NULL,
  `content_blocks` text DEFAULT NULL,
  `section_link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`home_page_id`),
  KEY `section` (`section`),
  KEY `section_title` (`section_title`),
  KEY `section_description` (`section_description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `home_page`
INSERT INTO `home_page` VALUES ('263eeb9a-bd3a-4656-83ee-f9229bb5a38c', 'FrequentlyAskedQuestions', 'Frequently Asked Questions', 'Have questions? We\'ve got answers. Check out our FAQ section for quick and helpful responses to the most common inquiries about our services, processes, and more.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '14', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('4fe1d104-3335-4188-8163-1edf7efad994', 'Pricing', 'Pricing', 'Get transparent and competitive pricing for all our services. We offer flexible packages to suit different budgets and requirements, ensuring you get the best value for your investment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '12', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('5d9d4977-5949-4e95-aa7f-7ae7a12edd38', 'HomeAbout', 'About Us', 'Welcome to A Bootstrap 5 Template for Modern Businesses! Our mission is to provide sleek, responsive, and highly customizable templates that empower businesses to create stunning websites with ease. Whether you\'re a startup, a growing company, or an established enterprise, our templates are designed to meet your needs and help you stand out in the digital landscape.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/home-about.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/why-us.png', NULL, NULL, 'https://www.youtube.com/watch?v=sQ22pm-xvrE', NULL, NULL, NULL, NULL, '0', '1', '4', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('6ba5bf78-6195-4b6f-969b-646cdc81b2e7', 'Partners', 'Partners', 'We are proud to be supported by our amazing sponsors. Their contributions help us deliver top-notch services and continue to innovate. Thank you for your support!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '22', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('74d2b557-ce60-4b91-9729-3c370d293fb3', 'CallToAction', 'Call To Action', 'Ready to take your business to the next level? Contact us today to get started on your journey to success. Let\'s build something amazing together!', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-1.jpg', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sQ22pm-xvrE', NULL, NULL, NULL, '#!', '0', '1', '24', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('7913ee26-26f6-451e-b592-2ddebc984170', 'RecentPosts', 'Recent Posts', 'Stay updated with the latest trends, tips, and insights in the industry through our blog. Our expert articles cover a wide range of topics to help you stay informed and ahead of the curve.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '26', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('7d3521b3-87ff-4ed1-82dc-debe02af1d62', 'Team', 'Team', 'Meet the talented individuals behind our success. Our team of experts brings diverse skills and experiences to the table, working collaboratively to deliver outstanding results for our clients.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '20', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('804a6693-b4ee-462f-839c-2060c010ffa4', 'Contact', 'Get in touch', 'We\'d love to hear from you! Reach out to us through our contact page for any inquiries, feedback, or to discuss how we can help your business grow. We\'re here to assist you every step of the way.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '30', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('84682947-8c29-44bb-bbb5-80220bf4be92', 'Services', 'Services', 'Discover our range of professional services designed to help your business thrive. From web development and design to digital marketing and consulting, we offer tailored solutions to meet your unique needs and drive your success.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '6', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('8d8c0016-6809-4d98-9e30-9e1ab66b9041', 'HomeHero', 'A Bootstrap 5 template for modern businesses', 'Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit!', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-img.svg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/hero-carousel-3.jpg', 'https://www.youtube.com/watch?v=sQ22pm-xvrE', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample-audio-1.mp3', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/sample.pdf', NULL, NULL, '0', '1', '2', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('9945ead9-10df-41da-96e8-8312f01a8ad9', 'Portfolio', 'Portfolio', 'Explore our portfolio to see the innovative projects we\'ve completed for our clients. Our work showcases our commitment to quality, creativity, and excellence across various industries and project types.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '18', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('cc125e1e-3fde-467e-86d3-f32311d7e5da', 'Testimonials', 'Testimonials', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '16', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('cf3b3e57-aa2c-4eda-9f1c-50312aff1cd0', 'Counters', 'Counters', '', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/skills.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '8', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `home_page` VALUES ('da40a6e8-26f6-4b14-a74c-3d0df434e90f', 'Subscribe', 'New products, delivered to you.', 'Sign up for our newsletter for the latest updates.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '28', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `languages`

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `language_id` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` VALUES ('1', '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('2', '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('3', '2024-08-27-210522', 'App\\Database\\Migrations\\Contacts', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('4', '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('5', '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('6', '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('7', '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('8', '2024-09-27-050700', 'App\\Database\\Migrations\\FileUploads', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('9', '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('10', '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('11', '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('12', '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('13', '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', '1748015095', '1');
INSERT INTO `migrations` VALUES ('14', '2024-10-12-182242', 'App\\Database\\Migrations\\ContactMessages', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('15', '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('16', '2024-10-13-112944', 'App\\Database\\Migrations\\Counters', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('17', '2024-10-13-113014', 'App\\Database\\Migrations\\Events', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('18', '2024-10-13-113032', 'App\\Database\\Migrations\\Faqs', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('19', '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('20', '2024-10-13-113132', 'App\\Database\\Migrations\\Pricings', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('21', '2024-10-13-113139', 'App\\Database\\Migrations\\Portfolios', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('22', '2024-10-13-113214', 'App\\Database\\Migrations\\Socials', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('23', '2024-10-13-113222', 'App\\Database\\Migrations\\Teams', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('24', '2024-10-13-113232', 'App\\Database\\Migrations\\Testimonials', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('25', '2024-10-13-113248', 'App\\Database\\Migrations\\Translations', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('26', '2024-11-02-212632', 'App\\Database\\Migrations\\Languages', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('27', '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('28', '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('29', '2024-11-12-143627', '\\SiteStats', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('30', '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('31', '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', '1748015096', '1');
INSERT INTO `migrations` VALUES ('32', '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('33', '2024-11-17-163545', 'App\\Database\\Migrations\\HomePage', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('34', '2024-11-18-142248', 'App\\Database\\Migrations\\Services', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('35', '2024-11-18-142850', 'App\\Database\\Migrations\\Partners', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('36', '2024-12-21-220542', 'App\\Database\\Migrations\\Resumes', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('37', '2024-12-22-124058', 'App\\Database\\Migrations\\Educations', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('38', '2024-12-22-124110', 'App\\Database\\Migrations\\Experiences', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('39', '2024-12-22-124119', 'App\\Database\\Migrations\\Skills', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('40', '2024-12-24-172538', 'App\\Database\\Migrations\\Products', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('41', '2024-12-24-172545', 'App\\Database\\Migrations\\ProductCategories', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('42', '2024-12-26-141524', 'App\\Database\\Migrations\\AnnouncementPopups', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('43', '2024-12-27-170426', 'App\\Database\\Migrations\\Subscribers', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('44', '2024-12-27-185828', 'App\\Database\\Migrations\\DonationCauses', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('45', '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', '1748015097', '1');
INSERT INTO `migrations` VALUES ('46', '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', '1748015097', '1');


-- Table structure for table `navigations`

DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `navigation_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT 10,
  `parent` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`navigation_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `navigations`
INSERT INTO `navigations` VALUES ('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', 'footer_nav', '44', NULL, 'rss', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('0a6d180e-96af-494d-b309-5cfa80e6c94f', 'Plant a Seed of Hope', 'Donate Plant a Seed of Hope nav', 'top_nav', '16', 'cb3badd1-b6df-420c-a74d-796e181b1228', 'donate/urban-gardening-initiative', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', 'services', '28', NULL, '#!', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', 'footer_nav', '36', NULL, '#services', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', 'services', '30', NULL, '#!', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', 'footer_nav', '38', NULL, '/cookie-policy', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', 'top_nav', '10', NULL, '#team', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Home', 'Home navigation', 'top_nav', '2', NULL, 'home', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', 'top_nav', '4', NULL, '#about', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', 'footer_nav', '42', NULL, 'sitemap', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', 'footer_nav', '34', NULL, '#about', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', 'top_nav', '20', NULL, 'contact', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', 'footer_nav', '32', NULL, 'home', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('875edb73-84ef-403c-9132-519a7fa62f79', 'Emergency Relief Fund', 'Donate Emergency Relief Fund nav', 'top_nav', '18', 'cb3badd1-b6df-420c-a74d-796e181b1228', 'donate/disaster-relief-fund', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', 'services', '26', NULL, '#!', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', 'footer_nav', '40', NULL, '/privacy-policy', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('cb3badd1-b6df-420c-a74d-796e181b1228', 'Donate', 'Donate nav', 'top_nav', '14', NULL, 'donate', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', 'top_nav', '12', NULL, 'blogs', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', 'top_nav', '6', NULL, '#services', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', 'services', '24', NULL, '#!', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', 'top_nav', '8', NULL, '#portfolio', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `navigations` VALUES ('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', 'services', '22', NULL, '#!', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `pages`

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `content` text NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`page_id`),
  KEY `title` (`title`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `pages`
INSERT INTO `pages` VALUES ('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', '1', '0', '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `pages` VALUES ('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'About Us', 'about-us', '1', '0', '<h2>About Us</h2> <p>Welcome to our company! We are dedicated to providing the best services to our customers. Our team is composed of highly skilled professionals who are passionate about what they do. We believe in innovation, integrity, and customer satisfaction.</p> <p>Our mission is to deliver top-notch solutions that meet the evolving needs of our clients. We strive to create a positive impact in the industry and build long-lasting relationships with our partners and customers.</p> <p>Thank you for choosing us. We look forward to working with you and achieving great success together.</p>', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'About Us - Our Company', 'Learn more about our companys mission, values, and team', 'about us, company, mission, values, team', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `pages` VALUES ('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', '1', '0', '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `partners`

DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `partner_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`partner_id`),
  KEY `title` (`title`),
  KEY `logo` (`logo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `partners`
INSERT INTO `partners` VALUES ('03c680b2-9775-4c28-a75f-dad1bd104ff5', 'Grabyo', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-4.png', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `partners` VALUES ('41bc5d55-edfb-4e38-bbb3-53ed5a7fe3ea', 'Trustly', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-1.png', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `partners` VALUES ('83c3194d-5cc1-4a15-b817-469e725bd7e2', 'Citrus', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-3.png', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `partners` VALUES ('b321f89b-dca2-4391-b04f-48dd31661329', 'Myob', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/client-2.png', NULL, NULL, 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `password_resets`

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `reset_id` char(36) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Table structure for table `portfolios`

DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE `portfolios` (
  `portfolio_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_filter` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `details_image_1` varchar(255) DEFAULT NULL,
  `details_image_2` varchar(255) DEFAULT NULL,
  `details_image_3` varchar(255) DEFAULT NULL,
  `details_image_4` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `status` int(11) DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`portfolio_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `portfolios`
INSERT INTO `portfolios` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa1', 'Website Redesign', 'A complete overhaul of the client\'s existing website to improve user experience and update the design.', 'website-redesign', 'Web Development', 'web-development', 'TechCorp', '2024-01-15', 'https://example.com/?techcorp=new-website', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg', '<p>We worked closely with TechCorp to redesign their website, focusing on a modern look and feel, as well as improving the overall user experience. The project included a new responsive design, updated content structure, and enhanced performance.</p>', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Website Redesign for TechCorp', 'Read about our project to redesign TechCorp\'s website, focusing on user experience and modern design.', 'website redesign, web development, TechCorp, user experience, responsive design', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `portfolios` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa2', 'Mobile App Development', 'Development of a cross-platform mobile app for a retail client to enhance their customer engagement.', 'mobile-app-development', 'App Development', 'app-development', 'RetailGiant', '2024-02-20', 'https://example.com/?retailgiant=mobile-app', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg', '<p>Our team developed a cross-platform mobile app for RetailGiant, designed to enhance customer engagement and provide a seamless shopping experience. The app includes features such as push notifications, in-app purchases, and loyalty rewards.</p>', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Mobile App Development for RetailGiant', 'Discover how we developed a cross-platform mobile app for RetailGiant to enhance customer engagement.', 'mobile app development, app development, RetailGiant, customer engagement, cross-platform', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `portfolios` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa3', 'E-commerce Platform Launch', 'Launch of a new e-commerce platform for a fashion brand, including design, development, and deployment.', 'ecommerce-platform-launch', 'E-commerce', 'e-commerce', 'FashionHub', '2024-03-10', 'https://example.com?fashionhub', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg', '<p>We partnered with FashionHub to launch a new e-commerce platform, providing end-to-end services from design and development to deployment. The platform offers a user-friendly interface, secure payment options, and an integrated inventory management system.</p>', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'E-commerce Platform Launch for FashionHub', 'Learn about our project to launch a new e-commerce platform for FashionHub, including design, development, and deployment.', 'e-commerce platform, e-commerce, FashionHub, platform launch, web development', '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `portfolios` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa4', 'Digital Marketing Campaign', 'A comprehensive digital marketing campaign for a new product launch, including SEO, SEM, and social media marketing.', 'digital-marketing-campaign', 'Marketing', 'marketing', 'Innovatech', '2024-04-05', 'https://example.com/?innovatech=new-product', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/portfolio-image-4.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-1.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-2.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-3.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/gallery-4.jpg', '<p>Innovatech engaged us to run a digital marketing campaign for their new product launch. The campaign included SEO to improve search engine rankings, SEM for targeted advertising, and social media marketing to increase brand awareness and engagement.</p>', '1', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Digital Marketing Campaign for Innovatech', 'Explore our digital marketing campaign for Innovatech\'s new product launch, including SEO, SEM, and social media marketing.', 'digital marketing, marketing campaign, Innovatech, SEO, SEM, social media marketing', '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `pricings`

DROP TABLE IF EXISTS `pricings`;
CREATE TABLE `pricings` (
  `pricing_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `included_features_list` text DEFAULT NULL,
  `excluded_features_list` text DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `other_label` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pricing_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `pricings`
INSERT INTO `pricings` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa6', 'Basic Plan', 'A starter plan for individuals looking to explore our services.', '$', '9', 'mo.', '0', 'Access to basic features, Email support, Community forums', 'No customizations, Limited storage, No priority support', 'Choose Basic', '#choose-basic', '1', '2', 'Best for individuals', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `pricings` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa7', 'Pro Plan', 'An advanced plan for professionals who need more features.', '$', '29', 'mo.', '1', 'Access to all features, Priority email support, Increased storage, Customizations', 'No phone support, No dedicated account manager', 'Choose Pro', '#choose-pro', '1', '4', 'Most popular', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `pricings` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa8', 'Enterprise Plan', 'A comprehensive plan for businesses that require advanced capabilities.', '$', '99', 'mo.', '0', 'All Pro features, Dedicated account manager, Phone support, Unlimited storage', 'No free trials', 'Contact Sales', '#contact-sales', '1', '6', 'Best for businesses', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `product_categories`

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `product_categories`
INSERT INTO `product_categories` VALUES ('7d513e35-f9c9-4901-9943-fa6037e3f484', 'Beauty and Personal Care', 'Beauty and Personal Care category', NULL, NULL, 'beauty-personal-care', '0', '6', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `product_categories` VALUES ('80585a47-1cc3-4a63-901b-7670708f0040', 'Health and Wellness', 'Health and Wellness category', NULL, NULL, 'health-wellness', '0', '10', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `product_categories` VALUES ('973e30cb-26e5-4fc2-bb12-d5750420f080', 'Books, Music, and Movies', 'Books, Music, and Movies category', NULL, NULL, 'books-music-movies', '0', '8', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `product_categories` VALUES ('abc9387d-dfbf-49cc-8781-f1e6de69d41d', 'Home Goods and Furniture', 'Home Goods and Furniture category', NULL, NULL, 'home-goods-furniture', '0', '12', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `product_categories` VALUES ('bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64', 'Apparel and Accessories', 'Apparel and Accessories category', NULL, NULL, 'apparel-accessories', '0', '2', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `product_categories` VALUES ('e2a2fc13-31da-4a4b-84fe-dfc5068d9faf', 'Electronics', 'Electronics category', NULL, NULL, 'electronics', '0', '2', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `products`

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `sale_price` varchar(255) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `price_note` varchar(100) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `product_image_1` varchar(255) DEFAULT NULL,
  `product_image_2` varchar(255) DEFAULT NULL,
  `product_image_3` varchar(255) DEFAULT NULL,
  `product_image_4` varchar(255) DEFAULT NULL,
  `product_video` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `specifications` text DEFAULT NULL,
  `attributes` text DEFAULT NULL,
  `seller_info` text DEFAULT NULL,
  `purchase_options` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`),
  KEY `slug` (`slug`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `products`
INSERT INTO `products` VALUES ('38623bd7-a99d-4624-a13a-0e7e58928421', 'Portable Bluetooth Speaker', 'Compact and powerful Bluetooth speaker with excellent sound quality.', 'Compact Bluetooth speaker for music on the go.', 'portable-bluetooth-speaker', 'e2a2fc13-31da-4a4b-84fe-dfc5068d9faf', '80585a47-1cc3-4a63-901b-7670708f0040', 'SoundMax', 'SPK101', '59.99', NULL, '$', 'per piece', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_front.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_side.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_back.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_closeup.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/speaker_demo.mp4', '1', '{\"battery_life\":\"10 hours\",\"bluetooth_version\":\"5.0\",\"dimensions\":\"5x3x2 inches\",\"color\":\"Black\"}', '{\"features\":[\"Waterproof\",\"Dustproof\"],\"included_items\":[\"Charging Cable\",\"User Manual\"],\"warranty\":\"1 Year Limited\"}', '{\"name\":\"TechShop\",\"contact_person\":\"Mike Smith\",\"phone\":\"+1234567891\",\"email\":\"sales@techshop.com\",\"location\":\"New York, USA\"}', '[{\"platform\":\"Amazon\",\"url\":\"https:\\/\\/amazon.com\\/product\\/?speaker\",\"price\":\"59.99\",\"availability\":\"In Stock\"}]', 'bluetooth,speaker,music', '1', '4', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Portable Bluetooth Speaker - SoundMax', 'Compact and powerful Bluetooth speaker for music lovers.', 'bluetooth speaker, portable speaker, music device', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `products` VALUES ('c16d8600-bc73-4d63-a7df-ae74d4f0b52a', 'Men\'s Casual Shirt', 'High-quality cotton shirt, perfect for casual wear.', 'Comfortable casual shirt.', 'mens-casual-shirt', 'bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64', 'e2a2fc13-31da-4a4b-84fe-dfc5068d9faf', 'BrandX', 'Model123', '49.99', '39.99', '$', 'per piece', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-front.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-side.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/shirt-closeup.jpg', NULL, NULL, '1', '{\"size\":\"M\",\"color\":\"Blue\",\"material\":\"Cotton\"}', '{\"features\":[\"Wrinkle-resistant\",\"Breathable\"],\"included_items\":[\"Shirt\",\"Tag\"]}', '{\"name\":\"Clothing Hub\",\"contact_person\":\"Jane Doe\",\"phone\":\"+123456789\",\"email\":\"sales@clothinghub.com\",\"location\":\"New York, USA\"}', '[{\"platform\":\"Amazon\",\"url\":\"https:\\/\\/amazon.com\\/?mens-shirt\",\"price\":\"39.99\",\"availability\":\"In Stock\"},{\"platform\":\"Etsy\",\"url\":\"https:\\/\\/etsy.com\\/?mens-shirt\",\"price\":\"44.99\",\"availability\":\"2-3 days\"}]', 'shirt, casual, blue', '1', '6', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Men\'s Casual Shirt - Blue', 'Buy Men\'s Casual Shirt in Blue for casual wear.', 'shirt, men, casual, blue', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `products` VALUES ('d1161e15-bcf2-44a1-9c0e-d74303048419', 'Stylish Summer Hat', 'A lightweight and stylish summer hat for outdoor activities.', 'Stylish summer hat for outdoor fun.', 'stylish-summer-hat', 'bd01cc3e-65c4-49d8-bc4e-b5d980fd2d64', 'e2a2fc13-31da-4a4b-84fe-dfc5068d9faf', 'FashionBrand', 'HAT123', '19.99', '14.99', '$', 'per piece', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_side.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_back.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/hat_closeup.jpg', NULL, NULL, '1', '{\"size\":\"One Size Fits All\",\"color\":\"Beige\",\"material\":\"Straw\",\"weight\":\"200g\",\"dimensions\":\"12x10x5 inches\"}', '{\"features\":[\"Breathable\",\"Lightweight\"],\"included_items\":[\"Hat\"],\"warranty\":\"No Warranty\",\"certifications\":[\"Eco-friendly\"]}', '{\"name\":\"Sunshine Store\",\"contact_person\":\"Jane Doe\",\"phone\":\"+1234567890\",\"email\":\"contact@sunshine.com\",\"location\":\"California, USA\"}', '[{\"platform\":\"Amazon\",\"url\":\"https:\\/\\/amazon.com\\/product\\/?hat\",\"price\":\"19.99\",\"availability\":\"In Stock\"},{\"platform\":\"Official Store\",\"url\":\"https:\\/\\/sunshine.com\\/product\\/?hat\",\"price\":\"14.99\",\"availability\":\"In Stock\"}]', 'summer,hat,outdoor', '1', '2', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Stylish Summer Hat - Sunshine Store', 'Lightweight and stylish summer hat, perfect for outdoor activities.', 'summer hat, fashion hat, outdoor wear', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `products` VALUES ('f6f3e4ce-7409-4a8e-a245-fa46a93e87e5', 'Wireless Bluetooth Earbuds', 'High-quality Bluetooth earbuds with noise cancellation.', 'Bluetooth earbuds for clear sound.', 'wireless-bluetooth-earbuds', 'e2a2fc13-31da-4a4b-84fe-dfc5068d9faf', '7d513e35-f9c9-4901-9943-fa6037e3f484', 'AudioTech', 'BT-1000', '79.99', '69.99', '$', NULL, 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-side.jpg', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-case.jpg', NULL, NULL, 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/products/earbuds-demo.mp4', '1', '{\"battery_life\":\"12 hours\",\"connectivity\":\"Bluetooth 5.0\",\"weight\":\"50g\"}', '{\"features\":[\"Noise Cancellation\",\"Water-resistant\"],\"included_items\":[\"Earbuds\",\"Charging Case\",\"Manual\"],\"warranty\":\"1 Year\"}', '{\"name\":\"ElectroMart\",\"contact_person\":\"John Smith\",\"phone\":\"+987654321\",\"email\":\"info@electromart.com\",\"location\":\"Los Angeles, USA\"}', '[{\"platform\":\"Best Buy\",\"url\":\"https:\\/\\/bestbuy.com\\/?earbuds\",\"price\":\"79.99\",\"availability\":\"In Stock\"}]', 'earbuds, bluetooth, wireless', '1', '8', '0', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, 'Wireless Bluetooth Earbuds', 'Experience crystal-clear sound with our wireless earbuds.', 'earbuds, bluetooth, wireless', '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `resumes`

DROP TABLE IF EXISTS `resumes`;
CREATE TABLE `resumes` (
  `resume_id` varchar(36) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `total_views` int(11) DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`resume_id`),
  KEY `full_name` (`full_name`),
  KEY `title` (`title`),
  KEY `summary` (`summary`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `resumes`
INSERT INTO `resumes` VALUES ('03f453e8-d90b-45d8-8e64-efce539f3149', 'Mary Jane', 'Software Engineer', 'Experienced software engineer with a passion for developing innovative programs that expedite the efficiency and effectiveness of organizational success.', 'john.doe@example.com', '123-456-7890', '123 Main St, Anytown, USA', 'https://example.com?johndoe', 'https://www.linkedin.com/in/?johndoe', 'https://github.com/?johndoe', 'https://twitter.com/?johndoe', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/resume-profile.jpg', 'public/uploads/cv_files/john_doe_cv.pdf', '1', '0', 'Mary Jane - Software Engineer', 'Mary Jane is an experienced software engineer with a passion for developing innovative programs.', 'Mary Jane, Software Engineer, Developer, Programmer', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);


-- Table structure for table `roles`

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `role_description` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `roles`
INSERT INTO `roles` VALUES ('57fb025a-f75d-4878-bb76-a2635d120f0f', 'Admin', 'Admin role', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `roles` VALUES ('9667c1c9-fa81-4f90-aa88-882f30497f21', 'Manager', 'Manager Role', '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `services`

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `service_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`service_id`),
  KEY `title` (`title`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `services`
INSERT INTO `services` VALUES ('0e8823f8-aefa-4383-9d27-d1f79cd38bdd', 'Portfolio Management', 'Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit', NULL, 'ri-team-line', NULL, NULL, '2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `services` VALUES ('92c59de9-0d56-4dda-90bc-d4cbfb0f48be', 'Productivity Improvement', 'Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.', NULL, 'ri-line-chart-fill', NULL, NULL, '4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `services` VALUES ('9715484d-8314-4534-9b54-10a8e381956b', 'Financial Consulting', 'Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.', NULL, 'ri-hand-coin-line', NULL, NULL, '6', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `services` VALUES ('df936c75-dbb0-413a-bf52-c31f3eea5dc7', 'Corporate Strategy', 'Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.', NULL, 'ri-bar-chart-box-line', NULL, NULL, '8', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `site_stats`

DROP TABLE IF EXISTS `site_stats`;
CREATE TABLE `site_stats` (
  `site_stat_id` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser_type` varchar(255) DEFAULT NULL,
  `page_type` varchar(50) DEFAULT NULL,
  `page_visited_id` varchar(255) DEFAULT NULL,
  `page_visited_url` text DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `request_method` varchar(50) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `screen_resolution` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `other_params` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`site_stat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `site_stats`
INSERT INTO `site_stats` VALUES ('07a0e996-7f0d-4159-9133-1fac57a7b507', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sitemap.xml', 'http://localhost:8080/apps/ci-igniter-cms/sitemap.xml', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'f430a93804a10d0693cf2b773786c505', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:53:29');
INSERT INTO `site_stats` VALUES ('23de34c4-a950-4f11-8acb-7542f0bf6392', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', '', '200', '', 'a9fa694d2abbd767fdd05d87d086d40e', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-23 16:48:32');
INSERT INTO `site_stats` VALUES ('2bd47f74-b615-4827-b197-111bec66bb40', '172.16.0.1', 'mobile', 'Edge', 'Page', '8431fe23-51bd-4db9-83b4-8fe86242b6a5', 'http://localhost:8080/apps/ci-igniter-cms/products', 'POST', '204', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'e84135a5-3255-452c-8fe8-473a5ae6da7d', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-05-21 15:44:56');
INSERT INTO `site_stats` VALUES ('319d6a79-de81-476c-bdf1-f1b14101e170', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost:8080/apps/ci-igniter-cms/', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '6407abfc2ee48b457039f10fe329b4da', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 13:42:34');
INSERT INTO `site_stats` VALUES ('3212fc1a-9c16-4e4f-93ed-4973be784c87', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fcms%2Fblogs%2Fnew-blog', '200', '', '569bc0b5cd59ac863ba28a83f469d55b', 'POST', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-23 20:13:19');
INSERT INTO `site_stats` VALUES ('38bb5ddf-3b9d-4b2a-893a-f7d08b6f2041', '10.0.0.1', 'tablet', 'Firefox', 'Page', '4f490b5c-2da4-4471-8b3b-cc81138ab377', 'http://localhost:8080/apps/ci-igniter-cms/contact', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '9520e32e-1aca-469f-b813-5db4d43935d0', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-05-22 15:44:56');
INSERT INTO `site_stats` VALUES ('395edd13-ba37-4f25-9731-7b5430b78769', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'search?q=Website', 'http://localhost:8080/apps/ci-igniter-cms/search', 'http://localhost:8080/apps/ci-igniter-cms/search?q=Website+Redesign', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '94a7efb5e76848c60fc531129dc261c6', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:43:58');
INSERT INTO `site_stats` VALUES ('48f42bff-4b2b-4601-9dcd-7795db461ded', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'robots.txt', 'http://localhost:8080/apps/ci-igniter-cms/robots.txt', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '0a43efd66d42ddcfbafa9375c3aed2b8', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 18:03:08');
INSERT INTO `site_stats` VALUES ('50cb60e7-0900-486c-b004-cdcd4c5e977f', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost:8080/apps/ci-igniter-cms/', 'http://localhost:8080/apps/', '200', '', '94a7efb5e76848c60fc531129dc261c6', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:40:23');
INSERT INTO `site_stats` VALUES ('5f071a09-7a0a-4c2e-bff9-5a5d67d305cd', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'ff66946d-fd4f-47f3-8811-6270df51fe27', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'a73f9c61-7c07-4e7b-8cc5-64ca95f13d26', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-02-01 00:00:00');
INSERT INTO `site_stats` VALUES ('6632b929-2afc-40ce-8bd1-aef7e6961d02', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fcms%2Fblogs%2Fnew-blog', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', '', '200', '', '797b5a12726a3a5e58e1ca313696654a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-25 20:01:15');
INSERT INTO `site_stats` VALUES ('6a66c553-2b07-418f-9596-21a0465fa79b', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sitemap.xml', 'http://localhost:8080/apps/ci-igniter-cms/sitemap.xml', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '0a43efd66d42ddcfbafa9375c3aed2b8', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 18:02:22');
INSERT INTO `site_stats` VALUES ('6ff758e4-7fe8-4821-9a3f-bf52ac73978d', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'd1aee7b0-d910-491d-9df0-7885bbc0c88d', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b9b83bc0-3b3e-4033-a454-7557fc0ff254', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-01-01 00:00:00');
INSERT INTO `site_stats` VALUES ('764ae33e-0630-45b8-a819-d2a9d20bbda7', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'c64cffb2-6202-40da-972b-7e313bd30169', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '13bff955-59b5-4330-92ef-78f53258a414', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-03-01 00:00:00');
INSERT INTO `site_stats` VALUES ('77596869-cd46-416e-b19a-18238ef54465', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'bf8b5f4a-e43a-4cc6-a496-9bda7fc26b46', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '64baa4ea-246a-4d2b-87da-a0b79ec0a0d2', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-04-01 00:00:00');
INSERT INTO `site_stats` VALUES ('7b1d48c2-ae0d-4720-9a3f-9572a8a57c88', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '7b5faacf-454b-442b-9d8b-02d1b2148fe8', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '02202e92-c580-4944-bec6-f57d2e574799', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2025-05-17 15:44:56');
INSERT INTO `site_stats` VALUES ('8040c6e7-2d60-4d68-9af8-7449fe99b09e', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '50e8ff72-0853-4911-8770-e2248ba28f71', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '77971713-ef89-4811-accb-87bf85dab57c', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2024-12-01 00:00:00');
INSERT INTO `site_stats` VALUES ('83750988-e288-454f-a244-bb46b14efb51', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '6613751c-90a0-43a7-8095-24e302058fc6', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '93f928d6-b03c-4819-9564-bf87f3060dd1', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-02-01 00:00:00');
INSERT INTO `site_stats` VALUES ('97ebadd0-ae74-487b-a590-8820edf0229b', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'rss', 'http://localhost:8080/apps/ci-igniter-cms/rss', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '0a43efd66d42ddcfbafa9375c3aed2b8', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 18:03:27');
INSERT INTO `site_stats` VALUES ('98f2f240-46c9-4964-a2e0-123557fb0580', '192.168.1.1', 'mobile', 'Safari', 'Page', '0f7cd7bc-919d-4a98-8a8f-cd5a1bfe8b35', 'http://localhost:8080/apps/ci-igniter-cms/about', 'POST', '201', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'session-683097f8d27e0', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2025-05-23 15:44:56');
INSERT INTO `site_stats` VALUES ('a58406f7-92e4-40a9-8afc-70c1829bf744', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sitemap.xml', 'http://localhost:8080/apps/ci-igniter-cms/sitemap.xml', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '94a7efb5e76848c60fc531129dc261c6', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:44:28');
INSERT INTO `site_stats` VALUES ('a5eb6369-3725-4f42-9cbf-ef76ae7cef2d', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fcms%2Fblogs%2Fnew-blog', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/account/cms/blogs', '200', '', '569bc0b5cd59ac863ba28a83f469d55b', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-23 20:13:01');
INSERT INTO `site_stats` VALUES ('a7905418-f23f-4c5d-8a9a-ddae1390f88e', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fadmin%2Fconfigurations', '200', '', '0747ae735f6ed9ad5f9c3c3e6bbd86fa', 'POST', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 12:01:59');
INSERT INTO `site_stats` VALUES ('a9babc75-0dd3-45e7-abb5-0085dab8a411', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fadmin%2Fconfigurations', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/account/cms/blogs/new-blog', '200', '', '0747ae735f6ed9ad5f9c3c3e6bbd86fa', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 12:01:41');
INSERT INTO `site_stats` VALUES ('acdf27ba-ed5b-4ddd-b8a4-0b7882fefc48', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/', '200', '', '94a7efb5e76848c60fc531129dc261c6', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:40:39');
INSERT INTO `site_stats` VALUES ('b5e09325-db07-48d4-a96c-20ee08b5d841', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost:8080/apps/ci-igniter-cms/', 'http://localhost:8080/apps/ci-igniter-cms/account/cms/blogs/new-blog', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'ed045ee27bd040aeb8a7e76df9353827', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 19:13:12');
INSERT INTO `site_stats` VALUES ('bd498a4f-f53e-4e3d-8ed7-e82f65419db6', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'search?q=Website+Redesign', 'http://localhost:8080/apps/ci-igniter-cms/search', 'http://localhost:8080/apps/ci-igniter-cms/', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '94a7efb5e76848c60fc531129dc261c6', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 17:43:45');
INSERT INTO `site_stats` VALUES ('d4307033-06de-41cb-85e3-e8888c6e3ba0', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fadmin%2Fconfigurations', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', '', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'a3e7de5440597eff75a0cc6b11026d46', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-26 12:13:14');
INSERT INTO `site_stats` VALUES ('d4a7160f-262c-4bd3-8a4e-adf983f6e77a', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'beb1ee78-a43b-4b12-953c-403c6965b914', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '0c80059e-dc84-45b1-94bf-5b2606788fd1', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-05-20 15:44:56');
INSERT INTO `site_stats` VALUES ('d4d65c12-1bba-4092-9e3c-11122c938c2f', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '3071e50f-f81e-4caf-8aea-4c2aa029c7b2', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '48c2238d-72fa-46d4-afa7-7577fb38ae67', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2024-11-01 00:00:00');
INSERT INTO `site_stats` VALUES ('d6b3ff4f-4a43-488b-942e-d76f3164f8d6', '192.168.2.1', 'mobile', 'Opera', 'Page', '920da556-c535-48a1-a03b-ad70fc01dd75', 'http://localhost:8080/apps/ci-igniter-cms/blog', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'f7fc320a-0754-4069-bc67-60e76b001357', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2025-05-19 15:44:56');
INSERT INTO `site_stats` VALUES ('dce9c382-3293-46a2-ae80-a90c1f1a5c20', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in', 'http://localhost:8080/apps/ci-igniter-cms/sign-in?returnUrl=http%3A%2F%2Flocalhost%3A8080%2Fapps%2Fci-igniter-cms%2Faccount%2Fcms%2Fblogs%2Fnew-blog', '200', '', '797b5a12726a3a5e58e1ca313696654a', 'POST', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-25 20:01:44');
INSERT INTO `site_stats` VALUES ('dfae1a3f-73fb-4015-baa0-f88ce87f403b', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost:8080/apps/ci-igniter-cms/', '', '200', '', 'a9fa694d2abbd767fdd05d87d086d40e', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', NULL, '2025-05-23 16:47:22');
INSERT INTO `site_stats` VALUES ('e63d6717-8675-4e0d-ae8a-4edf829e2434', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '9dbe40b9-6e79-4902-8855-fa8de31ed45f', 'http://localhost:8080/apps/ci-igniter-cms/', 'GET', '200', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '27669ffe-82ad-4074-b5ac-51cbb199cfb1', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2025-05-18 15:44:56');


-- Table structure for table `skills`

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `skill_id` varchar(36) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `proficiency_level` int(3) DEFAULT NULL,
  `years_experience` float DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `created_by` varchar(36) DEFAULT NULL,
  `updated_by` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`skill_id`),
  KEY `name` (`name`),
  KEY `description` (`description`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `skills`
INSERT INTO `skills` VALUES ('0635261d-6dbe-4b85-bb11-dd19e631cefb', 'Technical', 'Web Development', 'HTML & CSS', '0', '6', 'Expert in creating responsive and accessible web designs using HTML and CSS.', 'ri-html5-line', '3', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `skills` VALUES ('150f5395-1666-4303-a8c7-c6196e44d9c3', 'Technical', 'Programming Languages', 'Python', '0', '4', 'Proficient in developing data analysis and machine learning applications using Python.', 'ri-python-line', '2', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `skills` VALUES ('515989df-e800-429c-b789-7ff76a012494', 'Technical', 'Databases', 'SQL', '0', '4', 'Experienced in designing and managing relational databases using SQL.', 'ri-database-2-line', '5', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `skills` VALUES ('5745ccc8-caab-47d8-8981-3f952a99d35c', 'Technical', 'Frameworks', 'React', '0', '3', 'Skilled in building dynamic and high-performance web applications using React.', 'ri-reactjs-line', '4', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `skills` VALUES ('a25fee93-f56f-416f-8d1d-3700484c0ca6', 'Technical', 'DevOps', 'Docker', '0', '2', 'Proficient in containerizing applications and managing containerized environments using Docker.', 'ri-docker-line', '6', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);
INSERT INTO `skills` VALUES ('cebeb2de-4222-4cb5-b230-e551b270c3ae', 'Technical', 'Programming Languages', 'JavaScript', '0', '5', 'Experienced in developing web applications using JavaScript.', 'ri-robot-2-line', '1', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, NULL);


-- Table structure for table `socials`

DROP TABLE IF EXISTS `socials`;
CREATE TABLE `socials` (
  `social_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `order` int(11) DEFAULT 10,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`social_id`),
  KEY `name` (`name`),
  KEY `link` (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `socials`
INSERT INTO `socials` VALUES ('b01431ab-814f-4809-920f-dde53fe5c1d6', 'Instagram', 'ri-instagram-line', 'https://www.instagram.com/yourprofile', '1', '8', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `socials` VALUES ('b5ea5158-9af9-4f7d-afbe-7c2d517f8936', 'LinkedIn', 'ri-linkedin-fill', 'https://www.linkedin.com/in/yourprofile', '1', '6', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `socials` VALUES ('ca514840-7670-4d9a-ba48-5ebf87d3c700', 'Facebook', 'ri-facebook-fill', 'https://www.facebook.com/yourpage', '1', '2', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `socials` VALUES ('f16a7d6d-f44e-47db-b61d-8a478a6d022d', 'Twitter', 'ri-twitter-x-line', 'https://www.twitter.com/yourprofile', '1', '4', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `subscribers`

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `subscriber_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`subscriber_id`),
  UNIQUE KEY `subscriber_id` (`subscriber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `subscribers`
INSERT INTO `subscribers` VALUES ('60ae1b2c-2be9-4317-aff4-b55997038018', 'Mary Jane', 'subscriber@example.com', '192.168.1.1', 'GM', '1', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `subscribers` VALUES ('8160d165-5cc8-490e-8f9c-86e832ca4216', 'John Doe', 'user@example.com', '192.168.1.1', 'GM', '1', '2025-05-23 16:44:57', '2025-05-23 16:44:57');
INSERT INTO `subscribers` VALUES ('b041ebe8-dde4-48fe-8cd3-01d77c2685be', 'Mr Foo', 'example@subscriber.com', '192.168.1.1', 'GM', '0', '2025-05-23 16:44:57', '2025-05-23 16:44:57');


-- Table structure for table `teams`

DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `team_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `social_link_1` varchar(255) DEFAULT NULL,
  `social_link_2` varchar(255) DEFAULT NULL,
  `social_link_3` varchar(255) DEFAULT NULL,
  `social_link_4` varchar(255) DEFAULT NULL,
  `social_link_5` varchar(255) DEFAULT NULL,
  `social_link_6` varchar(255) DEFAULT NULL,
  `details_link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`team_id`),
  KEY `name` (`name`),
  KEY `title` (`title`),
  KEY `image` (`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `teams`
INSERT INTO `teams` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa1', 'Bob Johnson', 'CEO', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-1.jpg', 'Bob is the visionary leader of our company, with over 20 years of experience in the industry.', 'https://www.facebook.com/bob-smith', 'https://twitter.com/bobsmith', 'https://instagram.com/bobsmith', '', 'https://github.com/bobsmith', '', 'https://example.com/team/bob-smith', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `teams` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa2', 'Alice Smith', 'CTO', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-2.jpg', 'Alice is the tech guru behind our innovative solutions, leading the development team with expertise.', '', 'https://twitter.com/alicejohnson', 'https://instagram.com/alicejohnson', 'https://www.linkedin.com/in/alicejohnson', 'https://github.com/alicejohnson', '', 'https://example.com/team/alice-johnson', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `teams` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa3', 'David White', 'CFO', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-3.jpg', 'David manages the financial health of our company, ensuring sustainable growth and profitability.', 'https://www.facebook.com/davidwhite', 'https://twitter.com/davidwhite', '', 'https://www.linkedin.com/in/davidwhite', 'https://github.com/davidwhite', '', 'https://example.com/team/david-white', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `teams` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa4', 'Carol Brown', 'COO', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/team-4.jpg', 'Carol oversees the company\'s operations, ensuring efficiency and excellence in all we do.', 'https://www.facebook.com/carolbrown', 'https://twitter.com/carolbrown', 'https://instagram.com/carolbrown', 'https://www.linkedin.com/in/carolbrown', '', '', 'https://example.com/team/carol-brown', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `testimonials`

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `testimonial_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `testimonial` text NOT NULL,
  `rating` int(5) NOT NULL DEFAULT 0,
  `link` varchar(255) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`testimonial_id`),
  KEY `name` (`name`),
  KEY `title` (`title`),
  KEY `testimonial` (`testimonial`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `testimonials`
INSERT INTO `testimonials` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa1', 'Emily Clark', 'Marketing Director', 'MarketMakers Inc.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-2.jpg', 'This company provided exceptional service and helped us achieve our marketing goals with their innovative solutions.', '5', 'https://marketmakers.com', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `testimonials` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa2', 'Franklin Harris', 'CEO', 'TechSolutions Ltd.', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-1.jpg', 'Their team is highly skilled and delivered a top-notch product that exceeded our expectations.', '5', 'https://techsolutions.com', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `testimonials` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa3', 'Grace Lee', 'Product Manager', 'Innovatech', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-3.jpg', 'We were impressed with their attention to detail and the quality of their work. Highly recommend!', '4', 'https://innovatech.com', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');
INSERT INTO `testimonials` VALUES ('3fa85f64-5717-4562-b3fc-2c963f66afa4', 'Henry Adams', 'CTO', 'WebWorks', 'public/uploads/file-uploads/admin_8J0IM/01-12-2024/testimonials-4.jpg', 'Their expertise in web development is unmatched. We are extremely satisfied with the end result.', '5', 'https://webworks.com', '1', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `themes`

DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `theme_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `other_color` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `theme_url` varchar(255) DEFAULT NULL,
  `theme_bg_image` varchar(255) DEFAULT NULL,
  `theme_bg_video` varchar(255) DEFAULT NULL,
  `footer_copyright` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `selected` tinyint(1) DEFAULT 0,
  `deletable` int(11) NOT NULL DEFAULT 1,
  `home_page` varchar(255) NOT NULL DEFAULT 'HomePage',
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `themes`
INSERT INTO `themes` VALUES ('b5b9668c-3e37-4d35-adf0-c7601dfcb04f', 'Default', '/default', '#212529', '#0d6efd', '#444342', 'public/front-end/themes/default/assets/images/default-theme.png', 'https://startbootstrap.com/previews/modern-business', '', '', '<p>Copyright &copy; Igniter CMS 2025</p>', 'Business & Corporate', 'Portfolio & Resume', '1', '0', 'HomePage', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', NULL, '2025-05-23 16:44:56', '2025-05-23 16:44:56');


-- Table structure for table `translations`

DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations` (
  `translation_id` varchar(50) NOT NULL,
  `language` varchar(10) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `translations`
INSERT INTO `translations` VALUES ('3c553def-c57b-4071-8d3b-3b0fdd3f7702', 'ar', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2025-05-23 03:44:56', '2025-05-23 16:44:56');
INSERT INTO `translations` VALUES ('d5adc3ee-27f4-49d1-b6f3-a9e04450ed7f', 'en', 'b59363c6-08fa-46c4-9d99-d37b3eb18be9', '2025-05-23 03:44:56', '2025-05-23 16:44:56');


-- Table structure for table `users`

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'public/uploads/file-uploads/default/default-profile.png',
  `profile_picture` varchar(255) NOT NULL DEFAULT '',
  `twitter_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `about_summary` varchar(500) DEFAULT NULL,
  `upload_directory` varchar(255) NOT NULL DEFAULT 'user_Tre8Y',
  `password_change_required` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
INSERT INTO `users` VALUES ('4d004b40-f123-4865-b913-5d2d9123daa5', 'Manager', 'User', 'manager', 'manager@example.com', '$2y$10$9zi2Qw9FUVb2PSQKRmtRWecNSRNrpdMd8ywdm3jAb4u4WU9zpn/2y', '1', 'Manager', 'public/uploads/file-uploads/default/default-profile.png', 'https://twitter..com/?manager-user', 'https://www.facebook..com/?manager-user', 'https://instagram..com/?manager-user', 'https://www.linkedin.com/in/?manager-user', 'Hello! I\'m Manager User, the manager of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'manager_10BYZL', '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `users` VALUES ('4d6168a7-4b32-4f84-bff9-6603e23ceb03', 'Test', 'User', 'test', 'test@example.com', '$2y$10$bEyuZUnhujjO556erPHH8unenlZMMAtOxyobeNe8RZTZD7r2a6Qb2', '0', 'Manager', 'public/uploads/file-uploads/default/default-profile.png', 'https://twitter..com/?test-user', 'https://www.facebook..com/?test-user', 'https://instagram..com/?test-user', 'https://www.linkedin.com/in/?test-user', 'Hello! I\'m Manager User, the test of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'test_10BYZL', '0', '2025-05-23 16:44:55', '2025-05-23 16:44:55');
INSERT INTO `users` VALUES ('b59363c6-08fa-46c4-9d99-d37b3eb18be9', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$8xMiKtMogDabAW0cKuxWOO94Hk4d8NxkF.g7qEXB/rDtdWOOm1ePe', '1', 'Admin', 'public/uploads/file-uploads/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', '1', '2025-05-23 16:44:55', '2025-05-23 16:44:55');


-- Table structure for table `whitelisted_ips`

DROP TABLE IF EXISTS `whitelisted_ips`;
CREATE TABLE `whitelisted_ips` (
  `whitelisted_ip_id` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`whitelisted_ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `whitelisted_ips`
INSERT INTO `whitelisted_ips` VALUES ('2cbf2b9b-fef7-42f4-9c17-74b35e9b3c3d', '203.0.113.0', 'Voluptate nesciunt laborum Commodo sint', '2025-05-26 20:26:13', '2025-05-26 20:26:13');

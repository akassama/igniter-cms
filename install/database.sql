-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2026 at 07:51 AM
-- Server version: 8.0.45
-- PHP Version: 8.2.30

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
  `activity_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `activity_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auditable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auditable_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `old_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `new_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `activity_by`, `activity_type`, `activity`, `ip_address`, `country`, `device`, `url`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `updated_at`, `created_at`) VALUES
('31875E76-98A6-4B02-A664-F257AE028934', 'killi@ucl.ac.uk', 'comment_submitted', 'Comment Submitted: Comment submitted by: killi@ucl.ac.uk on page: CE07D948-FF00-4A3C-8735-A4F2AF219EDE', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-31 18:00:52', '2026-03-31 18:00:52'),
('396ACAC4-CD39-4606-8B3E-CA3506A1B625', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'user_login', 'User Login: User logged in with id: B83E35F4-6C79-4636-A36D-D3C55D89598B', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '', '', '', '', '', '2026-03-31 17:28:39', '2026-03-31 17:28:39'),
('50E20302-E7FF-4FEC-A029-1114A874D658', 'admin@example.com', 'comment_submitted', 'Comment Submitted: Comment submitted by: admin@example.com on page: CE07D948-FF00-4A3C-8735-A4F2AF219EDE', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-03-31 18:05:21', '2026-03-31 18:05:21'),
('6ED0F6E0-9DE2-4622-B587-E7DBE3581796', NULL, 'user_logout', 'User Logout: User with id:  logged out.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-04-01 12:36:24', '2026-04-01 12:36:24'),
('7D50CA88-4A3E-4B76-89D2-751C28B1143C', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'user_login', 'User Login: User logged in with id: B83E35F4-6C79-4636-A36D-D3C55D89598B', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-04-02 09:33:17', '2026-04-02 09:33:17'),
('AD3622A7-C033-44DF-B16D-4E1AD4CDBEDB', '6BE452D2-17C3-4EB4-A46E-F025DD996996', 'user_logout', 'User Logout: User with id: 6BE452D2-17C3-4EB4-A46E-F025DD996996 logged out.', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-03-31 17:28:34', '2026-03-31 17:28:34'),
('D4C97E37-5857-4EBB-A0A9-56C3BC989523', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'blog_created', 'Blog Created: Blog created: with idCE07D948-FF00-4A3C-8735-A4F2AF219EDE', '127.0.0.1', 'Unknown', 'Chrome on Windows 10', '/apps/igniter-cms/account/cms/blogs/new-blog', 'App\\Models\\BlogsModel', 'CE07D948-FF00-4A3C-8735-A4F2AF219EDE', 'null', NULL, '2026-03-31 17:59:21', '2026-03-31 17:59:21'),
('F01484DE-0E17-4A48-B62F-0DA8CDA9C445', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'user_logout', 'User Logout: User with id: B83E35F4-6C79-4636-A36D-D3C55D89598B logged out.', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '/apps/igniter-cms/sign-out', NULL, NULL, 'null', NULL, '2026-04-02 09:33:38', '2026-04-02 09:33:38'),
('F5EB14A5-817F-49D0-8700-0F0973AAAD57', NULL, 'search', 'Search: Search made for: fatu', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-04-02 09:16:21', '2026-04-02 09:16:21'),
('F7E09084-498C-46F8-9875-1498383E4E31', NULL, 'search', 'Search: Search made for: fatu', '127.0.0.1', 'Unknown', 'Edge on Windows 10', '', '', '', '', '', '2026-04-02 10:03:05', '2026-04-02 10:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `api_accesses`
--

CREATE TABLE `api_accesses` (
  `api_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_accesses`
--

INSERT INTO `api_accesses` (`api_id`, `api_key`, `assigned_to`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('B3D5C971-9265-4956-966F-68E9DB9D13C3', 'a380be69e92f6e00c29b8b9220e7c815c21320a23cfc8b04c4cdc1811ff45e9c', 'default', 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `api_calls_tracker`
--

CREATE TABLE `api_calls_tracker` (
  `api_call_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_modules`
--

CREATE TABLE `app_modules` (
  `app_module_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `module_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `module_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_search_terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_roles` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `module_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_modules`
--

INSERT INTO `app_modules` (`app_module_id`, `module_name`, `module_description`, `module_search_terms`, `module_roles`, `module_link`, `updated_at`, `created_at`) VALUES
('04935AD5-11AD-4030-A159-8657E8364433', 'Plugins', 'Manage plugins', 'plugins,extensions,package,extensions,paquet,extensiones,paquete,إضافات,حزمة,প্লাগইন,এক্সটেনশন,প্যাকেজ,plug-ins,erweiterungen,प्लगइन,एक्सटेंशन,पैकेज,plugin,estensioni,パッケージ,plugins,extensões,pacote,плагины,расширения,пакет,eklentiler,uzantılar,paket,پلگ ا', 'Admin', 'account/plugins', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('118B9BB0-903B-40B5-9B80-7067CF285DDB', 'Theme Revisions', 'Manage theme revisions', 'themes,revisions,versions,thèmes,révisions,versions,revisiones,versiones,مراجعات السمات,إصدارات,থিম সংশোধন,সংস্করণ,themen-revisionen,versionen,थीम संशोधन,संस्करण,revisioni temi,versioni,テーマリビジョン,バージョン,revisões de temas,versões,ревізії тем,версії,tema revi', 'Admin,Manager,User', 'account/appearance/theme-editor/revisions', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('25C5C018-0BF3-40C8-8706-928A5CFF3E64', 'Blocked IP\'s', 'View blocked ip addresses', 'block,blacklist,security,deny,ip,bloquer,liste noire,sécurité,refuser,bloquear,lista negra,seguridad,denegar,حظر,قائمة سوداء,أمان,رفض,ব্লক,কালো তালিকা,নিরাপত্তা,অস্বীকার,blockieren,sperrliste,sicherheit,verweigern,ब्लॉक,ब्लैकलिस्ट,सुरक्षा,अस्वीकार,bloccar', 'Admin', 'account/admin/blocked-ips', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('2B2C4633-35D8-412B-9CF1-60E0F7D04CE8', 'Backup', 'Manage backups', 'backup,restore,database,sauvegarde,restaurer,base de données,copia de seguridad,restaurar,base de datos,نسخ احتياطي,استعادة,قاعدة بيانات,ব্যাকআপ,পুনরুদ্ধার,ডাটাবেস,backup,wiederherstellen,datenbank,बैकअप,पुनर्स्थापित करना,डेटाबेस,backup,ripristinare, data', 'Admin', 'account/admin/backups', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('2EB3F62F-8F26-4FFD-AA89-17D422A1BAC2', 'Blogs', 'Manage blogs, posts, or articles', 'blogs,articles,posts,blogs,articles,blogs,artículos,مدونات,مقالات,ব্লগ,নিবন্ধ,blogs,artikel,ब्लॉग,लेख,blog,articoli,ブログ,記事,blogs,artigos,блоги,статьи,bloglar,makaleler,بلاگز,مضامین,blog,bài viết,博客,文章', 'Admin,Manager,User', 'account/cms/blogs', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('36077EED-AB1B-4D87-8A1B-DCDA287033CA', 'Pages', 'Manage pages', 'pages,content,publish,pages,contenu,páginas,contenido,صفحات,محتوى,পৃষ্ঠা,বিষয়বস্তু,seiten,inhalt,पृष्ठ,सामग्री,pagine,contenuto,ページ,コンテンツ,páginas,conteúdo,страницы,контент,sayfalar,içerik,صفحات,مواد,trang,nội dung,页面,内容', 'Admin,Manager,User', 'account/cms/pages', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('3B2553A0-4386-4EE5-89C0-555977C66AB3', 'Users', 'Manage application users', 'users,accounts,people,utilisateurs,comptes,personnes,usuarios,cuentas,personas,مستخدمين,حسابات,أشخاص,ব্যবহারকারী,অ্যাকাউন্ট,মানুষ,benutzer,konten,leute,उपयोगकर्ता,खाते,लोग,utenti,account,persone,ユーザー,アカウント,人々,usuários,contas,pessoas,пользователи,аккаунты,', 'Admin', 'account/admin/users', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('5D09CAAC-8726-4D91-BA76-36254F9956F7', 'AI', 'AI chatbot', 'artificial intelligence,chat gpt,claude,gemini,deepseek,intelligence artificielle,chat gpt,claude,gemini,deepseek,inteligencia artificial,chat gpt,claude,gemini,deepseek,الذكاء الاصطناعي,شات جي بي تي,كلود,جيميني,ডিপসিক,কৃত্রিম বুদ্ধিমত্তা,চ্যাট জিপিটি,ক্ল', 'Admin,Manager,User', 'account/ask-ai', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('65FAADA9-407B-45BA-923D-7536148C52B1', 'Themes', 'Manage themes', 'themes,appearance,design,thèmes,apparence,thèmes,apariencia,diseño,سمات,مظهر,থিম,চেহারা,themen,aussehen,थीम,दिखावट,temi,aspetto,テーマ,外観,temas,aparência,темы,внешний вид,temalar,görünüm,تھیمز,ظاہری شکل,chủ đề,diện mạo,主题,外观', 'Admin,Manager,User', 'account/appearance/themes', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('6D336D63-D810-4B70-A769-0289C68B0648', 'Booking Forms', 'Manage booking forms', 'booking,appointments,forms,réservation,rendez-vous,reservas,citas,حجوزات,مواعيد,বুকিং,অ্যাপয়েন্টমেন্ট,buchung,termine,बुकिंग,अपॉइंटमेंट,prenotazione,appuntamenti,予約,アポイントメント,reservas,compromissos,бронирование,встречи,rezervasyon,randevular,بکنگ,ملاقات​​,', 'Admin,Manager,User', 'account/forms/booking-forms', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('7777FA88-C705-4C96-A9DD-A510D9653978', 'Codes', 'Manage codes', 'codes,references,identifiers,codes,références,identifiants,códigos,referencias,identificadores,رموز,مراجع,معرفات,কোড,রেফারেন্স,আইডি,codes,referenzen,identifikatoren,कोड,संदर्भ,पहचानकर्ता,codici,riferimenti,identificatori,コード,参照,識別子,códigos,referências,ide', 'Admin', 'account/admin/codes', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('7AC3A2D5-8882-48BC-938C-98B1E77AAA2E', 'File Management', 'Manage files and media (images, videos, documents)', 'files,media,storage,fichiers,média,archivos,medios,ملفات,وسائط,ফাইল,মিডিয়া,dateien,medien,फ़ाइलें,मीडिया,file,media,ファイル,メディア,arquivos,mídia,файлы,медиа,dosyalar,medya,فائلیں,میڈیا,tệp,phương tiện,文件,媒体', 'Admin,Manager,User', 'account/file-manager', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('83DB3C92-5D04-4EFF-861F-7184212814D3', 'Account Details', 'Update account details', 'account,profile,settings,compte,profil,paramètres,cuenta,perfil,configuración,حساب,ملف,إعدادات,অ্যাকাউন্ট,প্রোফাইল,সেটিংস,konto,profil,einstellungen,खाता,प्रोफ़ाइल,सेटिंग्स,account,profilo,impostazioni,アカウント,プロフィール,設定,conta,perfil,configurações,аккаунт,пр', 'Admin,Manager,User', 'account/settings/update-details', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('8A753F7E-6E50-476D-BB4C-55A35E34E608', 'Contact Forms', 'Manage contact forms', 'contact,forms,formulaires de contact,formularios de contacto,نماذج الاتصال,যোগাযোগ ফর্ম,kontaktformulare,संपर्क फॉर्म,moduli di contatto,お問い合わせフォーム,formulários de contato,контактные формы,iletişim formları,فارمز رابطہ,biểu mẫu liên hệ,联系表单', 'Admin,Manager,User', 'account/forms/contact-forms', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('8FD1CA9A-1140-4D87-A6A4-37C534B21C16', 'Visit Stats', 'View visit statistics and charts', 'stats,visits,analytics,statistiques,visites,analytique,estadísticas,visitas,análisis,إحصائيات,زيارات,تحليلات,পরিসংখ্যান,পরিদর্শন,বিশ্লেষণ,statistiken,besuche,analytik,सांख्यिकी,दौरा,विश्लेषण,statistiche,visite,analisi,統計,訪問,分析,estatísticas,visitas,análise', 'Admin', 'account/admin/visit-stats', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('902082C4-3493-4B2B-84C8-3913FAC87168', 'Theme Editor', 'Manage theme files', 'theme,editor,files,thème,éditeur,fichiers,editor de temas,archivos,محرر السمات,ملفات,থিম সম্পাদক,ফাইল,themen-editor,dateien,थीम संपादक,फ़ाइलें,editor temi,file,テーマエディター,ファイル,editor de temas,arquivos,редактор тем,файлы,tema düzenleyici,dosyalar,تھیم ایڈیٹر', 'Admin,Manager,User', 'account/appearance/theme-editor', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('97564F18-976D-42F3-8883-EEDFFBBBBC4A', 'Activity Logs', 'View activity logs', 'logs,activity,tracking,journaux,activité,suivi,registros,actividad,seguimiento,سجلات,نشاط,تتبع,লগ,কার্যকলাপ,ট্র্যাকিং,protokolle,aktivität,verfolgung,लॉग,गतिविधि,ट्रैकिंग,registri,attività,tracciamento,ログ,アクティビティ,トラッキング,registros,atividade,rastreamento,ло', 'Admin', 'account/admin/activity-logs', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('A42C6E67-F5E6-42C7-96B0-6ACFAF06D973', 'Content Blocks', 'Manage content blocks', 'content,blocks,widgets,contenu,blocs,contenido,bloques,محتوى,كتل,বিষয়বস্তু,ব্লক,inhalt,blöcke,सामग्री,ब्लॉक,contenuto,blocchi,コンテンツ,ブロック,conteúdo,blocos,контент,блоки,içerik,bloklar,مواد,بلاکس,nội dung,khối,内容,块', 'Admin,Manager,User', 'account/content-blocks', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('A6DD8AA5-CA5F-4BE3-B3BB-D9A0C7EF7C82', 'Categories', 'Manage categories', 'category,categories,catégorie,catégories,categoría,categorías,فئة,فئات,বিভাগ,বিভাগসমূহ,kategorie,kategorien,श्रेणी,श्रेणियाँ,categoria,categorie,カテゴリー,categoria,categorias,категория,категории,kategori,kategoriler,زمرہ,اقسام,danh mục,类别', 'Admin,Manager,User', 'account/cms/categories', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('A8834F4A-3F28-413E-9064-EB5AFFA6F909', 'API Keys', 'Manage api keys', 'api,keys,access,clés,accès,claves,acceso,مفاتيح API,وصول,এপিআই,কী,অ্যাক্সেস,api-schlüssel,zugriff,एपीआई,चाबियाँ,पहुंच,chiavi,accesso,APIキー,アクセス,chaves de api,acesso,API-ключи,доступ,api anahtarları,erişim,API کیز,رسائی,khóa api,truy cập,API密钥,访问', 'Admin', 'account/admin/api-keys', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('ADE4E05C-FE42-44E8-88F9-0C94A5D0F674', 'Navigations', 'Manage navigations/menus', 'navigations,menus,links,navigations,menus,navegación,menús,قوائم,روابط,নেভিগেশন,মেনু,navigation,menüs,नेविगेशन,मेनू,navigazione,menu,ナビゲーション,メニュー,navegação,cardápio,навигация,меню,gezinme,menüler,نیویگیشن,مینیو,điều hướng,menu,导航,菜单', 'Admin,Manager,User', 'account/cms/navigations', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('B062CBF4-EFEE-4982-9C9F-BE314AC6FD7E', 'Whitelisted IP\'s', 'View whitelisted ip addresses', 'whitelist,allow,security,unblock,liste blanche,autoriser,sécurité,débloquer,lista blanca,permitir,seguridad,desbloquear,قائمة بيضاء,سماح,أمان,إلغاء حظر,সাদা তালিকা,অনুমতি,নিরাপত্তা,আনব্লক,whitelist,erlauben,sicherheit,entsperren,श्वेतसूची,अनुमति,सुरक्षा,अ', 'Admin', 'account/admin/whitelisted-ips', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('B551A2CD-01D4-4EC1-8C5E-8D1D2CD8B676', 'Data Groups', 'Manage data groups', 'data,groups,data groups,données,groupes,datos,grupos,بيانات,مجموعات,তথ্য,গ্রুপ,daten,gruppen,डेटा,समूह,dati,gruppi,データ,グループ,dados,grupos,данные,группы,veri,gruplar,ڈیٹا,گروپ्स,dữ liệu,nhóm,数据,组', 'Admin,Manager,User', 'account/cms/data-groups', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('B8F3BBFA-3764-4235-B1BE-4EBE083F4355', 'Subscription Forms', 'Manage subscription forms', 'subscription,newsletter,forms,abonnement,infolettre,suscripciones,boletín,اشتراكات,نشرة إخبارية,সাবস্ক্রিপশন,নিউজলেটার,abonnement,newsletter,सदस्यता,समाचारपत्रिका,abbonamento,newsletter,購読,ニュースレター,assinatura,boletim informativo,подписка,рассылка,abonelik,', 'Admin,Manager,User', 'account/forms/subscription-forms', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('C74725CF-E149-48E0-897B-BDA58B29BE41', 'Configurations', 'Manage configurations', 'configurations,settings,preferences,configurations,paramètres,préférences,configuraciones,ajustes,preferencias,إعدادات,تفضيلات,কনফিগারেশন,সেটিংস,পছন্দসমূহ,konfigurationen,einstellungen,प्रीफ़्रेंस,configurazioni,impostazioni,preferenze,設定,環境設定,configuraçõ', 'Admin', 'account/admin/configurations', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('C816E645-D71E-4499-8986-50C5B31D2D6A', 'Plugin Configurations', 'Manage plugin configurations', 'plugin,configurations,extensions,plugin,configurations,extensions,configuraciones de plugins,extensiones,إعدادات الإضافات,প্লাগইন কনফিগারেশন,plug-in-konfigurationen,प्लगइन कॉन्फ़िगरेशन,configurazioni plugin,プラグイン設定,configurações de plugins,настройки плаги', 'Admin', 'account/plugins/configurations', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('DD848E85-491F-4801-A32C-8067CD0C3EBC', 'Forms', 'Manage forms', 'forms,contact,formulaires,contact,formularios,contacto,نماذج,اتصال,ফর্ম,যোগাযোগ,formulare,kontakt,फॉर्म,संपर्क,moduli,contatto,フォーム,連絡先,formulários,contato,формы,контакт,formlar,iletişim,فارمز,رابطہ,biểu mẫu,liên hệ,表单,联系', 'Admin,Manager,User', 'account/forms', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('DF38C579-DF0E-4992-9D1D-0F0B40378155', 'Comment Forms', 'Manage comment forms', 'comments,feedback,forms,commentaires,retour,comentarios,retroalimentación,تعليقات,ملاحظات,মন্তব্য,প্রতিক্রিয়া,kritik,gerüst,टिप्पणियाँ,प्रतिक्रिया,commenti,反馈,コメント,フィードバック,comentários,feedback,комментарии,отзывы,yorumlar,geri bildirim,تبصرے,آراء,bình luậ', 'Admin,Manager,User', 'account/forms/comment-forms', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('E6C4753E-0B42-49EB-B303-4A1C98DD49C9', 'Dashboard', 'View admin dashboard', 'dashboard,home,overview,tableau,accueil,tablero,inicio,لوحة القيادة,الصفحة الرئيسية,ড্যাশবোর্ড,হোম,dashboard,startseite,डैशबोर्ड,होम,cruscotto,casa,painel,início,панель,главная,panel,panoya,ڈیش بورڈ,ہوم,bảng điều khiển,trang chủ,仪表板,主页', 'Admin,Manager,User', 'account/dashboard', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('EB1C3B01-5826-4724-B28D-D7AAD0F3EF85', 'Error Logs', 'View error logs', 'error,logs,tracking,erreur,journaux,suivi,error,registros,seguimiento,خطأ,سجلات,تتبع,ত্রুটি,লগ,ট্র্যাকিং,fehler,protokolle,verfolgung,त्रुटि,लॉग,ट्रैकिंग,errore,registri,tracciamento,エラー,ログ,トラッキング,erro,registros,rastreamento,ошибка,логи,отслеживание,hata,', 'Admin', 'account/admin/error-logs', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('EB513CDA-7644-43D6-B44E-3B9A3CC13498', 'Change Password', 'Change account password', 'password,security,change,password,sécurité,changer,contraseña,seguridad,cambiar,كلمة المرور,الأمان,تغيير,পাসওয়ার্ড,নিরাপত্তা,পরিবর্তন,passwort,sicherheit,ändern,पासवर्ड,सुरक्षा,बदलें,password,sicurezza,cambiare,パスワード,セキュリティ,変更,senha,segurança,mudar,парол', 'Admin,Manager,User', 'account/settings/change-password', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('F5354FEE-DC81-475D-9546-C560DBFDEFFE', 'Admin', 'Administration', 'admin,control,management,administration,contrôle,gestion,administración,control,gestión,إدارة,تحكم,مدير,অ্যাডমিন,নিয়ন্ত্রণ,ব্যবস্থাপনা,admin,verwaltung,एडमिन,नियंत्रण,प्रबंधन,amministrazione,controllo,gestione,管理者,コントロール,管理,administração,controle,админ,к', 'Admin', 'account/admin', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('FFDA4DE9-F845-457F-A61F-837C836E0044', 'Language', 'Update language preference', 'language,locale,translation,langue,paramètres régionaux,traduction,idioma,configuración regional,traducción,اللغة,الإعدادات المحلية,ترجمة,ভাষা,লোকেল,অনুবাদ,sprache,gebietsschema,übersetzung,भाषा,लोकेल,अनुवाद,lingua,traduzione,言語,ロケール,翻訳,idioma,tradução,яз', 'Admin,Manager,User', 'account/settings/language', '2026-03-31 17:28:25', '2026-03-31 17:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `backup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `backup_file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_ips`
--

CREATE TABLE `blocked_ips` (
  `blocked_ip_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `block_start_time` timestamp NULL DEFAULT NULL,
  `block_end_time` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `page_visited_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `featured_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `excerpt` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ai_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_breaking` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `scheduled_date_time` timestamp NULL DEFAULT NULL,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_views` int DEFAULT '0',
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `slug`, `featured_image`, `excerpt`, `content`, `ai_summary`, `category`, `tags`, `is_featured`, `is_breaking`, `status`, `scheduled_date_time`, `author`, `created_by`, `updated_by`, `total_views`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('7c4d3d90-08e0-451a-b79a-106d3150e6f3', 'Exploring the Future of AI in Healthcare', 'exploring-the-future-of-ai-in-healthcare', 'https://assets.aktools.net/image-stocks/posts/blog-3.jpg', 'AI is revolutionizing healthcare, from diagnostics to treatment. Explore the potential and challenges of integrating AI into the medical field', '<h2>Exploring the Future of AI in Healthcare</h2> <p>Artificial Intelligence (AI) is transforming healthcare, offering new possibilities for diagnosis, treatment, and patient care. Here is a glimpse into the future of AI in healthcare:</p> <h3>1. Early Diagnosis</h3> <p>AI algorithms can analyze medical data to detect diseases at an early stage, often before symptoms appear, allowing for timely intervention.</p> <h3>2. Personalized Treatment</h3> <p>By analyzing a patients genetic makeup and medical history, AI can help design personalized treatment plans that are more effective and have fewer side effects.</p> <h3>3. Virtual Health Assistants</h3> <p>AI-powered virtual assistants can provide patients with medical information, remind them to take medications, and even offer mental health support.</p> <h3>4. Operational Efficiency</h3> <p>AI can streamline administrative tasks, such as scheduling and billing, allowing healthcare providers to focus more on patient care.</p> <h3>5. Ethical Considerations</h3> <p>As AI becomes more integrated into healthcare, it is crucial to address ethical issues, such as data privacy and the potential for bias in algorithms.</p> <p>The future of AI in healthcare is promising, with the potential to improve patient outcomes and revolutionize the way we approach medicine. However, it is essential to navigate this path carefully, ensuring that technology serves to enhance human care.</p>', NULL, '11b3016f-4944-4467-ba98-9de4031ffe21', 'AI, healthcare, technology, future', 0, 0, 1, NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 1, 'Exploring the Future of AI in Healthcare', 'This is a sample blog post for demonstration purposes.', 'AI, healthcare, technology, future', '2026-03-31 15:28:25', '2026-03-31 17:28:25'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainable Living: Small Changes with Big Impact', 'sustainable-living-small-changes', 'https://assets.aktools.net/image-stocks/posts/blog-4.jpg', 'Discover simple yet effective ways to reduce your environmental footprint and live more sustainably in your daily life.', '<h2>Sustainable Living: Small Changes with Big Impact</h2><p>Sustainability doesn\'t require drastic lifestyle changes. Small, consistent actions can collectively make a significant difference. Here are practical ways to live more sustainably:</p><h3>1. Reduce Single-Use Plastics</h3><p>Carry reusable bags, bottles, and containers to minimize plastic waste.</p><h3>2. Conserve Energy</h3><p>Switch to LED bulbs and unplug devices when not in use.</p><h3>3. Mindful Water Usage</h3><p>Fix leaks promptly and install low-flow showerheads.</p><h3>4. Sustainable Transportation</h3><p>Walk, bike, or use public transport when possible.</p><h3>5. Conscious Consumption</h3><p>Buy less, choose quality over quantity, and support ethical brands.</p><p>Remember, sustainability is a journey, not a destination. Every small action counts!</p>', NULL, '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'sustainability, eco-friendly, lifestyle', 0, 0, 1, NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 0, 'Sustainable Living Tips', 'Easy ways to reduce your environmental impact through daily choices.', 'sustainability, eco-friendly, green living', '2026-03-31 13:28:25', '2026-03-31 17:28:25'),
('CE07D948-FF00-4A3C-8735-A4F2AF219EDE', 'Donald Trump tells UK to \'go get your own oil\'  Iran war', 'donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'https://i3.ytimg.com/vi/8l6FVGYKf8A/maxresdefault.jpg', 'Trump tells upset countries to \"go get your own oil\" from Strait of Hormuz as Iran chokes Gulf traffic following US-Israeli war on Iran. The UK initially refused US aircraft use of British bases for the strikes, warning the war might break international law.', '<div>Donald Trump says countries that are upset by high fuel prices should \"go get your own oil\" from the Strait of Hormuz.</div><div><br></div><div>The US president directed his Truth Social post at the UK, saying the US would no longer be there \"to help you anymore\".</div><div><br></div><div>Iran has put a chokehold on traffic leaving the Gulf following the launch of the US-Israeli war on Iran.</div><div><br></div><div>The UK initially refused to allow US aircraft to use British bases for the strikes, saying the war might break international law.</div>', 'Donald Trump told countries upset by high fuel prices to \"go get your own oil\" from the Strait of Hormuz, directing his criticism at the UK and claiming the US would no longer assist them. Iran has restricted traffic through the Gulf following the US-Israeli war on Iran, while the UK initially refused to allow US aircraft to use British bases for the strikes, citing potential violations of international law.', '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Donald Trump,UK oil,go get your own oil,Iran war,Trump Iran comment,US‑UK relations,oil supply,energy security,Middle East conflict,geopolitical tension,oil market,Trump foreign policy,Iran nuclear,UK energy policy,oil independence,Trump quote', 1, 1, 1, NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 2, 'Donald Trump Tells UK: Get Your Own Oil Amid Iran War', 'Trump tells UK to \'go get your own oil\' amid Iran war, urging Europe to act. Stay updated on the escalating tensions.', 'Donald Trump,Iran war,UK oil,Middle East conflict,US foreign policy,oil crisis,Iran US relations,Trump news,geopolitics,international relations,US UK relations.', '2026-03-31 17:59:21', '2026-04-02 08:27:41'),
('d9a9ce79-1756-4eab-a900-3684b175670f', 'How to attract top talent in competitive industries', 'how-to-attract-top-talent-in-competitive-industries', 'https://assets.aktools.net/image-stocks/posts/blog-1.jpg', 'Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.', '<p>Whilst your competitors are talking about ping pong tables and free office snacks that appeal to everyone (but are really just table stakes), you can focus on the things that will turn the heads of your ideal candidates.</p> <p>So, what does this approach look like exactly? What is it that recruiters need to do to grab the attention of the cream of the industry crop? We happen to help recruitment teams across 49 countries (and counting), attract and hire the best talent around every day. How do we/they do it? </p> <p>First up, you’ve got to change your shoes. That’s right, leave your tired, but trusty Size 6s or 10s at the door, and swap them for your candidates’ shoes. </p>', NULL, '6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'office, stakes, competitive', 0, 0, 1, NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 2, 'How to attract top talent in competitive industries', 'Top talents there for the picking, regardless of industry.', 'office, stakes, competitive', '2026-03-31 14:28:25', '2026-04-02 08:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `booking_form_submissions`
--

CREATE TABLE `booking_form_submissions` (
  `booking_form_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `number_of_attendees` int DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `confirmation_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resource_id` int DEFAULT NULL,
  `resource_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `order` int DEFAULT '10',
  `status` int DEFAULT '0',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `description`, `group`, `parent`, `link`, `new_tab`, `order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('11b3016f-4944-4467-ba98-9de4031ffe21', 'AI', 'AI category', NULL, NULL, 'ai', 0, 2, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('181dd10c-49d4-49bb-b3c0-f81ff69a35f6', 'Miscellaneous', 'Miscellaneous category', NULL, NULL, 'miscellaneous', 0, 4, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('4a886e81-a07d-4b7e-8750-25b5bd8f4e7a', 'Lifestyle & Wellness', 'Tips for healthy living, mindfulness practices, and personal development', NULL, NULL, 'lifestyle-wellness', 0, 3, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('5fc4f2e3-cbd7-410d-b8d3-195c6a5179ab', 'Technology & Innovation', 'Cutting-edge technology trends, AI developments, and digital innovations', NULL, NULL, 'technology-innovation', 0, 2, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('6b3c5c3e-6235-4ffa-b0be-db10e6444df5', 'Business & Career', 'Articles about business strategies, career development, and workplace trends', NULL, NULL, 'business-career', 0, 1, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Sustainability', 'Eco-friendly living, environmental awareness, and sustainable practices', NULL, NULL, 'sustainability', 0, 4, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('b2c3d4e5-f6a7-8901-2345-67890abcdef1', 'Personal Finance', 'Money management, investing tips, and financial planning strategies', NULL, NULL, 'personal-finance', 0, 5, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('f0b860dc-624c-439a-9de8-f3164c981b08', 'Technology', 'Technology category', NULL, NULL, 'technology', 0, 6, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_for` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`code_id`, `code_for`, `code`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('4D2A24D8-8831-43DC-86FD-76FE9BEACD88', 'CSS', '.dummy-class { color: initial; background-color: initial; font-size: initial; display: initial; visibility: initial; }', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('75C1B8DD-F71E-4E8E-9C79-12706450BE90', 'FooterJS', '<script>console.log(\'Footer script loaded\');</script>', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('A2B147F8-2C20-46E0-9334-C002AA7D7659', 'HeaderJS', '<script>console.log(\'Head script loaded\');</script>', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `comment_form_submissions`
--

CREATE TABLE `comment_form_submissions` (
  `comment_form_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gravatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `page_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `browser_signature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `is_reply` tinyint(1) NOT NULL DEFAULT '0',
  `reply_comment_form_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_me` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_updated_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_form_submissions`
--

INSERT INTO `comment_form_submissions` (`comment_form_id`, `name`, `email`, `gravatar`, `comment`, `page_id`, `page_url`, `ip_address`, `country`, `browser_signature`, `is_reply`, `reply_comment_form_id`, `remember_me`, `status`, `last_updated_by`, `created_at`, `updated_at`) VALUES
('4D17CA0C-8046-4ABB-BEF8-688807DB5958', 'Gaston Boyer', 'admin@example.com', 'https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=identicon', 'An absolute mf@cker', 'CE07D948-FF00-4A3C-8735-A4F2AF219EDE', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', '127.0.0.1', 'Unknown', 'd18e73137d21a5f9c90eef45302b8ff1', 1, 'CC7233A4-25BA-4FC7-8B05-0C3F227CDFE3', 0, 1, NULL, '2026-03-31 18:05:20', '2026-03-31 18:05:20'),
('CC7233A4-25BA-4FC7-8B05-0C3F227CDFE3', 'Kylie Gillespie', 'killi@ucl.ac.uk', 'https://www.gravatar.com/avatar/49cb53f2f818f341bdfe6c753b3edc50?d=identicon', 'He can go f#ck himself off', 'CE07D948-FF00-4A3C-8735-A4F2AF219EDE', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', '127.0.0.1', 'Unknown', 'd18e73137d21a5f9c90eef45302b8ff1', 0, NULL, 0, 1, NULL, '2026-03-31 18:00:52', '2026-03-31 18:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `config_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `config_for` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `config_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Text',
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `default_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom_class` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `search_terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`config_id`, `config_for`, `description`, `config_value`, `icon`, `group`, `data_type`, `options`, `default_value`, `custom_class`, `search_terms`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0629D126-2C86-4CD9-B9D0-C30CEB1769BC', 'TimestampKey', 'This is the input name for your timestamp bot detector.', 'igniter_timestamp_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_timestamp_val', '', 'honeypot,bot detection,spam,security, block ip', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('0842AF28-3224-4D35-8C08-7F1F3B165D10', 'EnableGeminiAI', 'Enable or disable Gemini AI integration.', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('0BBF6BD2-8A25-4CF1-A572-8A4C4C06B742', 'MaxFailedAttempts', 'This is maximum failed login attempts allowed in one session.', '5', 'ri-lock-fill', 'security', 'Text', NULL, '5', '', 'failed login,locked out,security', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('0EE02A88-9B4B-4E61-86CA-F48C29BD6E6C', 'AllowedApiGetModels', 'List of models allowed for API GET requests.', 'BlogsModel, CategoriesModel, CodesModel, ContentBlocksModel, NavigationsModel, PagesModel, ThemesModel, UsersModel', 'ri-database-2-line', 'api', 'Textarea', NULL, NULL, '', 'api,get,models,allowed', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('36D493D8-0E14-4115-9163-3F59E8B99AE2', 'EnableIgniterNewsFeed', 'Get latest news, features, and security update feeds from Igniter CMS.', 'Yes', 'ri-newspaper-line', 'comment', 'Select', 'Yes,No', 'Yes', '', 'igniter-cms,news feed,security updates', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('3BB44421-802B-42F6-AF4C-88F855AF816F', 'HoneypotKey', 'This is the input name for your honeypot input.', 'igniter_hpot_val', 'ri-shield-keyhole-fill', 'security', 'Text', NULL, 'igniter_hpot_val', '', 'honeypot,bot detection,spam,security, block ip', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('3D40818A-386A-4AFB-A032-454A1CA3D807', 'BackendFaviconLink', 'Favicon link for the backend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('43E0E067-6CBD-4892-9975-C2281A245C48', 'EnableRegistration', 'Enable or disable user registration/signup functionality.', 'Yes', 'ri-settings-line', 'site', 'Select', 'Yes,No', 'Yes', '', 'registration,sign up,mode,status,settings', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('49695113-6A1B-4C2B-81A6-4B9765130340', 'FailedLoginsSuspensionPeriod', 'This is suspension period for multiple failed logins.', '+30 minutes', 'ri-time-fill', 'security', 'Select', '+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours', '+30 minutes', '', 'suspension,failed login,locked out,security, timeout', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('580C3D3D-FAAE-4638-962E-047DAFB0FFE1', 'FrontEndFormat', 'Set frontend format to use MVC or API structure.', 'MVC', 'ri-layout-2-line', 'api', 'Select', 'MVC,API', 'MVC', 'Set to use MVC or API for frontend.', 'frontend,format,mvc,api', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('71E6C10C-B94B-4276-AAFD-7A5E055C552C', 'BackendLogoLink', 'Logo link for the backend interface.', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('87375685-FDAD-4EDE-8134-1D6B0089F72F', 'SiteFaviconLink', 'Favicon link for the frontend interface.', 'https://assets.aktools.net/image-stocks/favicon/favicon.ico', 'ri-image-line', 'meta_seo', 'Text', NULL, NULL, '', 'favicon,site,icon,browser', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('9A35D6F5-06B8-4B38-BF33-DED7789D3B35', 'BlockedIPSuspensionPeriod', 'This is suspension period for suspended IP\'s.', '+3 years', 'ri-time-fill', 'security', 'Select', '+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years', '+3 years', '', 'suspension,bot detection,spam,security, block ip', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('A75C9957-9511-47F9-A923-E97811588EDD', 'SiteDescription', 'Main title for SEO and meta tags', 'CodeIgniter CMS | Powerful and Flexible Content Management', 'ri-heading', 'meta_seo', 'Text', NULL, NULL, '', 'meta,title,seo,page', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('AD85CE94-706F-492B-9EEC-DBF50293CA7A', 'SiteKeywords', 'Keywords for SEO and meta tags', 'codeigniter, cms, content management system, php framework, web development', 'ri-hashtag', 'meta_seo', 'Text', NULL, NULL, '', 'meta,keywords,seo,tags', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('BB044E02-B855-4C31-A519-9DF1A84AC9F6', 'EnableGeminiAIAnalysis', 'Enable or disable Gemini AI for analysis of site data. This may include sharing of sensitive data with the AI', 'Yes', 'ri-robot-2-line', 'ai', 'Select', 'Yes,No', 'No', '', 'ai,chat,help,gemini,deepseek,qwen,gpt,enable', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('BE72B066-F5F5-4BC6-84D4-F2F7B160E8E3', 'SiteAddress', 'Address of the company, organization or business.', '221B Baker Street, London NW1 6XE, United Kingdom', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,address,locationb,business,organization', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('C17AC230-7DCB-4D55-B345-855A793072F3', 'SiteName', 'Name of the company, organization or business.', 'Igniter CMS App', 'ri-building-line', 'site', 'Text', NULL, NULL, 'title-text', 'company,name,business,organization', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('C200CED1-E098-4CAB-AC21-C78A11EB90C8', 'SiteLogoLink', 'Logo link for the frontend interface (PNG format).', 'https://assets.aktools.net/image-stocks/logos/ci-cms-logo.png', 'ri-image-2-line', 'meta_seo', 'Text', NULL, NULL, '', 'logo,site,branding,image', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('C4F25508-3E6A-4DB3-AE07-032357812604', 'MaxUploadFileSize', 'This is the maximum file upload size in megabytes.', '10', 'ri-upload-cloud-fill', 'site', 'Select', '1,3,5,10,50,100,1000', '5', '', 'file upload,maximum,file size', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('E663337E-28AC-46B1-808D-0A999C51ADCA', 'EnableHoneypotInput', 'Enable or disable the honeypot input for bot detection.', 'Yes', 'ri-shield-keyhole-fill', 'security', 'Select', 'Yes,No', 'No', '', 'honeypot,bot detection,spam,security, block ip', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:25', '2026-03-31 17:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

CREATE TABLE `contact_form_submissions` (
  `contact_form_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `referrer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'New',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks`
--

CREATE TABLE `content_blocks` (
  `content_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `custom_field_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_8` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_9` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `custom_field_10` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `order` int DEFAULT '10',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_blocks`
--

INSERT INTO `content_blocks` (`content_id`, `identifier`, `author`, `title`, `description`, `content`, `icon`, `group`, `image`, `video`, `file`, `link`, `new_tab`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `custom_field_5`, `custom_field_6`, `custom_field_7`, `custom_field_8`, `custom_field_9`, `custom_field_10`, `order`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('8690E6CA-1CA7-4103-897B-07BC97F65FBF', 'BusinessServices', 0, 'Business Services', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Our business services include strategic planning, process optimization, and technology integration to drive your success.</p>', 'ri-database-2-line', 'theme', 'https://placehold.co/600x400/06b6d4/ffffff?text=Business+Services', NULL, NULL, 'https://example.com/business-services', 1, '{\"color\": \"#007bff\", \"priority\": \"high\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('C73FE963-71E6-4F00-86D4-CFB54AD813A9', 'SavingInvestments', 0, 'Saving Investments', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', 'Learn how our investment strategies can maximize your returns while minimizing risks.', 'ri-reactjs-fill', 'theme', 'https://placehold.co/600x400/1c91e6/ffffff?text=Saving+Investments', NULL, NULL, 'https://example.com/saving-investments', 0, '{\"color\": \"#28a745\", \"priority\": \"medium\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('FBB217D8-F177-4EC5-AE6B-0FC0A12445BD', 'OnlineConsulting', 0, 'Online Consulting', 'Exhaustive technology of implementing multi purpose projects is putting your project successful.', '<p>Access expert advice from anywhere with our virtual consulting services.</p>', 'ri-global-line', 'theme', 'https://placehold.co/600x400/1d2eb3/ffffff?text=Online+Consulting', NULL, NULL, 'https://example.com/online-consulting', 1, '{\"color\": \"#dc3545\", \"priority\": \"low\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `iso` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nicename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iso3` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `data_group_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_for` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_group_list` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_groups`
--

INSERT INTO `data_groups` (`data_group_id`, `data_group_for`, `data_group_list`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('076484F0-0451-4139-9ACE-02677FF26C7D', 'Category', 'general,business,portfolio', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('0C84A4A1-EF92-4E26-B876-8BA5DE4971A0', 'Page', 'home,general,about,services,contact', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('5A3390B7-9480-4045-89EB-702164D3F856', 'Navigation', 'general,top_nav,services,footer_nav', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('5B049287-F1E6-4AE5-9414-E7BD13F3BE9C', 'ContentBlock', 'general', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('5FC605C4-1420-4D19-B111-0F59B2E788BC', 'ContactFormStatus', 'New,In Progress,Resolved,Archived', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('7F95C915-ED59-4F49-B80F-1AB7CC237FB0', 'BookingFormStatus', 'Pending,Confirmed,Cancelled', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('E7652953-F31A-4F7A-8F48-7C03245897AC', 'BookingFormPaymentStatus', 'None,Unpain,Paid,Refunded', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('F6D08F14-B889-412B-BDDE-0AF100C8E9F8', 'SubscriptionFormStatus', 'Pending Confirmation,Active,Unsubscribed,Bounced', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `error_log_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `severity` int NOT NULL,
  `error_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-08-27-210112', 'App\\Database\\Migrations\\Users', 'default', 'App', 1774974505, 1),
(2, '2024-08-27-210503', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', 1774974505, 1),
(3, '2024-08-27-210533', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1774974505, 1),
(4, '2024-08-27-210550', 'App\\Database\\Migrations\\ErrorLogs', 'default', 'App', 1774974505, 1),
(5, '2024-08-27-210615', 'App\\Database\\Migrations\\AppModules', 'default', 'App', 1774974505, 1),
(6, '2024-09-13-163422', 'App\\Database\\Migrations\\Countries', 'default', 'App', 1774974505, 1),
(7, '2024-10-05-231920', 'App\\Database\\Migrations\\PasswordResets', 'default', 'App', 1774974505, 1),
(8, '2024-10-06-181331', 'App\\Database\\Migrations\\Configurations', 'default', 'App', 1774974505, 1),
(9, '2024-10-12-182042', 'App\\Database\\Migrations\\Backups', 'default', 'App', 1774974505, 1),
(10, '2024-10-12-182050', 'App\\Database\\Migrations\\Blogs', 'default', 'App', 1774974505, 1),
(11, '2024-10-12-182102', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1774974506, 1),
(12, '2024-10-12-182318', 'App\\Database\\Migrations\\ContentBlocks', 'default', 'App', 1774974506, 1),
(13, '2024-10-13-113115', 'App\\Database\\Migrations\\Pages', 'default', 'App', 1774974506, 1),
(14, '2024-11-04-180801', 'App\\Database\\Migrations\\Codes', 'default', 'App', 1774974506, 1),
(15, '2024-11-05-131303', 'App\\Database\\Migrations\\Themes', 'default', 'App', 1774974506, 1),
(16, '2024-11-12-143627', '\\SiteStats', 'default', 'App', 1774974506, 1),
(17, '2024-11-15-185530', 'App\\Database\\Migrations\\ApiAccesses', 'default', 'App', 1774974506, 1),
(18, '2024-11-16-185500', 'App\\Database\\Migrations\\ApiCallsTracker', 'default', 'App', 1774974506, 1),
(19, '2024-11-17-163458', 'App\\Database\\Migrations\\Navigations', 'default', 'App', 1774974506, 1),
(20, '2025-02-16-001918', 'App\\Database\\Migrations\\BlockedIps', 'default', 'App', 1774974506, 1),
(21, '2025-02-18-145240', 'App\\Database\\Migrations\\WhitelistedIps', 'default', 'App', 1774974506, 1),
(22, '2025-06-01-113456', 'App\\Database\\Migrations\\DataGroups', 'default', 'App', 1774974506, 1),
(23, '2025-06-20-151038', 'App\\Database\\Migrations\\Plugins', 'default', 'App', 1774974506, 1),
(24, '2025-07-01-161418', 'App\\Database\\Migrations\\PluginConfigs', 'default', 'App', 1774974506, 1),
(25, '2025-10-14-165005', 'App\\Database\\Migrations\\SubscriptionForms', 'default', 'App', 1774974506, 1),
(26, '2025-10-14-165035', 'App\\Database\\Migrations\\ContactForms', 'default', 'App', 1774974506, 1),
(27, '2025-10-14-165049', 'App\\Database\\Migrations\\BookingForms', 'default', 'App', 1774974507, 1),
(28, '2025-10-31-142255', 'App\\Database\\Migrations\\CommentForms', 'default', 'App', 1774974507, 1),
(29, '2025-11-13-164704', 'App\\Database\\Migrations\\ThemeRevisions', 'default', 'App', 1774974507, 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `navigation_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order` int DEFAULT '10',
  `parent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT '0',
  `status` int DEFAULT '0',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`navigation_id`, `title`, `description`, `icon`, `group`, `order`, `parent`, `link`, `new_tab`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('07b6258b-1884-47af-892f-52d203d97d1e', 'RSS Feed', 'RSS feed page', '', 'footer_nav', 44, NULL, 'rss', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('0adc27cd-8d08-4a83-bfe0-06381cb343d3', 'Marketing', 'Marketing nav', '', 'services', 28, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('131c5798-d0b7-484c-bf21-e1768458632f', 'Home', 'Home navigation', '', 'top_nav', 2, NULL, 'home', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('1b191836-b655-4e2a-9257-2b59e642e195', 'Services', 'Services page', '', 'footer_nav', 36, NULL, '#services', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('1e19eba9-1b42-4918-99c0-906792224645', 'Graphic Design', 'Graphic Design nav', '', 'services', 30, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('204476df-0090-48de-829d-e5f30e2b85d6', 'Cookie Policy', 'Cookie Policy page', '', 'footer_nav', 38, NULL, 'cookie-policy', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('33df6a3e-197f-469e-a337-9da6a32c69c9', 'Team', 'Team page', '', 'top_nav', 10, NULL, '#team', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('4f4bb82e-e298-4d9f-bc78-30486dfdb2e3', 'About Us', 'About us page', '', 'top_nav', 4, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('5b2969a9-6d2f-431f-9a06-cebf924daa10', 'Sitemap', 'Sitemap page', '', 'footer_nav', 42, NULL, 'sitemap', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('60ff9118-7044-4308-86ff-b19afe1cf9ee', 'About Us', 'About us page', '', 'footer_nav', 34, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('70c54a4b-3201-4701-a6fe-094e533351fe', 'Contact Us', 'Contact us page', '', 'top_nav', 20, NULL, '#contact', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('7548ade6-c891-4f4c-a08b-fce04459a37c', 'Home', 'Home navigation', '', 'footer_nav', 32, NULL, 'home', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('8f89db87-1f9d-428d-bdbd-a29cf75ec8d6', 'Product Management', 'Product Management nav', '', 'services', 26, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('a5556828-689e-48fb-9f84-b59858a04e0a', 'Privacy Policy', 'Privacy policy page', '', 'footer_nav', 40, NULL, 'privacy-policy', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('d7ccca46-a01b-4dfc-aaf3-1d77938a6ea9', 'Blogs', 'Blogs page', '', 'top_nav', 12, NULL, 'blogs', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('e1ae5499-4847-4abf-ae00-f402d56d0063', 'Services', 'Services page', '', 'top_nav', 6, NULL, '#services', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('e6249c88-468b-44eb-92d6-9b8ef6ae68b5', 'Web Development', 'Web Developmentns nav', '', 'services', 24, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('ef1ee0ca-2420-47f3-ba8a-ad18d78ae424', 'Portfolio', 'Portfolio page', '', 'top_nav', 8, NULL, '#portfolio', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('f478adf7-74d8-4a2e-b3d4-30d159be6fa7', 'Web Design', 'Web Design nav', '', 'services', 22, NULL, '#!', 0, 1, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'portfolio',
  `status` int DEFAULT '0',
  `is_home_page` int DEFAULT '0',
  `total_views` int DEFAULT '0',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ai_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `slug`, `group`, `status`, `is_home_page`, `total_views`, `content`, `ai_summary`, `author`, `created_by`, `updated_by`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
('a1b2c3d4-e5f6-7890-1234-567890abcdef', 'Cookie Policy', 'cookie-policy', 'general', 1, 0, 0, '<h2>Cookie Policy</h2><p>This Cookie Policy explains how we use cookies and similar technologies on our website.  We use cookies to improve your browsing experience, personalize content, and analyze website traffic.</p><p><strong>What are cookies?</strong></p><p>Cookies are small text files that are placed on your device when you visit a website.  They are widely used to make websites work more efficiently, as well as to provide information to the website owners.</p><p><strong>Types of cookies we use:</strong></p><ul><li><strong>Strictly necessary cookies:</strong> These cookies are essential for you to navigate the website and use its features.</li><li><strong>Performance cookies:</strong> These cookies collect information about how you use the website, such as which pages you visit most often.  This information is used to improve the website\'s performance.</li><li><strong>Functionality cookies:</strong> These cookies allow the website to remember choices you make (such as your language preference) and provide enhanced, more personalized features.</li><li><strong>Targeting/advertising cookies:</strong> These cookies are used to deliver advertisements relevant to your interests.</li></ul><p><strong>Managing cookies:</strong></p><p>You have the right to choose whether or not to accept cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.  However, please note that if you disable or delete cookies, some parts of the website may not function correctly.</p><p>For more information about managing cookies, please visit [link to a relevant resource, e.g., aboutcookies.org].</p>', NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 'Cookie Policy', 'Our Cookie Policy explains how we use cookies on our website.', 'cookies, policy, privacy', '2026-03-31 17:28:26', '2026-03-31 17:28:26'),
('f7a8d40d-6b97-4c0b-a532-f535ac4c4af1', 'Home', 'home', 'home', 1, 1, 3, '', NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, NULL, NULL, NULL, '2026-03-31 17:28:26', '2026-04-08 09:00:55'),
('fedcba98-7654-3210-0fed-cba987654321', 'Privacy Policy', 'privacy-policy', 'general', 1, 0, 0, '<h2>Privacy Policy</h2><p>This Privacy Policy describes how we collect, use, and share your personal information when you visit or make a purchase from our website.</p><p><strong>Information we collect:</strong></p><p>When you visit the website, we automatically collect certain information about your device, including your IP address, web browser, time zone, and some of the cookies that are installed on your device.  Additionally, when you make a purchase or attempt to make a purchase, we collect information about you, including your name, billing address, shipping address, email address, phone number, and payment information.</p><p><strong>How we use your information:</strong></p><p>We use the information we collect to fulfill your orders, communicate with you about your orders, personalize your experience on our website, and improve our website.</p><p><strong>Sharing your information:</strong></p><p>We may share your information with third-party service providers who help us operate our website and fulfill your orders.  We will never sell your personal information.</p><p><strong>Your rights:</strong></p><p>You have the right to access, correct, and delete your personal information.  You also have the right to object to the processing of your personal information.</p><p><strong>Contact us:</strong></p><p>If you have any questions about our Privacy Policy, please contact us at [your contact information].</p>', NULL, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, 'Privacy Policy', 'Our Privacy Policy describes how we collect, use, and share your personal information.', 'privacy, policy, data, personal information', '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `plugin_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `plugin_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `update_available` int DEFAULT '0',
  `load` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugin_configs`
--

CREATE TABLE `plugin_configs` (
  `id` int UNSIGNED NOT NULL,
  `plugin_slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `config_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `config_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `role_description`, `updated_at`, `created_at`) VALUES
('28C5825A-BC7C-40BD-840B-13DFAD63B78E', 'User', 'User Role', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('2B3F5509-7AC2-4000-A402-E58FAD18D0C6', 'Manager', 'Manager Role', '2026-03-31 17:28:25', '2026-03-31 17:28:25'),
('E42FF7F1-0B6C-479A-B178-0D763603ABCA', 'Admin', 'Admin role', '2026-03-31 17:28:25', '2026-03-31 17:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `site_stats`
--

CREATE TABLE `site_stats` (
  `site_stat_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `device_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `browser_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_visited_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_visited_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `referrer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_code` int DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operating_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `screen_resolution` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `other_params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_stats`
--

INSERT INTO `site_stats` (`site_stat_id`, `ip_address`, `device_type`, `browser_type`, `page_type`, `page_visited_id`, `page_visited_url`, `referrer`, `status_code`, `user_id`, `session_id`, `request_method`, `operating_system`, `country`, `screen_resolution`, `user_agent`, `other_params`, `created_at`) VALUES
('02A3A1A2-B2DB-4AB0-8C55-F18A09AEF325', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'search?q=fatu', 'http://localhost/apps/igniter-cms/search', '', 200, '', '0b199862a56e53ffce2aacc8170d82b0', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 10:03:05'),
('10748D9E-D82D-44DE-9533-4DCD59542079', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'search/filter?type=tag&key=oil+market', 'http://localhost/apps/igniter-cms/search/filter', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:28:22'),
('1B71A3E5-4EE3-45CD-B5C6-5DD9219DC393', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'home', 'http://localhost/apps/igniter-cms/', 'http://localhost/apps/igniter-cms/blog/how-to-attract-top-talent-in-competitive-industries', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:28:39'),
('326AE417-5C20-40E0-A9E0-012BCEA1D14E', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/dashboard', 200, '', 'b4521fdc1b6ce097ac1f6bf74048f1cf', 'GET', 'Windows', 'Unknown', '1536 x 960', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 09:33:39'),
('3D01E6A3-4DB4-4F20-8E85-FFA2AC1F7460', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '1E6B2B51-7B73-421F-B389-0AA45D15026D', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'DFAD67BA-538F-43C9-85BB-98E1A7333A9F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-01-01 00:00:00'),
('3F863A70-181A-4C96-BD6C-C8653BE4F00A', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blogs', 200, '', 'a10ff47e11ac3ab92a136288624f67c4', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-03-31 17:59:48'),
('480A22EC-4CCE-4833-ABDF-F62850321599', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blog/how-to-attract-top-talent-in-competitive-industries', 'http://localhost/apps/igniter-cms/blog/how-to-attract-top-talent-in-competitive-industries', 'http://localhost/apps/igniter-cms/blogs', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:28:31'),
('4E3A4233-2352-48FD-A4B4-BAFA44EC4C82', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '7B6A625D-6939-4E4D-B090-D91456703166', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '439BAEC4-6F96-4364-AAD9-16063179BDEA', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-12-01 00:00:00'),
('65754AD4-4DF5-4028-98A0-3290FB365FC2', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'search?q=fatu', 'http://localhost/apps/igniter-cms/search', 'http://localhost/apps/igniter-cms/', 200, '', '3e8564918fa6ec258d8badf3a5080c18', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 09:16:21'),
('6C22F53A-E4F4-46AE-99EE-1B11291CE150', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blogs', 'http://localhost/apps/igniter-cms/blogs', 'http://localhost/apps/igniter-cms/search/filter?type=tag&key=oil+market', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:28:26'),
('6FFE2E95-1119-4C0F-8F58-73BD3462A359', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'search/filter?type=tag&key=US%E2%80%91UK+relations', 'http://localhost/apps/igniter-cms/search/filter', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:28:13'),
('71B85C7C-CD46-49F8-88B0-555AFF607881', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war?', 200, '', '0780c03d979225b94507c27eec80e9bb', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-03-31 18:05:21'),
('7DFC8D19-6CC5-48B5-BFF7-689EF69F6FEC', '172.16.0.1', 'mobile', 'Edge', 'Page', '43B71F1E-04F5-49DF-BCC1-A684CEDEC7F0', 'http://localhost/apps/igniter-cms/', 'POST', 204, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '28F857DD-A70D-4E6E-9B3D-145D25223AAF', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2026-03-29 16:28:26'),
('80D088C5-9702-43A7-BA81-638AB51522C6', '192.168.2.1', 'mobile', 'Opera', 'Page', '0163BBC5-EB86-457C-8F96-AEAEB4B3608A', 'http://localhost/apps/igniter-cms/blog', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'EBE5D65B-E88B-4526-8F04-AE5DA0BA427D', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPad; CPU OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', NULL, '2026-03-27 16:28:26'),
('88AB34DD-17E4-490A-A6D7-CAB98A5FCAD5', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'home', 'http://localhost/apps/igniter-cms/', '', 200, '', '5db6d432c81f5616cd4009f4602d4c9e', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, '2026-04-08 09:00:55'),
('8C99AF30-FD8E-4787-BF44-5E512B6AF45E', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '6F7E7FEC-9D4F-45BE-96A9-7E13BA144096', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '2BA4EE5E-21A4-4536-BC2F-67B73D07947F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-12-01 00:00:00'),
('8FF2BA10-1543-405B-9765-4B2C5C265318', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/search?q=fatu', 200, '', '0d7c5dd9cb24e98ebc7bb831861527e2', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 09:33:15'),
('9324F6A5-817A-4C6E-ADB1-674011178D1B', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '698D86D8-3630-40E3-9F70-471671348BE7', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '8491FC11-F942-4D69-956E-B5AD0FB76D6C', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-03-01 00:00:00'),
('970C69A3-56AA-42B6-84F1-623A662872B6', '10.0.0.1', 'tablet', 'Firefox', 'Page', '49C74ACD-3CF3-4EFB-B707-94730557976D', 'http://localhost/apps/igniter-cms/contact', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '1BF5D39F-D930-4C41-BBB4-88290DE8B81B', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-03-30 16:28:26'),
('A0862D29-1982-47A3-8A98-9A7A8624C9BA', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '8B404EC9-9AE1-43DB-81A7-B56E778FF8AE', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '311334C2-C135-44E0-8EEE-1E6FACA3B706', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-10-01 00:00:00'),
('AF6B6AB2-AEEF-46B4-9D6F-7B99092E7949', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'home', 'http://localhost/apps/igniter-cms/', '', 200, '', 'a10ff47e11ac3ab92a136288624f67c4', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-03-31 17:59:38'),
('B0A3C201-7B31-4E1C-B4EC-8BC85F34DB2F', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/account/cms/blogs', 200, '', '178269e2edb22c0338f8259000bdd968', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, '2026-04-01 12:36:24'),
('B4B7D8A3-0AFB-4573-A1F3-E6C0BA58F7D7', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war', 'http://localhost/apps/igniter-cms/blog/donald-trump-tells-uk-to-go-get-your-own-oil-iran-war?', 200, '', 'df8564680204a6f707c7ac74d6dbb03a', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-02 08:27:41'),
('BC97625B-2EE3-44FF-9E20-4CC957390A35', '127.0.0.1', 'desktop', 'Google Chrome', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', 'http://localhost/apps/igniter-cms/sign-in', 200, '', '5cf4fcc6a6616c7b41b60e5c9996190a', 'GET', 'Windows', 'Unknown', '2560 x 1440', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, '2026-03-31 17:28:35'),
('C3C5DFAE-835B-4912-BD6F-D6F5AC336D1F', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'DAAEB6BA-4807-4726-8A1F-3DFFF0DC4A6E', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '937A3C01-A7FC-4701-96F4-E28FA63365A0', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2026-03-28 16:28:26'),
('C4FFD309-3388-430C-B3C0-C083DD70764D', '127.0.0.1', 'desktop', 'Microsoft Edge', 'page', 'sign-in', 'http://localhost/apps/igniter-cms/sign-in', '', 200, '', 'a10ff47e11ac3ab92a136288624f67c4', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-03-31 17:59:35'),
('C84099FC-46D4-4289-9777-0A025FBF4C52', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '997C5B6B-08FA-4E81-976A-05502078FFA5', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'A4A88464-A931-4C81-BBBB-1C56BA3847C0', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-10-01 00:00:00'),
('CE70A0FE-D531-45A7-8676-5B4DF119456B', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', 'BFFC9BDF-DD70-40AF-85B4-9157DB90FDC5', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '7F603420-88EB-4252-9410-74059D169C4C', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', NULL, '2025-12-01 00:00:00'),
('D34A8095-ED8B-4E92-BA58-15F298ED4E37', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '448F9ADE-0AD7-4D47-BE07-2CF6BC84F3D7', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'D4AA526B-88A4-4950-B6A7-4A4FCF31C08F', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edge/130.0.0.0', NULL, '2026-03-25 16:28:26'),
('DB7409DC-8B6A-4C11-880A-78BC61E7FB66', '127.0.0.1', 'desktop', 'Microsoft Edge', 'blog', 'blogs', 'http://localhost/apps/igniter-cms/blogs', 'http://localhost/apps/igniter-cms/', 200, '', 'a10ff47e11ac3ab92a136288624f67c4', 'GET', 'Windows', 'Unknown', 'NA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-03-31 17:59:43'),
('EBF3ADC9-DF7D-4883-8860-CBF8F3172411', '192.168.1.1', 'mobile', 'Safari', 'Page', 'F7B6252B-3F10-44D8-A70F-30963601E688', 'http://localhost/apps/igniter-cms/about', 'POST', 201, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', 'session-69cbf62a63979', 'POST', 'iOS', 'UK', '375 x 812', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1', '{\"source\":\"direct\"}', '2026-03-31 16:28:26'),
('FD5E0FB5-E40E-408A-803D-F5385C08D457', '102.129.135.0', 'desktop', 'Google Chrome', 'Page', '2258779A-3934-4B14-99E0-52AADCFDD914', 'http://localhost/apps/igniter-cms/', 'GET', 200, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', '1C029742-3F86-470D-867D-981EA1EE546D', 'GET', 'Windows', 'US', '1280 x 591', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) OPT/15.6', NULL, '2026-03-26 16:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_form_submissions`
--

CREATE TABLE `subscription_form_submissions` (
  `subscription_form_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `form_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `site_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `list_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending Confirmation',
  `confirmation_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unsubscribed_at` datetime DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `theme_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `default_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `heading_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `accent_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surface_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrast_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `background_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `theme_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `selected` tinyint(1) DEFAULT '0',
  `override_default_style` tinyint(1) DEFAULT '0',
  `use_static_theme_nav` tinyint(1) DEFAULT '0',
  `plugins_required` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deletable` int NOT NULL DEFAULT '1',
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `name`, `path`, `default_color`, `heading_color`, `accent_color`, `surface_color`, `contrast_color`, `background_color`, `image`, `theme_url`, `category`, `sub_category`, `selected`, `override_default_style`, `use_static_theme_nav`, `plugins_required`, `deletable`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('D253F9FE-D1D0-42EF-87C6-843ABEB5C4DE', 'Default', '/default', '#6c757d', '#212529', '#0d6efd', '#f8f9fa', '#0d6efd', '#ffffff', 'public/front-end/themes/default/assets/images/preview.png', 'https://previews.ignitercms.com/Default/', 'Business & Corporate', 'Agency & Marketing', 1, 0, 0, '', 0, 'B83E35F4-6C79-4636-A36D-D3C55D89598B', NULL, '2026-03-31 17:28:26', '2026-03-31 17:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `theme_revisions`
--

CREATE TABLE `theme_revisions` (
  `theme_revision_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `theme_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `revision_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '0',
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `twitter_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about_summary` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `upload_directory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user_OrmEw',
  `is_social_login` tinyint(1) DEFAULT '0',
  `password_change_required` tinyint(1) DEFAULT '0',
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `status`, `role`, `profile_picture`, `twitter_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `about_summary`, `upload_directory`, `is_social_login`, `password_change_required`, `remember_token`, `expires_at`, `last_login`, `created_at`, `updated_at`) VALUES
('B83E35F4-6C79-4636-A36D-D3C55D89598B', 'Admin', 'User', 'admin', 'admin@example.com', '$2y$10$GgIDK3VNygJBCxoBNccMd.df664XT/x/kxD4ba/pZ5LF.dXS1Nflu', 1, 'Admin', 'public/uploads/default/default-profile.png', 'https://twitter.com/?admin-user', 'https://www.facebook..com/?admin-user', 'https://instagram..com/?admin-user', 'https://www.linkedin.com/in/?admin-user', 'Hello! I\'m Admin User, the administrator of this platform. With a strong background in managing and overseeing operations, I ensure everything runs smoothly. You can connect with me on social media through the links provided. I\'m here to help and support our community!', 'admin_8J0IM', 0, 1, NULL, NULL, '2026-04-02 07:33:17', '2026-03-31 17:28:25', '2026-04-02 09:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `whitelisted_ips`
--

CREATE TABLE `whitelisted_ips` (
  `whitelisted_ip_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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

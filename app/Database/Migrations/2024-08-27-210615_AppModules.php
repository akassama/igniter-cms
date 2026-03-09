<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AppModules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'app_module_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'module_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'module_description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'module_search_terms' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'module_roles' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'module_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'updated_at datetime default current_timestamp on update current_timestamp',
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('app_module_id', true);

        // Custom Optimization - Indexing
        $this->forge->addKey('module_name');
        $this->forge->addKey('module_description');
        $this->forge->addKey('module_search_terms');
        
        $this->forge->createTable('app_modules');

        //insert default records
        //----------------------
        $data = [
            // DASHBOARD
            [
                'app_module_id' => getGUID(),
                'module_name'   => 'Dashboard',
                'module_description'    => 'View admin dashboard',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/dashboard',
                'module_search_terms' => 'dashboard,home,overview,tableau,accueil,tablero,inicio,لوحة القيادة,الصفحة الرئيسية,ড্যাশবোর্ড,হোম,dashboard,startseite,डैशबोर्ड,होम,cruscotto,casa,painel,início,панель,главная,panel,panoya,ڈیش بورڈ,ہوم,bảng điều khiển,trang chủ,仪表板,主页'
            ],
            // CMS - BLOGS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Blogs',
                'module_description'  => 'Manage blogs, posts, or articles',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/blogs',
                'module_search_terms' => 'blogs,articles,posts,blogs,articles,blogs,artículos,مدونات,مقالات,ব্লগ,নিবন্ধ,blogs,artikel,ब्लॉग,लेख,blog,articoli,ブログ,記事,blogs,artigos,блоги,статьи,bloglar,makaleler,بلاگز,مضامین,blog,bài viết,博客,文章'
            ],
            // CMS - NAVIGATIONS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Navigations',
                'module_description'  => 'Manage navigations/menus',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/navigations',
                'module_search_terms' => 'navigations,menus,links,navigations,menus,navegación,menús,قوائم,روابط,নেভিগেশন,মেনু,navigation,menüs,नेविगेशन,मेनू,navigazione,menu,ナビゲーション,メニュー,navegação,cardápio,навигация,меню,gezinme,menüler,نیویگیشن,مینیو,điều hướng,menu,导航,菜单'
            ],
            // CMS - CATEGORIES
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Categories',
                'module_description'  => 'Manage categories',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/categories',
                'module_search_terms' => 'category,categories,catégorie,catégories,categoría,categorías,فئة,فئات,বিভাগ,বিভাগসমূহ,kategorie,kategorien,श्रेणी,श्रेणियाँ,categoria,categorie,カテゴリー,categoria,categorias,категория,категории,kategori,kategoriler,زمرہ,اقسام,danh mục,类别'
            ],
            // CMS - PAGES
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Pages',
                'module_description'  => 'Manage pages',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/pages',
                'module_search_terms' => 'pages,content,publish,pages,contenu,páginas,contenido,صفحات,محتوى,পৃষ্ঠা,বিষয়বস্তু,seiten,inhalt,पृष्ठ,सामग्री,pagine,contenuto,ページ,コンテンツ,páginas,conteúdo,страницы,контент,sayfalar,içerik,صفحات,مواد,trang,nội dung,页面,内容'
            ],
            // CMS - DATA GROUPS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Data Groups',
                'module_description'  => 'Manage data groups',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/cms/data-groups',
                'module_search_terms' => 'data,groups,data groups,données,groupes,datos,grupos,بيانات,مجموعات,তথ্য,গ্রুপ,daten,gruppen,डेटा,समूह,dati,gruppi,データ,グループ,dados,grupos,данные,группы,veri,gruplar,ڈیٹا,گروپ्स,dữ liệu,nhóm,数据,组'
            ],
            // FORMS - FORMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Forms',
                'module_description'  => 'Manage forms',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/forms',
                'module_search_terms' => 'forms,contact,formulaires,contact,formularios,contacto,نماذج,اتصال,ফর্ম,যোগাযোগ,formulare,kontakt,फॉर्म,संपर्क,moduli,contatto,フォーム,連絡先,formulários,contato,формы,контакт,formlar,iletişim,فارمز,رابطہ,biểu mẫu,liên hệ,表单,联系'
            ],
            // FORMS - CONTACT FORMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Contact Forms',
                'module_description'  => 'Manage contact forms',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/forms/contact-forms',
                'module_search_terms' => 'contact,forms,formulaires de contact,formularios de contacto,نماذج الاتصال,যোগাযোগ ফর্ম,kontaktformulare,संपर्क फॉर्म,moduli di contatto,お問い合わせフォーム,formulários de contato,контактные формы,iletişim formları,فارمز رابطہ,biểu mẫu liên hệ,联系表单'
            ],
            // FORMS - COMMENT FORMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Comment Forms',
                'module_description'  => 'Manage comment forms',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/forms/comment-forms',
                'module_search_terms' => 'comments,feedback,forms,commentaires,retour,comentarios,retroalimentación,تعليقات,ملاحظات,মন্তব্য,প্রতিক্রিয়া,kritik,gerüst,टिप्पणियाँ,प्रतिक्रिया,commenti,反馈,コメント,フィードバック,comentários,feedback,комментарии,отзывы,yorumlar,geri bildirim,تبصرے,آراء,bình luận,phản hồi,评论,反馈'
            ],
            // FORMS - BOOKING FORMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Booking Forms',
                'module_description'  => 'Manage booking forms',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/forms/booking-forms',
                'module_search_terms' => 'booking,appointments,forms,réservation,rendez-vous,reservas,citas,حجوزات,مواعيد,বুকিং,অ্যাপয়েন্টমেন্ট,buchung,termine,बुकिंग,अपॉइंटमेंट,prenotazione,appuntamenti,予約,アポイントメント,reservas,compromissos,бронирование,встречи,rezervasyon,randevular,بکنگ,ملاقات​​,đặt chỗ,cuộc hẹn,预订,约会'
            ],
            // FORMS - SUBSCRIPTION FORMS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Subscription Forms',
                'module_description'  => 'Manage subscription forms',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/forms/subscription-forms',
                'module_search_terms' => 'subscription,newsletter,forms,abonnement,infolettre,suscripciones,boletín,اشتراكات,نشرة إخبارية,সাবস্ক্রিপশন,নিউজলেটার,abonnement,newsletter,सदस्यता,समाचारपत्रिका,abbonamento,newsletter,購読,ニュースレター,assinatura,boletim informativo,подписка,рассылка,abonelik,bülten,سبسکرپشن,نیوز لیٹر,đăng ký,bản tin,订阅,通讯'
            ],
            // FILE MANAGER
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'File Management',
                'module_description'  => 'Manage files and media (images, videos, documents)',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/file-manager',
                'module_search_terms' => 'files,media,storage,fichiers,média,archivos,medios,ملفات,وسائط,ফাইল,মিডিয়া,dateien,medien,फ़ाइलें,मीडिया,file,media,ファイル,メディア,arquivos,mídia,файлы,медиа,dosyalar,medya,فائلیں,میڈیا,tệp,phương tiện,文件,媒体'
            ],
            // CONTENT BLOCKS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Content Blocks',
                'module_description'  => 'Manage content blocks',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/content-blocks',
                'module_search_terms' => 'content,blocks,widgets,contenu,blocs,contenido,bloques,محتوى,كتل,বিষয়বস্তু,ব্লক,inhalt,blöcke,सामग्री,ब्लॉक,contenuto,blocchi,コンテンツ,ブロック,conteúdo,blocos,контент,блоки,içerik,bloklar,مواد,بلاکس,nội dung,khối,内容,块'
            ],
            // APPEARANCE - THEMES
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Themes',
                'module_description'  => 'Manage themes',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/appearance/themes',
                'module_search_terms' => 'themes,appearance,design,thèmes,apparence,thèmes,apariencia,diseño,سمات,مظهر,থিম,চেহারা,themen,aussehen,थीम,दिखावट,temi,aspetto,テーマ,外観,temas,aparência,темы,внешний вид,temalar,görünüm,تھیمز,ظاہری شکل,chủ đề,diện mạo,主题,外观'
            ],
            // APPEARANCE - THEME EDITOR
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Theme Editor',
                'module_description'  => 'Manage theme files',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/appearance/theme-editor',
                'module_search_terms' => 'theme,editor,files,thème,éditeur,fichiers,editor de temas,archivos,محرر السمات,ملفات,থিম সম্পাদক,ফাইল,themen-editor,dateien,थीम संपादक,फ़ाइलें,editor temi,file,テーマエディター,ファイル,editor de temas,arquivos,редактор тем,файлы,tema düzenleyici,dosyalar,تھیم ایڈیٹر,فائلیں,trình chỉnh sửa chủ đề,tệp,主题编辑器,文件'
            ],
            // APPEARANCE - THEME REVISIONS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Theme Revisions',
                'module_description'  => 'Manage theme revisions',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/appearance/theme-editor/revisions',
                'module_search_terms' => 'themes,revisions,versions,thèmes,révisions,versions,revisiones,versiones,مراجعات السمات,إصدارات,থিম সংশোধন,সংস্করণ,themen-revisionen,versionen,थीम संशोधन,संस्करण,revisioni temi,versioni,テーマリビジョン,バージョン,revisões de temas,versões,ревізії тем,версії,tema revizyonları,sürümler,تھیم نظرثانی,ورژن,chủ đề sửa đổi,phiên bản,主题修订,版本'
            ],
            // SETTINGS - ACCOUNT DETAILS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Account Details',
                'module_description'  => 'Update account details',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/settings/update-details',
                'module_search_terms' => 'account,profile,settings,compte,profil,paramètres,cuenta,perfil,configuración,حساب,ملف,إعدادات,অ্যাকাউন্ট,প্রোফাইল,সেটিংস,konto,profil,einstellungen,खाता,प्रोफ़ाइल,सेटिंग्स,account,profilo,impostazioni,アカウント,プロフィール,設定,conta,perfil,configurações,аккаунт,профиль,настройки,hesap,profil,ayarlar,اکاؤنٹ,پروفائل,ترتیبات,tài khoản,hồ sơ,cài đặt,账户,个人资料,设置'
            ],
            // SETTINGS - CHANGE PASSWORD
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Change Password',
                'module_description'  => 'Change account password',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/settings/change-password',
                'module_search_terms' => 'password,security,change,password,sécurité,changer,contraseña,seguridad,cambiar,كلمة المرور,الأمان,تغيير,পাসওয়ার্ড,নিরাপত্তা,পরিবর্তন,passwort,sicherheit,ändern,पासवर्ड,सुरक्षा,बदलें,password,sicurezza,cambiare,パスワード,セキュリティ,変更,senha,segurança,mudar,пароль,безопасность,изменить,şifre,güvenlik,değiştir,پاس ورڈ,سیکیورٹی,تبدیلی,mật khẩu,bảo mật,thay đổi,密码,安全,更改'
            ],
            // SETTINGS - LANGUAGE
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Language',
                'module_description'  => 'Update language preference',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/settings/language',
                'module_search_terms' => 'language,locale,translation,langue,paramètres régionaux,traduction,idioma,configuración regional,traducción,اللغة,الإعدادات المحلية,ترجمة,ভাষা,লোকেল,অনুবাদ,sprache,gebietsschema,übersetzung,भाषा,लोकेल,अनुवाद,lingua,traduzione,言語,ロケール,翻訳,idioma,tradução,язык,локаль,перевод,dil,yerel,çeviri,زبان,مقامی,ترجمہ,ngôn ngữ,bản địa hóa,dịch thuật,语言,区域设置,翻译'
            ],
            // ADMIN - ADMIN
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Admin',
                'module_description'  => 'Administration',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin',
                'module_search_terms' => 'admin,control,management,administration,contrôle,gestion,administración,control,gestión,إدارة,تحكم,مدير,অ্যাডমিন,নিয়ন্ত্রণ,ব্যবস্থাপনা,admin,verwaltung,एडमिन,नियंत्रण,प्रबंधन,amministrazione,controllo,gestione,管理者,コントロール,管理,administração,controle,админ,контроль,управление,yönetici,kontrol,yönetim,ایڈمن,کنٹرول,انتظامیہ,quản trị viên,kiểm soát,quản lý,管理员,控制,管理'
            ],
            // ADMIN - USERS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Users',
                'module_description'  => 'Manage application users',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/users',
                'module_search_terms' => 'users,accounts,people,utilisateurs,comptes,personnes,usuarios,cuentas,personas,مستخدمين,حسابات,أشخاص,ব্যবহারকারী,অ্যাকাউন্ট,মানুষ,benutzer,konten,leute,उपयोगकर्ता,खाते,लोग,utenti,account,persone,ユーザー,アカウント,人々,usuários,contas,pessoas,пользователи,аккаунты,люди,kullanıcılar,hesaplar,insanlar,صارفین,اکاؤنٹس,لوگ,người dùng,tài khoản,mọi người,用户,帐户,人员'
            ],
            // ADMIN - CONFIGURATIONS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Configurations',
                'module_description'  => 'Manage configurations',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/configurations',
                'module_search_terms' => 'configurations,settings,preferences,configurations,paramètres,préférences,configuraciones,ajustes,preferencias,إعدادات,تفضيلات,কনফিগারেশন,সেটিংস,পছন্দসমূহ,konfigurationen,einstellungen,प्रीफ़्रेंस,configurazioni,impostazioni,preferenze,設定,環境設定,configurações,preferências,конфигурации,настройки,предпочтения,yapılandırmalar,ayarlar,tercihler,ترتیبات,ترجیحات,cấu hình,cài đặt,tùy chọn,配置,设置,首选项'
            ],
            // ADMIN - CODES
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Codes',
                'module_description'  => 'Manage codes',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/codes',
                'module_search_terms' => 'codes,references,identifiers,codes,références,identifiants,códigos,referencias,identificadores,رموز,مراجع,معرفات,কোড,রেফারেন্স,আইডি,codes,referenzen,identifikatoren,कोड,संदर्भ,पहचानकर्ता,codici,riferimenti,identificatori,コード,参照,識別子,códigos,referências,identificadores,коды,ссылки,идентификаторы,kodlar,referanslar,tanımlayıcılar,کوڈز,حوالہ جات,شناخت کنندگان,mã số,tài liệu tham khảo,mã định danh,代码,参考,标识符'
            ],
            // ADMIN - API KEYS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'API Keys',
                'module_description'  => 'Manage api keys',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/api-keys',
                'module_search_terms' => 'api,keys,access,clés,accès,claves,acceso,مفاتيح API,وصول,এপিআই,কী,অ্যাক্সেস,api-schlüssel,zugriff,एपीआई,चाबियाँ,पहुंच,chiavi,accesso,APIキー,アクセス,chaves de api,acesso,API-ключи,доступ,api anahtarları,erişim,API کیز,رسائی,khóa api,truy cập,API密钥,访问'
            ],
            // ADMIN - ACTIVITY LOGS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Activity Logs',
                'module_description'  => 'View activity logs',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/activity-logs',
                'module_search_terms' => 'logs,activity,tracking,journaux,activité,suivi,registros,actividad,seguimiento,سجلات,نشاط,تتبع,লগ,কার্যকলাপ,ট্র্যাকিং,protokolle,aktivität,verfolgung,लॉग,गतिविधि,ट्रैकिंग,registri,attività,tracciamento,ログ,アクティビティ,トラッキング,registros,atividade,rastreamento,логи,активность,отслеживание,kayıtlar,etkinlik,takip,لاگز,سرگرمی,ٹریکنگ,nhật ký,hoạt động,theo dõi,日志,活动,跟踪'
            ],
            // ADMIN - ERROR LOGS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Error Logs',
                'module_description'  => 'View error logs',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/error-logs',
                'module_search_terms' => 'error,logs,tracking,erreur,journaux,suivi,error,registros,seguimiento,خطأ,سجلات,تتبع,ত্রুটি,লগ,ট্র্যাকিং,fehler,protokolle,verfolgung,त्रुटि,लॉग,ट्रैकिंग,errore,registri,tracciamento,エラー,ログ,トラッキング,erro,registros,rastreamento,ошибка,логи,отслеживание,hata,kayıtlar,takip,غلطی,لاگز,ٹریکنگ,lỗi,nhật ký,theo dõi,错误,日志,跟踪'
            ],
            // ADMIN - VISIT STATS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Visit Stats',
                'module_description'  => 'View visit statistics and charts',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/visit-stats',
                'module_search_terms' => 'stats,visits,analytics,statistiques,visites,analytique,estadísticas,visitas,análisis,إحصائيات,زيارات,تحليلات,পরিসংখ্যান,পরিদর্শন,বিশ্লেষণ,statistiken,besuche,analytik,सांख्यिकी,दौरा,विश्लेषण,statistiche,visite,analisi,統計,訪問,分析,estatísticas,visitas,análise,статистика,посещения,аналитика,istatistikler,ziyaretler,analitik,شماریات,دورے,تجزیہ,thống kê,lượt truy cập,phân tích,统计,访问,分析'
            ],
            // ADMIN - BLOCKED IPS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Blocked IP\'s',
                'module_description'  => 'View blocked ip addresses',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/blocked-ips',
                'module_search_terms' => 'block,blacklist,security,deny,ip,bloquer,liste noire,sécurité,refuser,bloquear,lista negra,seguridad,denegar,حظر,قائمة سوداء,أمان,رفض,ব্লক,কালো তালিকা,নিরাপত্তা,অস্বীকার,blockieren,sperrliste,sicherheit,verweigern,ब्लॉक,ब्लैकलिस्ट,सुरक्षा,अस्वीकार,bloccare,lista nera,sicurezza,negare,ブロック,ブラックリスト,セキュリティ,拒否,bloquear,lista negra,segurança,negar,блокировать,черный список,безопасность,отказать,engelle,kara liste,güvenlik,reddetmek,بلاک,بلیک لسٹ,سیکیورٹی,انکار,chặn,danh sách đen,bảo mật,từ chối,阻止,黑名单,安全,拒绝'
            ],
            // ADMIN - WHITELISTED IPS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Whitelisted IP\'s',
                'module_description'  => 'View whitelisted ip addresses',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/whitelisted-ips',
                'module_search_terms' => 'whitelist,allow,security,unblock,liste blanche,autoriser,sécurité,débloquer,lista blanca,permitir,seguridad,desbloquear,قائمة بيضاء,سماح,أمان,إلغاء حظر,সাদা তালিকা,অনুমতি,নিরাপত্তা,আনব্লক,whitelist,erlauben,sicherheit,entsperren,श्वेतसूची,अनुमति,सुरक्षा,अनब्लॉक,whitelist,consentire,sicurezza,sbloccare,ホワイトリスト,許可,セキュリティ,ブロック解除,lista branca,permitir,segurança,desbloquear,белый список,разрешить,безопасность,разблокировать,beyaz liste,izin vermek,güvenlik,engeli kaldırmak,وائٹ لسٹ,اجازت,سیکیورٹی,غیر مسدود,danh sách trắng,cho phép,bảo mật,bỏ chặn,白名单,允许,安全,解锁'
            ],
            // ADMIN - BACKUP
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Backup',
                'module_description'  => 'Manage backups',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/admin/backups',
                'module_search_terms' => 'backup,restore,database,sauvegarde,restaurer,base de données,copia de seguridad,restaurar,base de datos,نسخ احتياطي,استعادة,قاعدة بيانات,ব্যাকআপ,পুনরুদ্ধার,ডাটাবেস,backup,wiederherstellen,datenbank,बैकअप,पुनर्स्थापित करना,डेटाबेस,backup,ripristinare, database,バックアップ,復元,データベース,backup,restaurar,banco de dados,резервное копирование,восстановить,база данных,yedekleme,geri yükleme,veritabanı,بیک اپ,بحال,ڈیٹا بیس,sao lưu,khôi phục,cơ sở dữ liệu,备份,恢复,数据库'
            ],
            // PLUGINS - PLUGINS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Plugins',
                'module_description'  => 'Manage plugins',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/plugins',
                'module_search_terms' => 'plugins,extensions,package,extensions,paquet,extensiones,paquete,إضافات,حزمة,প্লাগইন,এক্সটেনশন,প্যাকেজ,plug-ins,erweiterungen,प्लगइन,एक्सटेंशन,पैकेज,plugin,estensioni,パッケージ,plugins,extensões,pacote,плагины,расширения,пакет,eklentiler,uzantılar,paket,پلگ ان,ایکسٹنشنز,پیکیج,plugin,tiện ích mở rộng,gói,插件,扩展,包'
            ],
            // PLUGINS - PLUGIN CONFIGURATIONS
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'Plugin Configurations',
                'module_description'  => 'Manage plugin configurations',
                'module_roles'    => 'Admin',
                'module_link'    => 'account/plugins/configurations',
                'module_search_terms' => 'plugin,configurations,extensions,plugin,configurations,extensions,configuraciones de plugins,extensiones,إعدادات الإضافات,প্লাগইন কনফিগারেশন,plug-in-konfigurationen,प्लगइन कॉन्फ़िगरेशन,configurazioni plugin,プラグイン設定,configurações de plugins,настройки плагинов,eklenti yapılandırmaları,کنفیگریشن پلگ ان,cấu hình plugin,插件配置'
            ],
            // AI
            [
                'app_module_id' => getGUID(),
                'module_name'  => 'AI',
                'module_description'  => 'AI chatbot',
                'module_roles'    => 'Admin,Manager,User',
                'module_link'    => 'account/ask-ai',
                'module_search_terms' => 'artificial intelligence,chat gpt,claude,gemini,deepseek,intelligence artificielle,chat gpt,claude,gemini,deepseek,inteligencia artificial,chat gpt,claude,gemini,deepseek,الذكاء الاصطناعي,شات جي بي تي,كلود,جيميني,ডিপসিক,কৃত্রিম বুদ্ধিমত্তা,চ্যাট জিপিটি,ক্লদ,জেমিনি,ডিপসিক,künstliche intelligenz,chat gpt,claude,gemini,deepseek,कृत्रिम बुद्धिमत्ता,चैट जीपीटी,क्लॉड,जेमिनी,डीपसीक,intelligenza artificiale,chat gpt,claude,gemini,deepseek,人工知能,チャットGPT,クロード,ジェミニ,ディープシーク,inteligência artificial,chat gpt,claude,gemini,deepseek,искусственный интеллект,чат gpt,claude,gemini,deepseek,yapay zeka,chat gpt,claude,gemini,deepseek,مصنوعی ذہانت,چیٹ جی پی ٹی,کلاؤڈ,جیمنی,ڈیپ سیک,trí tuệ nhân tạo,chat gpt,claude,gemini,deepseek,人工智能,聊天GPT,克劳德,双子座,深度搜索'
            ],
        ];
        
        // Using Query Builder
        $this->db->table('app_modules')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('app_modules');
    }
}

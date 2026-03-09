<?php
// app/Config/CustomConfig.php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    #--------------------------------------------------------------------
    # THEME CATEGORIES
    #--------------------------------------------------------------------
    public $themeCategories = [
        'Business' => 'Business & Corporate',
        'Ecommerce' => 'Ecommerce & Retail',
        'Portfolio' => 'Portfolio & Creative',
        'News' => 'Blog & Magazine',
        'Events' => 'Event & Booking',
        'Educational' => 'Educational & Learning',
        'Restaurant' => 'Restaurant & Food',
        'Health' => 'Health & Wellness',
        'Directory' => 'Directory & Listing',
        'Professional' => 'Professional Services',
        'HomeServices' => 'Home & Property Services',
        'Automotive' => 'Automotive & Transportation',
        'Beauty' => 'Beauty & Personal Care',
        'Creative' => 'Creative & Photography',
        'LegalFinance' => 'Legal & Financial',
        'Childcare' => 'Childcare & Education',
        'Travel' => 'Travel & Hospitality',
        'Construction' => 'Construction, Contractors & Building',
        'Entertainment' => 'Entertainment & Arts',
        'Technology' => 'Technology & IT',
        'NonProfit' => 'Non-Profit & NGO',
        'RealEstate' => 'Real Estate & Property',
        'Personal' => 'Personal & Resume',
        'Agency' => 'Agency & Marketing',
        'Landing' => 'Landing Pages',
        'ComingSoon' => 'Coming Soon',
        'Miscellaneous' => 'Miscellaneous',
    ];
    
    #--------------------------------------------------------------------
    # USER ROLES
    #--------------------------------------------------------------------
    public $userRoles = [
        'Admin' => 'Admin',
        'Manager' => 'Manager',
        'User' => 'User',
    ];
}
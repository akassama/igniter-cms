<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\ThemesModel;

class ThemesController extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

    //############################//
    //           Themes           //
    //############################//
    public function themes()
    {
        $tableName = 'themes';
        $themesModel = new ThemesModel();
    
        // Set data to pass in view
        $data = [
            'themes' => $themesModel->orderBy('name', 'ASC')->findAll(),
            'total_themes' => getTotalRecords($tableName)
        ];
    
        return view('back-end/themes/index', $data);
    }
    
    public function newTheme()
    {
        return view('back-end/themes/new-theme');
    }
    
    public function addTheme()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the ThemesModel
        $themesModel = new ThemesModel();
    
        // Validation rules from the model
        $validationRules = $themesModel->getValidationRules();
    
        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/themes/new-theme');
        }

        // If validation passes, create the theme
        $themeData = [
            'name' => $this->request->getPost('name'),
            'path' => $this->request->getPost('path'),
            'primary_color'  => $this->request->getPost('primary_color'),
            'secondary_color'  => $this->request->getPost('secondary_color'),
            'background_color'  => $this->request->getPost('background_color'),
            'image'  => $this->request->getPost('image'),
            'theme_url'  => $this->request->getPost('theme_url'),
            'theme_bg_image'  => $this->request->getPost('theme_bg_image'),
            'theme_bg_video'  => $this->request->getPost('theme_bg_video'),
            'theme_bg_slider_image_1'  => $this->request->getPost('theme_bg_slider_image_1'),
            'theme_bg_slider_image_2'  => $this->request->getPost('theme_bg_slider_image_2'),
            'theme_bg_slider_image_3'  => $this->request->getPost('theme_bg_slider_image_3'),
            'theme_js'  => $this->request->getPost('theme_js'),
            'theme_css'  => $this->request->getPost('theme_css'),
            'footer_copyright'  => $this->request->getPost('footer_copyright'),
            'category'  => $this->request->getPost('category'),
            'sub_category'  => $this->request->getPost('sub_category'),
            'selected'  => $this->request->getPost('selected') ?? 0,
            'override_default_style'  => $this->request->getPost('override_default_style') ?? 0,
            'deletable' => $this->request->getPost('deletable') ?? 1,
            'home_page'  => $this->request->getPost('home_page') ?? 'HomePage',
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        //if selected, set the rest as not selected
        if($themeData["selected"] == "1"){
            $updatedData = [
                'selected' => 0
            ];

            $updateWhereClause = "theme_id != 'NULL'";

            updateRecord('themes', $updatedData, $updateWhereClause);
        }
    
        // Call createTheme method from the ThemeModel
        if ($themesModel->createTheme($themeData)) {
            //inserted user_id
            $insertedId = $themesModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::THEME_CREATION, 'Theme created with id: ' . $insertedId);
    
            return redirect()->to('/account/themes');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Failed to create themeuration with name: ' . $this->request->getPost('name'));
    
            return view('back-end/themes/new-theme');
        }
    }
    
    public function editTheme($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeuration = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeuration
        ];
    
        return view('back-end/themes/edit-theme', $data);
    }
    
    public function updateTheme()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $themesModel = new ThemesModel();
    
        // Custom validation rules
        $rules = [
            'theme_id' => 'required',
            'name' => 'required',
            'path' => 'required',
        ];
    
        $themeId = $this->request->getPost('theme_id');
        $data['theme_data'] = $themesModel->where('theme_id', $themeId)->first();
    
        if($this->validate($rules)){       

            //if selected, set the rest as not selected
            if($this->request->getPost('selected') == "1"){
                $updatedData = [
                    'selected' => 0
                ];

                $updateWhereClause = "theme_id != 'NULL'";

                updateRecord('themes', $updatedData, $updateWhereClause);
            }

            $db = \Config\Database::connect();
            $builder = $db->table('themes');
            $data = [
                'name' => $this->request->getPost('name'),
                'path'  => $this->request->getPost('path'),
                'primary_color'  => $this->request->getPost('primary_color'),
                'secondary_color'  => $this->request->getPost('secondary_color'),
                'background_color'  => $this->request->getPost('background_color'),
                'image'  => $this->request->getPost('image'),
                'theme_url'  => $this->request->getPost('theme_url'),
                'theme_bg_image'  => $this->request->getPost('theme_bg_image'),
                'theme_bg_video'  => $this->request->getPost('theme_bg_video'),
                'theme_bg_slider_image_1'  => $this->request->getPost('theme_bg_slider_image_1'),
                'theme_bg_slider_image_2'  => $this->request->getPost('theme_bg_slider_image_2'),
                'theme_bg_slider_image_3'  => $this->request->getPost('theme_bg_slider_image_3'),
                'theme_js'  => $this->request->getPost('theme_js'),
                'theme_css'  => $this->request->getPost('theme_css'),
                'footer_copyright'  => $this->request->getPost('footer_copyright'),
                'category'  => $this->request->getPost('category'),
                'sub_category'  => $this->request->getPost('sub_category'),
                'selected'  => $this->request->getPost('selected') ?? 0,
                'override_default_style'  => $this->request->getPost('override_default_style') ?? 0,
                'deletable' => $this->request->getPost('deletable') ?? 1,
                'home_page'  => $this->request->getPost('home_page') ?? 'HomePage',
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $loggedInUserId
            ];
    
            $builder->where('theme_id', $themeId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::THEME_UPDATE, 'Theme updated with id: ' . $themeId);
    
            return redirect()->to('/account/themes');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_UPDATE, 'Failed to update theme with name: ' . $this->request->getPost('name'));
    
            return view('back-end/themes/edit-theme', $data);
        }
    }
    
    public function editThemeHomePage($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeuration = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeuration
        ];
    
        return view('back-end/themes/edit-theme-home-page', $data);
    }

    public function activateTheme($themeId)
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeuration = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/themes');
        }

        //reset selected themes
        $updatedData = [
            'selected' => 0
        ];

        $updateWhereClause = "theme_id != 'NULL'";
        updateRecord('themes', $updatedData, $updateWhereClause);

        //set as active
        $updateColumn =  "'selected' = '1'";
        $updateWhereClause = "theme_id = '$themeId'";
        $result = updateRecordColumn("themes", $updateColumn, $updateWhereClause);

        // Record updated successfully. Redirect to dashboard
        $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
        session()->setFlashdata('successAlert', $createSuccessMsg);

        //log activity
        logActivity($loggedInUserId, ActivityTypes::THEME_UPDATE, 'Theme with id: ' . $themeId. 'set as active.');

        return redirect()->to('/account/themes');
    }
}

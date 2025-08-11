<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\ThemesModel;

class AppearanceController extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('back-end/appearance/index');
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
    
        return view('back-end/appearance/themes/index', $data);
    }
    
    public function installThemes()
    {
        $allThemes = $this->getThemesData();

        // Group themes
        $popularThemes = array_filter($allThemes, fn($theme) => !empty($theme['is_popular']));
        $latestThemes = array_filter($allThemes, fn($theme) => !empty($theme['is_new']));
        $featuredThemes = array_filter($allThemes, fn($theme) => !empty($theme['is_featured']));

        $data = [
            'themes' => $allThemes,
            'popularThemes' => $popularThemes,
            'latestThemes' => $latestThemes,
            'featuredThemes' => $featuredThemes,
            'has_error' => session()->getFlashdata('warning'),
        ];

        return view('back-end/appearance/themes/install-themes', $data);
    }
    
    public function uploadTheme()
    {
        return view('back-end/appearance/themes/upload-theme');
    }
    
    public function addTheme()
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $validation = \Config\Services::validation();

        // Validate the file upload
        $validation->setRules([
            'theme_file' => [
                'label' => 'Theme File',
                'rules' => 'uploaded[theme_file]|ext_in[theme_file,zip]|max_size[theme_file,10240]', // 10MB max
                'errors' => [
                    'uploaded' => 'Please select a plugin file to upload',
                    'ext_in' => 'Only ZIP files are allowed',
                    'max_size' => 'Maximum file size is 10MB'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Validation failed: ' . implode(', ', $validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $themeFile = $this->request->getFile('theme_file');
        $override = boolval($this->request->getPost('override_if_exists'));

        // Load the ThemesModel
        $themesModel = new ThemesModel();

        // Create temporary directory for extraction
        $tempDir = WRITEPATH . 'temp/theme_' . uniqid();
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Move uploaded file to temp directory
        $tempZipPath = $tempDir . '/theme.zip';
        $themeFile->move($tempDir, 'theme.zip');

        // Extract the zip file
        $zip = new \ZipArchive();
        if ($zip->open($tempZipPath) !== TRUE) {
            $this->deleteDirectory($tempDir);
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Failed to open theme zip file');
            return redirect()->back()->with('errorAlert', 'Failed to extract theme file');
        }

        $zip->extractTo($tempDir);
        $zip->close();
        unlink($tempZipPath); // Remove the zip file after extraction

        // Check if theme.json exists
        $themeJsonPath = $tempDir . '/theme.json';
        if (!file_exists($themeJsonPath)) {
            $this->deleteDirectory($tempDir);
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Theme.json file not found');
            return redirect()->back()->with('errorAlert', 'theme.json file not found in the theme package');
        }

        // Read theme.json
        $themeConfig = json_decode(file_get_contents($themeJsonPath), true);
        if (json_last_error() !== JSON_ERROR_NONE || !isset($themeConfig['path'])) {
            $this->deleteDirectory($tempDir);
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Invalid theme.json format');
            return redirect()->back()->with('errorAlert', 'Invalid theme.json format');
        }

        $themePath = $themeConfig['path'];
        $themeName = $themeConfig['name'] ?? 'Untitled Theme';
        $themeViewsDir = APPPATH . 'Views/front-end/themes/' . $themePath;
        $themeAssetsDir = FCPATH . 'public/front-end/themes/' . $themePath . '/assets';

        // Check if theme already exists
        $tableName = "themes";
        $themeExists = recordExists($tableName, 'path', $themePath);
        if ($themeExists && !$override) {
            $this->deleteDirectory($tempDir);
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Theme already exists: ' . $themeName);
            return redirect()->back()->with('errorAlert', 'A theme with this path already exists. Enable override option to replace it.');
        }

        // Create directories if they don't exist
        if (!is_dir($themeViewsDir)) {
            mkdir($themeViewsDir, 0755, true);
        }
        if (!is_dir($themeAssetsDir)) {
            mkdir($themeAssetsDir, 0755, true);
        }

        // Move views
        $tempViewsDir = $tempDir . '/views';
        if (is_dir($tempViewsDir)) {
            $this->copyDirectory($tempViewsDir, $themeViewsDir);
        }

        // Move assets
        $tempAssetsDir = $tempDir . '/assets';
        if (is_dir($tempAssetsDir)) {
            $this->copyDirectory($tempAssetsDir, $themeAssetsDir);
        }

        // Prepare theme data for database
        $themesData = [
            'theme_id' => getGUID(),
            'name' => $themeConfig['name'] ?? 'Untitled Theme',
            'path' => $themeConfig['path'],
            'primary_color' => $themeConfig['primary_color'] ?? '#000000',
            'secondary_color' => $themeConfig['secondary_color'] ?? '#808080',
            'background_color' => $themeConfig['background_color'] ?? '#FFFFFF',
            'theme_url' => $themeConfig['theme_url'] ?? '',
            'image' => $themeConfig['image'] ?? '',
            'category' => $themeConfig['category'] ?? 'General',
            'sub_category' => $themeConfig['sub_category'] ?? '',
            'selected' => 0,
            'override_default_style' => 0,
            'deletable' => 1,
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        try {
            if ($themeExists) {
                deleteRecord($tableName, 'path', $themePath);
            }
            addRecord($tableName, $themesData);
            logActivity($loggedInUserId, ActivityTypes::THEME_CREATION, 'Theme added to database: ' . $themeName);
        } catch (\Exception $e) {
            $this->deleteDirectory($tempDir);
            session()->setFlashdata('errorAlert', 'Failed to update theme database');
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Database update failed: ' . $themeName . ' - ' . $e->getMessage());
            return redirect()->to('/account/appearance/themes/upload-theme');
        }

        // Clean up temp directory
        $this->deleteDirectory($tempDir);

        // Theme uploaded successfully. Redirect to themes
        $createSuccessMsg = str_replace('[Record]', 'Theme', config('CustomConfig')->createSuccessMsg);
        session()->setFlashdata('successAlert', $createSuccessMsg);
        return redirect()->to('/account/appearance/themes');
    }
  
    public function editTheme($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeData = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeData) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/appearance/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeData
        ];
    
        return view('back-end/appearance/themes/edit-theme', $data);
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
                'category'  => $this->request->getPost('category'),
                'sub_category'  => $this->request->getPost('sub_category'),
                'selected'  => $this->request->getPost('selected') ?? 0,
                'override_default_style'  => $this->request->getPost('override_default_style') ?? 0,
                'deletable' => $this->request->getPost('deletable') ?? 1,
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $loggedInUserId
            ];
    
            $builder->where('theme_id', $themeId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'Theme', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
    
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
    
            return view('back-end/appearance/themes/edit-theme', $data);
        }
    }
    
    public function editThemeHomePage($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeData = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeData) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeData
        ];
    
        return view('back-end/appearance/themes/edit-theme-home-page', $data);
    }

    public function activateTheme($themeId)
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeData = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeData) {
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
        $editSuccessMsg = str_replace('[Record]', 'Theme', config('CustomConfig')->editSuccessMsg);
        session()->setFlashdata('successAlert', $editSuccessMsg);

        //log activity
        logActivity($loggedInUserId, ActivityTypes::THEME_UPDATE, 'Theme with id: ' . $themeId. 'set as active.');

        return redirect()->to('/account/appearance/themes');
    }

    public function removeTheme()
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $tableName = "themes";
        $pkName = "theme_id";
        $themeId = $this->request->getPost('theme_id');
        $themePath = $this->request->getPost('theme_path');

        // Show demo message
        if (boolval(env('DEMO_MODE', "false"))) {
            $errorMsg = "Action not available in the demo mode.";
            session()->setFlashdata('warningAlert', $errorMsg);
            return redirect()->to('/account/themes');
        }

        try {
            // First get theme data to check if it's deletable
            $themesModel = new ThemesModel();
            $theme = $themesModel->where('theme_id', $themeId)->first();
            
            if (!$theme) {
                throw new \Exception("Theme not found");
            }

            // Check if theme is marked as deletable
            if (!$theme['deletable']) {
                throw new \Exception("This theme cannot be deleted");
            }

            // Define directories to delete
            $themeViewsDir = APPPATH . 'Views/front-end/themes/' . $themePath;
            $themeAssetsDir = FCPATH . 'public/front-end/themes/' . $themePath . '/assets';

            // Remove theme files (if they exist)
            if (is_dir($themeViewsDir)) {
                $this->deleteDirectory($themeViewsDir);
            }

            if (is_dir($themeAssetsDir)) {
                $this->deleteDirectory($themeAssetsDir);
            }

            // Also try to remove the parent assets directory if empty
            $parentAssetsDir = dirname($themeAssetsDir);
            if (is_dir($parentAssetsDir) && count(scandir($parentAssetsDir)) == 2) { // empty dir has 2 entries (. and ..)
                rmdir($parentAssetsDir);
            }

            // Remove record from database
            deleteRecord($tableName, $pkName, $themeId);

            $createSuccessMsg = config('CustomConfig')->deleteSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            // Log activity
            logActivity($loggedInUserId, ActivityTypes::THEME_DELETION, 'User with id: ' . $loggedInUserId . ' deleted theme for table name: ' . $tableName .' with path: ' . $themePath);

            return redirect()->to('/account/appearance/themes');
        }
        catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            session()->setFlashdata('errorAlert', $errorMsg);

            // Log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_DELETE_LOG, 'User with id: ' . $loggedInUserId . ' failed to delete theme for table name: ' . $tableName .' with path: ' . $themePath . '. Error: ' . $errorMsg);

            return redirect()->to('/account/appearance/themes');
        }
    }

    protected function getThemesData()
    {
        $url = 'https://ignitercms.com/themes/';
        $json = @file_get_contents($url);

        if ($json === false) {
            // Handle error, maybe return an empty array or log the error
            return [];
        }

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return [];
        }

        return $data;
    }

    /**
     * Helper function to copy directory recursively
     */
    private function copyDirectory($source, $destination)
    {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $dir = opendir($source);
        while (($file = readdir($dir)) !== false) {
            if ($file != '.' && $file != '..') {
                $srcFile = $source . '/' . $file;
                $destFile = $destination . '/' . $file;

                if (is_dir($srcFile)) {
                    $this->copyDirectory($srcFile, $destFile);
                } else {
                    copy($srcFile, $destFile);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Helper function to delete directory recursively
     */
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }

    
    //############################//
    //        Theme Files         //
    //############################//
    public function viewFiles()
    {
        return view('back-end/appearance/theme-editor/index');
    }

    public function homeFileEditor()
    {
        // Get the file you want to edit
        $homeFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/home/index.php';
        
        // Get only the file name (not the whole path) to display it
        $homeFilename = basename($homeFilePath);

        if (!file_exists($homeFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $homeFileContent = file_get_contents($homeFilePath);
        
        $data = [
            'homeFilename' => $homeFilename,
            'homeFilePath' => $homeFilePath,
            'homeFileContent' => $homeFileContent
        ];

        return view('back-end/appearance/theme-editor/home', $data);
    }

    public function layoutFileEditor()
    {
        // Get the file you want to edit
        $layoutFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/layout/_layout.php';
        
        // Get only the file name (not the whole path) to display it
        $layoutFilename = basename($layoutFilePath);

        if (!file_exists($layoutFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $layoutFileContent = file_get_contents($layoutFilePath);
        
        $data = [
            'layoutFilename' => $layoutFilename,
            'layoutFilePath' => $layoutFilePath,
            'layoutFileContent' => $layoutFileContent
        ];

        return view('back-end/appearance/theme-editor/layout', $data);
    }

    public function blogsFileEditor()
    {
        // Get the file you want to edit
        $blogsFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/blogs/index.php';
        
        // Get only the file name (not the whole path) to display it
        $blogsFilename = basename($blogsFilePath);

        if (!file_exists($blogsFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $blogsFileContent = file_get_contents($blogsFilePath);
        
        $data = [
            'blogsFilename' => $blogsFilename,
            'blogsFilePath' => $blogsFilePath,
            'blogsFileContent' => $blogsFileContent
        ];

        return view('back-end/appearance/theme-editor/blogs', $data);
    }

    public function viewBlogFileEditor()
    {
        // Get the file you want to edit
        $viewBlogFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/blogs/view-blog.php';
        
        // Get only the file name (not the whole path) to display it
        $viewBlogFilename = basename($viewBlogFilePath);

        if (!file_exists($viewBlogFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewBlogFileContent = file_get_contents($viewBlogFilePath);
        
        $data = [
            'viewBlogFilename' => $viewBlogFilename,
            'viewBlogFilePath' => $viewBlogFilePath,
            'viewBlogFileContent' => $viewBlogFileContent
        ];

        return view('back-end/appearance/theme-editor/view-blog', $data);
    }

    public function viewPageFileEditor()
    {
        // Get the file you want to edit
        $viewPageFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/pages/view-page.php';
        
        // Get only the file name (not the whole path) to display it
        $viewPageFilename = basename($viewPageFilePath);

        if (!file_exists($viewPageFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewPageFileContent = file_get_contents($viewPageFilePath);
        
        $data = [
            'viewPageFilename' => $viewPageFilename,
            'viewPageFilePath' => $viewPageFilePath,
            'viewPageFileContent' => $viewPageFileContent
        ];

        return view('back-end/appearance/theme-editor/view-page', $data);
    }

    public function searchFileEditor()
    {
        // Get the file you want to edit
        $searchFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/search/index.php';
        
        // Get only the file name (not the whole path) to display it
        $searchFilename = basename($searchFilePath);

        if (!file_exists($searchFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $searchFileContent = file_get_contents($searchFilePath);
        
        $data = [
            'searchFilename' => $searchFilename,
            'searchFilePath' => $searchFilePath,
            'searchFileContent' => $searchFileContent
        ];

        return view('back-end/appearance/theme-editor/search', $data);
    }

    public function searchFilterFileEditor()
    {
        // Get the file you want to edit
        $searchFilterFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/search/filter.php';
        
        // Get only the file name (not the whole path) to display it
        $searchFilterFilename = basename($searchFilterFilePath);

        if (!file_exists($searchFilterFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $searchFilterFileContent = file_get_contents($searchFilterFilePath);
        
        $data = [
            'searchFilterFilename' => $searchFilterFilename,
            'searchFilterFilePath' => $searchFilterFilePath,
            'searchFilterFileContent' => $searchFilterFileContent
        ];

        return view('back-end/appearance/theme-editor/search-filter', $data);
    }

    public function saveFile()
    {
        $filePage = $this->request->getPost('filePage');
        $filePath = $this->request->getPost('filePath');
        $fileContent = $this->request->getPost('fileContent');
    
        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }
    
        if (file_put_contents($filePath, $fileContent) === false) {
            return redirect()->to('/account/appearance/theme-editor/'.$filePage)->with('error', 'Failed to save the file.');
        }
    
        return redirect()->to('/account/appearance/theme-editor/'.$filePage)->with('success', 'File saved successfully.');
    }
}

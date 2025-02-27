<?php

namespace App\Controllers;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FileUploadModel;

class FileManagerController extends BaseController
{
    protected $helpers = ['auth_helper'];
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        // Get logged-in user ID
        $loggedInUserId = $this->session->get('user_id');
        $fileUploadsModel = new FileUploadModel();

        // Get file uploads for the logged-in user
        $fileUploads = $fileUploadsModel->where('user_id', $loggedInUserId)->orderBy('created_at', 'DESC')->limit(intval(getConfigData("queryLimitUltraMax")))->findAll();
        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            // Get file uploads for tall users
            $fileUploads = $fileUploadsModel->findAll();
        } 

        // Set data to pass in view
        $data = [
            'file_uploads' => $fileUploadsModel->where('user_id', $loggedInUserId)->orderBy('created_at', 'DESC')->paginate(100),
            'pager' => $fileUploadsModel->pager,
            'total_file_uploads' => $fileUploadsModel->pager->getTotal()
        ];

        return view('back-end/file-manager/index', $data);
    }

    public function newUpload()
    {
        return view('back-end/file-manager/new-upload');
    }

    public function uploadFile()
    {
        // Get logged-in user ID
        $loggedInUserId = $this->session->get('user_id');
        $uploadDirectory = $this->session->get('upload_directory');
    
        // Load the FileUploadModel
        $fileUploadModel = new FileUploadModel();
    
        // Validation rules from the model
        $validationRules = $fileUploadModel->getValidationRules();
    
        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/file-manager/new-upload', $data);
        }
    
        $dateToday = date('d-m-Y');
        $savePath = 'public/uploads/file-uploads/' . $uploadDirectory .'/' .$dateToday;
        $file = $this->request->getFile('upload_file');
        $caption = $this->request->getPost('caption');
        $uniqueIdentifier = $this->request->getPost('unique_identifier');
        $group = $this->request->getPost('group');
    
        if ($file->isValid() && !$file->hasMoved()) {

            // Generate a random file name
            $fileName = $file->getRandomName();
    
            // Move the file to the upload directory
            if ($file->move($savePath, $fileName)) {
                $filePath = $savePath . '/' . $fileName;
                $fileSize = $file->getSize();
                $fileType = getFileExtension($fileName);

                // Write 403 Forbidden content to index.html in the upload directory
                $indexFilePath = $savePath.'/index.html';
                $forbiddenHtml = generateForbiddenHtml();
                file_put_contents($indexFilePath, $forbiddenHtml);
    
                // Prepare data for database insertion
                $fileId = getGUID();
                $fileData = [
                    'file_id' => $fileId,
                    'user_id' => $loggedInUserId,
                    'file_name' => $fileName,
                    'file_type' => $fileType,
                    'file_size' => $fileSize,
                    'upload_path' => $filePath,
                    'caption' => $caption,
                    'unique_identifier' => $uniqueIdentifier ?? generateContentIdentifier("file"),
                    'group' => $group,
                    'deletable' => 1,
                ];
    
                // Call saveFile method from the FileUploadModel
                if (addRecord('file_uploads', $fileData)) {
                    // File uploaded and record created successfully
                    $insertedId = $fileId;
                    $successMsg = config('CustomConfig')->createSuccessMsg;
                    session()->setFlashdata('successAlert', $successMsg);

                    // Log activity
                    logActivity($loggedInUserId, ActivityTypes::FILE_UPLOADED, 'File uploaded with id: ' . $insertedId);
    
                    return redirect()->to('/account/file-manager');
                } else {
                    // Failed to create database record
                    $errorMsg = config('CustomConfig')->errorMsg;
                    session()->setFlashdata('errorAlert', $errorMsg);
    
                    // Log activity
                    logActivity($loggedInUserId, ActivityTypes::FAILED_FILE_UPLOAD, 'Failed to save file record in database');
    
                    return redirect()->back()->withInput();
                }
            } else {
                // Failed to move the uploaded file
                $errorMsg = 'Failed to move the uploaded file.';
                session()->setFlashdata('errorAlert', $errorMsg);
    
                return redirect()->back()->withInput();
            }
        } else {
            // Invalid file or file has already been moved
            $errorMsg = 'Invalid file or file has already been moved.';
            session()->setFlashdata('errorAlert', $errorMsg);
    
            return redirect()->back()->withInput();
        }
    }

    public function newUrlUpload()
    {
        return view('back-end/file-manager/new-url-upload');
    }

    public function uploadUrlFile()
    {
        // Get logged-in user ID
        $loggedInUserId = $this->session->get('user_id');
        $uploadDirectory = $this->session->get('upload_directory');
    
        $dateToday = date('d-m-Y');
        $file = $this->request->getPost('upload_file');
        $caption = $this->request->getPost('caption');
        $uniqueIdentifier = $this->request->getPost('unique_identifier');
        $group = $this->request->getPost('group');
    
        // Validate the incoming data
        if (empty($file) || !isUrl($file)) {
            // Manually set a validation error message for the 'upload_file' input
            session()->setFlashdata('errorAlert', 'The provided file URL is not valid.');
            return view('back-end/file-manager/new-url-upload');
        }

        // Prepare data for database insertion
        $fileId = getGUID();
        $fileType = getFileExtension($file);
        $fileName = getFileNameFromUrl($fileType);
        $fileSize = getRemoteFileSize($file);
        $filePath = $file;
        $fileData = [
            'file_id' => $fileId,
            'user_id' => $loggedInUserId,
            'file_name' => $fileName,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'upload_path' => $filePath,
            'caption' => $caption,
            'unique_identifier' => $uniqueIdentifier ?? generateContentIdentifier("file"),
            'group' => $group,
            'deletable' => 1,
        ];

        // Call addRecord method from the FileUploadModel
        if (addRecord('file_uploads', $fileData)) {
            // File uploaded and record created successfully
            $insertedId = $fileId;
            $successMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $successMsg);

            // Log activity
            logActivity($loggedInUserId, ActivityTypes::FILE_UPLOADED, 'File uploaded with id: ' . $insertedId);

            return redirect()->to('/account/file-manager');
        } else {
            // Failed to create database record
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            // Log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_FILE_UPLOAD, 'Failed to save file record in database');

            return redirect()->back()->withInput();
        }
    }

    public function editImage()
    {
        // Get logged-in user ID
        $loggedInUserId = $this->session->get('user_id');
        
        $fileId = $this->request->getPost('file_id');
        $image = $this->request->getFile('image');
        
        // Get original file info
        $fileModel = new FileUploadModel();
        $fileInfo = $fileModel->find($fileId);
        
        if (!$fileInfo || $fileInfo['user_id'] !== $loggedInUserId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access or file not found'
            ]);
        }
        
        try {
            // Generate new filename while preserving original extension
            $originalExt = pathinfo($fileInfo['file_name'], PATHINFO_EXTENSION);
            $newFileName = pathinfo($fileInfo['file_name'], PATHINFO_FILENAME) . 
                        '_edited_' . time() . '.' . $originalExt;
            $savePath = dirname($fileInfo['upload_path']);
            
            if ($image->isValid() && !$image->hasMoved()) {
                if ($image->move($savePath, $newFileName)) {
                    $filePath = $savePath . '/' . $newFileName;
                    
                    // Update database with new file info
                    $fileData = [
                        'file_name' => $newFileName,
                        'file_size' => $image->getSize(),
                        'upload_path' => $filePath
                    ];
                    
                    $fileModel->update($fileId, $fileData);
                    
                    // Log activity
                    logActivity($loggedInUserId, ActivityTypes::FILE_EDITED, 
                            'Image edited: ' . $fileId);
                    
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Image updated successfully'
                    ]);
                }
            }
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to save edited image'
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Image edit error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while processing the image'
            ]);
        }
    }
    
    public function downloadFile($fileId)
    {
        $whereClause = ['file_id' => $fileId];
        $fileType = getTableData('file_uploads', $whereClause, 'file_type');
        $filePath = getTableData('file_uploads', $whereClause, 'upload_path');

        // Check if the file exists
        if (file_exists($filePath)) {
            // Use CodeIgniter's response to download the file
            return $this->response->download($filePath, null)->setFileName(getGUID().".".$fileType);
        } else {
            // File not found, set an error message
            session()->setFlashdata('errorAlert', 'File not found.');
            return redirect()->to('/account/file-manager');
        }
    }
}

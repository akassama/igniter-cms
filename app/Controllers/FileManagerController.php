<?php
namespace App\Controllers;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FileManagerController extends BaseController
{
    public function index(): string
    {
        //use ?modal=true in parameter to remove Edit & Delete actions
        $filterQuery = trim($this->request->getGet('modal'));
        $data["filterQuery"] = $filterQuery;
        return view('back-end/file-manager/index', $data);
    }

    public function getFileTags()
    {
        // Check if request is made from this server (CORS)
        if (!$this->validateCORSRequest()) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        // Only allow AJAX requests
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        $filePath = $this->request->getPost('file_path');
        $metadataFile = FCPATH . env("CI_FM_METADATA_FILE");

        $filePath = realpath($filePath);
        $allowedPath = realpath(FCPATH . env("CI_FM_FILES_UPLOAD_PATH"));

        // Verify the file is within the allowed directory
        if (strpos($filePath, $allowedPath) !== 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid file location'
            ]);
        }

        $relativePath = str_replace($allowedPath . DIRECTORY_SEPARATOR, '', $filePath);
        $tags = '';

        if (file_exists($metadataFile)) {
            $metadata = json_decode(file_get_contents($metadataFile), true);
            if (isset($metadata[$relativePath]['tags'])) {
                $tags = implode(', ', $metadata[$relativePath]['tags']);
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'tags' => $tags
        ]);
    }

    public function renameFile()
    {
        // Check if valid secret key
        $secretKey = $this->request->getPost('ajax-file-manager-secret-key');
        if (!$this->validateCISecretKey($secretKey)) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request key'
            ]);
        }

        // Check if request is made from this server (CORS)
        if (!$this->validateCORSRequest()) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        
        // Only allow AJAX requests
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        // Get POST data
        $currentName = $this->request->getPost('modal-edit-file-current-name');
        $newName = $this->request->getPost('modal-edit-file-name');
        $filePath = $this->request->getPost('modal-edit-file-id');
        $tags = $this->request->getPost('modal-edit-file-tags');

        // Validate input
        if (empty($currentName) || empty($newName) || empty($filePath)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required parameters'
            ]);
        }

        // If names are the same and no tags provided, return success
        if ($currentName === $newName && empty($tags)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'No changes made'
            ]);
        }

        // Security checks
        $filePath = realpath($filePath);
        $allowedPath = realpath(FCPATH . env("CI_FM_FILES_UPLOAD_PATH"));

        // Verify the file is within the allowed directory
        if (strpos($filePath, $allowedPath) !== 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid file location'
            ]);
        }

        // Sanitize file names
        $currentName = $this->sanitizeFilename($currentName);
        $newName = $this->sanitizeFilename($newName);

        // Build full paths
        $directory = dirname($filePath) . DIRECTORY_SEPARATOR;
        $oldPath = $directory . $currentName;
        $newPath = $directory . $newName;

        try {
            // Check if file exists
            if (!file_exists($oldPath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Original file not found'
                ]);
            }

            // Check if new filename exists
            if ($currentName !== $newName && file_exists($newPath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'A file with that name already exists'
                ]);
            }

            // Handle tags
            $metadataFile = FCPATH . env("CI_FM_METADATA_FILE");
            $metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];
            $relativeOldPath = str_replace($allowedPath . DIRECTORY_SEPARATOR, '', $oldPath);
            $relativeNewPath = str_replace($allowedPath . DIRECTORY_SEPARATOR, '', $newPath);

            // Parse tags
            $tagArray = !empty($tags) ? array_map('trim', explode(',', $tags)) : [];
            $tagArray = array_filter($tagArray); // Remove empty tags

            // Update metadata
            if ($currentName !== $newName) {
                // Remove old entry if it exists
                if (isset($metadata[$relativeOldPath])) {
                    $temp = $metadata[$relativeOldPath];
                    unset($metadata[$relativeOldPath]);
                    $metadata[$relativeNewPath] = $temp;
                } else {
                    $metadata[$relativeNewPath] = [];
                }
            }

            // Update tags in metadata
            $metadata[$relativeNewPath]['tags'] = $tagArray;

            // Write metadata back to file
            file_put_contents($metadataFile, json_encode($metadata, JSON_PRETTY_PRINT));

            // Attempt to rename
            if ($currentName !== $newName && !rename($oldPath, $newPath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to rename file'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'File updated successfully',
                'newPath' => $newPath
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: Failed to update file, ' . $e->getMessage()
            ]);
        }
    }

    public function deleteFile()
    {
        // Check if request is made from this server (CORS)
        if (!$this->validateCORSRequest()) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        // Only allow AJAX requests
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        // Get POST data
        $filePath = $this->request->getPost('file_path');
        $fileName = $this->request->getPost('file_name');

        // Validate input
        if (empty($filePath) || empty($fileName)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required parameters'
            ]);
        }

        // Security checks
        $filePath = realpath($filePath);
        $allowedPath = realpath(FCPATH . env("CI_FM_FILES_UPLOAD_PATH"));

        // Verify the file is within the allowed directory
        if (strpos($filePath, $allowedPath) !== 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid file location'
            ]);
        }

        try {
            // Update metadata
            $metadataFile = FCPATH . env("CI_FM_METADATA_FILE");
            $metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];
            $relativePath = str_replace($allowedPath . DIRECTORY_SEPARATOR, '', $filePath);

            // Remove metadata entry
            if (isset($metadata[$relativePath])) {
                unset($metadata[$relativePath]);
                file_put_contents($metadataFile, json_encode($metadata, JSON_PRETTY_PRINT));
            }

            // Check if it's a directory
            if (is_dir($filePath)) {
                // Delete directory recursively
                $this->deleteDirectory($filePath);
            } else {
                // Delete single file
                if (!file_exists($filePath)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'File not found'
                    ]);
                }
                
                if (!unlink($filePath)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to delete file'
                    ]);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'File deleted successfully'
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function uploadFiles()
    {
        // Check if request is made from this server (CORS)
        if (!$this->validateCORSRequest()) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        // First check if content length exceeds post_max_size
        $postMaxSize = $this->parseSize(ini_get('post_max_size'));
        if ($_SERVER['CONTENT_LENGTH'] > $postMaxSize) {
            return $this->response->setStatusCode(413)->setJSON([
                'success' => false,
                'message' => 'Total upload size exceeds server limit of ' . ini_get('post_max_size')
            ]);
        }

        // Get configuration from .env
        $maxUploadSize = env("CI_FM_MAX_UPLOAD_SIZE", 10 * 1024 * 1024); // Default to 10MB
        $allowedTypes = array_map('trim', explode(',', env("CI_FM_ALLOWED_UPLOAD_TYPES", "jpg,jpeg,png,gif,webp")));
        $allowedTypes = array_map('strtolower', $allowedTypes);

        // Get POST data
        $overwrite = (bool)$this->request->getPost('overwrite');
        $uploadPath = $this->request->getPost('upload_path');
        $tags = $this->request->getPost('tags');
        
        // Security check - verify upload path is within allowed directory
        $allowedPath = realpath(FCPATH . env("CI_FM_FILES_UPLOAD_PATH"));
        $uploadPath = realpath($uploadPath);
        
        if (strpos($uploadPath, $allowedPath) !== 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid upload location'
            ]);
        }

        // Get uploaded files
        $files = $this->request->getFiles();
        $uploadedCount = 0;
        $errors = [];

        if (!$files || !isset($files['files'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No files were uploaded'
            ]);
        }

        // Load or initialize metadata
        $metadataFile = FCPATH . env("CI_FM_METADATA_FILE");
        $metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];
        $tagArray = !empty($tags) ? array_map('trim', explode(',', $tags)) : [];
        $tagArray = array_filter($tagArray); // Remove empty tags

        foreach ($files['files'] as $file) {
            if ($file->getError() === UPLOAD_ERR_INI_SIZE) {
                $errors[] = "File '{$file->getClientName()}' exceeds server upload limit";
                continue;
            }

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getClientName();
                $fileExt = strtolower(pathinfo($newName, PATHINFO_EXTENSION));
                $destination = $uploadPath . DIRECTORY_SEPARATOR . $newName;

                // Check file size against max upload size
                if ($file->getSize() > $maxUploadSize) {
                    $errors[] = "File '{$newName}' exceeds maximum upload size of " . $this->formatBytes($maxUploadSize);
                    continue;
                }

                // Check file type against allowed types
                if (!in_array($fileExt, $allowedTypes)) {
                    $errors[] = "File '{$newName}' has invalid type (.{$fileExt}). Allowed types: " . implode(', ', $allowedTypes);
                    continue;
                }

                // Check if file exists and overwrite is disabled
                if (file_exists($destination) && !$overwrite) {
                    $errors[] = "File '{$newName}' already exists (overwrite disabled)";
                    continue;
                }

                try {
                    if ($file->move($uploadPath, $newName, $overwrite)) {
                        $relativePath = str_replace($allowedPath . DIRECTORY_SEPARATOR, '', $destination);
                        $metadata[$relativePath] = ['tags' => $tagArray];
                        $uploadedCount++;
                    } else {
                        $errors[] = "Failed to upload '{$newName}'";
                    }
                } catch (\Exception $e) {
                    $errors[] = "Error uploading '{$newName}': " . $e->getMessage();
                }
            } else {
                $errors[] = "File '{$file->getClientName()}' is invalid or already moved";
            }
        }

        // Write metadata back to file
        if ($uploadedCount > 0) {
            file_put_contents($metadataFile, json_encode($metadata, JSON_PRETTY_PRINT));
        }

        if ($uploadedCount > 0) {
            return $this->response->setJSON([
                'success' => true,
                'uploaded_count' => $uploadedCount,
                'message' => $uploadedCount . ' file(s) uploaded successfully' . 
                            ($errors ? ' (with some errors)' : ''),
                'errors' => $errors
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'No files were uploaded: ' . implode('; ', $errors)
        ]);
    }

    public function bulkDelete()
    {
        // Check if request is made from this server (CORS)
        if (!$this->validateCORSRequest()) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }
        
        // Verify AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed'
            ]);
        }

        // Get JSON data
        $json = $this->request->getJSON();
        $files = $json->files ?? [];
        $deletedCount = 0;
        $errors = [];

        // Base directory for security checks
        $basePath = realpath(FCPATH . env("CI_FM_FILES_UPLOAD_PATH"));
        
        // Additional security - validate the base path exists
        if (!$basePath) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid base directory'
            ]);
        }

        // Load metadata
        $metadataFile = FCPATH . env("CI_FM_METADATA_FILE");
        $metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];

        foreach ($files as $file) {
            try {
                // Validate file path structure
                if (empty($file->path) || strpos($file->path, '..') !== false) {
                    $errors[] = "Skipped '{$file->name}' - invalid path";
                    continue;
                }

                $filePath = realpath($file->path);

                // Security check - verify file is within allowed directory
                if (!$filePath || strpos($filePath, $basePath) !== 0) {
                    $errors[] = "Skipped '{$file->name}' - invalid location";
                    continue;
                }

                // Remove metadata entry
                $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $filePath);
                if (isset($metadata[$relativePath])) {
                    unset($metadata[$relativePath]);
                }

                if ($file->isDir) {
                    // Delete directory recursively
                    if ($this->deleteDirectory($filePath)) {
                        $deletedCount++;
                    } else {
                        $errors[] = "Failed to delete directory '{$file->name}'";
                    }
                } else {
                    // Delete single file
                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            $deletedCount++;
                        } else {
                            $errors[] = "Failed to delete file '{$file->name}'";
                        }
                    } else {
                        $errors[] = "File not found: '{$file->name}'";
                    }
                }
            } catch (\Exception $e) {
                $errors[] = "Error deleting '{$file->name}': " . $e->getMessage();
            }
        }

        // Write metadata back to file
        file_put_contents($metadataFile, json_encode($metadata, JSON_PRETTY_PRINT));

        return $this->response->setJSON([
            'success' => $deletedCount > 0,
            'deleted_count' => $deletedCount,
            'message' => $deletedCount > 0 ? 'Deleted ' . $deletedCount . ' item(s)' : 'No items deleted',
            'errors' => $errors
        ]);
    }

    /**
     * Parse size string (like '10M') to bytes
     */
    private function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
        $size = preg_replace('/[^0-9\.]/', '', $size);
        if ($unit) {
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        }
        return round($size);
    }

    /**
     * Helper function to format bytes into human-readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Helper method to sanitize filenames
     */
    protected function sanitizeFilename(string $filename): string
    {
        // Remove any characters that aren't alphanumeric, dots, hyphens, or underscores
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
        
        // Remove leading/trailing dots and multiple dots
        $filename = trim($filename, '.');
        $filename = preg_replace('/\.+/', '.', $filename);
        
        // Prevent directory traversal
        $filename = str_replace('..', '', $filename);
        
        // Ensure filename is not empty after sanitization
        if (empty($filename)) {
            $filename = 'unnamed_file';
        }
        
        return $filename;
    }

    /**
     * Validate CORS request to ensure it comes from the same server
     */
    protected function validateCORSRequest(): bool
    {
        $origin = $this->request->getHeaderLine('Origin');
        $host = $this->request->getServer('HTTP_HOST');
        $serverUrl = base_url();

        // If no origin is provided, assume it's a same-server request
        if (empty($origin)) {
            return true;
        }

        // Parse the origin to compare with the server URL
        $parsedOrigin = parse_url($origin);
        $parsedServer = parse_url($serverUrl);

        $originHost = $parsedOrigin['host'] ?? '';
        $serverHost = $parsedServer['host'] ?? $host;

        // Compare hosts to ensure they match
        return $originHost === $serverHost;
    }

    /**
     * Validate the secret key for file manager operations
     */
    protected function validateCISecretKey($key): bool
    {
        return $key === env('CI_FM_SECRET');
    }

    /**
     * Recursively delete a directory and its contents
     */
    protected function deleteDirectory(string $dirPath): bool
    {
        if (!is_dir($dirPath)) {
            return false;
        }

        if (substr($dirPath, strlen($dirPath) - 1, 1) != DIRECTORY_SEPARATOR) {
            $dirPath .= DIRECTORY_SEPARATOR;
        }

        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDirectory($file);
            } else {
                unlink($file);
            }
        }

        return rmdir($dirPath);
    }
}
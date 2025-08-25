<?php
class AssetManager {
    private static $includedAssets = [];

    /**
     * Includes a CSS asset if it hasn't been included yet.
     *
     * @param string $href The URL of the CSS file.
     * @param string $rel The relationship attribute (default: 'stylesheet').
     * @param string $type The MIME type (default: 'text/css').
     * @return string The HTML link tag or empty string if already included.
     */
    public static function includeCss($href, $rel = 'stylesheet', $type = 'text/css') {
        if (in_array($href, self::$includedAssets)) {
            return '';
        }
        self::$includedAssets[] = $href;
        return "<link href=\"$href\" rel=\"$rel\" type=\"$type\">\n";
    }

    /**
     * Includes a JavaScript asset if it hasn't been included yet.
     *
     * @param string $src The URL of the JavaScript file.
     * @param bool $defer Whether to add the defer attribute (default: false).
     * @return string The HTML script tag or empty string if already included.
     */
    public static function includeJs($src, $defer = false) {
        if (in_array($src, self::$includedAssets)) {
            return '';
        }
        self::$includedAssets[] = $src;
        $deferAttr = $defer ? ' defer' : '';
        return "<script src=\"$src\"$deferAttr></script>\n";
    }
}

// CIFM version
define('APP_VERSION', '1.0.0');
define('APP_TITLE', 'CodeIgniter File Manager');

// Files stat data
$totalFileSize = 0;
$totalFiles    = 0;
$totalFolders  = 0;
$lastUpdated  = "";

// Set path-related and secret variables
$root_files_folder_name = env("CI_FM_FILES_UPLOAD_PATH");
$base_url = base_url();
$file_manager_url  = $base_url . env("CI_FM_ROUTE") . "/";
$file_preview_url  = $base_url . $root_files_folder_name . "/";
$file_manager_path = FCPATH . $root_files_folder_name . "/";
$file_manager_secret_key = env("CI_FM_SECRET");
$metadata_file = FCPATH . env("CI_FM_METADATA_FILE");

// Utility functions
function cifGetFileExtension($entry, $fullPath) {
    if (is_dir($fullPath)) {
        return 'folder';
    }

    $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));

    return $extension;
}

function cifGetFileIcon($entry, $fullPath) {
    if (is_dir($fullPath)) {
        return '<i class="ri-folder-fill folder-icon"></i>';
    }

    $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
    $icons = [
        'jpg' => 'ri-image-line', 'jpeg'=> 'ri-image-line', 'png' => 'ri-image-line',
        'gif' => 'ri-image-line', 'pdf' => 'ri-file-pdf-2-line',
        'xls' => 'ri-file-excel-line', 'xlsx'=> 'ri-file-excel-line',
        'zip' => 'ri-file-zip-line', 'rar' => 'ri-file-zip-line',
        'txt' => 'ri-file-text-line', 'doc' => 'ri-file-word-line', 'docx'=> 'ri-file-word-line',
        'mp4' => 'ri-movie-fill', 'mov' => 'ri-mv-line', 'mp3' => 'ri-music-2-line', 'ogg' => 'ri-music-2-line',
        'php' => 'ri-file-code-line', 'js' => 'ri-file-code-line', 'css' => 'ri-file-code-line', 'json'=> 'ri-file-code-line',
        'gpg' => 'ri-shield-keyhole-line', 'pgp' => 'ri-shield-keyhole-line',
    ];
    return '<i class="' . ($icons[$extension] ?? 'ri-file-line') . ' file-icon"></i>';
}

function cifGetFileSize($path) {
    if (is_dir($path)) return 'Folder';
    $size = filesize($path);
    return $size >= 1048576 ? round($size / 1048576, 2) . ' MB' : round($size / 1024) . ' KB';
}

function cifGetLastModifiedDate($path) {
    return date(env("CI_FM_LAST_MODIFIED_DATE_FORMAT"), filemtime($path));
}

function cifGetFilePermissions($path) {
    return substr(sprintf('%o', fileperms($path)), -4);
}

function cifFormatSize($bytes) {
    return $bytes >= 1048576 ? round($bytes / 1048576, 2) . ' MB' : round($bytes / 1024) . ' KB';
}

function cifGetOwnerAuthor($path) {
    try {
        $path = realpath($path);

        if (!$path || !file_exists($path)) {
            return 'File not found';
        }

        $ownerId = fileowner($path);

        // Windows or failure fallback
        if ($ownerId === false || $ownerId === 0) {
            return (stripos(PHP_OS, 'WIN') === 0) ? 'Windows (unknown)' : 'UID: 0 (possibly root)';
        }

        // Try resolving UID to username on Linux
        if (function_exists('posix_getpwuid')) {
            $ownerInfo = posix_getpwuid($ownerId);
            return $ownerInfo['name'] ?? "UID: $ownerId";
        }

        return "UID: $ownerId"; // Fallback for environments without posix
    } catch (Exception $e) {
        return 'Unknown';
    }
}

function cifGetCreationDate($path) {
    return date(env("CI_FM_LAST_MODIFIED_DATE_FORMAT", "F j, Y, g:i A"), filectime($path));
}

function cifGetImageDimensions($path) {
    if (is_dir($path)) {
        return '';
    }
    $image_types = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'];
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($extension, $image_types)) {
        try {
            $imageInfo = getimagesize($path);
            return $imageInfo ? "{$imageInfo[0]}x{$imageInfo[1]}" : '';
        } catch (Exception $e) {
            return '';
        }
    }
    return '';
}

function cifGetPreviewThumbnail($path, $file_name, $file_preview_url) {
    if (is_dir($path)) {
        return 'https://placehold.co/40x40/ffc107/white?text=Folder';
    }
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $image_types = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'];
    $video_types = ['mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv'];
    if (in_array($extension, $image_types)) {
        return $file_preview_url . rawurlencode($file_name);
    } elseif (in_array($extension, $video_types)) {
        // Placeholder for videos; implement server-side thumbnail generation if needed
        return 'https://placehold.co/40x40/9b59b6/white?text=Video';
    }
    return 'https://placehold.co/40x40/95a5a6/white?text=File';
}

function cifGetFileTags($path, $metadata_file) {
    $tags = '';
    if (file_exists($metadata_file)) {
        $metadata = json_decode(file_get_contents($metadata_file), true);
        $relative_path = str_replace(FCPATH . env("CI_FM_FILES_UPLOAD_PATH") . '/', '', $path);
        if (isset($metadata[$relative_path]) && !empty($metadata[$relative_path]['tags'])) {
            $tags = implode(', ', $metadata[$relative_path]['tags']);
        }
    }
    return $tags ?: '-';
}

function cifActionLinks($extension, $file_name, $file_path, $file_preview_url, $filterQuery = false) {
    if (strtolower($extension) !== "folder") {

        // Escape backslashes for JavaScript compatibility
        $escaped_path = str_replace('\\', '\\\\', $file_path);
        $escaped_file_preview_url = str_replace('\\', '\\\\', $file_preview_url);
        $escaped_full_url = $escaped_file_preview_url.$file_name;
        $base_url = base_url();
        $relative_url_path = str_replace($base_url,"",$escaped_full_url);

        $editFileIconBtn = '';
        $deleteFileIconBtn = '';
        if (!boolval($filterQuery)){
            $editFileIconBtn = '<button class="action-btn edit" data-bs-toggle="tooltip" title="Edit file/tags" onclick="showEditModal(\'' . $escaped_path . '\', \'' . $file_name . '\')">
                        <i class="ri-edit-line"></i>
                    </button>';
            $deleteFileIconBtn = '<button class="action-btn delete" data-bs-toggle="tooltip" title="Delete file" onclick="confirmDelete(\'' . $escaped_path . '\', \'' . $file_name . '\')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>';
        }

        return ''.$editFileIconBtn.'
                <button class="action-btn link" data-bs-toggle="tooltip" title="Get relative link" onclick="copyRelativeFilePath(\'' . $relative_url_path . '\')">
                    <i class="ri-link"></i>
                </button>
                <button class="action-btn link" data-bs-toggle="tooltip" title="Get link" onclick="copyFilePath(\'' . $escaped_file_preview_url . '\', \'' . $file_name . '\')">
                    <i class="ri-external-link-line"></i>
                </button>
                <button class="action-btn download" data-bs-toggle="tooltip" title="Download file" onclick="downloadFileUrl(\'' . $escaped_file_preview_url . '\', \'' . $file_name . '\')">
                    <i class="ri-download-2-line"></i>
                </button>
                '.$deleteFileIconBtn.'';
    }

    return "";
}

function cifFileRowId() {
    return uniqid('row_', true);
}

function cifPreviewFileLink($extension, $file_preview_url, $file_name) {
    $ext = strtolower($extension);

    $image_types = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff', 'svg'];
    if (in_array($ext, $image_types)) {
        return $file_preview_url.$file_name;
    }

    switch ($ext) {
        case 'folder':
            return 'https://placehold.co/150x150/ffc107/white?text=Folder';
        case 'pdf':
            return 'https://placehold.co/150x150/B20000/white?text=PDF';
        case 'zip':
        case 'rar':
        case '7z':
        case 'tar':
        case 'gz':
        case 'bz2':
            return 'https://placehold.co/150x150/6c757d/white?text=ARCHIVE';
        case 'doc':
        case 'docx':
        case 'odp':
            return 'https://placehold.co/150x150/2b579a/white?text=WORD';
        case 'xls':
        case 'xlsx':
        case 'ods':
            return 'https://placehold.co/150x150/21ba45/white?text=EXCEL';
        case 'ppt':
        case 'pptx':
        case 'odp':
            return 'https://placehold.co/150x150/d44b24/white?text=POWERPOINT';
        case 'txt':
        case 'rtf':
        case 'log':
            return 'https://placehold.co/150x150/3498db/white?text=TEXT';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
        case 'bmp':
        case 'svg':
        case 'webp':
            return 'https://placehold.co/150x150/8e44ad/white?text=IMAGE';
        case 'mp4':
        case 'mov':
        case 'avi':
        case 'mkv':
        case 'wmv':
        case 'flv':
            return 'https://placehold.co/150x150/9b59b6/white?text=VIDEO';
        case 'mp3':
        case 'wav':
        case 'ogg':
        case 'flac':
        case 'aac':
        case 'wma':
            return 'https://placehold.co/150x150/ff66cc/white?text=AUDIO';
        case 'js':
        case 'php':
        case 'html':
        case 'htm':
        case 'css':
        case 'scss':
        case 'less':
        case 'json':
        case 'xml':
        case 'py':
        case 'java':
        case 'c':
        case 'cpp':
        case 'h':
        case 'hpp':
        case 'rb':
        case 'go':
        case 'swift':
        case 'ts':
        case 'jsx':
        case 'tsx':
        case 'vue':
        case 'sql':
            return 'https://placehold.co/150x150/e67e22/white?text=CODE';
        case 'exe':
        case 'msi':
        case 'dmg':
            return 'https://placehold.co/150x150/34495e/white?text=EXECUTABLE';
        default:
            return 'https://placehold.co/150x150/95a5a6/white?text=FILE';
    }
}

/**
 * Generates the HTML table for the file manager.
 *
 * @param string $file_manager_path The absolute path to the directory being managed.
 * @param string $base_url The base URL for public file access.
 * @param string $file_manager_url The URL of the file manager page itself (for previews).
 * @param string $file_preview_url The base URL for file previews.
 * @param string $metadata_file The path to the metadata JSON file.
 * @param bool $filterQuery Whether to filter the file list.
 * @return array Contains the HTML table, and file statistics.
 */
function cifGenerateFileManagerTable(
    $file_manager_path,
    $base_url,
    $file_manager_url,
    $file_preview_url,
    $metadata_file,
    $filterQuery = false
) {
    $totalFolders = 0;
    $totalFiles = 0;
    $totalFileSize = 0;
    $lastUpdated = "1970-01-01";
    $lastUpdatedFile = "";
    $tableRows = '';

    //If directory doe not exist, create it
    if (!is_dir($file_manager_path)) {
        mkdir($file_manager_path, 0777, TRUE);

    }
    $dirHandle = opendir($file_manager_path);
    if ($dirHandle === false) {
        return [
            'table_html' => '<div class="alert alert-danger" role="alert">Unable to open file manager directory.</div>',
            'totalFolders' => 0,
            'totalFiles' => 0,
            'totalFileSize' => 0,
            'lastUpdated' => $lastUpdated,
            'lastUpdatedFile' => $lastUpdatedFile,
        ];
    }

    while (($entry = readdir($dirHandle)) !== false) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }

        $fullPath = $file_manager_path . $entry;
        $modTime = filemtime($fullPath);

        // Track last updated file
        if ($modTime > strtotime($lastUpdated)) {
            $lastUpdated = date(env("CI_FM_LAST_UPDATED_DATE_FORMAT"), $modTime);
            $lastUpdatedFile = $entry;
        }

        $publicUrl = $base_url . 'files/' . rawurlencode($entry);
        $extension = cifGetFileExtension($entry, $fullPath);
        $icon = cifGetFileIcon($entry, $fullPath);
        $size = cifGetFileSize($fullPath);
        $date = cifGetLastModifiedDate($fullPath);
        $perm = cifGetFilePermissions($fullPath);
        $owner = cifGetOwnerAuthor($fullPath);
        $created = cifGetCreationDate($fullPath);
        $dimensions = cifGetImageDimensions($fullPath);
        $thumbnail = cifGetPreviewThumbnail($fullPath, $entry, $file_preview_url);
        $tags = cifGetFileTags($fullPath, $metadata_file);
        $actionLinks = cifActionLinks($extension, $entry, $fullPath, $file_preview_url, $filterQuery);
        $fileName = $entry;
        $fileNameLink = strtolower($extension) === "folder" ? "<a href=\"{$file_manager_url}?p={$entry}\">{$entry}</a>" : "{$entry}";
        $row_id = cifFileRowId();
        $preview = cifPreviewFileLink($extension, $file_preview_url, $fileName);

        // Accumulate file size for non-folders
        if (!is_dir($fullPath)) {
            $totalFileSize += filesize($fullPath);
            $totalFiles++;
        } else {
            $totalFolders++;
        }

        if (strtolower($extension) !== "folder") {
            $tableRows .= "<tr id=\"{$row_id}\">
                            <td><input type=\"checkbox\" class=\"form-check-input file-checkbox\" id=\"{$publicUrl}\" name=\"{$entry}\"></td>
                            <td>
                                <div class=\"file-name preview-image-div\" data-preview-image=\"{$preview}\">
                                    <img src=\"{$thumbnail}\" class=\"thumbnail-img\" alt=\"Thumbnail\">
                                </div>
                            </td>
                            <td>
                                <div class=\"file-name preview-image-div\" data-preview-image=\"{$preview}\" data-bs-toggle='tooltip' title='File name: {$fileNameLink}'>
                                    {$icon}
                                    <span>{$fileNameLink}</span>
                                </div>
                            </td>
                            <td data-bs-toggle='tooltip' title='File size: {$size}'>{$size}</td>
                            <td data-bs-toggle='tooltip' title='File type: {$extension}'>{$extension}</td>
                            <td data-bs-toggle='tooltip' title='File owner: {$owner}'>{$owner}</td>
                            <td data-bs-toggle='tooltip' title='Created on: {$created}'>{$created}</td>
                            <td data-bs-toggle='tooltip' title='File deminsion: {$dimensions} PX'>{$dimensions}</td>
                            <td data-bs-toggle='tooltip' title='File tags: {$tags}'>{$tags}</td>
                            <td data-bs-toggle='tooltip' title='Last modified on: {$date}'>{$date}</td>
                            <td data-bs-toggle='tooltip' title='File permissions: {$perm}'>{$perm}</td>
                            <td>{$actionLinks}</td>
                        </tr>";
        }
    }
    closedir($dirHandle);

    $tableHtml = '
        <div class="table-responsive p-2">
            <table class="table file-table" id="file-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">
                            <input type="checkbox" class="form-check-input" id="select-all">
                        </th>
                        <th style="width: 50px;">Thumb</th>
                        <th>
                            <i class="ri-file-line me-1"></i>
                            Name
                        </th>
                        <th style="width: 100px;">Size</th>
                        <th style="width: 100px;">Type</th>
                        <th style="width: 120px;">Owner</th>
                        <th style="width: 180px;">Created</th>
                        <th style="width: 100px;">Dimensions</th>
                        <th style="width: 150px;">Tags</th>
                        <th style="width: 180px;">Last Modified</th>
                        <th style="width: 100px;">Permissions</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $tableRows . '
                </tbody>
            </table>
        </div>';

    return [
        'table_html' => $tableHtml,
        'totalFolders' => $totalFolders,
        'totalFiles' => $totalFiles,
        'totalFileSize' => cifFormatSize($totalFileSize),
        'lastUpdated' => $lastUpdated,
        'lastUpdatedFile' => $lastUpdatedFile,
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI File Manager</title>
    
    <?php
        // CSS Assets
        echo AssetManager::includeCss('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css');
        echo AssetManager::includeCss('https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css');
        echo AssetManager::includeCss('https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css');
        echo AssetManager::includeCss('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.22.1/sweetalert2.min.css');
        echo AssetManager::includeCss('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css');
        echo AssetManager::includeCss('https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.css');
    ?>
    
    <style>
        .file-manager {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .file-manager-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .file-manager-header {
            background: linear-gradient(135deg, <?=env("CI_FM_PRIMARY_COLOR","#ef4322")?> 0%, <?=env("CI_FM_PSECONDARY_COLOR","#ff6b3b")?>  100%);
            color: white;
            padding: 1rem;
        }
        
        .file-manager-actions {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .file-table {
            margin: 0;
        }
        
        .file-table th {
            background: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
            padding: 1rem 0.75rem;
        }
        
        .file-table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #e9ecef;
        }
        
        .file-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .file-icon {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        /* file icon colors */
        .ri-file-pdf-2-line {
            color: #e74c3c;
        }
        .ri-file-excel-line {
            color: #21ba45;
        }
        .ri-file-zip-line {
            color: #f39c12;
        }
        .ri-file-text-line {
            color: #3498db;
        }
        .ri-file-word-line {
            color: #2b579a;
        }
        .ri-mv-line,
        .ri-movie-fill {
            color: #9b59b6;
        }
        .ri-image-line {
            color: #9acd32; 
        }
        .ri-music-2-line {
            color: #ff66cc; 
        }
        .ri-file-code-line {
            color: #e67e22; 
        }
        .ri-shield-keyhole-line {
            color: #34495e;
        }
        .ri-file-line {
            color: #95a5a6; 
        }
        
        .file-name {
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        
        .folder-icon {
            color: #ffc107;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }
        
        .action-btn {
            border: none;
            background: none;
            padding: 0.25rem;
            margin: 0 0.125rem;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }
        
        .action-btn.edit { color: #007bff; }
        .action-btn.link { color: #17a2b8; }
        .action-btn.copy { color: #28a745; }
        .action-btn.delete { color: #dc3545; }
        
        .file-manager-footer {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .stats-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .stats-value {
            font-weight: 600;
            color: #495057;
        }
        
        .btn-group-custom {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .bulk-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-tooltip {
            position: absolute;
            display: none;
            width: 150px;
            height: auto;
            z-index: 9999;
            pointer-events: none;
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            border-radius: 6px;
        }

        .preview-tooltip img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .thumbnail-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
            vertical-align: middle;
        }
        
        @media (max-width: 768px) {
            .file-manager-actions {
                padding: 1rem;
            }
            
            .file-manager-actions .row {
                gap: 1rem;
            }
            
            .file-table {
                font-size: 0.875rem;
            }
            
            .file-table th,
            .file-table td {
                padding: 0.5rem 0.25rem;
            }
            
            .action-btn {
                padding: 0.125rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <div class="file-manager">
        <div class="container-fluid">
            <div class="file-manager-container">
                <!-- Header -->
                <div class="file-manager-header">
                    <h2 class="mb-0">
                        <i class="ri-folder-line me-2"></i>
                        CI File Manager
                    </h2>
                </div>
                
                <!-- Actions Bar -->
                <div class="file-manager-actions">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="btn-group btn-group-custom me-3" role="group">
                                <button type="button" class="btn btn-primary" data-tippy-content="Upload new file" onclick="showUploadModal()">
                                    <i class="ri-upload-cloud-line me-1"></i>
                                    Upload File
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bulk-actions justify-content-md-end">
                                <?php if (!boolval($filterQuery)): ?>
                                    <select class="form-select form-select-sm" style="width: auto;">
                                        <option value="">Bulk Actions</option>
                                        <option value="delete">Delete Selected</option>
                                    </select>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="applyBulkAction()">Apply</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- File Table -->
                <?php
                    $fileManagerData = cifGenerateFileManagerTable(
                        $file_manager_path,
                        $base_url,
                        $file_manager_url,
                        $file_preview_url,
                        $metadata_file,
                        $filterQuery
                    );

                    // Echo the table HTML
                    echo $fileManagerData['table_html'];

                    // You can now access the calculated statistics
                    $totalFolders = $fileManagerData['totalFolders'];
                    $totalFiles = $fileManagerData['totalFiles'];
                    $totalFileSize = $fileManagerData['totalFileSize'];
                    $lastUpdated = $fileManagerData['lastUpdated'];
                    $lastUpdatedFile = $fileManagerData['lastUpdatedFile'];
                ?>
                
                <!-- Footer Stats -->
                <div class="file-manager-footer">
                    <div class="d-flex gap-4 flex-wrap">
                        <div class="stats-item">
                            <i class="ri-database-line"></i>
                            <span>Total File Size: <span class="stats-value"><?= $totalFileSize ?></span></span>
                        </div>
                        <div class="stats-item">
                            <i class="ri-file-line"></i>
                            <span>File(s): <span class="stats-value"><?= $totalFiles ?></span></span>
                        </div>
                        <div class="stats-item">
                            <i class="ri-folder-line"></i>
                            <span>Folder(s): <span class="stats-value"><?= $totalFolders ?></span></span>
                        </div>
                    </div>
                    <div class="text-muted">
                        <small>Last Updated: <?=$lastUpdated?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upload File Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadFileModalLabel">
                        <i class="ri-upload-cloud-line me-2"></i>
                        Upload Files
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="uploadInput" class="form-label">Select Files</label>
                        <input type="file" class="form-control" id="uploadInput" multiple accept="*/*">
                        <div class="form-text">
                            You can select multiple files. <br>
                            Maximum size: <?= round(env("CI_FM_MAX_UPLOAD_SIZE", 10000000) / (1024 * 1024)) ?>MB per file. <br>
                            Allowed types: <?= str_replace(',', ', ', env('CI_FM_ALLOWED_UPLOAD_TYPES', 'jpg, png')) ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="uploadTags" class="form-label">Tags (comma-separated)</label>
                        <input type="text" class="form-control" id="uploadTags" name="uploadTags" placeholder="e.g., project, important, draft">
                    </div>
                    <!-- Upload Progress (hidden by default) -->
                    <div id="uploadProgress" class="d-none">
                        <div class="mb-2">
                            <small class="text-muted">Uploading files...</small>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted" id="uploading-file"></small>
                            <small class="text-muted">100%</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="overwriteFiles" name="overwriteFiles">
                            <label class="form-check-label" for="overwriteFiles">
                                Overwrite existing files
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="startUpload()">
                        <i class="ri-upload-line me-1"></i>
                        Upload Files
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit File Modal -->
    <div class="modal fade" id="editFileModal" tabindex="-1" aria-labelledby="editFileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFileModalLabel">
                        <i class="ri-edit-line me-2"></i>
                        Edit File: <span id="modal-edit-file-label"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal-edit-file-name" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="modal-edit-file-name" name="modal-edit-file-name" value="">
                    </div>
                    <div class="mb-3">
                        <label for="modal-edit-file-tags" class="form-label">Tags (comma-separated)</label>
                        <input type="text" class="form-control" id="modal-edit-file-tags" name="modal-edit-file-tags" placeholder="e.g., project, important, draft">
                    </div>
                    <div class="d-none">
                        <input type="text" class="form-control" id="modal-edit-file-current-name" name="modal-edit-file-current-name" value="">
                        <input type="text" class="form-control" id="modal-edit-file-id" name="modal-edit-file-id" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="editFileModalButton">
                        <i class="ri-save-line me-1"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="hidden-variables">
        <input type="hidden" class="form-control" id="file_manager_path" name="file_manager_path" value="<?=$file_manager_path?>">
        <input type="hidden" class="form-control" id="file_manager_secret_key" name="file_manager_secret_key" value="<?=$file_manager_secret_key?>">
    </div>

    <?php
        // JavaScript Assets
        echo AssetManager::includeJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js');
        echo AssetManager::includeJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js');
        echo AssetManager::includeJs('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.22.1/sweetalert2.all.min.js');
        echo AssetManager::includeJs('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js');
        echo AssetManager::includeJs('https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy-bundle.umd.min.js');
        echo AssetManager::includeJs('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js');
        echo AssetManager::includeJs('https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js');
    ?>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script>
        $( document ).ready(function() {
            // Initialize Tippy.js tooltips
            tippy('[data-tippy-content]', {
                theme: 'dark',
                animation: 'scale',
                delay: [200, 0]
            });

            //tippy js
            tippy(".copy-btn-label", {
            content: "Click to copy file name",
            placement: "top",
            });
            tippy(".copy-path-label", {
            content: "Click to copy file path",
            placement: "top",
            });
            tippy(".download-btn", {
            content: "Download",
            placement: "top",
            });
            tippy(".edit-file", {
            content: "Edit file data",
            placement: "top",
            });
            tippy(".remove-file", {
            content: "Remove file",
            placement: "top",
            });
            tippy(".reload-files", {
            content: "Reload file manger",
            placement: "top",
            });
            
            // Configure Toastr
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });

        document.getElementById('editFileModalButton').addEventListener('click', function() {
            const newName = document.getElementById('modal-edit-file-name').value;
            const currentName = document.getElementById('modal-edit-file-current-name').value;
            const filePath = document.getElementById('modal-edit-file-id').value;
            const tags = document.getElementById('modal-edit-file-tags').value;
            const fileManagerSecretKey = document.getElementById('file_manager_secret_key')?.value || '';

            // Validate inputs
            if (!newName) {
                showToast('warning', 'File name cannot be empty.');
                return;
            }
            if (!fileManagerSecretKey) {
                showToast('error', 'Secret key is missing.');
                bootstrap.Modal.getInstance(document.getElementById('editFileModal')).hide();
                return;
            }

            // Make AJAX request to rename the file and update tags
            fetch('<?= $file_manager_url ?>renameFile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `modal-edit-file-name=${encodeURIComponent(newName)}&modal-edit-file-current-name=${encodeURIComponent(currentName)}&modal-edit-file-id=${encodeURIComponent(filePath)}&modal-edit-file-tags=${encodeURIComponent(tags)}&ajax-file-manager-secret-key=${encodeURIComponent(fileManagerSecretKey)}`
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error('Unauthorized: Invalid request or secret key.');
                    } else if (response.status === 405) {
                        throw new Error('Method not allowed: AJAX request required.');
                    } else {
                        throw new Error(`Server error: ${response.statusText}`);
                    }
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('success', data.message || 'File updated successfully.');
                    refreshFileList();
                } else {
                    showToast('error', data.message || 'Failed to update file.');
                }
                bootstrap.Modal.getInstance(document.getElementById('editFileModal')).hide();
            })
            .catch(error => {
                showToast('error', error.message || 'An error occurred while updating the file.');
                console.error('Error:', error);
                bootstrap.Modal.getInstance(document.getElementById('editFileModal')).hide();
            });
        });

        // Helper function to show toast notifications
        function showToast(type, message) {
            switch (type.toLowerCase()) {
                case 'success':
                    toastr.success(message, 'Success');
                    break;
                case 'error':
                    toastr.error(message, 'Error');
                    break;
                case 'warning':
                    toastr.warning(message, 'Warning');
                    break;
                default:
                    toastr.info(message, 'Info');
                    break;
            }
        }

        // Function to refresh file list
        function refreshFileList() {
            location.reload();
        }
    </script>

    <!-- Activate DataTable -->
    <script>
    $(document).ready(function() {
        $('#file-table').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: false,
            lengthMenu: [10, 25, 50, 100],
            columnDefs: [
                { orderable: false, searchable: false, targets: [0, 1, -1] }, // Checkbox, Thumb, and Actions
                { orderable: true, searchable: true, targets: [2, 4, 5, 6, 7, 8, 9, 10] }, // Name, Type, Owner, Created, Dimensions, Tags, Modified, Permissions
            ]
        });
    });

    // Select All functionality
    document.addEventListener("DOMContentLoaded", function () {
        const selectAllCheckbox = document.getElementById("select-all");

        selectAllCheckbox.addEventListener("change", function () {
            const checkboxes = document.querySelectorAll(".file-checkbox");
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
        });
    });
    </script>

    
    <script> 
        // SweetAlert2 Delete Confirmation with actual deletion
        function confirmDelete(filePath, fileName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${fileName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'swal-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX request to delete the file
                    fetch('<?= $file_manager_url ?>deleteFile', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: `file_path=${encodeURIComponent(filePath)}&file_name=${encodeURIComponent(fileName)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: data.message || `"${fileName}" has been deleted successfully.`,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            // Refresh the file list after successful deletion
                            refreshFileList();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || `Failed to delete "${fileName}".`,
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: `An error occurred while deleting "${fileName}".`,
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        console.error('Error:', error);
                    });
                }
            });
        }
        
        // Show Copy Success Toast
        function copyRelativeFilePath(filePreviewUrl) {
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.style.position = 'absolute';
            tempInput.style.left = '-1000px'; // Move off-screen
            tempInput.value = filePreviewUrl ;

            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices

            try {
                document.execCommand('copy');
                toastr.success('Copied to clipboard!', 'Success');
            } catch (err) {
                toastr.error('Failed to copy URL', 'Error');
                console.error('Copy failed:', err);
            }

            document.body.removeChild(tempInput);
        }
        
        // Show Copy Success Toast
        function copyFilePath(filePreviewUrl, fileName) {
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.style.position = 'absolute';
            tempInput.style.left = '-1000px'; // Move off-screen
            tempInput.value = filePreviewUrl + fileName;

            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices

            try {
                document.execCommand('copy');
                toastr.success('Copied to clipboard!', 'Success');
            } catch (err) {
                toastr.error('Failed to copy URL', 'Error');
                console.error('Copy failed:', err);
            }

            document.body.removeChild(tempInput);
        }
        
        // Download File
        function downloadFileUrl(filePreviewUrl, fileName) {
            const downloadLink = filePreviewUrl + fileName;

            // Create a temporary anchor element
            const link = document.createElement('a');
            link.href = downloadLink;
            link.download = fileName; // Hint to the browser to download instead of navigating
            link.style.display = 'none';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        // Show Upload Modal
        function showUploadModal() {
            var modal = new bootstrap.Modal(document.getElementById('uploadFileModal'));
            modal.show();
        }
        
        // Start Upload Process
        function startUpload() {
            const fileInput = document.getElementById('uploadInput');
            const files = fileInput.files;
            const overwriteFiles = document.getElementById('overwriteFiles').checked;
            const uploadPath = document.getElementById('file_manager_path').value;
            const tags = document.getElementById('uploadTags').value;
            const maxUploadSize = <?= env("CI_FM_MAX_UPLOAD_SIZE", 2000000) ?>;
            const allowedTypes = "<?= env('CI_FM_ALLOWED_UPLOAD_TYPES', 'jpg,jpeg,png') ?>".toLowerCase().split(',');

            if (files.length === 0) {
                toastr.warning('Please select at least one file to upload.', 'No Files Selected');
                return;
            }

            // Validate file sizes BEFORE uploading
            let hasInvalidFiles = false;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileExt = file.name.split('.').pop().toLowerCase();
                
                // Size validation
                if (file.size > maxUploadSize) {
                    toastr.error(
                        `"${file.name}" exceeds the maximum upload size of ${formatBytes(maxUploadSize)}.`, 
                        'File Too Large'
                    );
                    hasInvalidFiles = true;
                    continue;
                }
                
                // File type validation
                if (!allowedTypes.includes(fileExt)) {
                    toastr.error(
                        `"${file.name}" has an invalid file type (${fileExt}). Allowed types: ${allowedTypes.join(', ')}`,
                        'Invalid File Type'
                    );
                    hasInvalidFiles = true;
                }
            }
            if (hasInvalidFiles) return;

            // Show progress UI
            const progressContainer = document.getElementById('uploadProgress');
            const progressBar = progressContainer.querySelector('.progress-bar');
            const fileNameElement = progressContainer.querySelector('small:first-of-type');
            const progressPercent = progressContainer.querySelector('small:last-of-type');
            
            progressContainer.classList.remove('d-none');
            progressBar.style.width = '0%';
            progressPercent.textContent = '0%';

            // Prepare FormData
            const formData = new FormData();
            formData.append('overwrite', overwriteFiles);
            formData.append('upload_path', uploadPath);
            formData.append('tags', tags);
            
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            // Make AJAX request
            const xhr = new XMLHttpRequest();
            
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percentComplete = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressPercent.textContent = percentComplete + '%';
                    fileNameElement.textContent = files[0].name;
                }
            }, false);
            
            xhr.addEventListener('load', function() {
                try {
                    const response = JSON.parse(this.responseText);
                    
                    if (response.success) {
                        toastr.success(`Successfully uploaded ${response.uploaded_count} file(s)!`, 'Upload Complete');
                        refreshFileList();
                    } else {
                        let errorMsg = response.message || 'Error uploading files';
                        if (response.errors && response.errors.length) {
                            errorMsg += ': ' + response.errors.join('; ');
                        }
                        toastr.error(errorMsg, 'Upload Failed');
                    }
                } catch (e) {
                    let errorMsg = 'Error processing upload response';
                    if (this.status === 413) {
                        errorMsg = 'File too large. Server rejected the upload.';
                    }
                    toastr.error(errorMsg, 'Upload Failed');
                    console.error('Error:', e, 'Response:', this.responseText);
                }
                
                // Hide modal
                bootstrap.Modal.getInstance(document.getElementById('uploadFileModal')).hide();
            });

            xhr.addEventListener('error', function() {
                toastr.error('An error occurred during upload', 'Upload Failed');
                console.error('Upload error:', this.status, this.statusText);
            });

            xhr.open('POST', '<?= $file_manager_url ?>uploadFiles', true);
            xhr.send(formData);
        }

        // Helper function to format bytes (e.g., 2000000 → "2 MB")
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(decimals)) + ' ' + sizes[i];
        }
        
        // Show Edit Modal
        function showEditModal(filePath, fileName) {
            // Fetch current tags
            fetch('<?= $file_manager_url ?>getFileTags', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `file_path=${encodeURIComponent(filePath)}`
            })
            .then(response => response.json())
            .then(data => {
                // Set the modal values
                document.getElementById('modal-edit-file-label').textContent = fileName;
                document.getElementById('modal-edit-file-name').value = fileName;
                document.getElementById('modal-edit-file-current-name').value = fileName;
                document.getElementById('modal-edit-file-id').value = filePath;
                document.getElementById('modal-edit-file-tags').value = data.tags || '';

                var modal = new bootstrap.Modal(document.getElementById('editFileModal'));
                modal.show();
            })
            .catch(error => {
                showToast('error', 'Failed to load file tags.');
                console.error('Error:', error);
            });
        }
        
        // Apply Bulk Action
        async function applyBulkAction() {
            const deletePath = document.getElementById('file_manager_path').value;
            const bulkSelect = document.querySelector('.bulk-actions select');
            const selectedAction = bulkSelect.value;
            const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
            
            if (!selectedAction) {
                toastr.warning('Please select a bulk action.', 'No Action Selected');
                return;
            }
            
            if (checkedBoxes.length === 0) {
                toastr.warning('Please select at least one item.', 'No Items Selected');
                return;
            }
            
            // Prepare file data for deletion
            const filesToDelete = Array.from(checkedBoxes).map(checkbox => {
                const row = checkbox.closest('tr');
                return {
                    name: row.querySelector('.file-name span').textContent,
                    path: row.dataset.filePath || deletePath + row.querySelector('.file-name span').textContent,
                    isDir: row.classList.contains('folder-row') || false
                };
            });

            if (selectedAction === 'delete') {
                Swal.fire({
                    title: 'Delete Selected Items?',
                    html: `You are about to delete <strong>${filesToDelete.length}</strong> item(s):<br><br>` +
                        filesToDelete.map(file => `• ${file.name}`).join('<br>') +
                        '<br><br>This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Yes, delete ${filesToDelete.length} item(s)!`,
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch('<?= $file_manager_url.'bulkDelete' ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    files: filesToDelete
                                })
                            });

                            const data = await response.json();

                            if (data.success) {
                                toastr.success(`Successfully deleted ${data.deleted_count} item(s)!`, 'Bulk Delete Complete');
                                refreshFileList();
                            } else {
                                toastr.error(data.message || 'Error deleting files', 'Delete Failed');
                                if (data.errors) {
                                    data.errors.forEach(error => toastr.warning(error, 'Warning'));
                                }
                            }
                        } catch (error) {
                            toastr.error('An error occurred during deletion', 'Delete Failed');
                            console.error('Error:', error);
                        }

                        // Reset selection
                        checkedBoxes.forEach(cb => cb.checked = false);
                        document.getElementById('selectAll').checked = false;
                        document.getElementById('selectAll').indeterminate = false;
                        bulkSelect.value = '';
                    }
                });
            }
        }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const tooltip = document.createElement("div");
        tooltip.className = "preview-tooltip";
        document.body.appendChild(tooltip);

        const previewDivs = document.querySelectorAll(".preview-image-div");

        previewDivs.forEach(div => {
            const imageUrl = div.getAttribute("data-preview-image");

            div.addEventListener("mouseenter", (e) => {
                tooltip.innerHTML = `<img src="${imageUrl}" alt="Preview - ${imageUrl}">`;
                tooltip.style.display = "block";
            });

            div.addEventListener("mousemove", (e) => {
                tooltip.style.left = e.pageX + 15 + "px";
                tooltip.style.top = e.pageY + 15 + "px";
            });

            div.addEventListener("mouseleave", () => {
                tooltip.style.display = "none";
            });
        });
    });
    </script>

</body>
</html>
<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementPopupsModel extends Model
{
    protected $table            = 'announcement_popups';
    protected $primaryKey       = 'popup_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'popup_id',
        'name',                    // Internal name for reference
        'type',                    // 1-7 for different popup types
        'title',                   // Popup title
        'text',                    // Main content text
        'button_text',             // Primary CTA button text
        'button_color',            // Primary button color e.g. "#333333"
        'cancel_button_text',      // Secondary/cancel button text
        'cancel_button_color',     // Secondary button color
        'link',                    // CTA button link
        'new_tab',                // Open link in new tab
        'delay',                   // Delay before showing popup (in seconds)
        'image',                   // Main image path
        'preview_image',
        'background_color',        // Background color for popup e.g. "#ffffff"
        'text_color',             // Color for text content
        'backdrop_opacity',       // Backdrop overlay opacity (0-1) e.g. 0.7
        'width',                  // Popup width in px
        'height',                 // Popup height in px
        'position',               // Popup position (center, top, etc.)
        'animation',              // Entry/exit animation eg. 'animate__fadeIn', 'animate__fadeInUp', 'animate__fadeInDown', 'animate__fadeInLeft', 'animate__fadeInRight'
        'show_close_button',      // Show/hide close button
        
        // Email subscription related fields
        'enable_subscription',    // Enable/disable email collection
        'subscription_placeholder', // Placeholder text for email input
        'subscription_success_message', // Message after successful subscription
        
        // Countdown timer related fields
        'enable_countdown',       // Enable/disable countdown
        'countdown_end_date',     // End date/time for countdown
        'countdown_format',       // Format of countdown display
        'countdown_expired_text', // Text to show when countdown ends
        
        // General fields
        'order',                 // Display order
        'status',                // Active/Inactive
        'frequency',             // How often to show in days e.g. (0.25, 1, 3, 7, 30 etc.)
        'show_on_pages',         // JSON array or comma list of pages to show on
        'deletable',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|max_length[255]|min_length[2]',
        'title' => 'required|max_length[255]',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
        'title' => 'Title is required',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createPopUp($param = array())
    {
        $popupId = getGUID();
        $data = [
            'popup_id' => $popupId,
            'name' => $param['name'],
            'type' => $param['type'],
            'title' => $param['title'],
            'text' => $param['text'],
            'button_text' => $param['button_text'],
            'button_color' => $param['button_color'],
            'cancel_button_text' => $param['cancel_button_text'],
            'cancel_button_color' => $param['cancel_button_color'],
            'link' => $param['link'],
            'new_tab' => $param['new_tab'],
            'delay' => $param['delay'],
            'image' => $param['image'],
            'background_color' => $param['background_color'],
            'text_color' => $param['text_color'],
            'backdrop_opacity' => $param['backdrop_opacity'],
            'width' => $param['width'],
            'height' => $param['height'],
            'position' => $param['position'],
            'animation' => $param['animation'],
            'show_close_button' => $param['show_close_button'],
            'enable_subscription' => $param['enable_subscription'],
            'subscription_placeholder' => $param['subscription_placeholder'],
            'subscription_success_message' => $param['subscription_success_message'],
            'enable_countdown' => $param['enable_countdown'],
            'countdown_end_date' => $param['countdown_end_date'],
            'countdown_format' => $param['countdown_format'],
            'countdown_expired_text' => $param['countdown_expired_text'],
            'order' => $param['order'],
            'status' => $param['status'],
            'frequency' => $param['frequency'],
            'start_date' => $param['start_date'],
            'end_date' => $param['end_date'],
            'show_on_pages' => $param['show_on_pages'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updatePopUp($popupId, $param = [])
    {
        // Check if record exists
        $existingPopUp = $this->find($popupId);
        if (!$existingPopUp) {
            return false; // not found
        }

        // Update the fields
        $existingPopUp['name'] = $param['name'] ?? $existingPopUp['name'];
        $existingPopUp['type'] = $param['type'] ?? $existingPopUp['type'];
        $existingPopUp['title'] = $param['title'] ?? $existingPopUp['title'];
        $existingPopUp['text'] = $param['text'] ?? $existingPopUp['text'];
        $existingPopUp['button_text'] = $param['button_text'] ?? $existingPopUp['button_text'];
        $existingPopUp['button_color'] = $param['button_color'] ?? $existingPopUp['button_color'];
        $existingPopUp['cancel_button_text'] = $param['cancel_button_text'] ?? $existingPopUp['cancel_button_text'];
        $existingPopUp['cancel_button_color'] = $param['cancel_button_color'] ?? $existingPopUp['cancel_button_color'];
        $existingPopUp['link'] = $param['link'] ?? $existingPopUp['link'];
        $existingPopUp['new_tab'] = $param['new_tab'] ?? $existingPopUp['new_tab'];
        $existingPopUp['delay'] = $param['delay'] ?? $existingPopUp['delay'];
        $existingPopUp['image'] = $param['image'] ?? $existingPopUp['image'];
        $existingPopUp['background_color'] = $param['background_color'] ?? $existingPopUp['background_color'];
        $existingPopUp['text_color'] = $param['text_color'] ?? $existingPopUp['text_color'];
        $existingPopUp['backdrop_opacity'] = $param['backdrop_opacity'] ?? $existingPopUp['backdrop_opacity'];
        $existingPopUp['width'] = $param['width'] ?? $existingPopUp['width'];
        $existingPopUp['height'] = $param['height'] ?? $existingPopUp['height'];
        $existingPopUp['position'] = $param['position'] ?? $existingPopUp['position'];
        $existingPopUp['animation'] = $param['animation'] ?? $existingPopUp['animation'];
        $existingPopUp['show_close_button'] = $param['show_close_button'] ?? $existingPopUp['show_close_button'];
        $existingPopUp['enable_subscription'] = $param['enable_subscription'] ?? $existingPopUp['enable_subscription'];
        $existingPopUp['subscription_placeholder'] = $param['subscription_placeholder'] ?? $existingPopUp['subscription_placeholder'];
        $existingPopUp['subscription_success_message'] = $param['subscription_success_message'] ?? $existingPopUp['subscription_success_message'];
        $existingPopUp['enable_countdown'] = $param['enable_countdown'] ?? $existingPopUp['enable_countdown'];
        $existingPopUp['countdown_end_date'] = $param['countdown_end_date'] ?? $existingPopUp['countdown_end_date'];
        $existingPopUp['countdown_format'] = $param['countdown_format'] ?? $existingPopUp['countdown_format'];
        $existingPopUp['countdown_expired_text'] = $param['countdown_expired_text'] ?? $existingPopUp['countdown_expired_text'];
        $existingPopUp['order'] = $param['order'] ?? $existingPopUp['order'];
        $existingPopUp['status'] = $param['status'] ?? $existingPopUp['status'];
        $existingPopUp['frequency'] = $param['frequency'] ?? $existingPopUp['frequency'];
        $existingPopUp['start_date'] = $param['start_date'] ?? $existingPopUp['start_date'];
        $existingPopUp['end_date'] = $param['end_date'] ?? $existingPopUp['end_date'];
        $existingPopUp['show_on_pages'] = $param['show_on_pages'] ?? $existingPopUp['show_on_pages'];
        $existingPopUp['deletable'] = $param['deletable'] ?? $existingPopUp['deletable'];
        $existingPopUp['created_by'] = $param['created_by'] ?? $existingPopUp['created_by'];
        $existingPopUp['updated_by'] = $param['updated_by'] ?? $existingPopUp['updated_by'];

        // Save the updated data
        $this->save($existingPopUp);

        return true;
    }
}

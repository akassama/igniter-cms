<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HtmxController extends BaseController
{
    protected $helpers = ['data_helper', 'auth_helper'];

    /**
     * Checks if a user email exists in the database.
     * Echoes a message if the email already exists.
     * @return void
     */
    public function userEmailExists()
    {
        $userEmail = $this->request->getPost('email');
        $tableName = 'users';
        $primaryKey = 'email';

        if(!empty($userEmail)){
            if (recordExists($tableName, $primaryKey, $userEmail)) {
                // Record already exists
                echo '<span class="text-danger">User with email ('.$userEmail.') already exists</span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Checks if a username exists in the database.
     * Echoes a message if the username already exists.
     * @return void
     */
    public function userUsernameExists()
    {
        $username = $this->request->getPost('username');
        $tableName = 'users';
        $primaryKey = 'username';

        if(!empty($username)){
            if (recordExists($tableName, $primaryKey, $username)) {
                // Record already exists
                echo '<span class="text-danger">User with username ('.$username.') already exists</span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Validates the given password against a pattern.
     * Echoes an error message if the password is invalid.
     * @return void
     */
    public function checkPasswordIsValid()
    {
        $password = $this->request->getPost('password');

        // Regex pattern for password validation
        $pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$/';

        if(!empty($password)){
            // Check if the password matches the pattern
            if (!preg_match($pattern, $password)) {
                echo '<span class="text-danger">
                    <p>The password must be at least 6 characters long.<br/>
                    The password must contain at least one letter, one digit, and one special character.</p>
                  </span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Checks if two passwords match.
     * Echoes an error message if passwords do not match.
     * @return void
     */
    public function checkPasswordsMatch()
    {
        $password = $this->request->getPost('password');
        $repeatPassword = $this->request->getPost('repeat_password');

        if($password != $repeatPassword){
            // Passwords do not match
            echo '<span class="text-danger">Passwords do not match</span>';
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Checks if a contact number exists in the database.
     * Echoes a message if the contact number already exists.
     * @return void
     */
    public function contactNumberExists()
    {
        $contactNumber = $this->request->getPost('contact_number');
        $tableName = 'contacts';
        $primaryKey = 'contact_number';

        if(!empty($contactNumber)){
            if (recordExists($tableName, $primaryKey, $contactNumber)) {
                // Record already exists
                echo '<span class="text-danger">Contact with number ('.$contactNumber.') already exists</span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Checks if an edited contact number already exists in the database.
     * Echoes a message if the contact number already exists.
     * @return void
     */
    public function editContactNumberExists()
    {
        $contactId = $this->request->getPost('contact_id');
        $contactNumber = $this->request->getPost('contact_number');
        $tableName = 'contacts';
        $primaryKey = 'contact_number';
        $whereClause = "contact_number = '$contactNumber' AND contact_id != '$contactId'";

        if(!empty($contactNumber) && !empty($contactId)){
            if (checkRecordExists($tableName, $primaryKey, $whereClause)) {
                // Record already exists
                echo '<span class="text-danger">Another contact with number ('.$contactNumber.') already exists</span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    /**
     * Checks if a configuration with a specific identifier exists in the database.
     * Echoes a message if the configuration already exists.
     * @return void
     */
    public function configForExists()
    {
        $configFor = $this->request->getPost('config_for');
        $tableName = 'configurations';
        $primaryKey = 'config_for';

        if(!empty($configFor)){
            if (recordExists($tableName, $primaryKey, $configFor)) {
                // Record already exists
                echo '<span class="text-danger">Config for ('.$configFor.') already exists</span>';
            }
        }

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setNavigationSlug()
    {
        $title = $this->request->getPost('title');

        $slug = generateNavigationSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required readonly>';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setMetaTitle()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }
        $metaInput = '<input type="text" class="form-control" id="meta_title" name="meta_title" value="'.$title.'">';
        echo $metaInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setMetaDescription()
    {
        $description = $this->request->getPost('description');
        if(empty($description)){
            $description = $this->request->getPost('excerpt');
        }
        if(empty($description)){
            $description = $this->request->getPost('short_description');
        }

        $metaInput = '<textarea type="text" class="form-control" id="meta_description" name="meta_description">'.$description.'</textarea>';
        echo $metaInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setMetaKeywords()
    {
        $tags = $this->request->getPost('tags');
        if(empty($tags)){
            $tags = $this->request->getPost('keywords');
        }
        $metaInput = '<input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="'.$tags.'">';
        echo $metaInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getBlogTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generateBlogTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-blog-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getPageTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generatePageTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-page-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getEventTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generateEventTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-event-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getProjectTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generateProjectTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-project-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getProductTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generateProductTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-product-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getDonationTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generateDonationTitleSlug($title);
        $slugInput = '<input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required hx-post="'.$baseUrl.'/htmx/get-donation-title-slug" hx-trigger="load delay:1s" hx-swap="outerHTML">';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }


    //Generic image preview display
    public function setImageDisplay()
    {
        $image = $this->request->getPost('image');
        if(empty($image)){
            $image = $this->request->getPost('featured_image');
        }
        if(empty($image)){
            $image = $this->request->getPost('logo');
        }
        if(empty($image)){
            $image = $this->request->getPost('company_logo');
        }
        if(empty($image)){
            $image = $this->request->getPost('institution_logo');
        }

        $imageInput = '<div class="float-end"><img loading="lazy" src="'.base_url(getDefaultImagePath()).'" class="img-thumbnail" alt="Preview Image" width="150" height="150"></div>';
        if(!empty($image)){
            $imageInput = '<div class="float-end"><img loading="lazy" src="'.getImageUrl($image).'" class="img-thumbnail" alt="Preview Image" width="150" height="150"></div>';
        }
        echo $imageInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setPartnerLogoDisplay()
    {
        $title = $this->request->getPost('title');
        $image = $this->request->getPost('logo');
        $imageInput = '<div class="float-end"><img loading="lazy" src="'.base_url(getDefaultImagePath()).'" class="img-thumbnail" alt="Logo image" width="150" height="150"></div>';
        if(!empty($image)){
            $imageInput = '<div class="float-end"><img loading="lazy" src="'.getImageUrl($image).'" class="img-thumbnail" alt="'.$title.'" width="150" height="150"></div>';
        }
        echo $imageInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getFileDataForm($fileId)
    {
        echo getFileDetailsInput($fileId);

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function updateFileDataList($fileId)
    {
        $caption = $this->request->getPost($fileId.'_caption');
        $uniqueIdentifier = $this->request->getPost($fileId.'_unique_identifier');
        $group = $this->request->getPost($fileId.'_group');

        $updatedFileData = [
            'caption' => $caption,
            'unique_identifier' => $uniqueIdentifier,
            'group' => $group
        ];

        $updateWhereClause = "file_id = '$fileId'";

        updateRecord('file_uploads', $updatedFileData, $updateWhereClause);

        echo getFileDetailsList($fileId);

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getFileDataList($fileId)
    {
        echo getFileDetailsList($fileId);

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getPrimaryColorName()
    {
        $primaryColor = $this->request->getPost('primary_color');
        $colorName = getColorCodeName($primaryColor);
        $colorLabel = '<div class="text-danger">'.$colorName.'</div>';
        echo $colorLabel;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getSecondaryColorName()
    {
        $secondaryColor = $this->request->getPost('secondary_color');
        $colorName = getColorCodeName($secondaryColor);
        $colorLabel = '<div class="text-danger">'.$colorName.'</div>';
        echo $colorLabel;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getOtherColorName()
    {
        $otherColor = $this->request->getPost('other_color');
        $colorName = getColorCodeName($otherColor);
        $colorLabel = '<div class="text-danger">'.$colorName.'</div>';
        echo $colorLabel;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function setMessageReadStatus()
    {
        $readStatus = $this->request->getPost('read_status');
        $contactMessageId = $this->request->getPost('contact_message_id');

        //var_dump($readStatus);
        //exit();

        $readValue = (empty($readStatus) || $readStatus == "0") ? 1 : 0;

        //mark as read
        $updateColumn =  "'is_read' = '$readValue'";
        $updateWhereClause = "contact_message_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_messages", $updateColumn, $updateWhereClause);

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }
}

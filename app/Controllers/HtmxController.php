<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HtmxController extends BaseController
{
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

        $readValue = (empty($readStatus) || $readStatus == "0") ? 1 : 0;

        //mark as read
        $updateColumn =  "'is_read' = '$readValue'";
        $updateWhereClause = "contact_message_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_messages", $updateColumn, $updateWhereClause);

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    //AI REQUESTS 
    ## BLOGS ##  
    public function getExcerptAI()
    {
        $content = $this->request->getPost('content');
        if(empty($content)){
            $content = $this->request->getPost('title');
        }

        $content = getTextSummary(strip_tags($content), 1000);
        $prompt = "From the blog/page content provided below, extract an SEO-friendly excerpt using up to the first 1,000 characters. If the content is shorter, use it entirely. Ensure the excerpt is engaging, concise, and relevant. Do not include explanations or placeholders — return only the excerpt.\n\nBlog Content:\n$content";

        $excerpt = callGeminiAPI($prompt);

        $excerptInput = '<textarea class="form-control" id="excerpt" name="excerpt">'.$excerpt.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($excerptInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## TAGS LIST ##
    public function setTagsAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }
        $description = $this->request->getPost('description');

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control tags-input" id="tags" name="meta_description" required></textarea>';
        }

        $prompt = "Given the blog/page title '$title' and the blog/page description '$description', generate a list of relevant meta keywords, separated by commas. If the description is empty, derive keywords primarily from the blog/page title. Ensure keywords are concise, relevant, and SEO-friendly. Do not use placeholders—provide a fully formed description with concrete wording. Only provide the keywords without any explanation or additional options.";
        $keywords = callGeminiAPI($prompt);

        $tagsInput = '<textarea rows="1" class="form-control tags-input" id="tags" name="tags" required>'.$keywords.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($tagsInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## META TITLE ##
    public function setMetaTitleAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<input type="text" class="form-control" id="meta_title" name="meta_title" value="">';
        }

        $prompt = "Given the blog/page title '$title'. Please generate a compelling and SEO-friendly meta title that accurately summarizes the content while enticing users to click. Keep it under 160 characters. Do not use placeholders—provide a fully formed description with concrete wording. Generate only the response text.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress'. If not needed, ignore.";
        $metaTitle = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<input type="text" class="form-control" id="meta_title" name="meta_title" value="'.$metaTitle.'">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## META DESCRIPTION ##
    public function setMetaDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea class="form-control" id="meta_description" name="meta_description"></textarea>';
        }

        $prompt = "Given the blog/page title '$title'. Please generate a compelling and SEO-friendly meta description that accurately summarizes the content while enticing users to click. Keep it under 160 characters. Do not use placeholders—provide a fully formed description with concrete wording. Generate only the response text.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress'. If not needed, ignore.";
        $description = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea class="form-control" id="meta_description" name="meta_description">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## META KEYWORDS DESCRIPTION ##
    public function setMetaKeywordsAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }
        $description = $this->request->getPost('description');

        //if no data, return default input
        if(empty($title) && empty($description)){
            return '<textarea class="form-control" id="meta_keywords" name="meta_keywords"></textarea>';
        }

        $prompt = "Given the blog/page title '$title' and the blog/page description '$description', generate a list of relevant meta keywords, separated by commas. If the description is empty, derive keywords primarily from the blog/page title. Ensure keywords are concise, relevant, and SEO-friendly. Do not use placeholders—provide a fully formed description with concrete wording. Only provide the keywords without any explanation or additional options.";
        $keywords = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="meta_keywords" name="meta_keywords">'.$keywords.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## BLOG CATEGORIES DESCRIPTION ## 
    public function getBlogCategoryDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Based on the blog/page category name '$title', generate a clear, engaging, and SEO-friendly description that effectively defines the category and its purpose. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## NAVIGATION DESCRIPTION ## 
    public function getNavigationDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Based on the site navigation name '$title', generate a clear, engaging, and SEO-friendly description that effectively defines the navigation and its purpose. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## HOME PAGE SECTION DESCRIPTION ## 
    public function getHomePageSectionDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('section');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea class="form-control" id="section_description" name="section_description"></textarea>';
        }

        $prompt = "Given the homepage section title '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the section. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea class="form-control" id="section_description" name="section_description">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## CONTENT BLOCK DESCRIPTION ## 
    public function getContentBlockDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Given the content block title '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the block. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## EVENT DESCRIPTION ## 
    public function getEventDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Given the event title '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the event. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PORTFOLIO DESCRIPTION ## 
    public function getPortfolioDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Given the portfolio title '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the portfolio. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## COUNTER/STAT DESCRIPTION ## 
    public function getCounterDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Given the counter/homepage statistic titled '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the stat. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRIING DESCRIPTION ## 
    public function getPricingDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Given the pricing on the website titled '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the pricing. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## TEAM MEMBER SUMMARY ## 
    public function getTeamSummaryAI()
    {
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');

        //if no data, return default input
        if(empty($name) || empty($title)){
            return '<textarea rows="1" class="form-control" id="summary" name="summary" maxlength="500" required></textarea>';
        }

        $prompt = "Given the name: '$name', and title: '$title' for this team member, generate a clear, engaging, and SEO-friendly summary that effectively introduces and explains the summary. Ensure the summary is concise, informative, and appealing for website visitors. Do not use placeholders — provide a fully formed summary with concrete wording. The response should contain only the summary, with no explanations or additional options.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress'. If not needed, ignore.";
        $summary = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea rows="1" class="form-control" id="summary" name="summary" maxlength="500" required>'.$summary.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## TESTIMONIAL TEXT ## 
    public function getTestimonialAI()
    {
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $company = $this->request->getPost('company') ?? "Sample Company";

        //if no data, return default input
        if(empty($name) || empty($title)){
            return '<textarea rows="1" class="form-control" id="testimonial" name="testimonial" maxlength="500" required></textarea>';
        }

        $prompt = "Given the name: '$name', and title: '$title' for a clients testimonial at a Company '($company)', generate a clear, engaging, and SEO-friendly testimonial that effectively introduces and explains the testimonial. Ensure the testimonial is concise, informative, and appealing for website visitors. Do not use placeholders — provide a fully formed testimonial with concrete wording. The response should contain only the testimonial, with no explanations or additional options.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress'. If not needed, ignore.";
        $testimonial = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea rows="1" class="form-control" id="testimonial" name="testimonial" maxlength="500" required>'.$testimonial.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## FAQ ANSWER ## 
    public function getFaqAnswerAI()
    {
        $question = $this->request->getPost('question');

        //if no data, return default input
        if(empty($question)){
            return '<textarea rows="1" class="form-control" id="answer" name="answer" maxlength="1000" required></textarea>';
        }

        $prompt = "Given the question: '$question' for an FAQ in the website, generate a clear, engaging, and SEO-friendly answer that effectively introduces and explains the FAQ. Ensure the answer is concise, informative, and appealing for website visitors. Do not use placeholders — provide a fully formed answer with concrete wording. The response should contain only the answer, with no explanations or additional options.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyEmail = getConfigData("CompanyEmail");
        $companyEnquiryEmail = getConfigData("CompanyEnquiryEmail");
        $companyNumber = getConfigData("CompanyNumber");
        $companyOpeningHours = getConfigData("CompanCompanyOpeningHoursyNumber");
        $siteMetaDescription = getConfigData("MetaDescription");
        $siteMetaKeywords = getConfigData("MetaKeywords");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress', Company Email: '$companyEmail', Company Enquiry Email: '$companyEnquiryEmail', CompanyNumber: '$companyNumber', Company Opening Hours: '$companyOpeningHours', Site Meta Description: '$siteMetaDescription', Site Meta Keywords: '$siteMetaDescription'. If not needed, ignore.";
        $answer = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea rows="1" class="form-control" id="answer" name="answer" maxlength="1000" required>'.$answer.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## DONATION CAUSE DESCRIPTION ## 
    public function getDonationCauseDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Given the title '$title' for a Donation Cause/Campaign page, generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the Donation Cause. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## POPUP TEXT ## 
    public function getPopupTextAI()
    {
        $title = $this->request->getPost('title');
        $company = $this->request->getPost('company') ?? "Sample Company";

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="text" name="text" maxlength="1000"></textarea>';
        }

        $prompt = "Given the title: '$title' for a popup advert on the website, generate a clear, engaging, and SEO-friendly popup-advert text that effectively introduces and explains the popup-advert. Ensure the popup-advert text is concise, informative, and appealing for website visitors. Do not use placeholders — provide a fully formed popup-advert text with concrete wording. The response should contain only the popup-advert text, with no explanations or additional options.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyEmail = getConfigData("CompanyEmail");
        $companyEnquiryEmail = getConfigData("CompanyEnquiryEmail");
        $companyNumber = getConfigData("CompanyNumber");
        $companyOpeningHours = getConfigData("CompanCompanyOpeningHoursyNumber");
        $siteMetaDescription = getConfigData("MetaDescription");
        $siteMetaKeywords = getConfigData("MetaKeywords");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress', Company Email: '$companyEmail', Company Enquiry Email: '$companyEnquiryEmail', CompanyNumber: '$companyNumber', Company Opening Hours: '$companyOpeningHours', Site Meta Description: '$siteMetaDescription', Site Meta Keywords: '$siteMetaDescription'. If not needed, ignore.";
        $text = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea rows="1" class="form-control" id="text" name="text" maxlength="1000">'.$text.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRODUCT DESCRIPTION ## 
    public function getProductDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control content-editor" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Given the product title: '$title', generate a clear, engaging, and SEO-friendly description that effectively introduces and explains the product. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control content-editor" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRODUCT SHORT DESCRIPTION ## 
    public function getProductShortDescriptionAI()
    {
        $title = $this->request->getPost('title');
        $description = strip_tags($this->request->getPost('description')) ?? $title;
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="short_description" name="short_description" maxlength="500"></textarea>';
        }

        $prompt = "Given the product title: '$title', description: '$description', generate a clear, engaging, and SEO-friendly short description that effectively introduces and explains the product. Ensure the short-description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the short-description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="short_description" name="short_description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRODUCT BRAND ## 
    public function getProductBrandAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<input type="text" class="form-control" id="brand" name="brand" maxlength="250" value="">';
        }

        $prompt = "Given the product title: '$title', get the possible brand of the product if applicable. The response should contain only the brand, with no explanations or additional options.";
        $brand = callGeminiAPI($prompt);

        $metaInput = '<input type="text" class="form-control" id="brand" name="brand" maxlength="250" value="'.$brand.'">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRODUCT MODEL ## 
    public function getProductModelAI()
    {
        $title = $this->request->getPost('title');
        $description = strip_tags($this->request->getPost('description')) ?? $title;
        $brand = $this->request->getPost('brand') ?? "NA";
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<input type="text" class="form-control" id="model" name="model" maxlength="250" value="">';
        }

        $prompt = "Given the product title: '$title', description: '$description', and brand : '$brand', get the possible model of the product if applicable. The response should contain only the model, with no explanations or additional options.";
        $model = callGeminiAPI($prompt);

        $metaInput = '<input type="text" class="form-control" id="model" name="model" maxlength="250" value="'.$model.'">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## PRODUCT CATEGORIES DESCRIPTION ## 
    public function getProductCategoryDescriptionAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500"></textarea>';
        }

        $prompt = "Based on the product category name '$title', generate a clear, engaging, and SEO-friendly description that effectively defines the category and its purpose. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## RESUME SUMMARY ## 
    public function getResumeSummaryAI()
    {
        $name = $this->request->getPost('full_name');
        $title = $this->request->getPost('title');

        //if no data, return default input
        if(empty($name) || empty($title)){
            return '<textarea rows="1" class="form-control" id="summary" name="summary" maxlength="500" required></textarea>';
        }

        $prompt = "Given the name: '$name', and title: '$title' for my resume, generate a clear, engaging, and SEO-friendly summary that effectively introduces and explains the resume. Ensure the summary is concise, informative, and appealing for website visitors. Do not use placeholders — provide a fully formed summary with concrete wording. The response should contain only the summary, with no explanations or additional options.";
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$companyName', Company Address: '$companyAddress'. If not needed, ignore.";
        $summary = callGeminiAPI($prompt." ".$companyInfo);

        $metaInput = '<textarea rows="1" class="form-control" id="summary" name="summary" maxlength="500" required>'.$summary.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## EXPERIENCE DESCRIPTION ## 
    public function getExperienceDescriptionAI()
    {
        $companyName = $this->request->getPost('company_name') ?? "NA";
        $position = $this->request->getPost('position');

        //if no data, return default input
        if(empty($position)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Given this work experience with company: '$companyName', and position : '$position', generate a clear, engaging, and SEO-friendly work description that effectively introduces and explains the job experience. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## EDUCATION DESCRIPTION ## 
    public function getEducationDescriptionAI()
    {
        $institution = $this->request->getPost('institution') ?? "NA";
        $degree = $this->request->getPost('degree');
        $startDate = !empty($this->request->getPost('start_date')) ? "Start Date: ".$this->request->getPost('start_date') : "";
        $endDate = !empty($this->request->getPost('end_date')) ? "End Date: ".$this->request->getPost('end_date') : "";

        //if no data, return default input
        if(empty($degree)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Given this education experience with institution: '$institution', and degree : '$degree'. '$startDate', '$endDate'. Generate a clear, engaging, and SEO-friendly work description that effectively introduces and explains the education experience. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## SKILLS DESCRIPTION ## 
    public function getSkillsDescriptionAI()
    {
        $category = $this->request->getPost('category') ?? "NA";
        $name = $this->request->getPost('name');
        $proficiencyLevel = $this->request->getPost('proficiency_level');
        $yearsExperience = $this->request->getPost('years_experience');

        //if no data, return default input
        if(empty($name)){
            return '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required></textarea>';
        }

        $prompt = "Given this category: '$category', name: '$name', proficiency level: '$proficiencyLevel', and years of experience : '$yearsExperience'. Generate a clear, engaging, and SEO-friendly work description that effectively introduces and explains the resume skill. Ensure the description is concise, informative, and appealing for website visitors. Do not use placeholders—provide a fully formed description with concrete wording. The response should contain only the description, with no explanations or additional options.";
        $description = callGeminiAPI($prompt);

        $metaInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## REMIX ICON ## 
    public function getRemixIconAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('config_for');
        }
        if(empty($title)){
            $title = $this->request->getPost('category');
        }
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="" placeholder="E.g. ri-user-line">';
        }

        $prompt = "Based on the title '$title', provide the most relevant Remix Icon text representation. Ensure the response contains only the icon text (e.g., 'ri-user-line', 'ri-loop-left-fill', etc.), with no explanations or additional options.";
        $icon = callGeminiAPI($prompt);

        $metaInput = '<input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="'.$icon.'" placeholder="E.g. ri-user-line">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($metaInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }
}

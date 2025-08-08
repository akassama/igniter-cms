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

    public function setSiteTitle()
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
        $slugInput = '<span class="input-group-text">'.$baseUrl.'blog/</span><input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required><div class="invalid-feedback">Please provide slug</div>';
        echo $slugInput;

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    public function getPageTitleSlug()
    {
        $title = $this->request->getPost('title');
        $baseUrl = base_url();
        $slug = generatePageTitleSlug($title);
        $slugInput = '<span class="input-group-text">'.$baseUrl.'</span><input type="text" class="form-control" id="slug" name="slug" value="'.$slug.'" required><div class="invalid-feedback">Please provide slug</div>';
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

    public function getBackgroundColorName()
    {
        $otherColor = $this->request->getPost('background_color');
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
        $prompt = "From the following content, extract a concise, engaging, and SEO-friendly excerpt (max 1,000 characters). Return only the excerpt.\n\nContent:\n$content";

        $excerpt = makeGeminiCall($prompt);

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

        $prompt = "Generate a list of SEO-friendly meta keywords for the page titled '$title' with description '$description'. Focus on relevance and conciseness. Return only comma-separated keywords.";
        $keywords = makeGeminiCall($prompt);

        $returnInput = '<textarea rows="1" class="form-control tags-input" id="tags" name="tags" required>'.$keywords.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

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

        $prompt = "Generate an SEO-friendly meta title for the page titled '$title'. Keep it under 60 characters, compelling, and relevant. Return only the title";
        $siteName = getConfigData("SiteName");
        $siteAddress = getConfigData("SiteAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$siteName', Company Address: '$siteAddress'. If not needed, ignore.";
        $metaTitle = makeGeminiCall($prompt." ".$companyInfo);

        $returnInput = '<input type="text" class="form-control" id="meta_title" name="meta_title" value="'.$metaTitle.'">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## META DESCRIPTION ##
    public function setSiteTitleAI()
    {
        $title = $this->request->getPost('title');
        if(empty($title)){
            $title = $this->request->getPost('name');
        }

        //if no data, return default input
        if(empty($title)){
            return '<textarea class="form-control" id="meta_description" name="meta_description"></textarea>';
        }

        $prompt = "Generate an SEO-friendly meta description for the page titled '$title'. Summarize the content in under 160 characters, ensuring clarity and engagement. Return only the description.";
        $siteName = getConfigData("SiteName");
        $siteAddress = getConfigData("SiteAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$siteName', Company Address: '$siteAddress'. If not needed, ignore.";
        $description = makeGeminiCall($prompt." ".$companyInfo);

        $returnInput = '<textarea class="form-control" id="meta_description" name="meta_description">'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

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

        $prompt = "Generate a list of SEO-friendly meta keywords for the page titled '$title' with description '$description'. Focus on relevance and conciseness. Return only comma-separated keywords.";
        $keywords = makeGeminiCall($prompt);

        $returnInput = '<textarea rows="1" class="form-control" id="meta_keywords" name="meta_keywords">'.$keywords.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

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

        $prompt = "Generate a clear, SEO-friendly description for the blog category titled '$title'. Explain its purpose in under 160 characters. Return only the description.";
        $description = makeGeminiCall($prompt);

        $returnInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

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

        $prompt = "Generate a clear, SEO-friendly description for the page navigation titled '$title'. Explain its purpose in under 160 characters. Return only the description.";
        $description = makeGeminiCall($prompt);

        $returnInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

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

        $prompt = "Generate a concise, SEO-friendly description for the content block titled '$title'. Explain its purpose in 1-2 sentences. Return only the description text.";
        $description = makeGeminiCall($prompt);

        $returnInput = '<textarea rows="1" class="form-control" id="description" name="description" maxlength="500" required>'.$description.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));
        exit();
    }


    ## ACCOUNT SUMMARY ## 
    public function getAccountSummaryAI()
    {
        $aboutSummary = $this->request->getPost('about_summary');
        $firstName = $this->request->getPost('first_name') ?? "NA";
        $lastName = $this->request->getPost('last_name') ?? "NA";
        $name = $firstName." ".$lastName;
        $role = $this->request->getPost('role');
        $socialLinks = implode(", ", array_filter([
            $this->request->getPost('twitter_link'),
            $this->request->getPost('facebook_link'),
            $this->request->getPost('instagram_link'),
            $this->request->getPost('linkedin_link')
        ]));

        if(empty($name)){
            return '<textarea rows="1" class="form-control" id="about_summary" name="about_summary" maxlength="500">'.$aboutSummary.'</textarea>';
        }

        $prompt = "Create a professional bio for $name ($role). Include expertise and social links ($socialLinks) in 4-5 sentences. Return only the bio text.";
        $siteName = getConfigData("SiteName");
        $siteAddress = getConfigData("SiteAddress");
        $companyInfo = "\nIf needed, here is the Company Information. Company Name: '$siteName', Company Address: '$siteAddress'. If not needed, ignore.";
        $summary = makeGeminiCall($prompt." ".$companyInfo);

        $returnInput = '<textarea rows="1" class="form-control" id="about_summary" name="about_summary" maxlength="500">'.$summary.'</textarea>';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));
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
        $icon = makeGeminiCall($prompt);

        $returnInput = '<input type="text" class="form-control" id="icon" name="icon" maxlength="100" value="'.$icon.'" placeholder="E.g. ri-user-line">';
        echo preg_replace('/\s*\R\s*/', ' ', trim($returnInput));

        //Exit to prevent bug: Uncaught RangeError: Maximum call stack size exceeded
        exit();
    }

    ## ACTIVITY LOGS ## 
    public function getActivityLogsAnalysisAI()
    {
        $activityLogs = getRecentActivityLogsInJson();

        //if no data, return default input
        if(empty($activityLogs)){
            return '';
        }

        $prompt = "Analyze these website activity logs and provide a security-focused report in HTML format. Structure the response EXACTLY as follows:

        <div class=\"security-analysis\">
        <h4>Security Risks:</h4>
        <ul>
            <li>[Number] [Specific risk description]</li>
            <li>[Number] [Specific risk description]</li>
        </ul>
        
        <h4>General Summary:</h4>
        <ul>
            <li>Total activities: [number]</li>
            <li>Most common activity: [type] ([count] occurrences)</li>
            <li>[Other notable statistics]</li>
            <li>[Pattern observation]</li>
        </ul>
        </div>

        Focus specifically on identifying:
        1. Suspicious IP addresses
        2. Multiple failed login attempts
        3. Unusual activity patterns
        4. Potential brute force attacks
        5. Administrative action anomalies

        Return ONLY the HTML formatted as shown above - no additional text, explanations, or commentary. Use the exact same HTML structure with your analysis of this log data:
        " . $activityLogs;

        $analysis = makeGeminiCall($prompt);
        
        // Clean response
        echo $analysis;
        exit();
    }

    ## ERROR LOGS ## 
    public function getErrorLogsAnalysisAI()
    {
        $errorLogs = $this->request->getPost('error_log');

        //if no data, return default input
        if(empty($errorLogs)){
            return '<div class="alert alert-info">No error logs found</div>';
        }

        $prompt = "Analyze these error logs and provide a concise HTML report with:
            1. A summary table of error types/counts
            2. List of critical errors with explanations
            3. Suggested solutions
            
            Format the response EXACTLY like this:
            
            <div class=\"error-analysis\">
            <h4>Error Summary</h4>
            <table class=\"table table-bordered\">
                <thead><tr><th>Error Type</th><th>Count</th></tr></thead>
                <tbody>
                <tr><td>[Error Type]</td><td>[Count]</td></tr>
                </tbody>
            </table>
            
            <h4>Critical Issues</h4>
            <ul>
                <li><strong>[Error]</strong>: [Explanation]</li>
            </ul>
            
            <h4>Recommendations</h4>
            <ol>
                <li>[Suggested Action]</li>
            </ol>
            </div>

            Analyze these logs:
            " . $errorLogs;

        $analysis = makeGeminiCall($prompt);
        
        // Clean response
        echo $analysis;
        exit();
    }

    ## VISIT STATS ## 
    public function getVisitStatsAnalysisAI()
    {
        $visitStats = getRecentVisitStatsInJson();

        // if no data, return default input
        if(empty($visitStats)){
            return '';
        }

        $prompt = "Analyze these website visit statistics and provide a comprehensive report in HTML format. Structure the response EXACTLY as follows:

    <div class=\"visit-analysis\">
    <h4>Visitor Overview:</h4>
    <ul>
        <li>Total visits: [number]</li>
        <li>Unique IP addresses: [number]</li>
        <li>Most visited page: [URL] ([count] visits)</li>
        <li>Most active hour: [hour] (UTC)</li>
    </ul>

    <h4>User Agent Analysis:</h4>
    <ul>
        <li>Top browser: [browser] ([count] visits)</li>
        <li>Top operating system: [OS] ([count] visits)</li>
        <li>Top device type: [device] ([count] visits)</li>
        <li>[Observation about diversity or dominance]</li>
    </ul>

    <h4>Geographic Insights:</h4>
    <ul>
        <li>Top country: [country] ([count] visits)</li>
        <li>[Notable geographic pattern or anomaly]</li>
    </ul>

    <h4>Behavioral Patterns:</h4>
    <ul>
        <li>Most common referrer: [referrer] ([count] visits)</li>
        <li>Frequent screen resolution: [resolution] ([count] visits)</li>
        <li>[User navigation behavior observation]</li>
    </ul>

    <h4>Potential Anomalies:</h4>
    <ul>
        <li>[Number] visits from unusual device-browser combinations</li>
        <li>[Number] visits with missing or generic user agents</li>
        <li>[Potential bot or scraper detection]</li>
        <li>[Other suspicious patterns]</li>
    </ul>
    </div>

    Focus specifically on identifying:
    1. Traffic sources and referral patterns
    2. Device, browser, OS distribution
    3. Geographic location trends
    4. Repeated visits from same IP/user agent
    5. Unusual screen resolutions or session behaviors

    Return ONLY the HTML formatted as shown above - no additional text, explanations, or commentary. Use the exact same structure with your analysis of this visit stats data:
    " . $visitStats;

        $analysis = makeGeminiCall($prompt);

        // Clean response
        echo $analysis;
        exit();
    }


    ## GET AI HELP ANSWER ## 
    public function getAIHelpAnswer()
    {
        try {
            $siteKnowledgeBaseInJson = getSiteKnowledgeBaseInJson();

            // if no data, return default input
            if(empty($siteKnowledgeBaseInJson)){
                return '';
            }

            $question = $this->request->getPost('ai_question');

            $prompt = "Here is a question about Igniter CMS.\n Question: '$question'. Provide the answer to the question and structure the response EXACTLY as follows:

            <div class=\"row response-text\">
                <h4 class=\"text-primary mb-2\">'$question'</h4>
                <div class=\"col-12 mt-4\">
                    <p>[answer]</p>
                </ul>
            </div>

            Here is a knowledge base on Igniter CMS in JSON for your reference in providing an answer.\n Knowledge Base: '$siteKnowledgeBaseInJson'.

            Focus specifically on:
            1. Using the JSON knowledge base first for finding an answer.
            2. Use the documentation site (https://docs.ignitercms.com/), the GitHub repo (https://docs.ignitercms.com/) and the website (https://docs.ignitercms.com/) to look for potential answers.
            3. Use knowledge from CodeIgniter and PHP to also provide possible answers.

            Return ONLY the HTML formatted as shown above - no additional text, explanations, or commentary. You can include images if needed (for images use: <img src='[image-url]' class='img-fluid'>). Use the exact same structure with answer.";

            $answer = makeGeminiCall($prompt);

            // Clean response
            $answer = preg_replace('/```html/', '', $answer);
            $answer = preg_replace('/```/', '', $answer);
            echo trim($answer);
            exit();
        }

        //catch exception
        catch(Exception $e) {
            echo '<div class="ai-response-placeholder text-muted"><p class="mb-0"><strong>An Error Occurred!<strong> <br/>Your AI response will appear here after you ask a question.</p></div>';
            exit();
        }
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\ResumesModel;
use App\Models\ExperiencesModel;
use App\Models\EducationsModel;
use App\Models\SkillsModel;

class ResumeController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    //############################//
    //          Resumes          //
    //############################//
    public function index()
    {
        return view('back-end/resumes/index');
    }

    public function manageResumes()
    {
        $tableName = 'resumes';
        $resumesModel = new ResumesModel();
    
        // Set data to pass in view
        $data = [
            'resumes' => $resumesModel->orderBy('created_at', 'DESC')->findAll(),
            'total_resumes' => getTotalRecords($tableName)
        ];
    
        return view('back-end/resumes/manage-resumes', $data);
    }

    public function newResume()
    {
        return view('back-end/resumes/new-resume');
    }

    public function addResume()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the ResumesModel
        $resumesModel = new ResumesModel();

        // Validate the input
        $rules = $resumesModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/resumes/new-resume', ['validation' => $this->validator]);
        }

        // Check if record exists
        if (recordExists("resumes", "email", $this->request->getPost('email'))) {
            $alreadyExistMsg = config('CustomConfig')->alreadyExistMsg;
            $alreadyExistMsg = str_replace('[Record]', 'Email', $alreadyExistMsg);
            session()->setFlashdata('errorAlert', $alreadyExistMsg);

            // Return to view form with data
            return view('back-end/resumes/new-resume', [
                'data' => $this->request->getPost()
            ]);
        }

        // Prepare data for insertion
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'title' => $this->request->getPost('title'),
            'summary' => $this->request->getPost('summary'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'dob' => $this->request->getPost('dob'),
            'address' => $this->request->getPost('address'),
            'website' => $this->request->getPost('website'),
            'linkedin_url' => $this->request->getPost('linkedin_url'),
            'github_url' => $this->request->getPost('github_url'),
            'twitter_url' => $this->request->getPost('twitter_url'),
            'image' => $this->request->getPost('image'),
            'additional_image' => $this->request->getPost('additional_image'),
            'cv_file' => $this->request->getPost('cv_file'),
            'certifications' => $this->request->getPost('certifications'),
            'status' => $this->request->getPost('status'),
            'meta_title' => !empty($this->request->getPost('meta_title')) ? $this->request->getPost('meta_title') : $this->request->getPost('title'),
            'meta_description' => !empty($this->request->getPost('meta_description')) ? $this->request->getPost('meta_description') : getTextSummary(strip_tags($this->request->getPost('summary')), 160),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        // Attempt to create the resume
        if ($resumesModel->createResume($data)) {
            $insertedId = $resumesModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::RESUME_CREATION, 'Resume created with id: ' . $insertedId);

            return redirect()->to('/account/resumes/manage-resumes');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_RESUME_CREATION, 'Failed to create Resume with question: ' . $this->request->getPost('question'));

            return view('back-end/resumes/new-resume');
        }
    }

    public function editResume($resumeId)
    {
        $tableName = 'resumes';
        //Check if record exists
        if (!recordExists($tableName, "resume_id", $resumeId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-resumes');
        }

        $resumesModel = new ResumesModel();

        // Fetch the data based on the id
        $resume = $resumesModel->where('resume_id', $resumeId)->first();

        // Set data to pass in view
        $data = [
            'resume_data' => $resume
        ];

        return view('back-end/resumes/edit-resume', $data);
    }

    public function updateResume()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $resumesModel = new ResumesModel();
        $resumeId = $this->request->getPost('resume_id');
    
        if (!$this->validate($resumesModel->getValidationRules())) {
            return view('back-end/resumes/edit-resume', ['validation' => $this->validator, 'resume_data' => $resumesModel->find($resumeId)]);
        }
    
        // Prepare data for update
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'title' => $this->request->getPost('title'),
            'summary' => $this->request->getPost('summary'),
            'email' => $this->request->getPost('edit_email'),
            'phone' => $this->request->getPost('phone'),
            'dob' => $this->request->getPost('dob'),
            'address' => $this->request->getPost('address'),
            'website' => $this->request->getPost('website'),
            'linkedin_url' => $this->request->getPost('linkedin_url'),
            'github_url' => $this->request->getPost('github_url'),
            'twitter_url' => $this->request->getPost('twitter_url'),
            'image' => $this->request->getPost('image'),
            'additional_image' => $this->request->getPost('additional_image'),
            'cv_file' => $this->request->getPost('cv_file'),
            'certifications' => $this->request->getPost('certifications'),
            'status' => $this->request->getPost('status'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];
    
        if ($resumesModel->updateResume($resumeId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::RESUME_UPDATE, 'Resume updated with id: ' . $resumeId);
            return redirect()->to('/account/resumes/manage-resumes');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_RESUME_UPDATE, 'Failed to update Resume with id: ' . $resumeId);
            return redirect()->to('/account/resumes/edit-resume/' . $resumeId);
        }
    }

    public function viewResume($resumeId)
    {
        $tableName = 'resumes';
        //Check if record exists
        if (!recordExists($tableName, "resume_id", $resumeId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-resumes');
        }

        $resumesModel = new ResumesModel();

        // Fetch the data based on the id
        $resume = $resumesModel->where('resume_id', $resumeId)->first();

        // Set data to pass in view
        $data = [
            'resume_data' => $resume
        ];

        return view('back-end/resumes/view-resume', $data);
    }

    //############################//
    //          Experiences        //
    //############################//
    public function manageExperiences()
    {
        $tableName = 'experiences';
        $experiencesModel = new ExperiencesModel();

        // Set data to pass in view
        $data = [
            'experiences' => $experiencesModel->orderBy('start_date', 'DESC')->findAll(),
            'total_experiences' => getTotalRecords($tableName)
        ];

        return view('back-end/resumes/manage-experiences', $data);
    }

    public function newExperience()
    {
        return view('back-end/resumes/new-experience');
    }

    public function addExperience()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the ExperiencesModel
        $experiencesModel = new ExperiencesModel();

        // Validate the input
        $rules = $experiencesModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/resumes/new-experience', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'group' => $this->request->getPost('group'),
            'company_name' => $this->request->getPost('company_name'),
            'position' => $this->request->getPost('position'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'current_job' => (bool)$this->request->getPost('current_job'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'achievements' => $this->request->getPost('achievements'),
            'company_logo' => $this->request->getPost('company_logo'), 
            'company_url' => $this->request->getPost('company_url'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        // Attempt to create the experience
        if ($experiencesModel->createExperience($data)) {
            $insertedId = $experiencesModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::EXPERIENCE_CREATION, 'Experience created with id: ' . $insertedId);

            return redirect()->to('/account/resumes/manage-experiences');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_EXPERIENCE_CREATION, 'Failed to create Experience with data: ' . json_encode($data));

            return view('back-end/resumes/new-experience');
        }
    }

    public function viewExperience($experienceId)
    {
        $tableName = 'experiences';
        //Check if record exists
        if (!recordExists($tableName, "experience_id", $experienceId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-experiences');
        }

        $experiencesModel = new ExperiencesModel();

        // Fetch the data based on the id
        $experience = $experiencesModel->where('experience_id', $experienceId)->first();

        // Set data to pass in view
        $data = [
            'experience_data' => $experience
        ];

        return view('back-end/resumes/view-experience', $data);
    }

    public function editExperience($experienceId)
    {
        $tableName = 'experiences';
        //Check if record exists
        if (!recordExists($tableName, "experience_id", $experienceId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-experiences');
        }

        $experiencesModel = new ExperiencesModel();

        // Fetch the data based on the id
        $experience = $experiencesModel->where('experience_id', $experienceId)->first();

        // Set data to pass in view
        $data = [
            'experience_data' => $experience
        ];

        return view('back-end/resumes/edit-experience', $data);
    }

    public function updateExperience()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $experiencesModel = new ExperiencesModel();
        $experienceId = $this->request->getPost('experience_id');

        if (!$this->validate($experiencesModel->getValidationRules())) {
            return view('back-end/resumes/edit-experience', ['validation' => $this->validator, 'experience_data' => $experiencesModel->find($experienceId)]);
        }

        // Prepare data for update
        $data = [
            'group' => $this->request->getPost('group'),
            'company_name' => $this->request->getPost('company_name'),
            'position' => $this->request->getPost('position'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'current_job' => (bool)$this->request->getPost('current_job'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'achievements' => $this->request->getPost('achievements'),
            'company_logo' => $this->request->getPost('company_logo'),
            'company_url' => $this->request->getPost('company_url'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'updated_by' => $loggedInUserId
        ];

        if ($experiencesModel->updateExperience($experienceId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::EXPERIENCE_UPDATE, 'Experience updated with id: ' . $experienceId);
            return redirect()->to('/account/resumes/manage-experiences');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_EXPERIENCE_UPDATE, 'Failed to update Experience with id: ' . $experienceId);
            return redirect()->to('/account/resumes/edit-experience/' . $experienceId);
        }
    }

    //############################//
    //          Educations        //
    //############################//
    public function manageEducations()
    {
        $tableName = 'educations';
        $educationsModel = new EducationsModel();

        // Set data to pass in view
        $data = [
            'educations' => $educationsModel->orderBy('start_date', 'DESC')->findAll(),
            'total_educations' => getTotalRecords($tableName)
        ];

        return view('back-end/resumes/manage-educations', $data);
    }

    public function newEducation()
    {
        return view('back-end/resumes/new-education');
    }

    public function addEducation()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the EducationsModel
        $educationsModel = new EducationsModel();

        // Validate the input
        $rules = $educationsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/resumes/new-education', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'group' => $this->request->getPost('group'),
            'institution' => $this->request->getPost('institution'),
            'degree' => $this->request->getPost('degree'),
            'field_of_study' => $this->request->getPost('field_of_study'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'grade' => $this->request->getPost('grade'),
            'activities' => $this->request->getPost('activities'),
            'description' => $this->request->getPost('description'),
            'institution_logo' => $this->request->getPost('institution_logo'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        // Attempt to create the education
        if ($educationsModel->createEducation($data)) {
            $insertedId = $educationsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::EDUCATION_CREATION, 'Education created with id: ' . $insertedId);

            return redirect()->to('/account/resumes/manage-educations');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_EDUCATION_CREATION, 'Failed to create Education with data: ' . json_encode($data));

            return view('back-end/resumes/new-education');
        }
    }

    public function viewEducation($educationId)
    {
        $tableName = 'educations';
        //Check if record exists
        if (!recordExists($tableName, "education_id", $educationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-educations');
        }

        $educationsModel = new EducationsModel();

        // Fetch the data based on the id
        $education = $educationsModel->where('education_id', $educationId)->first();

        // Set data to pass in view
        $data = [
            'education_data' => $education
        ];

        return view('back-end/resumes/view-education', $data);
    }

    public function editEducation($educationId)
    {
        $tableName = 'educations';
        //Check if record exists
        if (!recordExists($tableName, "education_id", $educationId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-educations');
        }

        $educationsModel = new EducationsModel();

        // Fetch the data based on the id
        $education = $educationsModel->where('education_id', $educationId)->first();

        // Set data to pass in view
        $data = [
            'education_data' => $education
        ];

        return view('back-end/resumes/edit-education', $data);
    }

    public function updateEducation()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $educationsModel = new EducationsModel();
        $educationId = $this->request->getPost('education_id');

        if (!$this->validate($educationsModel->getValidationRules())) {
            return view('back-end/resumes/edit-education', ['validation' => $this->validator, 'education_data' => $educationsModel->find($educationId)]);
        }

        // Prepare data for update
        $data = [
            'group' => $this->request->getPost('group'),
            'institution' => $this->request->getPost('institution'),
            'degree' => $this->request->getPost('degree'),
            'field_of_study' => $this->request->getPost('field_of_study'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'grade' => $this->request->getPost('grade'),
            'activities' => $this->request->getPost('activities'),
            'description' => $this->request->getPost('description'),
            'institution_logo' => $this->request->getPost('institution_logo'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'updated_by' => $loggedInUserId
        ];

        if ($educationsModel->updateEducation($educationId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::EDUCATION_UPDATE, 'Education updated with id: ' . $educationId);
            return redirect()->to('/account/resumes/manage-educations');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_EDUCATION_UPDATE, 'Failed to update Education with id: ' . $educationId);
            return redirect()->to('/account/resumes/edit-education/' . $educationId);
        }
    }

    //############################//
    //          Skills          //
    //############################//
    public function manageSkills()
    {
        $tableName = 'skills';
        $skillsModel = new SkillsModel();

        // Set data to pass in view
        $data = [
            'skills' => $skillsModel->orderBy('order', 'ASC')->findAll(),
            'total_skills' => getTotalRecords($tableName)
        ];

        return view('back-end/resumes/manage-skills', $data);
    }

    public function newSkill()
    {
        return view('back-end/resumes/new-skill');
    }

    public function addSkill()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the SkillsModel
        $skillsModel = new SkillsModel();

        // Validate the input
        $rules = $skillsModel->getValidationRules();
        if (!$this->validate($rules)) {
            return view('back-end/resumes/new-skill', ['validation' => $this->validator]);
        }

        // Prepare data for insertion
        $data = [
            'group' => $this->request->getPost('group'),
            'category' => $this->request->getPost('category'),
            'name' => $this->request->getPost('name'),
            'proficiency_level' => $this->request->getPost('proficiency_level'),
            'years_experience' => (int)$this->request->getPost('years_experience'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        // Attempt to create the skill
        if ($skillsModel->createSkill($data)) {
            $insertedId = $skillsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::SKILL_CREATION, 'Skill created with id: ' . $insertedId);

            return redirect()->to('/account/resumes/manage-skills');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_SKILL_CREATION, 'Failed to create Skill with data: ' . json_encode($data));

            return view('back-end/resumes/new-skill');
        }
    }

    public function viewSkill($skillId)
    {
        $tableName = 'skills';
        //Check if record exists
        if (!recordExists($tableName, "skill_id", $skillId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-skills');
        }

        $skillsModel = new SkillsModel();

        // Fetch the data based on the id
        $skill = $skillsModel->where('skill_id', $skillId)->first();

        // Set data to pass in view
        $data = [
            'skill_data' => $skill
        ];

        return view('back-end/resumes/view-skill', $data);
    }

    public function editSkill($skillId)
    {
        $tableName = 'skills';
        //Check if record exists
        if (!recordExists($tableName, "skill_id", $skillId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/resumes/manage-skills');
        }

        $skillsModel = new SkillsModel();

        // Fetch the data based on the id
        $skill = $skillsModel->where('skill_id', $skillId)->first();

        // Set data to pass in view
        $data = [
            'skill_data' => $skill
        ];

        return view('back-end/resumes/edit-skill', $data);
    }

    public function updateSkill()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $skillsModel = new SkillsModel();
        $skillId = $this->request->getPost('skill_id');

        if (!$this->validate($skillsModel->getValidationRules())) {
            return view('back-end/resumes/edit-skill', ['validation' => $this->validator, 'skill_data' => $skillsModel->find($skillId)]);
        }

        // Prepare data for update
        $data = [
            'group' => $this->request->getPost('group'),
            'category' => $this->request->getPost('category'),
            'name' => $this->request->getPost('name'),
            'proficiency_level' => $this->request->getPost('proficiency_level'),
            'years_experience' => (int)$this->request->getPost('years_experience'),
            'description' => $this->request->getPost('description'),
            'icon' => $this->request->getPost('icon'),
            'order' => (int)$this->request->getPost('order'),
            'status' => $this->request->getPost('status'),
            'updated_by' => $loggedInUserId
        ];

        if ($skillsModel->updateSkill($skillId, $data)) {
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::SKILL_UPDATE, 'Skill updated with id: ' . $skillId);
            return redirect()->to('/account/resumes/manage-skills');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_SKILL_UPDATE, 'Failed to update Skill with id: ' . $skillId);
            return redirect()->to('/account/resumes/edit-skill/' . $skillId);
        }
    }

}

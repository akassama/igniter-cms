<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ContentBlocksModel;

class ContentBlocksController extends BaseController
{

    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    //############################//
    //       Content Blocks       //
    //############################//
    public function contentBlocks()
    {
        $tableName = 'content_blocks';
        $contentBlocksModel = new ContentBlocksModel();

        // Set data to pass in view
        $data = [
            'content_blocks' => $contentBlocksModel->orderBy('created_at', 'DESC')->findAll(),
            'total_content_blocks' => getTotalRecords($tableName)
        ];

        return view('back-end/content-blocks/index', $data);
    }

    public function newContentBlock()
    {
        return view('back-end/content-blocks/new-content-block');
    }

    public function addContentBlock()
    {
        $loggedInUserId = $this->session->get('user_id');
        $contentBlocksModel = new ContentBlocksModel();

        if (!$this->validate($contentBlocksModel->getValidationRules())) {
            return view('back-end/content-blocks/new-content-block', ['validation' => $this->validator]);
        }

        $data = [
            'identifier' => $this->request->getPost('identifier'),
            'author' => $loggedInUserId,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'image' => $this->request->getPost('image'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'custom_field' => $this->request->getPost('custom_field'),
            'created_by' => $loggedInUserId,
            'updated_by' => null,
        ];

        if ($contentBlocksModel->createContentBlock($data)) {
            $insertedId = $contentBlocksModel->getInsertID();
            $createSuccessMsg = str_replace('[Record]', 'Content Block', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CONTENT_BLOCK_CREATION, 'Content block created with id: ' . $insertedId);
            return redirect()->to('/account/content-blocks');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONTENT_BLOCK_CREATION, 'Failed to create content block with title: ' . $data['title']);
            return view('back-end/content-blocks/new-content-block');
        }
    }

    public function viewContentBlock($contentBlockId)
    {
        $tableName = 'content_blocks';
        //Check if record exists
        if (!recordExists($tableName, "content_id", $contentBlockId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/content-blocks');
        }

        $contentBlocksModel = new ContentBlocksModel();
        $data = ['content_block_data' => $contentBlocksModel->find($contentBlockId)];
        return view('back-end/content-blocks/view-content-block', $data);
    }

    public function editContentBlock($contentBlockId)
    {
        $tableName = 'content_blocks';
        //Check if record exists
        if (!recordExists($tableName, "content_id", $contentBlockId)) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/content-blocks');
        }

        $contentBlocksModel = new ContentBlocksModel();
        $data = ['content_block_data' => $contentBlocksModel->find($contentBlockId)];
        return view('back-end/content-blocks/edit-content-block', $data);
    }

    public function updateContentBlock()
    {
        $loggedInUserId = $this->session->get('user_id');
        $contentBlocksModel = new ContentBlocksModel();
        $contentBlockId = $this->request->getPost('content_id');

        if (!$this->validate($contentBlocksModel->getValidationRules())) {
            return view('back-end/content-blocks/edit-content-block', ['validation' => $this->validator, 'content_block_data' => $contentBlocksModel->find($contentBlockId)]);
        }

        $data = [
            'identifier' => $this->request->getPost('identifier'),
            'author' => $loggedInUserId,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'icon' => $this->request->getPost('icon'),
            'group' => $this->request->getPost('group'),
            'image' => $this->request->getPost('image'),
            'link' => $this->request->getPost('link'),
            'new_tab' => $this->request->getPost('new_tab'),
            'order' => $this->request->getPost('order') ?? 10,
            'custom_field' => $this->request->getPost('custom_field'),
            'created_by' => $this->request->getPost('created_by'),
            'updated_by' => $loggedInUserId
        ];

        if ($contentBlocksModel->updateContentBlock($contentBlockId, $data)) {
            $editSuccessMsg = str_replace('[Record]', 'Content Block', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::CONTENT_BLOCK_UPDATE, 'Content block updated with id: ' . $contentBlockId);
            return redirect()->to('/account/content-blocks');
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONTENT_BLOCK_UPDATE, 'Failed to update content block with id: ' . $contentBlockId);
            return redirect()->to('/account/edit-content-block/' . $contentBlockId);
        }
    }
}

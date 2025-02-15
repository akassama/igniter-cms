<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\AIChatModel;

class AIHelpBotController extends BaseController
{
    protected $helpers = ['auth_helper'];
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

    //############################//
    //         AI Helpbot         //
    //############################//
    public function index($chatId = null)
    {
        $tableName = 'ai_chats';
        $aiChatModel = new AIChatModel();
        
        $chatResponse = null;

        if(!empty($chatId)){
            //Check if record exists
            if (!recordExists($tableName, "chat_id", $chatId)) {
                $errorMsg = config('CustomConfig')->notFoundMsg;
                session()->setFlashdata('errorAlert', $errorMsg);
                return redirect()->to('/account/ai-helpbot');
            }
            $chatResponse = $aiChatModel->find($chatId);
        }

        // Set data to pass in view
        $data = [
            'chat_id' => $chatId,
            'ai_chats' => $aiChatModel->orderBy('created_at', 'DESC')->findAll(),
            'total_chats' => getTotalRecords($tableName),
            'chat_response' => !empty($chatResponse) ? $chatResponse['chat'] : $chatResponse,
        ];

        return view('back-end/ai-helpbot/index', $data);
    }

    // Handle sending a message to AI API
    public function sendMessage()
    {
        //get logged-in user id
        $tableName = 'ai_chats';
        $loggedInUserId = $this->session->get('user_id');
        $chatId = $this->request->getPost('chat_id');
        $message = $this->request->getPost('message');

        if (empty($message)) {
            return $this->response->setJSON(['error' => 'Prompt cannot be empty']);
        }

        // Call Gemini API //TODO - Implement other ai's
        $apiResponse = callGeminiAPI($message);

        if (empty($apiResponse)) {
            return $this->response->setJSON(['error' => $apiResponse['error']]);
        }

        // set data
        $cleanedMessage = extractPromptText($message); //remove questions formats and extract prompt text
        $newChatId = getGUID(); // Generate a unique chat ID
        $chatTitle = substr($message, 0, 500); // Use the first 500 characters as the chat title
        $shortChatTitle = substr($cleanedMessage, 0, 150); // Use the first 150 characters as the chat title
        $chatDivId = getGUID();
        $chatStructure = '<div class="d-flex flex-column mb-2"> <div class="d-flex flex-column mb-2 align-items-end"> <div class="alert alert-secondary w-75 text-end"> '.$chatTitle.' </div> </div> <div class="alert alert-light border w-75"> <div class="row text-end"> <a class="td-none copy-btn text-dark" data-clipboard-target="#ai-response-'.$chatDivId.'"> <i class="ri-file-copy-line"></i> </a> </div> <div id="ai-response-'.$chatDivId.'"> '.$apiResponse.' </div> </div> </div>';

        //new prompt data
        if(empty($chatId)){
            $newChatData = [
                'chat_id' =>  $newChatId,
                'chat_by' => $loggedInUserId,
                'chat_title' => $shortChatTitle,
                'chat' => formatAIResponse($chatStructure)
            ];

            addRecord($tableName, $newChatData);

            //update chatId for redirecting
            $chatId = $newChatId;
        }
        else{
            //update prompt data
            $whereClause = ['chat_id' => $chatId];
            $currentChatTitle = getTableData($tableName, $whereClause, 'chat_title');
            $currentChatStructure = getTableData($tableName, $whereClause, 'chat');
            $updatedChatStructure = $currentChatStructure.' '.$chatStructure;

            $updatedChatData = [
                'chat_by' => $loggedInUserId,
                'chat_title' => $chatTitle,
                'chat' => formatAIResponse($updatedChatStructure)
            ];

            $updateWhereClause = "chat_id = '.$chatId.'";
            updateRecord($tableName, $updatedChatData, $updateWhereClause);
        }

        return redirect()->to('/account/ai-helpbot/'.$chatId);
    }

}

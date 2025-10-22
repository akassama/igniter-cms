<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * @class ServicesController
 * @extends BaseController
 */
class ServicesController extends BaseController
{
    protected $helpers = ['form'];
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    /**
   * Deletes a service record from the database.
   *
   * @return void
   */
    public function deleteService()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $tableName = $this->request->getPost('table_name');
        $pkName = $this->request->getPost('pk_name');
        $pkValue = $this->request->getPost('pk_value');
        $childTables = $this->request->getPost('child_table');
        $returnUrl = $this->request->getPost('return_url');

        //show demo message
        if(boolval(env('DEMO_MODE', "false"))){
            $errorMsg = "Action not available in the demo mode.";
            session()->setFlashdata('warningAlert', $errorMsg);
            return redirect()->to($returnUrl);
        }

        try {
            //remove record
            deleteRecord($tableName, $pkName, $pkValue);

            // Check if $childTables is not empty
            if (!empty($childTables)) {
                // Split the comma-separated strings into an array
                $tablesArray = explode(',', $childTables);

                // Iterate over each table and delete records
                foreach ($tablesArray as $table) {
                    deleteRecord($table, $pkName, $pkValue);
                }
            }

            $createSuccessMsg = str_replace('[Record]', 'Data', config('CustomConfig')->deleteSuccessMsg);
            session()->setFlashdata('toastrSuccessAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::DELETE_LOG, 'User with id: ' . $loggedInUserId . ' deleted record for table name: ' . $tableName .' with id: ' . $pkValue);

            //return
            return redirect()->to($returnUrl);
        }
        catch (Exception $e){
            $errorMsg = config('CustomConfig')->exceptionMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_DELETE_LOG, 'User with id: ' . $loggedInUserId . ' failed to delete record for table name: ' . $tableName .' with id: ' . $pkValue);

            return redirect()->to($returnUrl);
        }
    }

    /**
   * Deletes a service record from the database and its associated file.
   *
   * @return void
   */
    public function deleteFileService()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $tableName = $this->request->getPost('table_name');
        $pkName = $this->request->getPost('pk_name');
        $pkValue = $this->request->getPost('pk_value');
        $childTables = $this->request->getPost('child_table');
        $filePath = $this->request->getPost('file_path');
        $returnUrl = $this->request->getPost('return_url');

        //show demo message
        if(boolval(env('DEMO_MODE', "false"))){
            $errorMsg = "Action not available in the demo mode.";
            session()->setFlashdata('warningAlert', $errorMsg);
            return redirect()->to($returnUrl);
        }

        try {
            //remove record
            deleteRecord($tableName, $pkName, $pkValue);

            //remove file
            if(!empty($filePath))
            {
                // Check if the file exists
                if (file_exists($filePath)) {
                    unlink($filePath); 
                } 
            }

            // Check if $childTables is not empty
            if (!empty($childTables)) {
                // Split the comma-separated strings into an array
                $tablesArray = explode(',', $childTables);

                // Iterate over each table and delete records
                foreach ($tablesArray as $table) {
                    deleteRecord($table, $pkName, $pkValue);
                }
            }

            $createSuccessMsg = str_replace('[Record]', 'Data', config('CustomConfig')->deleteSuccessMsg);
            session()->setFlashdata('toastrSuccessAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FILE_DELETION, 'User with id: ' . $loggedInUserId . ' deleted record for table name: ' . $tableName .' with id: ' . $pkValue);

            //return
            return redirect()->to($returnUrl);
        }
        catch (Exception $e){
            $errorMsg = config('CustomConfig')->exceptionMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_DELETE_LOG, 'User with id: ' . $loggedInUserId . ' failed to delete record for table name: ' . $tableName .' with id: ' . $pkValue);

            return redirect()->to($returnUrl);
        }
    }

    

    /**
   * Deletes a service record from the database and its associated backup.
   *
   * @return void
   */
  public function deleteBackupService()
  {
      //get logged-in user id
      $loggedInUserId = $this->session->get('user_id');

      $tableName = $this->request->getPost('table_name');
      $pkName = $this->request->getPost('pk_name');
      $pkValue = $this->request->getPost('pk_value');
      $fileName = $this->request->getPost('file_path');
      $returnUrl = $this->request->getPost('return_url');

      //show demo message
      if(boolval(env('DEMO_MODE', "false"))){
        $errorMsg = "Action not available in the demo mode.";
        session()->setFlashdata('warningAlert', $errorMsg);
        return redirect()->to($returnUrl);
      }

      try {
          //remove record
          deleteRecord($tableName, $pkName, $pkValue);

          //remove file
          if(!empty($fileName))
          {
            // Path to the backup file in the writable directory
            $filePath = WRITEPATH . 'backups/' . $fileName;

            // Check if the file exists
            if (file_exists($filePath)) {
                unlink($filePath); 
            } 
          }

          $createSuccessMsg = str_replace('[Record]', 'Data', config('CustomConfig')->deleteSuccessMsg);
          session()->setFlashdata('toastrSuccessAlert', $createSuccessMsg);

          //log activity
          logActivity($loggedInUserId, ActivityTypes::FILE_DELETION, 'User with id: ' . $loggedInUserId . ' deleted record for table name: ' . $tableName .' with id: ' . $pkValue);

          //return
          return redirect()->to($returnUrl);
      }
      catch (Exception $e){
          $errorMsg = config('CustomConfig')->exceptionMsg;
          session()->setFlashdata('errorAlert', $errorMsg);

          //log activity
          logActivity($loggedInUserId, ActivityTypes::FAILED_DELETE_LOG, 'User with id: ' . $loggedInUserId . ' failed to delete record for table name: ' . $tableName .' with id: ' . $pkValue);

          return redirect()->to($returnUrl);
      }
  }

    /**
   * Deletes a service record from the database and returns a JSON response.
   *
   * @return void
   */
    public function deleteServiceWithCode()
    {
        $tableName = $this->request->getPost('table_name');
        $pkName = $this->request->getPost('pk_name');
        $pkValue = $this->request->getPost('pk_value');
        $childTables = $this->request->getPost('child_table');
        $returnUrl = $this->request->getPost('return_url');

        //show demo message
        if(boolval(env('DEMO_MODE', "false"))){
            $errorMsg = "Action not available in the demo mode.";
            session()->setFlashdata('warningAlert', $errorMsg);
            return redirect()->to($returnUrl);
        }

        try {
            // Remove the main record
            deleteRecord($tableName, $pkName, $pkValue);

            // Check if $childTables is not empty
            if (!empty($childTables)) {
                // Split the comma-separated strings into an array
                $tablesArray = explode(',', $childTables);

                // Iterate over each table and delete records
                foreach ($tablesArray as $table) {
                    deleteRecord($table, $pkName, $pkValue);
                }
            }

            // Return a successful response (HTTP 200 OK)
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Record(s) successfully removed.']);
        } catch (Exception $e) {
            // Return an error response (HTTP 500 Internal Server Error)
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred while removing the record(s).']);
        }
    }

    /**
     * Unsubscribes a user from the service using either a subscription UUID or email address.
     *
     * Accepts a query parameter `identifier`, which can be a UUID or an email.
     * Example: /services/unsubscribe?identifier=user@example.com
     *
     * @return void
     */
    public function unsubscribe()
    {
        $identifier = $this->request->getGet('identifier');

        $updateColumn = "'status' = 'Unsubscribed'";
        $updateWhereClause = isValidGUID($identifier)
            ? "subscription_form_id = '$identifier'"
            : "email = '$identifier'";

        $result = updateRecordColumn("subscription_form_submissions", $updateColumn, $updateWhereClause);

        if ($result) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'You have unsubscribed and will no longer receive messages from this service.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Unable to process your unsubscribe request.']);
        }
    }

    /**
     * Resubscribes a user to the service using either a subscription UUID or email address.
     *
     * Accepts a query parameter `identifier`, which can be a UUID or an email.
     * Example: /services/resubscribe?identifier=user@example.com
     *
     * @return void
     */
    public function resubscribe()
    {
        $identifier = $this->request->getGet('identifier');

        $updateColumn = "'status' = 'Active'";
        $updateWhereClause = isValidGUID($identifier)
            ? "subscription_form_id = '$identifier'"
            : "email = '$identifier'";

        $result = updateRecordColumn("subscription_form_submissions", $updateColumn, $updateWhereClause);

        if ($result) {
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'You have re-subscribed and would now be receiving messages from this service.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Unable to process your resubscribe request.']);
        }
    }

}

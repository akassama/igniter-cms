<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class BackgroundController extends BaseController
{
    public function dailyJobs($key = null)
    {
         // Verify the security key
         if ($key !== env('CRON_SECURITY_KEY')) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ]);
        }

        //OPTIONAL - Implement job here

        try {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => 'Job executed successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Failed to execute job.',
            ]);
        }
    }

    
    public function mondayJobs($key = null)
    {
         // Verify the security key
         if ($key !== env('CRON_SECURITY_KEY')) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ]);
        }

        try {
            //OPTIONAL - Implement job here
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => 'Job executed successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Failed to execute job.',
            ]);
        }
    }
}


<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BlogsModel;


class CronController extends BaseController
{
    public function run()
    {
        try {
            $key = $this->request->getGet('key');

            // Security: Verify cron key (treat missing or wrong key the same)
            if (!$key || $key !== env('CRON_SECRET_KEY')) {
                return $this->response->setStatusCode(403)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Unauthorized'
                    ]);
            }

            //Update scheduled blog statuses
            $blogsModel = new BlogsModel();
            $scheduledBlogs = $blogsModel->where('status', '2')->orderBy('created_at', 'DESC')->findAll();

            if ($scheduledBlogs) {
                // Get current time in the same format as your DB (Y-m-d H:i:s)
                $currentDateTime = date('Y-m-d H:i:s');

                foreach ($scheduledBlogs as $blog) {
                    $blogId = $blog['blog_id'];
                    $scheduledDateTime = $blog['scheduled_date_time'];

                    // Check if the scheduled time has passed or is happening now
                    if ($scheduledDateTime <= $currentDateTime) {
                        $blogsModel->update($blogId, [
                            'status' => '1'
                        ]);
                    }
                }
            }

            // Do more cron work here...
            // ...

            // Log activity
            logActivity(null, ActivityTypes::CRON_EXECUTION, 'Cron executed from IP : ' . getIPAddress());

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status'    => 'success',
                    'message'   => 'Cron job(s) executed successfully',
                    'timestamp' => date('Y-m-d H:i:s')
                ]);

        } catch (\Throwable $e) {
            // Log full exception for diagnostics without leaking details to the client
            log_message('error', '[CRON] Exception: {message} @ {file}:{line}', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return $this->response->setStatusCode(500)
                ->setJSON([
                    'status'  =>  'error',
                    'message' => 'Internal server error'
                ]);
        }
    }
}

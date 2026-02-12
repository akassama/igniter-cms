<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


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

            // Log activity (keep your helpers/imports as-is)
            logActivity(null, ActivityTypes::CRON_EXECUTION, 'Cron executed from IP : ' . getIPAddress());

            // Do your cron work here...
            // ...

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status'    => 'success',
                    'message'   => 'Cron job executed successfully',
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
                    'status'  => 'error',
                    'message' => 'Internal server error'
                ]);
        }
    }
}

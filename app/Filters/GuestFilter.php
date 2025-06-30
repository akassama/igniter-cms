<?php


namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the current URL
        $currentUrl = current_url();

        $enableInstallationTracking = getConfigData("EnableInstallationTracking");
        $installationTracked = getConfigData("InstallationTracked");
        if(strtolower($enableInstallationTracking) === "yes" && strtolower($installationTracked) === "no")
        {
            $data = [
                'installation_id' => env('APP_KEY'),
                'domain' => $_SERVER['HTTP_HOST'] ?? $currentUrl,
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
                'php_version' => PHP_VERSION,
                'ci_version' => \CodeIgniter\CodeIgniter::CI_VERSION,
                'cms_name' => env('APP_NAME'),
                'cms_version' => env('APP_VERSION'),
                'tracked_at' => date('c')
            ];

            // Send cURL/POST data
            $ch = curl_init('https://api.ignitercms.com/api/track-installation/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

            // Add a timeout to prevent long delays
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 5 seconds timeout

            // Execute cURL and close
            $response = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                // Log the cURL error if necessary, but don't stop execution
                log_message('error', 'SiteStatsFilter cURL error: ' . $curlError);
            }

            //update enable track to no and tracked as yes
            $updateEnableTrackingColumn =  "'config_value' = 'No'";
            $updateEnableTrackingWhereClause = "config_for = 'EnableInstallationTracking'";
            updateRecordColumn("configurations", $updateEnableTrackingColumn, $updateEnableTrackingWhereClause);
            
            $updateTrackedColumn =  "'config_value' = 'Yes'";
            $updateTrackedWhereClause = "config_for = 'InstallationTracked'";
            updateRecordColumn("configurations", $updateTrackedColumn, $updateTrackedWhereClause);
        }

        if (session()->get('is_logged_in')) {
            return redirect()->to('/account/dashboard');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

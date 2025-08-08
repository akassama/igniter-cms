<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateKey extends BaseCommand
{
    protected $group       = 'Security';
    protected $name        = 'generate:key';
    protected $description = 'Generates a unique application key and stores it in the .env file.';

    public function run(array $params)
    {
        // Generate a 256-bit key
        $key1 = bin2hex(random_bytes(32));
        $key2 = bin2hex(random_bytes(32));

        // Define .env file path
        $envFile = ROOTPATH . '.env';

        if (!file_exists($envFile)) {
            CLI::write('Error: .env file does not exist.', 'red');
            return;
        }

        // Read existing .env content
        $envContent = file_get_contents($envFile);

        // Check if APP_KEY already exists
        if (preg_match('/APP_KEY\s*=\s*/', $envContent)) {
            // Replace existing key
            $envContent = preg_replace('/APP_KEY\s*=\s*[^\n]*/', "APP_KEY={$key1}", $envContent);
        } else {
            // Append new APP_KEY
            $envContent .= PHP_EOL . "APP_KEY={$key1}";
        }

        // Check if PLUGIN_API_REQUEST_KEY already exists
        if (preg_match('/PLUGIN_API_REQUEST_KEY\s*=\s*/', $envContent)) {
            // Replace existing key
            $envContent = preg_replace('/PLUGIN_API_REQUEST_KEY\s*=\s*[^\n]*/', "PLUGIN_API_REQUEST_KEY={$key2}", $envContent);
        } else {
            // Append new PLUGIN_API_REQUEST_KEY
            $envContent .= PHP_EOL . "PLUGIN_API_REQUEST_KEY={$key2}";
        }

        // Write back to .env file
        file_put_contents($envFile, $envContent);

        CLI::write("New application keys generated and saved: ({$key1},{$key2})", 'green');
    }
}

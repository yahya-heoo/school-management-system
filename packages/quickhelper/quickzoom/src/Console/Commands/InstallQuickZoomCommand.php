<?php
namespace QuickZoom\Console\Commands;

use Illuminate\Console\Command;

class InstallQuickZoomCommand extends Command
{
    protected $signature = 'quickzoom:install';
    protected $description = 'Install the QuickZoom package';

    public function handle()
    {
        $this->info('Installing QuickZoom Package...');

        $this->call('vendor:publish', [
            '--provider' => 'QuickZoom\Providers\QuickZoomServiceProvider',
            '--tag' => 'quickzoom-config'
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'QuickZoom\Providers\QuickZoomServiceProvider',
            '--tag' => 'quickzoom-migrations'
        ]);

        $this->info('QuickZoom package installed successfully.');
        $this->info('Please add your Zoom API credentials to your .env file:');
        $this->info('ZOOM_API_KEY=your_api_key');
        $this->info('ZOOM_API_SECRET=your_api_secret');
        $this->info('ZOOM_ACCOUNT_ID=your_account_id');
        $this->info('ZOOM_WEBHOOK_SECRET=your_webhook_secret (optional)');

        $this->warn('Note: Zoom has deprecated JWT authentication. Please use OAuth 2.0 Server-to-Server app credentials.');
    }
}
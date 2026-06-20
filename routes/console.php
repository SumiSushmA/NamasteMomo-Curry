<?php

use App\Services\Toast\ToastSyncService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('toast:sync-menu', function (ToastSyncService $syncService) {
    $log = $syncService->sync();

    if ($log->is_success) {
        $this->info($log->message);
    } else {
        $this->error($log->message);
    }

    return $log->is_success ? 0 : 1;
})->purpose('Sync menu names and prices from Toast POS');

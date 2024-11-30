<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


// Register any custom console commands here
Artisan::command('inspire', function () {
    $this->comment('Keep pushing forward!');
})->describe('Display an inspiring quote');

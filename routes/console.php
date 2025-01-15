<?php

// use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
// Kernel::command('posts:publish', PublishScheduledPosts::class);
<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Автоматическая публикация постов';

    public function handle()
    {
        $posts = Post::where('scheduled_publish_at', '<=', Carbon::now())
                     ->where('is_published', false)
                     ->get();

        foreach ($posts as $post) {
            $post->update(['is_published' => true]);
        }

        $this->info('Запланированные посты опубликованы.');
    }
}

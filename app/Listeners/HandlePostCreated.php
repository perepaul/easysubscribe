<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\SendNewPostMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandlePostCreated implements ShouldQueue
{
    use InteractsWithQueue;

    public $afterCommit = true;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        $users = $post?->website?->users;

        if ($users) {
            Mail::to($users)->send(new SendNewPostMailable($post));
        }
    }
}

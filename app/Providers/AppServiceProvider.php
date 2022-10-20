<?php

namespace App\Providers;

use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use App\Observers\PostVoteObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Newest posts
        View::share('newestPosts', Post::with('community')->latest()->take(5)->get());
        View::share('newestCommunities', Community::with('posts')->withCount('posts')->take(5)->get());

        // PostVoteObserver
        PostVote::observe(PostVoteObserver::class);

        // Gates
        Gate::define('edit-post', function(User $user, Post $post){
            return $post->user_id == $user->id;
        });

        Gate::define('delete-post', function(User $user, Post $post){
            return in_array($user->id, [$post->user_id, $post->community->user_id]);
        });
    }
}

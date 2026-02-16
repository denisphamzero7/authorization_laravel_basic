<?php

namespace App\Providers;
use App\Policies\PostPolicy;
use App\Models\Post;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Modules;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        ResetPassword::createUrlUsing(function ($doctor, string $token) {
            return 'http://example.com/doctors/reset-password?token=' . $token . '&email=' . urlencode($doctor->email);
        });
        // Định nghĩa gate: user này có quyền thêm bài viết không
        Gate::define('post.add', function (User $user) {

            return true;
        });

        // Gate::define('post.add', [PostPolicy::class,'add']);

        Gate::define('post.update', function (User $user, Post $post) {
            return $user->id === $post->user_id;
            // dd($post);
        });
        // 1, lấy danh sách module
         $modulesList = Modules::all();
         if($modulesList->count()>0) {
            foreach ($modulesList as $module){
                Gate::define($module->name,function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name);
                        return $check;
                      }
                      return false;
                });

            }
         }
    }
}

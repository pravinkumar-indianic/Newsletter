<?php
namespace Indianic\Newsletters;


use Indianic\Newsletters\Nova\Resources\Newsletters;
// use Indianic\Newsletters\Policies\NewslettersPolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Indianic\Newsletters\Console\NewsletterCommand;

class NewslettersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        /*$this->setModulePermissions();

        Gate::policy(\Indianic\Newsletters\Models\Newsletters::class, NewslettersPolicy::class);*/

        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                Newsletters::class,
            ]);

        });

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(base_path('vendor/indianic/newsletters/Database/migrations'));
            $path = 'vendor/indianic/newsletters/Database';
            $migrationPath = $path."/migrations";
            if (is_dir($migrationPath)) {
                foreach (array_diff(scandir($migrationPath, SCANDIR_SORT_NONE), [".",".."]) as $migration) {
                    Artisan::call('migrate', [
                        '--path' => $migrationPath."/".$migration
                    ]);
                }
            }
        }
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

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
     * Set newsletters module permissions
     *
     * @return void
     */


    private function setModulePermissions()
    {
        $existingPermissions = config('nova-permissions.permissions');

        $existingPermissions['view newsletters'] = [
            'display_name' => 'View newsletters',
            'description'  => 'Can view newsletters',
            'group'        => 'newsletters'
        ];

        $existingPermissions['create newsletters'] = [
            'display_name' => 'Create newsletters',
            'description'  => 'Can create newsletters',
            'group'        => 'newsletters'
        ];

        $existingPermissions['update newsletters'] = [
            'display_name' => 'Update newsletters',
            'description'  => 'Can update newsletters',
            'group'        => 'newsletters'
        ];

        $existingPermissions['delete newsletters'] = [
            'display_name' => 'Delete newsletters',
            'description'  => 'Can delete newsletters',
            'group'        => 'newsletters'
        ];

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }
}

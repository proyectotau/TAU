<?php

namespace Modules\Administration\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Config;
use Joselfonseca\LaravelTactician\Bus as CommandBus;

use Modules\Administration\Repositories\Repository;
use Modules\Administration\Repositories\Eloquent\{User, Group, Role};

use Modules\Administration\Commands\Handler\{
    IndexUser, StoreUser, ShowUser, UpdateUser, DestroyUser,
    UsersGroups, UsersGroupsNotIn, UsersGroupsUpdate};
use Modules\Administration\Commands\Handler\{
    IndexGroup, StoreGroup, ShowGroup, UpdateGroup, DestroyGroup,
    GroupsUsers, GroupsUsersNotIn, GroupsUsersUpdate,
    GroupsRoles, GroupsRolesNotIn, GroupsRolesUpdate};
use Modules\Administration\Commands\Handler\{
    IndexRole, StoreRole, ShowRole, UpdateRole, DestroyRole,
    RolesGroups, RolesGroupsNotIn};

class AdministrationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var array
     */
    protected $commandsHandlers = [
        // Users Admin Commands
        'Modules\Administration\Commands\IndexUser'   => 'Modules\Administration\Commands\Handler\IndexUser',
        'Modules\Administration\Commands\StoreUser'   => 'Modules\Administration\Commands\Handler\StoreUser',
        'Modules\Administration\Commands\ShowUser'    => 'Modules\Administration\Commands\Handler\ShowUser',
        'Modules\Administration\Commands\UpdateUser'  => 'Modules\Administration\Commands\Handler\UpdateUser',
        'Modules\Administration\Commands\DestroyUser' => 'Modules\Administration\Commands\Handler\DestroyUser',
        // Groups Admin Commands
        'Modules\Administration\Commands\IndexGroup'   => 'Modules\Administration\Commands\Handler\IndexGroup',
        'Modules\Administration\Commands\StoreGroup'   => 'Modules\Administration\Commands\Handler\StoreGroup',
        'Modules\Administration\Commands\ShowGroup'    => 'Modules\Administration\Commands\Handler\ShowGroup',
        'Modules\Administration\Commands\UpdateGroup'  => 'Modules\Administration\Commands\Handler\UpdateGroup',
        'Modules\Administration\Commands\DestroyGroup' => 'Modules\Administration\Commands\Handler\DestroyGroup',
        // Roles Admin Commands
        'Modules\Administration\Commands\IndexRole'   => 'Modules\Administration\Commands\Handler\IndexRole',
        'Modules\Administration\Commands\StoreRole'   => 'Modules\Administration\Commands\Handler\StoreRole',
        'Modules\Administration\Commands\ShowRole'    => 'Modules\Administration\Commands\Handler\ShowRole',
        'Modules\Administration\Commands\UpdateRole'  => 'Modules\Administration\Commands\Handler\UpdateRole',
        'Modules\Administration\Commands\DestroyRole' => 'Modules\Administration\Commands\Handler\DestroyRole',
        // Users Relations Commands
        // To Groups
        'Modules\Administration\Commands\UsersGroups'       => 'Modules\Administration\Commands\Handler\UsersGroups',
        'Modules\Administration\Commands\UsersGroupsNotIn'  => 'Modules\Administration\Commands\Handler\UsersGroupsNotIn',
        'Modules\Administration\Commands\UsersGroupsUpdate'  => 'Modules\Administration\Commands\Handler\UsersGroupsUpdate',
        // Groups Relations Commands
        // To Users
        'Modules\Administration\Commands\GroupsUsers'       => 'Modules\Administration\Commands\Handler\GroupsUsers',
        'Modules\Administration\Commands\GroupsUsersNotIn'  => 'Modules\Administration\Commands\Handler\GroupsUsersNotIn',
        'Modules\Administration\Commands\GroupsUsersUpdate'  => 'Modules\Administration\Commands\Handler\GroupsUsersUpdate',
        // To Roles
        'Modules\Administration\Commands\GroupsRoles'       => 'Modules\Administration\Commands\Handler\GroupsRoles',
        'Modules\Administration\Commands\GroupsRolesNotIn'  => 'Modules\Administration\Commands\Handler\GroupsRolesNotIn',
        'Modules\Administration\Commands\GroupsRolesUpdate'  => 'Modules\Administration\Commands\Handler\GroupsRolesUpdate',
        // Roles Relations Commands
        // To Group
        'Modules\Administration\Commands\RolesGroups'       => 'Modules\Administration\Commands\Handler\RolesGroups',
        'Modules\Administration\Commands\RolesGroupsNotIn'       => 'Modules\Administration\Commands\Handler\RolesGroupsNotIn',
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();

        $this->registerCommandsHandlerBindings();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //echo 'Se ha llamado a register() de AppServiceProvider: '.$this->app->environment().PHP_EOL;

        //$this->registerCommandsHandlerBindings();

        /**/

        /*$this->app->when('Modules\Administration\Http\Controllers')
            ->needs('$who')
            ->give($this->app->make('SomeInterface'));*/
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('administration.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'administration'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/administration');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/administration';
        }, Config::get('view.paths')), [$sourcePath]), 'administration');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/administration');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'administration');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'administration');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    // According to https://gist.github.com/joselfonseca/c53132658f74419060065c13846e7c06#file-busserviceprovider2-php
    private function registerCommandsHandlerBindings(){
        if( false && $this->app->environment() === 'testing' ){ // TODO: Move to phpunit's App bootstrap
            $this->registerUserRepositoryForTesting();
            $this->registerGroupRepositoryForTesting();
            $this->registerRoleRepositoryForTesting();
            return;
        }else{
            $this->registerUserRepository();
            $this->registerGroupRepository();
            $this->registerRoleRepository();
            $commandsHandlers = $this->commandsHandlers;
        }

        $this->app->singleton('admin.commandbus',
                function (\Illuminate\Contracts\Foundation\Application $app) use ($commandsHandlers) {
                    $bus = $app->make(CommandBus::class);
                    foreach($commandsHandlers as $command => $handler) {
                        $bus->addHandler($command, $handler);
                    }
                    return $bus;
        });

    }

    private function registerUserRepositoryForTesting(){
        $this->app->bind('Modules\Administration\Repositories\UserRepository',
            'Modules\Administration\Repositories\ArrayRepository\User');
    }

    private function registerGroupRepositoryForTesting(){
        $this->app->bind('Modules\Administration\Repositories\GroupRepository',
            'Modules\Administration\Repositories\ArrayRepository\Group');
    }

    private function registerRoleRepositoryForTesting(){
        $this->app->bind('Modules\Administration\Repositories\RoleRepository',
            'Modules\Administration\Repositories\ArrayRepository\Role');
    }

    private function registerUserRepository(){
        /*$this->app->bind('Modules\Administration\Repositories\UserRepository',
            'Modules\Administration\Repositories\Eloquent\User');*/
        $this->app->when(IndexUser::class)->needs(Repository::class)->give(User::class);
        $this->app->when(StoreUser::class)->needs(Repository::class)->give(User::class);
        $this->app->when(ShowUser::class)->needs(Repository::class)->give(User::class);
        $this->app->when(UpdateUser::class)->needs(Repository::class)->give(User::class);
        $this->app->when(DestroyUser::class)->needs(Repository::class)->give(User::class);
        // Relations
        $this->app->when(UsersGroups::class)->needs(Repository::class)->give(User::class);
        $this->app->when(UsersGroupsNotIn::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(UsersGroupsUpdate::class)->needs(Repository::class)->give(User::class);


    }

    private function registerGroupRepository(){
        $this->app->when(IndexGroup::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(StoreGroup::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(ShowGroup::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(UpdateGroup::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(DestroyGroup::class)->needs(Repository::class)->give(Group::class);
        // Relations
        $this->app->when(GroupsUsers::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(GroupsUsersNotIn::class)->needs(Repository::class)->give(User::class);
        $this->app->when(GroupsUsersUpdate::class)->needs(Repository::class)->give(Group::class);

        $this->app->when(GroupsRoles::class)->needs(Repository::class)->give(Group::class);
        $this->app->when(GroupsRolesNotIn::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(GroupsRolesUpdate::class)->needs(Repository::class)->give(Group::class);
    }

    private function registerRoleRepository(){
        $this->app->when(IndexRole::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(StoreRole::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(ShowRole::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(UpdateRole::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(DestroyRole::class)->needs(Repository::class)->give(Role::class);
        // Relations
        $this->app->when(RolesGroups::class)->needs(Repository::class)->give(Role::class);
        $this->app->when(RolesGroupsNotIn::class)->needs(Repository::class)->give(Group::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Category
        $this->defineGateCategory();
        //Post
        $this->defineGatePost();
        //Slider
        $this->defineGateSlider();
        //Product
        $this->defineGateProduct();
        //Setting
        $this->defineGateSetting();
        //User
        $this->defineGateUser();
        //Menu
        $this->defineGateMenu();
        //Role
        $this->defineGateRole();
        $this->defineGateHome();
        $this->defineGateComment();
        $this->defineGatePage();
        $this->defineGatePer();
        $this->defineGateOrder();
    }
    // Phân quyền cho Module Category
    public function defineGateCategory()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
    //phân quyền cho Module Post
    public function defineGatePost()
    {
        Gate::define('post-list', 'App\Policies\PostPolicy@view');
        Gate::define('post-add', 'App\Policies\PostPolicy@create');
        Gate::define('post-edit', 'App\Policies\PostPolicy@update');
        Gate::define('post-delete', 'App\Policies\PostPolicy@delete');
    }
    //phân quyền cho Module Slider
    public function defineGateSlider()
    {
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }
    //phân quyền cho Module Product
    public function defineGateProduct()
    {
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }
    //phân quyền cho Module Setting
    public function defineGateSetting()
    {
        Gate::define('setting-list', 'App\Policies\SettingPolicy@view');
        Gate::define('setting-add', 'App\Policies\SettingPolicy@create');
        Gate::define('setting-edit', 'App\Policies\SettingPolicy@update');
        Gate::define('setting-delete', 'App\Policies\SettingPolicy@delete');
    }
    //phân quyền cho Module User
    public function defineGateUser()
    {
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }
    //phân quyền cho Module Menu
    public function defineGateMenu()
    {
        Gate::define('menu-list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu-add', 'App\Policies\MenuPolicy@create');
        Gate::define('menu-edit', 'App\Policies\MenuPolicy@update');
        Gate::define('menu-delete', 'App\Policies\MenuPolicy@delete');
    }
    //phân quyền cho Module Role
    public function defineGateRole()
    {
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }
    public function defineGateHome(){
        Gate::define('admin-list', 'App\Policies\HomePolicy@view');
    }
    public function defineGatePer(){
        Gate::define('permissions-list', 'App\Policies\PermissionPolicy@view');
    }
    //comment
    public function defineGateComment(){
        Gate::define('comment-list', 'App\Policies\CommentPolicy@view');
    }
    public function defineGatePage(){
        Gate::define('page-list', 'App\Policies\PagePolicy@view');
    }
    public function defineGateOrder(){
        Gate::define('order-list', 'App\Policies\PagePolicy@view');
    }
}

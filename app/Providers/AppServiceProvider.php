<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\{
    Category,
    Client,
    Plan,
    Product,
    Table,
    Tenant
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver
};
use Illuminate\Support\Facades\Blade;

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
        Category::observe(CategoryObserver::class);
        Client::observe(ClientObserver::class);
        Plan::observe(PlanObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Tenant::observe(TenantObserver::class);

        /**
         * Custom If Statemets
         */
        Blade::if('admin', function() {
            $user = auth()->user();

            return $user->isAdmin();
        });
    }
}

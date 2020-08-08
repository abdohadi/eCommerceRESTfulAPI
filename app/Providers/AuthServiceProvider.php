<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
        'App\Buyer' => 'App\Policies\BuyerPolicy',
        'App\Seller' => 'App\Policies\SellerPolicy',
        'App\Transaction' => 'App\Policies\TransactionPolicy',
        'App\Product' => 'App\Policies\ProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(now()->addMinutes(30));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::enableImplicitGrant();

        Passport::tokensCan([
           'purchase-product' => 'Create a new transaction for a specific product',
           'manage-products' => 'Create, read, update, and delete products (CRUD)',
           'manage-account' => 'Read your account data, id, name, email, if verified and if an admin (cannot read password). Modify your account data (email and password). Cannot delete your account',
           'read-general' => 'Read general information like purchasing categories, purchased products, selling products, selling categories, your transactions (purchases and sales)', 
        ]);
    }
}

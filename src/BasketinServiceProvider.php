<?php

namespace Basketin;

use Basketin\Console\FillStateStatusOrders;
use Basketin\Console\SetupBasketin;
use Basketin\Core\ConfigtManager;
use Basketin\Models\Order\Address;
use Basketin\Repositories\OrderAddressRepository;
use Basketin\Support\Repositories\BasketRepository;
use Basketin\Support\Repositories\CouponRepository;
use Basketin\Support\Repositories\CustomerRepository;
use Basketin\Support\Repositories\OrderRepository;
use Basketin\Support\Repositories\ProductRepository;
use Basketin\Support\Repositories\QuoteRepository;
use Basketin\Support\Services\BasketService;
use Basketin\Support\Services\CouponService;
use Basketin\Support\Services\CustomerService;
use Basketin\Support\Services\OrderService;
use Basketin\Support\Traits\HasSetupBasketin;
use Illuminate\Support\ServiceProvider;

class BasketinServiceProvider extends ServiceProvider
{
    use HasSetupBasketin;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/basketin.php', 'basketin');

        $this->app->singleton('configuration', function () {
            return new ConfigtManager();
        });

        $this->app->singleton('product', function () {
            return new ProductRepository();
        });

        $this->app->singleton('basket', function () {
            return new BasketService(
                new BasketRepository,
                new QuoteRepository,
            );
        });

        $this->app->singleton('coupon', function () {
            return new CouponService(
                new CouponRepository
            );
        });

        $this->app->singleton('order', function () {
            return new OrderService(
                new OrderRepository,
                new OrderAddressRepository(
                    new Address
                )
            );
        });

        $this->app->singleton('customer', function () {
            return new CustomerService(
                new CustomerRepository
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->appendCommandToSetup(FillStateStatusOrders::class);

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->publishes([
                __DIR__ . '/../config/basketin.php' => config_path('basketin.php'),
            ], ['basketin', 'basketin-config']);

            $this->commands([
                SetupBasketin::class,
            ]);
        }
    }
}

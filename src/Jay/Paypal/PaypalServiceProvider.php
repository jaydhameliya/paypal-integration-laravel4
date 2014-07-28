<?php

namespace Jay\Paypal;

use Illuminate\Support\ServiceProvider;

class PaypalServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('jay/paypal');
        include __DIR__ . '/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
        $this->app['paypal'] = $this->app->share(function($app) {
            return new Paypal;
        });
        $this->app['paypal.install'] = $this->app->share(function($app) {
            return new Commands\InstallCommand();
        });
        $this->commands(array(
            'paypal.install'
        ));
        $this->app->booting(function() {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Paypal', 'Jay\Paypal\Facades\Paypal');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('paypal');
    }

}

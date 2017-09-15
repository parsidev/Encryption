<?php

namespace Parsidev\Encryption;

use Illuminate\Support\ServiceProvider;

class EncryptionServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot() {
        $this->publishes([
            __DIR__ . '/../../config/encryption.php' => config_path('encryption.php'),
        ]);
    }

    public function register() {
        $this->app->singleton('encryption', function($app) {
            $config = config('encryption');
            return new Encryption($config['keys']);
        });
    }

    public function provides() {
        return ['encryption'];
    }

}

<?php

namespace Parsidev\Encryption;

use Illuminate\Support\ServiceProvider;
use Parsidev\Encryption\Commands\EncryptionKeyGeneratorCommand;

class EncryptionServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot() {
        $this->publishes([
            __DIR__ . '/../../config/encryption.php' => config_path('encryption.php'),
        ]);
        
        if ($this->app->runningInConsole()) {
            $this->commands([EncryptionKeyGeneratorCommand::class,]);
        }
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

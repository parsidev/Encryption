   Encryption for Laravel
   ==========
   
   Requirement<br />
   Laravel 5.5
   
   installation
   ------------
   For install this package Edit your project's ```composer.json``` file to require parsidev/encryption
   
   ```php
   "require": {
       "parsidev/encryption": "dev-master"
   },
   ```
   Now, update Composer:
   ```
   composer update
   ```
   Once composer is finished, you need to add the service provider. Open ```config/app.php```, and add a new item to the providers array.
   ```
   Parsidev\Encryption\EncryptionServiceProvider::class,
   ```
   Next, add a Facade for more convenient usage. In ```config/app.php``` add the following line to the aliases array:
   ```
   'Encryption' => Parsidev\Encryption\Facades\Encryption::class
   ```
   Publish config files:
   ```
   php artisan vendor:publish --provider="Parsidev\Encryption\EncryptionServiceProvider"
   ```
   <br />
   
   Usage
   -----
   Before using this package you must add your custom key(s) to ```encryption.php``` in config folder <br />
   This package can encrypt your text to the count of keys entered in the config file.
   
   ### Encrypt
   ```php
   Encryption::encrypt($text);
   ```
   
   ### Decrypt
   ```php
   Encryption::decrypt($text);
   ```

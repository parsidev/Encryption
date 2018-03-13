Requirement
   ==========
   Laravel 5.6
   
   installation
   ------------
   For install this package Edit your project's ```composer.json``` file to require parsidev/encryption
   
   ```php
   "require": {
       "parsidev/encryption": "5.6.x-dev"
   },
   ```
   Now, update Composer:
   ```
   composer update
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

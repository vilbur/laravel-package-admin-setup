# AdminSetup Package For Laravel Framework
Package admin-setup.<br>
Ready for development and installation.

1. [Create folder for package.](#create-folder-for-package)<br>
2. [Checkout repository.](#checkout-repository)<br>
3. [Set path for development installation.](#set-path-for-development-installation)<br>
4. [Install package locally.](#install-package-locally)<br>


### Create folder for package
application\packages\\__vilbur\admin-setup__


### Checkout repository
In folder application\packages\vilbur\admin-setup run command below.
``` bash
git init &&git remote add origin https://github.com/vilbur/laravel-package-admin-setup.git &&git pull origin master
```


### Set path for development installation
Add to __application\composer.json__.
``` json
"repositories": {
    "admin-setup": {
        "type": "path",
        "url": "packages/vilbur/admin-setup",
        "options": {
            "symlink": true
        }
    }
}
```

### Install package
``` bash
composer require vilbur/admin-setup @dev
```

### Test in Laravel
``` html
http://your-domain/admin-setup
```

### Search and replace in file contents, filenames and folders
Run __ContentAndPathReplacer.exe__ and replace "admin-setup" with your package name


### Publish package
php artisan vendor:publish --provider="vilbur\admin-setup\AdminSetupServiceProvider"

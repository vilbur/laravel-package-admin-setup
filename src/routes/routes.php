<?php

Route::get('/admin-setup', 'Vilbur\AdminSetup\Controllers\AdminSetupController@testView');

Route::get('/admin-setup/migrate', 'Vilbur\AdminSetup\Controllers\AdminSetupController@migrate' );

Route::get('/admin-setup/drop-all-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@dropAllTables' );

Route::get('/admin-setup/database/refresh/{seeders?}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@refreshDatabase' );

Route::get('/admin-setup/seed/{seeders?}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seed' );

Route::get('/admin-setup/get-seeders', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getSeeders' );

Route::get('/admin-setup/get-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getTables' );

Route::get('/admin-setup/seed-generate/{table_names}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seeedGenerate' );

Route::get('/admin-setup/cache-clear', function(){
	\Artisan::call('cache:clear');
	\Artisan::call('view:clear');
	\Artisan::call('config:clear');
	\Artisan::call('route:clear');
});

Route::get('/admin-setup/truncate-tables/{table_names}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@truncateTables' );

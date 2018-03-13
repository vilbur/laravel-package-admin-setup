<?php


Route::get('/admin-setup', 'Vilbur\AdminSetup\Controllers\AdminSetupController@testView');


Route::get('/admin-setup/drop-all-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@dropAllTables' );

Route::get('/admin-setup/migrate', 'Vilbur\AdminSetup\Controllers\AdminSetupController@migrate' );

Route::get('/admin-setup/seed/{seeders}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seed' );

Route::get('/admin-setup/get-seeders', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getSeeders' );

Route::get('/admin-setup/get-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getTables' );

Route::get('/admin-setup/seed-generate/{tables}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seeedGenerate' );


Route::get('/admin-setup/cache-clear', function(){
	\Artisan::call('cache:clear');
});


Route::get('/admin-setup/truncate-tables/{tables}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@truncateTables' );

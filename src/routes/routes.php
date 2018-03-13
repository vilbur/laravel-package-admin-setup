<?php


Route::get('/admin-setup', 'Vilbur\AdminSetup\Controllers\AdminSetupController@testView');


Route::get('/admin-setup/drop-all-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@dropAllTables' );

Route::get('/admin-setup/migrate', 'Vilbur\AdminSetup\Controllers\AdminSetupController@migrate' );

Route::get('/admin-setup/seed/{seeders}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seed' );

Route::get('/admin-setup/get-seeders', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getSeeders' );

Route::get('/admin-setup/get-tables', 'Vilbur\AdminSetup\Controllers\AdminSetupController@getTables' );

Route::get('/admin-setup/seed-generate/{tables}', 'Vilbur\AdminSetup\Controllers\AdminSetupController@seeedGenerate' );


/**
* ROUTE ONLY FOR DEVELOPER
**/
//Route::get('/start','Backend\StartController@getView' );
/**
* ROUTE ONLY FOR START, no loggin needed
//**/
//Route::get('start', function(){
//	//dump(  \Config::get('models') );
//	//dump('start');exit();
//	return view('backend.start', ["models" => \Config::get('models')]);
//});


//dump('test');exit();
/**
* MIGRATE ALL TABLES
**/
//Route::get('/db/migrate','Backend\StartController@migrateAll' );

/**
* reset all id in table
**/
//Route::get('/db/resetid/{parent_model}/{model}','Backend\StartController@resetid' );
//Route::get('/db/resetid/{parent_model}/{model}', [
//	'as' => 'resetid',
//	'middleware' => 'level:1',
//	'uses' => 'Backend\StartController@resetid',
//]);

/**
* SEED ALL TABLES
**/

//Route::get('/db/seed','Backend\StartController@seedAll' );

/**
* CREATE SEED FILES OF ALL TABLES
**/
//Route::get('/db/seed/create/all','Backend\StartController@createAllSeedFiles' );

/**
* DROP ALL DB TABLES
**/
//Route::get('/db/delete','Backend\StartController@deleteAllTables' );

///**
//* CLEAR CACHE
//**/
//Route::get('/cache/clear', function(){
//	\Artisan::call('cache:clear');
//});

/**
* SEED SPECIFIC TABLE
**/
//Route::get('/db/seedTable/{seederClass}', 'Backend\StartController@seedTable');
/**
* CREATE SEED FILE OF SPECIFIC TABLE
**/
//Route::get('/db/createSeedFile/{model}', 'Backend\StartController@createSeedFile');
/**
* TRUNCATE SPECIFIC TABLE
**/
//Route::get('/db/truncateTable/{model}','Backend\StartController@truncateTable' );

//Route::get('/db/database/create/{migration}', 'Backend\StartController@runSingleMigration');

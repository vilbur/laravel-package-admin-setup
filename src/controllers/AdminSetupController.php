<?php namespace Vilbur\AdminSetup\Controllers;

use App\Http\Controllers\Controller;
//use Vilbur\AdminSetup\Models\AdminSetup;
use Vilbur\AdminSetup\Services\DatabaseService;


class AdminSetupController extends Controller {

	/**
	* CONSTRUCT
	**/
	public function __construct( DatabaseService $DatabaseService ){
		$this->DatabaseService = $DatabaseService;

	}


    public function testView() {
		return \View::make('AdminSetup::view');
	}

	/** Drop All Tables
	 */
	public function dropAllTables()
	{
		$this->DatabaseService->dropAllTables();
		return 'All tables are dropped';
		//return  \Redirect::back();
	}

	/** Migrate tables
	 */
	public function migrate()
	{
		$this->DatabaseService->migrate();
		return 'All tables are dropped';
		//return  \Redirect::back();
	}

	/** Seed tables
	 *
	 *  @param string $seeders class names of seeders E.G: 'RolesTablesSeeder,UserAdminTableSeeder'
	 */
	public function seed($seeders=null)
	{
		if($seeders)
			$this->DatabaseService->seedTables( explode ( ',', $seeders ) );
		else
			$this->DatabaseService->seedAll();

		return 'All tables are seeded';
	}

	/**  Generate seed files
	 *
	 *  @param string $table_names names of tables E.G: 'users,roles'
	 */
	public function seeedGenerate( $table_names )
	{
		$this->DatabaseService->generateSeeds( $table_names );

		return 'Seeds generated';
	}
	/** get Seeder class names
	*/
	public function getSeeders()
	{
		return $this->DatabaseService->getSeeders();
	}
	/** get Tables names
	*/
	public function getTables()
	{
		return $this->DatabaseService->getTables();
	}
	/**
	* Truncate Tables
	*
	*
	**/
	public function truncateTables( $table_names ){

		$this->DatabaseService->truncateTables( explode ( ',', $table_names ));
		return "Tables $table_names truncated";
	}
	///**
	//* MIGRATE ALL TABLES
	//*
	//*
	//**/
	//public function getMigrateAll(){
	//	$this->DatabaseService->migrateAll();
	//	return  \Redirect::back();
	//}
	//
	///**
	//* CREATE SEED FILES OF ALL TABLES
	//**/
	//public function getSeedAll(){
	//	$this->DatabaseService->seedAll();
	//	return \Redirect::back();
	//}
	//
	///**
	//* createAllSeedFiles
	//**/
	//public function createAllSeedFiles(){
	//	$this->DatabaseService->createAllSeedFiles();
	//	return  \Redirect::back();
	//}
	//
	///**
	//* delete All Tables
	//**/
	//public function getDeleteAllTables(){
	//	$this->DatabaseService->deleteAllTables();
	//	return  \Redirect::back();
	//}
	//
	///*
	//* CLEAR APP CACHE
	//*/
	//public function getClearCache(){
	//	\Artisan::call('cache:clear');
	//	return  \Redirect::back();
	//}
	//
	///**
	//* SEED SPECIFIC TABLE
	//*
	//*
	//**/
	//public function getSeedTable(  ){
	//	$this->DatabaseService->seedTable();
	//	return  \Redirect::back();
	//}
	//
	///**
	//* CREATE SEED FILE OF SPECIFIC TABLE
	//**/
	//public function getCreateSeedFile(  ){
	//	$this->DatabaseService->createSeedFile();
	//	return  \Redirect::back();
	//}

	//
	///**
	//* resetid
	//*
	//*
	//**/
	//public function getResetid(){
	//	$this->DatabaseService->resetid();
	//	return  \Redirect::back();
	//}


}
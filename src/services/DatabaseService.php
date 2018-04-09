<?php namespace Vilbur\AdminSetup\Services;
use Cache;
use Symfony\Component\Finder\Finder;

/**
*  Common work with datbase
**/

class DatabaseService {

	//public $modelName;
	//public $model;
	//public $id;
	//public $parentModelName;
	//public $parentModel;
	//public $seeder_class;


	/**  Migrate tables
	 */
	public function migrate(){
		if(!\Schema::hasTable("migrations"))
			\Artisan::call("migrate:install");

		\Artisan::call("migrate", ["--force" => true]);
	}

	/** Drop all tables
	 */
	public function dropAllTables(){
		$tables = array_reverse( $this->getTables() );
		/*    run twice because of foreign keys    */
		for( $t=0;$t  < 2;$t++ ) {
			foreach ( $tables as $table )
				try {
					\Schema::drop( $table ) ;
				} catch ( \Exception $e) { }
		}
	}
	/** get Seeders
	 */
	public function getSeeders()
	{
		//return ['CompanyTableSeeder', 'DatabaseSeeder'];
		$file_names	= [];
		$files 	= Finder::create()
						->in( base_path('database/seeds') )
						->depth('== 0')
						->notName('DatabaseSeeder.php')
						->name('*.php');

		foreach($files as $file)
			$file_names[] = basename($file->getFileName(), '.php' );
		
		sort($file_names);

		return $file_names;
	}
	/** Seed all tables
	 */
	public function seedAll()
	{
		\Artisan::call('db:seed', ['--force' => true]);
		\Artisan::call('cache:clear');
	}
	/** seed specific table
	 *
	 *  @param array $seeders class names of seeders
	 */
	public function seedTables( $seeders )
	{
		foreach($seeders as $seeder)
			\Artisan::call('db:seed', ['--class' => $seeder, "--force" => true] );
	}
	/** Generate seed files for tables
	 *
	 * 	REQUIRED PACKAGE: https://github.com/orangehill/iseed
	 *
	 *  @param array $table_names class names
	 */
	public function generateSeeds( $table_names )
	{
		\Artisan::call('iseed', ['tables' => $table_names] );
	}

	/** get tables
	 */
	public function getTables()
	{
		$tables = [];
		foreach ( \DB::select('SHOW TABLES') as $key => $table ){
			$data	= get_object_vars( $table );
			$tables[]	= $data[key( $data )];
		}
		return $tables;
	}



}

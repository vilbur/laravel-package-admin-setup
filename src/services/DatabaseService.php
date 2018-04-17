<?php namespace Vilbur\AdminSetup\Services;
use Cache;
use Symfony\Component\Finder\Finder;

/**
*  Common work with datbase
**/

class DatabaseService
{
	/**  Migrate tables
	 */
	public function migrate()
	{
		if(!\Schema::hasTable("migrations"))
			\Artisan::call("migrate:install");

		\Artisan::call("migrate", ["--force" => true]);
	}

	/** Drop all tables
	 *  Loop while all tables are dropped because of relationship tables can be dropped at once
	 */
	public function dropAllTables()
	{
		while($tables = array_reverse( $this->getTables() ))
		{
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
	/** Seed DatabaseSeeder
	 */
	public function seed()
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

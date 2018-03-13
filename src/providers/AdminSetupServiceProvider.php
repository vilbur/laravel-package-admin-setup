<?php namespace Vilbur\AdminSetup\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class AdminSetupServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
		/* ROUTES */
		$this->loadRoutesFrom(	__DIR__.'/../routes/routes.php');

		/* VIEWS */
		$this->loadViewsFrom(	__DIR__.'/../../publish/views', 'AdminSetup');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
	{

    }

}

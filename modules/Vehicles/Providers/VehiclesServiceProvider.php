<?php namespace Modules\Vehicles\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class VehiclesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the application events.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->registerConfig();
		$this->registerTranslations();
		$this->registerViews();
		$this->registerMenu();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{		
		//

	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function registerMenu()
	{		
		//
		$menu = Menu::instance('menu-left');
		// add a menu with url to a link
		$menu->dropdown( trans('vehicles::vehicles.menu.title'), function ($sub) {
			$sub->route('admin.vehicles.index', trans('vehicles::vehicles.menu.all'), [], 1);
			$sub->route('admin.vehicles.create', trans('vehicles::vehicles.menu.create'), [], 2);
			$sub->divider(3);
		}, 50, ['icon' => 'fa fa-car', 'auth'=>true]);
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('vehicles.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'vehicles'
		);

	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/vehicles');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'vehicles');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/vehicles');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'vehicles');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'vehicles');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

<?php namespace Modules\Petition\Providers;

use Illuminate\Support\ServiceProvider;
use Config, Menu, Request, View, Blade;
use App\Libraries\Api;

class PetitionServiceProvider extends ServiceProvider {

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
		$this->registerTranslations();
		$this->registerConfig();
		$this->registerViews();

		//
		// CREATING THE MENU
		//
		$menu = Menu::instance('backend');
		$menu->url('/petition', trans('petition::petitions.petitions'), 5 );

		/*view()->composer('admin::index', function ($view) 
        {
        	$view->widgets[] = view('petition::widget');
        	$view->with('widgets', $view->widgets );
        }); */
		
		$api = new Api();
		$api->setWidget('widgets', 'admin::index', 'petition::widget');

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
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('petition.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'petition'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/petition');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path) {
			return $path . '/modules/petition';
		}, \Config::get('view.paths')), [$sourcePath]), 'petition');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/petition');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'petition');
		} else {
			$this->loadTranslationsFrom( __DIR__.'/../Resources/lang', 'petition');
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

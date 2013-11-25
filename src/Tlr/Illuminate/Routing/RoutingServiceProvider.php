<?php namespace Tlr\Illuminate\Routing;

use Illuminate\Support\ServiceProvider;
use Tlr\Illuminate\Routing\Router;

class RoutingServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerRouter();
	}

	/**
	 * Register the router instance.
	 *
	 * @return void
	 */
	protected function registerRouter()
	{
		$this->app['router'] = $this->app->share(function($app)
		{
			$router = new Router($app);

			// If the current application environment is "testing", we will disable the
			// routing filters, since they can be tested independently of the routes
			// and just get in the way of our typical controller testing concerns.
			if ($app['env'] == 'testing')
			{
				$router->disableFilters();
			}

			return $router;
		});
	}


}

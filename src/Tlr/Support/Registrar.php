<?php namespace Tlr\Support;

use Illuminate\Support\ServiceProvider;

abstract class Registrar extends ServiceProvider {

	public function register() {}

	public function boot() {

		$this->routes( $this->app['router'] );

		$this->app['router']->group([ 'before' => 'guest' ], function() {
			$this->publicRoutes( $this->app['router'] );
		});

		$this->app['router']->group([ 'before' => 'auth' ], function() {
			$this->privateRoutes( $this->app['router'] );
		});

		$this->filters( $this->app['router'] );

		$this->bindings( $this->app['router'] );

		$this->composers( $this->app['view'] );

	}

	public function routes( $router ) {}
	public function bindings( $router ) {}
	public function privateRoutes( $router ) {}
	public function publicRoutes( $router ) {}
	public function filters( $router ) {}
	public function composers( $view ) {}

}

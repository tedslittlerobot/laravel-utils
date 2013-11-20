Laravel Utils
=============

A collection of classes that i use across a bunch of projects.

### Installation

###### Composer

Until it's on packagist, you can install it using composer's [standard VCS feature](http://getcomposer.org/doc/05-repositories.md#vcs)

```javascript
{
	"repositories": [
		{
			"type": "vcs",
			"url": "https://github.com/tedslittlerobot/laravel-utils"
		}
	]
}
```

#### The Router Mod

This is my implementation of [this issue](https://github.com/laravel/framework/issues/2531)

To use it, add `'Tlr\Illuminate\Routing\RoutingServiceProvider'` to your `app.php` config file's `providers` array at some point *after* the IlluminateRoutingProvider one.

Previously bound keys are now accessible through route bindings like so:

```php
Route::model('category', 'Category');

Route::('post', function( $slug, $route ) {
	$route->getParameter( 'category' )
		->posts()
		->where( 'slug', $slug )
		->firstOrFail();
});
```
#### Repository

An intermediary class for dealing with model CRUD actions.

Add `'Repository' => 'Tlr\Support\Repository'` to your `app.php` config file's `aliases` array.

#### Registrar

An abstraction around the `boot()` method in service providers. Subclasses of the `Registrar` class can use the following methods:

```php
/* for registering routes */
public function routes( $router )
{
	$router->get('/', function() { return 'woop.'; });
}

/* for registering route model bindings */
public function bindings( $router )
{
	$router->model('user', 'User');
}

/* The same as routes, but it is wrapped in an 'auth' filter */
public function privateRoutes( $router )
{
	$router->get('admin', 'AdminController@index');
}

/* The same as routes, but it is wrapped in an 'auth' filter */
public function publicRoutes( $router )
{
	$router->get('login', 'LoginController@login');
}

/* for registering route filters */
public function filters( $router )
{
	$router->filter('deny', function() { return 'DENIED'; });
}

/* for registering view composers */
public function composers( $view )
{
	$view->composer('');
}
```


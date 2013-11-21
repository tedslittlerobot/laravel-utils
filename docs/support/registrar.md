Registrar
=========

When on larger projects, it can be advisable to structure the project by area namespaces, rather than in the rails-esque `models`, `controllers` folder structure. A registrar is a place to put application-level registrations like route declarations, model bindings, composer registrations, etc.

### Usage

Subclass `Tlr\Support\Registrar`, and add your subclass to the `providers` key of `app/config/app.php`.

The Registrar class is a simple abstraction around the `boot()` method in service providers. Subclasses of the `Registrar` class can use the following methods:

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
	$view->composer( 'public.layout', 'PublicLayoutComposer' );
}
```

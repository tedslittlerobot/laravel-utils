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

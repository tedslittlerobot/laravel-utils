Route Binding
=============

This is my implementation of [this issue](https://github.com/laravel/framework/issues/2531)

When performing route bindings, I find often find myself wanting to use previously bound properties. For example, if had `{category}/{post}`, i wouldn't want to perform a query to get the category model twice, because a) it's an unneccessary database call, and b) it's [WET](http://en.wikipedia.org/wiki/Don't_repeat_yourself).

### Installation

To use it, add `'Tlr\Illuminate\Routing\RoutingServiceProvider'` to your `app.php` config file's `providers` array at some point *after* the IlluminateRoutingProvider one.

### Usage

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

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
	],
	"require": [
		"tlr/laravel-utils": "dev-master"
	]
}
```

Once it's up on packagist, you can simply call

```bash
composer require tlr/laravel-utils "1.0.*"
````

### Utilities

###### Illuminate Components

- [The Route Binding Mod](docs/illuminate/route.md)
- [HtmlBuilder](docs/illuminate/html.md)

###### Support Classes

- [Repository](docs/support/repository.md)
- [Registrar](docs/support/registrar.md)

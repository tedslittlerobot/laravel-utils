Html
====

### - attributeElement( $key, $value )

I have modified the attributeElement function to accept arrays of properties. For example the following:

```php
$atts = array(
	'class' => array('top', 'blue', 'logo')
);

echo HTML::attributes( $atts );
```

will now output `class="top blue logo"`

### - element( $element = 'div', $attributes = [], $content = null )

I made this method because I find it messy to construct html within classes.

It will simply generate an html element. For example:

```php
echo HTML::element( 'a', array( 'href' => 'google.com' ) );
```
will output
```html
<a href="google.com">
```

if the third argument, `$content`, is provided, it will create the whole element - ie.

```php
echo HTML::element( 'a', array( 'href' => 'google.com' ), 'Go To Google' );
```
will output
```html
<a href="google.com">Go To Google</a>
```

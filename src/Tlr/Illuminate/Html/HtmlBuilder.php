<?php namespace Tlr\Illuminate\Html;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {

	protected function attributeElement( $key, $value )
	{
		if (is_numeric($key)) $key = $value;

		if ( ! is_null($value)) return $key.'="'.e( implode(' ', (array) $value) ).'"';
	}

	public function element( $element = 'div', $attributes = array(), $content = null )
	{
		$el = array( $element );

		if ( $attributes )
			$el[] = $this->attributes( $attributes );

		$tag = implode( ' ', $el );

		$html = "<{$tag}>";

		if ( !is_null($content) )
		{
			$html .= "{$content}</{$element}>";
		}

		return $html;
	}

}

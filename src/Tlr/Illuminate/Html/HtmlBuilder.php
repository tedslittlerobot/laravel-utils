<?php namespace Tlr\Illuminate\Html;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {

	protected function attributeElement( $key, $value )
	{
		if (is_numeric($key)) $key = $value;

		if ( ! is_null($value)) return $key.'="'.e( implode(' ', (array) $value) ).'"';
	}

	public function element( $element = 'div', $attributes = array(), $content = null )
	{
		$tag = implode( ' ', array( $element, $this->attributes( $attributes ) ) );

		$html = "<{$tag}>";

		if ( !is_null($content) )
		{
			$html .= "{$content}</{$element}>";
		}

		return $html;
	}

}

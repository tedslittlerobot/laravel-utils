<?php namespace Tlr\Illuminate\Html;

class HtmlBuilder extends \Illuminate\Html\HtmlBuilder {

	protected function attributeElement( $key, $value )
	{
		if (is_numeric($key)) $key = $value;

		if ( ! is_null($value)) return $key.'="'.e( implode(' ', (array) $value) ).'"';
	}

	public function element( $element = 'div', $attributes = array(), $content = null )
	{
		$html = "<{$element}{$this->attributes( $attributes )}>";

		if ( !is_null($content) )
			$html .= "{$content}</{$element}>";

		return $html;
	}

}

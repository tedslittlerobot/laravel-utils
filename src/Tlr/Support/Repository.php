<?php namespace Tlr\Support;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;

class Repository {

	/**
	 * An Eloquent model
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * Input to validate
	 * @var array
	 */
	protected $input = array();

	/**
	 * Validate rules
	 * @var array
	 */
	protected $rules = array();

	/**
	 * The validated data
	 * @var array
	 */
	protected $data = array();

	/**
	 * File objects
	 * @var array
	 */
	protected $files = array();


	public function setInput( $input )
	{
		$this->input = $input;

		return $this;
	}

	public function getInput()
	{
		return $this->input;
	}

	public function setModel( Eloquent $model )
	{
		$this->model = $model;

		return $this;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function setRules( $rules )
	{
		$this->rules = $rules;

		return $this;
	}

	public function addRule( $key, $value )
	{
		$this->rules[ $key ] = $value;

		return $this;
	}

	/**
	 * Get the filtered input data, or a specific peice of that data
	 * @param string $key
	 * @param mixed  $default
	 * @return mixed
	 */
	public function data( $key = null, $default = null )
	{
		if ( is_null($key) )	return $this->data;

		return array_get( $this->data, $key, $default );
	}

	/**
	 * Get the files array, or a specific file
	 * @return mixed
	 */
	public function file( $key = null, $default = null )
	{
		if ( is_null($key) )	return $this->files;

		return array_get( $this->files, $key, $default );
	}

	public function validate()
	{
		$this->val = Validator::make( $this->getInput(), $this->getRules() );

		$this->data = $this->val->getData();

		$this->files = $this->val->getFiles();

		return $this->val->passes();
	}

	protected function fill()
	{
		$this->model->fill( $this->data() );

		return $this;
	}

	protected function save()
	{
		$this->model->save();
	}

	public function getErrors()
	{
		return $this->val->getMessageBag();
	}
}

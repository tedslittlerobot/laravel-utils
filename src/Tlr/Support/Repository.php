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

	public function addRules( $key, $value )
	{
		$this->rules[ $key ] = $value;

		return $this;
	}

	public function getFiles()
	{
		return $this->files;
	}

	public function getData()
	{
		return $this->data;
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
		$this->model->fill( $this->getData() );

		return $this;
	}

	protected function save()
	{
		$this->model->save();
	}


}

<?php namespace Tlr\Support;

use Response;

class JSON {

	protected $response = [];

	public function __construct()
	{
		$this->property('status', 'success');
		$this->code(200);
	}

	/**
	 * set a top level property on the response
	 * @author Stef Horner   (shorner@wearearchitect.com)
	 * @param  string   $property
	 * @param  mixed    $value
	 * @return JSON
	 */
	public function property($property, $value)
	{
		if (is_string($property))
			$this->response[$property] = $value;

		return $this;
	}

	/**
	 * set the response as an error
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  string   $msg    the error message
	 * @param  mixed    $code   the code
	 * @return JSON
	 */
	public function error($msg, $code = null)
	{
		$this->property('error', $msg);

		if (!empty($code))
			$this->code($code);

		$this->status('error');

		return $this;
	}

	/**
	 * set the code property on the response
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  string   $code
	 * @return JSON
	 */
	public function code($code)
	{
		$this->property('code', $code);

		return $this;
	}

	/**
	 * Return the response code
	 * @author Stef Horner       (shorner@wearearchitect.com)
	 * @return integer
	 */
	public function getCode()
	{
		return $this->response['code'];
	}

	/**
	 * set the status of the response
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  string   $status
	 * @return JSON
	 */
	public function status($status)
	{
		$this->property('status', $status);

		return $this;
	}

	/**
	 * set the data property on the response
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  mixed   $data
	 * @return JSON
	 */
	public function setData($data)
	{
		$this->property('data', $data);

		return $this;
	}

	/**
	 * set a single data value using dot notation
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  string   $key
	 * @param  mixed    $value
	 * @return JSON
	 */
	public function data($key, $value)
	{
		if ( function_exists('array_set') )
		{
			array_set($this->response, $key, $value);
		}
		else
		{
			if (!isset($this->response['data']))
			{
				$this->response['data'] = [];
			}
			$this->response['data'][$key] = $value;
		}

		return $this;
	}

	/**
	 * a getter for the response property
	 * @author Stef Horner       (shorner@wearearchitect.com)
	 * @return array
	 */
	public function response()
	{
		return $this->response;
	}

	/**
	 * the json encoded form of the response property
	 * @author Stef Horner       (shorner@wearearchitect.com)
	 * @return string
	 */
	public function __toString()
	{
		return json_encode($this->response);
	}

	/**
	 * A convenience method for validation errors
	 * @author Stef Horner (shorner@wearearchitect.com)
	 * @param  Validator   $val
	 * @return array
	 */
	public function val($val)
	{
		$this
			->error('Validation Error', 400)
			->data( 'errors', $val->errors()->all() );

		return $this;
	}

	/**
	 * Return a Laravel JSON Response
	 * @author Stef Horner       (shorner@wearearchitect.com)
	 * @return JsonResponse
	 */
	public function respond()
	{
		return Response::json( $this->response(), $this->getCode() );
	}
}

<?php namespace Tlr\Illuminate\Routing;

class Route extends \Illuminate\Routing\Route {

	/**
	 * Get the parameters to the callback.
	 *
	 * @return array
	 */
	public function getParameters()
	{
		// If we have already parsed the parameters, we will just return the listing
		// that we already parsed as some of these may have been resolved through
		// a binder that uses a database repository and shouldn't be run again.
		if (isset($this->parsedParameters))
		{
			return $this->parsedParameters;
		}

		$variables = $this->compile()->getVariables();

		// To get the parameter array, we need to spin the names of the variables on
		// the compiled route and match them to the parameters that we got when a
		// route is matched by the router, as routes instances don't have them.
		$this->parsedParameters = array();

		foreach ($variables as $variable)
		{
			$this->parsedParameters[$variable] = $this->resolveParameter($variable);
		}

		return $this->parsedParameters;
	}

	/**
	 * Get the raw, unparsed parameters
	 * @author Stef Horner       (shorner@wearearchitect.com)
	 * @return array
	 */
	public function getRawParameters()
	{
		return $this->parameters;
	}

}

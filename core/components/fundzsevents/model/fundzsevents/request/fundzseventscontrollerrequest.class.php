<?php


require_once MODX_CORE_PATH . 'model/modx/modrequest.class.php';

/**
 * Encapsulates the interaction of MODx manager with an HTTP request.
 *
 * {@inheritdoc}
 */
class fundzsEventsControllerRequest extends modRequest {
	public $fundzsEvents = null;
	public $actionVar = 'action';
	public $defaultAction = 'home';


	/**
	 * @param fundzsEvents $fundzsEvents
	 */
	function __construct(fundzsEvents &$fundzsEvents) {
		parent :: __construct($fundzsEvents->modx);
		$this->fundzsEvents =& $fundzsEvents;
	}


	/**
	 * Extends modRequest::handleRequest and loads the proper error handler and
	 * actionVar value.
	 *
	 * {@inheritdoc}
	 */
	public function handleRequest() {
		$this->loadErrorHandler();

		/* save page to manager object. allow custom actionVar choice for extending classes. */
		$this->action = isset($_REQUEST[$this->actionVar])
			? $_REQUEST[$this->actionVar]
			: $this->defaultAction;

		return $this->_respond();
	}


	/**
	 * Prepares the MODx response to a mgr request that is being handled.
	 *
	 * @access public
	 * @return boolean True if the response is properly prepared.
	 */
	private function _respond() {
		$modx =& $this->modx;
		$fundzsEvents =& $this->fundzsEvents;

		$viewHeader = include $this->fundzsEvents->config['corePath'] . 'controllers/mgr/header.php';

		$f = $this->fundzsEvents->config['corePath'] . 'controllers/mgr/' . $this->actionVar . '.php';
		if (file_exists($f)) {
			$viewOutput = include $f;
		}
		else {
			$viewOutput = 'Action not found: ' . $f;
		}

		return $viewHeader . $viewOutput;
	}

}
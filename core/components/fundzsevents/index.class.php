<?php

/**
 * Class fundzsEventsMainController
 */
abstract class fundzsEventsMainController extends modExtraManagerController {
	/** @var fundzsEvents $fundzsEvents */
	public $fundzsEvents;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('fundzsevents_core_path', null, $this->modx->getOption('core_path') . 'components/fundzsevents/');
		require_once $corePath . 'model/fundzsevents/fundzsevents.class.php';

		$this->fundzsEvents = new fundzsEvents($this->modx);

		$this->addCss($this->fundzsEvents->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->fundzsEvents->config['jsUrl'] . 'mgr/fundzsevents.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			fundzsEvents.config = ' . $this->modx->toJSON($this->fundzsEvents->config) . ';
			fundzsEvents.config.connector_url = "' . $this->fundzsEvents->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('fundzsevents:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends fundzsEventsMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}
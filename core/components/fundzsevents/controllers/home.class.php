<?php
/**
 * The home manager controller for fundzsEvents.
 *
 */
class fundzsEventsHomeManagerController extends fundzsEventsMainController {
	/* @var fundzsEvents $fundzsEvents */
	public $fundzsEvents;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('fundzsevents');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addJavascript($this->fundzsEvents->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->fundzsEvents->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->fundzsEvents->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "fundzsevents-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->fundzsEvents->config['templatesPath'] . 'home.tpl';
	}
}
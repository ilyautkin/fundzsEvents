<?php
ini_set('display_errors', 1);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('fundzsevents_core_path', null, $modx->getOption('core_path') . 'components/fundzsevents/');
require_once $corePath . 'model/fundzsevents/fundzsevents.class.php';
$modx->fundzsevents = new fundzsEvents($modx);

$modx->lexicon->load('fundzsevents:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->fundzsevents->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));
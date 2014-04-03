<?php
/**
 * The base class for fundzsEvents.
 */

class fundzsEvents {
	/* @var modX $modx */
	public $modx;
	/* @var fundzsEventsControllerRequest $request */
	protected $request;
	public $initialized = array();
	public $chunks = array();


	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('fundzsevents_core_path', $config, $this->modx->getOption('core_path') . 'components/fundzsevents/');
		$assetsUrl = $this->modx->getOption('fundzsevents_assets_url', $config, $this->modx->getOption('assets_url') . 'components/fundzsevents/');
		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,

			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);

		$this->modx->addPackage('fundzsevents', $this->config['modelPath']);
		$this->modx->lexicon->load('fundzsevents:default');
	}


	/**
	 * Initializes fundzsEvents into different contexts.
	 *
	 * @access public
	 *
	 * @param string $ctx The context to load. Defaults to web.
	 */
	public function initialize($ctx = 'web') {
		switch ($ctx) {
			case 'mgr':
				if (!$this->modx->loadClass('fundzsevents.request.fundzsEventsControllerRequest', $this->config['modelPath'], true, true)) {
					return 'Could not load controller request handler.';
				}
				$this->request = new fundzsEventsControllerRequest($this);

				return $this->request->handleRequest();
				break;
			case 'web':

				break;
			default:
				/* if you wanted to do any generic frontend stuff here.
				 * For example, if you have a lot of snippets but common code
				 * in them all at the beginning, you could put it here and just
				 * call $fundzsevents->initialize($modx->context->get('key'));
				 * which would run this.
				 */
				break;
		}
		return true;
	}


	/**
	 * Gets a Chunk and caches it; also falls back to file-based templates
	 * for easier debugging.
	 *
	 * @access public
	 *
	 * @param string $name The name of the Chunk
	 * @param array $properties The properties for the Chunk
	 *
	 * @return string The processed content of the Chunk
	 */
	public function getChunk($name, array $properties = array()) {
		$chunk = null;
		if (!isset($this->chunks[$name])) {
			$chunk = $this->modx->getObject('modChunk', array('name' => $name), true);
			if (empty($chunk)) {
				$chunk = $this->_getTplChunk($name, $this->config['chunkSuffix']);
				if ($chunk == false) {
					return false;
				}
			}
			$this->chunks[$name] = $chunk->getContent();
		}
		else {
			$o = $this->chunks[$name];
			$chunk = $this->modx->newObject('modChunk');
			$chunk->setContent($o);
		}
		$chunk->setCacheable(false);

		return $chunk->process($properties);
	}


	/**
	 * Returns a modChunk object from a template file.
	 *
	 * @access private
	 *
	 * @param string $name The name of the Chunk. Will parse to name.chunk.tpl by default.
	 * @param string $suffix The suffix to add to the chunk filename.
	 *
	 * @return modChunk/boolean Returns the modChunk object if found, otherwise
	 * false.
	 */
	private function _getTplChunk($name, $suffix = '.chunk.tpl') {
		$chunk = false;
		$f = $this->config['chunksPath'] . strtolower($name) . $suffix;
		if (file_exists($f)) {
			$o = file_get_contents($f);
			$chunk = $this->modx->newObject('modChunk');
			$chunk->set('name', $name);
			$chunk->setContent($o);
		}

		return $chunk;
	}
	
	public function dateFormat(array $data, $get) {
		$dateArr = explode('.', $data['date']);
		$data['date'] = $dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0];
		if ($get == 'end') {
		    $output = $data['date'].' '.$data['end'].':00';
		} else {
		    $output = $data['date'].' '.$data['begin'].':00';
		}
		return $output;
	}
	
	public function attend($event_id) {
	    $partisipData = array('uid' => $this->modx->user->id, 'event' => $event_id);
		if ($partisip = $this->modx->getObject('zsParticipant', $partisipData)) {
		    $partisip->remove();
		} else {
		    $partisip = $this->modx->newObject('zsParticipant', $partisipData);
		    $partisip->save();
		}
	}

}
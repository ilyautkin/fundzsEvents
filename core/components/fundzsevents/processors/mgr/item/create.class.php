<?php
/**
 * Create an Item
 */
class zsEventCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'zsEvent';
	public $classKey = 'zsEvent';
	public $languageTopics = array('fundzsevents');


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$required = array('name','city','description');
		foreach ($required as $tmp) {
			if (!$this->getProperty($tmp)) {
				$this->addFieldError($tmp, $this->modx->lexicon('field_required'));
			}
		}

		if ($this->hasErrors()) {
			return false;
		}

		if (!$this->getProperty('owner')) {
			$this->setProperty('owner', $this->modx->user->id);
		}
		if (!$this->getProperty('begin')) {
			$this->setProperty('begin', time());
		}
		return !$this->hasErrors();
	}

}

return 'zsEventCreateProcessor';
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
		/*$alreadyExists = $this->modx->getObject('fundzsEventsItem', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('fundzsevents_item_err_ae'));
		}*/

		return !$this->hasErrors();
	}

}

return 'zsEventCreateProcessor';
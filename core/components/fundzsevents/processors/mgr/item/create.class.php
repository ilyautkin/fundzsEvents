<?php
/**
 * Create an Item
 */
class fundzsEventsItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'fundzsEventsItem';
	public $classKey = 'fundzsEventsItem';
	public $languageTopics = array('fundzsevents');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('fundzsEventsItem', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('fundzsevents_item_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'fundzsEventsItemCreateProcessor';
<?php
/**
 * Remove an Items
 */
class fundzsEventsItemsRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'fundzsEventsItem';
	public $classKey = 'fundzsEventsItem';
	public $languageTopics = array('fundzsevents');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'fundzsEventsItemsRemoveProcessor';
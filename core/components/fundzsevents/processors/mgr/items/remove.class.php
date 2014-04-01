<?php
/**
 * Remove an Items
 */
class zsEventMultiRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'zsEvent';
	public $classKey = 'zsEvent';
	public $languageTopics = array('fundzsevents');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'zsEventMultiRemoveProcessor';
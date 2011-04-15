<?php
class Codem_DataObjectManager extends DataObjectManager {
	public function allowExport() {
		parent::setPermissions(array_merge(parent::getPermissions(), array('export')));
	}
}
?>
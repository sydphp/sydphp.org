<?php
/**
 * Field additions for general usage
 * @note to use these fields, you should specify Codem_MySQLDatabase as the driver
 */
class LatLongField extends Decimal {

	protected $value = NULL;
	
	public function __construct($name, $wholeSize , $decimalSize) {
		parent::__construct($name, $wholeSize, $decimalSize, NULL);
	}
	
	function hasValue() {
		return TRUE;
	}
	
	function requireField() {
		$parts=Array(
			'datatype'=>'decimal',
			'precision'=>"{$this->wholeSize},{$this->decimalSize}",
			'default'=> NULL,
			'arrayValue'=>$this->arrayValue
		);
		$values=Array(
			'type'=>'decimal',
			'parts'=>$parts
		);
		DB::requireField($this->tableName, $this->name, $values);
	}
	
	function saveInto($dataObject) {
		$fieldName = $this->name;
		if(is_null($this->value)){
			$dataObject->$fieldName = NULL;
		} else {
			parent::saveInto($dataObject);
		}
	}
	
	public function nullValue() {
		return NULL;
	}

	/**
	 * Return an encoding of the given value suitable for inclusion in a SQL statement.
	 * If necessary, this should include quotes.
	 */
	function prepValueForDB($value) {
		if(is_null($value)) {
			return NULL;
		} else {
			return parent::prepValueForDB($value);
		}
	}
}

class LatitudeField extends LatLongField {
	
	public function __construct($name, $wholeSize = 8, $decimalSize = 6) {
		parent::__construct($name, $wholeSize, $decimalSize);
	}
}

class LongitudeField extends LatLongField {
	
	public function __construct($name, $wholeSize = 9, $decimalSize = 6) {
		parent::__construct($name, $wholeSize, $decimalSize);
	}
}
?>
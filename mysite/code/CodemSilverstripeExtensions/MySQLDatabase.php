<?php
class Codem_MySQLDatabase extends MySQLDatabase {
	/**
	 * Return a decimal type-formatted string
	 * @note overrides parent decimal() to allow DEFAULT NULL
	 * 
	 * @param array $values Contains a tokenised list of info about this data type
	 * @return string
	 */
	public function decimal($values){
		//For reference, this is what typically gets passed to this function:
		//$parts=Array('datatype'=>'decimal', 'precision'=>"$this->wholeSize,$this->decimalSize");
		//DB::requireField($this->tableName, $this->name, "decimal($this->wholeSize,$this->decimalSize)");

		// Avoid empty strings being put in the db
		if($values['precision'] == '') {
			$precision = 1;
		} else {
			$precision = $values['precision'];
		}

		$defaultValue = '';
		if(is_null($values['default'])) {
			$defaultValue = ' default null';
		} else if(isset($values['default']) && is_numeric($values['default'])) {
			$defaultValue = ' not null default ' . $values['default'];
		}

		return 'decimal(' . $precision . ') ' . $defaultValue;
	}
}
?>
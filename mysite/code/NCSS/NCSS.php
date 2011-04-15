<?php
/**
 * @package NCSS
 * @note provides a simple mini framework for CSS shortcuts
 * @note all methods in this class can be called statically
 * @since 0.1
 * @note debug test
 */
class NCSS {
	protected $options = array();
	protected $handler;
	protected static $pielocation;
	protected $has_pied = FALSE;
	
	public function __construct($header = TRUE, $pie = "") {
		if($header) {
			header("Content-Type: text/css");
		}
		
		self::$pielocation = rtrim($pie, "/") . "/NCSS/PIE/PIE.htc";
	}
	
	public function PIE()  {
		return self::$pielocation;
	}
	
	public function Load($handler, $options) {
		try {
			if($handler) {
				//attempt to load the handler library
				$class = "NCSS_{$handler}";
				if(!class_exists($class)) {
					$path = dirname(__FILE__) . '/NCSS/' . $handler . '.php';
					if(is_readable($path)) {
						require($path);
					}
					if(!class_exists($class)) {
						throw new Exception('Handler ' . $handler . ' does not exist');
					}
				}
				$lib = new $class;
				$lib->options = array_merge($lib->options, $options);
				return $lib;
			}
		} catch (Exception $e) {
			return $this;
		}
	}
	
	final public function Render() {
		return "/* failed to load handler */\n";
	}
	
	final public function Reset() {
		$this->has_pied = FALSE;
		return $this;
	}
	public function __call($method, $args) {
		if(isset($args[0])) {
			$lib = $this->Load($method, $args[0]);
			$lib->Render();
			if(!$this->has_pied) {
				$lib->MakePie();
			}
			if($lib->HasPied()) {
				//so as to not duplicate the behaviour rule
				$this->has_pied = TRUE;
			}
		}
		return $this;//chainable
	}
}

//CSS handler parent, all handlers need to extend this parent
class NCSSHandler {
	public $options = array();
	private $has_pied = FALSE;
	protected $needs_pie = FALSE;
	
	public function __construct() {}
	
	final public function MakePie() {
		if($this->NeedsPie() && !$this->HasPied()) {
			$this->has_pied = TRUE;
			print "behavior: url(" . NCSS::PIE() . ");\n";
		}
	}
	
	final public function HasPied() {
		return $this->has_pied;
	}
	
	final protected function NeedsPie() {
		return $this->needs_pie;
	}
	
	protected function Render() {
		print "/* failed to load renderer */\n";
	}
}
?>

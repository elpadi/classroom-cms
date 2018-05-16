<?php
namespace School;

class Students extends \ArrayIterator {

	const NAMES = <<<'EOT'
["Blake Arriola", "Nicole Campbell", "John Cowie", "Jose Diaz", "Michael Engman", "Isaiah Frink", "Lerena Holloway", "Erika Hosoda", "Bubacarr Jammeh", "Din Karnitskiy", "Fahad Khan", "Daniel Lee", "John Macri", "Kyle Martin", "Matthew Megenhardt", "Alfredo Natal", "Kenneth Ofosu", "Elvin Perez", "Gabriel Rodriguez", "Byung Song", "Andrew Thompson"]
EOT;

	final public function __construct() {
		parent::__construct(array_map(function($name) {
			return new Student($name);
		}, json_decode(self::NAMES)));
	}

}

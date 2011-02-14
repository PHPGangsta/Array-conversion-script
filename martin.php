<?php
class compressarray {
	private $array = NULL;
	static function init(array $array) {
		return new self ( $array );
	}
	public function getArray() {
		return $this->array;
	}
	private function setArray($array) {
		$this->array = $array;
	}
	public function __construct(array $array) {
		$this->setArray ( $array );
	}
	public function make() {
		$methode = 'packArray';
		foreach ( $this->getArray () as $item ) {
			if (is_string ( $item )) {
				$methode = 'unpackArray';
				break;
			}
		}
		$this->$methode ();
		return $this;
	}
	private function packArray() {
		$a = array ();
		foreach ( $this->getArray () as $key => $item ) {
			$keyBefore = count ( $a ) - 1;
			if ($keyBefore == - 1) {
				$keyBefore = 0;
			}
			if (isset ( $a [$keyBefore] ) && is_numeric ( $a [$keyBefore] ) && ($a [$keyBefore] - 1 == $item || $a [$keyBefore] == $item - 1)) {
				$a [$keyBefore] = ( string ) $a [$keyBefore] . "-" . ( string ) $item;
				continue;
			} elseif (isset ( $a [$keyBefore] ) && is_string ( $a [$keyBefore] )) {
				list ( $start, $end ) = explode ( '-', $a [$keyBefore] );
				if ($end - 1 == $item || $end == $item - 1) {
					$a [$keyBefore] = ( string ) $start . '-' . ( string ) $item;
					continue;
				}
			}
			$a [] = $item;
		}
		$this->setArray ( $a );
	}
	private function unpackArray() {
		$a = array ();
		foreach ( $this->getArray () as $key => $item ) {
			if (is_string ( $item )) {
				list ( $start, $end ) = explode ( '-', $item );
				array_splice ( $a, count ( $a ), 0, range ( $start, $end ) );
			} else {
				$a [] = $item;
			}
		}
		$this->setArray ( $a );
	}
}
<?php
/**
 * This file is part of Rudolf.
 * 
 * Generate random and put it on database
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Install
 * @version 0.1
 */

namespace Rudolf\Install;

class DataGenerator {

	public $_tables;
	private $_fields;

	public $random;

	public function __construct(PDO $pdo, $_tables, $_fields, $random) {
		$this->pdo = $pdo;
		$this->_tables = $_tables;
		$this->_fields = $_fields;
		$this->random = $random;
	}
	
	public function addRandom($number, $table) {

		foreach ($this->_fields[$table] as $key => $value) {
			$aFields[] = $key;
			$a_fields[] = ':'. $key;
		}

		$fields = implode(', ', $aFields);
		$_fields = implode(', ', $a_fields);

		$stmt = $this->pdo->prepare('INSERT INTO '. $table .' ('. $fields .') VALUES('. $_fields .')');
		
		$i = $count = 0;
		while($number--) {
			foreach ($this->_fields[$table] as $key => $value) {

				if('id' === $key) continue;
				elseif('category_id' === $key or 'parent_id' === $key) $v = 0;
				elseif('tinyint' === $value[0]) $v = $this->randomTinyint();
				elseif('varchar' === $value[0]) $v = $this->randomVarchar($value[1]);
				elseif('text' === $value[0]) $v = $this->randomVarchar();
				elseif('int' === $value[0] and '11' == $value[1]) $v = rand(1, 2);
				elseif('int' === $value[0] and '10' == $value[1]) $v = rand(1, 255);
				elseif('datetime' === $value[0]) $v = $this->randomDatatime();

				if('slug' === $key) $v = $this->createSlug($v);
				if('thumb' === $key) $v = 'https://api.fnkr.net/testimg/2200x1500/222/FFF/?text='.$i++;

				$stmt->bindValue(':'. $key, $v);
			}
			$count += $stmt->execute();
		}

		return $count;		
	}

	private function randomTinyint() {
		return rand(0, 1);
	}

	private function createSlug($string) {
		return $this->prepareURL($string);
	}

	public function prepareURL($sText) {
		$sText = $this->clearDiacritics($sText);
		$sText = strtolower($sText);
		$sText = str_replace(' ', '-', $sText);
		$sText = preg_replace('/[^0-9a-z\-]+/', '', $sText);
		$sText = preg_replace('/[\-]+/', '-', $sText);
		$sText = trim($sText, '-');

		return $sText;
	}

	public function clearDiacritics($sText)	{
		$aReplacePL = array(
			'ą' => 'a', 'ę' => 'e', 'ś' => 's', 'ć' => 'c',
			'ó' => 'o', 'ń' => 'n', 'ż' => 'z', 'ź' => 'z', 'ł' => 'l',
			'Ą' => 'A', 'Ę' => 'E', 'Ś' => 'S', 'Ć' => 'C',
			'Ó' => 'O', 'Ń' => 'N', 'Ż' => 'Z', 'Ź' => 'Z', 'Ł' => 'L'
		);

		return str_replace(array_keys($aReplacePL), array_values($aReplacePL), $sText);
	}

	private function randomVarchar($length = false) {
		if(!$length) {
			return $this->random;
		}

		$string = mb_substr($this->random, rand(0, strlen($this->random)) - strlen($this->random), $length);
		return trim($string, ',. :');
	}

	private function randomDatatime() {
		$int = mt_rand(100000000, 1450000000);

		return date("Y-m-d H:i:s", $int);
	}
}

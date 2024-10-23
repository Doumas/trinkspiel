<?php
// Klasse Validator: Return Objektdaten nach Säuberung, Sortierung der Input Feldern.
class Validator
{
	// Für Error Handling & Post Handling
	public $errors = [],
	$register = array( "inlineRadioOptions"=>"","username"=>"", "email"=>"", "password"=>"", "passwordRequire"=>"", "agb"=>"", "land"=>""),
	$login = array( "email"=>"", "password"=>""),
	$userUpdate = array( "username"=>"", "email"=>""),
	$newGame = array(
		'title' => '',
		'question_0' => '',
		'question_1' => '',
		'question_2' => '',
		'question_3' => '',
		'question_4' => '',
		'question_5' => '',
		'question_6' => '',
		'question_7' => '',
		'question_8' => '',
		'question_9' => ''
	),
	// Rules
	$words = '/^[a-zA-Z 0-9  -.,]*$/',
	$sentence = '/[A-Za-z0-9\.,;:!?()"\'%\-]+/',
	$data;
	// Säuberung von $_POST, übergebe an Post Handling
	public function __construct(string $string = null)
	{
		if($string == 'register' || $string == 'login' || $string == 'userUpdate' || $string == 'newGame'){
			// Säuberung mit HelferKlasse
			$post = helper::cleanArray($_POST);
			foreach($this->$string as $name => $value) {
				if(!empty($post[$name]))
				$this->data[$name] = $post[$name];
				else
				// Error Meldung
				$this->errors[$name] = ' Bitte Feld ausfüllen';
				} 
			}
		}
		// Validieren mit Rules
		public function setValidate() 
		{
			var_dump($this->errors);
		foreach($this->data as $name => $value) {	
			switch($name) {
				case 'username':
					$this->countStrlen($name, $value, 3, 15);
					$this->pregMatch($name, $value, $this->words);
					break;
				case 'title':
					$this->countStrlen($name, $value, 3, 40);
					$this->pregMatch($name, $value, $this->sentence);
					break;
				case 'question^*':
					$this->countStrlen($name, $value, 10, 89);
					$this->pregMatch($name, $value, $this->sentence);
					break;	
				case 'email':
					if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
						$this->errors[$name] = '*Bitte geben Sie eine Email-Adresse an'; 	
					}
					break;
				case 'password':
					$this->countStrlen($name, $value, 6, 12);
					$this->pregMatch($name, $value, $this->sentence);
					$this->password = $value;
					$this->data['password'] = password_hash($value, PASSWORD_DEFAULT);
					break;
				case 'userId':
					$this->countStrlen($name, $value, 10, 10);
					break;
				case 'btnValue':
						if(!$value == 'positiv' ||  !$value == 'negativ'){	
						$this->errors[$name] = '*Die Frage steht nicht zur Verfügung'; 
						} 
					break;
				case 'land':
					if(!$value === 'Deutschland'|| !$value === 'England' || !$value === 'Österreich')
					$this->errors[$name] = '*Bitte wählen Sie eins der hinterlegten Feldern aus';
					break;
				case 'passwordRequire':
					if($value !== $this->password){
						$this->errors[$name] = '*Ihre Passwörter stimmen nicht überein'; 
					}
					break;
				case 'inlineRadioOptions':
					if(!$value === 'male' || !$value === 'female')
					$this->errors[$name] = '*Bitte wählen Sie ihr Geschlecht aus'; 
					break;
				case 'inlineRadioOptionsQuestion':
					if(!$value === 'private' || !$value === 'public')
					$this->errors[$name] = '*Bitte geben Sie Öffentlichkeitsrechte an'; 
					break;
				case 'agb':
					if(!$value === 'accept')
						$this->errors[$name] = '*Bitte akzeptieren Sie die Agbs'; 
					break;
			}
		}
		// Bei Fehlmeldung
		if(!empty($this->errors)){
			// übergabe an Helferklasse
			helper::flash($this->errors, 'error');
			return false;
			}
			else return true;
	}
	public function getData()
	{
		// Bei Fehlmeldung
		if(!empty($this->errors)){
			helper::flash($this->errors, 'error');
			return false;
			}
			else{
				// Wenn keine Fehlermeldung, return saubere Data
				return $this->data;
			}
	}
	// Methode für Zeichenlänge, über Rules definiert
	private function countStrlen(string $name, string $value, int $min, int $max)
	{
		if(strlen($value) < $min || strlen($value) > $max)
		$this->errors[$name] = 'Bitte zwischen '.$min.' - '.$max.' Buchstaben eintragen.'; 
	}
	// Methode für Zeichennutzung, über Rules definiert
	private function pregMatch(string $name, string $value, string $string){
		if(!preg_match($string, $value)){
		$this->errors[$name] = 'Es wurde nicht erlaubte Zeichen verwendet!'; 
		}
	}
}
			
		
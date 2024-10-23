<?php
// Error Handling
#error_reporting( E_ALL );
#ini_set( 'display_errors', '1' );
// MVC Pattern Methode
// Klasse Core: Kreiert und teilt die URL auf als Controller, Method, Params
// Bsp: www.App.com/home/index?name=John' === /controller/method/params
class Core
{
	// Vordefiniert für den Controller- & Methodaufruf 
	private $controller = 'homeController',
	$method = 'index', 
	$params = array('Message' => ''),
	// Zur Erfassung der Url
	$url,
	$current_url;
	public function __construct() {
		// Wenn URL gesetzt, Funktionsaufruf URL in Array
		isset($_GET['url']) ? $this->explodeUrl() : false;
		// Definiere Controller falls /controller/ in URL gesetzt, ansonsten vordefiniert als HomeController
		if(isset($this->current_url[0])) {
			file_exists( APPROOT.'/backend/controllers/' . $this->current_url[0] . 'Controller.php') ? $this->controller = $this->current_url[0].'Controller': '';
				unset($this->current_url[0]); 
			}
		// Hinzuziehung des Controller
		require_once APPROOT."/backend/controllers/{$this->controller}.php";
		// Initiere Controller Klasse
		$this->controller = new $this->controller;
		// Definiere Method falls controller/method/ in URL existiert, ansonsten vordefiniert als index
		if(isset($this->current_url[1])) {
			if(method_exists($this->controller, $this->current_url[1])) {
				$this->method = $this->current_url[1];
				unset($this->current_url[1]);
			}
		}
		// Definiere Params falls /controller/method/params in URL existiert, anonsten leerer Array
		$this->params = $this->current_url ? array_values($this->current_url) : [];
		// Aufruf mit Array und Params
		#var_dump($this->controller);
		call_user_func_array([$this->controller, $this->method], $this->params);
	}
	// Erfassung der Url, Säuberung und Aufteilung 
	protected function explodeUrl(){
	// URL erfassen, säubern & filtern, 
	$this->url = parse_url(filter_var(rtrim(strtolower($_GET['url']), ''), FILTER_SANITIZE_URL));
	// Als Array aufteilen
	$this->current_url = explode("/", $this->url['path']);
	$this->current_url = helper::cleanArray($this->current_url);
	}
}
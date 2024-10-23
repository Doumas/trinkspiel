<?php 

// Klasse HomeController: Aufgerufen durch Core.
class homeController extends Controller{
    // Params für Errorhandlung
    public $errors = [];
    // Initialisiere Methode Model aus der Schwesterklasse Controller
    public function __construct()
    {
     // Hinzuziehung des Model
     $this->questionModel = $this->model("questionModel");
    }   
    // Initialisierung der Startseite
    public function index( $data = null)
    {
    // r
    if(is_array(($data)))
    $data = helper::cleanArray($data);
    if(is_string($data))
    $data = array(helper::cleanString($data));
    if($data !== true)
        unset($data);
    
    #Wenn User bereits angemeldet ist, Weiterleitung zum UserController
    if(isset($_SESSION['userid']))
    Redirect::to('user');
    else
        // Wenn das Model erfolgreich mit der Datenbank kommuniziert, Get Daten zu $data
        if($this->questionModel->setTrinkspiel('public', 'random', 10) !== true)
        $errors['Datenbank'] = 'Die Datenbankverbindung ist Offline!';
        else{
            $post = $this->questionModel->getTrinkspiel();
            foreach($post as $key => $value){
                $data[$key] = $value;
            }
            // Fall Errors in der Helperklasse existieren, Error im array Data aufnehmen und an View
            if(helper::getErrors() !== false)
            foreach (helper::$error as $key => $value) {
                $data[$key] = $value;
            }
            // Aufrufung Schwesternmethode view(), übergebe $data   
            $this->view("home", $data);
        }
    }
    // Über die Klasse Core, aufruf durch URL */home/register
    public function register()
    {
        // Validator aufruf, Säubern der Register Form Data
        if(!empty($_POST)){
              $validate = new Validator('register');
              if($validate -> setValidate() !== false){
              $valide = $validate -> getData(); 
              // Erstelle Paramas 
                    $data = [
                        'land' => $valide['land'],
                        'gender' => $valide['inlineRadioOptions'],
                        'username' => $valide['username'],
                        'email' => $valide['email'],
                        'passwort' => $valide['password'],
                        'agb' => $valide['agb']
                    ];
                    // userModel aufruf, nutze methode signUp
                    $this->userModel = $this->model("userModel");
                        if($this->userModel->signUp($data) !== false){
                            // Bei Erfolg geben wir nur die notwendigen Daten weiter.
                            unset($data);
                            $data = [
                                'message' => 'Wilkommen',
                                'username' => $valide['username'],
                            ];
                            // Weiterleitung an User
                            $this->userModel->startSession();
                            Redirect::to('user', $data['username']);
                            } 
                            // Ansonsten zurück zur index
                            else $this->index();
                        }
                        else $this->index();
                    }else $this->index();
                }
               }
          
        
     
?>
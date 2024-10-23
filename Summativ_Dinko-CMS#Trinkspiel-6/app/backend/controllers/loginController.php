<?php 
// Error Handling
#error_reporting( E_ALL );
#ini_set( 'display_errors', '1' );
// Klasse HomeController: Aufgerufen durch Core.
class loginController extends Controller{
    // Params für Post
    
    // Initialisiere Methode Model aus der Schwesterklasse Controller
    public function __construct()
    {
     // Hinzuziehung des Model
     $this->userModel = $this->model("userModel");
    }   
    // Initialisierung der Startseite
    public function index( $data = null)
    {
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
      #  $post = $this->questionModel->getTrinkspiel('public', 10);
      if(isset($data))
      $data = helper::cleanArray($data);
      else 
      $data = [
          'message' => 'Login'
      ];
      // Wenn Errors existieren, aufnahme ins Array für die View
      if(helper::getErrors() !== false)
            foreach (helper::$error as $key => $value) {
                $data[$key] = $value;
            }
            $this->view("login", $data);
            // Aufrufung Schwesternmethode view(), übergebe $data (Gesammelt aus Get methoden des Model)  
            
        }
        public function signIn()
                {
                    if(!empty($_POST)){
                      $validate = new Validator('login');
                      if($validate -> setValidate() !== false){
                          $valide = $validate -> getData();
                          $data = [
                            'email' => $valide['email'],
                            'passwort' => $valide['password'],
                            ];
                            $this->userModel = $this->model("userModel");
                            if($this->userModel->findUser('byVerify', $data) !== false){
                                $this->userModel->startSession();
                                $data = [
                                    'username' => $data['username'],
                                ];
                                Redirect::to('user');
                            }
                            else $this->index(array('message' => 'Fehler'));
                        }else
                        // Aufrufung Schwesternmethode view(), übergebe $data (Gesammelt aus Get methoden des Model)  
                        $this->index(array('message' => 'Es ist ein Fehler aufgetreten'));
                    }
                else{
                }
            }
        }
?>
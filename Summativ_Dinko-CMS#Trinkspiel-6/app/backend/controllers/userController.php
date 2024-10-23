<?php
// Userklasse, Ruf über die Schwesterklasse View und Modem auf
class UserController extends Controller
{
    // Params Errorhandling
    public $errors = [];
    // Einbindung der Model über Schwesternklasse Controller.
    public function __construct()
    {
        $this->userModel = $this->model('userModel');
        $this->questionModel = $this->model('questionModel');
    }
    #Rewrite URL
    public function index($data = null)
    {
        //  Cleaning Data
        if (is_array(($data)))
            $data = helper::cleanArray($data);
        if (is_string($data))
            $data = helper::cleanString($data);
        if (empty($_SESSION['userid']))
            $this->view('login', array('message' => 'Bitte Anmelden'));
        else
            // Wenn das Model erfolgreich mit der Datenbank kommuniziert, Get Daten zu $data
            if ($this->questionModel->setGames() !== true) {
                $this->errors['Datenbank'] = 'Die Datenbankverbindung ist Offline!';
            } else {
                // Userdaten über die Session auslesen, rückgabe des Username für Title
                if ($this->userModel->findUser('bySession') !== false) {
                    $user = $this->userModel->getUser('username');
                    $post = $this->questionModel->getGames();

                    $data = [
                        'user' => $user,
                        'questions' => $post['questions'],
                        'counter' => $post['counter']
                    ];

                    // Aufrufung Schwesternmethode view(), übergebe $data (Gesammelt aus Get methoden des Model)  
                    $this->view("user", $data);
                } else
                    $this->view("login", array('messageError' => 'Sie sind nicht Angemeldet'));
            }
    }
    public function register()
    {
        // Validator aufruf, Säubern der Register Form Data
        if (!empty($_POST)) {
            $validate = new Validator('register');
            if ($validate->setValidate() !== false) {
                $valide = $validate->getData();
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
                if ($this->userModel->signUp($data) !== false) {
                    // Bei Erfolg geben wir nur die notwendigen Daten weiter.
                    unset($data);
                    $data = [
                        'message' => 'Wilkommen',
                        'username' => $valide['username'],
                    ];
                    // Weiterleitung an User
                    $this->userModel->startSession();
                    $this->index($data);
                }
                // Ansonsten zurück zur index
                else $this->index($data);
            } else {
                $data = helper::getErrors();
                Redirect::to('home', $data);
            }
        }
    }
    public function newGame()
    {
        if (!empty($_POST)) {
            $validate = new Validator('newGame');
            if ($validate->setValidate() !== false) {
                $valide = $validate->getData();
                // Erstelle Paramas 
                $data = [
                    'title' => $valide['title'],
                    'question_0' => $valide['question_0'],
                    'question_1' => $valide['question_1'],
                    'question_2' => $valide['question_2'],
                    'question_3' => $valide['question_3'],
                    'question_4' => $valide['question_4'],
                    'question_5' => $valide['question_5'],
                    'question_6' => $valide['question_6'],
                    'question_7' => $valide['question_7'],
                    'question_8' => $valide['question_8'],
                    'question_9' => $valide['question_9'],
                ];
                // userModel aufruf, nutze methode newGame
                if ($this->questionModel->newGame($data) !== false) {
                    // Bei Erfolg Weiterleitung an User Page
                    $data = [
                        'message' => 'Spiel wurde gespeichert'
                    ];
                    $this->index($data);
                } else {
                    $data['message'] = 'Bitte korrigieren';
                    $this->spiel($data);
                }
                // Ansonsten zurück zur index
            } else {
                $data['message'] = 'Bitte korrigieren';

                $this->spiel($data);
            }
        }
        else $this->index();
    }
    // Methode Spiel, Aufruf der Spiel View. 
    public function spiel($data = null)
    {
        if (is_array(($data)))
            $data = helper::cleanArray($data);
        if (is_string($data))
            $data = array(helper::cleanString($data));
        if ($data !== true)
            unset($data);
        if (empty($_SESSION['userid']))
            Redirect::to('login');
        else
            // Wenn das Model erfolgreich mit der Datenbank kommuniziert, Get Daten zu $data
            if ($this->questionModel->setTrinkspiel('public', 'all') !== true) {
                $this->errors['Datenbank'] = 'Die Datenbankverbindung ist Offline!';
            } else {
                $post = $this->questionModel->getTrinkspiel();

                $data = [
                    'questions' => $post['questions'],
                    'statistic' => $post['statistic'],
                    'counter' => $post['counter'],
                    'message' => 'Spielmacher'
                ];
                if (helper::getErrors() !== false)
                    foreach (helper::$error as $key => $value) {
                        $data[$key] = $value;
                    }
                // Aufrufung Schwesternmethode view(), übergebe $data (Gesammelt aus Get methoden des Model)  
                $this->view("spiel", $data);
            }
    }
    // Methode Benutzer, get Userdata für Template/Benutzer.php
    public function benutzer()
    {
        //Check User über Session, wenn nicht zurück zum Login
        if (!isset($_SESSION['userid'])) {
            Redirect::to('login', array('message' => 'Bitte Anmelden'));
        } else {
            if ($this->userModel->findUser('bySession') !== false) {
                $data = [
                    'username',
                    'email'
                ];
                $user = $this->userModel->getUser($data);
                $this->view("benutzer", $user);
            }
            Redirect::to('login', array('message' => 'Bitte Anmelden'));
        }
    }
    // Methode questions, get all questions für template/questions
    public function questions()
    {
        //Check User über Session, wenn nicht zurück zum Login
        if (empty($_SESSION['userid']))
            Redirect::to('login', array('message' => 'Bitte Angemeldet'));
        else {
            // Wenn das Model erfolgreich mit der Datenbank kommuniziert, Get Daten zu $data
            if ($this->questionModel->setTrinkspiel('public', 'all') !== true) {
                $this->errors['Datenbank'] = 'Die Datenbankverbindung ist Offline!';
            } else {
                // Bereite Array vor für die Übergabe aller Fragen an View.
                $post = $this->questionModel->getTrinkspiel();
                $data = [
                    'questions' => $post['questions'],
                    'statistic' => $post['statistic'],
                    'counter' => $post['counter']
                ];
                // ÜBbergebe an View.
                $this->view("questions", $data);
            }
        }
    }
    // Updata User
    public function update()
    {
        // Session check
        if (empty($_SESSION['userid']))
            Redirect::to('login', array('message' => 'Login'));
        else {
            if (!empty($_POST)) {
                // cleaning Data
                $validate = new Validator('userUpdate');
                if ($validate->setValidate() !== false) {
                    $valide = $validate->getData();
                    $data = [
                        'username' => $valide['username'],
                        'email' => $valide['email'],
                    ];
                    //find User by $_SESSION['userid]
                    if ($this->userModel->findUser('bySession') !== false)
                        //Update User
                        if ($this->userModel->updateUser($data) !== false) {
                            $data['message'] = 'Daten aktualisiert';
                            $this->view("benutzer", $data);
                        } // Bei Errors, Weiterleitung an Schwestern Method View
                        else $this->view("benutzer", helper::getErrors());
                    else $this->view("benutzer", helper::getErrors());
                } else $this->view("benutzer", helper::getErrors());
                # code...
            }
        }
    }
    // User löschen
    public function accountDelete()
    {
        //  Check User über SESSION
        if (!empty($_SESSION['userid'])) {
            if ($this->userModel->deleteUser() !== false) {
                session_destroy();
                // Lehrtipp aus SAE Unterricht, leerer Array entfernt alle SESSIONS
                $_SESSION = array();
                Redirect::to('home', array('message' => 'Ihr Account wurde Gelöscht'));
                // Wenn kein User Angemeldet
            } else  Redirect::to('home', array('message' => 'Lust auf ein Trinkspiel?'));
        }
    }

    // Logout
    public function logout()
    {
        //  Check User über SESSION
        if (!empty($_SESSION['userid'])) {
            session_destroy();
            // Lehrtipp aus SAE Unterricht, leerer Array entfernt alle SESSIONS
            $_SESSION = array();
            Redirect::to('home', array('messageError' => 'Sie wurden Abgemeldet'));
            // Wenn kein User Angemeldet
        } else  Redirect::to('home', array('message' => 'Wilkommen, Lust auf ein Spiel?'));
    }
}

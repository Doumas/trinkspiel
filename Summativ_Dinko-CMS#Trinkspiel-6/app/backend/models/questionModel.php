<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Finale Klasse questionModem:
// Wird verwendet für die Datenbank
class questionModel
{
    // Für den Empfang der Datenbankelemente für die Home View
    private $question,
    $db,
    $params = array('publicQuestions' => '', 'randomQuestions' => ''),
    $questions,
    $randomQuestions,
    $count,
    $statistic,
    $errors,
    $success;

    #Initialisere Database Klasse
    public function __construct()
    {
        $this->db = new Database();
    }
    #Erstelle Parameter zum Spiel
    public function setTrinkspiel(string $string, string $type, int $int = null)
    {
        if ($string === 'public' || $string === 'private') {
            switch ($type) {
                case 'random':
                    if ($this->setQuestions($string, $type, $int) !== false && $this->setStatistic() !== false) {
                        if ($this->getRandom($int) !== false) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    break;
                case 'all':
                    if ($this->setQuestions($string, $type) !== false && $this->setStatistic() !== false) {
                        return true;
                    } else {
                        return false;
                    }

                    break;
                case 'all':
                    if ($this->setQuestions($string, $type) !== false && $this->setStatistic() !== false) {
                        return true;
                    } else {
                        return false;
                    }

                    break;
            }
        }
    }
    #Return Parameter zum Spiel
    public function getTrinkspiel()
    {
        return array(
            'questions' => $this->questions,
            'statistic' => $this->statistic,
            'counter' => count($this->questions),
        );
    }

    #Aufruf von Database Methode, übergabe des Sql String, return an Controller.
    private function setQuestions(string $string, string $type, int $int = null)
    {
        if ($string === 'public' || $string === 'private' && $type === 'random' || $type === 'all') {
            $sql = 'SELECT question, id FROM question WHERE visibility = :visibility';
            if ($this->db->setRows($sql, array('visibility' => $string), PDO::FETCH_ASSOC) !== false) {
                $this->questions = $this->db->getRows();
                return true;
            } else {
                return false;
            }

        }
    }
    #überprüfe ob Games vorhanden sind.
    public function setGames()
    {
        if ($this->setGame() !== false) {
            return true;
        } else {
            return false;
        }

    }
    public function getGames()
    {
        return array(
            'questions' => $this->questions,
            'counter' => count($this->questions),
        );
    }

    #Aufruf von Database Methode, übergabe des Sql String, return an Controller.
    private function setGame()
    {
        $data['userId'] = helper::cleanString($_SESSION['userid']);
        $sql = 'SELECT * FROM newGamePublic WHERE userId = :userId';
        if ($this->db->setRows($sql, $data, PDO::FETCH_ASSOC) !== false) {
            $this->questions = $this->db->getRows();
            return true;
        } else {
            return false;
        }

    }

    #Empfängt Daten, nutz random_int mit einer Int vorgabe, Daten Values werden zufällig ausgewählt.
    public function getRandom(int $int)
    {
        for ($i = 0; $i < $int; $i++) {
            $randomNumber = random_int(0, count($this->questions) - 1);
            $this->questions[$i] = $this->questions[$randomNumber];
        }
    }
    #Wenn aus der klasse Database Daten existieren, übergebe SQL String und Array
    public function setStatistic()
    {
        if (!empty($this->questions)) {
            $i = 0;
            $sql = 'SELECT positiv, negativ FROM statistic WHERE questionId = :questionId ';
            foreach ($this->questions as $key => $value) {
                if ($this->db->setRow($sql, array('questionId' => $value['id']), PDO::FETCH_ASSOC) !== false) {
                    $this->statistic[$i] = $this->db->getRow();
                    $i++;
                }
            }
            if (!empty($this->statistic)) {
                return true;
            }

        } else {
            return false;
        }

    }

    public function setQuestionss(string $string)
    {
        if ($string == 'public') {
            $sql = 'SELECT question, id FROM question WHERE visibility = :visibility';
            if ($this->db->setRows($sql, array('visibility' => $string), PDO::FETCH_ASSOC) !== false) {
                $this->questions = $this->db->getRows();
            } else {
                return false;
            }

        }
        if ($string == 'public') {
            if ($this->setRandomQuestion($this->data) !== false) {
                $this->params['randomQuestions'] = $this->randomQuestions;
            } else {
                return false;
            }

        }
    }

    #public function getStatistics(string $string){
    #SignIn User
    #    $i =0;
    #    if($string === 'random')
    #    foreach($this->params['randomQuestions'] as $key => $value){
    #        if($this->setRows('SELECT * FROM statistic WHERE questionId = :questionId', array('questionId' => $value['id'])) !== false){
    #        $this->data['statistic'][$i] = $this->getRows();
    #        }
    #    $i++;
    #  }
    #  return $this->data['statistic'];
    #}

    private function setRandomQuestion()
    {
        if (isset($this->data)) {
            $this->count = count($this->data) - 1;
            for ($i = 0; $i < 10; $i++) {
                $randomNumber = random_int(0, $this->count);
                $this->randomQuestions[$i] = $this->data[$randomNumber];
            }
            return true;
        } else {
            return false;
        }

    }
    #Write Support
    public function writeSupport($vote)
    {

        //Keine Fehler, wir können den Nutzer registrieren
        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare("SELECT * FROM statistic WHERE id = :id");
        $btnValue = $_POST['btnValue'];
        $questionId = $_POST['questionId'];
        $result = $statement->execute(array('id' => $questionId));
        $user = $statement->fetch();

        if ($user !== false) {
            $this->errors['question'] = 'Diese Frage wurde bereits gestellt<br>';
            return false;
        } else {
            $statement = $pdo->prepare('INSERT INTO `statistic`(`id`, ' . $vote . ') VALUES (:id, :vote)');
            $result = $statement->execute(array('id' => $questionId, $vote => $vote));

            if ($result) {

                $this->success = 'Bewertung wurde abgegeben';
                return true;
            } else {
                $this->errors['question'] = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                return false;
            }
        }
    }

    #SignUp User
    public function writeQuestion($array)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare("SELECT * FROM question WHERE question = :question");
        $result = $statement->execute(array('question' => $array['question']));
        $user = $statement->fetch();

        if ($user !== false) {
            $this->errors['question'] = 'Diese Frage wurde bereits gestellt<br>';
            return false;
        } else

        //Keine Fehler, wir können den Nutzer registrieren
        if (!$this->errors) {
            $id = $this->IdGenerator();

            $statement = $pdo->prepare('INSERT INTO `question`(`id`, `question`, `user_id`, `visibility`) VALUES (:id, :question, :user_id, :visibility)');
            $result = $statement->execute(array('id' => $id, 'question' => $array['question'], 'user_id' => $_SESSION['userid'], 'visibility' => $array['inlineRadioOptionsQuestion']));

            if ($result) {

                $this->success = 'Die Frage wurde erfolgreich Veröffentlicht';
                return true;
            } else {
                $this->errors['question'] = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                return false;
            }
        }
    }

    public function newGame($array)
    {
        $sql = "INSERT INTO newGamePublic (`userId`, `title`, `question_0`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`, `question_7`, `question_8`, `question_9`) VALUES (:userId, :title, :question_0, :question_1, :question_2, :question_3, :question_4, :question_5, :question_6, :question_7, :question_8, :question_9)";
        $array['userId'] = helper::cleanString($_SESSION['userid']);
        if ($this->db->insertRow($sql, $array) !== false) {
            return true;
        } else {
            return false;
        }

    }
    #SignIn User
    public function readQuestion()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare("SELECT * FROM question WHERE user_id = :user_id");
        $result = $statement->execute(array('user_id' => $_SESSION['userid']));
        $this->question = $statement->fetchAll();
        //Überprüfung des Passworts
        if ($this->question !== false) {

            return $this->question;
        } else {
            return false;
        }
    }

    public function setMyGame()
    {

        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare('SELECT * FROM newGame WHERE userId = :userId');
        $result = $statement->execute(array('userId' => $_SESSION['userid']));
        $this->question = $statement->fetch(PDO::FETCH_ASSOC);
        $i = 0;

        unset($this->question['userId']);
        //Überprüfung des Passworts
        if ($this->question !== false) {
            $i = 0;
            foreach ($this->question as $key => $value) {
                $statement = $pdo->prepare("SELECT id, question FROM question WHERE id= :id");
                $result = $statement->execute(array('id' => $value));
                $this->question[$i] = $statement->fetch(PDO::FETCH_ASSOC);

                $i++;
            }
            #Hier wird alles doppelt in die Datenbank gespeichert, dass ist meine Notlösung

            return $this->question;
        } else {
            $this->errors['start'] = 'Noch kein Spiel?';
            return false;
        }
    }
    public function getCountQuestions(string $string)
    {
        if ($string === 'all') {
            $this->count = count($this->data) - 1;
            return $this->count;
        }
    }
    public function getAllQuestion()
    {
        return $this->question;
    }

    #Find User
    public function GetUser()
    {

        $pdo = new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        $statement = $pdo->prepare("SELECT * FROM user WHERE userid = :userid");
        $result = $statement->execute(array('userid' => $_SESSION['userid']));
        $user = $statement->fetch();
        return $user['username'];
    }
    #Password Hash
    protected function IdGenerator()
    {
        $n = 5;
        $result = bin2hex(random_bytes($n));
        return $result;
    }
    #Password Re Hash
    private function PasswordReHash()
    {
    }
    #get a Success Message
    public function getSuccess()
    {
        return $this->success;
    }
    #get a Error Message
    public function getErrors()
    {
        return $this->errors;
    }
}

<?php
// UserModel, Klasse für die Datenbank tabel User. 
class UserModel
{
    // Error
    public $user;
    public $errors = [];
    public function __construct()
    {
        // Initialisiere Database
        $this->db = new Database;
    }
    // Methode zur Userfindung, params geben an ob über Session, Email oder herkömmlich mit Passwort  & Email
    public function findUser(string $string, array $data = null)
    {
        // Säuberung des Array
        if (isset($data))
            $data = helper::cleanArray($data);
        switch ($string) {
            // Session
            case 'bySession':
                if ($this->findBySession() !== false) {
                    $this->user = $this->db->getRow();
                    return true;
                } else return false;
                break;
                // Email & Passwort
            case 'byVerify':
                if ($this->findByEmail($data['email']) !== false) {
                    $this->user = $this->db->getRow();
                    if ($this->verfiyPassword($data['passwort']) !== false)
                        return true;
                    else return false;
                } else {
                    $this->errors['email'] = 'User ist nicht registriert';
                    helper::flash($this->errors, 'error');
                    return false;
                }
                break;
                // Nur Email
            case 'byEmail':
                if ($this->findByEmail($data['email']) !== false) {
                    $this->user = $this->db->getRow();
                    return true;
                } else return false;
                break;
        }
    }

    // User über Email finden
    private function findByEmail(string $email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        if ($this->db->setRow($sql, array('email' => $email)) !== false) {
            $this->user = $this->db->getRows();
            return true;
        } else return false;
    }
    // Registrierung eines neuen Users
    public function signUp(array $data)
    {
        // Nutze Data aus register methode, verifizere User
        $data = helper::cleanArray($data);
        // Method findUser, überprüfung ob emailadresse bereits vergeben ist
        if ($this->findUser('byEmail', $data) !== true) {
            // User wird registiert
            $string = 'INSERT INTO user (gender, land, username, email, passwort, agb) VALUES (:gender, :land, :username, :email, :passwort, :agb)';
            if ($this->db->insertRow($string, $data) !== false) {
                // Überprüfe ob User in der Datenbank ist
                if ($this->findUser('byEmail', $data) !== true) {
                    return true;
                } else false;
            } else {
                // Error bei Datenbank Problemen
                $this->errors['message'] =  'Datenbank Offline';
                // Helferklasse zur übergabe des errors
                helper::flash($this->errors, 'error');
                return false;
            }
        } else {
            $this->errors['email'] =  'Die E-Mail-Adresse wird bereits verwendet';
            helper::flash($this->errors, 'error');
            return false;
        }
    }
    // verifiziere user, passwort & reHash()
    public function verifyUser(array $data = null)
    {
        $data = helper::cleanArray($data);
        if ($this->findByEmail($data['email']) !== true) {
            if ($this->verfiyPassword($data['passwort'], $this->db->getRow()) !== false) {
                return true;
            } else helper::flash($this->errors, 'error');
        } else $this->errors['email'] =  'Die E-Mail-Adresse wird noch nicht verwendet';
    }
    // Verifiziere Passwort
    protected function verfiyPassword(string $string)
    {
        $passwort = helper::cleanString($_POST['password']);
        if (password_verify( $passwort, $this->user['passwort'])) {
            return true;
        } else {
            // Ansonsten Error Handling
            $this->errors['password'] =  'Bitte überprüfen Sie ihr Passwort';
            helper::flash($this->errors, 'error');
            return false;
        }
    }
    // Update User
    public function updateUser(array $data)
    {
        if ($this->findBySession() !== false) {
            $data = helper::cleanArray($data);
            foreach ($data as $key => $value) {
                $string = 'UPDATE user SET username = :username, email = :email WHERE userid = :userid';
                $data['userid'] = $_SESSION['userid'];
                if ($this->db->updateRow($string, $data) !== false) {
                    // Start Session
                    return true;
                } else return false;
            }
        }
    }
    // User über Session Finden
    private function findBySession()
    {
        if (isset($_SESSION['userid'])) {
            $string = "SELECT * FROM user WHERE userid = :userid";
            $array['userid'] = $_SESSION['userid'];
            if ($this->db->setRow($string, $array) !== false) {
                return true;
            } else return false;
        }
    }
    // Session Starten. Funtioniert nur nach eine User Identifizierung
    public function startSession()
    {

        if (!empty($this->user['userid'])) {
            $_SESSION['userid'] = $this->user['userid'];
            return true;
        } else return false;
    }
   // Übergibt Userdaten nach Anfrage. 
    public function getUser($data = null)
    {
        if (is_string($data)) {
            $data = helper::cleanString($data);
            return $this->user[$data];
        }
        if (is_array($data)) {
            $data = helper::cleanArray($data);
            foreach ($data as $key => $value) {
                $post[$value] = $this->user[$value];
            }
            return $post;
        }
    }
    public function getsUser($string = null, array $array = null)
    {
        if (isset($string)) {
            $string = helper::cleanString($string);
            return $this->user[$string];
        } else return false;
        if (isset($array)) {
            $array = helper::cleanArray($array);
            foreach ($array as $key) {
                $post = $this->user[$key];
            }
            return $post;
        } else return $this->user;
    }
    // Methode zur Löschung des Users.
    public function deleteUser()
    {
        // Usersuche über SESSION
        if ($this->findUser('bySession') !== false) {
            // sql string und params vorbereitung
            $sql = "DELETE FROM user WHERE userid = :userid";
            $params['userid'] = helper::cleanString($_SESSION['userid']);
            // Nutze Datenbank Klasse zur Inject.
            if ($this->db->insertRow($sql, $params) !== false) {
                if ($this->findUser('bySession') !== true) {
                    return true;
                } else {
                    // Error handling
                    $this->errors['message'] = 'User ist noch vorhanden';
                    helper::flash($this->errors, 'error');
                    return false;
                }
            }
        }
    }
}

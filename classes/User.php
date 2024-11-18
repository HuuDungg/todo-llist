<?php
class User {
    private $username;
    private $password;
    private $userFile = __DIR__ . '/../data/users.json';

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function register() {
        $users = json_decode(file_get_contents($this->userFile), true) ?? [];
        foreach ($users as $user) {
            if ($user['username'] === $this->username) {
                return "Username already exists.";
            }
        }
        $users[] = ['username' => $this->username, 'password' => $this->password];
        file_put_contents($this->userFile, json_encode($users));
        return "User registered successfully.";
    }

    public function login($password) {
        $users = json_decode(file_get_contents($this->userFile), true) ?? [];
        foreach ($users as $user) {
            if ($user['username'] === $this->username && password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }
}
?>

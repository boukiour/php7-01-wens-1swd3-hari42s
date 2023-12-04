<?php

class User extends DbConfig
{

    private $username;
    private $password;
    public function register($data)
    {
        try {

            $this->username = $data['username'];
            $this->password = $data['password'];
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(username, password) VALUES(:username, :password)";
            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $hashed_password);

            if (!$stmt->execute()) {
                throw new Exception("Error, registratie mislukt.");
            }

            return header('Location: home.php');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

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

    public function login($data)
    {
        try {
            $this->username = $data['username'];
            $this->password = $data['password'];

            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':username', $this->username);

            if (!$stmt->execute()) {
                throw new PDOException("Login mislukt.");
            }

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                $hashpassword = $row['password'];
                if (password_verify($this->password, $hashpassword)) {
                    $_SESSION['user'] = $row;
                } else {
                    return false;
                }

                return header('Location: home.php');
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            header('Location: index.php');
        }
    }

    public function read($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
                throw new PDOException("read mislukt..");
            }

            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public static function readAll()
    {
        try {
            $sql = "SELECT * FROM users";

            $stmt = self::connect()->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException("read mislukt..");
            }

            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function update($data, $id)
    {
        try {

            $this->username = $data['username'];
            $this->password = $data['password'];
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET 
                 username = :username,
                 password = :password, 
                 WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $hashed_password);

            if (!$stmt->execute()) {
                throw new Exception("Error, user toevoegen mislukt.");
            }

            return header('Location: index.php');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
                throw new Exception("Error, delete mislukt.");
            }

            return header('Location: index.php');
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

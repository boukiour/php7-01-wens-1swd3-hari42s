<?php

class Wish extends DbConfig
{
    private $title;
    private $description;
    public function create($data)
    {
        try {

            $this->title = $data['wish_name'];
            $this->description = $data['wish_desc'];

            $sql = "INSERT INTO wishes(title, description, user_id) VALUES(:title, :description, :user_id)";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':desc', $this->description);
            $stmt->bindParam(':user_id', $_SESSION['user']['id']);

            if (!$stmt->execute()) {
                throw new Exception("Connection error");
            }

            return 'wish created';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function read($id)
    {
        try {
            $sql = "SELECT * FROM wishes where id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
                throw new PDOException("Error");
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
            $sql = "SELECT * FROM wishes";

            $stmt = self::connect()->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException("Error");
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
            $this->title = $data['wish_name'];
            $this->description = $data['wish_desc'];

            $sql = "UPDATE wishes SET title = :title, description = :description WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':desc', $this->description);

            if (!$stmt->execute()) {
                throw new Exception("Error");
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM wishes WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
                throw new Exception("Error");
            }

            return;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

<?php

class Wish extends DbConfig
{
    private $wish_name;
    private $wish_desc;
    public function create($data)
    {
        try {

            $this->wish_name = $data['wish_name'];
            $this->wish_desc = $data['wish_desc'];

            $sql = "INSERT INTO wishes(wish_name, wish_desc, userID) VALUES(:wish_name, :wish_desc, :userID)";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':wish_name', $this->wish_name);
            $stmt->bindParam(':wish_desc', $this->wish_desc);
            $stmt->bindParam(':userID', $_SESSION['user']['ID']);

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

            $this->wish_name = $data['wish_name'];
            $this->wish_desc = $data['wish_desc'];


            $sql = "UPDATE wishes SET wish_name = :title, wish_desc = :desc, userID = :userID WHERE id = :id";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':wish_name', $this->wish_name);
            $stmt->bindParam(':wish_desc', $this->wish_desc);
            $stmt->bindParam(':userID', $_SESSION['user']['ID']);

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

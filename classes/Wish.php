<?php

class Wish extends DbConfig
{
    private $title;
    private $desc;
    public function create($data)
    {
        try {

            $this->title = $data['title'];
            $this->desc = $data['description'];

            $sql = "INSERT INTO wishes(wish_name, wish_desc, userID) VALUES(:wish_name, :wish_desc, :userID)";

            $stmt = self::connect()->prepare($sql);
            $stmt->bindParam(':wish_name', $this->title);
            $stmt->bindParam('::wish_desc', $this->desc);
            $stmt->bindParam(':userID', $_SESSION['user']['ID']);

            if (!$stmt->execute()) {
                throw new Exception("Connection error");
            }

            return 'product created';
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

                $this->title = $data['title'];
                $this->desc = $data['description'];


                $sql = "UPDATE wishes SET wish_name = :title, wish_desc = :desc, userID = :userID WHERE id = :id";

                $stmt = self::connect()->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':desc', $this->desc);
                $stmt->bindParam(':userID', $_SESSION['user']['ID']);

                if (!$stmt->execute()) {
                    throw new Exception("Error");
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
    }
}

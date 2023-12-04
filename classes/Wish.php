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
}

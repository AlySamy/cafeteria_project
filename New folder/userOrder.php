<?php
public function getUserTotalPriceIndex($tableUsers,$tableOrder,$index)
    {
        try {
            $query = "SELECT $tableUsers.*, sum(total_price) as total_price FROM $tableOrder, $tableUsers WHERE user_id = users.id AND status = 'Done' GROUP BY(user_id) LIMIT $index,2";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    >
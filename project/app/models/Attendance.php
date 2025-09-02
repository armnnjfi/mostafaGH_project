<?php
require_once  "init.php";
class Attendance extends model

{

    public function insert($useId, $date, $entryTime, $relativePath, $exitTime, $total_time)
    {
        $query = "INSERT INTO `attendance`(`user_id`, `date`, `check_in`, `check_in_photo`, `check_out`, `total_hours`) VALUES (?,?,?,?,?,?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("issssd", $useId, $date, $entryTime, $relativePath, $exitTime, $total_time);
        $result->execute();
    }

    public function set_exit_total_time($userId, $exitTime, $total_time)
    {
        $query = "UPDATE `attendance` 
              SET `check_out` = ?, `total_hours` = ? 
              WHERE user_id = ? AND check_out IS NULL";
        $result = $this->connection->prepare($query);
        $result->bind_param("ssi", $exitTime, $total_time, $userId);
        $result->execute();
    }

    public function getEntryTime($userId)
    {
        $query = "SELECT `check_in` FROM `attendance` WHERE total_hours Is null and check_out Is null and user_id = ? LIMIT 1";
        $result = $this->connection->prepare($query);
        $result->bind_param("i", $userId);
        $result->execute();
        $res = $result->get_result()->fetch_assoc();

        return $res ? $res['check_in'] : null;
    }
}

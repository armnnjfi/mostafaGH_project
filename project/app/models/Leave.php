<?php
require_once  "init.php";
class Leave extends model
{
    public function insert($userId, $startDate, $endDate, $reason, $status = 'pending')
    {
        $query = "INSERT INTO `leaves`(`user_id`, `start_date`, `end_date`, `reason`, `status`) VALUES (?,?,?,?,?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("issss", $userId, $startDate, $endDate, $reason, $status);
        $result->execute();
    }

    public function showRequests()
    {
        $query = "SELECT `id`, `user_id`, `start_date`, `end_date`, `reason`, `status` FROM `leaves` WHERE status = 'pending'";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->get_result();
    }

    public function approve_reject_requests($request_id, $status='pending')
    {
        $query = "UPDATE `leaves` SET `status`= ? WHERE id = ?";
        $result = $this->connection->prepare($query);
        $result->bind_param("si",$status , $request_id);
        $result->execute();
    }
}
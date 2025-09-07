<?php
require_once "init.php";
class LeaveController extends controller
{

    public function showForm()
    {
        if ($this->check_auth()) {
            $csrf = new SecurityService();
            $csrf->setCSRFToken();

            $this->view('leaveForm', ['csrf_token' => $csrf->getCSRFToken()]);
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }

    public function leave()
    {
        $csrf = new SecurityService();
        $csrf_token = $_POST['csrf_token'] ?? '';

        if (!$csrf->validate_token($csrf_token)) {
            die("Invalid CSRF token!");
        }

        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $reason = $_POST['reason'];

        $new_request = new Leave();
        $new_request->insert($_SESSION['user_id'], $startDate, $endDate, $reason);
        header('location: ' . Constants::BASE_URL . "dashboard/employee");
    }


    public function approve_reject_request()
    {
        if ($this->check_auth() && $this->is_admin()) {
            $csrf = new SecurityService();
            $csrf_token = $_POST['csrf_token'] ?? '';

            if (!$csrf->validate_token($csrf_token)) {
                die("Invalid CSRF token!");
            }

            $request_id = $_POST['request_id'];
            $requests = new Leave();

            if (isset($_POST['submit'])) {
                if ($_POST['submit'] == 'approve') {
                    $requests = $requests->approve_reject_requests($request_id, 'approved');
                } elseif ($_POST['submit'] == 'reject') {
                    $requests = $requests->approve_reject_requests($request_id, 'rejected');
                }
            }
            header('location:' . Constants::BASE_URL . 'leave_requests');
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }
}

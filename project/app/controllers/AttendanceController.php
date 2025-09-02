<?php
class AttendanceController extends Controller
{
    public function showForms()
    {
        if ($this->check_auth()) {
            $csrf_obj = new SecurityService();
            $csrf = $csrf_obj->getCSRFToken();
            $this->view('attendanceForms', ['csrf_token' => $csrf]);
        } else {
            header('location: ' . Constants::BASE_URL .  'login');
        }
    }

    public function submitAttendance()
    {
        if ($this->check_auth()) {
            $csrf = new SecurityService();
            if (!$csrf->validate_token($_POST['csrf_token'] ?? '')) {
                echo __DIR__;
                die("Invalid CSRF token!");
            }
            if (isset($_POST['entryTime']) && isset($_POST['data']) && !isset($_POST['exitTime'])) {
                $date = $_POST['data'];
                $entryTime = $_POST['entryTime'];
                if (isset($_FILES['entryPic']) && $_FILES['entryPic']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . "../../../Uploads/Attendances/" . $_SESSION['name'] . "_" . $_SESSION['user_id'];
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = time() . "_" . basename($_FILES['entryPic']['name']);
                    $filePath = $uploadDir . "/" . $fileName;

                    if (move_uploaded_file($_FILES['entryPic']['tmp_name'], $filePath)) {
                        $relativePath = "uploads/attendance/" . $_SESSION['name'] . "_" . $_SESSION['user_id'] . $fileName;

                        $attendance = new Attendance();
                        $attendance->insert($_SESSION['user_id'], $date, $entryTime, $relativePath, null, null);
                        $_SESSION['attendance'] = 1;

                        header("Location: " . Constants::BASE_URL . "dashboard/employee");
                        exit();
                    } else {
                        die("Error uploading file!");
                    }
                } else {
                    die("Picture error!");
                }
            } else if (isset($_POST['exitTime'])) {
                $attendance = new Attendance();

                // رشته check_in از دیتابیس
                $entryTimeStr = $attendance->getEntryTime($_SESSION['user_id']);
                $exitTimeStr = $_POST['exitTime'];

                if ($entryTimeStr) {
                    $entryTime = new DateTime($entryTimeStr);
                    $exitTime = new DateTime($exitTimeStr);

                    $interval = $entryTime->diff($exitTime);
                    $totalTime = $interval->format('%H:%I:%S');

                    $attendance->set_exit_total_time($_SESSION['user_id'], $exitTimeStr, $totalTime);
                }

                $_SESSION['attendance'] = 0;
                header("Location: " . Constants::BASE_URL . "dashboard/employee");
                exit();
            }
        }
    }
}

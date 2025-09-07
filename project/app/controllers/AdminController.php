<?php
require_once "init.php";
class AdminController extends controller
{
    public function dashboard()
    {
        if ($this->check_auth()) {
            $this->view("admin_dashboard");
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }

    public function showLeaveRequests()
    {
        if ($this->check_auth() && $this->is_admin()) {
            $csrf = new SecurityService();
            $csrf->setCSRFToken();

            $requests = new Leave();
            $requests = $requests->showRequests();

            $this->view('leaveRequestsList', ['csrf_token' => $csrf->getCSRFToken(), 'leave_requests' => $requests]);
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }


    public function showAllAttendances()
    {
        if ($this->check_auth() && $this->is_admin()) {


            $attendance = new Attendance();
            $reports = $attendance->showReports();

            $this->view('attendances_reports', ['reports' => $reports]);
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }


    // public function dailyReport()
    // {
    //     if ($this->check_auth() && $this->is_admin()) {
    //         $date = $_GET['date'] ?? date('Y-m-d');
    //         $attendance = new Attendance();
    //         $report = $attendance->getDailyReport($date);

    //         $this->view('daily_report', ['report' => $report, 'date' => $date]);
    //     } else {
    //         header('location:' . Constants::BASE_URL . 'login');
    //         exit();
    //     }
    // }

    // public function monthlyReport()
    // {
    //     if ($this->check_auth() && $this->is_admin()) {
    //         $month = $_GET['month'] ?? date('m');
    //         $year  = $_GET['year'] ?? date('Y');

    //         $attendance = new Attendance();
    //         $report = $attendance->getMonthlyReport($month, $year);

    //         $this->view('monthly_report', ['report' => $report, 'month' => $month, 'year' => $year]);
    //     } else {
    //         header('location:' . Constants::BASE_URL . 'login');
    //         exit();
    //     }
    // }


    public function reports()
    {
        if ($this->check_auth() && $this->is_admin()) {
            $date = $_GET['date'] ?? date('Y-m-d');
            $month = $_GET['month'] ?? date('m');
            $year = $_GET['year'] ?? date('Y');

            $attendance = new Attendance();
            $dailyReport = $attendance->getDailyReport($date);
            $monthlyReport = $attendance->getMonthlyReport($month, $year);

            // محاسبه جمع کل روزانه
            $dailyTotalSeconds = 0;
            foreach ($dailyReport as $row) {
                if (!empty($row['total_hours'])) {
                    list($h, $m, $s) = explode(':', $row['total_hours']);
                    $dailyTotalSeconds += ($h * 3600) + ($m * 60) + $s;
                }
            }
            $dailyTotalFormatted = sprintf(
                "%02d:%02d:%02d",
                floor($dailyTotalSeconds / 3600),
                floor(($dailyTotalSeconds % 3600) / 60),
                $dailyTotalSeconds % 60
            );

            // محاسبه جمع کل ماهانه
            $monthlyTotalSeconds = 0;
            foreach ($monthlyReport as $row) {
                if (!empty($row['total_hours'])) {
                    list($h, $m, $s) = explode(':', $row['total_hours']);
                    $monthlyTotalSeconds += ($h * 3600) + ($m * 60) + $s;
                }
            }
            $monthlyTotalFormatted = sprintf(
                "%02d:%02d:%02d",
                floor($monthlyTotalSeconds / 3600),
                floor(($monthlyTotalSeconds % 3600) / 60),
                $monthlyTotalSeconds % 60
            );

            $report = [
                'daily' => $dailyReport,
                'monthly' => $monthlyReport,
                'daily_total' => $dailyTotalFormatted,
                'monthly_total' => $monthlyTotalFormatted
            ];

            $this->view('reports', [
                'report' => $report,
                'date' => $date,
                'month' => $month,
                'year' => $year
            ]);
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }
}

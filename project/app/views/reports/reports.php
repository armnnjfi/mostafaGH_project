<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>گزارش‌های حضور و غیاب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #4CAF50;
            color: #fff;
        }

        .tab-container {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background: #f2f2f2;
            margin-left: 5px;
            border-radius: 5px 5px 0 0;
        }

        .tab.active {
            background: #4CAF50;
            color: #fff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>گزارش‌های حضور و غیاب</h2>

        <div class="tab-container">
            <div class="tab active" onclick="showTab('daily')">گزارش روزانه</div>
            <div class="tab" onclick="showTab('monthly')">گزارش ماهانه</div>
        </div>

        <!-- گزارش روزانه -->
        <div id="daily" class="tab-content active">
            <h3>گزارش روزانه</h3>
            <form method="GET" action="<?php echo Constants::BASE_URL . 'reports'; ?>">
                <label for="date">انتخاب تاریخ:</label>
                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($data['date']); ?>" required>
                <button type="submit">نمایش گزارش</button>
            </form>

            <?php if (!empty($data['report']['daily'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>نام پرسنل</th>
                            <th>زمان ورود</th>
                            <th>زمان خروج</th>
                            <th>مجموع ساعت کاری</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['report']['daily'] as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['check_in']); ?></td>
                                <td><?php echo htmlspecialchars($row['check_out'] ?? 'ثبت نشده'); ?></td>
                                <td><?php echo htmlspecialchars($row['total_hours'] ?? 'ثبت نشده'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3"><strong>جمع کل ساعت کاری این روز:</strong></td>
                            <td><?php echo $data['report']['daily_total']; ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>داده‌ای برای این تاریخ یافت نشد.</p>
            <?php endif; ?>
        </div>

        <!-- گزارش ماهانه -->
        <div id="monthly" class="tab-content">
            <h3>گزارش ماهانه</h3>
            <form method="GET" action="<?php echo Constants::BASE_URL . 'reports'; ?>">
                <label for="month">ماه:</label>
                <select name="month" id="month" required>
                    <?php
                    $monthNames = [1 => 'فروردین', 2 => 'اردیبهشت', 3 => 'خرداد', 4 => 'تیر', 5 => 'مرداد', 6 => 'شهریور', 7 => 'مهر', 8 => 'آبان', 9 => 'آذر', 10 => 'دی', 11 => 'بهمن', 12 => 'اسفند'];
                    for ($i = 1; $i <= 12; $i++) {
                        $sel = ($i == $data['month']) ? 'selected' : '';
                        echo "<option value='$i' $sel>{$monthNames[$i]}</option>";
                    }
                    ?>
                </select>

                <label for="year">سال:</label>
                <select name="year" id="year" required>
                    <?php
                    $currentYear = date('Y');
                    for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++) {
                        $sel = ($i == $data['year']) ? 'selected' : '';
                        echo "<option value='$i' $sel>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit">نمایش گزارش</button>
            </form>

            <?php if (!empty($data['report']['monthly'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>نام پرسنل</th>
                            <th>مجموع ساعت کاری</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['report']['monthly'] as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_hours']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>جمع کل ساعت کاری این ماه:</strong></td>
                            <td><?php echo $data['report']['monthly_total']; ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>داده‌ای برای این ماه یافت نشد.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            document.querySelector(`.tab[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>

</html>
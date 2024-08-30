<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ข้อมูลผู้ใช้งาน.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table border="1" class="table table-hover">
        <thead>
            <tr class="info">
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล</th>
                <th>วันที่สมัครสมาชิก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connect.php';
            include 'format.php';
            $conn = connect_bestDB();
            $sql_get_order_data = "select username, email, date_register from account";
            $result = mysqli_query($conn, $sql_get_order_data);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <tr>
                        <td>' . base64_decode($row["username"]) . '</td>
                        <td>' . base64_decode($row["email"]) . '</td>
                        <td>' . $row["date_register"] . '</td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>
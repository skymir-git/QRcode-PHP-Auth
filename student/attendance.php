<?php
session_start();
require ('../lib/db.php');

if($_SESSION['type']=='학생') {
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}
?>

<!doctype html>
<html lang="ko">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>GNTech QR Student Attendance</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/lib/materialize.min.css">
    <link rel="stylesheet" href="/lib/style.css">
    <script src="/lib/jquery-3.3.1.min.js"></script>
    <script src="/lib/materialize.min.js"></script>
    <script src="/lib/script.js"></script>
    <link rel="stylesheet" href="../lib/attendance.css">
</head>

<body>
    <div class="wrap">
        <header>
            <div class="buttons">
                <form id="Logout">
                    <div class="row right-align">
                        <button  class="btn waves-effect waves-light btn-small" type="submit" name="action">로그아웃
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
                <button  class="btn waves-effect waves-light btn-small" type="submit" name="action" onclick="history.back(-1);">목록으로
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </header>
        <div id="content">
            <div class="title">
                <?php
                echo "<p>{$_GET['subject']} 출석 현황</p>";
                ?>
            </div>
            <table>
                <tr>
                    <th>날짜</th>
                    <th>출석</th>
                </tr>
                    <?php
                    $subjectName = $_GET["subject"];
                    $studentCode = $_SESSION["studentcode"];
                    $subjectCodeResult = $PDO->query("select subjectcode from web.subjectcode where subject = '$subjectName'");
                    foreach ($subjectCodeResult as $row) {
                        $subjectCode = $row['subjectcode'];
                    }

                    $result = $PDO->query("select * from attendance where subjectcode='$subjectCode' AND code='$studentCode'");
                    foreach ($result as $rows) {
                        echo '<tr>';
                        echo '<td>' . $rows['date'] . '</td>';
                        if ($rows['yn'] == 1) {
                            echo '<td>O</td>';
                        } else {
                            echo '<td>X</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
            </table>
        </div>
    </div>
</body>

</html>
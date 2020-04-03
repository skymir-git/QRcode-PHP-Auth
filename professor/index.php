<?php

session_start();

require ('../lib/db.php');

if($_SESSION['type']=='교수') {

    $code = $_SESSION['studentcode'];
    $name = $_SESSION['name'];
    $result=$PDO->query("SELECT * FROM web.subjectcode WHERE code = '$code' and name = '$name'")->fetchAll();

}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>GNTech QR Professor</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../lib/materialize.min.css">
    <link rel="stylesheet" href="../lib/style.css">
    <link rel="stylesheet" href="../lib/professor.css">
    <script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../lib/materialize.min.js"></script>
    <script src="../lib/script.js"></script>
</head>
<body>
<div id="main" class="all">
    <form id="Logout">
        <div class="row right-align">
            <p class="logoutbox"><?=$_SESSION['name']?> 님의 출석부입니다.</p>
            <button  class="btn waves-effect waves-light btn-small" type="submit" name="action">로그아웃
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
    <p class="title">출석 기록부</p>
    <hr><br>
    <fieldset>
    <legend><p class="subject">과목별 출석부</p></legend>
    <?for ($i=0; $i<count($result); $i++){?>
    <div class="middle">
        <button class="detail btn waves-effect waves-light position" type="submit" name="list">조회
            <i class="material-icons right">send</i>
        </button>
        <p class="relative"><?=$result[$i]["subject"]?></p>
        <hr>
        <br>
        <br>
    </div>
    <?}?>
    </fieldset>
</div>
<div id="qr" class="center-align">
    <div id="qr_result" class="center-align">
        <img id="qrcodeimg">
    </div>
    <p>제한 시간안에 QR코드를 인식하세요</p>
    <div id="countdown"></div>
    <br>
    <!--
    <div class="center-align">
        <button class="btn waves-effect waves-light" type="submit" name="list_back">뒤로가기
            <i class="material-icons right">send</i>
        </button>
    </div>
    -->
</div>
<div id="detail"></div>
<div id="attendance"></div>
</body>
</html>

<?php

if (!isset($_SESSION)) session_start();
session_regenerate_id(TRUE);

//セッション変数を全て解除
$_SESSION = [];

// セッションを切断するにはセッションクッキーも削除する。
// Note: セッション情報だけでなくセッションを破壊する。
if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');

//セッションを破棄
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign out</title>
  <!-- CSSを読み込む -->
  <link rel="stylesheet" href="stylesheet.css">
  <!-- jQueryのライブラリを読み込む -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- bootstrapのライブラリーを読み込む -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <!-- nav -->
  <div class="container mt-5">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="../../index.php">TOP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../players_page.php">playerページ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../admin/admin_page.php">管理者ページ</a>
        </li>
    </ul>
  </div>


  <div class="container mt-5">
    <h2>Sign Out しました</h2>
  </div>
  
</body>
</html>

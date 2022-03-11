<?php
  session_start();
  session_regenerate_id(TRUE);
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アハ体験TOP</title>

    <!-- CSSを読み込む -->
    <link rel="stylesheet" href="stylesheet.css">
    <!-- jQueryのライブラリを読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrapのライブラリーを読み込む -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!-- header -->

        <!-- jumbotron -->
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <?PHP if( isset($_SESSION["signIn"]['is_signIn']) ):?>
                    <h2 class="display-5">ようこそ！ <?= $_SESSION["signIn"]['name'] ?>さん</h2>
                <?PHP else:?>
                    <h2 class="display-5">ようこそ！</h2>
                <?PHP endif?>
                <p class="lead">このサイトではアハ体験ができます</p>
                <p class="lead">アハ体験とは、一定時間で画像の一部が徐々に変化していくので、それを当てるゲームです</p>
            </div>
        </div>

        <!-- nav -->
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="#">TOP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="players/players_page.php">playerの管理ページ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/admin_page.php">管理者ページ</a>
            </li>
        </ul>
    

    <!-- main -->
    <div class="container">
        <div class="mt-5">
            <!-- 問題 -->
            <div class="card-deck">
                <!-- 初級問題 -->
                <div class="card">
                    <h5 class="card-header">初級問題</h5>
                    <div class="card-body">
                        <h5 class="card-title">初級問題</h5>
                        <p class="card-text">画像のどこが変化したかわかりやすくなっています。初めての方にオススメ</p>
                        <form action="#" method="POST">
                            <input type="hidden" name="difficulty" value=1>
                            <button type="submit" class="btn btn-primary" formaction="aha/aha_list.php">問題へ</button>
                        </form>
                    </div>
                </div>
                <!-- 中級問題 -->
                <div class="card">
                    <h5 class="card-header">中級問題</h5>
                    <div class="card-body">
                        <h5 class="card-title">中級問題</h5>
                        <p class="card-text">標準レベル。</p>
                        <form action="#" method="POST">
                            <input type="hidden" name="difficulty" value=2>
                            <button type="submit" class="btn btn-primary" formaction="aha/aha_list.php">問題へ</button>
                        </form>
                    </div>
                </div>
                <!-- 上級問題 -->
                <div class="card">
                    <h5 class="card-header">上級問題</h5>
                    <div class="card-body">
                        <h5 class="card-title">上級問題</h5>
                        <p class="card-text">これを解けた貴方はスゴイ！</p>
                        <form action="#" method="POST">
                            <input type="hidden" name="difficulty" value=3>
                            <button type="submit" class="btn btn-primary" formaction="aha/aha_list.php">問題へ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div id="footer-wrapper">
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <script type="text/javascript" src="script.js"></script>
</body>
</html>
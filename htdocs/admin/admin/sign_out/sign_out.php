<?PHP
    // セッションをスタートする。
    session_start();
    // セッションIDをリクエストのたびに更新する。
    session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="jp">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>

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
                <a class="nav-link" href="../../../index.php">TOP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../../players/players_page.php">playerページ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../admin_page.php">管理者ページ</a>
            </li>
        </ul>
    </div>
    <!-- Form -->
    <div class="container">
        <div class="my-5">
            <h2>Sign Out しますか？</h2>
            <form method="POST" action="#">
                <button type="cancel" class="btn btn-secondary" formaction="../../../index.php">cancel</button>
                <button type="submit" class="btn btn-primary" formaction="sign_out_check_and_action.php">OK</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
<?PHP
  // セッションをスタートする。
  session_start();
  // セッションIDをリクエストのたびに更新する。
  session_regenerate_id();

  require_once('../../../common/define.php');
  require_once('../../../common/sql_admin.php');

  try
  {
    $admin = new adminModel();
    if ( $admin->registerAdmin($_SESSION['amdin']["signUp"]['name'], $_SESSION['amdin']["signUp"]['pass1']) == false )
    {
      header('Location: sign_up.php');
    }
  } catch(Exception $e)
  {
    var_dump($e);
    exit();
    header('Location: ../../admin_page.php');
  }

  $admin = NULL;

  unset($_SESSION['amdin']["signUp"]);
  if(isset($_SESSION["err"])) unset($_SESSION["err"]);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>

    <!-- CSSを読み込む -->
    <link rel="stylesheet" href="stylesheet.css">
    <!-- jQueryのライブラリを読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrapのライブラリーを読み込む -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
  <!-- nav -->
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

  <div class="container mt-5">
        <h2>登録完了しました</h2>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
<?PHP
  session_start();
  session_regenerate_id(TRUE);
?>

<!DOCTYPE html>
<html lang="ja">
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
  <!-- jumbotron -->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <?PHP if( isset($_SESSION["signIn"]['is_signIn'])):?>
        <h2 class="display-5">ようこそ！ <?= $_SESSION["signIn"]['name'] ?>さん</h2>
      <?PHP else:?>
        <h2 class="display-5">ようこそ！</h2>
      <?PHP endif?>
      <p class="lead">このページでは、playerの管理を行います</p>
    </div>
  </div>

  <!-- nav -->
  <ul class="nav justify-content-end">
    <li class="nav-item">
        <a class="nav-link" href="../index.php">TOP</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">playerの管理ページ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../admin/admin_page.php">管理者ページ</a>
    </li>
</ul>

  <?PHP if( !isset($_SESSION["signIn"]['is_signIn']) ):?>
    <div class="container mt-3">
      <h2>Sign In</h2>
      <a href="sign_in/sign_in.php">こちら</a>から
    </div>
  <?PHP endif?>

  <?PHP if (isset($_SESSION["signIn"]['is_signIn'])):?>
    <div class="container mt-3">
      <h2>Sign Out</h2>
      <a href="sign_out/sign_out.php">こちら</a>から
    </div>
  <?PHP endif?>

  <?PHP if ( !isset($_SESSION["signIn"]['is_signIn'])):?>
    <div class="container mt-3">
      <h2>Sign Up</h2>
      <a href="sign_up/sign_up.php">こちら</a>から
    </div>
  <?PHP endif?>

  <?PHP if (isset($_SESSION["signIn"]['is_signIn']) ):?>
    <div class="container mt-3">
      <h2>player名やパスワードの変更</h2>
      <a href="change/change.php">こちら</a>から
    </div>
  <?PHP endif?>

  <?PHP if (isset($_SESSION["signIn"]['is_signIn']) ):?>
    <div class="container mt-3">
      <h2>退会</h2>
      <a href="withdraw/withdraw.php">こちら</a>から
    </div>
  <?PHP endif?>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
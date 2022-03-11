<?PHP
  session_start();
  session_regenerate_id(TRUE);
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
  <div class="container mt-5">
    <form action="#" method="POST" novalidate>
      <h2>sign up</h2>
      <?PHP if (isset($_SESSION['err']["signUp"]['accident'])): ?>
        <p color="red"><?=$_SESSION['err']["signUp"]['accident']?></p>
      <?else:?>
        <p>登録することで、続きからプレイ出来ます</p>
      <?PHP endif?>
      <div class="container mt-4">
        <!-- 氏名またはニックネーム -->
        <div class="form-group row">
          <label for="name" class="col-sm-3 col-form-label">氏名またはニックネーム</label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['signUp']['name'])):?>
              <input type="text" class="form-control is-invalid fix-rounded-right" required id="name" name="name">
              <div class="invalid-feedback">
                  <?= $_SESSION['err']['signUp']['name'] ?>
              </div>
            <?PHP elseif (isset($_SESSION['signUp']['name'])):?>
              <input type="text" class="form-control" id="user" name="name" aria-describedby="name" required value=<?=$_SESSION['signUp']['name']?>>
            <?php else:?>
              <input type="text" class="form-control" id="user" name="name" aria-describedby="name" required>
            <?php endif?>
          </div>
        </div>
        <!-- パスワード -->
        <div class="form-group row">
          <label for="pass1" class="col-sm-3 col-form-label">パスワード</label>
          <div class="col-sm-9">
            <?PHP if(isset($_SESSION['err']['signUp']['pass'])): ?>
              <input type="password" class="form-control is-invalid fix-rounded-right" required id="pass1" name="pass1">
              <div class="invalid-feedback">
                <?PHP echo $_SESSION['err']['signUp']['pass'] ?>
              </div>
            <?PHP else:?>
              <input type="password" class="form-control" id="pass1" name="pass1" aria-describedby="passwordHelpBlock">
              <small id="passwordHelpBlock" class="form-text text-muted">
                半角英数8文字以上16文字以内で設定して下さい
              </small>
            <?PHP endif?>
          </div>
        </div>
        <!-- パスワード（再入力） -->
        <div class="form-group row">
          <label for="pass2" class="col-sm-3 col-form-label">パスワード（再入力）</label>
          <div class="col-sm-9">
            <?PHP if(isset($_SESSION['err']['signUp']['pass'])): ?>
              <input type="password" class="form-control is-invalid fix-rounded-right" required id="pass2" name="pass2">
              <div class="invalid-feedback">
                <?= $_SESSION['err']['signUp']['pass'] ?>
              </div>
            <?PHP else:?>
              <input type="password" class="form-control" id="Password2" name="pass2" aria-describedby="passwordHelpBlock">
              <small id="passwordHelpBlock" class="form-text text-muted">
                半角英数8文字以上16文字以内で設定して下さい
              </small>
            <?PHP endif?>
          </div>
        </div>
        <!-- ボタン -->
        <div class="form-group row">
          <div class="col-sm-3">
            <button type="cancel" class="btn btn-secondary" formaction="../index.php">キャンセルし、トップページへ</button>
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary" formaction="sign_up_check.php">登録</button>
          </div>
        </div>
      </div>
    </form>

    </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
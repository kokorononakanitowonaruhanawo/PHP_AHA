<?PHP
  session_start();
  session_regenerate_id(TRUE);
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
    <!-- Form -->
    <div class="container">
        <div class="my-5">
            <h2>Sign In</h2>
            
            <!-- sign in 失敗のエラーメッセージ -->
            <?PHP if (isset($_SESSION['err']['login']['incorrect']) && $_SESSION['err']['login']['incorrect']):?>
                <h3 class="alert alert-primary" role="alert"><?=$_SESSION['err']['login']['incorrect']?></h3>
            <?PHP endif?>

            <form method="POST" action="#">
                <div class="form-group row">
                <!-- 氏名またはニックネーム -->
                    <label for="name" class="col-sm-3 col-form-label">氏名またはニックネーム</label>
                    <div class="col-sm-9">
                        <!-- 『氏名またはニックネーム』が空白の時 -->
                        <?php if(isset($_SESSION['err']['signIn']['name'])):?>  
                            <input type="text" class="form-control is-invalid fix-rounded-right" required id="name" name="name">
                            <div class="invalid-feedback">
                                <?= $_SESSION['err']['signIn']['name'] ?>
                            </div>
                        <!-- 『sign in』に失敗した時 -->
                        <?php elseif(isset($_SESSION['err']['login']['incorrect'] )):?>
                            <input type="text" class="form-control is-invalid fix-rounded-right" required id="name" name="name">
                            <div class="invalid-feedback">
                                <?= $_SESSION['err']['login']['incorrect']  ?>
                            </div>
                        <!-- 『パスワード』が間違っていた時 -->
                        <?PHP elseif (isset($_SESSION['signIn']['name'])):?>
                            <input type="text" class="form-control" id="user" name="name" aria-describedby="name" required value=<?=$_SESSION['signIn']['name']?>>
                        <!-- 初回 -->
                        <?php else:?>
                            <input type="text" class="form-control" id="user" name="name" aria-describedby="name" required>
                        <?php endif?>
                    </div>
                </div>
                <!-- パスワード -->
                <div class="form-group row">
                    <label for="pass" class="col-sm-3 col-form-label">パスワード</label>
                    <div class="col-sm-9">
                        <!-- パスワードが空白か文字数が間違っている -->
                        <?PHP if(isset($_SESSION['err']['signIn']['pass'])): ?>
                            <input type="password" class="form-control is-invalid fix-rounded-right" required id="pass" name="pass">
                            <div class="invalid-feedback">
                                <?PHP echo $_SESSION['err']['signIn']['pass'] ?>
                            </div>
                        <!-- 『sign in』に失敗した時 -->
                        <?php elseif(isset($_SESSION['err']['login']['incorrect'] )):?>
                            <input type="password" class="form-control is-invalid fix-rounded-right" required id="pass" name="pass">
                            <div class="invalid-feedback">
                                <?= $_SESSION['err']['login']['incorrect']  ?>
                            </div>
                        <?PHP else:?>
                            <input type="password" class="form-control" id="pass" name="pass">
                        <?PHP endif?>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="cancel" class="btn btn-secondary" formaction="../../index.php">cancel</button>
                <button type="submit" class="btn btn-primary" formaction="sign_in_check_and_action.php">sign in</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
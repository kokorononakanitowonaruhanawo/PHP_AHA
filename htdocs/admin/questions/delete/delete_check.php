<?PHP
    session_start();
    session_regenerate_id(TRUE);

    require_once('../../../common/define.php');
    require_once('../../../common/sql_questions.php');

    //$_SESSION リセット
    if (isset($_SESSION['err']) && $_SESSION['err'])  unset($_SESSION['err']);
    if (isset($_SESSION['question']))   unset($_SESSION['question']);
    $_SESSION['question'] = sanitize($_POST);
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <h2 class="display-5">問題削除（確認）</h2>
    </div>

<h3>以下の問題を削除しますか？</h3>

<!-- FORM -->
    <div class="container my-5">
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- title -->
        <div class="form-group row">
            <label for="difficulty" class="col-sm-4 col-form-label">タイトル</label>
            <div class="col-sm-6">
                <input type="text" readonly value="<?=$_SESSION['question']['title']?>">
            </div>
        </div> 
        <!-- 難易度 -->
        <div class="form-group row">
            <label for="difficulty" class="col-sm-4 col-form-label">難易度</label>
            <div class="col-sm-6">
                <input type="text" readonly value="<?=$_SESSION['question']['difficulty']?>">
            </div>
        </div> 
            <div class="col-sm-3">
                <button type="cancel" class="btn btn-secondary" formaction="../delete_and_edit.php">キャンセル</button>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" formaction="delete_action.php">削除</button>
            </div>
        </form>
    </div>
    
</body>
</html>
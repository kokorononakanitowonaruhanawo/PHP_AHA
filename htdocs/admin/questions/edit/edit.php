<?PHP
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../../common/define.php');
  require_once('../../../common/sql_questions.php');

  //$_SESSION リセット
  if (isset($_SESSION['err']) && $_SESSION['err'])  unset($_SESSION['err']);
  if (isset($_SESSION['question']))   unset($_SESSION['question']);

  try{
    $question = new questionsModel();
    $_SESSION['question'] = [];
    $_SESSION['question'] = $question -> getQuestion(sanitize($_POST['ID']));
  } catch (Exception $e)
  {
    var_dump($e);
    exit();
    header('Location: ../../index.php');
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題修正</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

    <!-- nav -->
    <div class="mt-3">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="../../../index.php">TOP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../../players/players_page.php">playerページ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../../admin_page.php">管理者ページ</a>
        </li>
    </ul>
</div>


<!-- FORM -->
    <div class="container my-5">
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- Title -->
        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">タイトル</label>
            <div class="col-sm-6">
                <?PHP if(isset($_SESSION['err']['question']['title']) && $_SESSION['err']['question']['title']):?>
                    <input type="text" class="form-control is-invalid" id="title" name="title" aria-describedby="titleFeedback" require>
                    <div id="titleFeedback" class="invalid-feedback">
                        <?=$_SESSION['err']['question']['title']?>
                    </div>
                <?PHP else:?>
                    <input type="text" class="form-control-file" id="title" name="title" value="<?=$_SESSION['question']['title']?>">
                <?PHP endif?>
            </div>
        </div>

        <!-- 難易度 -->
        <div class="form-group row">
            <label for="difficulty" class="col-sm-4 col-form-label">難易度</label>
            <div class="col-sm-5">
                <select class="form-control" id="difficulty" name="difficulty">
                    <option value=1 <?PHP if($_SESSION['question']['difficty']==1):?> selected <?PHP endif?>>easy</option>
                    <option value=2 <?PHP if($_SESSION['question']['difficty']==2):?> selected <?PHP endif?>>normal</option>
                    <option value=3 <?PHP if($_SESSION['question']['difficty']==3):?> selected <?PHP endif?>>hard</option>
                </select>
            </div>
        </div> 
        <!-- 画像の登録 -->
        <div class="form-group row">
            <label for="before" class="col-sm-4 col-form-label">変更前の画像 <span class="badge badge-warning">画像サイズ：980×600 pngファイル</span></label>
            <div class="col-sm-6">
                <?PHP if(isset($_SESSION['err']['question']['before']) && $_SESSION['err']['question']['before']):?>
                    <input type="file" class="form-control is-invalid" id="before" name="before" aria-describedby="beforeFeedback" >
                    <div id="beforeFeedback" class="invalid-feedback">
                        <?=$_SESSION['err']['question']['before']?>
                    </div>
                <?PHP else:?>
                    <input type="file" class="form-control-file" id="before" name="before" aria-describedby="beforeHelpBlock">
                <?PHP endif?>
            </div>
        </div>
        <div class="form-group row">
            <label for="after" class="col-sm-4 col-form-label">変更後の画像 <span class="badge badge-warning">画像サイズ：980×600 pngファイル</span></label>
            <div class="col-sm-6">
                <?PHP if(isset($_SESSION['err']['question']['after']) && $_SESSION['err']['question']['after']):?>
                    <input type="file" class="form-control is-invalid" id="after" name="after" aria-describedby="afterFeedback" require>
                    <div id="afterFeedback" class="invalid-feedback">
                        <?=$_SESSION['err']['question']['after']?>
                    </div>
                <?PHP else:?>
                    <input type="file" class="form-control-file" id="before" name="before">
                <?PHP endif?>
            </div>
        </div>
        <div class="form-group row">
            <label for="answer" class="col-sm-4 col-form-label">答えの画像 <span class="badge badge-warning">画像サイズ：980×600 pngファイル</span></label>
            <div class="col-sm-6">
                <?PHP if(isset($_SESSION['err']['question']['answer']) && $_SESSION['err']['question']['answer']):?>
                    <input type="file" class="form-control is-invalid" id="answer" name="answer" aria-describedby="answerFeedback" require>
                    <div id="answerFeedback" class="invalid-feedback">
                        <?=$_SESSION['err']['question']['answer']?>
                    </div>
                <?PHP else:?>
                    <input type="file" class="form-control-file" id="before" name="before">
                <?PHP endif?>
            </div>
        </div>
        <div class="form-group row">
            <label for="explanation" class="col-sm-4 col-form-label">答えの解説 <span class="badge badge-warning">100文字まで</span></label>
            <div class="col-sm-6">
                <?PHP if(isset($_SESSION['err']['question']['explanation']) && $_SESSION['err']['question']['explanation']):?>
                    <textarea class="form-control is-invalid" id="explanation" name="explanation" aria-describedby="explanationFeedback" require><?=$_SESSION['question']['explanation']?></textarea>
                    <div id="explanationFeedback" class="invalid-feedback">
                    <?=$_SESSION['err']['question']['explanation']?>
                <?PHP else:?>
                    <textarea class="form-control" id="explanation" row="5" name="explanation"><?=$SESSION['question']['explanation']?></textarea>
                <?PHP endif?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
                <button type="cancel" class="btn btn-secondary" formaction="../question_page.php">破棄して問題管理画面へ</button>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" formaction="register_check.php">登録（確認）</button>
            </div>
        </form>
    </div>
    
</body>
</html>
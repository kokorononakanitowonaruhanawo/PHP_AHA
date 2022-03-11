<?PHP
    session_start();
    session_regenerate_id(TRUE);

    require_once('../../../common/define.php');
    require_once('../../../common/sql_questions.php');

    //$_SESSION リセット
    if (isset($_SESSION['err']) && $_SESSION['err'])  unset($_SESSION['err']);
    if (isset($_SESSION['question']) && $_SESSION['question'])  unset($_SESSION['question']);

    $_SESSION['question'] = sanitize($_POST);

// exit();
    /** validity check
     * タイトル
     * 画像×3枚
     * 答えの補足解説
     */
    $validity = TRUE;
    // タイトル
    if (($_SESSION['question']['title'] == "") || (strlen($_SESSION['question']['title']) > 20))
    {
        $validity = FALSE;
        $_SESSION['err']['question']['title'] = 'タイトルは1文字以上20文字以内で設定してください';
    } elseif (ctype_space($_SESSION['question']['title']) == true)
    {
        $validity = FALSE;
        $_SESSION['err']['question']['title'] = '空白文字は使えません';
    }

    // 画像（変化前）
    if( questionsModel::uploadFileToTemp($_FILES['before'], "before.png") == false )    //static functionを呼び出す場合は、class名::ユーザ定義関数　とする
    {
        $_SESSION['err']['question']['before'] =  "ファイルをアップロードできません。";
        $validity = FALSE;
    } 

    // 画像（変化後）
    if( questionsModel::uploadFileToTemp($_FILES['after'], "after.png") == false )  //static functionを呼び出す場合は、class名::ユーザ定義関数　とする
    {
        // $_SESSION['err']['question']['after'] =  "ファイルをアップロードできません。";
        $validity = FALSE;
    }

    // 画像（答え）
    if( questionsModel::uploadFileToTemp($_FILES['answer'], "answer.png") == false )    //static functionを呼び出す場合は、class名::ユーザ定義関数　とする
    {
        $_SESSION['err']['question']['answer'] =  "ファイルをアップロードできません。";
        $validity = FALSE;
    }

    // 答えの補足解説
    if (ctype_space($_SESSION['question']['explanation']) == true)
    {
        $validity = FALSE;
        $_SESSION['err']['question']['explanation'] = '空白文字は使えません';
    } elseif (strlen($_SESSION['question']['explanation']) > 100)
    {
        $validity = FALSE;
        $_SESSION['err']['question']['explanation'] = '補足解説は100文字以内で設定してください';
    }

    if ($validity == FALSE)
    {
        header('Location: register.php');
        exit();
    }
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題登録（確認）</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <h2 class="display-5">問題登録（確認）</h2>
    </div>



<!-- FORM -->
    <div class="container my-5">
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- title -->
        <div class="form-group row">
                
            <label for="title" class="col-sm-4 col-form-label">タイトル</label>
            <div class="col-sm-5">
                <label for="title" class="col-form-label"><?=$_SESSION['question']['title']?></label>
            </div>
        </div>
        <!-- 難易度 -->
        <div class="form-group row">
            <label for="difficulty" class="col-sm-4 col-form-label">難易度</label>
            <div class="col-sm-5">
                <?PHP if($_SESSION['question']['difficulty']==1):?>
                    <label for="difficulty" class="col-form-label">easy</label>
                <?PHP elseif($_SESSION['question']['difficulty']==2):?>
                    <label for="difficulty" class="col-form-label">normal</label>
                <?PHP elseif($_SESSION['question']['difficulty']==3):?>
                    <label for="difficulty" class="col-form-label">hard</label>
                <?PHP endif?>
            </div>
        </div>
        <!-- 画像の登録 -->
        <div class="form-group row">
            <label for="before" class="col-sm-4 col-form-label">変更前の画像</label>
            <div class="col-sm-6">
                <label for="before" class="col-form-label"><?=$_FILES['before']['name']?></label>
            </div>
        </div>
        <div class="form-group row">
            <label for="after" class="col-sm-4 col-form-label">変更後の画像</label>
            <div class="col-sm-6">
                <label for="after" class="col-form-label"><?=$_FILES['after']['name']?></label>
            </div>
        </div>
        <div class="form-group row">
            <label for="answer" class="col-sm-4 col-form-label">答えの画像</label>
            <div class="col-sm-6">
                <label for="answer" class="col-form-label"><?=$_FILES['answer']['name']?></label>
            </div>
        </div>
        <div class="form-group row">
            <label for="explanation" class="col-sm-4 col-form-label">答えの解説</label>
            <div class="col-sm-6">
                <label for="explanation" class="col-form-label"><?=$_SESSION['question']['explanation']?></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
                <button type="cancel" class="btn btn-secondary" formaction="register.php">戻る</button>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" formaction="register_action.php">登録</button>
            </div>
        </form>
    </div>
    
</body>
</html>
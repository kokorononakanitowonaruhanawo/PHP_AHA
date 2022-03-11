<?PHP
    session_start();
    session_regenerate_id(TRUE);
  
    require_once('../common/define.php');
    require_once('../common/sql_players.php');
    require_once('../common/sql_compList.php');
    require_once('../common/sql_questions.php');
  

    //  解いたというcheckをする
    if ((isset($_SESSION["signIn"]['is_signIn']))) {
        try {
            $comp = new compListModel;
            $comp -> checkCompQuestion($_SESSION["signIn"]['is_signIn'], $_SESSION['question']['ID']);
        } catch (Exception $e) {
            var_dump($e);
            exit();
            header('Local: aha_list.php');
        }
    }
    $comp = null;

    // 問題を取得
    try {
        $q = new questionsModel;
        $AHA = $q->getAnswer($_SESSION['question']['id']);
    } catch (Exception $e) {
        var_dump($e);
        exit();
        header('Local: aha_list.php');
    }
    $q = null;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sample</title>
    

    <!-- CSSを読み込む -->
    <link rel="stylesheet" href="stylesheet.css">
    <!-- jQueryのライブラリを読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrapのライブラリーを読み込む -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container my-5">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">TOPページへ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aha_list.php">問題一覧へ</a>
            </li>
        </ul>
    </div>
    <div class="container my-5">
        <img class="displayedAnswerIMG" src="<?= $_SESSION['question']['dir'] . $AHA['answer_png']?>" alt="" height="600" width="980">
    </div>
    <?PHP if (isset($AHA['explanation']) && $AHA['explanation']!=""): ?>
        <div class="container my-5">
            <p class="explanation"><?=$AHA['explanation']?></p>
        </div>
    <?PHP endif?>
    


    <script type="text/javascript" src="script.js"></script>
</body>
</html>
<?PHP
    session_start();
    session_regenerate_id(TRUE);
  
    require_once('../common/define.php');
    require_once('../common/sql_players.php');
    require_once('../common/sql_questions.php');
    require_once('../common/sql_compList.php');

    if(isset($_SESSION['question']))    unset($_SESSION['question']);

    // どの難易度を選択したか
    $diffucilty = sanitize($_POST);
    if (!empty($diffucilty))    $_SESSION['diffucilty'] = $diffucilty["difficulty"];

    try {
        $question = new questionsModel;
        $questions = [];

        /** 難易度の問題を取得
         * case1:signinしている場合　→　解いた問題に「済」をつけ、ソートする
         * case2:signinしていない場合　→　単に問題を取得
         */
        
        // case1:signinしている場合　→　解いた問題に「済」をつけ、ソートする
        if ( isset($_SESSION["signIn"]['is_signIn'])) {
            $questions = $question->getAllQuestionsForDifficultyInSignin($_SESSION["signIn"]['is_signIn'], $diffucilty["difficulty"] );
        }

        // case2:signinしていない場合　→　単に問題を取得
        else {
            $questions = $question->getAllQuestionsForDifficulty($_SESSION['diffucilty'] );
        }
    } catch (Exception $e) {
        var_dump($e);
        exit();
        header('Location: ../index.php');
    }

    /** playerがsigninしている場合
     * playerが解いた問題に「済」をつける
     */

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

    <!-- main -->
    <div class="container mt-5">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">問題を解いたか</th>
                    <th scope="col">action</th>
                </tr>
            </thead>

            <?php $i=1?>
            <?php foreach($questions as $question):?>
                <tr>
                    <td class="align-center">
                        <?= $i?>
                    </td>
                
                    <td class="align-center">
                        <?= $question['title']?>
                    </td>
                    <td class="align-center">
                        <?PHP if ((isset($_SESSION["signIn"]['is_signIn'])) && ($question['players_ID'] == $_SESSION["signIn"]['is_signIn'])):?>
                            済
                        <?PHP endif?>
                    </td>
                    <td>
                        <form action="aha.php" method="post">
                            <input type="hidden" name="id" value="<?= $question['id']?>">
                            <input type="hidden" name="name" value="<?=$question['title']?>">
                            <input type="submit" value="挑戦">
                        </form>
                    </td>
                </tr>
                <?php $i++?>
            <?php endforeach?>
        </table>
    </div>


    <script type="text/javascript" src="script.js"></script>
</body>
</html>
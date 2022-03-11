<?PHP
  session_start();
  session_regenerate_id(TRUE);

  require_once('../../../common/define.php');
  require_once('../../../common/sql_questions.php');

  try{
    $question = new questionsModel();
    $question -> editQuestion($_SESSION['question']['id'], $_SESSION['question']['title'], $_SESSION['question']['difficulty'], 
        $_SESSION['question']['before'], $_SESSION['question']['after'], $_SESSION['question']['answer'], $_SESSION['question']['explanation']);
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
    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-5">問題を修正しました</h3>
        </div>
    </div>

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
    <div class="container my5">
        <h3>問題を修正しました</h3>
    </div>

</body>
</html>
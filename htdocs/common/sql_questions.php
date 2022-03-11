<?php
  require_once('sql_parent.php');
  require_once('sql_compList.php');

  class questionsModel extends BaseModel {

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();    //親クラスのコンストラクタを呼び出す
    }


    /**
     * デストラクタ
     */
    public function __destruct()
    {
        parent::__destruct();   //親クラスのデストラクタを呼び出す
    }




    /** 問題を登録
     * @param varchar title
     * @param int diffiulty
     * @param varchar before_png
     * @param varchar after_png
     * @param varchar answer_png
     * @param varchar explanation
     * 
     * @return bool
     */
    public function registerQuestion($title, $difficulty, $explanation)
    {
        // 画像の保存先
        $dir = '../../../img/';
        if ($_SESSION['question']['difficulty']==1) $dir .= 'easy';
        elseif ($_SESSION['question']['difficulty']==2) $dir .= 'normal';
        elseif ($_SESSION['question']['difficulty']==3) $dir .= 'hard';

        try {
            $iterator = new GlobIterator($dir);
            $i = 1;
            while(true)
            {
                $filename_base = 'aha' . strval($iterator->count()+$i);
                if(!file_exists($dir . '/' . $filename_base))
                {
                    $dir .= '/' . $filename_base;
                    // ディレクトリを作成
                    mkdir ($dir, 0777, true);
                    break;
                }
                $i ++;
            }
        } catch (Exception $e) {
            var_dump($e);
            exit();
            header('Location: ../admin/question/register/register.php');
        }
        $iterator = null;
        
        // ファイルを移動し、リネーム
        $tempDir = "../../../img/temp/";
        // 画像（変化前）
        rename($tempDir."before.png", $dir.'/'.$filename_base.'_before.png');

        // 画像（変化後）
        rename($tempDir."after.png", $dir.'/'.$filename_base.'_after.png');

        // 画像（答え）
        rename($tempDir."answer.png", $dir.'/'.$filename_base.'_answer.png');

        $sql = 'INSERT INTO questions_list (title, difficulty, before_png, after_png, answer_png, explanation) VALUES(?, ?, ?, ?, ?, ?)';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $title;
        $data[] = $difficulty;
        $data[] = $filename_base .'_before.png';
        $data[] = $filename_base .'_after.png';
        $data[] = $filename_base .'_answer.png';
        $data[] = $explanation;
        $stmt->execute($data);
    }



    /** 全問題を取得
     * @return  array
     */
    public function getAllQuestions()
    {
        $sql = 'SELECT id, title, difficulty FROM questions_list WHERE is_deleted=0';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        $questions = [];
        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            $questions[] = $rec;
        }

        return $questions;
    }




    /** ある難易度の全問題を取得
     * @param int difficulty
     * @return  array questions
     */
    public function getAllQuestionsForDifficulty($difficulty)
    {
        $sql = 'SELECT id, title FROM questions_list WHERE is_deleted=0 AND difficulty=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $difficulty;
        $stmt->execute($data);

        $questions = [];
        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            $questions[] = $rec;
        }

        return $questions;
    }




    /** ある難易度の全問題を取得
     * @param int player_ID
     * @param int difficulty
     * @return  array questions
     */
    public function getAllQuestionsForDifficultyInSignin($player_ID, $difficulty)
    {
        $questions = [];
        $sql = 'SELECT q.id, q.title c.players_ID FROM questions_list q
                left OUTER JOIN comp_questions_list c ON q.id = c.questions_ID
                WHERE q.is_deleted=0 AND q.difficulty=? AND players_ID!=?
                ORDER BY q.title';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $difficulty;
        $data[] = $player_ID;
        $stmt->execute($data);

        $questions = [];
        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            $questions[] = $rec;
        }

        $sql = 'SELECT q.id, q.title c.players_ID FROM questions_list q
                left OUTER JOIN comp_questions_list c ON q.id = c.questions_ID
                WHERE q.is_deleted=0 AND q.difficulty=? AND players_ID=?
                ORDER BY q.title';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            $questions[] = $rec;
        }

        return $questions;
    }




    /** 問題を取得
     * @param array question_id
     * @return  array
     */
    public function getQuestion($question_id)
    {
        $sql = 'SELECT id, title, difficulty, before_png, after_png FROM questions_list WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $question_id;
        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




     /** 答えと解説を取得
     * @param array question_id
     * @return  array
     */
    public function getAnswer($question_id)
    {
        $sql = 'SELECT answer_png, explanation FROM questions_list WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $question_id;
        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /** 問題を削除
     * @param int  ID
     */
    public function deleteQuestion($question_id)
    {
        $sql = 'UPDATE questions_list set is_deleted=1 WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $question_id;
        $stmt->execute($data);
    }



    /** 問題を修正
     * @param int question_id
     * @param varchar title
     * @param int diffiulty
     * @param varchar before_png
     * @param varchar after_png
     * @param varchar answer_png
     * @param varchar explanation
     */
    public function editQuestion($question_id, $title, $difficulty, $before_png, $after_png, $answer_png, $explanation)
    {
        $sql = 'UPDATE questions_list set title=?, difficulty=?, before_png=?, after_png=?, answer_png=?, explanation=? WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $title;
        $data[] = $difficulty;
        $data[] = $before_png;
        $data[] = $after_png;
        $data[] = $answer_png;
        $data[] = $explanation;
        $data[] = $question_id;
        $stmt->execute($data);
    }



    /** ファイルをTempフォルダにアップロードする
     * @param array : file
     * @param  : name
     *  Tempフォルダの場所：img/temp
     * @return bool
     */
    public static function uploadFileToTemp ($file, $name)  // 親classを継承($this->)していない場合は、static
    {
        // ファイルでない時
        if( $file['size'] == 0 ) {
            $_SESSION['err']['question']['after'] =  "ファイルをアップロードできません。1";
            return false;
        } 

        // Tempフォルダの場所
        $uploads_dir = '../../../img/temp/';

        // Tempフォルダが存在しない場合は、Tempフォルダを作成する
        if (file_exists($uploads_dir) == false) mkdir($uploads_dir, 0777, true);

        // ファイルに異常がない場合
        if ($file['error'] == 0) {
          // 移動に成功した場合
          if (move_uploaded_file($file["tmp_name"], $uploads_dir.'/'.$name))  return true;
        }
        return false;
    }
  }
?>
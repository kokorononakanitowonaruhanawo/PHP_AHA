<?php
  require_once('sql_parent.php');

  class compListModel extends BaseModel {

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct();    //親クラスのコンストラクタを呼び出す
    }


    /**
     * デストラクタ
     */
    public function __destruct() {
        parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    /** 解いた問題にcheck
     * @param int $player_ID
     * @param int $questions_ID
     * @return array  completed_question
     */
    public function checkCompQuestion ($player_ID, $questions_ID)
    {
        $sql = 'INSERT INTO comp_questions_list player_ID, questions_ID VALUES(?, ?)';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data = $player_ID;
        $data = $questions_ID;

        $stmt->execute($data);
      }





  }
?>
<?php
  require_once('sql_parent.php');

  class playersModel extends BaseModel {

    /** コンストラクタ */
    public function __construct()
    {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }


    /** デストラクタ*/
    public function __destruct()
    {
        parent::__destruct();   //親クラスのデストラクタを呼び出す
    }





    /** sign in Check
     * @param string $name
     * @param string $non_hash_pass
     * @return int 
     */
    public function signInCheck($name, $non_hash_pass) : int
    {
        $sql = 'SELECT ID, password FROM players_list WHERE is_deleted=0 AND player=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $name;
        $stmt->execute($data);
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        //認証処理
        if(password_verify($non_hash_pass, $rec['password']))  return $rec['ID'];

        return 0;
      }




    /** player登録
     *  @param string $player_name
     *  @param string $non_hash_pass
     *  @return bool true → 登録成功、false → 登録済み
     */
    public function registerPlayer ($player_name, $non_hash_pass) : bool
    {
        //登録者がいるか
        $hash_pass = password_hash($non_hash_pass, PASSWORD_DEFAULT);
        if ($this->isPlayer($player_name, $hash_pass) == true) return false;

        //登録作業
        $sql = 'INSERT INTO players_list (player, password) VALUES(?, ?)';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $player_name;
        $data[] = $hash_pass;
        $stmt->execute($data);
        return true;
    }




    /** player変更
     *  @param string $player_name
     *  @param string $non_hash_pass
     *  @return bool true → 変更成功、false → 登録済み
     */
    public function changePlayer ($player_id, $player_name, $non_hash_pass) : bool
    {
        //登録者がいるか
        $hash_pass = password_hash($non_hash_pass, PASSWORD_DEFAULT);

        if ($this->isPlayer($player_name, $hash_pass) == true) return false;

        //登録作業
        $sql = 'UPDATE players_list set player=?, password=? WHERE is_deleted=0 AND id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $player_name;
        $data[] = $hash_pass;
        $data[] = $player_id;
        $stmt->execute($data);
        return true;
    }




    /** player削除  (is_deleted=1 とする)
     * @param int $player_id
     */
    public function deletePlayer ($player_id) : void
    {
        $sql = 'UPDATE players_list set is_deleted=1 WHERE is_deleted=0 AND ID=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $player_id;
        $stmt->execute($data);
    }





    /** 既に登録者がいるが確認
     * @param string $player_name
     * @param string $hash_pass
     * @return bool false → 登録なし、true → 登録済み
     */
    public function isPlayer ($player_name, $hash_pass) : bool
    {
        $sql = 'SELECT ID FROM players_list WHERE is_deleted=0 AND (player=? OR password=?)';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data = $player_name;
        $data = $hash_pass;

        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            else {
                unset ($_SESSION['err']['isPlayer']);
                $_SESSION['err']["signUp"]['accident'] = "既に使用されています";
                return true;
            }
        }
        return false;
    }




    /**全player(is_deleted=0のみ)を取得
     * 
     */
    public function getAllPlayers ()
    {
        $players = [];

        //テーブル名とカラム名には「別名」をつけることができる。(toto_itemsには「i」という別名をつけて、usersには「u」という別名をつけている)
        //sqlは必要最小限で出力する
        $sql = 'SELECT ID, player FROM players_list where is_deleted=0 order by player';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            $players[] = $rec;
        }

        return $players;
    }

  }
?>
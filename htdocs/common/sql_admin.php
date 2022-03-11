<?php
  require_once('sql_parent.php');

  class adminModel extends BaseModel {

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



    /** 既に登録者がいるが確認
     * @param string $player_name
     * @param string $hash_pass
     * @return bool false → 登録なし、true → 登録済み
     */
    public function isAdmin ($admin_name, $hash_pass) : bool
    {
        $sql = 'SELECT ID FROM admin WHERE is_deleted=0 AND (admin=? OR password=?)';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data = $admin_name;
        $data = $hash_pass;

        while (TRUE)
        {
            $rec = [];
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == FALSE) break;
            else
            {
                unset ($_SESSION['err']['isAdmin']);
                $_SESSION['err']["signUp"]['accident'] = "既に使用されています";
                return true;
            }
        }
        return false;
    }




    /** player登録
     *  @param string $player_name
     *  @param string $non_hash_pass
     *  @return bool true → 登録成功、false → 登録済み
     */
    public function registerAdmin ($admin_name, $non_hash_pass) : bool {
      //登録者がいるか
      $hash_pass = password_hash($non_hash_pass, PASSWORD_DEFAULT);
      if ($this->isAdmin ($admin_name, $hash_pass) == true) return false;

      //登録作業
      $sql = 'INSERT INTO admin (admin, password) VALUES(?, ?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $admin_name;
      $data[] = $hash_pass;
      $stmt->execute($data);
      return true;
    }





    /** sign in Check
     * @param string $name
     * @param string $non_hash_pass
     * @return int 
     */
    public function signInCheck($admin_name, $non_hash_pass) : int {
      $sql = 'SELECT ID, password FROM admin WHERE is_deleted=0 AND admin=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $admin_name;
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      //認証処理
      if(password_verify($non_hash_pass, $rec['password']))  return $rec['ID'];

      return 0;
    }

  }
?>
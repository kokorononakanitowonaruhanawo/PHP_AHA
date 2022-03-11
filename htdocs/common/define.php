<?php
    /** Database接続関連 */
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'AHA');
    define('DB_USER', 'root');
    //define('DB_PASS', '');   //for windows
    define('DB_PASS', 'root');   //for mac


    /** エラーリクエスト関連 */
    define('MSG_ERR', '%sに誤りがあります。');
    define('MSG_EXCEPTION', '申し訳ございません、エラーが発生しました。');

    
    /** サニタイズ
     * @param array $before サニタイズしたいデータ
     * 返り値   ：  サニタイズ完了したデータ
     */
    function sanitize($before)
    {
        $after=[];
        foreach($before as $key => $value){
        $after[$key]=htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $after;
    }




    function count_file($path)
    {
        $files = scandir($path);
        $count = 0;
        foreach ($files as $file){
        if (is_file($path . $file) == true){
        $count++;
        }
        }
        return ($count);
    }

?>
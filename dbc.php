<?php
require_once('env.php');
function dbConnect()
{
    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $port = DB_PORT;
    $dsn = "mysql:dbname=$dbname;port=$port;host=$host;charset=utf8";
    try {
        $pdo = new \PDO($dsn, $user, $pass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    };
    return $pdo;
}


/**
 *ファイルを保存する
 *@param string $filename ファイル名
 *@param string $save_path　保存先のパス
 *@param string $caption　投稿の説明
 *@return bool $result 
 */
function fileSave($filename, $save_path, $caption)
{
    $result = False;

    $sql = "INSERT INTO file_table (file_name,file_path,description)VALUE(?,?,?)";
    try {
        $stmt = dbConnect()->prepare($sql);
        $stmt->bindValue(1, $filename);
        $stmt->bindValue(2, $save_path);
        $stmt->bindValue(3, $caption);
        $result = $stmt->execute();
        return $result;
    } catch (\Exception $e) {
        echo$e->getMessage();
        return $result;
    }
}
/**
 *ファイルデータを取得
 *@return array $fileData 
 */
function getAllFile()
{
    $sql ="SELECT * FROM file_table";
    $fileData=dbConnect()->query($sql);
    return $fileData;

}
/**
 * XSS対策：エスケープ処理
 * @param string $str 対象の文字列
 * @return string 処理された文字列
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES,"UTF-8");
}

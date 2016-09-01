<?php
/*
 * PDO作成
 */
class PdoWrapper
{
    protected $pdo;
    /**
     * PDOを作成
     * @param string dbname
     * @param string host
     * @param string dbuser
     * @param string password
     * @return bool
     */
    public function __construct($dbname, $host, $dbuser, $password, $port = 3306)
    {
        date_default_timezone_set('Asia/Tokyo');
        try {
            $dbinfo = sprintf('mysql:host=%s;port=%s;dbname=%s', $host, $port, $dbname);

            $pdo = new PDO($dbinfo, $dbuser, $password);
            $pdo->query('SET NAMES utf8');
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
        $this->pdo = $pdo;
    }

    /**
     * SQL実行
     * @param string $query
     * @return result
     */
    public function executeQuery($query)
    {
        $stmt = $this->pdo->query($query);
        if (!$stmt) {
            $info = $this->pdo->errorInfo();
            exit($info[2]);
        }

        return $stmt;
    }
}


$importPdo = new PdoWrapper('adoptimizer' ,'database', 'hoge', 'fuga', 3306);

$table = 'tag';
$countQuery = 'SELECT * FROM '.$table.' WHERE id;';
$result = $importPdo->executeQuery($countQuery);


while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row);
}

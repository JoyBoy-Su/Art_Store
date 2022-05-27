<?php
/**
 * 定义一个工具类用来操作数据库
 * 利用PDO来连接并操作数据库
 */
class DBUtil {

    // 数据库连接信息
    private $url = "mysql:host=localhost;dbname=art";
    private $username = "root";
    private $password = "@Sjd20030903";
    private $connection = null;

    // 构造函数，建立与数据库的连接
    public function __construct() {
        try {
            // pdo连接
            $this->connection = new PDO($this->url, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "conn_error:<br/>" . $e -> getMessage();
        }
    }

    // 执行查询语句
    public function query($sql, ...$params) {
        return $this->getResult($sql, $params);
    }

    // 执行数组查询语句
    // 执行查询语句
    public function queryByArray($sql, $arr) {
        return $this->getResult($sql, $arr);
    }

    public function update($sql, ...$params) {
        try {
            // 对数据库进行增删改操作
            // 预编译
            $statement = $this->connection->prepare($sql);
            // 填充占位符
            for ($i = 0; $i < count($params); $i++) {
                $statement->bindValue($i + 1, $params[$i]);
            }
            // 添加
            $statement->execute();
        } catch (PDOException $e) {
            echo "conn_error:<br/>" . $e -> getMessage();
        }
    }

    public function __destruct() {
        // 关闭数据库连接
        $this->connection = null;
    }

    /**
     * @param $sql
     * @param $arr
     * @return array
     */
    public function getResult($sql, $arr)
    {
        try {
            // 预编译
            $statement = $this->connection->prepare($sql);
            // 填充占位符
            for ($i = 0; $i < count($arr); $i++) {
                $statement->bindValue($i + 1, $arr[$i]);
            }
            // 查询
            $statement->execute();
            $result = array();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);   //将每一条数据添加到结果集
            }
            // 返回结果集
            return $result;
        } catch (PDOException $e) {
            echo "conn_error:<br/>" . $e->getMessage();
        }
        return $result;
    }
}
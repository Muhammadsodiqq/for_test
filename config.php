<?php

class Database
{
    private $host = 'localhost';
    private $root = 'root';
    private $password = '';
    private $db = "test";
    public PDO $pdo;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;";
            $this->pdo = new PDO($dsn, $this->root, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getRows($page, $limit, $orderColumn, $orderType)
    {
        $starting_limit = ($page - 1) * $limit;
        $query = "SELECT * FROM `persons`
         ORDER BY $orderColumn $orderType
         LIMIT $starting_limit,$limit
          ";
        $query2 = "SELECT count(*) FROM persons";

        $r = $this->pdo->prepare($query);
        $r->execute();
        $query2 = $this->pdo->query($query2);
        $total_results = $query2->fetchColumn();
        $total_pages = ceil($total_results / $limit);
        $data = $r->fetchAll(PDO::FETCH_ASSOC);

        return ([
            "data" => $data,
            'total_pages' => $total_pages,
            'count' => $total_results,
            "query2"=>$query2
        ]);
    }

    public function getFiltered($id, $first_name, $last_name, $email, $birth_date, $to_date, $status)
    {

        $query = "SELECT * FROM `persons` WHERE ( `first_name` LIKE '%$first_name%' 
                AND `last_name` LIKE '%$last_name%'
                AND `email` LIKE '%$email%' 
                AND `id` LIKE '%$id%'
                AND `status` LIKE '%$status%' ) 
                AND `birth_date` = '$birth_date' 
                ";

        if($birth_date && $to_date) {
            $search = "AND `birth_date` = '$birth_date'";
            $replace = "AND `birth_date` BETWEEN '$birth_date' AND '$to_date'";
            $query = str_replace($search,$replace,$query);
        }elseif(!$birth_date) {
            $search ="AND `birth_date` = '$birth_date'";
            $replace = "";
            $query = str_replace($search,$replace,$query);
        }


        $r = $this->pdo->prepare($query);
        $r->execute();
        $data = $r->fetchAll(PDO::FETCH_ASSOC);

        return ([
            "data" => $data,
        ]);
    }
}


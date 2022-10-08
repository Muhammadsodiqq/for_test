<?php

require 'config.php';
$db = new Database();

$page = $_GET['page'] ??1;
$limit = $_GET['limit'] ?? 10;
$id = $_GET['id'] ?? "";
$first_name = $_GET['first_name'] ?? "";
$last_name = $_GET['last_name'] ?? "";
$email = $_GET['email'] ?? "";
$birth_date = $_GET['birth_date']??"";
$to_date = $_GET['to_date'] ?? "";
$status = $_GET['status'] ?? "";

$filteredData = $db->getFiltered($id, $first_name, $last_name, $email, $birth_date, $to_date, $status);



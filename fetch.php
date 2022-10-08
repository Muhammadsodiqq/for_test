<?php

require 'config.php';
$db = new Database();
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;
$column = $_GET['column'] ?? "id";
$order = $_GET['order'] ?? "ASC";

$data = $db->getRows($page, $limit, $column, $order);

<?php
$homepage_url="http://localhost/api/";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$r_per_page = 10;
$record_num = ($records_per_page * $page) - $records_per_page;

<?php 
require_once "./config/parameters.php";
require_once "./config/db.php";

require_once "./Request.php";
require_once "./Run.php";

require_once "./views/layouts/head.php";

Run::Exce(new Request($_GET["url"]));

require_once "./views/layouts/head.php";



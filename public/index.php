<?php

if (!session_id()) { //jika tidak ada session id maka jalankan session start
    session_start();
}
require_once '../app/init.php';
$app = new App;

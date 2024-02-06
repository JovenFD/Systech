<?php

include '../initialize.php';


$logout = new Login();
echo json_encode($logout->logout());

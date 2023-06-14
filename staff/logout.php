<?php
session_start();
session_destroy();
header("Location: ../?log=loggedout");
exit();

?>
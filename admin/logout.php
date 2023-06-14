<?php
session_start();
session_destroy();
header("Location: index.php?log=loggedout");
exit();

?>
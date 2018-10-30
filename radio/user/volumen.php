<?php
session_start();
if(isset($_GET["v"])){
    $actual_v = intval($_GET["v"]);
}
if($_GET["action"] == "set"){
    $_SESSION["volumen"] = $actual_v;
    echo $actual_v;
} 
else if($_GET["action"] == "get"){
    echo $_SESSION["volumen"];
}

?>
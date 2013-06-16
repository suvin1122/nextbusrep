<?php

if (isset($_COOKIE["haltlist"])) {
    $haltck = $_COOKIE['haltlist'];
    $haltck = explode(",", $haltck);
    print_r($haltck);
    ?>

    <script>  document.cookie = "haltlist" + '=; Max-Age=0' </script> 
    <script>  document.cookie = "retlink" + '=; Max-Age=0' </script> 
<?php }
//else{
//     header("Location: ../index.php");
//    } ?>
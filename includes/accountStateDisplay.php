<?php
    if($user['accountState'] == 1){
        echo "Active";
    }
    else if($user['accountState'] == 2){
        echo "Disabled";
    }
    else{
        echo "Awaiting Verification";
    }
 ?>
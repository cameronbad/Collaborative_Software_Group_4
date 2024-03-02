<?php
    if($user['accountState'] == 1){
        echo "Active";
    }
    else if($user['accountState'] == 0){
        echo "Disabled";
    }
    else{
        echo "Awaiting Verification";
    }
 ?>
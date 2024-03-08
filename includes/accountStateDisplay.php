<?php
    if($accountState == 1){
        echo "Active";
    }
    else if($accountState == 0){
        echo "Disabled";
    }
    else{ //Field is left null meaning they havent been verified
        echo "Awaiting Verification";
    }
 ?>
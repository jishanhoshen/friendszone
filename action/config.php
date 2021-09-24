<?php
$conn = new mysqli("77.247.126.152","dreamcre_chatapp","V6TZR)oGwXjm","dreamcre_chatapp");
// $conn = new mysqli("localhost","jishan2","12345","friendszone");
if($conn->connect_error){
    die("connection Error" . $conn->connect_error);
}
function arrayshorting($thearray, $shortby)
{
    for ($i = 0; $i < count($thearray); $i++) {
        for ($j = 0; $j < count($thearray); $j++) {
            if (($j + 1) > count($thearray) - 1) {
            } else {
                if ($thearray[$j][$shortby] < $thearray[$j + 1][$shortby]) {
                    $temp = $thearray[$j];
                    $thearray[$j] = $thearray[$j + 1];
                    $thearray[$j + 1] = $temp;
                }
            }
        }
    }
    return $thearray;
}
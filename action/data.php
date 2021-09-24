<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$output = "";
// $sql = "
//     SELECT
//     CASE
//         WHEN incoming_msg_id = {$outgoing_id} THEN outgoing_msg_id
//         WHEN outgoing_msg_id = {$outgoing_id} THEN incoming_msg_id
//     END AS friend
//     FROM messages
//     WHERE
//         incoming_msg_id = {$outgoing_id} || outgoing_msg_id = {$outgoing_id}
//     GROUP BY friend
//     ORDER BY createdAt ;
//     ";
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY users_id DESC";
$data = [];
$query = $conn->query($sql);
if($query){
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            // $lastmessage = "
            //     SELECT
            //         msg_id,
            //         incoming_msg_id,
            //         outgoing_msg_id,
            //         msg,
            //         createdAt AS messagetime,
            //         fname,
            //         lname,
            //         img,
            //         status
            //     FROM messages 
            //     LEFT JOIN users ON users.unique_id = {$row['friend']}
            //     WHERE (incoming_msg_id = {$row['friend']}
            //     OR outgoing_msg_id = {$row['friend']})  AND (outgoing_msg_id = {$outgoing_id} 
            //     OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1
            // ";
            $lastmessage = "
                SELECT
                    msg_id,
                    incoming_msg_id,
                    outgoing_msg_id,
                    msg,
                    createdAt AS messagetime,
                    fname,
                    lname,
                    img,
                    status
                FROM messages 
                LEFT JOIN users ON users.unique_id = {$row['unique_id']}
                WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']})  AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1
            ";
            $query2 = $conn->query($lastmessage);
            if($query2){
                if ($query2->num_rows > 0) {
                    while ($row2 = $query2->fetch_assoc()) {
                        $newrow = $row2;
                        $newrow['unique_id'] = $row['unique_id'];
                        array_push($data, $newrow);
                    }
                }
            }else{
                echo '<div class="content"><p class="nofriends">Something went wrong</p></div>';
            } 
        }
    }else{
        echo '<div class="content"><p class="nofriends">No Friends Are Available</p></div>';
    }  
}else{
    echo '<div class="content"><p class="nofriends">Something went wrong</p></div>';
}  
$shortData = arrayshorting($data, "msg_id");

for ($k = 0; $k < count($shortData); $k++) {
    if(isset($shortData[$k]['outgoing_msg_id'])){
        ($outgoing_id == $shortData[$k]['outgoing_msg_id']) ? $you = "You: " : $you = "";
    }else{
        $you = "";
    }
    ($shortData[$k]['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    $output .= '<a href="chat.php?user_id=' . $shortData[$k]['unique_id'] . '">
                <div class="content">
                <img src="../assets/images/users/' . $shortData[$k]['img'] . '" alt="">
                <div class="details">
                    <span>' . $shortData[$k]['fname'] . " " . $shortData[$k]['lname'] . '</span>
                    <p>' . $you . $shortData[$k]['msg'] . '</p>
                </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
echo $output;
<?php

session_start();
if (isset($_POST['submit']))  
{

    include 'db.inc.php' ;

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (empty($uid) || empty($pwd)) {
        header("Location: index.html?login=empty");
        exit();

    } else {
        $sql = "SELECT * FROM stud_login WHERE Stud_uid='$uid' OR Stud_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: index.html?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                $hashedPwdCheck = password_verify($pwd, $row['Stud_pwd']);
                if ($hashedPwdCheck == false) {
                    header("Location: index.html?login=error");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    $_SESSION['u_id'] = $row['Stud_id'];
                    $_SESSION['u_name'] = $row['Stud_name'];
                    $_SESSION['u_email'] = $row['Stud_email'];
					$_SESSION['u_sap'] = $row['Stud_sap'];
                    $_SESSION['u_uid'] = $row['Stud_uid'];
                    header("Location: index.html?login=success");
                    exit();

                }

            }
        }
    }

} else {
    header("Location: ../index.php?login=error");
    exit();

}
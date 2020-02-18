<?php
	
	if(isset($_POST{'submit'}))
	{
		include_once 'db.inc.php';
		
		$email =  mysqli_real_escape_string($conn,$_POST['email']);
		$pwd =  mysqli_real_escape_string($conn,$_POST['pwd']);
		$name =  mysqli_real_escape_string($conn,$_POST['name']);
		$sap =  mysqli_real_escape_string($conn,$_POST['sap']);
		$uid =  mysqli_real_escape_string($conn,$_POST['uid']);
		
		if(empty($email) || empty($pwd) || empty($name) || empty($sap) || empty($uid))
		{	
			header("Location: signup.php?signup=empty");
			exit();
		}
		else
		{
			if(!preg_match("/^[a-zA-Z\s]*$/", $name))
			{
				header("Location: signup.php?signup=invalid_name");
				exit();
			}
			else
			{echo"hi";
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					header("Location: signup.php?signup=email");
					exit();
				}
				else
				{
					$sql= "SELECT * FROM stud_login WHERE Stud_uid='$uid'";
					$result = mysqli_query($conn, $sql);
					$resultCheck= mysqli_num_rows($result);
					if($resultCheck > 0)
					{
						header("Location: signup.php?signup=username_taken");
						exit();
					}
					else
					{
						
						$hashedPwd= password_hash($pwd,PASSWORD_DEFAULT);
						$sql="INSERT INTO stud_login (Stud_email,Stud_pwd,Stud_name,Stud_sap,Stud_uid) VALUES ('$email','$hashedPwd','$name','".$sap."','$uid');";
						mysqli_query($conn, $sql);
						header("Location: signup.php?signup=Success");
						exit();
					}
				}
			}
		}
	}
else
{
	header("Location: /signup.php");
	exit();
}
?>

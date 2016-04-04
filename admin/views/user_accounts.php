<html>
<body>
<h1> User Accounts information </h1>
<table style= "width:80%">
	<tr> 
		<td> User Id </td>
		<td> User Name </td>
		<td> User Email </td>
		<td> Administrator status </td>
		<td> Delete account </td>
		<td> Block user</td>
	</tr>
<?php $result = $admin->ShowUserAccounts();


 while ($row = $result->fetch_assoc()) {
 		echo '<tr>';
 		echo '<td>'.$row['user_id'].'</td>';
 		echo '<td>'.$row['user_name'].'</td>';
 		echo '<td>'.$row['user_email'].'</td>';
 		echo '<td>';
 		if($admin->isAdmin($row['user_privilege'])==true) 
 			echo "Yes";
 		else 
 			echo "No";
 		echo '</td>';
 		
 		}
 		
 		
    ?>

</body>
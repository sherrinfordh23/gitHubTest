<?php 
    if(isset($_REQUEST["submit"]))
    {
        echo "this works";
        $submit=$_REQUEST["submit"];
        if($submit=="id")
            header("Location: FindById.php");
        elseif($submit=="groupId")
            header("Location: FindByGroupId.php");
        elseif($submit=="allStudents")
            header("Location: FindAllStudents.php");
        
    }

?>

<!DOCTYPE HTML>
<html>
	<head>
		<style>
		 
		  body{
		      text-align:center;
		  }
		  button{
		      width:150px;
		  }
		</style>
	</head>

	<body>
		<h2>Find Students</h2>
	
		<form action="#" method="get" id="form">
    		<button name="submit" type="submit" value="id">Find by id</button><br/><br/>
    		<button name="submit" type="submit" value="groupId">Find by Group id</button><br/><br/>
    		<button name="submit" type="submit" value="allStudents">Find all Students</button><br/><br/>
		</form>
	</body>

</html>
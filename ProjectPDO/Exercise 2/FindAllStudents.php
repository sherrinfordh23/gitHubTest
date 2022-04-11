<?php
require_once 'dbConfig.php';
require_once 'Student.cls.php';

$connection=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);

$student = new Student();
$listOfStudents = unserialize($student->getAllStudents($connection));
$student->displayStudents($listOfStudents);


if(isset($_REQUEST["submit"]))
    header("Location: HomePage.php");

?>

<!DOCTYPE HTML>
<html>

	<body>
		<br/><br/>
		<form action="#" method="get">
			<button name="submit" type="submit" value="return">Return</button>
		</form>
	</body>
	
</html>
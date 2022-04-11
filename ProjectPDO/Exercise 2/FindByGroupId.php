<?php 
function displayNoValues(){
    require_once 'Student.cls.php';
    
    echo Student::getHeader();
    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    echo Student::getFooter();
}

if(isset($_REQUEST["submit"]))
    header("Location: HomePage.php");
?>

<!DOCTYPE HTML>
<html>

	<body>
		<form>
			Group Id: <input type="text" name="groupId"/>&nbsp;
			<input type="submit" value="Go"/>
		</form><br/><br/>
		
		<?php 
		require_once 'dbConfig.php';
		require_once 'Student.cls.php';
		
		$connection=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);
		
		
		if(isset($_REQUEST["groupId"]))
		{
		    $student=new Student();
		    $student->setGroupId($_REQUEST["groupId"]);
		    $listOfStudents=unserialize($student->getStudentsByGroupId($connection));
		    
		    if(!empty($listOfStudents))
		      $student->displayStudents($listOfStudents);
		    else
		    {
		        if(empty($_REQUEST["groupId"]))
		            echo "<a style='color:red;'>No value entered for Group Id</a>";
		        else 
		            echo "<a style='color:red;'>No Student with Group Id ".$student->getGroupId()."</a>";
		        displayNoValues();
		    }
		}
		else
		    displayNoValues();
		?>
		
		<form>
			<br/><br/>
			<button name="submit" type="submit" value="return">Return</button>
		</form>
		
	</body>

</html>
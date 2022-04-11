
<?php 
function displayNoValues(){
    echo "Name: <input type='text' value=''/><br/><br/>
		  Address: <input type='text' value=''/><br/><br/>
          Photo: <img src='./img/Capture.PNG'><br/><br/>
		  Group: <input type='number'/><br/><br/>
         ";

    echo "
        <table border='1'>
        <tr><th>Course Id</th><th>Course Desc</th></tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        </table>";
}

if(isset($_REQUEST["submit"]))
    header("Location: HomePage.php");

?>



<!DOCTYPE HTML>
<html>
	<body>
		<form action="#" method="get">
    		Student id: <input type="number" name="studentId" id="studentId" />&nbsp;&nbsp;
    		<input type="submit" value="GO" /><br/><br/><br/><br/>
    		
    		<?php 
    		      require_once 'dbConfig.php';
    		      require_once 'Student.cls.php';
    		      
    		      $connection=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);
    		      if(isset($_REQUEST["studentId"]))
    		      {
        		      $student=new Student();
        		      $student->setStudentId($_REQUEST["studentId"]);
        		      
        		      $student=unserialize($student->getStudentById($connection));
        		      if(!empty($student))
        		      {
            		      echo "
                                Name: <input type='text' value='".$student->getLastName()."'/><br/><br/>
                        		Adress: <input type='text' value='".$student->getAddress()."'/><br/><br/>
                        		Photo: <img style='max-width:150px;' src='".$student->getPhoto()."'/><br/><br/>
                        		Group: <input type='number' value=".$student->getGroupId()."><br/><br/>
                               ";
            		      
            		      $listOfCourses=unserialize($student->getCourse($connection));
            		      
            		      echo "
                                <table border='1'>
                		        <tr><th>Course Id</th><th>Course Desc</th></tr>";
            		     
            		      
//                 	      foreach($listOfCourses as $oneRow)
//                 	          echo "<tr><td>".$oneRow[0]."</td><td>".$oneRow[1]."</td></tr>";
                            if($listOfCourses > 0)
                            {
                                foreach($listOfCourses as $oneRow)
                                    echo "<tr><td>".$oneRow[0]."</td><td>".$oneRow[1]."</td></tr>";
                            }
                            else
                                echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
                            

                		  echo "</table>";
        		      }
        		      else{
        		          if(empty($_REQUEST["studentId"]))
        		              echo "<a style='color:red'>No entered value for Student Id</a><br/>";
        		          else
        		              echo "<a style='color:red'>Student Id ".$_REQUEST["studentId"]." not found</a><br/>";
        		          displayNoValues();
        		      }
    		      
    		      }
    		      else
    		          displayNoValues();
    		?>
    		
			<br/><br/>
			<button name="submit" type="submit" value="return">Return</button>
			
		</form>	
	</body>
</html>


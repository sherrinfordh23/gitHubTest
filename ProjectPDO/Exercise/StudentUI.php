
<?php 
    require_once 'dbConfig.php';
    require_once 'Student.cls.php';
    
    $connection=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);
    
    function insertData($connection){
        $studentId=$_REQUEST["studentId"];
        $name=$_REQUEST["name"];
        $address=$_REQUEST["address"];
        $birthDate=$_REQUEST["birthDate"];
        $groupId=$_REQUEST["groupId"];
        $photo=$_REQUEST["photo"];
        
        $student=new Student($studentId, $name, $address, $birthDate, $groupId, $photo);
        $isInserted=$student->create($connection);
        if($isInserted)
            echo "The student with the id ".$student->getStudentId()." has been inserted";
        else{
            $arr=$connection->errorInfo();
            echo $arr[2]."<br/>";
        }
    }
    
    function updateData($connection){
        $studentId=$_REQUEST["studentId"];
        $address=$_REQUEST["address"];
        
        $student=new Student();
        $student->setStudentId($studentId);
        $student->setAddress($address);
        $isUpdated=$student->update($connection);
        
        if($isUpdated)
            echo "The student with the student id ".$student->getStudentId()." has been updated";
        else
        {
            $arr=$connection->errorInfo();
            echo $arr[2]."<br/>";
        }        
    }
    
    function deleteData($connection){
        $studentId=$_REQUEST["studentId"];
        
        $student=new Student();
        $student->setStudentId($studentId);
        $isDeleted=$student->remove($connection);
        
        if($isDeleted)
            echo "The student with the student id ".$student->getStudentId()."  has been deleted";
        else
        {
            $arr=$connection->errorInfo();
            echo $arr[2]."<br/>";
        }
    }
    
?>

<!DOCTYPE HTML>
<html>
	<body>
		<p style="text-align:center;font-size:18px;">Manipulate Student</p>
		
		<form action="" method="get">
			
			Student id: <input type="number" name="studentId" id="studentId" /><br/>
			Name: <input type="text" name="name" id="name" /><br/>
			Address: <input type="text" name="address" id="address" /><br/>
			Birthdate: <input type="date" name="birthDate" id="birthDate" /><br/>
			Group Id: <input type="number" name="groupId" id="groupId" /><br/>
			Photo: <input type="text" name="photo" id="photo" /><br/>
			<br/>
			<input type="submit" name="submit" value="Add" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Update" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Delete" />
		</form>
		
		
		<?php 
		  if(isset($_REQUEST["submit"]))
		  {
		      $command=$_REQUEST["submit"];
		      
		      if($command=="Add")
		          insertData($connection);
		      else if($command=="Update")
		          updateData($connection);
		      else if($command=="Delete")
		          deleteData($connection);
		  }
		  
		?>
		
		
		
	</body>
</html>

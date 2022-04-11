<?php
class Student{
    private $studentId;
    private $lastName;
    private $address;
    private $birthDate;
    private $groupId;
    private $photo;
    
    
    
    function __construct($studentId=null,$lastName=null,$address=null,
        $birthDate=null,$groupId=null,$photo=null){
            $this->studentId=$studentId;
            $this->lastName=$lastName;
            $this->address=$address;
            $this->birthDate=$birthDate;
            $this->groupId=$groupId;
            $this->photo=$photo;
    }
    
    
    /**
     * @return string
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param string $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    
    
    function getAllStudents($connection){
        $cpt=0;
        $sqlStatement="SELECT * FROM student";
        
        foreach($connection->query($sqlStatement) as $oneRow){
            $student = new Student(
                    $oneRow["StudentId"],$oneRow["LastName"],$oneRow["Address"],
                    $oneRow["BirthDate"],$oneRow["GroupId"],$oneRow["Photo"]
                );
            $listOfStudents[$cpt++]=$student;
        }
        
        return serialize($listOfStudents);
    }
    
    
    function getStudentById($connection){
        $sqlStatement="SELECT * FROM student WHERE StudentId=:id";
        $id=$this->studentId;
        $prepare=$connection->prepare($sqlStatement);
        $prepare->bindValue(':id',$id,PDO::PARAM_INT);
        $prepare->execute();
        $list=$prepare->fetchAll();
        $student="";
        
        if(sizeof($list)>0){
            $student=new Student();
            foreach($list as $oneRow){
                $student = new Student(
                    $oneRow["StudentId"],$oneRow["LastName"],$oneRow["Address"],
                    $oneRow["BirthDate"],$oneRow["GroupId"],$oneRow["Photo"]
                    );
            }
            return serialize($student);
        }
    }
    
    function getCourse($connection){
        $sqlStatement="SELECT take_courses.CourseId, CourseDesc FROM take_courses 
                       JOIN course ON take_courses.CourseId = course.CourseId
                       WHERE take_courses.StudentId=:id";
        $id=$this->studentId;
        $prepare=$connection->prepare($sqlStatement);
        $prepare->bindValue(':id',$id,PDO::PARAM_INT);
        $prepare->execute();
        $list=$prepare->fetchAll();
        $cpt=0;
        
        if(sizeof($list)>0){
            foreach($list as $oneRow){
                $listOfCourses[$cpt][0]=$oneRow["CourseId"];
                $listOfCourses[$cpt++][1]=$oneRow["CourseDesc"];
            }
            return serialize($listOfCourses);
        }
    }
    
    function getStudentsByGroupId($connection){
        $sqlStatement="SELECT * FROM student WHERE GroupId=:id";
        $id=$this->getGroupId();
        $prepare=$connection->prepare($sqlStatement);
        $prepare->bindValue(':id',$id,PDO::PARAM_INT);
        $prepare->execute();
        $list=$prepare->fetchAll();
        $cpt=0;
        $listOfStudents=array();
        
        foreach($list as $oneRow){
            $student=new Student();
            $student->setStudentId($oneRow["StudentId"]);
            $student->setLastName($oneRow["LastName"]);
            $student->setAddress($oneRow["Address"]);
            
            $listOfStudents[$cpt++]=$student;
        }
        
        return serialize($listOfStudents);
    }

    
    
    
    public static function getHeader(){
        return "<table border='1'><tr><th>Id</th><th>Name</th><th>Address</th></tr>";
    }
    
    public static function getFooter(){
        return "</table>";
    }
    
    public function __toString(){
        return "<tr><td>$this->studentId</td><td>$this->lastName</td><td>$this->address</td></tr>";
    }
    
    
    public static function displayStudents($listOfStudents){
        echo Student::getHeader();
        foreach($listOfStudents as $oneStudent){
            echo $oneStudent;
        }
        echo Student::getFooter();
    }
    
    
    
}
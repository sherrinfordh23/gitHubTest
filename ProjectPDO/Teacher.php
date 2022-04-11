<?php

class Teacher
{

    private $teacherId;

    private $name;

    private $phone;

    private $email;

    function __construct($teacherId = null, $name = null, $phone = null, $email = null)
    {
        $this->teacherId = $teacherId;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     *
     * @return string
     */
    public function getTeacherId()
    {
        return $this->teacherId;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $teacherId
     */
    public function setTeacherId($teacherId)
    {
        $this->teacherId = $teacherId;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     *
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // --------------------------------- CRUD Methods ---------------------------------
    function create($connection)
    {
        $teacherId = $this->teacherId;
        $name = $this->name;
        $phone = $this->phone;
        $email = $this->email;
        $sqlStatement = "INSERT INTO teacher VALUES($teacherId, '$name', '$phone', '$email')";
        $result = $connection->exec($sqlStatement);
        return $result;
    }

    function update($connection)
    {
        $teacherId = $this->teacherId;
        $phone = $this->phone;
        $sqlStatement = "UPDATE teacher SET phone='$phone' WHERE teacherId=$teacherId";
        $result = $connection->exec($sqlStatement);
        return $result;
    }

    function delete($connection)
    {
        $teacherId = $this->teacherId;
        $sqlStatement = "DELETE FROM teacher WHERE teacherId=$teacherId";
        $result = $connection->exec($sqlStatement);
        return $result;
    }

    function getAllTeachers($connection)
    {
        $cpt = 0;
        $sqlStatement = "SELECT * FROM teacher";

        foreach ($connection->query($sqlStatement) as $oneRow) {
            $teacher = new Teacher();
            $teacher->setTeacherId($oneRow["teacherId"]);
            $teacher->setName($oneRow["name"]);
            $teacher->setPhone($oneRow["phone"]);
            $teacher->setEmail($oneRow["email"]);
            $listOfTeachers[$cpt ++] = $teacher;
        }
        return serialize($listOfTeachers);
    }

    public function __toString()
    {
        $str = "<tr><td>$this->teacherId</td><td>$this->name</td>";
        $str = "$str<td>$this->phone</td><td>$this->email</td></tr>";

        return $str;
    }

    public static function getHeader()
    {
        $str = "<table border='1'>";
        $str = "$str<tr><th>Teacher id</th><th>Name</th><th>Phone</th><th>Email</th></tr>";
        return $str;
    }

    public static function getFooter()
    {
        return "</table>";
    }

    public static function displayTeachers($listOfTeachers)
    {
        echo Teacher::getHeader();
        foreach ($listOfTeachers as $oneTeacher)
            echo $oneTeacher;
        echo Teacher::getFooter();
    }

    public function getTeacherById($connection)
    {
        $sqlStatement = "SELECT * FROM teacher WHERE teacherId=:id";
        $id = $this->teacherId;
        $prepare = $connection->prepare($sqlStatement);
        $prepare->bindValue(':id', $id, PDO::PARAM_INT);
        $prepare->execute();
        $list = $prepare->fetchAll();
        // 1- $listOfTeachers="";
        // $cpt=0;
        $teacher = "";
        if (sizeof($list) > 0) {
            $teacher = new Teacher();
            foreach ($list as $oneRow) {
                $teacher->setTeacherId($oneRow["teacherId"]);
                $teacher->setName($oneRow["name"]);
                $teacher->setEmail($oneRow["email"]);
                $teacher->setPhone($oneRow["phone"]);
                // 2- $listOfTeacher[$cpt++]=$teacher; when you have more than one rows
            }

            return serialize($teacher);
            // 3- return serialize($listOfTeachers);
        }
    }
}
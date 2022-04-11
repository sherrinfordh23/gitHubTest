<?php
class Student{
    private $studentId;
    private $name;
    private $address;
    private $birthDate;
    private $groupId;
    private $photo;
    
    
    function __construct($studentId=null,$name=null,$address=null,
        $birthDate=null,$groupId=null,$photo=null){
            $this->studentId=$studentId;
            $this->name=$name;
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
    public function getName()
    {
        return $this->name;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

    
    public function __toString(){
        
    }
    
    //--------------------------------- CRUD Methods ---------------------------------
    public function create($connection){
        $sqlStatement="INSERT INTO student VALUES($this->studentId,'$this->name','$this->address',
                                           '$this->birthDate',$this->groupId,'$this->photo')";
        $result=$connection->exec($sqlStatement);
        return $result;
    }
    
    public function update($connection){
        $sqlStatement="UPDATE student SET address='$this->address' WHERE studentId=$this->studentId";
        $result=$connection->exec($sqlStatement);
        return $result;
    }
    
    public function remove($connection){
        $sqlStatement="DELETE FROM student WHERE studentId=$this->studentId";
        $result=$connection->exec($sqlStatement);
        return $result;
    }
    
    
    
}
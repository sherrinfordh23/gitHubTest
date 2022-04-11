<?php
require_once 'dbConfig.php';
require_once 'Teacher.php';



try{
    $connection=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);
//     $t1=new Teacher(400,"David","514789761","david@yahoo.com");
//     $isInserted=$t1->create($connection);
//     if($isInserted){
//         echo "The teaher with the id ".$t1->getTeacherId()." has been added successfully!";
//     }
//     else{
//         $arr=$connection->errorInfo();
//         echo $arr[2]."<br/>";
//     }

//     $t2=new Teacher();
//     $t2->setTeacherId("400");
//     $t2->setPhone("4500010201");
//     $isUpdated=$t2->update($connection);
//     if($isUpdated){
//         echo "The teacher with the id ".$t2->getTeacherId()." has been updated successfully.<br/>";
//     }
//     else {
//         $arr=$connection->errorInfo();
//         echo $arr[2]."<br/>";
//     }
    
//     $t3=new Teacher();
//     $t3->setTeacherId("400");
//     $isDeleted=$t3->delete($connection);
//     if($isDeleted){
//         echo "The teacher with the id ".$t3->getTeacherId()." has been successfully deleted.<br/>";
//     }
//     else {
//         $arr=$connection->errorInfo();
//         echo arr[2]."<br/>";
//     }
    
//     $t4=new Teacher();
//     $listOfTeachers=unserialize($t4->getAllTeachers($connection));
//     $t4->displayTeachers($listOfTeachers);
    
    $t5=new Teacher();
    $t5->setTeacherId(100);
    $t5=unserialize($t5->getTeacherById($connection));
    
    if(!empty($t5)){
        echo Teacher::getHeader();
        echo $t5;
        echo Teacher::getFooter();
    }
        
    
}
catch(SQLException $ex){
    echo "Error: $ex<br/>";
}



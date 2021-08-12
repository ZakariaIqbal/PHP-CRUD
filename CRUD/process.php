<?php
session_start();
$mysqli= new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli)); 
$update =false;
$id = 0;
$name ='';
$email='';
    //CRETE
    if (isset($_POST['save'])){
        $name  =$_POST['name'];
        $email =$_POST['email'];
        
        $mysqli-> query("INSERT  INTO DATA(name , email) VALUES('$name','$email ') ") 
        or 
        die ($mysqli->error);
        
        $_SESSION['message']  = 'Record Has Been Saved!';
        $_SESSION['msg_type'] = "success";
        //Redirect to home

        header("location: index.php");


    }
    //DELETE
    if (isset($_GET['delete'])){
        $id =$_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id =$id")  or die(mysqli_error($mysqli));
        $_SESSION['message']  = 'Record Has Been Deleted!';
        $_SESSION['msg_type'] = "danger";
    }

    //EDIT  
    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM data WHERE id = $id") or die(mysqli_error($mysqli));
        //to make sure db exist 
        if ($result->num_rows>0) {    
            $row = $result->fetch_array();
            
            $name =$row['name'];
            $email =$row ['email'];
            $update =true;

        }
    }
    //Update
    if(isset($_POST['update'])){
        $id    = $_POST ['id'];
        $name  =$_POST['name'];
        $email =$_POST['email'];
        $mysqli->query("UPDATE data SET name='$name' ,email='$email' WHERE id =$id")  or die(mysqli_error($mysqli));
        $_SESSION['message']  = 'Record Has Been Updated!';
        $_SESSION['msg_type'] = "warning";
        //Redirect to home

        header("location: index.php");
    }

?>
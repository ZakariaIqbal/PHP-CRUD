<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

</head>
<body>
    <?php require_once 'process.php'; ?>
    <?php //alert 
    if(isset($_SESSION['message'])): ?>
    <div class='alert alert-<?=$_SESSION['msg_type']?>'> 
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    

    <div class="d-flex justify-content-center container">
        <form action="process.php" method="POST">
            <div class="form-group">
            <label>Name</label>
            <input  type="text" 
                    name='name'
                    class="form-control" 
                    value ="<?php echo $name; ?>"
                    placeholder="Enter your name">
                    
            </div>

            <div class="form-group">
                <input type="hidden" name ='id' value="<?php echo $id; ?>">
            <label>E-mail</label>
            <input  type="text"
                    name="email"
                    class="form-control"
                    value ="<?php echo $email; ?>"
                    placeholder='Enter your e-mail'>
            </div>
            
            <div class="form-group">
                <?php if ($update == false ): ?>  
            <button type="submit" name='save' class="btn btn-primary">Save</button>
                <?php else: ?>
            <button type="submit" name='update' class="btn btn-primary">Update</button> 
                    <?php endif; ?>
            </div>
        </form>
    </div>
    <?php
        $mysqli= new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli)); 
        $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli)); 
        // showDB($result ->fetch_assoc());
        // showDB($result ->fetch_assoc());
        // // showDB($result);
        // function showDB($array){
        //     echo'<pre>';
        //     print_r($array);
        //     echo "</pre>";
        //}
    ?>
    
    <div class="d-flex justify-content-center container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
         <?php while($row = $result->fetch_assoc()):?>   
         <tr>
             <td><?php echo $row['name'];  ?></td>
             <td><?php echo $row['email']; ?></td>
             <td>
                 <a href="index.php?edit=<?php echo $row ["id"]; ?>"
                 class="btn btn-info">Edit</a> ||
                 <a href="index.php?delete=<?php echo $row ["id"]; ?>"
                 class="btn btn-danger">Delete</a>
             </td>
         </tr>
        <?php endwhile; ?>
        </table>

    </div>



</body>
</html>
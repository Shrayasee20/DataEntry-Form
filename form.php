<?php
include("connection.php");
?>



<?php
    if(isset($_POST['searchdata']))
    {
       $search = $_POST['search'];

       $query = "SELECT * from idform where id = '$search' ";
       $data = mysqli_query($conn, $query);

       $result = mysqli_fetch_assoc($data);

       //$name = $result['emp_name'];
       //echo $name;
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    
    <title>Data Entry Form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    
</head>
<body>
    <div class="center">
        <form action="#" method="POST">

        <h1>Employee Data Entry Form</h1>

        <div class="form">
            <input type="text" name="search" class="textfield" placeholder="Search ID" 
            value="<?php if(isset($_POST['searchdata'])){echo $result['id'];}?>">

            <input type="text" name="id" class="textfield" placeholder="Employee ID"
            value="<?php if(isset($_POST['searchdata'])){echo $result['emp_id'];}?>">

            <input type="text" name="name" class="textfield" placeholder="Employee Name"
            value="<?php if(isset($_POST['searchdata'])){echo $result['emp_name'];}?>">
            
            <select class="textfield" name="gender">
                <option value="Not Selected">Select Gender</option>
                
                <option value="Male"
                <?php
                if($result['emp_gender'] == 'Male')
                   {
                        echo "selected";
                   }
                ?>
                
                >Male</option>

                <option value="Female"
                <?php
                if($result['emp_gender'] == 'Female')
                   {
                    echo "selected";
                   }
                ?>
                >Female</option>
                
                
                <option value="Other"
                <?php
                if($result['emp_gender'] == 'Other')
                   {
                    echo "selected";
                    }
                ?>
                >Other</option>

            </select>
           
            <input type="text"name="email" class="textfield" placeholder="Email Address" value="<?php if(isset($_POST['searchdata'])){echo $result['emp_email'];}?>">

            
            <select class="textfield" name="department">
                
                <option>Select Department</option>
                
                <option value="IT"
                <?php
                if($result['emp_department'] == 'IT')
                   {
                    echo "selected";
                    }
                ?>
                >IT</option>
                
                <option value="HR"
                <?php
                if($result['emp_department'] == 'HR')
                   {
                    echo "selected";
                    }
                ?>
                >HR</option>
                
                <option value="Sales"
                <?php
                if($result['emp_department'] == 'Sales')
                   {
                    echo "selected";
                    }
                ?>
                >Sales</option>
                
                <option value="Marketing"
                <?php
                if($result['emp_department'] == 'Marketing')
                   {
                    echo "selected";
                    }
                ?>
                >Marketing</option>
                
                <option value="Accounts"
                <?php
                if($result['emp_department'] == 'Accounts')
                   {
                    echo "selected";
                    }
                ?>
                >Accounts</option>
                
                <option value="Business Development"
                <?php
                if($result['emp_department'] == 'Business Development')
                   {
                    echo "selected";
                    }
                ?>
                >Business Development</option>

            </select>

            <textarea placeholder="Address" name="address"><?php if(isset($_POST['searchdata'])){echo $result['emp_address'];}?>
    
            </textarea>

            <input type="submit" value="Search" name="searchdata" class="btn">
            <input type="submit" name="save" value="Save" name="" class="btn" style="background-color: green;">
            <input type="submit" value="Update" name="update" class="btn" style="background-color: orange;">
            <input type="submit" name="delete" value="Delete" name="delete" class="btn" style="background-color: red;" onclick="return checkdelete()">
            <input type="reset" name="clear" value="Clear" name="" class="btn" style="background-color: blue;">
            
        </div>
        </form>
    </div>

</body>
</html>

<script>
    function checkdelete()
    {
        return confirm('Are you sure?');
    }
</script>

<?php
if(isset($_POST['save']))
{
    $empid         = $_POST['id'];
    $name       = $_POST['name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];

    $query = "INSERT INTO idform (emp_id, emp_name, emp_gender, emp_email, emp_department, emp_address) 
    VALUES('$empid','$name','$gender','$email','$department','$address')";
   
    $data = mysqli_query($conn,$query);

    if($data)
    {
        echo "<script> alert('Data saved into Database') </script>";
    }
    else 
    {
        echo "<script> alert('Failed to insert data') </script>";
    }
}
?>



<?php
    
    if(isset($_POST['delete']))
    {
        $id = $_POST['search'];
        
        $query = "DELETE FROM idform WHERE id= '$id' ";
        
        $data = mysqli_query($conn, $query);

        if($data)
        {
            echo "Record deleted";
        }
        else
        {
            echo "Failed to deleted";
        }
    }
?>

<?php
if(isset($_POST['update']))
   {
    $id         = $_POST['search'];
    $empid      = $_POST['id'];
    $name       = $_POST['name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];

    $query = "UPDATE idform SET emp_id ='$empid',emp_name ='$name',emp_gender ='$gender',emp_email ='$email',emp_department ='$department',emp_address ='$address' WHERE id ='$id' ";

       $data = mysqli_query($conn,$query);

    if($data)
    {
        echo "<script> alert('Record Updated') </script>";
    }
    else 
    {
        echo "<script> alert('Failed to Update') </script>";
    }
   }
?>


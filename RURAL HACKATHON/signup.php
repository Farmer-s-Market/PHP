<?php
  $username = $_POST["username"];
  $pass = $_POST["password"];
  $email = $_POST["email"];
  $pn = $_POST["phonenumber"];

  $conn = new mysqli("localhost","root","","rural");

  if($conn->connect_error)
  {
    echo "error";
  }

  $sql1 = "SELECT `username`,`email`,`phonenumber` FROM `signup`;";

  $table = mysqli_query($conn,$sql1);

  $n = mysqli_num_rows($table);

  while($n!=0)
  {
    $row = mysqli_fetch_assoc($table);
    if($row["username"] == $username)
    {
      include("signup.html");
      echo "<script>alert('USERNAME ALREADY EXISTS')</script>";
      die();
    }
    if($row["email"] == $email)
    {
      include("signup.html");
      echo "<script>alert('EMAIL ALREADY EXISTS')</script>";
      die();
    }
    if($row["phonenumber"] == $pn)
    {
      include("signup.html");
      echo "<script>alert('PHONE NUMBER ALREADY EXISTS')</script>";
      die();
    }
    $n-=1;
  }

  $sql2 = "INSERT INTO `signup` (`username`,`password`,`email`,`phonenumber`) VALUES ('$username','$pass','$email','$pn');";

  $sql3 = "CREATE TABLE `$username` (
    `product` VARCHAR(100) NOT NULL,
    `price` VARCHAR(100) NOT NULL,
    `city` VARCHAR(100) NOT NULL
  );";

  if(mysqli_query($conn,$sql2))
  {
    if(mysqli_query($conn,$sql3))
    {
      echo "<script>location.href='login.html'</script>";
    }
    else
    {
      echo "error";
    }
  }
  else
  {
    echo "error";
  }
  mysqli_close($conn);
?>

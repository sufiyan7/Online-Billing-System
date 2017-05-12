<?php
include_once 'dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=$_POST['id'];
$status=$_POST['status'];
$price=$_POST['current'];
$quantity=$_POST['quantity'];
$total_price=$_POST['c'];

if($status=='on'){
  $status='true';
}



$select="SELECT raw_id FROM labour_total WHERE raw_id = '$id'";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);



if($status=='true'){

  //
  if(empty($row)){
    $sql = "INSERT INTO labour_total (raw_id,status,quantity,total_price)
    VALUES ('$id','$status','$quantity','$total_price')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  else{
    $sql = "UPDATE labour_total SET status='$status',quantity='$quantity',total_price='$total_price' WHERE raw_id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


}else if ($status=='false'){

  echo $status;
  $sql = "DELETE FROM labour_total WHERE raw_id = '$id'";

  if ($conn->query($sql) === TRUE) {
      echo "Record Deleted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// $sql = "INSERT INTO labour_total (raw_id,status,quantity,total_price) VALUES ('$id','$status','$quantity','$total_price')";
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

$conn->close();
?>

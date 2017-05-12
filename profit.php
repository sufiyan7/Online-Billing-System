<?php
include_once 'dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id=$_POST['id2'];
$status=$_POST['status2'];
$percent=$_POST['percent2'];



if($status=='on'){
  $status='true';
}


$sql="select sum(t1) as final from (SELECT sum(total_price) as t1 FROM `total` union all select sum(total_price) as t2 from labour_total union all SELECT sum(total_price) as t3 FROM `process_total` union all SELECT sum(total_price) as t4 FROM `overhead_total`)as t";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$table1=$row['final'];
$profit=($table1*$percent)/100;

$select="SELECT id FROM profit_total WHERE id = '$id'";
$result2 = mysqli_query($conn,$select);
$row2 = mysqli_fetch_assoc($result2);


if($status=='true'){

  if(empty($row2)){
    $sql = "INSERT INTO profit_total (id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);

    // if ($conn->query($sql) == TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
  }
  else{
    $sql = "UPDATE profit_total SET status='$status',total_price='$profit' WHERE id='$id'";
    $conn->query($sql);
    // if ($conn->query($sql) == TRUE) {
    //     echo "Update successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
  }

  // $sql = "INSERT INTO profit_total (id,status,total_price) VALUES ('$id','$status','$profit')";
  // $conn->query($sql);
  // if ($conn->query($sql) == FALSE) {
  //   $sql2 = "UPDATE profit_total SET status='$status',total_price='$total_price' WHERE id='$id'";
  //   $conn->query($sql2)
  //   echo "Record Updated successfully";
  // }

  echo $profit;

}elseif ($status=='false'){

  echo $status;
  $sql = "DELETE FROM profit_total WHERE id = '$id'";
  $conn->query($sql);
  if ($conn->query($sql) === TRUE) {
      echo "Record Deleted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


$conn->close();
?>

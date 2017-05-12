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

if($id==1)
{


  $select="SELECT raw_id FROM overhead_total WHERE raw_id = '$id'";
  $result = mysqli_query($conn,$select);
  $row = mysqli_fetch_assoc($result);
  // var_dump($row);
  // echo empty($row[0]);


  if($status=='true'){

    //
    if(empty($row)){
      $sql = "INSERT INTO overhead_total (raw_id,status,quantity,total_price)
      VALUES ('$id','$status','$quantity','$total_price')";
      if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    else{
      $sql = "UPDATE overhead_total SET status='$status',quantity='$quantity',total_price='$total_price' WHERE raw_id='$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Update successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }


  }else if ($status=='false'){

    echo $status;
    $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record Deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

    // $sql = "INSERT INTO overhead_total (raw_id,status,quantity,total_price)
    // VALUES ('$id','$status','$quantity','$total_price')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
}
else if ($id!==1){

  $sql="SELECT SUM(total_price) as td FROM total";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $total1=$row['td'];



    $sql="SELECT SUM(total_price) as td FROM process_total";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $total2=$row['td'];

    $net_total=$total1+$total2;


  if ($id==2){
    $profit=$total2*$price/100;
    if($status=='true'){
      $sql = "INSERT INTO overhead_total (raw_id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);
    echo $profit;

    }elseif ($status=='false'){

      echo $status;
      $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Record Deleted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }


  }elseif($id==3){
    $profit=$net_total*$price/100;
    if($status=='true'){
      $sql = "INSERT INTO overhead_total (raw_id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);
    echo $profit;

    }elseif ($status=='false'){

      echo $status;
      $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Record Deleted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

  }elseif($id==4){
    $profit=$total2*$price/100;
    if($status=='true'){
      $sql = "INSERT INTO overhead_total (raw_id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);
    echo $profit;

    }elseif ($status=='false'){

      echo $status;
      $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Record Deleted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    echo $profit;
  }elseif($id==5){
    $profit=$total2*$price/100;
    if($status=='true'){
      $sql = "INSERT INTO overhead_total (raw_id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);
    echo $profit;

    }elseif ($status=='false'){

      echo $status;
      $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Record Deleted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

  }elseif($id==6){
    $profit=$net_total*$price/100;
    if($status=='true'){
      $sql = "INSERT INTO overhead_total (raw_id,status,total_price) VALUES ('$id','$status','$profit')";
    $conn->query($sql);
    echo $profit;

    }elseif ($status=='false'){

      echo $status;
      $sql = "DELETE FROM overhead_total WHERE raw_id = '$id'";

      if ($conn->query($sql) === TRUE) {
          echo "Record Deleted successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

  }


}


$conn->close();
?>

<?php
include_once 'dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id=$_POST['id3'];
$status=$_POST['status3'];
$percent=$_POST['value'];
// $status=$_POST['status3'];


// $sql="SELECT * FROM tax WHERE id = '$id'";
// $result = mysqli_query($conn,$sql);
// $row = mysqli_fetch_assoc($result);
// echo json_encode($row);

if($status=='on'){
  $status='true';
}









// $sql="select sum(t1) as final from (SELECT sum(total_price) as t1 FROM `total` union select sum(total_price) as t1 from labour_total union SELECT sum(total_price) as t1 FROM `process_total` union SELECT sum(total_price) as t1 FROM `overhead_total`)as t";
$res="select sum(t1) as final from (SELECT sum(total_price) as t1 FROM `total` union all select sum(total_price) as t1 from labour_total union all SELECT sum(total_price) as t1 FROM `process_total` union all SELECT sum(total_price) as t1 FROM `overhead_total` union all SELECT sum(total_price) as t1 FROM `profit_total`)as t";
$result2 = mysqli_query($conn,$res);
$row2 = mysqli_fetch_assoc($result2);
$table1=$row2['final'];
$profit=$table1*$percent/100;
// $profit=30;



if($status=='true'){

if($id==1){
  $sql = "TRUNCATE TABLE tax_total";
  $conn->query($sql);

  // $sql = "INSERT INTO tax_total (id,total_price) VALUES ('$id','$profit')";
  // $conn->query($sql);


 $sql="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id where tax.id = $id";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_assoc($result);
 echo json_encode($row);


}elseif ($id==2){
  $sql = "TRUNCATE TABLE tax_total";
  $conn->query($sql);

  $sql = "INSERT INTO tax_total (id,total_price) VALUES ('$id','$profit')";
  $conn->query($sql);
 // echo "Record 1 Inserted successfully";

 $sql="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id where tax.id = $id";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_assoc($result);
 echo json_encode($row);


}elseif ($id==3){
  $sql = "TRUNCATE TABLE tax_total";
  $conn->query($sql);

  $sql = "INSERT INTO tax_total (id,total_price) VALUES ('$id','$profit')";
  $conn->query($sql);

 $sql="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id where tax.id = $id";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_assoc($result);
 echo json_encode($row);
  // echo "Record 2 Inserted successfully";

}elseif($id==4){
  $sql = "TRUNCATE TABLE tax_total";
  $conn->query($sql);

  $sql = "INSERT INTO tax_total (id,total_price) VALUES ('$id','$profit')";
  $conn->query($sql);
  // echo "Record 3 Inserted successfully";

  $sql="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id where tax.id = $id";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
}

}elseif ($status=='false'){

  echo $status;
  $sql = "TRUNCATE TABLE tax_total";
  $conn->query($sql);
  if ($conn->query($sql) === TRUE) {
      echo "Record Deleted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

//



$conn->close();
?>

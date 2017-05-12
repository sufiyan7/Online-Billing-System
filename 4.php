<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}

?>
<?php
include_once 'dbconfig.php';
if(isset($_POST['quantity']) || !empty($_POST['quantity'])){
$a=$_POST['quantity'];
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Bon Auto Tech</title>


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   </head>

   <body>
<div class="container">
       <div class="row" style="padding-top:6px;">
         <div class="col-lg-6 col-md-6" align="left" >
           <img src="logo.jpg" alt="logo" height="40">
         </div>
         <div class="col-lg-6 col-md-6" align="right" >
           <a class="btn btn-danger btn-sm" href="reset.php" role="button">Reset All</a>
             <!-- <a class="btn btn-primary btn-sm" href="index1.php" role="button">Restore</a> -->
             <a class="btn btn-success btn-sm" href="iherb/skp.php" role="button">Export</a>
               <a href="logout.php" class="btn btn-info btn-sm">
                   <span class="glyphicon glyphicon-log-out"></span> Log out
                 </a>
         </div>
       </div>
       </div>

     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <h3>Miscellaneous</h3>
           <div class="table-responsive">

             <table align="center" class="table table-bordred table-striped">
               <thead>
        			 	<th></th>
                 <th>Title</th>
                 <th>Price</th>
                 <th>Unit</th>
                 <th>Quantity</th>
                 <th>Total Price</th>
               </thead>

               <tbody>
                   <?php
               $sql_query="SELECT labour.id, labour.title, labour.unit, labour.price, labour_total.status, labour_total.quantity, labour_total.total_price FROM `labour` left join labour_total on labour.id=labour_total.raw_id";


							 								// $result_set=mysql_query($sql_query);
							                 // while($row=mysql_fetch_row($result_set))
							                  $result_set=mysqli_query($conn,$sql_query);
							                 while($row=mysqli_fetch_array($result_set))
							                 {
							                  ?>
							                  <tr class="disp-parent">
							                    <td>
							                      <label class="btn btn-default">
							 				                <input type="checkbox" class="sub"  id="<?php echo $row[0]; ?>" <?php if($row[4]!=NULL){ echo "checked";} else { echo "";} ?> >
							 			                </label>
							                    </td>
							                  <td><?php echo $row[1]; ?></td>
							                   <td><input type="number" class="price" value="<?php echo $row[3]?>"></td>
							                  <td><?php echo $row[2]; ?></td>
							                  <td><input type="number" class="quant" name="quantity" value="<?php echo $row[5]?>"></td>


							                   <!-- <td><input type="submit" name="add" value="Add" onclick="javascript:edt_id('<?php echo $row[0]; ?>')"></td> -->
							 									 <td class="total"><?php if($row[5]!=NULL){ echo $row[6];} else { echo "";} ?></td>
							                   </tr>

							                  <?php
							                }
							                ?>
							                </tbody>

							              </table>


           </div>

         </div>

       </div>





			 <div class="row">
         <div class="col-md-12">
           <h3>Profit</h3>
           <div class="table-responsive">

             <table align="center" class="table table-bordred table-striped">
               <thead>
        			 	<th></th>
                 <th>Title</th>
                 <th>Percentage</th>
                 <th>Unit</th>
                 <th hidden>Quantity</th>
                 <th>Total Profit</th>
               </thead>

               <tbody>
                   <?php
									 $sql_query="SELECT profit.id, profit.title, profit.unit, profit.price, profit_total.status, profit_total.total_price FROM `profit` left join profit_total on profit.id=profit_total.id";


							 								// $result_set=mysql_query($sql_query);
							                 // while($row=mysql_fetch_row($result_set))
							                  $result_set=mysqli_query($conn,$sql_query);
							                 while($row=mysqli_fetch_array($result_set))
							                 {
							                  ?>
							                  <tr class="disp-parent2">
							                    <td>
							                      <label class="btn btn-default">
							 				                <input type="checkbox" class="sub2"  id="<?php echo $row[0]; ?>" <?php if($row[5]!=NULL){ echo "checked";} else { echo "";} ?> >
							 			                </label>
							                    </td>
							                  <td><?php echo $row[1]; ?></td>
							                   <td><input type="number" class="price2" value="<?php echo $row[3]?>"></td>
							                  <td><?php echo $row[2]; ?></td>
																<td class hidden><?php echo $row[5]; ?></td>
							                   <!-- <td><input type="submit" name="add" value="Add" onclick="javascript:edt_id('<?php echo $row[0]; ?>')"></td> -->
							 									 <td class="total2"><?php if($row[4]=='true'){ echo $row[5];} else { echo "";} ?></td>
							                   </tr>

							                  <?php
							                }
							                ?>
							                </tbody>

							              </table>
           </div>
         </div>
       </div>





			 <div class="row">
         <div class="col-md-12">
           <h3>Tax</h3>
           <div class="table-responsive">

             <table align="center" class="table table-bordred table-striped">
               <thead>
								 <th></th>
                 <th>Title</th>
                 <th>Percentage</th>
                 <th>Unit</th>
                 <!-- <th hidden>Quantity</th> -->
                 <th>Total Profit</th>
               </thead>

               <tbody>
                   <?php
									 $sql_query="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id";

							                  $result_set=mysqli_query($conn,$sql_query);

							                //  while($row=mysqli_fetch_array($result_set))
							                //  {
							                  ?>
							                  <tr class="disp-parent3">
																	<td>
							                      <label class="btn btn-default">
							 				                <input type="checkbox" class="sub3"  id="tax-check" <?php $select="SELECT * FROM tax_total";
																			$result2 = mysqli_query($conn,$select);
																			$row2 = mysqli_fetch_assoc($result2);
																			if(empty($row2)){ echo "";} else { echo "checked";} ?> >
							 			                </label>

							                  <td>
																	<?php echo '<select class="bootstrap-select" style="border: 1px solid #928b8b;
    padding: 6px 18px;">';
																	// echo '<option value=""></option>';
																while ($row=mysqli_fetch_array($result_set)) {
   															echo '<option  class="select2" value="'.$row['id'].'"';
																if($row['total_price']!=NULL){ $temp=$row['id']; echo "selected";} else { echo "";};
																echo '>';
																echo $row['title'];
																echo '</option>';
																}
																echo '</select>'; ?>
															</td>
							                  <td><input type="number" class="price3" value="<?php  $sql_query="SELECT tax.id, tax.title, tax.unit, tax.price, tax_total.status, tax_total.total_price FROM `tax` left join tax_total on tax.id=tax_total.id WHERE tax.id='$temp'";
						 							      	$result_set=mysqli_query($conn,$sql_query);
																	$row=mysqli_fetch_array($result_set);
																	echo $row['price'];?>"></td>
							                  <td>%</td>
							 									<td class="total3"> <?php echo $row['total_price']; ?></td>
							                   </tr>

							                  <?php
							                // }
							                ?>


							                </tbody>

							              </table>

														<div class="text-center">
							                <ul class="pagination">
							 								 <li ><a href="1.php">1</a></li>
							 							 <li ><a href="2.php">2</a></li>
							 							 <li ><a href="3.php">3</a></li>
							 							 <li class="active"><a href="#">4</a></li>
							               </ul>
							              </div>
           </div>
         </div>
       </div>



     </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="4.js"></script>


   </body>
 </html>

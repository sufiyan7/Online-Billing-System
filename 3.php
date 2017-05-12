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
           <h3>Overhead</h3>
           <div class="table-responsive">

             <table align="center" class="table table-bordred table-striped">
               <thead>
        			 	<th></th>
                 <th>Title</th>
                 <th>Value</th>
                 <th>Unit</th>
                 <th>Quantity</th>
                 <th>Total Price</th>
               </thead>

               <tbody>
                   <?php
               $sql_query="SELECT overhead.id, overhead.title, overhead.unit, overhead.price, overhead_total.status, overhead_total.quantity, overhead_total.total_price FROM `overhead` left join overhead_total on overhead.id=overhead_total.raw_id";

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
							 									 <td class="total" data-id="<?php echo $row[0]; ?>"><?php if($row[4]!=NULL){ echo $row[6];} else { echo "";} ?></td>
							                   </tr>

							                  <?php
							                }
							                ?>
							                </tbody>

							              </table>

														<div class="text-center">
							                <ul class="pagination">
							 								 <li ><a href="1.php">1</a></li>
							 							 <li ><a href="2.php">2</a></li>
							 							 <li class="active"><a href="#">3</a></li>
							 							 <li ><a href="4.php">4</a></li>
							               </ul>
							              </div>


           </div>

         </div>

       </div>



     </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
$('.sub').on('change',function(){

  var id=$(this).parents('.disp-parent').find('.sub').attr('id');
  var status=$(this).parents('.disp-parent').find('.sub').val();


  if(id==1)
  {
		if ($(this).is(':checked')){
		  if($(this).parents('.disp-parent').find('.quant').val()){
		      //if checkbox tick first
		      var quantity=$(this).parents('.disp-parent').find('.quant').val();

		          var current=$(this).parents('.disp-parent').find('.price').val();

		            var sum=current*quantity;
		            var c = parseFloat(current)*parseInt(quantity);
		            $(this).parents('.disp-parent').find('.total').html('<div>'+c+'</div>');

		      formdata={
		        id:id,
		        current:current,
		        status:status,
		        quantity:quantity,
		        c:c,
		      };

		        $.ajax({
		          url: 'overhead.php',
		          type: 'POST',
		          data: formdata,
		          cache:true,
		          success:function(){
		            // console.log(current);
		          }
		        });

		  }else{ //if quantity is added first
		    $('.quant').on('change',function(){
		    var quantity=$(this).parents('.disp-parent').find('.quant').val();

		        var current=$(this).parents('.disp-parent').find('.price').val();

		          var sum=current*quantity;
		          var c = parseFloat(current)*parseInt(quantity);
		          $(this).parents('.disp-parent').find('.total').html('<div>'+c+'</div>');

		    formdata={
		      id:id,
		      current:current,
		      status:status,
		      quantity:quantity,
		      c:c,
		    };

		      $.ajax({
		        url: 'overhead.php',
		        type: 'POST',
		        data: formdata,
		        cache:true,
		        success:function(){
		          // console.log(current);
							location.reload();
		        }
		      });
		    })
		  }

		}else if (!$(this).is(':checked')){
		//for delete on uncheck
		  var status='false';
		  var id=$(this).parents('.disp-parent').find('.sub').attr('id');
		  $(this).parents('.disp-parent').find('.total').html('<div></div>');
		  formdata={
		    id:id,
		    status:status,
		  };

		    $.ajax({
		      url: 'overhead.php',
		      type: 'POST',
		      data: formdata,
		      cache:true,
		      success:function(){
		        // console.log(current);
		      }
		});
		}
  } else
  {
	// $('.sub').on('change',function(){
			if ($(this).is(':checked')){

					var current=$(this).parents('.disp-parent').find('.price').val();
			var percent = parseInt(current);
			// $(this).parents('.disp-parent2').find('.total2').html('<div>'+c+'</div>')
			formdata={
	 			id:id,
	 			current:current,
	 			status:status,
	 			quantity:quantity,
 };

				$.ajax({
					url: 'overhead.php',
					type: 'POST',
					data: formdata,
					cache:true,
					success:function(response) {
									location.reload();


			        }
				});
			}else if(!$(this).is(':checked')){
				//for delete on uncheck
				  var status3='false';
				  var id=$(this).parents('.disp-parent').find('.sub').attr('id');
				  $(this).parents('.disp-parent').find('.totals').html('<div></div>');
				  formdata={
				    id:id,
				    status:status3,
				  };

				    $.ajax({
				      url: 'overhead.php',
				      type: 'POST',
				      data: formdata,
				      cache:true,
				      success:function(){
				        // console.log(current);
								location.reload();
				      }
				});
			}

  //   var current=$(this).parents('.disp-parent').find('.price').val();
  //   var quantity=$(this).parents('.disp-parent').find('.quant').val();
	//
  // // $(this).parents('.disp-parent2').find('.total2').html('<div>'+c+'</div>')
  // formdata={
  //   id:id,
  //   current:current,
  //   status:status,
  //   quantity:quantity,
  // };
	//
  // 	$.ajax({
  // 		url: 'overhead.php',
  // 		type: 'POST',
  // 		data: formdata,
  //     // dataType: 'json',
  // 		cache:true,
  // 		success:function(response) {
	// 						location.reload();
  //         }
  // 	});
// }) //if ends
}
$(".sub").unbind();
})
</script>



   </body>
 </html>

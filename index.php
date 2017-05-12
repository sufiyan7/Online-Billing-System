<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
             <div class="col-lg-6 col-md-6 center-block">
               <a class="btn btn-danger btn-lg center-block" href="reset.php" role="button">Reset</a>
              </div>
              <div class="col-lg-6 col-md-6 center-block">
               <a class="btn btn-primary btn-lg center-block" href="1.php" role="button">Restore</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
    </script>
  </body>
</html>

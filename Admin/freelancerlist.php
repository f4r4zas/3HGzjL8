<?php 

//Check if init.php exists

if(!file_exists('../core/init.php')){

	header('Location: ../install/');        

    exit;

}else{

 require_once '../core/init.php';	

}



//Start new Admin Object

$admin = new Admin();



//Check if Admin is logged in

if (!$admin->isLoggedIn()) {

  Redirect::to('index.php');	

}

?>

<!DOCTYPE html>

<html lang="en-US" class="no-js">



    <!-- Include header.php. Contains header content. -->

    <?php include ('template/header.php'); ?>

  

<body class="skin-green sidebar-mini">

     

     <!-- ==============================================

     Wrapper Section

     =============================================== -->

	 <div class="wrapper">

	 	

        <!-- Include navigation.php. Contains navigation content. -->

	 	<?php include ('template/navigation.php'); ?> 

        <!-- Include sidenav.php. Contains sidebar content. -->

	 	<?php include ('template/sidenav.php'); ?> 

	 	

	  <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1><?php echo $lang['freelancer']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo $lang['freelancer']; ?> <?php echo $lang['list']; ?></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">	 	

		    <!-- Include currency.php. Contains header content. -->

		    <?php include ('template/currency.php'); ?>  

		 <div class="row">	

		 	<div class="col-md-12">

		 		

		 		<div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['freelancer']; ?> <?php echo $lang['list']; ?></h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

					   <!--<th><?php echo $lang['image']; ?></th>-->

					   <th><?php echo $lang['name']; ?></th>

					   <th><?php echo $lang['email']; ?></th>
                       
                       <th><?php echo $lang['phone']; ?></th>

					   <th>Sign-up date</th>
                       
                       <th>Location</th>

					   <th><?php echo $lang['active']; ?></th>

					   <th><?php echo $lang['action']; ?></th>

                      </tr>

                    </thead>

                    <tbody>

				    <?php

                     $query = DB::getInstance()->get("freelancer", "*", ["AND" => ["delete_remove" => 0]]);

                     if($query->count()) {

						foreach($query->results() as $row) {

							

                        if(!$row->active == 1):

					    $mark = '

					    <a id="' . escape($row->id) . '" class="btn btn-info btn-xs" data-toggle="tooltip" title="' . $lang['activate'] . '"><span class="fa fa-check-square"></span></a>';

						else:

					    $mark = '<a id="' . escape($row->id) . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="' . $lang['deactivate'] . '"><span class="fa fa-close"></span></a>';

						endif;			

										

					    echo '<tr>';

					    //echo '<td><img src="../freelancer/'. escape($row->imagelocation) .'" width="50" height="30" /></td>';

					    echo '<td><a href="../freelancer.php?a=overview&id='. escape($row->freelancerid) .'" target="_blank">'. escape($row->name) .'</a></td>';

					    echo '<td>'. escape($row->email) .'</td>';
                        
                        echo '<td>'. escape($row->phone) .'</td>';

					    echo '<td>'. date('m-d-Y H:i:s',strtotime($row->joined)) .'</td>';
                        
                        $query1 = DB::getInstance()->get("profile", "*", ["AND" => ["userid" => $row->freelancerid]]);
                        $query1_result = $query1->results();
                        
                        echo '<td>'. escape($query1_result[0]->location) .'</td>';

					    if (escape($row->active) == 1) {

					    echo '<td><span class="label label-success"> ' . $lang['active'] . ' </span> </td>';

						} else {

					    echo '<td><span class="label label-success"> ' . $lang['in_active'] . ' </span> </td>';

						}

					    echo '<td>

					      '.$mark.'

					      <a href="editfreelancer.php?a=data&id=' . escape($row->freelancerid) . '" class="btn btn-success btn-xs" data-toggle="tooltip" title="' . $lang['edit'] . '"><span class="fa fa-edit"></span></a>

					      <a id="' . escape($row->id) . '" class="btn btn-danger btn-xs" data-toggle="tooltip" title="' . $lang['delete'] . '"><span class="fa fa-trash"></span></a></td>';

					    echo '</tr>';

					   }

					}else {

						echo $lang['no_results'];

					}

			        ?>

                    </tbody>

                    <tfoot>

                      <tr>

					   <!--<th><?php echo $lang['image']; ?></th>-->

					   <th><?php echo $lang['name']; ?></th>

					   <th><?php echo $lang['email']; ?></th>
                       <th><?php echo $lang['phone']; ?></th>

					   <th>Sign-up date</th>
                       
                       <th>Location</th>

					   <th><?php echo $lang['active']; ?></th>

					   <th><?php echo $lang['action']; ?></th>

                      </tr>

                    </tfoot>

                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->  	

			  

	         

		 </div><!-- /.col-lg-12 -->	 

	    </div><!-- /.row -->		  		  

	   </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

	 	

      <!-- Include footer.php. Contains footer content. -->	

	  <?php include 'template/footer.php'; ?>	

	 	

     </div><!-- /.wrapper -->   



	

	 <!-- ==============================================

	 Scripts

	 =============================================== -->

	 

    <!-- jQuery 2.1.4 -->

    <script src="../assets/js/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.6 JS -->

    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- DATA TABES SCRIPT -->

    <script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->

    <script src="../assets/js/app.min.js" type="text/javascript"></script>

    <!-- page script -->

    <script type="text/javascript">

      $(function () {

        $("#example1").dataTable();

      });

    </script>

    <script type="text/javascript">

	$(function() {

	

	

	$(".btn-danger").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['delete_freelancer']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/delete/deletefreelancer.php",

				 data: info,

				 success: function()

					   {

						parent.fadeOut('slow', function() {$(this).remove();});

					   }

				});

			 

	

			  }

		   return false;

	

		});

	

	});

	</script>



	<script type="text/javascript">

	$(function() {

	

	$(".btn-info").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['activate_freelancer']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/activatefreelancer.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});	

	

	});

	</script>

	

	<script type="text/javascript">

	$(function() {

	

	$(".btn-default").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['deactivate_freelancer']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/deactivatefreelancer.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});		

	

	});

	</script>	

    

</body>

</html>


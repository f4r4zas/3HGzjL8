<?php 

//Check if init.php exists

if(!file_exists('../core/init.php')){

	header('Location: ../install/');        

    exit;

}else{

 require_once '../core/init.php';	
 require_once 'stripe/config.php';
}



//Start new Client object

$client = new Client();



//Check if Client is logged in

if (!$client->isLoggedIn()) {

  Redirect::to('../index.php');	

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

          <h1><?php echo $lang['proposal']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo $lang['proposal']; ?> <?php echo $lang['list']; ?></li>

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

                  <h3 class="box-title"><?php echo $lang['proposal']; ?> <?php echo $lang['list']; ?></h3>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

					   <th><?php echo $lang['freelancer']; ?> <?php echo $lang['name']; ?></th>

					   <th><?php echo $lang['job']; ?> <?php echo $lang['title']; ?></th>

					   <th><?php echo $lang['category']; ?></th>

					   <th><?php echo $lang['budget']; ?></th>

					   <!--<th><?php echo $lang['freelancer']; ?> <?php echo $lang['budget']; ?></th>-->

					   <th><?php echo $lang['accepted']; ?></th>

					   <th><?php echo "Apply date"//$lang['date_added']; ?></th>

					   <!--<th><?php echo $lang['active']; ?></th>-->

					   <th><?php echo $lang['action']; ?></th>

                      </tr>

                    </thead>

                    <tbody>

				    <?php

				    if(Input::get('id')):

				    $jobid = Input::get('id');

                     $query = DB::getInstance()->get("proposal", ["[>]job" => ["proposal.jobid" => "jobid"]], "proposal.*", ["ORDER" => "proposal.id DESC", "AND" => ["job.clientid" => $client->data()->clientid, "job.jobid" => $jobid, "proposal.active" => 1, "proposal.delete_remove" => 0]]);

					else:	

                     $query = DB::getInstance()->get("proposal", ["[>]job" => ["proposal.jobid" => "jobid"]], "proposal.*", ["ORDER" => "proposal.id DESC", "AND" => ["job.clientid" => $client->data()->clientid, "proposal.active" => 1, "proposal.delete_remove" => 0]]);

				    endif;

                     if($query->count()) {

						foreach($query->results() as $row) {

							

					    $q1 = DB::getInstance()->get("job", "*", ["jobid" => $row->jobid]);

						if ($q1->count()) {

							 foreach ($q1->results() as $r1) {

							  $title_job = $r1->title;	

							  $slug = $r1->slug;	

							  $catid = $r1->catid;	

							  $budget = $r1->budget;	

						     }

						}	

						

					    $q2 = DB::getInstance()->get("category", "*", ["catid" => $catid]);

						if ($q2->count()) {

							 foreach ($q2->results() as $r2) {

							  $name1 = $r2->name;	

						     }

						}

							

					    $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->freelancerid]);

						if ($q3->count()) {

							 foreach ($q3->results() as $r3) {

							  $name2 = $r3->name;	

						     }

						}	

						

						 $q = DB::getInstance()->get("job", "*", ["AND"=> ["jobid" => $row->jobid, "accepted" => 1]]);	

						 if($q->count() === 1) {

						 	

						     $q1 = DB::getInstance()->get("proposal", "*", ["AND"=> ["proposalid" => $row->proposalid, "freelancerid" => $row->freelancerid, "accepted" => 1]]);

							 if($q1->count() === 1) {

							  foreach($q1->results() as $r1) {

								// Output variable

					            /*$mark = '

					                   <a id="' . escape($r1->id) . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="' . $lang['unassign'] . '">

					                   <span class="fa fa-close"></span>

					                   </a>';*/
                                       $mark = '';	

							  }	

							  	

							 }else {

								// Output variable

								$mark = '';	

							 }	

							 $link .='<a href="jobboard.php?a=overview&id='. escape($row->jobid) .'">'. escape($title_job) .'</a>';  

						 	

						 }else {

					    $mark = '
                        
                        <form action="template/actions/assign.php?id=' . escape($row->proposalid) . '" method="POST">

						  <script

						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"

						    data-key="'. $stripe[publishable] .'"

						    data-name="Escrow ' . $lang['payments'] . '"

						    data-description="' . $title_job . '"

						    data-currency="'.$currency_code.'"

						    data-email="'. $client->data()->email .'"

						    data-amount="'. getMoneyAsCents($budget) .'"

						    data-locale="auto">

						  </script>

						</form>                        

					    <!--<a id="' . escape($row->id) . '" data-jobid="'.escape($row->jobid).'" data-freelancerid="'.escape($row->freelancerid).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="' . $lang['assign'] . ' ' . $lang['job'] . '">' . $lang['assign'] . ' ' . $lang['job'] . '</a>-->';
						 

						$link .='<a href="../jobpost.php?title='. escape($slug) .'" target="_blank">'. escape($title_job) .'</a>';  

						 }		

	

						if($row->opened == 0):						

					    echo '<tr class="success">';

						else:				

					    echo '<tr>';

						endif;

					    echo '<td><a href="../freelancer.php?a=overview&id='. escape($row->freelancerid) .'&requestid='.$row->proposalid.'">'. $name2 .'</a></td>';

					    echo '<td> '.$link.' </td>';

					    echo '<td><span class="label label-success"> '. escape($name1) .' </span></td>';

					    echo '<td>'. $currency_symbol .' '. escape($budget) .'</td>';

					    //echo '<td>'. $currency_symbol .' '. escape($row->budget) .'</td>';

						

					    if ($row->accepted === "2") :

					    echo '<td><span class="label label-success"> ' . $lang['declined'] . ' </span> </td>';

                        elseif($row->accepted === "1"):

					    echo '<td><span class="label label-success"> ' . $lang['assigned'] . ' </span> </td>';

                        elseif($row->accepted === "0"):

					    echo '<td><span class="label label-success"> ' . $lang['waiting'] . ' ' . $lang['to'] . ' ' . $lang['be'] . ' ' . $lang['assigned'] . ' </span> </td>';

						endif;	

						

					    echo '<td>'. escape(strftime("%b %d, %Y, %H : %M %p ", strtotime($row->date_added))) .'</td>';

						

					    if (escape($row->active) == 1) {

					    //echo '<td><span class="label label-success"> ' . $lang['active'] . ' </span> </td>';

						} else {

					    //echo '<td><span class="label label-success"> ' . $lang['in_active'] . ' </span> </td>';

						}											

						

					    echo '<td>

					      <a style="display:none;" href="proposalnotification.php?id=' . escape($row->proposalid) . '" class="btn btn-primary btn-xs" data-toggle="tooltip" title="' . $lang['view'] . ' ' . $lang['proposal'] . '"><span class="fa fa-eye"></span></a>

                          '.$mark.'

					      </td>';

					    echo '</tr>';

						unset($link);

					   }

					}else {

						echo $lang['no_results'];

					}

			        ?>

                    </tbody>

                    <tfoot>

                      <tr>

					   <th><?php echo $lang['freelancer']; ?> <?php echo $lang['name']; ?></th>

					   <th><?php echo $lang['job']; ?> <?php echo $lang['title']; ?></th>

					   <th><?php echo $lang['category']; ?></th>

					   <th><?php echo $lang['budget']; ?></th>

					   <!--<th><?php echo $lang['freelancer']; ?> <?php echo $lang['budget']; ?></th>-->

					   <th><?php echo $lang['approved']; ?></th>

					   <th><?php echo "Apply date"//$lang['date_added']; ?></th>

					   <!--<th><?php echo $lang['active']; ?></th>-->

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

	

	$(".btn-info").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");
    var parent = $(this).parent().parent();
    
    
    /*var name = $("#name").val();

    var description = $("#description").val();

    var budget = $("#budget").val();

    var start_date = $("#start_date").val();

    var end_date = $("#end_date").val();*/

    var jobid = $(this).attr('data-jobid');

    var freelancerid = $(this).attr('data-freelancerid');

	

	//Built a url to send

	var info = 'id=' + id;
    
    var info1 = "jobid="+jobid+"&freelancerid="+freelancerid;

	 /*if(confirm("<?php echo $lang['assign_job']; ?>"))

			  {*/
			     
            // get values

	    

	    

		//Built a url to send    

		//var datas="fname="+fname+"&lname="+lname+"&email="+email;

		

	

	    // Add record

        $.ajax({

           type  : 'POST',

            url  : 'template/requests/addmilestone.php',

		    data: info1,

            //data : {name:name, description:description, budget:budget, start_date:start_date, end_date:end_date, jobid:jobid, freelancerid:freelancerid},

            success: function (data) {

	        $.ajax({

				 type: "GET",

				 url: "template/actions/assign.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

            }

        });     
                 
                 

			

				

			 

	

			  //}

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

	 if(confirm("<?php echo $lang['unassign_job']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/unassign.php",

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


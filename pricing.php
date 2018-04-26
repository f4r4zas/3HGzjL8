<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: nstall/');        
    exit;
}else{
 require_once 'core/frontinit.php';	
}


?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('includes/template/header.php'); ?> 
<style>
.currencytag {
    font-size: 50px !important;

}
</style>



<?php $admin = new Admin();

			 //Start new Client object

			 $client = new Client();

			 //Start new Freelancer object

			 $freelancer = new Freelancer(); 

			 

			 if ($admin->isLoggedIn()) { 
			     $redirect_link = "login1.php?mid=p";

	         } elseif($client->isLoggedIn()) {
	           
               $redirect_link = "login1.php?mid=p";

	         } elseif($freelancer->isLoggedIn()) {
	           $redirect_link = "#";
             } else {
                $redirect_link = "login1.php";
             }
               ?>
             
<body class="greybg">
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('includes/template/navigation.php'); ?> 
     
     <div class="form-head">

			 <h3 style="text-align: center; font-weight: bold;">Service Providers Membership Plans</h3>

			</div><!-- /.form-head -->
     
     
     <?php /*
 	 <div class="section padsec">		<div class="container">			<div class="row">					<div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">					<div class="bader">					<div class="Headerpri">HAPPY </div>												<div class="botmprice">							<div class="textprice">							 Free sign up							</div>							<div class="textprice">							Covers 2 region							</div>							<div class="textprice">							Requestup to 10 jobs leads per month							</div>							<div class="textprice">							Receive Payment 5-7 days							</div>							<div class="textprice">							25% Transaction services change fees							</div>							<div class="textprice">							Profile Verification 							</div>													</div>						<div class="pricetag">							<a href="#">							<span class="currencytag">$</span>39.99<span class="permnth">Per Month</span>							</a>						</div>					</div>									</div>								<div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">					<div class="bader">					<div class="Headerpri redke">SMILE </div>												<div class="botmprice">							<div class="textprice">							Free sign up							</div>							<div class="textprice">							Covers 2 region							</div>							<div class="textprice">							Add 3 additional Regions to your current regions 							</div>							<div class="textprice">							Receive Payment 3-5 days							</div>							<div class="textprice">							Priority lead Alert notifications 							</div>							<div class="textprice">							Auto follow up messages							</div>							<div class="textprice">							Requestup to 15 jobs leads per month							</div>							<div class="textprice">							15% transaction services charge fees							</div>							<div class="textprice">							Profile Verification 							</div>																				</div>						<div class="pricetag redke">							<a href="#">							<span class="currencytag">$</span>59.99<span class="permnth">Per Month</span>							</a>						</div>					</div>									</div>					<div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">					<div class="bader">					<div class="Headerpri orngkee">LAUGH</div>												<div class="botmprice">							<div class="textprice">							Free sign up							</div>							<div class="textprice">							Covers 2 region							</div>							<div class="textprice">							Add 7 additional Regions to your current regions 							</div>							<div class="textprice">							Receive Payment 2-3 days							</div>							<div class="textprice">							Priority lead Alert notifications 							</div>							<div class="textprice">							Auto follow up messages							</div>							<div class="textprice">							Requestup to 25 jobs leads per month							</div>							<div class="textprice">							9% transaction services charge fees							</div>							<div class="textprice">							Profile Verification 							</div>							<div class="textprice">							Unlimited messaging 							</div>							<div class="textprice">							Review reply option							</div>							<div class="textprice">							Increase Profile Security							</div>							<div class="textprice">							Profile Verification  							</div>													</div>						<div class="pricetag orngkee">						<a href="#"><span class="currencytag">$</span>79.99<span class="permnth">Per Month</span>						</a>						</div>					</div>									</div>								<div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">					<div class="bader">					<div class="Headerpri yellokee">KEEHEE</div>												<div class="botmprice">							<div class="textprice">							Free sign up							</div>							<div class="textprice">							Covers 2 region							</div>							<div class="textprice">							Add 14 additional Regions to your current regions 							</div>							<div class="textprice">							Receive Payment –NEXT DAY							</div>							<div class="textprice">							Priority lead Alert notifications 							</div>							<div class="textprice">							Auto follow up messages							</div>							<div class="textprice">							Request unlimited jobs leads							</div>							<div class="textprice">							5% transaction services charge fees							</div>							<div class="textprice">							Profile Verification 							</div>							<div class="textprice">							Unlimited messaging 							</div>							<div class="textprice">							Review reply option							</div>							<div class="textprice">							Increase Profile Security							</div>							<div class="textprice">							Review respond							</div>							<div class="textprice">							Profile Verification 							</div>						</div>						<div class="pricetag yellokee">						<a href="#">														<span class="currencytag">$</span>79.99<span class="permnth">Per Month</span>						</a>						</div>					</div>									</div>													</div>		</div>	 </div>
     */?>
     
     <div class="section padsec" style="padding: 15px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri">HAPPY </div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Request up to 20 jobs leads per month </div>
                        <div class="textprice"> Receive Payment 5-7 days </div>
                        <div class="textprice"> 25% Transaction services change fees </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag"> <a href="<?php echo $redirect_link;?>">							<span class="currencytag">$39</span>.99<span class="permnth">Per Month</span>							</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri redke">SMILE </div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 3 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment 3-5 days </div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request up to 35 jobs leads per month </div>
                        <div class="textprice"> 15% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag redke"> <a href="<?php echo $redirect_link;?>">							<span class="currencytag">$59</span>.99<span class="permnth">Per Month</span>							</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri orngkee">LAUGH</div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 7 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment 2-3 days </div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request up to 50 jobs leads per month </div>
                        <div class="textprice"> 9% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                        <div class="textprice"> Unlimited messaging </div>
                        <div class="textprice"> Review reply option </div>
                        <div class="textprice"> Increase Profile Security </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag orngkee"> <a href="<?php echo $redirect_link;?>"><span class="currencytag">$79</span>.99<span class="permnth">Per Month</span>						</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri yellokee">KEEHEE</div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 14 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment – <b>NEXT DAY</b></div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request unlimited job leads </div>
                        <div class="textprice"> 5% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                        <div class="textprice"> Unlimited messaging </div>
                        <div class="textprice"> Review reply option </div>
                        <div class="textprice"> Increase Profile Security </div>
                        <div class="textprice"> Review respond </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag yellokee"> <a href="<?php echo $redirect_link;?>">														<span class="currencytag">$99</span>.99<span class="permnth">Per Month</span>						</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('includes/template/footer.php'); ?> 		
	 
     <!--<a id="scrollup">Scroll</a>-->
	 
     <!-- ==============================================
	 Scripts
	 =============================================== -->
	 
     <!-- jQuery 2.1.4 -->
     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
     <!-- Bootstrap 3.3.6 JS -->
     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
     <!-- Kafe JS -->
     <script src="assets/js/kafe.js" type="text/javascript"></script>

</body>
</html>

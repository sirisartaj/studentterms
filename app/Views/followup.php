<?php echo view('header');?>
<section> 
 <?php  echo view('sidebar');?>
  <div class="main-content" style="display:none;"> 
    <?php echo view('topbar'); ?>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
      <div class="header">
        <h2><strong>Follow </strong>Up</h2>
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
            <li><a href="https://sirians.xyz/dgtl/dashboard.html">Home</a> </li>
            <li><a href="https://sirians.xyz/dgtl/enquiry.html">Enquiry</a> </li>
            <li class="active">Follow Up</li>
          </ol>
        </div>
      </div>
	  <div class="row">
	  <div class="col-md-7">	
		<div class="row">
			<div class="col-lg-12">
				<button type="submit" class="btn btn-default btn-block show-info-link m-b-10">Add New Followup</button>
			</div>
		</div>	  
            <div class="panel show-info">			
              <div class="panel-content">	
		<div class="">
		<div class="panel-header p-0">
                 <div class="pull-left"><h3 class="m-t-0"><i class="icon-user-following"></i> <strong>Follow</strong> Up</h3></div>
				
				<div class="clear"></div>
              </div> 

       <form method="post" id="add_create" name="add_create" action="<?= site_url('/submitForm') ?>" onsubmit="return validcreateform();">
                <div class="row">
				          <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Executive<sup>*</sup></label>
                      <input type="hidden" name="student_id" value="<?php echo $student_id; ?>"/>
                      <input type="hidden" name="rid" value="<?php echo $rid; ?>"/>
                      <input type="text" placeholder="Executive" class="form-control form-white" id="Executive" name="executive" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Next Follow Up</label>			
                      <div class="append-icon-default">
                        <!-- <input type="text" name="Date" class="b-datepicker form-control form-white" placeholder="Select a date..." data-orientation="top"> -->
            						<div class="date form-datetime">
                            <input type="text" class="form-control form-white" name="next_follow_up" placeholder="Select date & time">
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                        <i class="icon-calendar default-date-icon"></i> </div>
                    </div>
                  </div>
                </div>
				<div class="row">				
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Follow Up Type<sup>*</sup></label>
                      <select id="FollowUpType" name="follow_up_type" class="form-control form-white" data-search="true" required>
                        <option value="">Select type</option>
                        <option value="1">Walk-in</option>
                        <option value="3">Referral</option>
                        <option value="5">Just Dial</option>
                        <option value="8">Website</option>
                        <option value="9">Telephonic</option>
                        <option value="10">Face book</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Status</label>
                      <select id="Status" name="Status" class="form-control form-white" data-search="true">
                        <option value="">Select Status</option>
                        <option value="interested">Interested</option><option value="notinterested">Not Interested</option><option value="far">far</option><option value="notaffordable">Not affordable</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /row inner end -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Overview</label>
                      <textarea placeholder="Write comment of enquiry here..." class="form-control form-white" id="Overview" name="Overview"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /row inner end -->                 
				<div class="row">
			<div class="col-lg-12">
				<button type="submit" class="btn btn-success">Submit</button>
				<button type="submit" class="btn btn-danger show-info-cancel">Cancel</button>
			</div>
		</div>
  </form>
		</div>
		<!-- /advanced search -->
		 
			 </div>
            </div>  
			<div class="timeframe">
			<div class="timeframe-line"></div>
      <?php 
     // print_r($followup);
      //if($followup){ ?>
        <?php $u =1;
          if($followup): ?>
          <?php foreach($followup as $follow): ?>
			  <div class="timeframe-block">
			  <div class="timeframe-circle"><i class="ti-reload"></i></div>
				<div class="arrow-left"></div>	
				  <div class="timeframe-status">
					  <strong class="pull-left"><?php echo date('jS F, Y', strtotime($follow['created_at'])); ?></strong>
					  <strong class="pull-right">Status: <span class="text-success"><?php echo $follow['Status'];?></span></strong>				  
					   <div class="clear"></div>
					   <small class="text-danger">Follow up by - <?php echo $follow['executive'];?></small>	
				  </div>	
					<div class="timeframe-info">		
									
					<p><?php echo $follow['Overview'];?></p>			  
				  </div>
				  <div class="timeframe-date">
					<div class="pull-left">
						<strong>Next Follow Up: <span class="text-info"><?php echo date('jS F, Y', strtotime($follow['next_follow_up'])); ?></span></strong>
					</div>
					<div class="pull-right">
						<a data-rel="tooltip" data-placement="bottom" title="Edit" onclick="edit('<?php echo $follow['id'] ?>');" href="javascript:void(0);"><i class="icon-note text-primary m-r-10"></i></a>
						<a data-rel="tooltip" data-placement="bottom" title="Delete" onclick="delete('<?php echo $follow['id'] ?>');" href="javascript:void(0);"><i class="icon-trash text-danger"></i></a>
					</div>
					<div class="clear"></div>
				  </div>
			  </div>
			  <!-- time line block -->
        <?php endforeach ?>
			  <?php else: ?>
              <div class="timeframe-block">
                No Follow Up Yet
              </div>
       <?php endif ?>
			  
			  
			</div>
	  </div>
	  <div class="col-md-5">
      <form class="form-validation" role="form">
            <div class="panel">
              <div class="panel-header panel-no-space">
                 <div class="pull-left"><h3 class="text-success"><i class="icon-user"></i> <strong>Student</strong> Information</h3></div>
				
				<div class="clear"></div>
        <?php //echo "<pre>";print_r($student);?>
              </div> 
              <div class="panel-content p-t-10">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Student Name</label>
                      <p><strong><?php echo $student[0]['Student_Name'] ?></strong></p>
                    </div>
                  </div>                
                  
                </div>
                <!-- /row inner end -->
                <div class="row">	
							
                  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Class of Joining</label>
                      <p><strong><?php echo $student[0]['Course_Name'];?> </strong></p>
                    </div>
                  </div>                  
				  </div>
                <!-- /row inner end -->
				<div class="row">
					<div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">paid_amount</label>
                      <p><strong><?php echo $student[0]['paid_amount'];?></strong></p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Term Name</label>
                      <p><strong><?php echo $student[0]['term_name'];?></strong></p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Term Amount</label>
                      <p><strong><?php echo $student[0]['term_amount'];?></strong></p>
                    </div>
                  </div>
				</div>
				<!-- /row inner end --> 
                <div class="row">
				  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Admission Number</label>
                      <p><strong><?php echo $student[0]['admission_number'];?></strong></p>
                    </div>
                  </div>
                </div>
                <!-- /row inner end --> 
				<div class="panel-header p-0">
                 <div class="pull-left"><h3 class="text-success"><i class="icon-user"></i> <strong>Parent</strong> Information</h3></div>				
				<div class="clear"></div>
              </div> 
				<div class="row">
				  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Parent/Guardian</label>
                      <p><strong>Father</strong></p>
                    </div>
                  </div>
				  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Name</label>
                      <p><strong><?php echo $student[0]['Father_FullName'];?></strong></p>
                    </div>
                  </div>
                </div>
                <!-- /row inner end --> 
				<div class="row">
				  <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Mobile</label>
                      <p><strong><?php echo $student[0]['Father_mobile_number'];?></strong></p>
                    </div>
                  </div>
				  <!-- <div class="col-sm-6">
                    <div class="form-list">
                      <label class="control-label">Email</label>
                      <p><strong>satyam.g@siriinnovations.com</strong></p>
                    </div>
                  </div> -->
                </div>
                <!-- /row inner end --> 
				<!-- <div class="panel-header p-0">
                 <div class="pull-left"><h3 class="text-success"><i class="icon-pin"></i> <strong>Address</strong></h3></div>				
				<div class="clear"></div>
              </div> 
				<div class="row">
				  <div class="col-sm-12">
                    <div class="form-list">
                      <p><strong>III Block, 311/A, MLA Colony, Road No. 12, Banjara Hills, Hyderabad, Telangana 500034. (+91) 40 47766789 and 40 64640441</strong></p>
                     
                    </div>
                  </div>
                </div> -->
                <!-- /row inner end --> 
              </div>
			  <!-- /panel-content -->
            </div>
               

	 </form>
      <!-- /form -->
	  </div>
	  
	  
	  
	  <div class="clear"></div>
	  </div>
      <div class="footer">
        <div class="copyright">
          <p class="pull-left sm-pull-reset"> <span>Copyright <span class="copyright">©</span> 2016 </span> <span>Siri IT Innovations Pvt Ltd</span>. <span>All rights reserved. </span> </p>
          <p class="pull-right sm-pull-reset"> <span><a href="https://sirians.xyz/dgtl/#" class="m-r-10">Support</a> | <a href="https://sirians.xyz/dgtl/#" class="m-l-10 m-r-10">Terms of use</a> | <a href="https://sirians.xyz/dgtl/#" class="m-l-10">Privacy Policy</a></span> </p>
        </div>
      </div>
    </div>
    <!-- END PAGE CONTENT --> 
  </div>
  <!-- END MAIN CONTENT --> 
</section>
<a href="https://sirians.xyz/dgtl/#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
<?php echo view('js'); ?>
<script>
  function validcreateform(){

  }
</script>
</body>
</html>
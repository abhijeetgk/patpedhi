<?php echo $data['header'];?>
 <div class="container body">
    <div class="main_container">
     <?php echo $data['leftbar'];?>
      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <?php echo $data['topbar_profile_dropdown'];?>
              <?php echo $data['email_dropdown'];?>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->
      <!-- page content -->

      <div class="right_col" role="main">
      <div class="page-title">
            <div class="title_left">
              <h3>Recurring Deposits</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <!-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div> -->
              </div>
            </div>
          </div>
        <br />
        
            <?php if (isset($success_message) && $success_message!="") { ?>
            <div class="alert alert-success" style="clear:both">
                <strong><?php echo $success_message;?></strong>
            </div>
            <br>
            <?php } ?>
            <br />
        <?php echo $data['rd_report'];?>
        </div>
       <?php echo $data['footer'];?>
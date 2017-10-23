<?php
if (isset($customer_data) && $customer_data != "") {
    $customer = $customer_data;
    $formaction = "edit";
} else {
    $customer = array(
        "id"=>"",
        "fname" => "",
        "mname" => "",
        "lname" => "",
        "address1" => "",
        "address2" => "",
        "city" => "",
        "state" => "",
        "country" => "",
        "pincode" => "",
        "description"=>""
    );
    $formaction = "add";
}
?>

<div class="">
    <!-- main form -->
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New Customer <small>add customer details</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="add_customer" data-parsley-validate class="form-horizontal form-label-left" name="add_customer" method="POST"
                          action="<?php echo BASE_URL; ?>customer/<?php echo $formaction; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $customer['id'];?>" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fname">
                                First Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fname" name="fname" required="required" value="<?php echo $customer['fname']; ?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mname" class="control-label col-md-3 col-sm-3 col-xs-12">
                                Middle Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="mname" value="<?php echo $customer['mname']; ?>" class="form-control col-md-7 col-xs-12" type="text" name="mname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lname">Last Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="lname" value="<?php echo $customer['lname']; ?>" id="lname" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 1 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="address1" name="address1" value="<?php echo $customer['address1']; ?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 2 <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="address2" name="address2" value="<?php echo $customer['address2']; ?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="city" name="city" value="<?php echo $customer['city']; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="state" name="state" value="<?php echo $customer['state']; ?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="country" name="country" value="<?php echo $customer['country']; ?>" class=" form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pincode <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="pincode" name="pincode" value="<?php echo $customer['pincode']; ?>" class=" form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="description" name="description" value="<?php echo $customer['description']; ?>" class="form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main form -->

</div>
<div class="">
    <!-- main form -->
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New RD <small>Recurring Deposit details</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="add_rd_master" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo BASE_URL; ?>rd/addmaster">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Customer<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_name" id="customer_name" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" name="customer_id" id="customer_id" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_date">Start Date<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text" id="start_date" name="start_date" required="required" class="date-picker form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="initial_deposit">Initial Deposit<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number"  id="initial_deposit" name="initial_deposit" required="required" 
                                       class="form-control col-md-7 col-xs-12 has-feedback-left">
                                <span class="fa fa-inr form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#start_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_1",
            format: 'YYYY-MM-DD '

        }, function (start, end, label) {
//            console.log(start.toISOString(), end.toISOString(), label);
        });
    });

</script>
<script type="text/javascript">
    $(function ()
    {
        $("#customer_name").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo BASE_URL; ?>ajax/customer_id_autocomplete",
                    data: {term: request.term},
                    dataType: "json",
                    success: function (data) {
                        response($.map(data, function (item) {
                            //alert(item.label);
                            return {
                                label: item.id + " " + item.name,
                                value: item.name,
                                id: item.id

                            }
                        }));
                    },

                });
            },
            select: function (event, ui) {
                $("#customer_id").val(ui.item.id);  // ui.item.value contains the id of the selected label
            }
        });
    });
</script>
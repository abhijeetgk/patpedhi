<!-- Bootstrap core CSS -->

<link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">

<link href="<?php echo ASSETS_PATH; ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo CSS_PATH; ?>animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo CSS_PATH; ?>custom.css" rel="stylesheet">
<link href="<?php echo CSS_PATH; ?>icheck/flat/green.css" rel="stylesheet">

<link href="<?php echo JS_PATH; ?>datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JS_PATH; ?>datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JS_PATH; ?>datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JS_PATH; ?>datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo JS_PATH; ?>datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo JS_PATH; ?>jquery.min.js"></script>

<!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Customers</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="customer_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Datatables -->
<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="<?php echo JS_PATH; ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/jszip.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/pdfmake.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/vfs_fonts.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/buttons.html5.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/buttons.print.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo JS_PATH; ?>datatables/dataTables.scroller.min.js"></script>


<!-- pace -->
<script src="<?php echo JS_PATH; ?>pace/pace.min.js"></script>
<script>
    var handleDataTableButtons = function () {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdf",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
            responsive: !0
        })
    },
            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons()
                    }
                }
            }();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#customer_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/ajax/customer/"
        });

    });
</script>
<?php if (isset($datepicker)) { ?>
<script src="<?=base_url()?>assets/js/slider/bootstrap-slider.js"></script>
<script src="<?=base_url()?>assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/locales/bootstrap-datepicker.<?=(lang('lang_code') == 'en' ? 'en-GB': lang('lang_code'))?>.min.js"></script>

<script type="text/javascript">
$('.datepicker-input').datepicker({
    todayHighlight: true,
    todayBtn: "linked",
    autoclose: true
});
</script>
<?php } ?>

<?php if (isset($form)) { ?>
<script src="<?=base_url()?>assets/js/libs/select2.min.js"></script>
<script src="<?=base_url()?>assets/js/file-input/bootstrap-filestyle.min.js"></script>
<script src="<?=base_url()?>assets/js/wysiwyg/jquery.hotkeys.js"></script>
<script src="<?=base_url()?>assets/js/wysiwyg/bootstrap-wysiwyg.js"></script>
<script src="<?=base_url()?>assets/js/wysiwyg/demo.js"></script>
<script src="<?=base_url()?>assets/js/parsley/parsley.min.js"></script>
<script src="<?=base_url()?>assets/js/parsley/parsley.extend.js"></script>
<?php } ?>
<?php if ($this->uri->segment(2) == 'help') { ?>
 <!-- App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/1.0.0/intro.min.js"> </script>
<script src="<?=base_url()?>assets/js/intro/demo.js"> </script>
<?php }  ?>

<?php
if (isset($datatables)) {
    $sort = strtoupper(config_item('date_picker_format'));
?>
<script src="<?=base_url()?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/js/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?=base_url()?>assets/js/datatables/datetime-moment.js"></script>
<script type="text/javascript">
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "currency-pre": function (a) {
                a = (a==="-") ? 0 : a.replace( /[^\d\-\.]/g, "" );
                return parseFloat( a ); },
            "currency-asc": function (a,b) {
                return a - b; },
            "currency-desc": function (a,b) {
                return b - a; }
        });
        $.fn.dataTableExt.oApi.fnResetAllFilters = function (oSettings, bDraw/*default true*/) {
                for(iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                        oSettings.aoPreSearchCols[ iCol ].sSearch = '';
                }
                oSettings.oPreviousSearch.sSearch = '';

                if(typeof bDraw === 'undefined') bDraw = true;
                if(bDraw) this.fnDraw();
        }

        $(document).ready(function() {

        $.fn.dataTable.moment('<?=$sort?>');
        $.fn.dataTable.moment('<?=$sort?> HH:mm');

        var oTable1 = $('.AppendDataTables').dataTable({
        "bProcessing": true,
        "sDom": "<'row'<'col-sm-4'l><'col-sm-8'f>r>t<'row'<'col-sm-4'i><'col-sm-8'p>>",
        "sPaginationType": "full_numbers",
        "iDisplayLength": <?=config_item('rows_per_table')?>,
        "oLanguage": {
                "sProcessing": "<?=lang('processing')?>",
                "sLoadingRecords": "<?=lang('loading')?>",
                "sLengthMenu": "<?=lang('show_entries')?>",
                "sEmptyTable": "<?=lang('empty_table')?>",
                "sInfo": "<?=lang('pagination_info')?>",
                "sInfoEmpty": "<?=lang('pagination_empty')?>",
                "sInfoFiltered": "<?=lang('pagination_filtered')?>",
                "sInfoPostFix":  "",
                "sSearch": "<?=lang('search')?>:",
                "sUrl": "",
                "oPaginate": {
                        "sFirst":"<?=lang('first')?>",
                        "sPrevious": "<?=lang('previous')?>",
                        "sNext": "<?=lang('next')?>",
                        "sLast": "<?=lang('last')?>"
                }
        },
        "tableTools": {
                    "sSwfPath": "<?=base_url()?>assets/js/datatables/tableTools/swf/copy_csv_xls_pdf.swf",
              "aButtons": [
                      {
                      "sExtends": "csv",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
                      {
                      "sExtends": "xls",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
                      {
                      "sExtends": "pdf",
                      "sTitle": "<?=config_item('company_name').' - '.lang('invoices')?>"
                  },
              ],
        },
        "aaSorting": [],
        "aoColumnDefs":[{
                    "aTargets": ["no-sort"]
                  , "bSortable": false
              },{
                    "aTargets": ["col-currency"]
                  , "sType": "currency"
              }]
        });
            $("#table-tickets").dataTable().fnSort([[0,'desc']]);
            $("#table-tickets-archive").dataTable().fnSort([[1,'desc']]);
           

            $("#table-projects-client").dataTable().fnSort([[4,'asc']]);
            $("#table-projects-archive").dataTable().fnSort([[5,'desc']]);
            $("#table-teams").dataTable().fnSort([[0,'asc']]);
            $("#table-milestones").dataTable().fnSort([[2,'desc']]);
            $("#table-milestone").dataTable().fnSort([[2,'desc']]);
            $("#table-tasks").dataTable().fnSort([[2,'desc']]);
            $("#table-files").dataTable().fnSort([[2,'desc']]);
            $("#table-links").dataTable().fnSort([[0,'asc']]);
            $("#table-project-timelog").dataTable().fnSort([[0,'desc']]);
            $("#table-tasks-timelog").dataTable().fnSort([[0,'desc']]);
            
            $("#table-clients").dataTable().fnSort([[0,'asc']]);
            
            /* client search Hide start */
            
            var tableclients = $('#table-clients-compaines').DataTable();

            $('#client_search').click(function(){
                var clientname = $('#client_name').val();
                var client_email = $('#client_email').val();
                tableclients
                .columns( 0 )
                .search(  clientname )
                .columns( 4 )
                .search(  client_email )
                .draw();
            });
            $('#table-clients-compaines_filter').hide();
            

            /* client search Hide end */
            /* Project Data table start  */
            
             var tableprojects = $("#table-projects").DataTable(); //dataTable().fnSort([[0,'desc']]);
               
               $('#project_search_btn').click(function(){

                var project_title = $('#project_title').val();
                var client_name = $('#client_name').val();

                tableprojects
                .columns( 1 )
                .search(  project_title )
                .columns( 2 )
                .search(  client_name )
                .draw();
            });
            $('#table-projects_filter').hide();
            /* Project Data table END  */
            /* User Data Table Start */
            
            //$("#table-users").dataTable().fnSort([[4,'desc']]);
             var tableusers = $("#table-users").DataTable();

               $('#users_search_btn').click(function(){

                var username = $('#username').val();
                var company = $('#company').val();
                var user_role = $('#user_role').val();

                tableusers
                .columns( 0 )
                .search(  username )
                .columns( 2 )
                .search(  company )
                .columns( 3 )
                .search(  user_role )
                .draw();
            });
            $('#table-users_filter').hide();

            /* User Data Table End */
            /* Ticked  Data Table Start  */
            
            //$("#table-tickets").dataTable().fnSort([[0,'desc']]);
             var tabletickets = $("#table-tickets").DataTable();

               $('#ticket_search_btn').click(function(){

                var employee_name = $('#employee_name').val();
                var ticket_status = $('#ticket_status').val();
                var ticked_priority = $('#ticked_priority').val();
                var ticket_from = $('#ticket_from').val();
                var ticket_to = $('#ticket_to').val();

                tabletickets
                .columns(2 )
                .search(  employee_name )
                .columns( 6 )
                .search(  ticket_status )
                .columns( 4 )
                .search(  ticked_priority )
                .draw();
                 if(ticket_from !='' && ticket_to!=''){

                 tabletickets.draw();
                    
                 }
            });

               <?php if($this->uri->segment(1) == 'tickets'){ ?>
             
                $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                var min  = $('#ticket_from').val();
                var max  = $('#ticket_to').val();

                var createdAt = data[7] || 0; // Our date column in the table

                if  ( 
                ( min == "" || max == "" )
                || 
                ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
                )
                {
                return true;
                }
                return false;
                }
                );
            <?php }  ?>

             $('#table-tickets_filter').hide();
            /* Ticked  Data Table End */

               /* Invoice  Data Table Start */
            // $("#table-invoices").dataTable().fnSort([[0,'desc']]);
            var tableinvoices = $("#table-invoices").DataTable();
            $('#tableinvoices_btn').click(function(){

                var invoices_status = $('#invoices_status').val();
               
                var ticket_from = $('#invoice_date_from').val();
                var ticket_to = $('#invoice_date_to').val();

                tableinvoices
                .columns(2 )
                .search(  invoices_status )
                .draw();
                 if(ticket_from !='' && ticket_to!=''){

                 tableinvoices.draw();
                    
                 }
            });
               <?php if($this->uri->segment(1) == 'invoices'){ ?>
               $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                var min  = $('#invoice_date_from').val();
                var max  = $('#invoice_date_to').val();

                var createdAt = data[1] || 0; // Our date column in the table

                if  ( 
                ( min == "" || max == "" )
                || 
                ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
                )
                {
                return true;
                }
                return false;
                }
                );
            <?php } ?>

             $('#table-invoices_filter').hide();
            /* Invoice  Data Table End */
            /* Expenses  Data Table Start */
            //$("#table-expenses").dataTable().fnSort([[0,'desc']]);
             var tableexpenses = $("#table-expenses").DataTable();

              $('#search_expenses_btn').click(function(){

                var expenes_project = $('#expenes_project').val();
                var expenes_client = $('#expenes_client').val();
                var expenses_category = $('#expenses_category').val();
               
                var from = $('#expenses_date_from').val();
                var to = $('#expenses_date_to').val();

                tableexpenses
                .columns(1 )
                .search(  expenes_project )
                .columns( 3 )
                .search(  expenes_client )
                .columns( 5 )
                .search(  expenses_category )
                .draw();
                 if(from !='' && to!=''){

                 tableexpenses.draw();
                    
                 }
            });
              
              <?php if($this->uri->segment(1) == 'expenses'){ ?>
               $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                var min  = $('#expenses_date_from').val();
                var max  = $('#expenses_date_to').val();

                var createdAt = data[6] || 0; // Our date column in the table

                if  ( 
                ( min == "" || max == "" )
                || 
                ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
                )
                {
                return true;
                }
                return false;
                }
                );
            <?php } ?>

             $('#table-expenses_filter').hide();
            /* Expenses  Data Table End */

              /* estimates  Data Table Start */
            // $("#table-estimates").dataTable().fnSort([[0,'desc']]);
             var tableestimates = $("#table-estimates").DataTable();

              $('#search_estimates_btn').click(function(){

                var estimates_status = $('#estimates_status').val();
                
               
                var from = $('#estimates_from').val();
                var to = $('#estimates_to').val();

                tableestimates
                .columns( 4 )
                .search(  estimates_status )
                .draw();
                 if(from !='' && to!=''){

                 tableestimates.draw();
                    
                 }
            });
              
              <?php if($this->uri->segment(1) == 'estimates'){ ?>
               $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                var min  = $('#estimates_from').val();
                var max  = $('#estimates_to').val();

                var createdAt = data[1] || 0; // Our date column in the table

                if  ( 
                ( min == "" || max == "" )
                || 
                ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) ) 
                )
                {
                return true;
                }
                return false;
                }
                );
            <?php } ?>

             $('#table-estimates_filter').hide();
            /* estimates  Data Table End */

            $("#table-client-details-1").dataTable().fnSort([[1,'asc']]);
            $("#table-client-details-2").dataTable().fnSort([[2,'desc']]);
            $("#table-client-details-3").dataTable().fnSort([[0,'asc']]);
            $("#table-client-details-4").dataTable().fnSort([[1,'asc']]);
            $("#table-templates-1").dataTable().fnSort([[0,'asc']]);
            $("#table-templates-2").dataTable().fnSort([[0,'asc']]);
            
            
            $("#table-payments").dataTable().fnSort([[0,'desc']]);
            
            $("#table-rates").dataTable().fnSort([[0,'asc']]);
            $("#table-bugs").dataTable().fnSort([[1,'desc']]);
            $("#table-stuff").dataTable().fnSort([[0,'asc']]);
            $("#table-activities").dataTable().fnSort([[0,'desc']]);
            
            $("#table-strings").DataTable().page.len(-1).draw();
            if ($('#table-strings').length == 1) { $('#table-strings_length, #table-strings_paginate').remove(); $('#table-strings_filter input').css('width','200px'); }


        $('#save-translation').on('click', function (e) {
            e.preventDefault();
            oTable1.fnResetAllFilters();
            $.ajax({
                url: base_url+'settings/translations/save/?settings=translations',
                type: 'POST',
                data: { json : JSON.stringify($('#form-strings').serializeArray()) },
                success: function() {
                    toastr.success("<?=lang('translation_updated_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $('#table-translations').on('click','.backup-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_backed_up_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $("#table-translations").on('click', '.restore-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_restored_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $('#table-translations').on('click','.submit-translation', function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            $.ajax({
                url: target,
                type: 'GET',
                data: {},
                success: function() {
                    toastr.success("<?=lang('translation_submitted_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });
        $("#table-translations").on('click','.active-translation',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var isActive = 0;
            if (!$(this).hasClass('btn-success')) { isActive = 1; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { active: isActive },
                success: function() {
                    toastr.success("<?=lang('translation_updated_successfully')?>", "<?=lang('response_status')?>");
                },
                error: function(xhr) {
                    alert('Error: '+JSON.stringify(xhr));
                }
            });
        });

        $(".menu-view-toggle").on('click',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var role = $(this).attr('data-role');
            var vis = 1;
            if ($(this).hasClass('btn-success')) { vis = 0; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { visible: vis, access: role },
                success: function() {},
                error: function(xhr) {}
            });
        });

        $(".cron-enabled-toggle").on('click',function (e) {
            e.preventDefault();
            var target = $(this).attr('data-href');
            var role = $(this).attr('data-role');
            var ena = 1;
            if ($(this).hasClass('btn-success')) { ena = 0; }
            $(this).toggleClass('btn-success').toggleClass('btn-default');
            $.ajax({
                url: target,
                type: 'POST',
                data: { enabled: ena, access: role },
                success: function() {},
                error: function(xhr) {}
            });
        });


        $('[data-rel=tooltip]').tooltip();
});
</script>
<?php }  ?>

<?php if (isset($iconpicker)) { ?>
<script type="text/javascript" src="<?=base_url()?>assets/js/iconpicker/fontawesome-iconpicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
            $('#site-icon').iconpicker({hideOnSelect: true, placement: 'bottomLeft'});
            $('.menu-icon').iconpicker().on('iconpickerSelected',function(event){
                var role = $(this).attr('data-role');
                var target = $(this).attr('data-href');
                $(this).siblings('div.iconpicker-container').hide();
                $.ajax({
                    url: target,
                    type: 'POST',
                    data: { icon: event.iconpickerValue, access: role  },
                    success: function() {},
                    error: function(xhr) {}
                });
            });
    });
</script>
<?php } ?>

<?php if (isset($sortable)) { ?>
<script type="text/javascript" src="<?=base_url()?>assets/js/sortable/jquery-sortable.js"></script>
<script type="text/javascript">
    var t1, t2, t3, t4, t5;
    $('#inv-details, #est-details').sortable({
        cursorAt: { top: 20, left: 0 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t1); t1 = setTimeout('saveOrder()', 500); }
    });
    $('#menu-admin').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t2); t2 = setTimeout('saveMenu(\'admin\',1)', 500); }
    });
    $('#menu-client').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t3); t3 = setTimeout('saveMenu(\'client\',2)', 500); }
    });
    $('#menu-staff').sortable({
        cursorAt: { top: 20, right: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t4); t4 = setTimeout('saveMenu(\'staff\',3)', 500); }
    });
    $('#cron-jobs').sortable({
        cursorAt: { top: 20, left: 20 },
        containerSelector: 'table',
        handle: '.drag-handle',
        revert: true,
        itemPath: '> tbody',
        itemSelector: 'tr.sortable',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function() { clearTimeout(t5); t5 = setTimeout('setCron()', 500); }
    });

    function saveOrder() {
        var data = $('.sorted_table').sortable("serialize").get();
        var items = JSON.stringify(data);
        var table = $('.sorted_table').attr('type');
        $.ajax({
            url: "<?=base_url()?>"+table+"/items/reorder/",
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });

    }
    function saveMenu(table, access) {
        var data = $("#menu-"+table).sortable("serialize").get();
        var items = JSON.stringify(data);
        $.ajax({
            url: "<?=base_url()?>settings/hook/reorder/"+access,
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });
    }

    function setCron() {
        var data = $('#cron-jobs').sortable("serialize").get();
        var items = JSON.stringify(data);
        $.ajax({
            url: "<?=base_url()?>settings/hook/reorder/1",
            type: "POST",
            dataType:'json',
            data: { json: items },
            success: function() { }
        });
    }
</script>
<?php } ?>

<?php if (isset($nouislider)) { ?>
<script type="text/javascript" src="<?=base_url()?>assets/js/nouislider/jquery.nouislider.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var progress = $('#progress').val();
    $('#progress-slider').noUiSlider({
            start: [ progress ],
            step: 10,
            connect: "lower",
            range: {
                'min': 0,
                'max': 100
            },
            format: {
                to: function ( value ) {
                    return Math.floor(value);
                },
                from: function ( value ) {
                    return Math.floor(value);
                }
            }
    });
    $('#progress-slider').on('slide', function() {
        var progress = $(this).val();
        $('#progress').val(progress);
        $('.noUi-handle').attr('title', progress+'%').tooltip('fixTitle').parent().find('.tooltip-inner').text(progress+'%');
    });

    $('#progress-slider').on('change', function() {
        var progress = $(this).val();
        $('#progress').val(progress);
    });

    $('#progress-slider').on('mouseover', function() {
        var progress = $(this).val();
        $('.noUi-handle').attr('title', progress+'%').tooltip('fixTitle').tooltip('show');
    });

    var invoiceHeight = $('#invoice-logo-height').val();
    $('#invoice-logo-slider').noUiSlider({
            start: [ invoiceHeight ],
            step: 1,
            connect: "lower",
            range: {
                'min': 30,
                'max': 150
            },
            format: {
                to: function ( value ) {
                    return Math.floor(value);
                },
                from: function ( value ) {
                    return Math.floor(value);
                }
            }
    });
    $('#invoice-logo-slider').on('slide', function() {
        var invoiceHeight = $(this).val();
        var invoiceWidth = $('.invoice_image img').width();
        $('#invoice-logo-height').val(invoiceHeight);
        $('#invoice-logo-width').val(invoiceWidth);
        $('.noUi-handle').attr('title', invoiceHeight+'px').tooltip('fixTitle').parent().find('.tooltip-inner').text(invoiceHeight+'px');
        $('.invoice_image img').css('height',invoiceHeight+'px');
        $('#invoice-logo-dimensions').html(invoiceHeight+'px x '+invoiceWidth+'px');
    });

    $('#invoice-logo-slider').on('change', function() {
        var invoiceHeight = $(this).val();
        var invoiceWidth = $('.invoice_image img').width();
        $('#invoice-logo-height').val(invoiceHeight);
        $('#invoice-logo-width').val(invoiceWidth);
        $('.invoice_image').css('height',invoiceHeight+'px');
        $('#invoice-logo-dimensions').html(invoiceHeight+'px x '+invoiceWidth+'px');
    });

    $('#invoice-logo-slider').on('mouseover', function() {
        var invoiceHeight = $(this).val();
        $('.noUi-handle').attr('title', invoiceHeight+'px').tooltip('fixTitle').tooltip('show');
    });



});
</script>
<?php } ?>

<?php if (isset($calendar) || isset($fullcalendar)) { ?>
<?php $lang = lang('lang_code'); if ($lang == 'en') { $lang = 'en-gb'; } ?>
<script src="<?=base_url()?>assets/js/jquery.fullcalendar.js"></script>
<script src="<?=base_url()?>assets/js/fullcalendar.min.js"></script>
<script src="<?=base_url()?>assets/js/calendar/gcal.js"></script>
<script src="<?=base_url()?>assets/js/calendar/lang/<?=$lang?>.js"></script>
<?php if (isset($calendar)) { ?>
 <?=$this->load->view('sub_group/calendarjs')?>
<?php } ?>


<?php
if(User::is_staff()) :
$tasks = $this->db->select('*, fx_tasks.due_date as task_due, fx_tasks.start_date as task_start',TRUE)->join('assign_tasks','task_assigned = t_id')->where('assigned_user',User::get_id())->get('tasks')->result();
$projects = $this->db->join('assign_projects','project_assigned = project_id')
                  ->where('assigned_user',User::get_id())->get('projects')->result();

$events = $this->db->where('added_by',User::get_id())->get('events')->result();
else:

$tasks = $this->db->select('*, fx_tasks.due_date as task_due, fx_tasks.start_date as task_start',TRUE)->join('projects','project = project_id')->get('tasks')->result();
$payments = $this->db->join('invoices','invoice = inv_id')->join('companies','paid_by = co_id')->get('payments')->result();
$invoices = $this->db->join('companies','client = co_id')->get('invoices')->result();
$estimates = $this->db->join('companies','client = co_id')->get('estimates')->result();
$projects = $this->db->join('companies','client = co_id')->get('projects')->result();
$events = $this->db->get('events')->result();
$leave_list   = $this->db->query("SELECT ul.*,lt.leave_type as l_type,ad.fullname
										FROM `fx_user_leaves` ul
										left join fx_leave_types lt on lt.id = ul.leave_type
										left join fx_account_details ad on ad.user_id = ul.user_id 
										where ul.status != 4 order by ul.id  ASC ")->result();
endif;
$gcal_api_key = config_item('gcal_api_key');
$gcal_id = config_item('gcal_id');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            googleCalendarApiKey: '<?=$gcal_api_key?>',
            header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
            eventAfterRender: function(event, element, view) {
                if (event.type == 'fo') {
                    $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
                }
            },
            eventSources: [
                {
                    events: [
                    <?php foreach ($tasks as $t) { ?>
                            {
                                title  : '<?= addslashes($t->task_name) ?>',
                                start  : '<?= date('Y-m-d', strtotime($t->task_start)) ?>',
                                end: '<?= date('Y-m-d', strtotime($t->task_due)) ?>',
                                url: '<?= base_url('calendar/event/tasks/' . $t->t_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#529FE7',
                    textColor: 'white'
                },
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($payments as $p) { ?>
                            {
                                title  : '<?=addslashes($p->company_name)."  (".Applib::format_currency($p->currency, $p->amount).")"?>',
                                start  : '<?= date('Y-m-d', strtotime($p->payment_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($p->payment_date)) ?>',
                                url: '<?= base_url('calendar/event/payments/' . $p->p_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#FBBE59',
                    textColor: 'black'
                },<?php endif; ?>
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($invoices as $i) { ?>
                            {
                                title  : '<?=$i->reference_no." ".addslashes($i->company_name)?>',
                                start  : '<?= date('Y-m-d', strtotime($i->due_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($i->due_date)) ?>',
                                url: '<?= base_url('calendar/event/invoices/' . $i->inv_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#E27777',
                    textColor: 'white'
                },<?php endif; ?>
                <?php if(User::is_admin()) : ?>
                {
                    events: [
                    <?php foreach ($estimates as $e) { ?>
                            {
                                title  : '<?=$e->reference_no." ".addslashes($e->company_name)?>',
                                start  : '<?= date('Y-m-d', strtotime($e->due_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($e->due_date)) ?>',
                                url: '<?= base_url('calendar/event/estimates/' . $e->est_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#8E76C6',
                    textColor: 'white'
                },<?php endif; ?>
                {
                    events: [
                    <?php foreach ($projects as $j) { ?>
                            {
                                title  : '<?=addslashes($j->project_title)?>',
                                start  : '<?= date('Y-m-d', strtotime($j->start_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($j->due_date)) ?>',
                                url: '<?= base_url('calendar/event/projects/' . $j->project_id) ?>',
                                type: 'fo'
                            },
                    <?php } ?>
                    ],
                    color: '#6B6B6B',
                    textColor: 'white'
                },
				{
                    events: [
                    <?php  foreach ($leave_list as $j) { ?>
                            {
                                title          : '<?=$j->l_type." - ".addslashes($j->fullname)?>',
                                start          : '<?= date('Y-m-d', strtotime($j->leave_from)) ?>',
                                end            : '<?= date('Y-m-d', strtotime($j->leave_to)) ?>',
                                url            : '<?= base_url('calendar/event/leaves/' . $j->id) ?>',
                                type           : 'fo',
								//backgroundColor: '#<?=substr(md5(rand()), 0, 6)?>'
                            },
                    <?php  } ?>
                    ],
                   color    : '#23d03a',
				    //color    : '#3db893',
					//color    : '#1a4789',
				    //color    : '#009a7a',
                    textColor: 'white'
                },
                {
                    events: [
                    <?php foreach ($events as $e) { ?>
                            {
                                title  : '<?=addslashes($e->event_name)?>',
                                start  : '<?=date('Y-m-d', strtotime($e->start_date)) ?>',
                                end: '<?= date('Y-m-d', strtotime($e->end_date)) ?>',
                                url: '<?= base_url('calendar/event/events/' . $e->id) ?>',
                                type: 'fo',
                                color: '<?=$e->color?>'
                            },
                    <?php } ?>
                    ],
                    color: '#38354a',
                    textColor: 'white'
                },
                {
                    googleCalendarId: '<?=$gcal_id?>'
                }
            ]
        });
    });
</script>
<?php } ?>


<?php if (isset($set_fixed_rate)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#fixed_rate").click(function(){
            //if checked
            if($("#fixed_rate").is(":checked")){
                $("#fixed_price").show("fast");
                $("#hourly_rate").hide("fast");
                }else{
                    $("#fixed_price").hide("fast");
                    $("#hourly_rate").show("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($postmark_config)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#use_postmark").click(function(){
            //if checked
            if($("#use_postmark").is(":checked")){
                $("#postmark_config").show("fast");
                }else{
                    $("#postmark_config").hide("fast");
                }
        });
        $("#use_alternate_emails").click(function(){
            //if checked
            if($("#use_alternate_emails").is(":checked")){
                $("#alternate_emails").show("fast");
                }else{
                    $("#alternate_emails").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($braintree_setup)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#use_braintree").click(function(){
            //if checked
            if($("#use_braintree").is(":checked")){
                $("#braintree_setup").show("fast");
                }else{
                    $("#braintree_setup").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($attach_slip)) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#attach_slip").click(function(){
            //if checked
            if($("#attach_slip").is(":checked")){
                $("#attach_field").show("fast");
                }else{
                    $("#attach_field").hide("fast");
                }
        });
    });
</script>
<?php } ?>

<?php if (isset($task_checkbox)) { ?>
<script type="text/javascript">

$(document).ready(function() {

$('.task_complete input[type="checkbox"]').change(function() {

    var task_id = $(this).data().id;
    var task_complete = $(this).is(":checked");

    var formData = {
            'task_id'         : task_id,
            'task_complete'   : task_complete
        };
    $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?=base_url()?>projects/tasks/progress', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                 if ( ! data.success) {
                        alert('There was a problem with AJAX');
                    }else{
                        location.reload();
                    }

                // here we will handle errors and validation messages
            });

  });

});
</script>
<?php } ?>


<?php if (isset($todo_list)) { ?>
<script type="text/javascript">

$(document).ready(function() {

$('.todo_complete input[type="checkbox"]').change(function() {

    var id = $(this).data().id;
    var todo_complete = $(this).is(":checked");

    var formData = {
            'id'         : id,
            'todo_complete'   : todo_complete
        };
    $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?=base_url()?>projects/todo/status', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the done promise callback
            .done(function(data) {

                 if ( ! data.success) {
                        alert('There was a problem with AJAX');
                    }else{
                        location.reload();
                    }

                // here we will handle errors and validation messages
            });

  });

});
</script>
<?php } ?>

 <?php
if($this->session->flashdata('message')){
$message = $this->session->flashdata('message');
$alert = $this->session->flashdata('response_status'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        swal({
            title: "<?=lang($alert)?>",
            text: "<?=$message?>",
            type: "<?=$alert?>",
            timer: 5000,
            confirmButtonColor: "#38354a"
        });
});
</script>
<?php } ?>

<?php if (isset($typeahead)) { ?>
<script type="text/javascript">
    $(document).ready(function(){

        var scope = $('#auto-item-name').attr('data-scope');
        if (scope == 'invoices' || scope == 'estimates') {

        var substringMatcher = function(strs) {
          return function findMatches(q, cb) {
            var substrRegex;
            var matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
              if (substrRegex.test(str)) {
                matches.push(str);
              }
            });
            cb(matches);
          };
        };

        $('#auto-item-name').on('keyup',function(){ $('#hidden-item-name').val($(this).val()); });

        $.ajax({
            url: base_url + scope + '/autoitems/',
            type: "POST",
            data: {},
            success: function(response){
                $('.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 2
                    },
                    {
                    name: "item_name",
                    limit: 10,
                    source: substringMatcher(response)
                });
                $('.typeahead').bind('typeahead:select', function(ev, suggestion) {
                    $.ajax({
                        url: base_url + scope + '/autoitem/',
                        type: "POST",
                        data: {name: suggestion},
                        success: function(response){
                            $('#hidden-item-name').val(response.item_name);
                            $('#auto-item-desc').val(response.item_desc).trigger('keyup');
                            $('#auto-quantity').val(response.quantity);
                            $('#auto-unit-cost').val(response.unit_cost);
                        }
                    });
                });
            }
        });
    }


    });
</script>
<?php } ?>
<!-- this is settings page leave type scripts -->
<script type="text/javascript">
function leave_day_type(){ 
  var val  = $("input[name='req_leave_day_type']:checked").val();
  if(val == 2 || val == 3){  val = 0.5;  } 
  $('#req_leave_count').val(val); 
}
function leave_days_calc(){ 
    $('#leave_day_type').hide();
    
    var new_cnt = 0;

    if($('#req_leave_date_from').val()!=''){
        var d1     = $('#req_leave_date_from').datepicker('getDate'); 
    var d2     = $('#req_leave_date_to').datepicker('getDate'); 
    
    if(d1  != null && d2 != null){
        while(d1 <= d2){
           if(d1.getDay() != 0){  new_cnt++; }
           var newDate = d1.setDate(d1.getDate() + 1);
           d1 = new Date(newDate);
        } 
        //alert(new_cnt);
    }
    }
      
    /*var oneDay = 24*60*60*1000;
    var diff   = 0;
    if (d1 && d2) {
       diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
    }*/
	if(new_cnt == 1){
		$("input[name=req_leave_day_type][value='1']").prop("checked",true); 
		$('#leave_day_type').show();
 	}
    $('#req_leave_count').val(new_cnt); 
	 
}
$(document).ready(function(){
	if($("#req_leave_date_from").length > 0){
		$("#req_leave_date_from").datepicker({ });
		$("#req_leave_date_to").datepicker({ });
	} 
	$('.leave_datepicker').each(function() {
		var minDate = new Date();
		minDate.setHours(0);
		minDate.setMinutes(0);
		minDate.setSeconds(0,0);
		var $picker = $(this);
		$picker.datepicker();
		var pickerObject = $picker.data('datepicker');
		$picker.on('changeDate', function(ev){ 
 			if (ev.date.valueOf() < minDate.valueOf()){
 				$picker.datepicker('setDate', minDate); 
 				ev.preventDefault();
				return false;
			}
		});
    });
 	
	$('.leave_type_edit').on('click', function (e) { 
  		var det = $(this).attr('data_type').split('^');
		 $('#leave_type_tbl_id').val(det[0]);
		 $('#leave_type').val(det[1]);
		 //$('#leave_days').val(det[2]);
		 $("#leave_days").select2("val", det[2]);
		 $('.l_type_save_btn').html('Update');
		 $('.leave_type_add_form').show();
 	});
	
$('#admin_search_leave').on('click', function (e) {  
	    e.preventDefault();
		var scope  = 'leaves';
        var target = $(this).attr('href');
 		var l_type = $('#ser_leave_type').val();
		var l_sts  = $('#ser_leave_sts').val();
		var dfrom  = $('#ser_leave_date_from').val();
		var dto    = $('#ser_leave_date_to').val();
		var uname  = $.trim($('#ser_leave_user_name').val());
  		$('#admin_leave_tbl').html('<tr> <td class="text-center" colspan="9"><img src="<?=base_url()?>assets/images/loader-mini.gif" alt="Loading"></td> </tr>'); 
		$.ajax({
            url    : "<?=base_url()?>"+ scope + '/search_leaves/',
            type   : "POST", 
            data   : {l_type:l_type,l_sts:l_sts,uname:uname,dfrom:dfrom,dto:dto,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(response) {  
			               $('#admin_leave_tbl').html(response);
 			}
        }); 
 	}); 
});
</script>

<?php if (isset($gantt)) { ?>

<script src="<?=base_url()?>assets/js/charts/gantt/jquery.fn.gantt.js"></script>

<script>
$(".gantt").gantt({
    source: [
    <?php
    if(!User::is_client()){
    $tasks = $this->db->order_by('t_id','desc')->where(array('project'=>$project))->get('tasks')->result();
    }else{
    $tasks = $this->db->order_by('t_id','desc')->where(array('project'=>$project,'visible'=>'Yes'))->get('tasks')->result();
    }
    foreach ($tasks as $key => $t) { $start_date = ($t->start_date == NULL) ? $t->date_added : $t->start_date; ?>
{
  "name": '<a href="<?=site_url()?>projects/view/<?=$project?>?group=tasks&view=task&id=<?=$t->t_id?>" class="text-info"><?=addslashes($t->task_name)?> </a>',
  "desc": "",
  "values": [
            {"from":  Date.parse("<?=date('Y/m/d',strtotime($start_date))?>"), "to": Date.parse("<?=date('Y/m/d',strtotime($t->due_date))?>"),
            "desc": "<b><?=$t->task_name?></b> - <em><?=$t->task_progress?>% <?=lang('done')?></em><br><div class=\"line line-dashed line-lg pull-in\"></div><em><?=lang('start_date')?>: <span class=\"text-success text-small\"><?=strftime(config_item('date_format'), strtotime($start_date));?></span> to <?=lang('due_date')?>: <span class=\"text-danger text-small\"><?=strftime(config_item('date_format'), strtotime($t->due_date));?></span></em>",
            "customClass": '<?php if($t->task_progress == '100'){ echo "ganttGreen"; }else{ echo "ganttRed"; } ?>', "label": "<?=$t->task_name?>"
            }
  ]
},
<?php } ?>
],

    maxScale: "months",
    itemsPerPage: 25,
});
</script>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
    var param = 0; //this is for ie problem just 1 parametter

   // setInterval(function(){ get_all_new_chats(param); }, 5000); // this will run after every 5 seconds

    get_all_new_chats(param); //for page load first time
	//get_last_chat_user(param);
	setInterval(function(){
	   var param = 0; //this is for ie problem just 1 parametter	
      //get_all_new_chats(param); // this will run after every 5 seconds
	  get_oposit_new_chats(1,0);
	}, 5000);

    $('.clickable tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});

function show_user_sidebar(){   
    $('.chat_user_sidebar').toggleClass('open-msg-box')
}
function filter_chat_user(text)

{  

    $("#chat-contacts_list > li").each(function() {

		if ($(this).find('.contact-name').text().search(new RegExp(text, "i")) > -1) {

			$(this).show();

		}else {

			$(this).hide();

		}

    }); 

} 

function get_all_new_chats(param)

{  

 	  $.ajax({

			  url      : "<?=base_url()?>"+'chats/all_new_chats/',

			  dataType : 'json',

			  success  : function(res){

				             var chat_id   = $('.chat_user_lst').find('.active_cls').attr('chat_id');

							 if(!chat_id) chat_id = 0; 

 				             $.each(res.chats, function(key,value){ 

 								  if($('#chat-'+key).length == 0){

									  var chld = $('#chat-window-container').children().size();

						   			  if(chld < 5){

 									 	 get_users_chats(key,1);

									  } 

 								  }else if($('#chat-'+key).length == 1){

									  var html2 = value.html2;

									  var d = $('#chat-'+key).find('.panel-body');

									  var ids = '';

 									  $.each(html2, function(key2,value2){

 										 if($('#c_wind_'+key2).length == 0){

											// $(d).append(value2).animate({ scrollTop: $(d)[0].scrollHeight}, 500); 

										 } 

 										 if(ids == ''){ ids += key2; }else { ids += ','+key2; }

									 });  

									 $('#new_chat_tbl_ids_'+key).val(ids); 

  								  }

								  

								  if($('.chat_usr_'+key).length == 0){

 									new_side_user_window(key);

 								  }else{

									 $('.chat_usr_'+key).find('.usr_last_chat_date').html(value.time);

									 $('.chat_usr_'+key).find('.usr_last_chat_det').html(value.content+' .....');	

								  } 

								  var tot_new = 0; $.each(value.html2, function(key2,value2){  tot_new++;  });  

								  $('#new_chat_cnt_'+key).html(tot_new).show();  

 								  

								  if(chat_id == key){

									  var html1 = value.html1;

									  $.each(html1, function(key3,value3){

 										if($('#c_wind2_'+key3).length == 0){

											$("#chat_details_appnd").append(value3);

										} 

									  });  

  								  } 

  				              });  

 				 }

	  }); 

}

function change_chat_sts(id,user_id){  

    var ids = $(id).val(); 

	if(ids != ''){

		$.ajax({

			url     : "<?=base_url()?>"+'chats/change_chat_sts/',

			type    : "POST", 

			data    : { ids : ids,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

			success : function(response) {

				                            $(id).val(''); 

											$('#new_chat_cnt_'+user_id).html(0).hide();

										 }

		}); 

	}

}

function get_users_chats(user_id,type){  

	$.ajax({

		url     : "<?=base_url()?>"+'chats/new_chat_window/',

		type    : "POST", 

		data    : { user_id : user_id,type:type,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

		success : function(response) {  

		               if($('#chat-'+user_id).length == 0){

 						   var chld = $('#chat-window-container').children().size();

						   if(chld == 5){

  							   $('#chat-window-container').find('div:first').remove();

						   }

 						   $('#chat-window-container').append(response);

 						   var d = $('#chat-'+user_id).find('.panel-body');

						   $(d).animate({ scrollTop: $(d)[0].scrollHeight}); 

						   if(type == 0){ $('#chat_txt_bx'+user_id).focus(); }

  					   } 

 		}

	}); 

}

function chat_window_toggle(ele){  

 	if($(ele).hasClass( "panel-heading" )){  

 		$(ele).parent().find('.panel-body,.chat_text_bx').toggle();

	}

}

function email_list_active(ele)

{ 

    $(ele).parent().children().each(function(index, element) {  $(this).removeClass('active_cls');  });

	$(ele).addClass('active_cls');

}  



function save_chat()

{ 

   $("#_error_").html('').hide(); 

   var chat_id   = $('.chat_user_lst').find('.active_cls').attr('chat_id');

   if(chat_id){ 

     var chat_content = $.trim($('#chat_message_content').val());

	 if(chat_content.length > 0){ 

			 $.ajax({

				url      : "<?=base_url()?>"+'chats/save_chat/',

				type     : "POST", 

				dataType : 'json',

				data     : { chat_id : chat_id,chat_content : chat_content,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				success  : function(response) {   

				                $('.chat_user_sidebar').hide();

								if(response.html1 != '') {

 								   $('.chat_usr_'+chat_id).find('.usr_last_chat_date').html(response.time);

								   $('.chat_usr_'+chat_id).find('.usr_last_chat_det').html(response.content);

   								   $('#chat_message_content').val('');  

								   $('#chat_details_appnd').append(response.html1);

							    }
								
								$('.chat-wrap-inner').animate({scrollTop: $('#chat_details_appnd').outerHeight()}, 1000);
								if($('#chat-'+chat_id).length == 1){

									var d = $('#chat-'+chat_id).find('.panel-body');

									$(d).append(response.html2).animate({ scrollTop: $(d)[0].scrollHeight}, 1000); 

 							    }  

				}

			 });   

	 }else{

		 $("#_error_").html('Please Enter Some Content.....').show(); 

	 }

	 return false;	

    }else{

		 $("#_error_").html('Please select Users.....').show();   

		 return false;	

    } 

}

function save_chat2(chat_id)

{   

     var chat_tbl_id  = $.trim($('#chat_tbl_id_bx'+chat_id).val());

     var chat_content = $.trim($('#chat_txt_bx'+chat_id).val());

	 if(chat_content.length > 0){ 

			 $.ajax({

				url      : "<?=base_url()?>"+'chats/save_chat2/',

				type     : "POST", 

				dataType : 'json',

				data     : { chat_tbl_id: chat_tbl_id,chat_id : chat_id,chat_content : chat_content,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				success  : function(response) {   

 				                if(chat_tbl_id == 0){ $('#chat_tbl_id_bx'+chat_id).val(response.chat_tbl_id); } 

								if($('#chat-'+chat_id).length == 1){

 									$('#chat_txt_bx'+chat_id).val('');

									var d = $('#chat-'+chat_id).find('.panel-body');

									$(d).append(response.html2).animate({ scrollTop: $(d)[0].scrollHeight}, 1000);  

 							    } 

								var active_id   = $('.chat_user_lst').find('.active_cls').attr('chat_id');

								if(!active_id) { active_id = 0; }

 								if(active_id != 0 && active_id == chat_id) { 

								   $('#chat_details_appnd').append(response.html1);

							    }  

 								if($('.chat_usr_'+chat_id).length == 0){

 									new_side_user_window(chat_id);

 								}else{

									$('.chat_usr_'+chat_id).find('.usr_last_chat_date').html(response.time);

									$('.chat_usr_'+chat_id).find('.usr_last_chat_det').html(response.content);	

								} 

 				}

			 });   

	 } 

	 return false;	

 }

 function new_side_user_window(user_id)

{ 

 	 if(user_id != "" || user_id != 0){   

		 $.ajax({

				  url     : "<?=base_url()?>"+'chats/new_sidebar_window/',

				  data    : { user_id : user_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				  type    :"POST",

				  success : function(res){

					   if(res != '') {

						  $('.chat_user_lst').append(res);
							
					   }

				  }

		 });

	 }	 

}

function chat_details(user_id)

{ 

	 if(user_id != "" || user_id != 0){   

		 $.ajax({

				  url     : "<?=base_url()?>"+'chats/chat_details/',

				  data    : { user_id : user_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				  type    :"POST",

				  success : function(res){

					   if(res != '') {

						  $('.chat_user_sidebar').hide();

 						  // $("#new_chat_icon"+user_id).remove();

						  $('#new_chat_cnt_'+user_id).hide();

 						  $('#chat_details_appnd').html(res).hide(); 
						  $('.chat-wrap-inner').animate({scrollTop: $('#chat_details_appnd').outerHeight()}, 3000);
						  setTimeout(function(){$('#chat_details_appnd').show();},2000);
					   }

				  }

		 });

	 }									

}

function get_oposit_new_chats(ty,user_id)

{ 

  if(ty == 1 && user_id == 0){

	  var last_chat = $("#chat_details_appnd").children(":first").attr('c_lst2'); 

	  var chat_id   = $('.chat_user_lst').find('.active_cls').attr('chat_id');

  }else if(ty == 2 && user_id != 0){

 	  var last_chat = $("#chat-"+user_id).find('.panel-body').children(":last-child").attr('c_lst'); 

	  var chat_id   = user_id;

  } 

  if(last_chat){} else var last_chat = 0;

  if(chat_id){ 

		 $.ajax({

				  url      : "<?=base_url()?>"+'chats/oposit_new_chat/',

				  data     : { last_chat : last_chat,chat_id:chat_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				  type     : "POST",

				  dataType : 'json',

				  success  : function(res){ 

 				        var active_id   = $('.chat_user_lst').find('.active_cls').attr('chat_id');

					    if(!active_id) { active_id = 0; }

						if(active_id == chat_id){

							$.each(res.html1, function(key, value){

								if($('#c_wind2_'+key).length == 0){

									$("#chat_details_appnd").append(value);

								}

							});

						} 

						if($('#chat-'+chat_id).length == 1){

							var d = $('#chat-'+chat_id).find('.panel-body');

							$.each(res.html2, function(key, value){ 

								if($('#c_wind_'+key).length == 0){

									$(d).append(value).animate({ scrollTop: $(d)[0].scrollHeight}, 500); 

								}

							}); 

 						}  

						

						if(res.time != ''){

 							$('.chat_usr_'+chat_id).find('.usr_last_chat_date').html(res.time);

						}

						if(res.content != '' && res.content){

					    	$('.chat_usr_'+chat_id).find('.usr_last_chat_det').html('You : '+res.content+' .....');	

						}

  				  }

		 }); 

  } 	

}



function get_year_holidays(year)

	{ 	 if(year != "" || year != 0){   

			 $('#holiday_tbl_body').html('<tr> <td class="text-center" colspan="5"><img src="<?=base_url()?>assets/images/loader-mini.gif" alt="Loading"></td> </tr>'); 

			 $.ajax({

					  url     : "<?=base_url()?>"+'holidays/year_holidays/',

					  data    : { year : year,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

					  type    :"POST",

					  success : function(res){ 

							  $('#holiday_tbl_body').html(res); 

					  }

			 });

		 }									

	}

	

function staff_salary_update(ty)

	{ 	  

		 var user_id  = $.trim($('#salary_user_id').val());

		 var amount  = $.trim($('.user_salary_amnt_'+ty).val());

	     if(user_id != '' && amount != ''){

			 $.ajax({

				  url     : "<?=base_url()?>"+'payroll/update_salary/',

				  data    : { user_id : user_id,amount : amount,type : ty,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				  type    :"POST",

				  success : function(res){ 

				             var r_url = "<?=base_url()?>"+'payroll/';

						     if(res == 1){

								 window.location = r_url;

							 }

				  }

			 }); 	

		 }

	} 

function staff_salary_detail(user_id)

	{ 	  

		 var year    = $.trim($('#payslip_year').val());

		 var month   = $.trim($('#payslip_month').val());

	     if(user_id != ''){

			 $.ajax({

				  url     : "<?=base_url()?>"+'payroll/salary_detail/',

				  data    : { user_id : user_id,year : year,month : month,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },

				  type    :"POST",

				  dataType:"json",

				  success : function(res){ 

				              if(res){

 								     $('#payslip_basic').val(res.basic); 

									 $('#payslip_da').val(res.da); 

									 $('#payslip_hra').val(res.hra);  

							  } 

 				  }

			 }); 	

		 }

	} 	
</script>

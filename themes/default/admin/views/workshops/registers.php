<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$v = '';

if ($this->input->post('event_id')) {
    $v .= '&event_id=' . $this->input->post('event_id');
}

if ($this->input->post('start_date')) {
    $v .= '&start_date=' . $this->input->post('start_date');
}
if ($this->input->post('end_date')) {
    $v .= '&end_date=' . $this->input->post('end_date');
}
?>
<script>
    $(document).ready(function () {
     
        oTable = $('#BrandTable').dataTable({
            "aaSorting": [[3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
                        'sAjaxSource': '<?= admin_url('workshops/getRegisterevents/?v=1' . $v) ?>',

            // 'sAjaxSource': '<?= admin_url('workshops/getRegisters') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({ 'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback });
            },
            "aoColumns": [{ "bSortable": false, "mRender": checkbox },
            { "bSortable": false, "mRender": img_hl },
                null,
                null,
                null, null, { "bSortable": false }]
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form').hide();
        $('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });

    });
</script>
<?= admin_form_open('workshops/register_actions', 'id="action-form"','autocomplete="off"') ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-th-list"></i>
            <?= lang('register_event'); ?>
             <?php
            if ($this->input->post('start_date')) {
                echo 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
            }
            ?>
        </h2>
    
      

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
            <a href="<?php echo admin_url('workshops/add_register'); ?>" data-toggle="modal"
                                data-target="#myModal">
                                <i class="fa fa-plus"></i>
                                <?= lang('add_register_event') ?>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo admin_url('workshops/register_events'); ?>">
                            <i class="fa fa-th-list"></i>
                            <?= lang('report_register') ?>
                        </a>
                        </li>
                         <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="#" id="delete" data-action="delete">
                                <i class="fa fa-trash-o"></i>
                                <?= lang('delete_register_event') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
             <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                        <i class="icon fa fa-toggle-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>">
                        <i class="icon fa fa-toggle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?= lang('list_results'); ?>
                </p>
                  <div id="form">

                    <div class="row">
                        <div class="col-sm-4">
                          
                            <div class="form-group">
                                <label class="control-label" for="warehouse"><?= lang('event'); ?></label>
                                <?php
                                $ev[''] = lang('select') . ' ' . lang('event');
                                foreach ($event_id as $event) {
                                    $ev[$event->id] = $event->title;
                                }
                                echo form_dropdown('event_id', $ev, (isset($_POST['event_id']) ? $_POST['event_id'] : ''), 'class="form-control" id="event_id" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('event_id') . '"');
                                ?>
                            </div> 

                                                 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang('start_date', 'start_date'); ?>
                                <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : ''), 'class="form-control datetime" id="start_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang('end_date', 'end_date'); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ''), 'class="form-control datetime" id="end_date"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div
                            class="controls"> <?php echo form_submit('submit_report', $this->lang->line('submit'), 'class="btn btn-primary"'); ?> </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table id="BrandTable" class="table table-bordered table-hover table-striped reports-table">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check" />
                                </th>
                                <th style="min-width:40px; width: 40px; text-align: center;">
                                    <?= lang('image'); ?>
                                </th>
                                <th>
                                    <?= lang('name'); ?>
                                </th>
                                <th>
                                    <?= lang('events'); ?>
                                </th>
                                <th>
                                    <?= lang('phone'); ?>
                                </th>
                                <th>
                                    <?= lang('email'); ?>
                                </th>
                                <th style="width:100px;">
                                    <?= lang('actions'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="dataTables_empty">
                                    <?= lang('loading_data_from_server') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action" />
    <?= form_submit('submit', 'submit', 'id="action-form-submit"') ?>
</div>
<?= form_close() ?>
<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>

<script language="javascript">
    $(document).ready(function () {

        $('#delete').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#excel').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#pdf').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

    });
</script>
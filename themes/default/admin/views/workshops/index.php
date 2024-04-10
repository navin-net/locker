<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        function active_yn(x) {
            return x == 1 ?
                '<div class="text-center"><span class="label label-primary"><?= lang('active'); ?></span></div>' :
                '<div class="text-center"><span class="label label-danger"><?= lang('inactive'); ?></span></div>';
        }

        function type(x) {
               return x == 'events' ?
                '<div class="text-center"><span class="label label-primary"><?= lang('events'); ?></span></div>' :
                '<div class="text-center"><span class="label label-danger"><?= lang('workshops'); ?></span></div>';
        }
        oTable = $('#BrandTable').dataTable({
            "aaSorting": [
                [3, "asc"]
            ],
            "aLengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "<?= lang('all') ?>"]
            ],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true,
            'bServerSide': true,
            'sAjaxSource': '<?= admin_url('workshops/getEvents') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            },
            "aoColumns": [{ "bSortable": false, "mRender": checkbox },
            { "bSortable": false, "mRender": img_hl }, null, { "mRender": type }, null, null, null, null, { "mRender": active_yn }, { "bSortable": false }
            ]
        });
    });
</script>
<?= admin_form_open('workshops/actions', 'id="action-form"') ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-th-list"></i>
            <?= lang('event_or_workshop'); ?>
        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?php echo admin_url('workshops/add'); ?>" data-toggle="modal"
                                data-target="#myModal">
                                <i class="fa fa-plus"></i>
                                <?= lang('add_event') ?>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="#" id="delete" data-action="delete">
                                <i class="fa fa-trash-o"></i>
                                <?= lang('delete_events') ?>
                            </a>
                        </li>
                    </ul>
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
                                    <?= lang('title'); ?>
                                </th>
                                <th>
                                    <?= lang('type'); ?>
                                </th>
                                <th>
                                    <?= lang('location'); ?>
                                </th>
                                <th>
                                    <?= lang('start_date'); ?>
                                </th>
                                <th>
                                    <?= lang('end_date'); ?>
                                </th>
                                <th>
                                    <?= lang('created_by'); ?>
                                </th>
                                <th>
                                    <?= lang('status'); ?>
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
<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('add_event'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('workshops/add', $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('enter_info'); ?>
            </p>
            <div class="form-group">
                <?= lang('title', 'title'); ?>
                <?= form_input('title', '', 'class="form-control gen_slug" id="title" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('type', 'type'); ?>
                <!-- <?= form_input('type', '', 'class="form-control gen_slug" id="type" required="required"'); ?> -->
                <?php
                $opt = ['events' => lang('events'), 'workshops' => lang('workshops')];
                echo form_dropdown('type', $opt, ($_POST['type'] ?? ''), 'id="type"  class="form-control select" style="width:100%;"');
                ?>
            </div>
            <div class="form-group">
                <?= lang('location', 'location'); ?>
                <?= form_input('location', '', 'class="form-control gen_slug" id="location" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('speaker', 'name'); ?>
                <?php
                // $cat[] = '';
                foreach ($speakers as $speaker) {
                    $sk[$speaker->id] = $speaker->name;
                }
                echo form_dropdown(
                    'speaker_id[]',
                    $sk,
                    set_value('speaker_id[]'),
                    'id="speaker_id[]"  class="form-control select" placeholder="' . lang('select') . ' ' . lang('speaker_id') . '" required="required" data-live-search="true" multiple style="width:100%"'
                );
                ?>
            </div>


            <div class="form-group">
                <?= lang('start_date', 'start_date'); ?>
                <?php echo form_input('start_date', (isset ($_POST['start_date']) ? $_POST['start_date'] : ''), 'class="form-control input-tip datetime" id="start_date" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('end_date', 'end_date'); ?>
                <?php echo form_input('end_date', (isset ($_POST['end_date']) ? $_POST['end_date'] : ''), 'class="form-control input-tip datetime" id="end_date" required="required"'); ?>
            </div>

            <div class="form-group">
                <?= lang('status', 'status'); ?>
                <?php
                $opt = [1 => lang('active'), 0 => lang('inactive')];
                echo form_dropdown('status', $opt, ($_POST['status'] ?? ''), 'id="status"  class="form-control select" style="width:100%;"');
                ?>
            </div>
            <div class="form-group">
                <?= lang('description', 'description'); ?>
                <?= form_input('description', '', 'class="form-control gen_slug" id="description" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>


        </div>
        <div class="modal-footer">
            <?php echo form_submit('add', lang('add'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function () {
        $('.gen_slug').change(function (e) {
            getSlug($(this).val(), 'brand');
        });
    });
</script>
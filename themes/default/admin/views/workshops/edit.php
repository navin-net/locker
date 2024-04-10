<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('edit_event'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('workshops/edit/' . $event_details->id, $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('update_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('title', 'title'); ?>
                <?= form_input('title', $event_details->title, 'class="form-control" id="title" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('type', 'type'); ?>
                <?php
                $ty = ['events' =>  lang('events'), 'workshops' => lang('workshops')];
                echo form_dropdown('type', $ty, ($_POST['type'] ?? $event_details->type), 
                    'id="type"  class="form-control input-tip select" style="width:100%;"');
                ?>
            </div>
            <div class="form-group">
                <?= lang('location', 'location'); ?>
                <?= form_input('location', $event_details->location, 'class="form-control" id="location" required="required"');
                ?>
            </div>
            <div class="form-group">
                <?= lang('speakers', 'name'); ?>
                <?php

                foreach ($speakers as $speaker) {
                    $opt[$speaker->id] = $speaker->name;
                }

                foreach ($eventSpeakers as $t) {
                    $nt[] = $t->name;
                }

                echo form_multiselect(
                    'speaker_id[]',
                    $opt,
                    set_value('speaker_id', ($nt == $opt ? $opt : '')),
                    'id="speaker_id[]"  class="form-control select" placeholder="' . lang('select') . ' ' . lang('speaker') . '" required="required" data-live-search="true"  style="width:100%"'
                );
                ?>
            </div>
            <div class="form-group">
                <?= lang('start_date', 'start_date'); ?>
                <?php echo form_input('start_date', (isset ($_POST['start_date']) ? $_POST['start_date'] : $this->sma->hrld($event_details->start_date)), 'class="form-control input-tip datetime" id="start_date" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('end_date', 'end_date'); ?>
                <?php echo form_input('end_date', (isset ($_POST['end_date']) ? $_POST['end_date'] : $this->sma->hrld($event_details->end_date)), 'class="form-control input-tip datetime" id="end_date" required="required"'); ?>
            </div>
      
                       <div class="form-group">
            <?= lang('status', 'status'); ?>
            <?php 
            $opt = [1 => lang('active'), 0 => lang('inactive')];
             echo form_dropdown('status', $opt, ($_POST['status'] ?? $event_details->status), 'id="status" required="required" class="form-control input-tip select" style="width:100%;"'); ?>
            </div>


            <div class="form-group">
                <?= lang('description', 'description'); ?>
                <?= form_input('description', $event_details->description, 'class="form-control" id="description" required="required"');
                ?>
            </div>

            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>
            <?php echo form_hidden('id', $event_details->id); ?>

        </div>

        <div class="modal-footer">
            <?php echo form_submit('edit', lang('edit'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function () {
        $('.gen_slug').change(function (e) {
            getSlug($(this).val(), 'category');
        });
    });
</script>
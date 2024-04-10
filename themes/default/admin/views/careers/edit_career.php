<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_career'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('careers/edit_career/' . $career->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('update_info'); ?></p>

            <div class="form-group">
                <?= lang('job_title', 'job_title'); ?>
                <?= form_input('job_title', $career->job_title, 'class="form-control" id="job_title"'); ?>
            </div>

            <div class="form-group">
                <?= lang('position', 'position'); ?>
                <?= form_input('position', $career->position, 'class="form-control gen_slug" id="position" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('location', 'location'); ?>
                <?= form_input('location', $career->location, 'class="form-control gen_slug" id="location" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('start_date','start_date');?>
                <?= form_input('start_date',date_format(date_create($career->start_date),'d/m/Y') ,'class="form-control input-tip date" id="start_date" required="required"');?>
            </div>
            <div class="form-group">
                <?= lang('end_date','end_date');?>
                <?= form_input('end_date',date_format(date_create($career->end_date),'d/m/Y'),'class="form-control input-tip date " id="end_date" required="required"');?>

            </div>

            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" data-show-upload="false" data-show-preview="false"
                       class="form-control file">
            </div>
            <?php echo form_hidden('id', $career->id); ?>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_career', lang('edit_career'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function() {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'career');
        });
    });
</script>














<!--  -->
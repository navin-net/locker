<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('add_register'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('workshops/add_register', $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('enter_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', '', 'class="form-control " id="name" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('events', 'event_id'); ?>
                <?php
                foreach ($events as $v) {
                    $cat[$v->id] = $v->title;
                }
                echo form_dropdown('event_id', $cat, set_value('event_id'), 'id="event_id" class="form-control select" style="width:100%;" required="required"');
                ?>
            </div>
            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', '', 'class="form-control " id="phone" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('email', 'email'); ?>
                <?= form_input('email', '', 'class="form-control " id="email" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('address', 'address'); ?>
                <?= form_input('address', '', 'class="form-control " id="address" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('company', 'company'); ?>
                <?= form_input('company', '', 'class="form-control " id="company"'); ?>
            </div>
            <div class="form-group">
                <?= lang('dob', 'dob'); ?>
                <?= form_input('dob', '', 'class="form-control input-tip date" id="dob"'); ?>
            </div>
            <div class="form-group">
                <?= lang('intagram', 'intagram'); ?>
                <?= form_input('intagram', '', 'class="form-control " id="intagram" '); ?>
            </div>
            <div class="form-group">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', '', 'class="form-control " id="twitter" '); ?>
            </div>
            <div class="form-group">
                <?= lang('description', 'description'); ?>
                <?= form_input('description', '', 'class="form-control " id="description" '); ?>
            </div>

            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>



        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_register', lang('add_register'), 'class="btn btn-primary"'); ?>
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
<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('add_speaker'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('workshops/add_speaker', $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('enter_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', '', 'class="form-control gen_slug" id="name" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', '', 'class="form-control gen_slug" id="phone" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('address', 'address'); ?>
                <?= form_input('address', '', 'class="form-control gen_slug" id="address" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('email', 'email'); ?>
                <?= form_input('email', '', 'class="form-control gen_slug" id="email" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('dob','dob');?>
                <?= form_input('dob','','class="form-control" id="dob" ');?>
                
            </div>
                  <div class="form-group">
                <?= lang('company','company');?>
                <?= form_input('company','','class="form-control" id="company" ');?>
                
            </div>
            <div class="form-group">
                <?= lang('telegram', 'telegram'); ?>
                <?= form_input('telegram', '', 'class="form-control gen_slug" id="telegram"'); ?>
            </div>
            <div class="form-group">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', '', 'class="form-control gen_slug" id="twitter"'); ?>
            </div>
            <div class="form-group">
                <?= lang('facebook', 'facebook'); ?>
                <?= form_input('facebook', '', 'class="form-control gen_slug" id="facebook" '); ?>
            </div>
            <div class="form-group">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', '', 'class="form-control gen_slug" id="twitter" '); ?>
            </div>

            <div class="form-group">
                <?= lang('intagram', 'intagram'); ?>
                <?= form_input('intagram', '', 'class="form-control gen_slug" id="intagram"'); ?>
            </div>
            <div class="form-group">
                <?= lang('youtube', 'youtube'); ?>
                <?= form_input('youtube', '', 'class="form-control gen_slug" id="youtube" '); ?>
            </div>
            <div class="form-group">
                <?= lang('short_description', 'short_description'); ?>
                <?= form_input('short_description', '', 'class="form-control gen_slug" id="short_description" '); ?>
            </div>
            <div class="form-group">
                <?= lang('descriptions', 'descriptions'); ?>
                <?= form_input('descriptions', '', 'class="form-control gen_slug" id="descriptions" '); ?>
            </div>
            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>



        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_speaker', lang('add_speaker'), 'class="btn btn-primary"'); ?>
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
<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('edit_speaker'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('workshops/edit_speaker/' . $speakers->id, $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('update_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', $speakers->name, 'class="form-control" id="name"'); ?>
            </div>
            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', $speakers->phone, 'class="form-control" id="phone"'); ?>
            </div>
            <div class="form-group">
                <?= lang('email', 'email'); ?>
                <?= form_input('email', $speakers->email, 'class="form-control" id="email"'); ?>
            </div>
            <div class="form-group">
                <?= lang('address', 'address'); ?>
                <?= form_input('address', $speakers->address, 'class="form-control" id="address"'); ?>
            </div>
            <div class="form-group">
                <?= lang('company', 'company'); ?>
                <?= form_input('company', $speakers->company, 'class="form-control" id="company"'); ?>
            </div>
            <div class="form-group">
                <?= lang('dob', 'dob'); ?>
                <?= form_input('dob', $speakers->dob, 'class="form-control" id="dob"'); ?>
            </div>
            <div class="form-group">
                <?= lang('facebook', 'facebook'); ?>
                <?= form_input('facebook', $speakers->facebook, 'class="form-control" id="facebook"'); ?>
            </div>
            <div class="form-group">
                <?= lang('intagram', 'intagram'); ?>
                <?= form_input('intagram', $speakers->intagram, 'class="form-control" id="intagram"'); ?>
            </div>
            <div class="form-group">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', $speakers->twitter, 'class="form-control" id="twitter"'); ?>
            </div>
            <div class="form-group">
                <?= lang('youtube', 'youtube'); ?>
                <?= form_input('youtube', $speakers->youtube, 'class="form-control" id="youtube"'); ?>
            </div>
            <div class="form-group">
                <?= lang('telegram', 'telegram'); ?>
                <?= form_input('telegram', $speakers->telegram, 'class="form-control" id="telegram"'); ?>
            </div>
            <div class="form-group">
                <?= lang('short_description', 'short_description'); ?>
                <?= form_input('short_description', $speakers->short_description, 'class="form-control" id="short_description"'); ?>
            </div>
            <div class="form-group">
                <?= lang('descriptions', 'descriptions'); ?>
                <?= form_input('descriptions', $speakers->descriptions, 'class="form-control" id="descriptions"'); ?>
            </div>
            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

            <?php echo form_hidden('id', $speakers->id); ?>
        </div>

        <div class="modal-footer">
            <?php echo form_submit('edit_speaker', lang('edit_speaker'), 'class="btn btn-primary"'); ?>
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
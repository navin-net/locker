<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('add_partner'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('partners/add_partner', $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('enter_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', '', 'class="form-control" id="name" required="required"'); ?>
            </div>

            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', '', 'class="form-control gen_slug" id="phone" required="required"'); ?>
            </div>

            <div class="form-group all">
                <?= lang('address', 'address'); ?>
                <?= form_input('address', set_value('address'), 'class="form-control tip" id="address" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('email','email'); ?>
                <?= form_input('email', set_value('email'),'class="form-control tip" id="email" required="required"'); ?>
                
            </div>

            <div class="form-group all">
                <?= lang('telegram', 'telegram'); ?>
                <?= form_input('telegram', set_value('telegram'), 'class="form-control tip" id="telegram" '); ?>
            </div>

            <div class="form-group all">
                <?= lang('website', 'website'); ?>
                <?= form_input('website', set_value('website'), 'class="form-control tip" id="website" '); ?>
            </div>
            <div class="form-group all">
                <?= lang('facebook', 'facebook'); ?>
                <?= form_input('facebook', set_value('facebook'), 'class="form-control tip" id="facebook" '); ?>
            </div>
            <div class="form-group all">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', set_value('twitter'), 'class="form-control tip" id="twitter" '); ?>
            </div>
            <div class="form-group all">
                <?= lang('intagram', 'intagram'); ?>
                <?= form_input('intagram', set_value('intagram'), 'class="form-control tip" id="intagram" '); ?>
            </div>



            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_partner', lang('add_partner'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function () {
        $('.gen_slug').change(function (e) {
            getSlug($(this).val(), 'partner');
        });
    });
</script>
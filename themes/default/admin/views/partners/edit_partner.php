<?php defined('BASEPATH') or exit ('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo lang('edit_partner'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('partners/edit_partner/' . $partner->id, $attrib); ?>
        <div class="modal-body">
            <p>
                <?= lang('update_info'); ?>
            </p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', $partner->name, 'class="form-control" id="name"'); ?>
            </div>

            <div class="form-group">
                <?= lang('phone', 'phone'); ?>
                <?= form_input('phone', $partner->phone, 'class="form-control gen_slug" id="phone" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('address', 'address'); ?>
                <?= form_input('address', $partner->address, 'class="form-control gen_slug" id="address" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('email' ,'email'); ?>
                <?= form_input('email' , $partner->email,'class="form-control" id="email" required="required"');?>
                
            </div>
            <div class="form-group">
                <?= lang('telegram', 'telegram'); ?>
                <?= form_input('telegram', $partner->telegram, 'class="form-control gen_slug" id="telegram" required="required"'); ?>
            </div>
            <div class="form-group">
                <?= lang('website', 'website'); ?>
                <?= form_input('website', $partner->website, 'class="form-control id="website"')
                ; ?>
            </div>
            <div class="form-group">
                <?= lang('facebook', 'facebook'); ?>
                <?= form_input('facebook', $partner->facebook, 'class="form-control id="facebook"')
                ; ?>
            </div>
            <div class="form-group">
                <?= lang('twitter', 'twitter'); ?>
                <?= form_input('twitter', $partner->twitter, 'class="form-control id="twitter"')
                ; ?>
            </div>
            <div class="form-group">
                <?= lang('intagram', 'intagram'); ?>
                <?= form_input('intagram', $partner->intagram, 'class="form-control id="intagram"')
                ; ?>
            </div>




            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>
            <?php echo form_hidden('id', $partner->id); ?>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_partner', lang('edit_partner'), 'class="btn btn-primary"'); ?>
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














<!--  -->
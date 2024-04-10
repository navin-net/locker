<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_new'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('news/add_new', $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
          
           <div class="form-group">
                <?= lang('title', 'title'); ?>
                <?= form_input('title', '', 'class="form-control " id="title" '); ?>
            </div>
            <div class="form-group">
                <?= lang('category', 'category_id'); ?>
                <?php
                 foreach ($categories as $category) {
                     $cat[$category->id]  = $category->name;
                 }
                echo form_dropdown('category_id', $cat, set_value('category_id'), 'id="category_id" class="form-control select "  data-live-search="true"  style="width:100%;"');
                ?>
            </div>
            <div class="form-group">
                    <?= lang('tags','name'); ?>
                          <?php
                    // $cat[] = '';
                     foreach ($tags as $tag) {
                         $opt[$tag->id]  = $tag->name;
                     }
                    echo form_multiselect('tag_id[]', $opt, set_value('tag_id[]'), 
                        'id="tag_id[]"  class="form-control select" placeholder="' . lang('select') . ' ' . lang('tag') . '" required="required" data-live-search="true" multiple style="width:100%"');
                     ?> 
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
                <?= form_input('description', '', 'class="form-control " id="description" '); ?>
            </div>
            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>
            




        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_new', lang('add_new'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function() {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'brand');
        });
    });
</script>
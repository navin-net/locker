<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_new'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('news/edit_new/' . $new_details->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('update_info'); ?></p>
            
              <div class="form-group">
                <?= lang('title', 'title'); ?>
                <?= form_input('title', $new_details->title, 'class="form-control" id="title" required="required"'); ?>
            </div>


       <div class="form-group">
                <?= lang('category', 'category_id'); ?>
                <?php
                 foreach ($categories as $category) {
                     $cat[$category->id]  = $category->name;
                 }
                echo form_dropdown('category_id', $cat,  set_value('category_id',$new_details->category_id), 'id="category_id"  class="form-control select"  style="width:100%;" required="required" ');
                ?>
            </div> 
       <div class="form-group">
                    <?= lang('tags','name'); ?>
                          <?php
        
                     foreach ($tags as $tag) {
                         $opt[$tag->id]  = $tag->name;
                     }

                     foreach($newsTags as $t){
                        $nt[] = $t->name;
                     }
                     // $this->sma->print_arrays($nt);

                    echo form_multiselect('tag_id[]', $opt, set_value('tag_id',($nt==$opt ? $opt :'')), 
                        'id="tag_id[]"  class="form-control select" placeholder="' . lang('select') . ' ' . lang('tag') . '" required="required" data-live-search="true"  style="width:100%"');
                     ?> 
                </div> 
 
          
            <div class="form-group">
                <?= lang('status', 'status'); ?>
                <?php
                $opt = [1 => lang('active'), 0 => lang('inactive')];
                echo form_dropdown('status', $opt, ($_POST['status'] ?? ''), 'id="status"  class="form-control select" style="width:100%;" required="required"');
                ?>
            </div>

      <div class="form-group">
                <?= lang('description' , 'description'); ?>
                <?= form_input('description', $new_details->description, 'class=form-control id="description" required="required"');
                ?>
            </div> 

    <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" data-show-upload="false" data-show-preview="false"
                       class="form-control file">
            </div>
            <?php echo form_hidden('id', $new_details->id); ?>

        </div>

          <div class="modal-footer">
            <?php echo form_submit('edit_new', lang('edit_new'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    $(document).ready(function() {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'category');
        });
    });
</script>
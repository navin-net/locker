<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_career'); ?></h4>
        </div>
 <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('careers/add_career', $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="form-group">
                <?= lang('job_title', 'job_title'); ?>
                <?= form_input('job_title', '', 'class="form-control" id="job_title" required="required"'); ?>
            </div>

            <div class="form-group">
                <?= lang('position', 'position'); ?>
                <?= form_input('position', '', 'class="form-control " id="position" required="required"'); ?>
            </div>

            <div class="form-group all">
                <?= lang('location', 'location'); ?>
                <?= form_input('location', set_value('location'), 'class="form-control tip" id="location" required="required"'); ?>
            </div>


            <div class="form-group">
                <?= lang('end_date', 'end_date'); ?>
            <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date']: ''), 'class="form-control input-tip date" id="end_date" required="required"'); ?>
                                </div>
          
                                
            <div class="form-group">
                <?= lang('image', 'image') ?>
                <input id="image" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile"
                    data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

          

          <!--   <div class="form-group">
                <?= lang('file', 'file') ?>
                <input id="file" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>
 -->
        </div>
    
        <div class="modal-footer">
            <?php echo form_submit('add_career', lang('add_career'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
<script>
    // $(document).ready(function() {
    //     if (localStorage.getItem('start_date')) {
    //             localStorage.removeItem('start_date');
    //         }
    //     $('.gen_slug').change(function(e) {
    //         getSlug($(this).val(), 'career');
    //     });

    // });
    // if (!localStorage.getItem('start_date')) {
    //         $("#start_date").datetimepicker({
    //             format: site.dateFormats.js_ldate,
    //             fontAwesome: true,
    //             language: 'sma',
    //             weekStart: 1,
    //             todayBtn: 1,
    //             autoclose: 1,
    //             todayHighlight: 1,
    //             startView: 2,
    //             forceParse: 0
    //         }).datetimepicker('update', new Date());
    //     }
    //     $(document).on('change', '#start_date', function (e) {
    //         localStorage.setItem('start_date', $(this).val());
    //     });
    //     if (start_date = localStorage.getItem('start_date')) {
    //         $('#start_date').val(start_date);
    //     }
</script>

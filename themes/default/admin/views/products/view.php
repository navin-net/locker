<!-- <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($Owner || $Admin) {
    ?>
    <ul id="myTab" class="nav nav-tabs">
        <li class=""><a href="#details" class="tab-grey"><?= lang('product_details') ?></a></li>
      
        <?php
    } ?>
    </ul>

<div class="tab-content">
    <div id="details" class="tab-pane fade in">
        <?php
 ?>
        <div class="box">
            <div class="box-header">
             
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= base_url() ?>assets/uploads/<?= $product->image ?>"
                                     alt="<?= $product->name ?>" class="img-responsive img-thumbnail"/>

                                <div id="multiimages" class="padding10">
                                    <?php if (!empty($images)) {
        echo '<a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . 'assets/uploads/' . $product->image . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . 'assets/uploads/thumbs/' . $product->image . '" alt="' . $product->image . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
    
    }
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped dfTable table-right-left">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr>
                             
                                        <tr>
                                            <td><?= lang('type'); ?></td>
                                            <td><?php echo lang($product->type); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang('name'); ?></td>
                                            <td><?php echo $product->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= lang('code'); ?></td>
                                            <td><?php echo $product->code; ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td><?= lang('brand'); ?></td>
                                            <td><?= $brand ? $brand->name : ''; ?></td>
                                        </tr> -->
                                        <tr>
                                        <td><?= lang('brand'); ?></td>
                                        <td><?php echo $brand->name; ?></td>

                                        </tr>
                                        <tr>
                                            <td><?= lang('category'); ?></td>
                                            <td><?php echo $category->name; ?></td>
                                        </tr>
                                        <?php if ($product->subcategory_id) {
                                        ?>
                                            <tr>
                                                <td><?= lang('subcategory'); ?></td>
                                                <td><?php echo $subcategory->name; ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <tr>
                                            <td><?= lang('unit'); ?></td>
                                            <td><?= $unit ? $unit->name . ' (' . $unit->code . ')' : ''; ?></td>
                                        </tr>
                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                
                    </div>
                </div>
            </div>
        </div>
        <!-- <script type="text/javascript">
            $(document).ready(function () {
                $('.tip').tooltip();
            });
        </script> -->
  




 -->
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($Owner || $Admin) {
    ?>
<ul id="myTab" class="nav nav-tabs">
    <li class=""><a href="#details" class="tab-grey"><?= lang('event_details') ?></a></li>

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
                                <img src="<?= base_url() ?>assets/uploads/<?= $event->image ?>"
                                    alt="<?= $event->title ?>" class="img-responsive img-thumbnail" />
                                <div id="multiimages" class="padding10">
                                    <?php if (!empty($images)) {
                             echo '<a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="' . base_url() . 'assets/uploads/' . $event->image . '" style="margin-right:5px;"><img class="img-responsive" src="' . base_url() . 'assets/uploads/thumbs/' . $event->image . '" alt="' . $event->image . '" style="width:' . $Settings->twidth . 'px; height:' . $Settings->theight . 'px;" /></a>';
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
                                                <td><?= lang('title');?></td>
                                                <td><?php echo $event->title; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('type'); ?></td>
                                                <td><?php echo $event->type; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('location');?></td>
                                                <td><?php echo$event->location; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('start_date'); ?></td>
                                                <td><?php echo$event->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('end_date'); ?></td>
                                                <td><?php echo$event->end_date; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('description'); ?></td>
                                                <td><?php echo$event->description; ?></td>
                                            </tr>

                                            <table
                                                class="table table-bordered table-striped table-condensed dfTable three-columns">
                                                <thead>
                                                    <tr>
                                                        <th><?= lang('list_register') ?></th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($event_register as $key) { ?>
                                                    
                    <td><?php echo'<tr><td style="text-align: center;">'.'   '.$key->rname.'</tr></td><strong>';?>
                                                    </td>
                                                    <?php } ?>

                                                </tbody>
                                                </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <table
                                            class="table table-bordered table-striped table-condensed dfTable three-columns">
                                            <thead>
                                                <tr>
                                                    <th><?= lang('list_speakers') ?></th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($event_speaker as $key) { ?>
                            <td><?php echo'<tr><td style="text-align: center;">'.$key->name.'</tr></td><strong>';?>
                                                </td>
                                                <?php } ?>

                                            </tbody>
                                            </tr>
                                    </div>
                                    <div class="col-6 col-sm-7">
                            
                                    </div>
                                        </tbody>
                                        </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
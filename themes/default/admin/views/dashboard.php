<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
function row_status($x)
{
    if ($x == null) {
        return '';
    } elseif ($x == 'pending') {
        return '<div class="text-center"><span class="label label-warning">' . lang($x) . '</span></div>';
    } elseif ($x == 'completed' || $x == 'paid' || $x == 'sent' || $x == 'received') {
        return '<div class="text-center"><span class="label label-success">' . lang($x) . '</span></div>';
    } elseif ($x == 'partial' || $x == 'transferring') {
        return '<div class="text-center"><span class="label label-info">' . lang($x) . '</span></div>';
    } elseif ($x == 'due') {
        return '<div class="text-center"><span class="label label-danger">' . lang($x) . '</span></div>';
    }
    return '<div class="text-center"><span class="label label-default">' . lang($x) . '</span></div>';
}


?>
<?php if (($Owner || $Admin) && $chatData) {
    foreach ($chatData as $month_sale) {
        $months[]     = date('M-Y', strtotime($month_sale->month));
        $msales[]     = $month_sale->sales;
        $mtax1[]      = $month_sale->tax1;
        $mtax2[]      = $month_sale->tax2;
        $mpurchases[] = $month_sale->purchases;
        $mtax3[]      = $month_sale->ptax;
    } ?>
    <div class="box" style="margin-bottom: 15px;">
        <div class="box-header">
            <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i><?= lang('overview_chart'); ?></h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-12">
                    <p class="introtext"><?php echo lang('overview_chart_heading'); ?></p>

                    <div id="ov-chart" style="width:100%; height:450px;"></div>
                    <p class="text-center"><?= lang('chart_lable_toggle'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php
} ?>
<?php if ($Owner || $Admin) {
        ?>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span><?= lang('quick_links') ?></h2>
            </div>
            <div class="box-content">
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bblue white quick-button small" href="<?= admin_url('products') ?>">
                        <i class="fa fa-barcode"></i>

                        <p><?= lang('products') ?></p>
                    </a>
                </div>
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bdarkGreen white quick-button small" href="<?= admin_url('news') ?>">
                        <i class="fa fa-heart"></i>

                        <p><?= lang('news') ?></p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="blightOrange white quick-button small" href="<?= admin_url('System_settings/brands') ?>">
                        <i class="fa fa-heart-o"></i>

                        <p><?= lang('brands') ?></p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bred white quick-button small" href="<?= admin_url('careers') ?>">
                        <i class="fa fa-star"></i>

                        <p><?= lang('careers') ?></p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bpink white quick-button small" href="<?= admin_url('workshops') ?>">
                        <i class="fa fa-star-o"></i>

                        <p><?= lang('workshops') ?></p>
                    </a>
                </div>

             

               

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="blightBlue white quick-button small" href="<?= admin_url('notifications') ?>">
                        <i class="fa fa-comments"></i>

                        <p><?= lang('notifications') ?></p>
                        <!--<span class="notification green">4</span>-->
                    </a>
                </div>

                <?php if ($Owner) {
            ?>
                    <div class="col-lg-1 col-md-2 col-xs-6">
                        <a class="bblue white quick-button small" href="<?= admin_url('auth/users') ?>">
                            <i class="fa fa-group"></i>
                            <p><?= lang('users') ?></p>
                        </a>
                    </div>
                    <div class="col-lg-1 col-md-2 col-xs-6">
                        <a class="bblue white quick-button small" href="<?= admin_url('system_settings') ?>">
                            <i class="fa fa-cogs"></i>

                            <p><?= lang('settings') ?></p>
                        </a>
                    </div>
                <?php
        } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php
    } else {
        ?>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span><?= lang('quick_links') ?></h2>
            </div>
            <div class="box-content">
            <?php if ($GP['products-index']) {
            ?>
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bblue white quick-button small" href="<?= admin_url('products') ?>">
                        <i class="fa fa-barcode"></i>
                        <p><?= lang('products') ?></p>
                    </a>
                </div>
            <?php
            } if($GP['news-index']){
                ?>
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a  class="bblue white quick-button small" href="<?= admin_url('news') ?>">
                        <i class="fa fa-2x"></i>
                        <p><?= lang('news')?></p>
                    </a>
                    
                </div>
                <?php
            }
         ?>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php
    } ?>

<div class="row" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-tasks"></i> <?= lang('latest_five') ?></h2>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-12">

                        <ul id="dbTab" class="nav nav-tabs">
                            <?php  if ($Owner || $Admin || $GP['products-index']){
        ?>
                            <li class=""><a href="#products"><?= lang('products') ?></a></li>
                            <?php
                        } if ($Owner || $Admin || $GP['news-index']) {
        ?>
                            <li class=""><a href="#news"><?= lang('news') ?></a></li>
                            <?php
            } if ($Owner || $Admin || $GP['brands-index']) {
        ?>
                            <li class=""><a href="#brands"><?= lang('brands') ?></a></li>
                            <?php
            } if ($Owner || $Admin || $GP['careers-index']) {
        ?>
                            <li class=""><a href="#careers"><?= lang('careers') ?></a></li>
                            <?php
            } if ($Owner || $Admin || $GP['events-index']) {
        ?>
                            <li class=""><a href="#events"><?= lang('workshops') ?></a></li>
                            <?php     
        } ?>
                        </ul>

                        <div class="tab-content">
    

<?php      
    if($Owner  || $Admin || $GP['products-index']){
    ?>
           <div id="products" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="products-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th><?= $this->lang->line('code'); ?></th>
                                                    <th><?= $this->lang->line('name'); ?></th>
                                                    <th><?= $this->lang->line('unit'); ?></th>
                                                    <th><?= $this->lang->line('cost'); ?></th>
                                                    <th><?= $this->lang->line('price'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($products)) {
            $r = 1;
            foreach ($products as $product) {
                echo '<tr id="' . $product->id . '" class="product_link pointer"><td>' . $r . '</td>
                                            <td>' . $product->code . '</td>
                                            <td>' . $product->name . '</td>
                                            <td>' . $product->unit . '</td>
                                            <td>' . $product->cost . '</td>
                                            <td>' . $product->price . '</td>
                                        </tr>';
                $r++;
            }
        } else {
            ?>
                                                    <tr>
                                                        <td colspan="6"
                                                            class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                    </tr>
                                                <?php
        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <?php
    } if ($Owner || $Admin || $GP['brands-index']) {
        ?>
                            <div id="brands" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="brands-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th><?= $this->lang->line('image'); ?></th>
                                                    <th><?= $this->lang->line('code'); ?></th>

                                                    <th><?= $this->lang->line('name'); ?></th>
                                                    <th><?= $this->lang->line('slug'); ?></th>

                                         
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($brands)) {
            $r = 1;
            foreach ($brands as $brand) {
                echo '<tr id="' . $brand->id . '" class="brand_link pointer"><td>' . $r . '</td>
                <td><img src="' . base_url('assets/uploads/' . $brand->image) . '" alt="' . $brand->name . '" style="width: 30px;"></td>
                                            <td>' . $brand->code . '</td>
                                            <td>' . $brand->name . '</td>
                                            <td>' . $brand->slug . '</td>

                                        </tr>';
                $r++;
            }

        } else {
            ?>
                                                    <tr>
                                                        <td colspan="6"
                                                            class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                    </tr>
                                                <?php
        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

  <!--                           <?php
    } if ($Owner || $Admin || $GP['careers-index']) {
        ?> 
                       <div id="careers" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="careers-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th><?= $this->lang->line('job_title'); ?></th>
                                                    <th><?= $this->lang->line('position'); ?></th>
                                                    <th><?= $this->lang->line('location'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($careers)) {
            $r = 1;
            foreach ($careers as $career) {
                echo '<tr id="' . $career->id . '" class="career_link pointer"><td>' . $r . '</td>
                                            <td>' . $career->job_title . '</td>
                                            <td>' . $career->position . '</td>
                                            <td>' . $career->location . '</td>
                                        </tr>';
                $r++;
            }
        } else {
            ?>
                                                    <tr>
                                                        <td colspan="6"
                                                            class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                    </tr>
                                                <?php
        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

        <?php  
    } if ($Owner || $Admin || $GP['news-index']) {
        ?>

                            <div id="news" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="news-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                <th style="width:30px !important;">#</th>
                                                    <th><?= $this->lang->line('title'); ?></th>
                                                    <th><?= $this->lang->line('category_name');?></th>
                                                    <th><?= $this->lang->line('description'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
            <?php if (!empty($news)) {
            $r = 1;
            foreach ($news as $new) {
                echo '<tr id="' . $new->id . '" class="new_link pointer"><td>' . $r . '</td>
                                            <td>' . $new->title . '</td>
                                            <td>' . $new->name . '</td>
                                            <td>' . $new->description . '</td>

                                        </tr>';
                $r++;
            }
        } else {
            ?>
                                                    <tr>
                                                        <td colspan="6"
                                                            class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                    </tr>
                                                <?php
        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

          } if ($Owner || $Admin || $GP['events-index']) {
        ?>

                            <div id="events" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="events-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                <th style="width:30px !important;">#</th>
                                                    <th><?= $this->lang->line('title'); ?></th>
                                                    <th><?= $this->lang->line('type');?></th>
                                                    <th><?= $this->lang->line('location'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($events)) {
            $r = 1;
            foreach ($events as $event) {
                echo '<tr id="' . $event->id . '" class="event_link pointer"><td>' . $r . '</td>
                                            <td>' . $event->title . '</td>
                                            <td>' . $event->type . '</td>
                                            <td>' . $event->location . '</td>

                                        </tr>';
                $r++;
            }
        } else {
            ?>
                                                    <tr>
                                                        <td colspan="6"
                                                            class="dataTables_empty"><?= lang('no_data_available') ?></td>
                                                    </tr>
                                                <?php
        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
    } ?> -->

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.order').click(function () {
            window.location.href = '<?=admin_url()?>orders/view/' + $(this).attr('id') + '#comments';
        });
        $('.invoice').click(function () {
            window.location.href = '<?=admin_url()?>orders/view/' + $(this).attr('id');
        });
        $('.quote').click(function () {
            window.location.href = '<?=admin_url()?>quotes/view/' + $(this).attr('id');
        });
    });
</script>

<?php if (($Owner || $Admin) && $chatData) {
        ?>
    <style type="text/css" media="screen">
        .tooltip-inner {
            max-width: 500px;
        }
    </style>
    <script src="<?= $assets; ?>js/hc/highcharts.js"></script>
    <script type="text/javascript">
        $(function () {
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                    stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                };
            });
            $('#ov-chart').highcharts({
                chart: {direction: '<?= $Settings->user_rtl ? 'rtl' : 'ltr'; ?>'},
                credits: {enabled: false},
                title: {text: ''},
                xAxis: {categories: <?= json_encode($months); ?>},
                yAxis: {min: 0, title: ""},
                tooltip: {
                    shared: true,
                    followPointer: true,
                    formatter: function () {
                        if (this.key) {
                            return '<div dir="<?= $Settings->user_rtl ? 'rtl' : 'ltr'; ?>" class="tooltip-inner hc-tip" style="margin-bottom:0;">' + this.key + '<br><strong>' + currencyFormat(this.y) + '</strong> (' + formatNumber(this.percentage) + '%)';
                        } else {
                            var s = '<div dir="<?= $Settings->user_rtl ? 'rtl' : 'ltr'; ?>" class="well well-sm hc-tip" style="margin-bottom:0;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                s += '<tr><td style="color:{series.color};padding:0;text-align:<?= $Settings->user_rtl ? 'right' : 'left'; ?>;">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                currencyFormat(this.y) + '</b></td></tr>';
                            });
                            s += '</table></div>';
                            return s;
                        }
                    },
                    useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                    style: {fontSize: '14px', padding: '0', color: '#000000'}
                },
                series: [{
                    type: 'column',
                    name: '<?= lang('sp_tax'); ?>',
                    data: [<?php
                    echo implode(', ', $mtax1); ?>]
                },
                    {
                        type: 'column',
                        name: '<?= lang('order_tax'); ?>',
                        data: [<?php
                    echo implode(', ', $mtax2); ?>]
                    },
                    {
                        type: 'column',
                        name: '<?= lang('sales'); ?>',
                        data: [<?php
                    echo implode(', ', $msales); ?>]
                    }, {
                        type: 'spline',
                        name: '<?= lang('purchases'); ?>',
                        data: [<?php
                    echo implode(', ', $mpurchases); ?>],
                        marker: {
                            lineWidth: 2,
                            states: {
                                hover: {
                                    lineWidth: 4
                                }
                            },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'spline',
                        name: '<?= lang('pp_tax'); ?>',
                        data: [<?php
                    echo implode(', ', $mtax3); ?>],
                        marker: {
                            lineWidth: 2,
                            states: {
                                hover: {
                                    lineWidth: 4
                                }
                            },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'pie',
                        name: '<?= lang('stock_value'); ?>',
                        data: [
                            ['', 0],
                            ['', 0],
                            ['<?= lang('stock_value_by_price'); ?>', <?php echo $stock->stock_by_price; ?>],
                            ['<?= lang('stock_value_by_cost'); ?>', <?php echo $stock->stock_by_cost; ?>],
                        ],
                        center: [80, 42],
                        size: 80,
                        showInLegend: false,
                        dataLabels: {
                            enabled: false
                        }
                    }]
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            <?php if ($lmbs) {
                        ?>
            $('#lmbschart').highcharts({
                chart: {type: 'column', direction: '<?= $Settings->user_rtl ? 'rtl' : 'ltr'; ?>'},
                title: {text: ''},
                credits: {enabled: false},
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                tooltip: {
                    shared: true,
                    followPointer: true,
                    formatter: function () {
                        var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;text-align:<?= $Settings->user_rtl ? 'right' : 'left'; ?>;">';
                        $.each(this.points, function () {
                            s += '<span style="color:{series.color};padding:0"><b>' + this.key + '</b><br /> ' + this.series.name + ' <b>' +
                            currencyFormat(this.y) + '</b></span>';
                        });
                        s += '</div>';
                        return s;
                    },
                    useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                    style: {fontSize: '14px', padding: '0', color: '#000000'}
                },
                series: [{
                    name: '<?=lang('sold'); ?>',
                    data: [<?php
                    foreach ($lmbs as $r) {
                        if ($r->quantity > 0) {
                            echo "['" . addSlashes($r->product_name) . '<br>(' . $r->product_code . ")', " . $r->quantity . '],';
                        }
                    } ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });
            <?php
                    }
        if ($bs) {
            ?>
            $('#bschart').highcharts({
                chart: {type: 'column', direction: '<?= $Settings->user_rtl ? 'rtl' : 'ltr'; ?>'},
                title: {text: ''},
                credits: {enabled: false},
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                tooltip: {
                    shared: true,
                    followPointer: true,
                    formatter: function () {
                        var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;text-align:<?= $Settings->user_rtl ? 'right' : 'left'; ?>;">';
                        $.each(this.points, function () {
                            s += '<span style="color:{series.color};padding:0"><b>' + this.key + '</b><br /> ' + this.series.name + ' <b>' +
                            currencyFormat(this.y) + '</b></span>';
                        });
                        s += '</div>';
                        return s;
                    },
                    useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                    style: {fontSize: '14px', padding: '0', color: '#000000'}
                },
                series: [{
                    name: '<?=lang('sold'); ?>',
                    data: [<?php
                foreach ($bs as $r) {
                    if ($r->quantity > 0) {
                        echo "['" . addSlashes($r->product_name) . '<br>(' . $r->product_code . ")', " . $r->quantity . '],';
                    }
                } ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });
            <?php
        } ?>
        });
    </script>
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2 class="blue"><i
                            class="fa-fw fa fa-line-chart"></i><?= lang('best_sellers'), ' (' . date('M-Y', time()) . ')'; ?>
                    </h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bschart" style="width:100%; height:450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2 class="blue"><i
                            class="fa-fw fa fa-line-chart"></i><?= lang('best_sellers') . ' (' . date('M-Y', strtotime('-1 month')) . ')'; ?>
                    </h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="lmbschart" style="width:100%; height:450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    } ?>

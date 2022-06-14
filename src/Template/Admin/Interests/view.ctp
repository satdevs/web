
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $interest->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $interest->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Interestdetails</button>'), ['controller' => 'Interestdetails', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Interestdetail</button>'), ['controller' => 'Interestdetails', 'action' => 'add'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>

        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Adatlap megtekintése') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($interest,['class'=>'form-horizontal']) ?>



        <h3 class="text-center">Érdeklődés szolgáltatásainkról</h3>
        <table width="600" cellpadding="0" cellspacing="0" border="1" align="center" style="border: 3px solid lightgray; background: #eee;">
            <tr>
                <td width="50%" style="padding: 10px; border: 1px solid lightgray; " valign="top">
                    <div style="float: right;">Státusz: 
                        <?php if($interest->status <= 1){ ?>
                            <span title="Státusz = 0 v. 1" style="font-size: 18px; color: gray;" class="glyphicon glyphicon-pencil"></span>
                        <?php } ?>
                        <?php if($interest->status == 2){ ?>
                            <a href="/admin/interests/view/<?= $interest->id ?>">
                                <span title="Státusz = 2" style="font-size: 18px; color: green;" class="glyphicon glyphicon-envelope"></span>
                            </a>
                        <?php } ?>
                        <?php if($interest->status == 3){ ?>
                            <a href="/admin/interests/view/<?= $interest->id ?>">
                                <span title="Státusz = 3" style="font-size: 18px; color: blue;" class="glyphicon glyphicon-ok"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <b>Érdeklődő adatai:</b><br>
                    Neve: <b><?= $interest->name ?></b><br>
                    Település: <b><?= $interest->city ?></b><br>
                    Utca, hsz.: <b><?= $interest->address ?></b><br>
                    Telefon: <b><?= $interest->phone ?></b><br>
                    Email: <b><?= $interest->email ?></b><br>
                    <div style="float: left;">
                        <a class="btn btn-success btn-xs" href="<?php if($admin){echo "/admin";}?>/interests/edit/<?= $interest->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                    </div>
                </td>
                <td width="50%" style="padding: 10px; border: 1px solid lightgray; " valign="top">
                    <b>Szolgáltató adatai:<b><br>
                    Sághy-Sat Kft.
                    ...
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px; border: 1px solid lightgray; ">Üzenet: <b><?= $interest->message ?></b></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px;">
                    <table width="1000" cellpadding="0" cellspacing="0" border="1" align="center" style="border: 1px solid lightgray; background: #fff;">
                        <tr>
                            <td style="font-weight: bold; padding: 10px; border: 1px solid lightgray;" align="left" width="70%">Szolgáltatás metgnevezése</td>
                            <td style="font-weight: bold; padding: 10px; border: 1px solid lightgray;" align="center" width="30%">Ára</td>
                        </tr>

                        <tr>
                            <td style="padding: 10px; font-weight: bold; border: 1px solid lightgray;" width="70%">
                                <?php if($interest->package_name != "" ){ ?><h4><?= $interest->package_name ?></h4><?php } ?>
                                <ul>
<?php foreach ($interestdetails as $interestdetail) { if($interestdetail->product_group <= 4){ ?>
                                    <li><?= $interestdetail->name ?></li>
<?php } } ?>
                                </ul>
                            </td>
                            <td style="padding: 10px; font-size: 24px; border: 1px solid lightgray;" width="30%" align="center" valign="middle">
                                <?= $interest->price_services ?> Ft
                            </td>
                        </tr>

<?php if($interest->price_digitals > 0){ ?>
                        <tr>
                            <td style="padding: 10px; font-weight: bold; border: 1px solid lightgray;" width="70%">
                                <h4>Digitális csomagok</h4>
                                <ul>
<?php foreach ($interestdetails as $interestdetail) { if($interestdetail->product_group == 9){ ?>
                                    <li><?= $interestdetail->name ?></li>
<?php } } ?>
                                </ul>
                            </td>
                            <td style="padding: 10px; font-size: 24px; border: 1px solid lightgray;" width="30%" align="center" valign="middle">
                                <?= $interest->price_digitals ?> Ft
                            </td>
                        </tr>
<?php } ?>


                        <tr>
                            <td style="padding: 10px; font-weight: bold;" width="70%" align="right" valign="middle">
<?php if($interest->status < 3){ ?>
                                <div style="float: left;">
                                    <?= $this->Html->link(__('<button type="button" class="btn btn-primary"> Felhívva (Státusz 3-ra állítása)</button>'), ['action' => 'commit', $interest->id], ['escape' => false, 'confirm' => __('Be szeretné állítani a státuszát 3-asra?')]) ?>
                                </div>
<?php } ?>
                                Összesen:
                            </td>
                            <td style="padding: 10px; font-size: 24px; border: 1px solid lightgray;" width="30%" align="center" valign="middle">
                                <?= $interest->price_total ?> Ft
                            </td>
                        </tr>


                    </table>
                </td>


            </tr>
        </table>

<br><br><br>
        <!--div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 text-center">
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/interests/index"><i class="fa fa-fw fa-close"></i> Lista</a>
            </div>
        </div--><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

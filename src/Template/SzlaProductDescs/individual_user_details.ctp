
<!-- -------------------------------- FORM -------------------------------- -->
    <div id="contact" class="col-sm-8 col-sm-pull-4">
        <div class="blog">
            <div class="blog-item">
                <h3 class="text-center">Az alábbi szolgáltatásokról szerenék bővebb felvilágosítást kapni!</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-xs-12">
                            <h4><b><?php if($interest->package_name!=""){ echo $interest->package_name.":"; $margin_top='10'; }else{echo "&nbsp;"; $margin_top='30';} ?></b></h4>
                            <ul>
<?php foreach ($interestdetails as $item) { 
    if($item->product_group <= 4){?>

                                <li><b><?= $item->name ?></b></li>
<?php }
} ?>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-right">
                            <div class="hidden-xs" style="height: 1px; width: 10px; margin-top: <?= $margin_top ?>px;"></div>
                            <h4><?= $interest->price_services ?>&nbsp;Ft/hó</h4>
                        </div>
                    </div>

<?php if(isset($interest->price_digitals) && $interest->price_digitals > 0){ ?>
                    <div class="row">
                        <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-xs-12">
                            <h4>Havidíj ellenében nézhető digitálsi csomagjaink:</h4>
                            <ul>
<?php foreach ($interestdetails as $item) { 
    if($item->product_group == 9){?>

                                <li><b><?= $item->name ?></b></li>
<?php }
} ?>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-right">
                            <div class="hidden-xs" style="height: 1px; width: 10px; margin-top: 1px;"></div>
                            <h4><?= $interest->price_digitals ?>&nbsp;Ft/hó</h4>
                        </div>
                    </div>
<?php } ?>

                    <div class="row">
                        <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-sm-7 col-xs-6 text-right">
                            <h4>Összesen:</h4>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-right">
                            <h4 style="font-weight: bold;"><?= $interest->price_total ?>&nbsp;Ft/hó</h4>
                        </div>
                    </div>
                </div>



                <br>
                <h5 class="text-center" style="font-weight: bold;">Kérem adja meg adatait, hogy mielőbb fel tudjuk venni Önnel a kapcsoaltot!</h5>
                <br>

                <?= $this->Form->create($interest,['class'=>'form-horizontal']) ?>                
                <div class="box-body">
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">*Neve:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'required'=>true]); ?>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">*Település:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('city', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true, 'required'=>true]); ?>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">*Utca, házszám:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'required'=>true]); ?>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">*Telefon:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'required'=>true]); ?>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">*Email:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('email', ['label'=>false, 'type'=>'email', 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'required'=>true]); ?>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label for="group_id" class="col-sm-2 control-label">Egyéb üzenet:</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('message', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'height: 80px;' ]); ?>
                        </div>
                    </div>            
                </div><!-- /.box-body -->

                <!--div style="border: 1px solid gray; padding: 0px; width: 100%;"-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <?= $this->Form->button('<i class="fa fa-fw fa-send"></i> Üzenet küldése',['class'=>'btn btn-primary btn-lg']) ?>
                        </div>

                    </div>
                </div>
                <!--/div-->

            <?= $this->Form->end() ?>
        </div>
        <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

    </div>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

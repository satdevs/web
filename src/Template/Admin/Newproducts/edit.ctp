<?php
	//debug($newproduct);
?>
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>
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
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($newproduct,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Fejállomás:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('headstation_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="servicegroup" class="col-sm-1 control-label">Csoport:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('servicegroup', ['options'=>$servicegroups, 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
			
			<h3>KTV nélküli NET esetén bepipálni!</h3>
            <div class="form-group">
                <label for="without_catv" class="col-sm-1 control-label">KTV nélkül (Net):</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('without_catv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Neve:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            

			<hr>
			<h3>Mivel van együtt?</h3>
            <div class="form-group">
                <label for="pkg_catv" class="col-sm-1 control-label">Csomagban KTV:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('pkg_catv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="pkg_net" class="col-sm-1 control-label">Csomagban NET:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('pkg_net', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="pkg_tel" class="col-sm-1 control-label">Csomagban TEL:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('pkg_tel', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
			
			<hr>
            <div class="form-group">
                <label for="onlyInPackage" class="col-sm-1 control-label">Csak csomagban:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('onlyInPackage', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
			<hr>
			
			<h3>Ha csomag, akor a tartalmának ID-jeit itt meg kell adni</h3>
            <div class="form-group">
                <label for="pkg_catv_id" class="col-sm-1 control-label">TV ID:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('pkg_catv_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="pkg_net_id" class="col-sm-1 control-label">NET ID:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('pkg_net_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="pkg_tel_id" class="col-sm-1 control-label">TEL ID:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('pkg_tel_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
			<hr>
			
			<h3>Szöveges tartalom leírás!</h3>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tartalma:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('content', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="comment" class="col-sm-1 control-label">Megjegyzés:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('comment', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Bruttó ár:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('price', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
			
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Pozíció:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('pos', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Látható:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('visible', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/newproducts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

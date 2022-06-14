
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
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($subscriber,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Radius Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('radius_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Ext Key:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('ext_key', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Fullname:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('fullname', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">City:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('city', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Zip:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('zip', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Street:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('street', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Address:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tel1:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tel2:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Paymode:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('paymode', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Category:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('category', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">State:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('state', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Over Limit Down:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('over_limit_down', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Over Limit Up:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('over_limit_up', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Contract Time:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('contract_time', ['empty' => true, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Contract Year:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('contract_year', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Download Override:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('download_override', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Upload Override:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('upload_override', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Last Change:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('last_change', ['empty' => true, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Size Override:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('size_override', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Debug:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('debug', ['empty' => true, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Category Test:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('category_test', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/subscribers/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

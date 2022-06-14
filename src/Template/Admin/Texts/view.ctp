
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-header">


    </div>
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $text->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $text->id)]
            )
        ?>
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
            <h3 class="box-title"><?= __('Adatlap megtekintése') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($text,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <!--div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">User Id:</label>
                <div class="form-control">
                    <?php //echo $text->user->name; ?>
                </div>
            </div-->            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">User Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('user_id', ['options' => $users, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cím:</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <?php echo $text->title; ?>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <div style="border: 1px solid lightgray; padding: 10px;">
                        <?php echo $text->text; ?>
                    </div>
                </div>
            </div>            
            <!--div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Képek száma:</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <?php //echo $text->count_images; ?>
                    </div>
                </div>
            </div-->            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/texts/edit/<?= $text->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/texts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

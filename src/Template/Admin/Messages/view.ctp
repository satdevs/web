
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-header">


    </div>
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $message->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $message->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Üzenet témák</button>'), ['controller' => 'Messagethemes', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új üzenet téma</button>'), ['controller' => 'Messagethemes', 'action' => 'add'], ['escape' => false]) ?>
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
    <?= $this->Form->create($message,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Téma:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('messagetheme_id', ['options' => $messagethemes, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Neve:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Email:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Telefon:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tárgy:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('subject', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('body', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Olvasva:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('readed', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Olvasva:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('readedtime', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
            <!--div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Ki olvasta:</label>
                <div class="col-sm-10">
                    <?php //echo $this->Form->input('whoisreaded', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div-->
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/messages/edit/<?= $message->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/messages/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

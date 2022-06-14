<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">

        </div>

        <div class="col-sm-2">
            <a style="margin-left: 10px;" class="btn btn-default" href="/users/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>          
        </div>
        <div class="col-sm-10">
            <h3 class="box-title">Módosítás</h3>
        </div>
    </div>
    <?= $this->Form->create($user,['class'=>'form-horizontal']) ?>  
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Csoport</label>
                <div class="col-sm-10">
                    <?= $this->Form->input('group_id', ['options' => $groups, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Neve</label>
                <div class="col-sm-10">
                    <?= $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Teljes neve', 'type'=>'text', 'autofocus'=>true]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <?= $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Email', 'type'=>'email', 'autofocus'=>false]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Jelszó</label>
                <div class="col-sm-10">
                    <?= $this->Form->input('password', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Jelszó', 'type'=>'password', 'autofocus'=>false]); ?>
                </div>
            </div>
        </div>


        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="/users/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div>
        <!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>

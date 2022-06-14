
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
<?php
        //foreach ($headstations as $headstation) {
        //    dump($headstation);            
        //}
?>
        </div>

        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
            <p style="color: red;">Leírás az űrlap alatt!</p>
        </div>
    </div>
    <?= $this->Form->create($productDepend,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Fejállomás:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('headstation_id', [ 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tv:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Net:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('net', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tel:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                    <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/szla_product_depends/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <h3>Segítség</h3>
                    <p>
                        Név: tetszőlegesen megadható<br>
                        Fejállomás: egyértelmű. Bóly vagy Felsőszentiván. A többihez nem tartozik telefon vagy internetszolgáltatás.<br>
                        A következő mezőkhöz a <b>product_descs</b> tábla <b>ID</b>-jét kell megadni a következők szerint:<br>
                    </p>
                    <h4>A telefon kapcsolók állapotának függéseit kell rögzíteni. Azaz:</h4>
                    <ul>
                        <li>Ha az adott telefonkapcsoló a <b>TV és NET együttes választása esetén érhető csak el</b>, akkor a TV és a NET id-jét fel kell venni.<br>
                        <i>Például: TV=3, NET=19, TEL=34. Ez esetben a 34-es TEL csak akkor érhető el, ha a 3-as TV kapcsoló és a 19-es NET kapcsoló be van kapcsolva.<br>
                        Descartes szorzat szerint az összes TV kapcsoló <b>X</b> összes NET kapcsoló-t fel kell venni!</i><br></li>

                        <li>Például a <b>Telefon Csevely</b> feltétele a TV választása. (NET-et nem kell választani hozzá, de lehet.) Ekkor A TV id-je mellé a NET-nél 0-t kell írni.<br>
                        <i>Azaz például: TV=3, NET=0, TEL=34. Itt megengedett a NET kapcsoló bekapcsolt állása is.</i><br></li>

                        <li><b>Telefon solo</b> feltétele TV (kizáró)vagy NET választása. (Azaz csak egyet lehet választani). Ez esetben a másik kapcsolóhoz <b>-1</b>-et kell megadni<br>
                        <i>Például:<br>
                        TV=3, NET=<b>-1</b>, TEL=34.<br>
                        TV=<b>-1</b>, NET=18, TEL=34.<br>
                        Ez esetben a 3-as TV kapcsoló lehet bekapcsolva (k)vagy a 18-as NET kapcsoló. A kettő együtt nem!</i></li>
                    </ul>



                </div>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

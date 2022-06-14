
<!-- -------------------------------- FORM -------------------------------- -->
<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
%>
<div class="box">
    <div class="box-body">
<% if (strpos($action, 'add') === false): %>
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>)]
            )
        ?>
<% endif; %>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

<%
        $done = [];
        foreach ($associations as $type => $data) {
            foreach ($data as $alias => $details) {
                if ($details['controller'] !== $this->name && !in_array($details['controller'], $done)) {
%>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary"><%= $this->_pluralHumanName($alias) %></button>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új <%= $this->_singularHumanName($alias) %></button>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add'], ['escape' => false]) ?>
<%
                    $done[] = $details['controller'];
                }
            }
        }
%>
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
            <h3 class="box-title"><?= __('<%
                if($action == 'add'){
                    echo "Új felvitele";
                }
                if($action == 'edit'){
                    echo "Módosítás";
                }
                if($action == 'view'){
                    echo "Adatlap megtekintése";
                }
            %>') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($<%= $singularVar %>,['class'=>'form-horizontal']) ?>
        <div class="box-body">
<% if($action == 'view'){$disabled="true";}else{$disabled="false";} %>
<%
    foreach ($fields as $field) {
        if($field=='name' || $field=='title'){$autofocus="true";}else{$autofocus="false";}
%>
<%
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
%>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label"><%= Inflector::humanize($field); %>:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true, 'label'=>false, 'class'=>'form-control', 'autofocus'=><%= $autofocus %>, 'disabled'=><%= $disabled %>]); ?>
                </div>
            </div>            
<%
                } else {
%>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label"><%= Inflector::humanize($field); %>:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'label'=>false, 'class'=>'form-control', 'autofocus'=><%= $autofocus %>, 'disabled'=><%= $disabled %>] ); ?>
                </div>
            </div>            
<%
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated']) && !strpos($field, '_count') ) {
                $fieldData = $schema->column($field);
                if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
%>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label"><%= Inflector::humanize($field); %>:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('<%= $field %>', ['empty' => true, 'label'=>false, 'class'=>'form-control', 'autofocus'=><%= $autofocus %>, 'disabled'=><%= $disabled %>]); ?>
                </div>
            </div>            
<%
                } else {
%>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label"><%= Inflector::humanize($field); %>:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('<%= $field %>', ['label'=>false, 'class'=>'form-control', 'autofocus'=><%= $autofocus %>, 'disabled'=><%= $disabled %> <% if($action=='add' && $field=='pos'){echo ', "value"=>500 ';} %>]); ?>
                </div>
            </div>            
<%
                }
            }
%>
<%
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
                if($field != 'created' && $field != 'modified'){
%>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label"><%= Inflector::humanize($field); %>:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'label'=>false, 'class'=>'form-control', 'autofocus'=><%= $autofocus %>, 'disabled'=><%= $disabled %>]); ?>
                </div>
            </div>            
<%
                }
            }
        }
%>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
<% if ($action=='add' || $action=='edit' ){ %>
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
<% } %>
<% if ($action=='view'){ %>
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/<%= $pluralVar %>/edit/<?= $<%= $singularVar %>-><%= $primaryKey[0] %> ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
<% } %>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/<%= $pluralVar %>/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/<%= $pluralVar %>/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<%
use Cake\Utility\Inflector;

$fields = collection($fields)
	->filter(function($field) use ($schema) {
		return !in_array($schema->columnType($field), ['binary', 'text']);
	});

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
	$fields = $fields->reject(function ($field) {
		return $field === 'lft' || $field === 'rght';
	});
}

if (!empty($indexColumns)) {
	$fields = $fields->take($indexColumns);
}
%>
<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
<%
	$done = [];
	foreach ($associations as $type => $data):
		foreach ($data as $alias => $details):
			if (!empty($details['navLink']) && $details['controller'] !== $this->name && !in_array($details['controller'], $done)):
%>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary"><%= $this->_pluralHumanName($alias) %></button>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új <%= $this->_singularHumanName($alias) %></button>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add'], ['escape' => false]) ?>
<%
				$done[] = $details['controller'];
			endif;
		endforeach;
	endforeach;
%>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_<%= $pluralVar %>', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="<%= $pluralVar %>_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="<%= $pluralVar %>" role="grid" id="<%= $pluralVar %>" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
<% foreach ($fields as $field): if($field!='id' && $field!='created' && $field!='modified'){ 
	$width = "";
	$posalign = "";
	if(strpos($field,'_count')){
		$width="width: 100px;";
	}
	if( $field == 'pos' ){
		$width="width: 80px;";
		$posalign="text-align: center;";
	}
%>
									<th style="border-bottom: 2px solid lightgray; <%= $width %> <%= $posalign %>" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('<%= $field %>','<% if($field=="pos"){echo "Rang";}%>') ?></th>
<% } endforeach; %>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?> <% $pk = '$' . $singularVar . '->' . $primaryKey[0]; %>
								<tr row-id="<?= <%= $pk %> ?>">
<% foreach ($fields as $field) {
if($field!='created' && $field!='modified'){
			$isKey = false;
			if (!empty($associations['BelongsTo'])) {
				foreach ($associations['BelongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
%>
									<td style="text-align: left; padding-right: 7px;"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
<%
						break;
					}
				}
			}
			if ($isKey !== true) {
				if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
									<td style="text-align: left; padding-left: 7px;"><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
				} else {
%>
									<td style="<% if($field=="pos"){echo "text-align: center;";}else{echo "text-align: right;";}%> padding-right: 7px;"><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
				}
			}
		}

		//$pk = '$' . $singularVar . '->' . $primaryKey[0];
}
%>

									<td style="text-align: center;"><?= $this->Time->format( $<%= $singularVar %>->created, 'yyyy.MM.dd. HH:mm:ss', null, $<%= $singularVar %>->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $<%= $singularVar %>->modified, 'yyyy.MM.dd. HH:mm:ss', null, $<%= $singularVar %>->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', <%= $pk %>], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', <%= $pk %>], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', <%= $pk %>], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', <%= $pk %>)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
<% foreach ($fields as $field): if($field!='id' && $field!='created' && $field!='modified'){ %>
									<th style="border-top: 2px solid lightgray; <%= $posalign %>" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('<%= $field %>','<% if($field=="pos"){echo "Rang";}%>') ?></th>
<% } endforeach; %>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="<%= $pluralVar %>" tabindex="0">Műveletek</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>

<?= $this->element('paginator'); ?>

		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- ------------------------------------------------- /index ------------------------------------------------- -->

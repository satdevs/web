<%
use Cake\Utility\Inflector;

$defaultModel = $name;
%>
<?php
namespace <%= $namespace %>\Controller<%= $prefix %>;
//namespace App\Controller\Admin;
use <%= $namespace %>\Controller\AppController;
//use App\Controller\Admin\AppController;

class <%= $name %>Controller extends AppController{
	public $title = "<%= $name %>";
<%
echo $this->Bake->arrayProperty('helpers', $helpers, ['indent' => false]);
echo $this->Bake->arrayProperty('components', $components, ['indent' => false]);
foreach($actions as $action) {
    echo $this->element('Controller/' . $action);
}
%>
}

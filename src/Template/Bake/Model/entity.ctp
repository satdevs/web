<%

$propertyHintMap = null;
if (!empty($propertySchema)) {
    $propertyHintMap = $this->DocBlock->buildEntityPropertyHintTypeMap($propertySchema);
}

$accessible = [];
if (!isset($fields) || $fields !== false) {
    if (!empty($fields)) {
        foreach ($fields as $field) {
            $accessible[$field] = 'true';
        }
    } elseif (!empty($primaryKey)) {
        $accessible['*'] = 'true';
        foreach ($primaryKey as $field) {
            $accessible[$field] = 'false';
        }
    }
}
%>
<?php
namespace <%= $namespace %>\Model\Entity;
use Cake\ORM\Entity;
class <%= $name %> extends Entity{
<% if (!empty($accessible)): %>

    protected $_accessible = [
<% foreach ($accessible as $field => $value): %>
        '<%= $field %>' => <%= $value %>,
<% endforeach; %>
    ];
<% endif %>
<% if (!empty($hidden)): %>

    protected $_hidden = [<%= $this->Bake->stringifyList($hidden) %>];
<% endif %>
<% if (empty($accessible) && empty($hidden)): %>

<% endif %>
}

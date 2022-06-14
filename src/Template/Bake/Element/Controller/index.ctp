
    public function index() {
<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
        $this->paginate = [
<% if ($belongsTo): %>
            'contain' => [<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>],
<% endif; %>
            'limit' => 100,
            'order' => [
                //'<%= $currentModelName %>.group_id' => 'asc',
                //'<%= $currentModelName %>.name' => 'asc',                
            ],
            'conditions' => [
                //'<%= $currentModelName %>.xxx' => 1,
            ]
        ];
        $<%= $pluralName %> = $this->paginate($this-><%= $currentModelName %>);
        $this->set(compact('<%= $pluralName %>'));
        $this->set('_serialize', ['<%= $pluralName %>']);
    }

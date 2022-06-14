<%
$compact = ["'" . $singularName . "'"];
%>

    public function add() {
        $<%= $singularName %> = $this-><%= $currentModelName %>->newEntity();
        if ($this->request->is('post')) {
            $<%= $singularName %> = $this-><%= $currentModelName %>->patchEntity($<%= $singularName %>, $this->request->data);
            if ($this-><%= $currentModelName; %>->save($<%= $singularName %>)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
<%
        $associations = array_merge(
            $this->Bake->aliasExtractor($modelObj, 'BelongsTo'),
            $this->Bake->aliasExtractor($modelObj, 'BelongsToMany')
        );
        foreach ($associations as $assoc):
            $association = $modelObj->association($assoc);
            $otherName = $association->target()->alias();
            $otherPlural = $this->_variableName($otherName);
%>
        $<%= $otherPlural %> = $this-><%= $currentModelName %>-><%= $otherName %>->find('list', ['limit' => 200]);
<%
            $compact[] = "'$otherPlural'";
        endforeach;
%>
        $this->set(compact(<%= join(', ', $compact) %>));
        $this->set('_serialize', ['<%=$singularName%>']);
    }

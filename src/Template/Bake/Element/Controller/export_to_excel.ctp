
	public function export_to_excel($filename="export_<%= $pluralName %>.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
<% /*
		$options = [
			//'limit'	=> 100,
			'order' => [
				'<%= $currentModelName %>.id' => 'asc',
				//'<%= $currentModelName %>.xxx' => 'asc',
			],
			'conditions' => [
				//'<%= $currentModelName %>.id' => '1',
				//'<%= $currentModelName %>.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this-><%= $currentModelName %>->recursive = -1;
		$<%= $pluralName %> = $this-><%= $currentModelName %>->find('all',$options);
		foreach ($<%= $pluralName %> as $<%= $singularName %>) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$<%= $singularName %>->created = $<%= $singularName %>->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$<%= $singularName %>->modified = $<%= $singularName %>->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$<%= $singularName %>->created = $<%= $singularName %>->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$<%= $singularName %>->modified = $<%= $singularName %>->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= '<%= $pluralName %>';
        $_header 		=  [ 'ID', 'Name', 'Created', 'Modified' ];
        //$_footer 		= [''];	//Ha kell, be kell illeszteni a compact()-ba
        $_extract 		= [ 'id', 'name', 'created', 'modified' ];
        //$_delimiter 	= chr(9); //Ha a TAB kellene ... (Kívánt rész törlendő ;-)
        $_delimiter 	= ';';
		$_enclosure 	= '"';
		$_newline 		= "\r\n";
		$_eol 			= "\r\n";
		$_bom 			= true;
		$this->response->download($filename);
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('<%= $pluralName %>', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
*/ %>
	}



    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }


    public function logout(){
        $this->Flash->success(__('Sikeresen kijelentkeztél!'));
        return $this->redirect($this->Auth->logout());
    }

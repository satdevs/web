<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class InterestsController extends AppController{
	public $title = "Interests";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    //----------- Status 3-ra állítása. ----------------
    public function commit($id = null){         
        $interestTable = TableRegistry::get('Interests');
        $query = $interestTable->query();
        $query->update()->set(['status'=>3])->where(['id'=>$id])->execute();
        return $this->redirect(['action' => 'index']);
    }

    public function index($status=null) {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                'Interests.modified' => 'desc',
                //'Interests.name' => 'asc',                
            ],
        ];
        if($status=='pending'){ 
            $this->paginate['conditions'] = ['status <='=>1]; 
        }
        if($status=='sent'){ 
            $this->paginate['conditions'] = ['status'=>2]; 
        }
        if($status=='commited'){ 
            $this->paginate['conditions'] = ['status'=>3]; 
        }

        $interests = $this->paginate($this->Interests);
        $this->set(compact('interests'));
        $this->set('_serialize', ['interests']);
    }

    public function add() {
        $interest = $this->Interests->newEntity();
        if ($this->request->is('post')) {
            $interest = $this->Interests->patchEntity($interest, $this->request->data);
            if ($this->Interests->save($interest)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('interest'));
        $this->set('_serialize', ['interest']);
    }

    public function edit($id = null){
        $interest = $this->Interests->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $interest = $this->Interests->patchEntity($interest, $this->request->data);
            if ($this->Interests->save($interest)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('interest'));
        $this->set('_serialize', ['interest']);
    }

    public function view($id = null){
        $interest = $this->Interests->get($id, [
            'contain' => []
        ]);

        $this->loadModel("Interestdetails");
        $interestdetails = $this->Interestdetails->find('all', [
            'conditions'=>[
                'interest_id'=>$interest->id
            ]
        ]);

        $this->set(compact('interest','interestdetails'));
        $this->set('_serialize', ['interest']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $interest = $this->Interests->get($id);
        if ($this->Interests->delete($interest)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

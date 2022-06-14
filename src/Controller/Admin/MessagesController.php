<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;
use Cake\Network\Request;
//use Cake\Routing\RequestActionTrait;

class MessagesController extends AppController{
	public $title = "Üzenetek";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
    }

    public function income() {
        $options = [
            'order' => [
                'Messages.created' => 'desc'
            ],
            'conditions' => [
                'Messages.readed' => 0
            ]
        ];
        $income = $this->Messages->find('all',$options);
        //echo "<pre>";
        //print_r($income);
        //die();
        return $income;
    }

    public function index() {
        $this->paginate = [
            //'contain' => ['Messagethemes'],
            'limit' => 100,
            'order' => [
                'Messages.created' => 'desc',
                //'Messages.name' => 'asc',
            ],
            'conditions' => [
                //'Messages.xxx' => 1,
            ]
        ];
        $messages = $this->paginate($this->Messages);
        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }

    public function view($id = null){
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        $this->request->data['id'] = $id;
        $this->request->data['readed'] = 1;
        $this->request->data['readedtime']  = date("Y-m-d H:i:s");
        $this->request->data['whoisreaded'] = $this->Auth->user('id');
        $message = $this->Messages->patchEntity($message, $this->request->data);
        $this->Messages->save($message);

        $messagethemes = $this->Messages->Messagethemes->find('list', ['limit' => 200]);
        $this->set(compact('message', 'messagethemes'));
        $this->set('_serialize', ['message']);
    }

    public function add() {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $messagethemes = $this->Messages->Messagethemes->find('list', ['limit' => 200]);
        $this->set(compact('message', 'messagethemes'));
        $this->set('_serialize', ['message']);
    }

    public function edit($id = null){
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $messagethemes = $this->Messages->Messagethemes->find('list', ['limit' => 200]);
        $this->set(compact('message', 'messagethemes'));
        $this->set('_serialize', ['message']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

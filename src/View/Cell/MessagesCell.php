<?php
namespace App\View\Cell;
use Cake\View\Cell;

class MessagesCell extends Cell{

    protected $_validCellOptions = [];

    public function display(){
		$this->loadModel('Messages');
		$total_posts = $this->Messages->find()->where(['readed'=>0])->count();
		$recent_posts = $this->Messages->find()
									->select(['id','name','subject','created'])
									->order(['created' => 'DESC'])
									->where(['readed'=>0])
									->limit(10)
									->toArray();
		$this->set(['total_posts' => $total_posts, 'recent_posts' => $recent_posts, 'admin'=>true]);
    }
}

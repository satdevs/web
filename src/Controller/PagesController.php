<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class PagesController extends AppController{

	public function display(){
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}

		switch ($page) {
			case 'mobil':
				$this->set('title', 'Mobil ajánlat');
				break;
			
			default:
				$this->set('title', 'Missing Title!');
				break;
		}


		$this->set(compact('page', 'subpage'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingTemplateException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}

	}
}

<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

//use Cake\Datasource\ConnectionManager;
//use Cake\Database\Connection;


class ChPackagesProgramsController extends AppController{
	public $title = "Channels - Csomagban lévő műsorok (ChPackagesPrograms)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function index($broadcast='analog', $headstation_id=1) {
        $this->set('active',$broadcast."-".$headstation_id);
        if($broadcast=='analog'){$broadcast='Analóg';}
        if($broadcast=='digitalis'){$broadcast='Digitális';}


        $queryPackages   = TableRegistry::get('ChPackages');
        $packagesIds     = $queryPackages->find()->select('id')->where(['headstation_id'=>$headstation_id, 'broadcast'=>$broadcast]);
        //debug($packagesIds);

        //$this->paginate['contain']  = ['ChPackages', 'ChPrograms', 'ChBands'];
        $this->paginate['contain']  = ['ChPackages', 'ChPrograms'];
        $this->paginate['limit']    = 100;
        $this->paginate['order']    = [
            'ChPackagesPrograms.package_id' => 'asc',
            'ChPackagesPrograms.packageorder' => 'asc',
            'ChPackagesPrograms.lcn'        => 'asc',
            //'ChPackagesPrograms.name' => 'asc',                
        ];
        $this->paginate['conditions'] = [
            'ChPackagesPrograms.broadcast'  => $broadcast,
            'ChPackages.headstation_id'     => $headstation_id,
        ];



        //dump( $this->paginate );
        //die();

        $packagesPrograms = $this->paginate($this->ChPackagesPrograms);

        $this->set(compact('packagesPrograms'));
        $this->set('_serialize', ['packagesPrograms']);
    }

    public function view($id = null){
        $packagesProgram = $this->ChPackagesPrograms->get($id, [
            'contain' => []
        ]);
        $packages = $this->ChPackagesPrograms->Packages->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $programs = $this->ChPackagesPrograms->Programs->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $bands = $this->ChPackagesPrograms->Bands->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'PackagesPrograms_' . $id . '.pdf'
        ];

/*
        Configure::write('CakePdf', array(
            'engine' => 'CakePdf.WkHtmlToPdf',
            'binary' => '/usr/local/bin/wkhtmltopdf',
            //'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'margin' => [
                'bottom' => 5,
                'left' => 10,
                'right' => 10,
                'top' => 10
            ],
            'orientation' => 'portrait',
            'encoding'  => 'UTF-8',
            'download'  => true,
            'routes' =>true
        ));

        Configure::write('CakePdf', [
            'engine' => 'CakePdf.WkHtmlToPdf',
            //'engine' => 'CakePdf.tcpdf',
            //'binary' => '/usr/local/bin/wkhtmltopdf',
            'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'options' => [
                'print-media-type' => false,
                'outline' => true,
                'dpi' => 96
            ],             
            'margin' => [
                'bottom' => 5,
                'left' => 10,
                'right' => 10,
                'top' => 10
            ],
            'orientation' => 'landscape',
            'download' => true
        ]);

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'saghysat_'.date("Ymd_His")
            ]
        ]);
*/



        $this->set(compact('packagesProgram', 'packages', 'programs', 'bands'));
        $this->set('_serialize', ['packagesProgram']);
    }

    public function add() {
        $packagesProgram = $this->ChPackagesPrograms->newEntity();
        if ($this->request->is('post')) {
            $packagesProgram = $this->ChPackagesPrograms->patchEntity($packagesProgram, $this->request->data);
            if ($this->ChPackagesPrograms->save($packagesProgram)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        //$packages = $this->ChPackagesPrograms->Packages->find('list', ['limit' => 200]);
        //$programs = $this->ChPackagesPrograms->Programs->find('list', ['limit' => 200]);
        //$bands = $this->ChPackagesPrograms->Bands->find('list', ['limit' => 200]);
        //$this->set(compact('packagesProgram', 'packages', 'programs', 'bands'));
        //$this->set('_serialize', ['packagesProgram']);
        $packages = $this->ChPackagesPrograms->ChPackages->find('list', ['limit' => 200]);
        $programs = $this->ChPackagesPrograms->ChPrograms->find('list', ['limit' => 200]);
        $bands = $this->ChPackagesPrograms->ChBands->find('list', ['limit' => 200]);
        $this->set(compact('packagesProgram', 'packages', 'programs', 'bands'));
        $this->set('_serialize', ['packagesProgram']);        
    }

    public function edit($id = null){
        $packagesProgram = $this->ChPackagesPrograms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packagesProgram = $this->ChPackagesPrograms->patchEntity($packagesProgram, $this->request->data);
            if ($this->ChPackagesPrograms->save($packagesProgram)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $packages = $this->ChPackagesPrograms->ChPackages->find('list', ['limit' => 200]);
        $programs = $this->ChPackagesPrograms->ChPrograms->find('list', ['limit' => 200]);
        $bands = $this->ChPackagesPrograms->ChBands->find('list', ['limit' => 200]);
        $this->set(compact('packagesProgram', 'packages', 'programs', 'bands'));
        $this->set('_serialize', ['packagesProgram']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $packagesProgram = $this->ChPackagesPrograms->get($id);
        if ($this->ChPackagesPrograms->delete($packagesProgram)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

use Cake\Network\Exception\NotFoundException;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Network\Session;

class UsersController extends AppController{

//    public $components = array('PhpExcel');

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->set('title', 'Felhasználók');
        $this->Auth->allow(['add', 'logout']);
    }

    public function initialize(){       //PDF-hez kellett
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }



    //Új jelszó kérése: email megy, linkre kattintva hívódik meg a generatenewpassword() és elküldi az új email-t, amivel be tud lépni
    public function requestnewpassword(){
        $this->set('title_for_layout', 'Jelszó megújítása');

    }

    //requestnewpassword() emailt küld egy linkkel, ha rákattint a felhasználó, akkor email megy a generát új jelszóval
    public function generatenewpassword($user_id=Null, $request_code=Null){
        $this->set('title_for_layout', 'Új jelszó generálása');

    }

    //Jelszó csere, ahogy a neve is mutatja ;-)
    public function changepassword(){
        $this->set('title_for_layout', 'Jelszó megváltoztatása');
    }


    public function index(){
        $this->loadComponent('Paginator');
        $this->paginate = [
            'contain' => ['Groups'],
            'limit' => 20,
            'orders' => [
                'User.id' => 'desc',
                //'User.name' => 'asc',                
            ],
            'conditions' => [
                //'User.group_id' => 2,
            ]
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function login(){
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Hibás email és jelszó páros!');
        }
    }

    public function logout(){
        $this->Flash->success('Sikeresen kijelentkeztél!');
        return $this->redirect($this->Auth->logout());
    }


    public function add(){
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //echo "<pre>";
            if( session_name() ){
                $this->request->data['id'] = str_replace("-",$_COOKIE[session_name()],Text::uuid());
                $this->request->data['request_code'] = str_replace("-",$_COOKIE[session_name()],Text::uuid());
            }else{
                $this->request->data['id'] = Text::uuid();
                $this->request->data['request_code'] = Text::uuid();
            }
            $this->request->data['enabled']     = 1;    //Alapesetben beléphet, de az admin letilthatja később
            $this->request->data['confirmed']   = 0;    //Emailben érkező linkre kell kattintani és akkor álíltódik 1-esre
            $this->request->data['group_id']    = 3;    //Alapesetben előfizető az illető. Admin feljebb tolhatja a ranglétrán ;-)

            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {


/*      //Images upload
            foreach ($user['files'] as $u) {
                $tmp_name = $u['tmp_name'];
                $src_path = WWW_ROOT.'files'.DS.'uploaded'.DS;
                $dest_path = $src_path;
                $name = $u['name'];
                $original_name = 'original_'.$name;
                $big_name = 'big_'.$name;
                $thumb_name = 'thumb_'.$name;
                $original_name_with_path = $dest_path.$original_name;
                move_uploaded_file($tmp_name, $original_name_with_path);
                parent::resizePhoto(120, $original_name, $thumb_name, $src_path, $dest_path, 30);
                parent::resizePhoto(600, $original_name, $big_name,   $src_path, $dest_path, 30);
                unlink($original_name_with_path);
            }
*/
            
                $this->Flash->success('Adatok mentése: Ok');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null){
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Adatok mentése: Ok');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('Törlés: Ok');
        } else {
            $this->Flash->error('Nem sikerült a törlés! Kérem próbálja újra!');
        }
        return $this->redirect(['action' => 'index']);
    }


    public function view($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'Photos', 'Posts']
        ]);

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'User_'.$id,

                'margin' => [
                    'bottom' => 0,
                    'left'   => 0,
                    'right'  => 0,
                    'top'    => 0
                ],
                'orientation' => 'landscape',
                'encoding'  => 'UTF-8',




            ]
        ]);

/*
        $this->pdfConfig = [
            'orientation'   => 'portrait',
            'filename'      => 'User_' . $id . '.pdf'
        ];

        //$pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');
        //Configure::write('CakePdf.crypto', 'CakePdf.Pdftk');
        Configure::write('CakePdf', array(
            'download'  => false,
        ));
        //$pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');
/*
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
            'routes' =>true

*/



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

/*
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

        $groups = $this->Users->Groups->find('list', ['limit' => 20]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }



    //########################################################################################################################
    //########################################################################################################################
    //##                                            Plugin functions()                                                      ##
    //########################################################################################################################
    //########################################################################################################################
    public function export_to_excel($filename="export_users.xlsx"){
        //$this->set('data',$this->Tests->find('all'));
        //$this->response->download("users_export.xls");
        $options = [
            //'limit'   => 2,
            'order' => [
                //'<%= $currentModelName %>.id' => 'asc',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ],
            'conditions' => [
                //'<%= $currentModelName %>.id' => '1',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ]
        ];
        $this->Users->recursive = -1;
        $users = $this->Users->find('all',$options);
        foreach ($users as $user) {
            $user->created = strtotime($user->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            $user->modified = strtotime($user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss'));
        }
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        $this->set('filename', $filename);
    }

    public function export($filename="export_users.xlsx"){
        //$this->set('data',$this->Tests->find('all'));
        //$this->response->download("users_export.xls");
        $options = [
            //'limit'   => 2,
            'order' => [
                //'<%= $currentModelName %>.id' => 'asc',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ],
            'conditions' => [
                //'<%= $currentModelName %>.id' => '1',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ]
        ];
        $this->Users->recursive = -1;
        $users = $this->Users->find('all',$options);
        foreach ($users as $user) {
            $user->created = strtotime($user->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            $user->modified = strtotime($user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss'));
        }
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        $this->set('filename', $filename);
    }

    public function export_to_csv($filename="export_users.csv") {
        $options = [
            //'limit'   => 2,
            'order' => [
                //'<%= $currentModelName %>.id' => 'asc',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ],
            'conditions' => [
                //'<%= $currentModelName %>.id' => '1',
                //'<%= $currentModelName %>.xxx' => 'asc',
            ]
        ];
        $this->Users->recursive = -1;
        $users = $this->Users->find('all', $options);
        foreach ($users as $user) {
            //$user->created = $user->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
            //$user->modified = $user->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
            $user->created = $user->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $user->modified = $user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
        }
        $_serialize = 'users';
        $_header = ['ID', 'Name', 'Email', 'Created', 'Modified'];
        $_extract = ['id', 'name', 'email', 'created', 'modified' ];
        $_header = ['ID', 'Name'];      //Ezeket a mezőket írja ki a CSV-be
        $_extract = ['id', 'name'];     //  -"-
        //$_footer = ['Totals', '400', '$3000'];
        $_delimiter = chr(9); //tab
        $_delimiter = ';';
        $_enclosure = '"';
        $_newline = "\r\n";
        $_eol = "\r\n";
        $_bom = true;
        $this->response->download($filename); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('users', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
/*
        $data = [
            ['a', 'b', 'c'],
            [1, 2, 3],
            ['you', 'and', 'me'],
        ];
        $_serialize = 'data';
        $_header = ['Column 1', 'Column 2', 'Column 3'];
        $_footer = ['Totals', '400', '$3000'];
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize', '_header', '_footer'));
*/
    }



    public function sendemail() {
        $this->autoRender = false;
        $email = new Email('default');
        $email->transport('saghysat');

        $email->template('default', 'default');
        $email->emailFormat('html');

        $email->from(['zsolt@saghysat.hu' => 'Zsolt - CakePhp3 Email']);
        $email->to('zsolt@saghysat.hu');
/*
        $email->attachments([
            'zsolt.jpg' => [                                            //A file neve a levélben
                'file' => WWW_ROOT.'img'.DS.'avatars'.DS.'zsolt.jpg',   //Valós csatoléandó file neve
                'mimetype' => 'image/jpeg',                             //Pl.: application/pdf, image/jpeg, forrás: https://www.sitepoint.com/web-foundations/mime-types-complete-list/
                //'contentId' => Text::uuid()                           //Content ID
            ]
        ]);
*/
        $email->subject('CakePhp3 Email - Tárgy mező');
        $email->send('Levél tartalom');
    }









}
?>
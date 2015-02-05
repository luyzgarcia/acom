<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	#public $helpers = array('CakeLess.Less');
	public $helpers = array('Less.Less');
	public $components = array(
		'Session',
		'Auth'=> array(
			'authorize' => array('Controller')
		),
		'RequestHandler'
	);
	
	public function isAuthorized($user) {
		if(isset($user['role']) && $user['role'] === 'admin') {
			return true; //Admin pode acessar tudo
		}if(isset($user['role']) && $user['role'] === 'supervisor') {
			if(in_array($this->params['controller'], array('fileuploads','Chamados', 'chamados','Chamado_Respostas', 'chamado_respostas', 'dashboards', 'Briefings'))) {
				return true;
			}
		}	
		$this->Session->setFlash(__('Você não tem acesso a essa área!'));
		return false;
		//return false; //Outros usuarios nao pode acessar nada
	}
	
	function beforeFilter() {
		#$this->Auth->allow('/pages/home');
		#$this->Auth->allow();
    }
}

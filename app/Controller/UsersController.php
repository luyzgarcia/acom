<?php

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login','logout');
	}
	
	public function login() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			}else {
				$this->Session->setFlash(__('Usuário ou senha inválidos'));
			}
		}
	}
	
	public function logout() {
		$this->Session->setFlash(__('Logout Realizado com sucesso'));
		$this->redirect($this->Auth->logout());
	}
	
	public function index() {
		$this->set('usuarios', $this->User->find('all',array('order' => array('User.created'=>'desc'))));
		
		if($this->RequestHandler->isAjax()) {
			$this->viewClass = 'Tools.Ajax';
		}
	}
	
	public function editar($id) {
		if($this->request->is('get')){
			$this->User->id = $id;
			$this->User->read();
			$this->data = $this->User->data;
			$this->render('index');
		}
	}
	
	public function add() {
		if($this->request->is('post') || $this->request->is('put')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('O usuário foi salvo'), 'default', array('class' => 'message'), 'sucesso');
				$this->redirect(array('action' => 'index'));
			}else {
				$errors = '';
				foreach($this->User->validationErrors as $field => $error) {
					$this->Session->setFlash(__(''.$error[0]), 'default', array('class' => 'message'), 'erro');
					$this->render('index');	
				}
			}
		}
	}
	public function beforeRender() {
		$this->set('usuarios', $this->User->find('all',array('order' => array('User.created'=>'desc'))));
	}
}

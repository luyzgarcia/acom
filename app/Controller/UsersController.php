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
		if($this->RequestHandler->isAjax()) {
			$this->viewClass = 'Tools.Ajax';
		}
	}
	
	public function add() {
		if($this->request->is('post')) {
			$this->User->create();
			if($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('O usuário foi salvo!'));
				$this->redirect(array('action' => 'index'));
			}else {
				$this->Session->setFlash(__('Houve um erro ao salvar o usuário, tente novamente!'));
			}
		}
	}
}

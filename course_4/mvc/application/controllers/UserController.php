<?php
class UserController implements IController{
	public function helloAction(){
		$fc = FrontController::getInstance();
		$params = $fc->getParams();
		/* Инициализация модели */
		$model = new FileModel();
		$model->name = $params['name'];
		$output = $model->render(USER_DEFAULT_FILE);
		$fc->setBody($output);
	}
	public function listAction(){
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();
		//получаем строку, которую подом десериализуем
		$model->list = file_get_contents(USER_DB);
		$model->user = unserialize($model->list);
		$output = $model->render(USER_LIST_FILE);
		$fc->setBody($output);
	}
	public function getAction(){
		$fc = FrontController::getInstance();
		$params = $fc->getParams();
		/* Инициализация модели */
		$model = new FileModel();
		$model->name = $params['role'];
		$model->list = file_get_contents(USER_DB);
		$model->user = unserialize($model->list);
		$output = $model->render(USER_ROLE_FILE);
		$fc->setBody($output);
	}
	public function addAction(){
		$fc = FrontController::getInstance();
		$params = $fc->getParams();
		/* Инициализация модели */
		$model = new FileModel();
		$model->name = $params['name'];
		$model->role = $params['role'];
		$model->list = file_get_contents(USER_DB);
		$model->user = unserialize($model->list);
		
		$output = $model->render(USER_ADD_FILE);
		$fc->setBody($output);
	}
}
?>
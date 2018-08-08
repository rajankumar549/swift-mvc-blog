<?php

/**
 * The Default Example Controller Class
 *
 * @author Faizan Ayubi, Hemant Mann
 */
use \Models\User as User;
use Shared\{Utils, Mail, Controller};
use Framework\Registry as Registry;

class Auth extends Controller {
	public function __construct($options = array()) {
        parent::__construct($options);
       	$this->setLayout('/layouts/login');
    }

    public function _isLogin() {
        $session = Registry::get("session");
        $user = $session->get('user');
        if($user){
            $this->redirect('/');
        }
    }

    public function _checkUserLogin(){
        $session = Registry::get('session');
        $user = $session->get('user');
        if(empty($user)){
            $this->redirect('/auth');
        }
    }
    public function _csrfToken() {
        $session = $this->getSession();
        $csrf_token = Framework\StringMethods::uniqRandString(44);
        $session->set('Auth\Request:$token', $csrf_token);

        if ($this->actionView) {
            $this->actionView->set('__token', $csrf_token);
        }
    }
    /**
     * @before _isLogin
     */
    
    public function index() {
        $layoutView = $this->getLayoutView();
        $view = $this->getActionView();
        $view->set('isError',false);
        $userInfo = Registry::get('user');
        if($this->request->isPost()){
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            $where = ['email=?' =>$email,'password=?'=> $password];
            $user = User::first($where);
            if($user){
                $this->setUser($user);
                $this->redirect("/");
            }    
            else{
                if($email || $password){
                    $view->set('isError',true);
                }
                $view->set('email',$email);
                $view->set('password',$password);
            }
        }
    }

    public function logout(){
        $this->setUser(null);
        $this->redirect('/auth');
    }

    /**
     * @before _isLogin
     */
    public function register() {
        $layoutView = $this->getLayoutView();
        $view = $this->getActionView();
        $view->set('saved',false);
        $view->set('isError',false);
        if($this->request->isPost()){
            $name = $this->request->post('name');
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            $isUserExist = User::check_user_exist($email);
            //var_dump($isUserExist);
            if($email && $name && $password && !($isUserExist)){
                $user = new User(array('email' =>$email,
                    'name'=>$name,
                    'password'=>$password));
                $user->save();
                $view->set('saved',true);
            }    
            else{
                if($email || $name || $password){
                    $view->set('isError',true);
                }
                $view->set('name',$name);
                $view->set('email',$email);
                $view->set('password',$password);
            }
        }
    }

}

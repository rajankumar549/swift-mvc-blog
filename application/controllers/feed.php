<?php

/**
 * The Default Example Controller Class
 *
 * @author Faizan Ayubi, Hemant Mann
 */
use \Models\UserFeed as UserFeed;
use Framework\Controller as Controller;
use Framework\RequestMethods as RequestMethods;
use Framework\Registry as Registry;

class Feed extends Auth {

    public function __construct($options = array()) {
        parent::__construct($options);
        $this->setLayout('/layouts/standard');
    }

    /**
     * @before _checkUserLogin
     */
    public function index() {
        $layoutView = $this->getLayoutView();
        $view = $this->getActionView();
        $view->set('page_title2','Feed Page2');
        $layoutView->set('page_title','Feed Page');
        $view->set('saved',false);
        $view->set('isError',false);
        if($this->request->isPost()){
            $title = $this->request->post('post_title');
            $description = $this->request->post('post_desc');
            if($title && $description){
                $session = Registry::get('session');
                $user = $session->get('user');
                $user_feed = new UserFeed(array('user_id'=>$user,
                    'title'=>$title,
                    'description'=>$description
                ));
                $user_feed->save();
                $this->redirect('/feed');
            }    
            else{
                if($title || $description){
                    $view->set('isError',true);
                }
                $view->set('title',$title);
                $view->set('description',$description);
            }
        }
        $session = Registry::get('session');
        $allUserFeed= UserFeed::all(['user_id = ?'=>$session->get('user')]);
        $view->set('user_feeds',$allUserFeed);
    }

    /**
     * @before _checkUserLogin
     */
    public function edit() {
        $layoutView = $this->getLayoutView();
        $view = $this->getActionView();
        $layoutView->set('page_title','Edit Page');
        $view->set('isError',false);
        $view->set('no_record',false);
        if($this->request->isPost()){
            $title = $this->request->post('post_title');
            $description = $this->request->post('post_desc');
            $id = $this->request->post('id');
            if($id && $title && $description){
                $user_feed = UserFeed::first(['id=?'=>$id]);
                if(empty($user_feed)){
                    $view->set('no_record',true);
                }
                $user_feed->update_params($title,$description);
                $user_feed->save();
                $this->redirect('/feed');
            }    
            else{
                if($title || $description){
                    $view->set('isError',true);
                }
                $view->set('id',$id);
                $view->set('title',$title);
                $view->set('description',$description);
            }
        }
        else{
            $id = $this->request->get('id');
            $user_feed = UserFeed::first(['id=?'=>$id]);
            if($user_feed){
                $view->set('title',$user_feed->title);
                $view->set('description',$user_feed->description);
                $view->set('id',$id);
                $view->set('no_record',false);
            }
            else{
                $this->redirect('/feed');
            }
        }
    }

    /**
     * @before _checkUserLogin
     */
    public function show(){
        $layoutView = $this->getLayoutView();
        $view = $this->getActionView();
        $id = $this->request->get('id');
        $user_feed = UserFeed::first(['id=?'=>$id]);
        $layoutView->set('page_title','Feed');
        $view->set('feed',$user_feed);
    }
    
    /**
     * @before _checkUserLogin
     */
    public function feedDelete(){
        $this->setWillRenderLayoutView(false);
        $id = $this->request->post('id');
        if($id){
            $user_feed = UserFeed::first(['id = ?'=>$id]);
            if($user_feed){
                $user_feed->delete();
                $this->redirect('/feed');
            }
        }
    }

}

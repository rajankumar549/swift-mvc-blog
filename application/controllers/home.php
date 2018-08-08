<?php

/**
 * The Default Example Controller Class
 *
 * @author Faizan Ayubi, Hemant Mann
 */
use Framework\Controller as Controller;
use \Models\UserFeed as UserFeed;
class Home extends Auth {

    public function __construct($options = array()) {
        parent::__construct($options);
       $this->setLayout('/layouts/standard');
    }

     /**
     * @before _checkUserLogin
     */
    public function index() {
    	$layoutView = $this->getLayoutView();
        $view = $this->getActionView(); // Gets the property _actionView
        $view->set('ip', $this->request->getIp());
		$view->set('headers', $this->request->headerBag()->all());
		$layoutView->set('page_title','Home Page :-)');
        $allfeeds = UserFeed::all();
        $view->set('allfeeds',$allfeeds);
    }

}

<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
use Framework\Registry as Registry;
namespace Models;
    class User extends \Shared\Model {

        /**
         * @column
         * @readwrite
         * @type text
         * @length 100
         * 
         * @label username
         */
        protected $_name;

        /**
         * @column
         * @readwrite
         * @type text
         * @length 100
         * @uindex
         * 
         * @label email address
         */
        protected $_email;

        /**
         * @column
         * @readwrite
         * @type text
         * @length 100
         * @index
         * 
         * @label password
         */
        protected $_password;

        public static function check_user_exist($email){
            $user = User::first(['email = ?' => $email]);
            if($user)
            {
                return true;
            }
            else{
                return false;
            }
        }
        
    }

// CREATE TABLE users (
//     name varchar(100) DEFAULT NULL,
//     email varchar(100) DEFAULT NULL,
//     password varchar(100) DEFAULT NULL,
//     id int(11) AUTO_INCREMENT,
//     created datetime DEFAULT NULL,
//     modified datetime DEFAULT NULL,
//     PRIMARY KEY (id));

// insert into users (name,email,password,created,modified) values ('Rajan Kumar','rajankumar549@gmail.com', '1234567890','2018-09-22','2018-09-19');
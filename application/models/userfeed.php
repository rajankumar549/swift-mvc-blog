<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
namespace Models;
class UserFeed extends \Shared\Model {
    

    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @label user_id
     */
    protected $_user_id;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 200
     * 
     * @label title
     */
    protected $_title;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 900
     * @index
     * 
     * @label description
     */
    protected $_description;
    
    public function update_params($title,$description){
        $this->title = $title;
        $this->description = $description;
    }

}

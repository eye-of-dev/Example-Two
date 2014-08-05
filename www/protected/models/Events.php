<?php

class Events extends CActiveRecord
{

    public $date;
    public $title;
    public $description;
    public $date_added;
    
    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{events}}';
    }
    
}
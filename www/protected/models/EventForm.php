<?php

class EventForm extends CFormModel
{
    public $date;
    public $title;
    public $description;
    
    public function rules()
    {
        return array(
            // username and password are required
            array('date, title, description', 'required'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'date'  =>  'Дата:',
            'title' =>  'Заголовок:',
            'description' => 'Описание:'
        );
    }
    
    public function addEvent()
    {
        $event = new Events;
        $event->date = date('Y-m-d H:i:s', strtotime($this->date));
        $event->title = $this->title;
        $event->description = $this->description;
        $event->date_added = date('Y-m-d H:i:s');
        $event->save();
    }    
    
}

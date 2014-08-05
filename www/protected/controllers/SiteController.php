<?php

class SiteController extends Controller
{
    public $event;

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        if (Yii::app()->user->isGuest)
        {
            $model = new LoginForm;

            // if it is ajax validation request
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if (isset($_POST['LoginForm']))
            {
                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login()){
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            // display the login form
            $this->render('login', array('model' => $model));
        }
        else
        {
           
            $this->event = new EventForm;
            
            if (isset($_POST['EventForm']))
            {
                $this->event->attributes = $_POST['EventForm'];
                
                if ($this->event->addEvent())
                {
                    $this->event->redirect(Yii::app()->user->returnUrl);
                }
            }
            
            if(Yii::app()->user->role_id === '1')
            {
                $this->layout = 'column2';
            }
            
            $this->render('index', 
                array(
                    'event' => $this->event
                )
            );

        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest){
                echo $error['message'];
            }else{
                $this->render('error', $error);
            }
                
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionChangeEventDate()
    {
        
        $id = Yii::app()->getRequest()->getPost('id', 0);
        
        $data = array(
            'date' => date('Y-m-d H:i:s', strtotime(Yii::app()->getRequest()->getPost('date'))), 
            'title' => Yii::app()->getRequest()->getPost('title'), 
            'description' => Yii::app()->getRequest()->getPost('description'), 
            'date_added' => date('Y-m-d H:i:s')
        );
        
        Events::model()->updateByPk($id, $data);
        $this->redirect(Yii::app()->user->returnUrl);
    }

}

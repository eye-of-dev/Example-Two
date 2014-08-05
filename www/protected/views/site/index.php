<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->widget('CalendarWidget'); ?>

<div id="dialog-form" title="Create new event" style="display: none;">
    
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
            'validateOnSubmit' => true,
	),
)); ?>
    
<p class="note">Поля, отмеченные звездочкой <span class="required">*</span> являются обязательными при заполнении.</p>
<div class="row">
    <?php echo $form->labelEx($event, 'date'); ?>
    <?php echo $form->textField($event, 'date'); ?>
    <?php echo $form->error($event, 'date'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($event, 'title'); ?>
    <?php echo $form->textField($event, 'title'); ?>
    <?php echo $form->error($event, 'title'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($event, 'description'); ?>
    <?php echo $form->textArea($event, 'description'); ?>
    <?php echo $form->error($event, 'description'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить'); ?>
    <a href="javascript:void(0);" onclick="$('#dialog-form').hide();">Отмена</a>
</div>

<?php $this->endWidget(); ?>
</div>

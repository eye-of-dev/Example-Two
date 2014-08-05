<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
        <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'event-edit-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'action' => array('/site/changeeventdate'),
        )); ?>
        <table>
            <thead>
                <tr>
                    <th>Ред. событие</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input id="datepicker" type="text" value="" name="date" placeholder="Дата" style="width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" value="" name="id">
                        <input type="text" value="" name="title" placeholder="Заголовок" style="width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="description" style="width: 150px; height: 150px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="" value="Сохранить" style="width: 150px;">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php $this->endWidget(); ?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
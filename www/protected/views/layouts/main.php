<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->assetManager->baseUrl; ?>/5176e90b/jui/css/base/jquery.ui.datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->assetManager->baseUrl; ?>/5176e90b/jui/css/base/jquery.ui.tooltip.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Logout (' . Yii::app()->user->name . ')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
            <script type="text/javascript" src="<?php echo Yii::app()->assetManager->baseUrl; ?>/5176e90b/jui/js/jquery-ui.min.js"></script>
            <script>
            $(function() {
                
                $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                
                $( ".draggable" ).draggable({ 
                    snap: ".ui-widget-header",
                    drag: function(event_drag){

                    },
                    stop: function( event, ui ) {

                        var event_id = $(this).data('id');
                        var parent_id = $(this).parents('td').attr('id');

//                        console.log(ui);
//                        console.log(event);

//                        $.ajax({
//                            type: 'POST',
//                            url: 'index.php?r=site/changeeventdate',
//                            data: 'event_id=' + event_id + '&data=',
//                            async: false,
//                            success: function(data){
//
//                            }
//                        });
                    }
                });

                $('.open-event').bind('click', function(){
                    var id = $(this).attr('id');
                    var content = $('#' + id).attr('title');

                    $('#' + id).tooltip({
                        content: content,
                        position: {
                            my: "center bottom-20",
                            at: "center top",
                            using: function( position, feedback ) {
                                $( this ).css( position );
                                $( "<div>" )
                                .addClass( "arrow" )
                                .addClass( feedback.vertical )
                                .addClass( feedback.horizontal )
                                .appendTo( this );
                           }
                        }
                    });
                    $('#' + id).tooltip( "open" );

                    var event_id = $(this).data('id');
                    var date = $(this).parent().parent().parent().data('date');
                    var title = $(this).text();
                    
                    $('#sidebar input[name=id]').val(event_id);
                    $('#sidebar input[name=title]').val(title);
                    $('#sidebar input[name=date]').val(date);
                    $('#sidebar textarea[name=description]').val(content);

                });

                $('.open-event').bind('mouseout', function(){
                    var id = $(this).attr('id');
                    $('#' + id).tooltip( "destroy" );
                });

                $('.add_event').bind('click', function(){
                    var date = $(this).data('date');
                    $('#EventForm_date').val(date);
                    
                    $('#dialog-form').show();
                });

            });
           </script>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

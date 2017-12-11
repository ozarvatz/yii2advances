<?php
// use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\utils\DevUtils;
$this->title = 'Game';

$asyncUrl = Yii::$app->request->hostInfo . Yii::$app->urlManager->createUrl('game/index');
//action="/frontend.dev/index.php?r=game%2Findex"
$csrf = '{}';
if (Yii::$app->request->enableCsrfValidation) {
    $csrfTokenName = Yii::$app->request->csrfParam;
    $csrfToken = Yii::$app->request->csrfToken;
    $csrf = "{'$csrfTokenName':'$csrfToken'}";
} 
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Time to play the game!!! 
    </p>
    <?= Html::checkbox('play async', true, 
        ['label' => 'Play asynchronously',
         'id' => 'play-async',
         'onclick' => "if(!this.checked) {window.location.href ='{$asyncUrl}'}" 
         // 'onclick' => "alert('pach')" 
         ]);
    ?>

    <div id="equation-array">
    </div>
   	<form id="game-form"  method="post">
		                
		<div class="form-group field-dmath-id">
			<input type="hidden" id="dmath-id" class="form-control" name="DMath[id]" value="78">
			<p class="help-block help-block-error"></p>
		</div>        		
		<div class="form-group field-dmath-task required">
			<input type="hidden" id="dmath-task" class="form-control" name="DMath[task]" value="71+52">
			<p class="help-block help-block-error"></p>

		</div>
		<div class="form-group field-dmath-result required">
			<input type="hidden" id="dmath-result" class="form-control" name="DMath[result]" value="123">
			<p class="help-block help-block-error"></p>
		</div>
		<label class="control-label">71+52=?</label>
        <div class="form-group field-dmath-answer required">
			<label class="control-label" for="dmath-answer">Answer</label>
			<input type="text" id="dmath-answer" class="form-control" name="DMath[answer]" value="-1" autofocus="" aria-required="true">
			<p class="help-block help-block-error"></p>
		</div>
             	
           

        <div class="form-group">
            <button id="submit-btn" type="button" class="btn btn-primary" name="game-button">Submit</button>                
        </div>

    </form>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		
		$.ajax({
	        url: "<?=Yii::$app->urlManager->createUrl('game/data');?>",
			type: "GET",
			data: {},
	        dataType: "json",
	        success: function(data) {
	        	drawEquationArray(data["equation_list"]);
	        	drawEquation(data["model"]);
	        	// alert(data['model']);
				// $("#User_user_password").val(data);
	        }
	    });
	});
	$( "#submit-btn" ).click(function(){
		try{
			var dmathAnswer = $("#dmath-answer").val();
			var dmathId = $("#dmath-id").val();
			// var data_to_send = $.serialize(dmath);
			console.log('answer, id :');
			console.log(dmathAnswer);
			console.log(dmathId);
			$.ajax({
		        url: "<?=Yii::$app->urlManager->createUrl('game/data');?>",
				type: "GET",
				// data: <?= $csrf; ?>,
				data : {'id' : dmathId, 'answer' : dmathAnswer},
		        dataType: "json",
		        success: function(data) {
		        	console.log(data);
		        	// alert(data['model']);
					// $("#User_user_password").val(data);
		        }
		    });
		}
		catch(e)
		{
			console.log(e);
		}
	});

	var drawEquationArray = function(equationArray)
	{
		console.log(equationArray);
		equationArray.forEach(function(entry){
			var result = entry["result"];
			var answer = entry["answer"];
			var equals = result == answer ? '=' : '!=';

			$form = $('<form id="equationList-form"></form>');
			if(result == answer)
			{
				//set class for green V - correct answer
				$form.append('<label class="control-label">' + entry["task"] + equals + answer + '</label>');
			}
			else
			{
				//set class for red X - incorrect answer
				$form.append('<label class="control-label">' + entry["task"] + equals + answer + '</label>');
			}
			$("#equation-array").append($form);
		});	
	};

	var drawEquation = function(equation)
	{

	}
</script>
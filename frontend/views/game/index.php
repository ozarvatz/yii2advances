<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\game\data_entity\GameDataEntity;

$this->title = 'Game';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Time to play the game!!! 
    </p>

    <?php  
    	foreach ($arEquationList as &$arEquation) 
    	{
            $isEquals = $arEquation->result == $arEquation->answer;
            $comperator = $isEquals ? '=' : '!=';
    		?>
            <?php $form = ActiveForm::begin(['id' => 'equationList-form']); ?>
                <label class="control-label" ><?=$arEquation->task . $comperator . $arEquation->answer;?></label>
                <?= $form->field($arEquation, 'answer', [
                        // 'template' => "{$model->task}"
                    ])->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'equations-button', 'disabled' => true]) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <?php
            

    	}
    ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'game-form']); ?>
                <?php  echo $form->field($model, 'id')->hiddenInput()->label(false); ?>
        		<?php  echo $form->field($model, 'task')->hiddenInput()->label(false); ?>
        		<?php  echo $form->field($model, 'result')->hiddenInput()->label(false); ?>
                <label class="control-label" ><?=$model->task . "=?" ;?></label>
                <?= $form->field($model, 'answer', [
                        // 'template' => "{$model->task}"
                    ])->textInput(['autofocus' => true]) ?>

             	
           

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'game-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <div class="site-index">

        
            <h1 class="display-4"> CREATE BOOK </h1><br>

            <div  class="body-content">
                
                <?php
                    $form = ActiveForm::begin();
                ?>

                <div class="row">
                    <div class="form-group">
                        <div>
                            <?= $form->field($book, 'name')->textArea(['rows'=>'1']); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div>
                            <?= $form->field($book, 'author')->textArea(['rows'=>'1']); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div>
                            <div class="col-lg-3">
                                <?php Pjax::begin(['enablePushState' => false]); ?>
                                <?= Html::submitButton('Create Post', ['class'=>'btn btn-primary']); ?>
                                <?php Pjax::begin(['enablePushState' => false]); ?>
                            </div>
                            <div class="col-lg-3">
                                <a href = <?php echo yii::$app->homeUrl; ?> class="btn btn-primary my-1">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            
</html>

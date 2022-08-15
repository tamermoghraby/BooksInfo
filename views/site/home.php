<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        
        <script>
          $(document).ready(function(){
           $("#create").click(function(){
             $("#create-form").slideDown("slow");
             $("#close-form").slideDown("slow");
            });
          
           $("#close-form").click(function(){
            $("#create-form").slideUp("slow");
            $("#close-form").slideUp("slow");
            $("#status").hide();
           });

           $("#testbtn").click(function(){
            $("#testdiv").load(" #testdiv");
           });

          });
        </script>

        <script>
           $(document).ready(function($) {
            $("#submit-btn").click(function(event) {
              $("#loading-btn").show();
              $("#submit-ctr").hide();  
            event.preventDefault(); 
            var data = $("#form1").serializeArray();
            var url = $("#form1").attr('action');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
                if (response.data.success == true) {
                  $("#form1").trigger("reset");
                  //$("#create-form").slideUp("slow");
                  //$("#close-form").slideUp("slow");
                  $("#tablediv").load(" #tablediv");
                  $("#loading-btn").hide();
                  $("#submit-ctr").show();
                  $("#status").html("Saved Successfully");
                  $("#status").addClass("text-success");
                  $("#status").slideDown("slow");

                  return false;
                  
                }
                else{
                  $("#loading-btn").hide();
                  $("#submit-ctr").show();
                  $("#status").html("Failed To Save");
                  $("#status").addClass("text-danger");
                  $("#status").slideDown("fast");
                }
            })
            .fail(function() {
                $("#loading-btn").hide();
                $("#submit-ctr").show();
                alert("Failed to Save");
                console.log("error");
            });
        
        });

    });
        </script>

    </head>
    <body>
        <h1 class="display-4">Books Info</h1><br>
        <div class="row">
          <button id="create" class="btn btn-warning my-1">Create</button>
          <button style="display: none;"  id="close-form" class="btn btn-danger my-1 mx-5">Close</button>
        </div>
        <div id="create-form" style="display: none">
          <?php 
              $form = ActiveForm::begin([
                  'action' => ['site/submit'],
                  'options' => [
                      'class' => 'my-4',
                      'id' => 'form1'

                  ]
              ]); 
          ?>
          
            <div class="form-group row">
              <div class="col-sm-10">
                <?= $form->field($book, 'name'); ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <?= $form->field($book, 'author'); ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <?= $form->field($book, 'category'); ?>
              </div>
            </div>
            <div class="form-group row">
            <div id="loading-btn" style="display: none;">  
              <button class="btn btn-success" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
              </button>
              </div>
              <div class="col-sm-10 my-3" id="submit-ctr">
                <?= Html::button("Save Book", ['class' => "btn btn-primary", 'id' => 'submit-btn']); ?>
                <h4 id="status" class="my-1" style="display:none ;"></h4>
              </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div id="create-form1" style="display: none;">
          <form class="my-4">
            <div class="form-group row">
              <label for="inputEmail3" class="col-lg-1 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Name">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-lg-1 col-form-label">Author</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputAuthor" placeholder="Author">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputCategory" class="col-lg-1 col-form-label">Category</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputCategory" placeholder="Category">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10 my-3">
                <button type="submit" class="btn btn-primary">Save Book</button>
              </div>
            </div>
          </form>
        </div>

        <div class="body-content" >

            <div class="row" id="tablediv">
             <?php Pjax::begin() ?>
             <table class="table table-dark" id="table">
                <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Author</th>
                      <th scope="col">Category</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($books) > 0): ?>
                    <?php foreach ($books as $book): ?>
                    <tr>
                      <th scope="row"> <?php echo $book->id; ?> </th>
                      <td> <?php echo $book->name; ?> </td>
                      <td> <?php echo $book->author; ?> </td>
                      <td> <?php echo $book->category; ?> </td>
                      <td>
                        <span><?= Html::a('View', ['#'], ['class' => 'badge badge-primary']) ?> </span>
                        <span><?= Html::a('Update', ['#'], ['class' => 'badge badge-success']) ?> </span>
                        <span><?= Html::a('Delete', ['#'], ['class' => 'badge badge-danger']) ?> </span>
                      </td>
                    </tr>
                    <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td>No Records Found</td>
                        </tr>
                    <?php endif; ?>    
                  </tbody>

              </table> 
              <?php Pjax::end(); ?>

            </div>
        </div>  

    </body>
</html>

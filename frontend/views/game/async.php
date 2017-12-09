<?php
use aki\vue\Vue;
?>
<?php 
Html::a('Your Link name','controller/action', [
'title' => Yii::t('yii', 'Close'),
    'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
     $.ajax({
    type     :'POST',
    cache    : false,
    url  : 'controller/action',
    success  : function(response) {
        $('#close').html(response);
    }
    });return false;",
                ]);
?>
<?php Vue::begin([
    'id' => "vue-app",
    'data' => [
        'message' => "hello",
        'seen' => false,
        'todos' => [
            ['text' => "aa"],
            ['text' => "akbar"]
        ]
    ],
    'methods' => [
        'reverseMessage' => new yii\web\JsExpression("function(){"
                . "this.message =1; "
                . "}"),
    //     'getList' => new yii\web\JsExpression("
    //     	function(){
    //     		this.axios.get().then( (response) => {
				//     console.log(response) // this logs correctly
				//     this.message = response;
				// })
    //     	}"
    //     ),

    ]
]); ?>
    
    <p>{{ message }}</p>
    <button v-on:click="reverseMessage">Reverse Message</button>
    
    <p v-if="seen">Now you see me</p>
    
    
    <ol>
        <li v-for="todo in todos">
          {{ todo.text }}
        </li>
    </ol>
    
    <p>{{ message }}</p>
    <input v-model="message">
  
  
<?php Vue::end(); ?>
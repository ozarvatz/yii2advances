<?php
use aki\vue\Vue;
use yii\helpers\Html;
use yii\helpers\Url;

// $this->registerJsFile("https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js");
// $this->registerJsFile("https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js");
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
                . "},"),
        'getList' => new yii\web\JsExpression("
        	function(){
        		
	     //    		$.ajax({
				  //       url: \"" . Url::base() . 'game/data' . "\",
						// type: \"GET\",
				  //       dataType: \"text\",
				  //       success: function(data) {
		    //     			alert(data);
		    //     		},
		    //     		error: function(data) {
		    //     			alert(\"error:\" + data);
		    //     		}
		    //     	})
        		this.http.get(\"/someUrl\").then(response => {

				    // get body data
				    alert(response.body);

				  }, response => {
				    // error callback
				    alert(\"error\" + response);
				  });

			        
        	}"
        ),

    ]
]); ?>
    
    <p>{{ message }}</p>
    <button v-on:click="getList">Reverse Message</button>
    
    <p v-if="seen">Now you see me</p>
    
    
    <ol>
        <li v-for="todo in todos">
          {{ todo.text }}
        </li>
    </ol>
    
    <p>{{ message }}</p>
    <input v-model="message">
  
  
<?php Vue::end(); ?>
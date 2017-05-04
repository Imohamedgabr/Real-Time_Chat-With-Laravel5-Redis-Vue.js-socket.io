@extends('layouts.app')

@section('content')

    <div class="container">
    	<div class="row">
	    	<div class="col col-md-8 col-offset-2">
				<div>


					<div class="panel panel-default">
						<div class="panel-heading">
					    	<h3 class="panel-title">Chatroom</h3>
					 	</div>


						<div class="panel-body">
							
							<div id="chat">
					    
					   			<Example :id="{{ Auth::id() }}"></Example>
					   
					 		</div>

						</div>
			
				</div>
			</div>
		</div>
	</div>
	
@endsection

{{-- @section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
<script>
		var socket = io('http://redischat.dev:3000');

            new Vue({
               el: '#chat',

               data:{
               		messageText: '',
                    messages:[]
               },
                mounted(){
                    socket.on('test-channel:App\\Events\\UserSignedUp',function(data){
                        console.log(data);
                        //data which gets published and push it in array
                        // this.messages.push(data.message);
                    }.bind(this));
                },
                methods: {
                	sendMessage() {
			            // use axios to post data
			            axios.post('/chat/message', {
						    username: 'mohamed',
						    message: 'awesome'
						  })
						  // .then(function (response) {
						  //   console.log(response);
						  // })
						  // .catch(function (error) {
						  //   console.log(error);
						  // });

			            this.messageText = '';
			        }
                }

            });

</script>

@endsection
 --}}
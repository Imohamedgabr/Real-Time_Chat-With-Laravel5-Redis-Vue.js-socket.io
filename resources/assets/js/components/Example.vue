<template>
    <div>
        <div v-for="message in messages">

            <p> <b> {{ message.username }} </b> : {{ message.message }}</p>
        </div>
        
        <!-- sending message when clicking enter -->
        <input id="message" type="text" placeholder="Start typing your message..."  v-model="messageText" @keyup.enter="sendMessage">
        <button class="btn btn-primary" @click="sendMessage">Send</button>

        </div>
    </div>
</template>

<script>
    var socket = io('http://redischat.dev:3000');
    export default {
                
                data() {
                        return {
                            messageText: '',
                            messages:[]
                        }
                    },
                    
                mounted(){
                    socket.on('test-channel:App\\Events\\UserSignedUp',function(data){
                        // console.log(data.message.message);
                        // we listen on the socket using node and publish data using the event and the data which gets published we push it in array 
                        //Note: we don't get that data wrote up there and push it
                        this.messages.push(data.message);
                        // console.log(this.messages);
                    }.bind(this));
                },
                methods: {
                    sendMessage() {
                        // use axios to post data
                        axios.post('/chat/message', {
                            username: 'mohamed',
                            message: this.messageText
                          })
                          .then(function (response) {
                            console.log(response);
                          })
                          .catch(function (error) {
                            console.log(error);
                          });

                        this.messageText = '';
                    }
                }
        
    }
</script>

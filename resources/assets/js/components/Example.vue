<template>
    <div>
        <div v-for="message in messages">

             <!-- <small> {{ message.username }} </small> -->
            <p> {{ message }}</p>
        </div>

        <input id="message" type="text" placeholder="Start typing your message..."  v-model="messageText">
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
                        // console.log(data.message);
                        //data which gets published and push it in array
                        this.messages.push(data.message);
                        console.log(this.messages);
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

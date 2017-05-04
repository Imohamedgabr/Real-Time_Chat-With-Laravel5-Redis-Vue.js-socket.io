<template>
    <div>
        <div v-for="message in messages">

            <p> <b> {{ message.sender }} </b> : {{ message.content }}</p>
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
                props: ['id'],
                mounted(){
                    // need the id from the URL to get the messages between him and this user
                    self = this;
                    function getParameterByName(name, url) {
                        if (!url) url = window.location.href;
                        name = name.replace(/[\[\]]/g, "\\$&");
                        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                            results = regex.exec(url);
                        if (!results) return null;
                        if (!results[2]) return '';
                        return decodeURIComponent(results[2].replace(/\+/g, " "));
                    }
                    // console.log(getParameterByName('user_id'));
                    // send get request to get the messages

                    axios.get('/returnMessages/' + getParameterByName('user_id') )
                          .then(function (response) {
                            // console.log(response);
                            self.messages = response.data;
                            console.log(self.messages);
                          })
                          .catch(function (error) {
                            console.log(error);
                          });                  

                    // you will need sender name to add here
                    // you will need reciever name to compare with the id in the broadcasted message to know to display here or not
                    // you will need the content ofcourse
                    // this is the authenticated user id came from props
                    console.log(this.id);
                    socket.on('test-channel:App\\Events\\UserSignedUp',function(data){
                        // console.log(data.message.message);
                        // we listen on the socket using node and publish data using the event and the data which gets published we push it in array 
                        //Note: we don't get that data wrote up there and push it
                        // console.log(data.message)
                        if (data.message.sender_id == this.id && data.message.receiver_id == getParameterByName('user_id')) {

                            this.messages.push(data.message);
                        }
                         if (data.message.sender_id == getParameterByName('user_id') && data.message.receiver_id == this.id) {
                            
                            this.messages.push(data.message);
                        }
                        // this.messages.push(data.message);
                        // console.log(this.messages);
                    }.bind(this));
                },
                methods: {
                    sendMessage() {
                        self = this;

                        function getParameterByName(name, url) {
                        if (!url) url = window.location.href;
                        name = name.replace(/[\[\]]/g, "\\$&");
                        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                            results = regex.exec(url);
                        if (!results) return null;
                        if (!results[2]) return '';
                        return decodeURIComponent(results[2].replace(/\+/g, " "));
                        }

                        // use axios to post data
                    

                        axios({
                          method: 'post',
                          url: '/sendMessages/' + getParameterByName('user_id'),
                          data: {
                            receiver_id: getParameterByName('user_id'),
                            message: self.messageText
                          }
                        });

                        this.messageText = '';
                    }
                }
        
    }
</script>

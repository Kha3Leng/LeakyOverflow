<template>
    <div class="container">
<!--        {{this.userId}}-->
        <div role="button" @click="followUser" v-text="followText"></div>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follow'],
        data: function (){
          return {
              status: this.follow
          }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            followUser(){
                axios.post('/follow/'+this.userId)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(errors=>{
                        if(errors.response.status == 401){
                            window.location = '/login';
                        }
                    });
            }
        },
        computed:{
            followText(){
                return (this.status)? 'Following': 'Follow';
            }
        }
    }
</script>

<template>
    <div class="container">
        <div class="d-flex align-items-center">
            <i class="material-icons" v-if="yes" style="color:green;">cached</i>
            <i class="material-icons" v-else style="color:black;">cached</i>
            <span role="button" @click="reacted" v-text="doThis"></span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['postId', 'tweetCount', 'retweeted'],
    data: function (){
        return {
            status: true,
            count: this.tweetCount,
            yes: this.retweeted
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        reacted() {
            axios.post('/retweet/'+this.postId)
                .then(response=>{
                    this.count = response.data[0];
                    this.yes = response.data[1];
                    console.log(response.data);
                });
        }
    },

    computed:{
        doThis(){
            return this.count;
        }
    }
}
</script>

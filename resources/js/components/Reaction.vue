<template>
    <div class="container">
        <span role="button" @click="reacted" v-text="doThis"></span>
    </div>
</template>

<script>
export default {
    props: ['postId', 'reactionCount'],
    data: function (){
        return {
            status: true,
            count: this.reactionCount
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        reacted() {
            axios.post('/r/'+this.postId)
                .then(response=>{
                    this.count = response.data;
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

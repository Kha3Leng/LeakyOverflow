<template>
    <div class="container">
        <div role="button" @click="reacted">{{this.reactionCount}}</div>
    </div>
</template>

<script>
export default {
    props: ['postId', 'reactionCount'],
    data: function (){
        return {
            status: true,
            count: 1
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        reacted() {
            // axios.post('/r/'+this.postId)
            //     .then(response => {
            //         console.log(response.data);
            //     })
            //     .catch(errors=>{
            //
            //     });
            // this.status = !this.status;
            // console.log(response.data);
            // this.count += 1;
            axios.post('/r/'+this.postId)
                .then(response=>{
                    this.status != this.status;
                    console.log(response.data);
                });
        }
    },

    computed:{
        loveText(){
            return (this.status)? 'Love':'No love';
        }
    }
}
</script>

<template>
    <div class="container">
        <div class="d-flex align-items-center">
            <i class="material-icons" v-if="color" style="color:red;">favorite</i>
            <i class="material-icons" v-else style="color:black;">favorite</i>
            <span role="button" @click="reacted" v-text="doThis"></span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['postId', 'reactionCount', 'color'],
    data: function (){
        return {
            status: true,
            count: this.reactionCount,
            color: this.color
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        reacted() {
            axios.post('/r/'+this.postId)
                .then(response=>{
                    this.count = response.data[0];
                    this.color = response.data[1];
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

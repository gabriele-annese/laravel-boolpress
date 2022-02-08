<template>
  <div class="title">
      <h1>Vue ok</h1>
      <h3>Work in progress</h3>
  </div>
</template>

<script>

import axios from 'axios';

export default {
    name: 'App',
    components:{},
    data(){
        return {
            posts: null,
        }
    },
    created(){
        this.getPosts()
    },
    methods: {
        getPosts(){
            axios.get('http://127.0.0.1:8000/api/posts')
                .then(res => {
                    console.log(res.data);

                    this.posts = res.data
                });
        }
    }
}
</script>

<style lang="scss">
    .title{
        text-transform: uppercase;
    }
</style>
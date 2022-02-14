<template>
  <section class="container">
      <div v-if="post">
          <h1 class="mb-3">{{ post.title }}</h1>

          <h4 v-if="post.category" class="mb-4">Category: <strong>{{post.category.name}}</strong> </h4>
          <h4 v-else>Uncategorized</h4>
          
          <Tags class="mb-5" :list="post.tags" />
          
          <p>{{post.content}}</p>
      </div>
      <Loader text="Loading for post..." v-else />
  </section>
</template>

<script>
import axios from 'axios'
import Tags from '../components/Tags'
import Loader from '../components/Loader'


export default {
    name: 'PostDetail',
    components: {
        Tags,
        Loader,
    },
    data(){
        return{
            post: null,
        }
    },
    created(){
       this.getPostDetail();
    },
    methods:{
        getPostDetail(){
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then( res => {
                    console.log(res.data);

                    if(res.data.not_found){
                        this.$router.push( { name: 'not-found' });
                    }else{

                    }
                    this.post = res.data;
                })
                .catch(err => log.error(err));
        }
    }
}
</script>

<style>

</style>
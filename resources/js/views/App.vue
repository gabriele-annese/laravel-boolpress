
<template>
  <section>
      <div class="container">
          <h1 class="my-5">Our Blog</h1>

          <div v-if="posts">
              <article class="mb-4" v-for="post in posts" :key="`post-${post.id}`">
                  <h2>{{ post.title }}</h2>
                  <div class="mb-4">
                      {{  formatData(post.created_at) }}
                  </div>
                  <p class="mb-4">
                      {{ getExcerpt(post.content, 100) }}
                  </p>
              </article>
          </div>

          <div v-else>
              loading please..
          </div>

      </div>
  </section>
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
        },

        getExcerpt(text, maxLength){
            if(text.length > maxLength){
                return text.substr(0, maxLength) + '...';
            }
            
            return text;
        },
        formatData(postDate){
            console.log(postDate);
            const date = new Date(postDate);
            console.log(date);

            const formatted = new Intl.DateTimeFormat('it-IT').format(date);
            return formatted;
        },
    }
}
</script>

<style lang="scss">
    .title{
        text-transform: uppercase;
    }
</style>

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
                  <router-link :to="{ name: 'post-detail', params: { slug: post.slug } }">
                      read hear
                  </router-link>
              </article>

              <button 
                class="btn btn-primary mr-3"
                :disabled="pagination.current === 1"
                @click="getPosts(pagination.current - 1)"
              >
                  Prev
              </button>

              <button
                class="btn mr-3"
                :class="pagination.current === i ? 'btn-primary' : 'btn-secondary'"
                v-for="i in pagination.last"
                :key="`page-${i}`"
                @click="getPosts(i)"
              >
                {{ i }}
              </button>

              <button
                class="btn btn-primary "
                :disabled="pagination.current === pagination.last "
                @click="getPosts(pagination.current + 1)"
              >
                  Next
              </button>

          </div>

          <Loader text="Loading for archives posts..." v-else />

      </div>
  </section>
</template>

<script>

import axios from 'axios';
import Loader from '../components/Loader.vue';
export default {
    name: 'Blog',
    components:{
        Loader,
    },
    data(){
        return {
            posts: null,
        }
    },
    created(){
        this.getPosts()
    },
    methods: {
        getPosts(page = 1){
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {

                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    };
                });
        },

        getExcerpt(text, maxLength){
            if(text.length > maxLength){
                return text.substr(0, maxLength) + '...';
            }
            
            return text;
        },
        formatData(postDate){
            const date = new Date(postDate);

            const formatted = new Intl.DateTimeFormat('it-IT').format(date);
            return formatted;
        },
    }
}
</script>

<style lang="scss">
   
</style>
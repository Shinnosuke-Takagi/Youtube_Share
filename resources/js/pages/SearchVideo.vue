<template>
   <v-container>
     <v-row>
       <v-col
        sm="8"
       >
          <v-text-field
            label="Search"
            single-line
            append-icon="mdi-magnify"
            v-model="keyword"
            color="amber darken-3"
            @keyup.enter="searchVideo"
          ></v-text-field>
       </v-col>
       <v-col
        sm="4"
       >
          <v-btn dark color="amber darken-3" @click.prevent="searchVideo">Search Button</v-btn>
       </v-col>
     </v-row>
      <v-row v-show="results">
        <v-col
          v-for="video in results"
          :key="video.id.videoId"
          cols="12"
          md="3"
          sm="6"
        >
          <v-card
            :href="`https://www.youtube.com/watch?v=${video.id.videoId}`"
            target="_blank"
            width="320"
            dark
          >
            <v-img
              height="180"
              width="320"
              :src="video.snippet.thumbnails.default.url"
            >
            </v-img>
            <v-card-subtitle><strong>{{ video.snippet.title }}</strong></v-card-subtitle>
            <v-btn
              @click.prevent="share(video.id.videoId)"
              color="amber darken-3"
            > Share
              <v-icon>mdi-share</v-icon>
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { CREATED } from '../util'

export default {
  data () {
    return {
      results: null,
      keyword: '',
      order: 'viewCount',
      video_id: null,
      params: {
        q: '',
        part: 'snippet',
        type: 'video',
        maxResults: '50',
        key: process.env.MIX_API_KEY,
      }
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
  methods: {
    async searchVideo () {
      this.params.q = this.keyword
      const response = await axios.get('https://www.googleapis.com/youtube/v3/search',{
        params: this.params
      })
      console.log(response.data.items)
      this.results = response.data.items
    },
    async share (videoId) {
      if(! this.isLogin) {
        this.$router.push('/login')
        return false
      }
      const response = await axios.post('/api/videos', {video_id: videoId})
      console.log(response)
      if(response.status === CREATED) {
        this.$store.commit('message/setContent', {
          content: '新しくシェアされました！',
          timeout: 6000
        })
        this.$router.push('/')
      }
    }
  }
}
</script>

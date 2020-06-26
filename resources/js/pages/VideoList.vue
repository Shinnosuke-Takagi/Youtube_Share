<template>
  <v-container>
    <v-row v-show="results">
      <v-col
        v-for="video in videos"
        :key="video.id"
        cols="12"
        md="3"
        sm="6"
      >
        <v-card
          :href="`https://www.youtube.com/watch?v=${video.id}`"
          target="_blank"
          width="320"
          height="270"
          dark
        >
          <v-img
            height="180"
            width="320"
            :src="video.snippet.thumbnails.default.url"
          >
          </v-img>
          <v-card-subtitle><strong>{{ video.snippet.title }}</strong></v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      results: null,
      videos: [],
      params: {
        part: 'snippet',
        id: '',
        key: 'AIzaSyBwWbHnKw6jlN76aO6qBhc_vQGOLWiZgSM',
      }
    }
  },
  methods: {
    async getVideoId () {
      const response = await axios.get('/api/videos')
      this.results = response.data.data
      console.log(this.results)
      console.log(this.results.length)
      console.log(this.results[0].video_id)

      const vm = this
      for (let i = 0; i < vm.results.length; i ++) {
        vm.params.id = vm.results[i].video_id
        const videoResources = await axios.get('https://www.googleapis.com/youtube/v3/videos', {
          params: vm.params
        })
        console.log(videoResources)
        console.log(videoResources.data.items[0])
        vm.videos.push(videoResources.data.items[0])
        vm.params.id = ''
      }

      console.log(vm.videos)
    },
  },
  created () {
    this.getVideoId()
  }
}
</script>

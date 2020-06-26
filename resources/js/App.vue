<template>
  <v-app>
    <Navbar />
    <v-container>
      <Message />
      <RouterView />
    </v-container>
    <Footer absolute />
  </v-app>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import Message from './components/Message.vue'
import { INTERNAL_SERVER_ERROR } from './util'

export default {
  components: {
    Navbar,
    Footer,
    Message
  },
  computed: {
    errorCode () {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      handler (val) {
        if(val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')
        }
      },
      immerdiate: true,
    },
    $route() {
      this.$store.commit('error/setCode', null)
    }
  }
}
</script>

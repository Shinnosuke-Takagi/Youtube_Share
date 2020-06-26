<template>
  <v-footer padless dark color="amber darken-3">
    <v-col
      class="text-center"
      cols="12"
    >
    <v-btn v-if="isLogin" @click.prevent="logout" text color="white">Logout</v-btn>
    <RouterLink v-else class="routerlink" to="/login">Register / Login</RouterLink>
    </v-col>
  </v-footer>
</template>

<style scoped>
.routerlink {
  color: white;
  text-decoration: none;
}
</style>

<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    apiStatus () {
      return this.$store.state.auth.apiStatus
    }
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      if(this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }
}
</script>

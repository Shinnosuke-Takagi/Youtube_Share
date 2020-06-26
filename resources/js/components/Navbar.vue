<template>
  <v-card
    dark
    flat
    tile
  >
    <v-toolbar dense color="amber darken-3">
      <v-toolbar-title>
        <RouterLink class="routerlink" to="/">Youtube Share</RouterLink>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <span v-if="isLogin"><strong>{{ username }}</strong></span>
      <v-btn v-if="isLogin" @click="logout" small text>
        logout
      </v-btn>
      <v-btn v-else small text>
        <RouterLink class="routerlink" to="/login">Register / Login</RouterLink>
      </v-btn>
      <v-btn small text>
        <RouterLink class="routerlink" to="/search">Search</RouterLink>
      </v-btn>
    </v-toolbar>
  </v-card>
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
    username () {
      return this.$store.getters['auth/username']
    },
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

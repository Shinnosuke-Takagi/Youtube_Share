<template>
  <v-snackbar
    v-model="snackbar"
    :timeout="timeout"
    top
  >
    {{ message }}
  </v-snackbar>
</template>

<script>
export default {
  data () {
    return {
      snackbar: false,
      timeout: 3000,
    }
  },
  computed: {
    message () {
      return this.$store.state.message.content
    },
    isShared () {
      if(this.message) {
        this.snackbar = true
      }
    }
  }
}
</script>

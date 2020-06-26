<template>
    <v-container>
        <v-col
          cols="12"
          md="12"
        >
          <v-tabs color="amber darken-3">
            <v-tab @click="tab = 1">Login</v-tab>
            <v-tab @click="tab = 2">Register</v-tab>
          </v-tabs>
        </v-col>
        <v-form v-show="tab === 1" ref="formLog" @submit.prevent="login">
          <v-row>
            <h1>Login</h1>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="loginForm.email"
                :rules="emailRules"
                label="E-mail"
                required
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="loginForm.password"
                :rules="passwordRules"
                type="password"
                label="Password"
                required
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              md="12"
            >
              <v-btn type="submit" rounded color="amber darken-3" dark>Submit</v-btn>
            </v-col>
          </v-row>
        </v-form>
        <v-form v-show="tab === 2" ref="formRegi" @submit.prevent="register">
          <v-row>
            <h1>Register</h1>
            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model="registerForm.name"
                :rules="nameRules"
                label="Name"
                required
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model="registerForm.email"
                :rules="emailRules"
                label="E-mail"
                required
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model="registerForm.password"
                :rules="passwordRules"
                type="password"
                label="Password"
                required
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              md="3"
            >
              <v-text-field
                v-model="registerForm.password_confirmation"
                :rules="passwordConfirmationRules"
                :type="'password'"
                label="Password (confirmation)"
                required
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              md="12"
            >
              <v-btn type="submit" rounded color="amber darken-3" dark>Submit</v-btn>
            </v-col>
          </v-row>
        </v-form>
    </v-container>
</template>

<script>
export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      nameRules: [
        v => !!v || 'Name is required',
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 8) || "パスワードは8文字以上で入力してください。"
      ],
      passwordConfirmationRules: [
        v => !!v || 'Password(confirmation) is required',
        v => v === this.registerForm.password || 'Password(confirmation) do not match'
      ],
    }
  },
  computed: {
    apiStatus () {
      return this.$store.state.auth.apiStatus
    }
  },
  methods: {
    async login() {
      await this.$store.dispatch('auth/login', this.loginForm)

      if(this.apiStatus) {
        this.$router.push('/')
      }
    },
    async register () {
      await this.$store.dispatch('auth/register', this.registerForm)

      if(this.apiStatus) {
        this.$router.push('/')
      }
    },
    reset () {
        this.$refs.formLog.reset()
        this.$refs.formRegi.reset()
    },
  },
  mounted () {
    this.reset ()
  }
}
</script>

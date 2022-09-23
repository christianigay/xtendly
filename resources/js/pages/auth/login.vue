<template>
    <div>
    <v-card
      class="d-flex justify-center align-center mb-6"
      style="height: 500px; width:100%; margin-top: 40px;"
      flat
      tile
    >
      <v-card
        class="pa-4"
        outlined
        tile
        style="width: 350px;"
      >
        <v-card-title class="justify-center teal--text">Login</v-card-title>
        <v-text-field
          v-model="data.email"
          @keyup.enter="handleLogin"
          color="teal"
          outlined
          dense
          label="Email *"
          prepend-inner-icon="mdi-account-lock-outline"
        ></v-text-field>
        <v-text-field
          v-model="data.password"
          @keyup.enter="handleLogin"
          :append-icon="showPassword?'mdi-eye-off':'mdi-eye'"
          @click:append="showPassword=!showPassword"
          :type="showPassword ? 'text' : 'password'"
          color="teal"
          outlined
          dense
          label="Password *"
          prepend-inner-icon="mdi-lock-outline"
        ></v-text-field>
        <div>
          <v-row>
            <v-col
            cols="6"
            >
              <v-btn
              @click="$router.push('/auth/register')"
              outlined
              block
              >
                Register
              </v-btn>
            </v-col>
            <v-col
            cols="6"
            >
              <v-btn
              @click="handleLogin"
              color="teal"
              outlined
              block
              >
                Login
              </v-btn>
            </v-col>
            <v-col
            cols="12"
            >
              <v-btn
              @click="$router.push('/')"
              outlined
              block
              color="info"
              >
                Home
              </v-btn>
            </v-col>
          </v-row>
        </div>
      </v-card>
    </v-card>
    </div>
</template>
<script>
import { apiLogin } from '@/apis/auth.js'
export default {
    data: () => ({
        showPassword: false,
        data: {
          email: '',
          password: '',
        },
    }),
    methods: {
      handleLogin() {
        if(! this.data.password) return;
        if(! this.data.email) return;
        apiLogin(this.data)
        .then(({data}) => {
          if(data && data.user) {
            this.$router.push({name: 'dashboard'})
            console.log(data, 'data')

          }
        })
      }
    }
}
</script>
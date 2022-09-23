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
        <v-card-title class="justify-center teal--text">Register</v-card-title>
        <v-text-field
          v-model="data.email"
          @keyup.enter="handleResgister"
          color="teal"
          outlined
          dense
          label="Email"
          prepend-inner-icon="mdi-account-lock-outline"
        ></v-text-field>
        <v-text-field
          v-model="data.password"
          @keyup.enter="handleResgister"
          :append-icon="showPassword?'mdi-eye-off':'mdi-eye'"
          @click:append="showPassword=!showPassword"
          :type="showPassword ? 'text' : 'password'"
          color="teal"
          outlined
          dense
          label="Password"
          prepend-inner-icon="mdi-lock-outline"
        ></v-text-field>
          <div>
            <v-row>
              <v-col
              cols="6"
              >
                <v-btn
                outlined
                block
                >
                  Login
                </v-btn>
              </v-col>
              <v-col
              cols="6"
              >
                <v-btn
                @click="handleResgister"
                color="teal"
                outlined
                block
                >
                  Register
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
import { apiRegister } from '@/apis/user.js'
export default {
    data: () => ({
        showPassword: true,
        data: {
            email: '',
            password: '',
            name: ''
        }
    }),
    methods: {
        handleResgister() {
            apiRegister(this.data)
        }
    }
}
</script>
<template>
    <v-app-bar app>
        <template v-slot:prepend>
          <v-app-bar-nav-icon
          @click.stop="$store.dispatch('ui/MODIFY_DRAWER')"
          ></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>Title</v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn icon
        @click="logout"
        >
          <v-icon>mdi-power</v-icon>
        </v-btn>

        <v-btn icon>
          <v-icon>mdi-heart</v-icon>
        </v-btn>

        <v-btn icon>
          <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
    </v-app-bar>
</template>
<script>
import { apiLogout } from '@/apis/auth.js'
export default {
  methods: {
    logout(){
      apiLogout().then(() => this.$router.push({name: 'auth-login'}))
    }
  }
}
</script>
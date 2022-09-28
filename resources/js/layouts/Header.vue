<template>
    <div>Header</div>
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
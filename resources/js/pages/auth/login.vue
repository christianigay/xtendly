<template>
    <div>
      login page
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
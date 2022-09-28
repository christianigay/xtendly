<template>
    <div>
      register page
    </div>
</template>
<script>
import { apiRegister } from '@/apis/user.js'
export default {
    data: () => ({
        showPassword: false,
        data: {
          email: '',
          password: '',
          name: ''
        },
        confirmPassword: ''
    }),
    methods: {
      handleRegister() {
        if(! this.data.password) return;
        if(this.confirmPassword != this.data.password) return;
        if(! this.data.name) return;
        apiRegister(this.data)
      }
    }
}
</script>
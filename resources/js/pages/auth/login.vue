<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div class="q-ma-md text-center text-h4">Login</div>

        <FormInput v-model:modelValue="form.email" :label="`Email`"/>
        <FormPassword v-model:modelValue="form.password" :label="`Password`"/>
        <q-card-actions>
          <q-btn @click="$router.push({name: 'auth-register'})" color="grey" label="Register" />
          <q-btn @click="handleLogin" color="teal" label="Login" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { apiLogin } from '@/apis/auth.js'
export default {
    data: () => ({
        showPassword: false,
        form: {
          email: 'test@gmail.com',
          password: 'password',
        },
        dense: true
    }),
    methods: {
      handleLogin() {
        if(! this.form.password) return;
        if(! this.form.email) return;
        apiLogin(this.form)
        .then(({data}) => {
          if(data && data.user) {
            this.$router.push({name: 'dashboard'})
          }
        })
      }
    }
}
</script>
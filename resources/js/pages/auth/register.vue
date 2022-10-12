<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div class="q-ma-md text-center text-h4">Register</div>

        <FormInput v-model:modelValue="form.email" :label="`Email`"/>
        <FormPassword v-model:modelValue="form.password" :label="`Password`"/>
        <FormInput v-model:modelValue="form.name" :label="`Name`"/>
        <q-card-actions>
          <q-btn @click="$router.push({name: 'auth-login'})" color="grey" label="Login" />
          <q-btn @click="handleRegister" color="primary" label="Register" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { apiRegister } from '@/apis/user.js'
import { apiLogin } from '@/apis/auth.js'
export default {
    data: () => ({
        showPassword: false,
        form: {
          email: '',
          password: '',
          name: ''
        },
        confirmPassword: ''
    }),
    methods: {
      handleRegister() {
        if(! this.form.password) return;
        if(! this.form.name) return;
        apiRegister(this.form)
        .then(({data}) => {
          if(data){
            this.handleLogin()
          }
        })
      },
      handleLogin() {
        if(! this.form.password) return;
        if(! this.form.email) return;
        apiLogin(this.form)
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
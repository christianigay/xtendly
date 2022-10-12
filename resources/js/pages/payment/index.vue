<template>
    <FormInput v-model:modelValue="form.amount" :label="`Amount`"/>
    <q-btn @click="payNow">Pay Now</q-btn>
</template>
<script>
import { payApi } from '@/apis/payment.js'
export default {
    data: () => ({
        form: {
          amount: '',
        },
    }),
    methods: {
      payNow(){
        payApi(this.form)
        .then(({data}) => {
            console.log(data, 'data')
            window.location = data
        })
      }
    }
}
</script>
<template>
<div class="row justify-center">
  <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
    <div>Purchase product</div>
    <FormInput v-model:modelValue="form.name" :label="`Name`" :disable="true"/>
    <FormInput v-model:modelValue="form.description" :label="`Description`" :disable="true"/>
    <FormInput v-model:modelValue="form.quantity" :label="`Quantity`"/>
    <FormInput v-model:modelValue="form.price" :label="`Price`"/>
    <FormInput v-model:modelValue="form.amount" :label="`Amount`" :disable="true"/>
    <q-btn @click="payNow">Pay Now</q-btn>
  </q-card>
</div>
</template>
<script>
import { productGet } from '@/apis/product.js' 
import { payApi } from '@/apis/payment.js'
export default {
    data: () => ({
        form: {
          amount: '',
        },
    }),
    mounted(){
      this.getProduct()
    },
    watch: {
      form: {
        handler(val){
          this.form.amount = this.form.price * this.form.quantity
        },
        immediate: true,
        deep: true
      }
    },
    methods: {
      getProduct(){
        productGet(this.$route.params.id)
        .then(({data}) => {
          this.form = data
        })
      },
      payNow(){
        payApi(this.form)
        .then(({data}) => {
            window.location = data
        })
      }
    }
}
</script>
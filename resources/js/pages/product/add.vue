<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div>Add product</div>

        <FormInput v-model:modelValue="form.name" :label="`Name`"/>
        <FormInput v-model:modelValue="form.description" :label="`Description`"/>
        <FormInput v-model:modelValue="form.quantity" :label="`Quantity`"/>
        <FormInput v-model:modelValue="form.price" :label="`Price`"/>
        <q-card-actions>
          <q-btn @click="addProduct" color="primary" label="Add" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { productAdd } from '@/apis/product.js' 
export default {
    data: () => ({
        form: {
            name: '',
            description: '',
            quantity: 0,
            price: 0
        }
    }),
    methods: {
        addProduct(){
            if(! this.form.name) return;
            productAdd(this.form)
            .then(({data}) => {
                console.log(data, 'addproduct')
                this.$router.push({name: 'product-list'})
            })
        }
    }
}
</script>
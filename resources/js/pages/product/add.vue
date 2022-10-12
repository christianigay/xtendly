<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div class="text-h4">Add product</div>

        <FormInput v-model:modelValue="form.name" :label="`Name`"/>
        <FormInput v-model:modelValue="form.description" :label="`Description`"/>
        <FormInput v-model:modelValue="form.quantity" :label="`Quantity`" :type="`number`"/>
        <FormInput v-model:modelValue="form.price" :label="`Price`" :type="`number`"/>
        <q-card-actions>
          <q-btn @click="addProduct" color="teal" label="Add" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { productAdd } from '@/apis/product.js' 
import ToastHelper from '@/mixins/ToastHelper.vue'
export default {
    mixins: [ToastHelper],
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
            .then(() => {
                this.showToast("Product added successfully", "secondary");
                this.$router.push({name: 'product-list'})
            })
        }
    }
}
</script>
<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div class="text-h4">Edit product</div>

        <FormInput v-model:modelValue="form.name" :label="`Name`"/>
        <FormInput v-model:modelValue="form.description" :label="`Description`"/>
        <FormInput v-model:modelValue="form.quantity" :label="`Quantity`" :type="`number`"/>
        <FormInput v-model:modelValue="form.price" :label="`Price`" :type="`number`"/>
        <q-card-actions>
          <q-btn @click="editProduct" color="teal" label="Save" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { productEdit, productGet } from '@/apis/product.js' 
import ToastHelper from '@/mixins/ToastHelper.vue'

export default {
    mixins: [ToastHelper],
    data: () => ({
        form: {
            id: '',
            name: '',
            description: '',
            quantity: 0,
            price: 0
        }
    }),
    mounted(){
        this.getProduct()
    },
    methods: {
        getProduct(){
            productGet(this.$route.params.id)
            .then(({data}) => this.form = data)
        },
        editProduct(){
            if(! this.form.name) return;
            productEdit(this.form)
            .then(({data}) => {
                this.showToast("Product updated", "secondary");
                this.$router.push({name: 'product-list'})
            })
        }
    }
}
</script>
<template>
    <div class="row justify-center">
      <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
        <div>Edit product</div>

        <FormInput v-model:modelValue="form.name" :label="`Name`"/>
        <FormInput v-model:modelValue="form.description" :label="`Description`"/>
        <FormInput v-model:modelValue="form.quantity" :label="`Quantity`"/>
        <FormInput v-model:modelValue="form.price" :label="`Price`"/>
        <q-card-actions>
          <q-btn @click="editProduct" color="primary" label="Save" />
        </q-card-actions>
      </q-card>
    </div>
</template>
<script>
import { productEdit, productGet } from '@/apis/product.js' 
export default {
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
                console.log(data, 'addproduct')
                this.$router.push({name: 'product-list'})
            })
        }
    }
}
</script>
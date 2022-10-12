<template>
    <div class="text-h4 q-ma-md">Products</div>
  <div class="q-pa-md">
    <data-table
    :data="tableContent"
    :columns="columns"
    >
        <template v-slot:toolbar>
          <table-header
          :hide="[]"
          @search="searchTable"
          @addItem="addItem"
          ></table-header>
        </template>
        <template v-slot:total_price="{item}">
          {{getTotalPrice(item)}}
        </template>
        <template v-slot:action="{item}">
          <q-btn @click="addToCart(item)" class="q-mx-sm" size="sm" label="Add to Cart`" color="teal" outline></q-btn>
          <q-btn @click="editItem(item)" size="sm" label="Edit`" color="primary" outline></q-btn>
        </template>
        
    </data-table>
    
  </div>
</template>
<script>
import DataTable from '@/components/forms/Datatable.vue'
import TableHeader from '@/components/forms/TableHeader.vue'
import { productList } from '@/apis/product.js'
import { mapGetters } from 'vuex'
import ToastHelper from '@/mixins/ToastHelper.vue'
export default {
    mixins: [ToastHelper],
    components: {DataTable, TableHeader},
    data: () => ({
        columns: [
            {
                name: 'name',
                required: true,
                label: 'Name',
                align: 'left',
                field: row => row.name,
                format: val => `${val}`,
                sortable: true
            },
            {
                name: 'description',
                required: true,
                label: 'Description',
                align: 'left',
                field: row => row.description,
                format: val => `${val}`,
                sortable: true
            },
            {
                name: 'quantity',
                required: true,
                label: 'Quantity',
                field: row => row.quantity,
                format: val => `${val}`,
                sortable: true
            },
            {
                name: 'price',
                required: true,
                label: 'Unit Price',
                field: row => row.price,
                format: val => `${val}`,
                sortable: true
            },
            {
                name: "total_price",
                align: "center",
                label: "Total Price",
                field: ""
            },
            {
                name: "action",
                align: "center",
                label: "Action",
                field: ""
            }
        ],
        tableContent: []
    }),
    computed: {
        ...mapGetters({
            cartItems: 'cart/cartItems'
        })
    },
    mounted(){
        this.getProducts()
    },
    methods: {
        addToCart(item){
            this.showToast("Item added to cart", "secondary");
            this.$store.dispatch('cart/SAVE_CART_ITEM', item)
        },
        getTotalPrice(item){
            if(item && item.quantity){
                return item.quantity * item.price
            }
            return 0
        },
        getProducts(){
            productList()
            .then(({data}) => {
                console.log(data, 'products')
                this.tableContent = data
            })
        },
        searchTable(value){
            console.log(value, 'search value')
        },
        addItem(){
            this.$router.push({name: 'product-add'})
        },
        editItem(item){
            this.$router.push({name: 'product-edit', params: {id: item.id}})
        }
    }
}
</script>
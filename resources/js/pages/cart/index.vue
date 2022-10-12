<template>
    <h2>Cart Items</h2>
    <div class="q-pa-md">
        <data-table
        :data="cartItems"
        :columns="columns"
        >
            <template v-slot:action="{item}">
                <q-btn @click="addQuantity(item)" class="q-mx-sm" size="sm" label="Add`" color="grey" outline></q-btn>
                <q-btn @click="deductQuantity(item)" class="q-mx-sm" size="sm" label="Deduct`" color="grey" outline></q-btn>
                <q-btn @click="removeItem(item)" size="sm" label="Delete`" color="primary" outline></q-btn>
            </template>
            
        </data-table>
        
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import DataTable from '@/components/forms/Datatable.vue'

export default {
    components: { DataTable },
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
                name: "buy_quantity",
                align: "center",
                label: "Quantity",
                field: row => row.buy_quantity,
            },
            {
                name: "buy_price_total",
                align: "center",
                label: "Total",
                field: row => row.buy_price_total,
            },
            {
                name: "action",
                align: "center",
                label: "Action",
                field: ""
            }
        ],
    }),
    computed: {
        ...mapGetters({
            cartItems: 'cart/cartItems'
        })
    },
    methods: {
        removeItem(item){
            this.$store.dispatch('cart/REMOVE_PARAM', item)
        },
        addQuantity(item){
            this.$store.dispatch('cart/ADD_QUANTITY', item)
        },
        deductQuantity(item){
            this.$store.dispatch('cart/DEDUCT_QUANTITY', item)
        }
    }

}
</script>
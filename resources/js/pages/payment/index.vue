<template>
  <h2>Checkout</h2>
  <div class="q-pa-md">
      <data-table
      :data="cartItems"
      :columns="columns"
      >
          
      </data-table>
      
  </div>
  <div class="row justify-end">
    <q-card class="col-xs-12 col-md-4 q-ma-xl q-pa-lg">
      <div class="row q-gutter-lg">
          <div class="col text-weight-bolder">
              Grand Total
          </div>
          <div class="col">
              {{ grandTotal }}
          </div>
      </div>

      <q-card-actions class="q-mt-xl">
        <q-btn @click="payNow" color="primary" label="Place Order" />
      </q-card-actions>
    </q-card>
  </div>
</template>
<script>
import { payApi } from '@/apis/payment.js'
import { mapGetters } from 'vuex'
import DataTable from '@/components/forms/Datatable.vue'

export default {
  components: { DataTable },
    data: () => ({
        form: {
          amount: '',
          product_items: []
        },
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
          }
        ],
    }),
    computed: {
      ...mapGetters({
        cartItems: 'cart/cartItems'
      }),
      grandTotal(){
        let sum = this.cartItems.reduce((total, obj) => obj['buy_price_total'] + total,0)
        return sum + ' USD'
      }
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
      
      payNow(){
        this.form.amount = this.grandTotal
        this.form.product_items = this.cartItems
        payApi(this.form)
        .then(({data}) => {
            window.location = data
        })
      }
    }
}
</script>
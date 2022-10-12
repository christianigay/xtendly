<template>
    <q-card class="my-card bg-secondary text-white q-pa-md">
        <div class="text-h4 q-ma-md">Paypal payment successful</div>
    </q-card>
</template>

<script>
import { payApprove } from '@/apis/payment.js'
export default {
    data: () => ({
        token: ""
    }),
    mounted () {
        this.initialize();
    },
    methods: {
        async initialize() {
            this.token = this.$route.query.token ? this.$route.query.token : "";
            var intent = this.$route.query.payment_intent ? this.$route.query.payment_intent : "";
            var res;
            res = await payApprove({ token: this.token });
            if (res.status !== 200) return;
            this.$router.push({ name: "product-list" });
        }
    }
}
</script>
<template>
    <div class="text-h4 q-ma-md">Dashboard Page</div>
</template>
<script>
import { apiDetails } from '@/apis/user.js'
export default {
    data: () => ({
        user: {}
    }),
    mounted(){
        this.getUserDetails()
    },
    methods: {
        getUserDetails(){
            apiDetails().then(({data}) => this.user = data)
        }
    }
}
</script>
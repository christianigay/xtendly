<template>
    <h3>Dashboard Page</h3>
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
<template>
    <div>Dashboard</div>
    <q-icon name="font_download" />
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
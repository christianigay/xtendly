<template>
    <component :is="layout">
        
    </component>
</template>
<script>
export default {
    name: 'App',
    data(){
        return {
            layout: 'LayoutDefault'
        }
    },
    watch: {
        '$route.meta.layout': {
            handler(val){
                this.layout = val || 'LayoutDefault'
            },
            immediate: true,
            deep: true
        }
    }
}
</script>
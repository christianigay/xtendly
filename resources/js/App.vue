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
    methods: {
        // updateLayout(layout){
        //     this.layout = layout
        // }
    }
}
</script>
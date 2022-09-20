<template>
    <component :is="layout">
        <router-view></router-view>
    </component>
</template>
<script>
export default {
    name: 'App',
    data(){
        return {
            layout: 'div'
        }
    }
}
</script>
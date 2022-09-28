<template>
    <div>sidebar</div>   
</template>
  
<script>
import { menus } from '@/data/menus.js'
export default {
    data: () => ({
        items: menus,
    }),
    computed: {
		drawer: {
			get() {
				return this.$store.state.ui.drawer;
			},
			set(state) {
				if (state !== this.$store.state.ui.drawer) {
                    this.$store.commit('ui/updateDrawer')
                }
			}
		}
	}
}
</script>
  
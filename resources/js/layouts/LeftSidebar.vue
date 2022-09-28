<template>
    <q-drawer  v-model="drawer" side="left" bordered>
      <q-list bordered class="rounded-borders">
        <template v-for="(item, index) of items" :key="index">
          <q-expansion-item
            v-if="item.children"
            expand-separator
            :icon="item.icon"
            :label="item.title"
          >
            <q-list v-for="(child, cindex) of item.children" :key="cindex">
              <q-item
                clickable
                v-ripple
                active-class="my-menu-link"
              >
                <q-item-section avatar>
                  <q-icon :name="child.icon" />
                </q-item-section>

                <q-item-section>{{child.title}}</q-item-section>
              </q-item>
            </q-list>
          </q-expansion-item>

          <q-item
            v-else
            clickable
            v-ripple
            active-class="my-menu-link"
          >
            <q-item-section avatar>
              <q-icon :name="item.icon" />
            </q-item-section>

            <q-item-section>{{item.title}}</q-item-section>
          </q-item>
        </template>
      </q-list>
    </q-drawer>
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
  
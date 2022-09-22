<template>
    <v-navigation-drawer
		fixed
		app
	>
        <v-list density="compact">
            <template v-for="(item, i) in items"
            :key="i"
            >
                <v-list-group 
                v-if="item.children"
                :prepend-icon="item.icon"
                >
                    <template v-slot:activator="{ props }">
                        <v-list-item
                        v-bind="props"
                        :title="item.title"
                        ></v-list-item>
                    </template>
                    <v-list-item
                        v-for="(child, key) in item.children"
                        :key="key"
                        :title="child.title"
                        :prepend-icon="child.icon"
                        :value="child.title"
                        active-color="teal"
                    ></v-list-item>
                </v-list-group>
                <v-list-item
                    v-else
                    :value="item"
                    active-color="teal"
                >
                    <template v-slot:prepend>
                        <v-icon :icon="item.icon"></v-icon>
                    </template>
                    <v-list-item-title v-text="item.title"></v-list-item-title>
                    <template v-slot:activator="{ props }">
                        <v-list-item
                        v-bind="props"
                        :title="item.title"
                        ></v-list-item>
                    </template>
                </v-list-item>
            </template>
        </v-list>
    </v-navigation-drawer>    
</template>
  
  <script>
  import { menus } from '@/data/menus.js'
  export default {
    data: () => ({
      items: menus,
    }),
  }
  </script>
  
<template>
    <div class="q-mb-sm">
        <q-card>
            <q-toolbar class="text-primary">
                <q-toolbar-title>
                   <slot name="title"></slot>
                </q-toolbar-title>
                <!-- <q-input 
                    v-model="filter" placeholder="Search"
                    borderless dense debounce="300" 
                >
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input> -->
                <q-btn 
                v-if="!hide.includes('create')"
                @click="$emit('addItem')" outline
                color="primary" class="q-mx-sm" size="sm" label="Add"
                >
                </q-btn>
            </q-toolbar>
        </q-card>
    </div>
</template>
<script>
export default {
    props: {
        hide: {
            type: Array,
            default: []
        },
    },
    data: () =>  ({
        filter: ''
    }),
    watch: {
        filter(){
            this.$emit('search', this.filter)
        }
    }
}
</script>
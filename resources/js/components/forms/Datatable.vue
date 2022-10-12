<template>
    <div>
        <slot name="toolbar"></slot>
        <q-table
        v-if="data"
        :columns="columns"
        :rows="data"
        row-key="action"
        class="my-sticky-header-column-table"
        :pagination="initialPagination"
        >     
            <template v-for="(column, index) of columns" v-slot:[`body-cell-${column.name}`]="props">
                <q-td :props="props">
                    <slot :name="column.name" :item="props.row">
                        {{props.row[column.name]}}
                    </slot>
                </q-td>
            </template>
        </q-table>
    </div>
</template>
<script>

export default {
    props: {
        data: {
            type: Array,
            default: []
        },
        columns: {
            type: Array,
            default: []
        },
        filter: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        initialPagination: {
            sortBy: 'desc',
            descending: false,
            page: 1,
            rowsPerPage: 25
            // rowsNumber: xx if getting data from a server
        },
    })
}
</script>
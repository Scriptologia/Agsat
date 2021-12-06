<template>
    <div class="overflow-auto">
        <p class="mt-3">Текущая страница: {{ currentPage }}</p>

        <b-table
                id="table"
                :items="items"
                :per-page="perPage"
                :current-page="currentPage"
                :fields="fields"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                responsive="sm"
                small
                striped hover
        >
            <template #cell(edit)="data">
                <router-link :to="{ path: '/'}"><b-icon-pencil></b-icon-pencil></router-link>
           </template>
            <template #cell(delete)="data">
                <router-link :to="{ path: '/'}"><b-icon-trash></b-icon-trash></router-link>
                <!--{ name: 'category', params: { userId: data.item.id }}-->
           </template>
        </b-table>
        <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                aria-controls="table"
        ></b-pagination>
    </div>
</template>

<script>
    export default {
        props: {
            perPage: 3,
            currentPage: 1,
            sortBy: 'id',
            sortDesc: false,
            fields: [],
            items: []
        },
        data() {
            return {
            }
        },
        computed: {
            rows() {
                return this.items.length
            },
        }
    }
</script>
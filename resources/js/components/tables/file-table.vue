<template>
    <v-card class="pa-5">
        <v-card-text>
            <v-data-table
                :headers="headers"
            >
                <template #[`item.actions`] = "{item}">
                    <v-icon color="secondary">mdi-view</v-icon>
                    <v-icon color="warning">mdi-pencil</v-icon>
                    <v-icon color="error">mdi-trash</v-icon>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
    
</template>

<script>
export default {
    setup() {
        const headers = ref([
            {
                title: 'Filename',
                key: 'filename'
            },
            {
                title: 'Office From',
                key: 'office_from'
            },
            {
                title: 'Route From',
                key: 'route_from'
            },
            {
                title: 'Date Received',
                key: 'date_received'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ])


        return {
            //variables
            headers,

        }
    },
}
</script>
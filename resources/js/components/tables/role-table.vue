<template>
    <v-card>
        <v-card-text>
            <v-data-table
                :headers="headers"
            >
                
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>

export default {
    setup() {
        const headers = [
            {
                title: 'Name',
                key: 'name',
            },
            {
                title: 'Created At',
                key: 'created_at',
            },
            {
                title: 'Actions',
                key: 'actions',
            }
        ]

        return{
            //variables
            headers,

        }
    },
}
</script>
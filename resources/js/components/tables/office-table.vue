<template>
    <v-card>
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="offices"
                item-title="name"
                item-value="id"
            >
                <template
                    v-slot:[`item.actions`]=" {item} "
                >
                    <v-icon color="warning">mdi-pencil</v-icon>
                    <v-icon color="error">mdi-trash</v-icon>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>

export default {
    props: {
        offices: {
            type: Array,
            default: () => []
        }
    },
    setup() {
        const headers = [
            {
                title: 'Office Name',
                key: 'name'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ]



        return {

            //variable
            headers,
        }
        
    },
}
</script>
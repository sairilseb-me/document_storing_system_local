<template>
    <v-row>
        <v-col cols="12">
            <v-card>
                <v-card-text>
                    <v-data-table
                        :headers="headers"
                    >

                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import { ref } from 'vue'
export default {
    setup() {
        const headers = ref([
            {
                title: 'Fullname',
                key: 'fullname'
            },
            {
                title: 'Username',
                key: 'username'
            },
            {
                title: 'Email',
                key: 'email'
            },
            {
                title: 'Role',
                key: 'role'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ])


        return {
            //variables
            headers
        }
    },
}
</script>
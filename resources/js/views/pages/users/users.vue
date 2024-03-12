<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-text class="d-flex justify-space-between">
                        <h3>Users</h3>
                        <v-btn color="primary">Add</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <user-table></user-table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { ref } from 'vue'
import UserTable from '@/components/tables/user-table.vue'
export default {
    components: {
        UserTable
    },
    setup() {
        
    },
}
</script>
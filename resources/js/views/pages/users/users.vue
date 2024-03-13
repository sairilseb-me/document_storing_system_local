<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-text class="d-flex justify-space-between">
                        <h3>Users</h3>
                        <v-btn color="primary" @click="openUserDialog">Add</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <user-table :items="users"></user-table>
            </v-col>
        </v-row>
        <user-dialog :visible="showUserDialog" @close="closeUserDialog"></user-dialog>
    </v-container>
</template>

<script>
import { ref } from 'vue'
import UserTable from '@/components/tables/user-table.vue'
import UserDialog from '@/components/dialogs/user-dialog.vue'
import axios from '@axios'
export default {
    components: {
        UserTable,
        UserDialog,
    },
    setup() {
        const users = ref([])
        const showUserDialog = ref(false)

        const openUserDialog = () => {
            showUserDialog.value = true
        }

        const closeUserDialog = () => {
            showUserDialog.value = false
            getUsers()
        }

        const getUsers = () => {
            axios.get('/user')
            .then(({data}) => {
                users.value = data.users
            })
        }

        getUsers()

        return {
            //variables
            users,
            showUserDialog,


            //methods
            openUserDialog,
            closeUserDialog,
        }   
        
    },
}
</script>
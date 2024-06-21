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
                <v-card>
                    <div class="mt-3 d-flex justify-end">
                        <v-col cols="4">
                            <v-text-field
                                v-model="search"
                                prepend-inner-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                                @update:model-value="searchUsers"
                            ></v-text-field>
                        </v-col>
                    </div>
                   
                    <div class="mt-3">
                        <user-table :items="users" @edit="handleEdit" @delete="handleDelete"></user-table>
                    </div>
                </v-card>
                
            </v-col>
        </v-row>
        <user-dialog :visible="showUserDialog" :user="user" @close="closeUserDialog"></user-dialog>
        <delete-dialog :visible="showDeleteDialog" :details="deleteOptions" @close="closeDeleteDialog"></delete-dialog>
    </v-container>
</template>

<script>
import { ref } from 'vue'
import UserTable from '@/components/tables/user-table.vue'
import UserDialog from '@/components/dialogs/user-dialog.vue'
import DeleteDialog from '@/components/dialogs/delete-dialog.vue'
import axios from '@axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
export default {
    components: {
        UserTable,
        UserDialog,
        DeleteDialog,
    },
    setup() {
        const users = ref([])
        const user = ref({})
        const showUserDialog = ref(false)
        const showDeleteDialog = ref(false)
        const deleteOptions = ref({})
        const search = ref('')
        const globalSnackbar = useGlobalSnackbarStore()

        const openUserDialog = () => {
            showUserDialog.value = true
        }

        const closeUserDialog = () => {
            showUserDialog.value = false
            getUsers()
        }

        const closeDeleteDialog = () => {
            showDeleteDialog.value = false
            deleteOptions.value = {}
            getUsers()
        }

        const getUsers = () => {
            axios.get('/user')
            .then(({data}) => {
                users.value = data.users
            }).catch(error => {
                globalSnackbar.setValues({
                    message: 'Having some problem getting users. Please try again later.',
                    color: 'error',
                    show: true,
                })
            })
        }

        const handleEdit = (value) => {
            user.value = value  
            openUserDialog()
            getUsers()
        }

        const handleDelete = (value) => {
            showDeleteDialog.value = true
            deleteOptions.value = {
                url: `/user/${value}`,
                title: 'Delete User',
                message: 'Are you sure you want to delete this user?'
            }
        }

        const searchUsers = () => {
            if (search.value === '') {
                getUsers()
            } else {
                axios.get(`/user/search/${search.value}`)
                .then((response) => {
                    users.value = response.data.users
                }).catch(error => {
                    globalSnackbar.setValues({
                        message: 'Having some problem searching users. Please try again later.',
                        color: 'error',
                        show: true,
                    })
                
                })
            }
        }

        getUsers()

        return {
            //variables
            users,
            showUserDialog,
            user,
            showDeleteDialog,
            deleteOptions,
            search,


            //methods
            openUserDialog,
            closeUserDialog,
            handleEdit,
            handleDelete,
            closeDeleteDialog,
            searchUsers,
        }   
        
    },
}
</script>
<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" class="d-flex justify-space-between">
                                <h3 class="text-h5">Roles</h3>
                                <v-btn color="primary" @click="showRoleDialog">Add Role</v-btn>
                            </v-col>
                        </v-row>
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
                                @update:model-value="searchRoles"
                            >
                            </v-text-field>
                        </v-col>
                    </div>
                </v-card>
                <role-table :items="roles" :loading="tableLoading" @edit="editRole" @delete="deleteRole"></role-table>
            </v-col>
        </v-row>
        <role-dialog :visible="visible" @close="closeRoleDialog" :role="selectedRole"></role-dialog>
        <delete-dialog :visible="deleteDialogVisible" :details="deleteDetails" @close="closeDeleteDialog"></delete-dialog>
    </v-container>
</template>

<script>
import RoleTable from '@/components/tables/role-table.vue'
import RoleDialog from '@/components/dialogs/role-dialog.vue'
import DeleteDialog from '@/components/dialogs/delete-dialog.vue'
import { ref } from 'vue'
import axios from '@axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
export default {
    components: {
        RoleTable,
        RoleDialog,
        DeleteDialog,
    },
    setup() {
        
        const visible = ref(false)
        const deleteDialogVisible = ref(false)
        const roles = ref([])
        const selectedRole = ref({})
        const deleteDetails = ref({})
        const search = ref('')  
        const globalSnackbar = useGlobalSnackbarStore()
        const tableLoading = ref(false)

        const showRoleDialog = () => {
            visible.value = true
        }
        const closeRoleDialog = () => {
            visible.value = false
            selectedRole.value = {}
            getRoles()
        } 

        const getRoles = () => {
            tableLoading.value = true
            axios.get('/role')
            .then(({data}) => {
                roles.value = data.roles
            })
            .catch(error => {
                globalSnackbar.setValues({
                    message: 'Having some problem getting the roles. Please try again later.',
                    color: 'error',
                    show: true,
                })
            }).finally(() => {
                tableLoading.value = false
            }) 
        }

        const editRole = (item) => {
            selectedRole.value = item
            visible.value = true
        }

        const deleteRole = (item) => {
            deleteDetails.value = {
                url: `/role/${item.id}`,
                message: 'Are you sure you want to delete this role?',
            }
            deleteDialogVisible.value = true
        }

        const closeDeleteDialog = () => {
            deleteDialogVisible.value = false
            getRoles()
        }

        const searchRoles = () => {
            if (search.value === '') {
                getRoles()
            } else {
                tableLoading.value = true
                axios.get(`/role/search/${search.value}`)
                .then(({data}) => {
                    roles.value = data.roles
                })
                .catch(error => {
                    globalSnackbar.setValues({
                    message: 'Having some problem searching the roles. Please try again later.',
                    color: 'error',
                    show: true,
                }).finally(() => {
                    tableLoading.value = false
                })
                })
            }
        }

        getRoles()

        return {

            //variable
            visible,
            roles,
            selectedRole,
            deleteDialogVisible,
            deleteDetails,
            search,
            tableLoading,

            //methods
            showRoleDialog,
            closeRoleDialog,
            editRole,
            deleteRole,
            closeDeleteDialog,
            searchRoles,
        }
    },
}
</script>
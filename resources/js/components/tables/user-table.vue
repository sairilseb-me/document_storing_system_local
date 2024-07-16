<template>
    <v-row>
        <v-col cols="12">
            <v-card>
                <v-card-text>
                    <v-data-table
                        :headers="headers"
                        :items="items"
                    >
                        <template #[`item.role_id`]="{ item }">
                            {{ getRoleName(item.selectable.role_id) }}
                        </template>

                        <template #[`item.actions`]="{item}">
                            <v-spacer></v-spacer>
                            <v-icon color="warning" @click="editUser(item.selectable)">mdi-pencil</v-icon>
                            <v-icon color="error" @click="deleteUser(item.selectable.id)">mdi-delete</v-icon>
                        </template>
                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import { computed, ref } from 'vue'
import axios from '@axios'
export default {
    props: {
        items: {
            type: Array,
            default: () => []
        }
    },
    setup(_, {emit}) {
        const headers = ref([
            {
                title: 'Fullname',
                key: 'name'
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
                key: 'role_id'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ])

        const roles = ref([])

        const getRoleName =(id) => {
            const role = roles.value.find(r => r.id == id)
            return role ? role.name : ''
        }

        const getRoles = () => {
            axios.get('/role')
            .then(({data}) => {
                roles.value = data.roles
            })
            .catch(error => {
                console.log(error)
            })
        }

        const editUser = (user) => {
            emit('edit', user)
        }

        const deleteUser = (user_id) => {
            emit('delete', user_id)
        }
        getRoles()


        return {
            //variables
            headers,

            //computed
            getRoleName,
            editUser,
            deleteUser,
        }   
    },
}
</script>
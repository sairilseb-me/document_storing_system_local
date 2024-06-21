<template>
    <v-dialog
        v-model="visible"
        width="500"
    >
        <v-row>
            <v-col cols="12">
                <v-form @submit.prevent="resolveAction">
                    <v-card class="pa-5">
                        <v-card-title class="mb-3">Users</v-card-title>
                        <v-card-text>
                            <v-text-field class="mb-3" label="Enter Fullname" v-model="name"></v-text-field>
                            <v-text-field class="mb-3" label="Enter Username" v-model="username"></v-text-field>
                            <v-text-field class="mb-3" label="Enter Email" v-model="email"></v-text-field>
                            <v-text-field v-if="showPasswordElement" class="mb-3" :type=" showPassword ? 'text' : 'password'" label="Enter Password" :append-inner-icon="showPassword ? 'mdi-eye-circle-outline' : 'mdi-eye-closed'" @click:append-inner="showPassword = !showPassword" v-model="userPassword"></v-text-field>
                            <role-autocomplete :role_id="role_id" @select="selectedRole"></role-autocomplete>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="secondary" @click="closeDialog">Cancel</v-btn>
                            <v-btn color="primary" type="submit">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                    
                </v-form>
            </v-col>
        </v-row>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue'
import RoleAutocomplete from '@/components/autocompletes/role-autocomplete.vue'
import axios from '@axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
export default {
    components: {
        RoleAutocomplete
    },
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        user: {
            type: Object,
            default: () => ({})
        }
    },
    setup(props, {emit}) {
        const visible = ref(false)
        const name = ref('')
        const username = ref('')
        const email = ref('')
        const userPassword = ref('')
        const role_id = ref('')
        const showPassword = ref(false)
        const showPasswordElement = ref(true)
        const globalSnackbar = useGlobalSnackbarStore()

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        watch(
            () => props.user,
            (value) => {
                if (value && value.id) {
                    name.value = value.name
                    username.value = value.username
                    email.value = value.email
                    showPasswordElement.value = false
                    role_id.value = value.role_id
                }
            },
        )

        const addNewUser =  () => {            
            axios.post('/user', {
                name: name.value,
                username: username.value,
                email: email.value,
                password: userPassword.value,
                role_id: role_id.value
            })
                .then(response => {
                    if(response.status == 200){
                        globalSnackbar.setValues({
                            show: true,
                            message: 'User saved successfully',
                            color: 'success'
                        })
                        closeDialog()
                    }else {
                        globalSnackbar.setValues({
                            show: true,
                            message: 'An error occurred while saving user',
                            color: 'error'
                        })
                    }
                    
                })
                .catch(error => {
                    globalSnackbar.setValues({
                            show: true,
                            message: 'An error occurred while saving user',
                            color: 'error'
                        })
                })
        }

        const editUser = () => {
            axios.put(`/user/${props.user.id}`, {
                name: name.value,
                username: username.value,
                email: email.value,
                role_id: role_id.value
            })
                .then(response => {
                    if (response.status == 200) {
                        globalSnackbar.setValues({
                            show: true,
                            message: 'User successfully updated.',
                            color: 'success'
                        })
                        closeDialog()
                    } else {
                        globalSnackbar.setValues({
                            show: true,
                            message: 'An error occurred while updating user',
                            color: 'error'
                        })
                    }
                })
                .catch(error => {
                    globalSnackbar.setValues({
                        show: true,
                        message: 'An error occurred while updating user',
                        color: 'error'
                    })
                })
        }

        const resolveAction = computed(() => {
            if (props.user.id) {
                return editUser
            }

            return addNewUser
        })

        const selectedRole = (value) => {
            console.log(value)
            role_id.value = value
        }

        const closeDialog = () => {
            emit('close')
            showPasswordElement.value = true
        }

        return {
            //variables
            visible,
            name,
            username,
            email,
            userPassword,
            role_id,
            showPassword,
            showPasswordElement,

            // computed
            resolveAction,

            //methods
            closeDialog,
            selectedRole,
            
        }
    },
}
</script>
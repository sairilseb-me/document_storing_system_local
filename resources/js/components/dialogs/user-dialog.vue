<template>
    <v-dialog
        v-model="visible"
        width="500"
    >
        <v-row>
            <v-col cols="12">
                <v-form>
                    <v-card class="pa-5">
                        <v-card-title class="mb-3">Users</v-card-title>
                        <v-card-text>
                            <v-text-field class="mb-3" label="Enter Fullname"></v-text-field>
                            <v-text-field class="mb-3" label="Enter Username"></v-text-field>
                            <v-text-field class="mb-3" label="Enter Email"></v-text-field>
                            <v-text-field class="mb-3" :type=" showPassword ? 'text' : 'password'" label="Enter Password" :append-inner-icon="showPassword ? 'mdi-eye-circle-outline' : 'mdi-eye-closed'" @click:append-inner="showPassword = !showPassword"></v-text-field>
                            <role-autocomplete></role-autocomplete>
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
export default {
    components: {
        RoleAutocomplete
    },
    props: {
        visible: {
            type: Boolean,
            default: false
        }
    },
    setup(props, {emit}) {
        const visible = ref(false)
        const fullname = ref('')
        const username = ref('')
        const email = ref('')
        const userPassword = ref('')
        const role = ref('')
        const showPassword = ref(false)

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        const closeDialog = () => {
            emit('close')
        }

        return {
            //variables
            visible,
            fullname,
            username,
            email,
            userPassword,
            role,
            showPassword,

            //methods
            closeDialog
        }
    },
}
</script>
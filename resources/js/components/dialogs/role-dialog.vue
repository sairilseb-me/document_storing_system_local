<template>
    <v-dialog
        v-model="visible"
        max-width="600"
    >
        <v-card class="pa-5">
            <v-form>
                <v-card-title>Roles</v-card-title>
                <v-card-text>
                    <v-text-field v-model="roleName"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Cancel</v-btn>
                    <v-btn color="primary" type="button">Save</v-btn>
                </v-card-actions>
            </v-form>
            
        </v-card>
    </v-dialog>
</template>

<script>
import {ref, watch} from 'vue'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false
        }
    },
    setup(prop, {emit}) {

        const visible = ref(false)
        const roleName = ref('')

        const closeDialog = () => {
            emit('close', false)
            resetInput()

        }

        watch(
            () => prop.visible,
            (value) => {
                visible.value = value
            }
        )

        //methods

        const resetInput = () => {
            roleName.value = null
        }

        return {
            //variable
            visible,
            roleName,

            //methods
            closeDialog,
        }
    },
}
</script>
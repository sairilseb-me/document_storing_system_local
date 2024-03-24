<template>
    <v-dialog
        v-model="visible"
        max-width="500"
    >
        <v-card class="pa-5">
            <v-card-title>Offices</v-card-title>
            <v-card-text>
                <v-text-field label="Enter Office Name"></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" @click="closeDialog">Close</v-btn>
                <v-btn color="primary">Add Office</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { watch } from 'vue'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
    },
    setup(props, { emit }) {
        const visible = ref(false)


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
            visible,
            

            //methods
            closeDialog,
        }
    },
}
</script>
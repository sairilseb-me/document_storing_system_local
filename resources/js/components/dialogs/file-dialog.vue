<template>
    <v-dialog
        v-model="visible"
        max-width="800px"
    >
        <v-card class="pa-5">
            <v-form>
                <v-card-title>
                    Add Files
                </v-card-title>
                <v-card-text>
                    <v-text-field label="Enter Filename" class="mb-3"></v-text-field>
                    <v-file-input label="Upload File" :prepend-icon="null" prepend-inner-icon="mdi-paperclip"></v-file-input>
                    <v-textarea label="Remarks" class="mb-3"></v-textarea>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary">Close</v-btn>
                    <v-btn color="primary">Add File</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import { watch } from 'vue'

export default {
    components: {
       
    },
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

        return {
            visible,
        }
    },
}
</script>
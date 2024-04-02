<template>
    <v-dialog
        v-model="visible"
        max-width="800px"
    >
        <v-card class="pa-5">
            <v-form @submit.prevent="addFile">
                <v-card-title>
                    Add Files
                </v-card-title>
                <v-card-text>
                    <v-text-field label="Enter Filename" class="mb-3" v-model="filename"></v-text-field>
                    <v-file-input label="Upload File" :prepend-icon="null" prepend-inner-icon="mdi-paperclip" class="mb-3" v-model="file"></v-file-input>
                    <office-autocomplete class="mb-3" @select="office_id = $event"></office-autocomplete>
                    <v-textarea label="Remarks" class="mb-3" v-model="remarks"></v-textarea>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Close</v-btn>
                    <v-btn color="primary" type="submit">Add File</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue'
import OfficeAutocomplete from '@/components/autocompletes/office-autocomplete.vue'
export default {
    components: {
       OfficeAutocomplete,
    },
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
    },
    setup(props, { emit }) {

        const visible = ref(false)

        const filename = ref(null)
        const file = ref(null)
        const office_id = ref(null)
        const remarks = ref(null)
        const date_received = ref(null)

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        const addFile = () => {
            axios.post('/file')
        }


        const closeDialog = () => {
            emit('close')
        }

        return {
            //variable
            visible,
            filename,
            file,
            office_id,
            remarks,

            //methods
            closeDialog,
            addFile,
        }
    },
}
</script>
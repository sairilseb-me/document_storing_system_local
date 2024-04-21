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
                    <v-text-field type="date" class="mb-3" label="Select Date" v-model="selectedDate"></v-text-field>
                    <v-text-field type="time" label="Enter Time" class="mb-3" v-model="selectedTime"></v-text-field>
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
import '@vuepic/vue-datepicker/dist/main.css';
import axios from '@axios';
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
        const selectedDate = ref(Date.now())
        const selectedTime = ref(null)
       
        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        const handleFileChange = (e) => {
            file.value = e.target.files[0]
            console.log(file.value)
        }

        const addFile = () => {
            let newDate = null
            let formData = new FormData()
            if (selectedDate.value) {
                if (selectedTime.value)
                {
                    newDate = new Date(`${selectedDate.value}T${selectedTime.value}`)
                }else {
                    const tempDate = new Date()
                    const newTime = `${tempDate.getHours()}:${tempDate.getMinutes()}:${tempDate.getSeconds()}`
                    newDate = new Date((`${selectedDate.value}T${newTime}`))
                }
            } else {
                newDate = new Date()
            }

            let formattedDate = newDate.toLocaleString('en-US', {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            })

            formData.append('title', filename.value)
            formData.append('file', file.value[0])
            formData.append('office_id', office_id.value)
            formData.append('remarks', remarks.value)
            formData.append('date_received', formattedDate)

            axios.post('/file', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then(response => {
                if (response.status == 200){
                    resetValues()
                    closeDialog()
                }
            })
                
        }

        const closeDialog = () => {
            emit('close')
        }

        const resetValues = () => {
            filename.value = null
            file.value = null
            office_id.value = null
            remarks.value = null
            selectedDate.value = Date.now()
            selectedTime.value = null
        }


        return {
            //variable
            visible,
            filename,
            file,
            office_id,
            remarks,
            selectedDate,
            selectedTime,

            //methods
            closeDialog,
            addFile,
            handleFileChange,
        }
    },
}
</script>
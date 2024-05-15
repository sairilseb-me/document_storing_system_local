<template>
    <v-autocomplete
        v-model="office_id"
        :items="offices"
        item-title="name"
        item-value="id"
        label="Select Office"
        @update:model-value="selectedOffice"    
    >
    </v-autocomplete>
</template>


<script>
import { ref, watch } from 'vue'
import axios from '@axios'
export default {
    props: {
        modelValue: {
            type: Number,
            default: null
        }
    },
    setup(props, {emit}) {

        const offices = ref([])
        const office_id = ref(props.modelValue)

        watch(
            () => props.modelValue,
            (value) => {
                office_id.value = value
            }
        )

        const getOffices = () => {
            axios.get('/office')
            .then(({data}) => {
                offices.value = data.offices
            })
        }

        const selectedOffice = (value) => {
            emit('update:modelValue', value)
        }

        getOffices()
        return {

            //variables
            offices,
            office_id,

            //methods
            selectedOffice,
        }
        
    },
}
</script>


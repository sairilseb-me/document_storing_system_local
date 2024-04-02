<template>
    <v-autocomplete
        :items="offices"
        item-title="name"
        item-value="id"
        label="Select Office"
        @update:model-value="selectedOffice"
    >
    </v-autocomplete>
</template>


<script>
import { ref } from 'vue'
import axios from '@axios'
export default {

    setup(_, {emit}) {

        const offices = ref([])
        const office_id = ref(null)

        const getOffices = () => {
            axios.get('/office')
            .then(({data}) => {
                offices.value = data.offices
            })
        }

        const selectedOffice = (value) => {
            emit('select', value)
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


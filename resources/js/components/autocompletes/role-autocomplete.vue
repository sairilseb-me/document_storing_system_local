<template>
    <v-autocomplete
        :items="roles"
        item-title="name"
        item-value="id"
        label="Select Role"
    >
        
    </v-autocomplete>
</template>

<script>
import { ref } from 'vue'
import axios from '@axios'
export default {
    setup() {


        const roles = ref([])

        const getRoles = () => {
            axios.get('/role')
            .then(({data}) => {
                console.log(data.roles)
                roles.value = data.roles
            })
            .catch(error => {
                console.log(error)
            })
        }

        getRoles()
        return {
            //variables
            roles
        }
    },
}
</script>
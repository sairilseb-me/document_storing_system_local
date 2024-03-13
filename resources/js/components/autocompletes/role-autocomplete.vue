<template>
    <v-autocomplete
        :items="roles"
        item-title="name"
        item-value="id"
        label="Select Role"
        @update:model-value="selectedRole"
    >

    </v-autocomplete>
</template>

<script>
import { ref } from 'vue'
import axios from '@axios'
export default {
    setup(_, {emit}) {


        const roles = ref([])

        const getRoles = () => {
            axios.get('/role')
            .then(({data}) => {
                roles.value = data.roles
            })
            .catch(error => {
                console.log(error)
            })
        }

        const selectedRole = (value) => {
            emit('select', value)
        }

        getRoles()
        return {
            //variables
            roles,

            //methods
            selectedRole,
        }
    },
}
</script>
<template>
    <v-autocomplete
        v-model="role_id"
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
    props: {
        role_id: {
            type: [Number, String],
            default: 1
        }
    },
    setup(props, {emit}) {

        const role_id = ref(null)
        const roles = ref([])

        watch(
            () => props.role_id,
            (value) => {
                if (value){
                    role_id.value = value
                }
            }, {immediate: true}
        )

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
            role_id,

            //methods
            selectedRole,
        }
    },
}
</script>
<template>
    <v-card>
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="offices"
                item-title="name"
                item-value="id"
            >
                <!-- <template v-slot:[`item.name`] = "{item}">
                    {{ item.selectable.id }}
                </template> -->
                <template #[`item.office`] = "{item}">
                    {{ item.selectable.office.toUpperCase() }}
                </template>
                <template
                    v-slot:[`item.actions`]=" {item} "
                >
                    <v-icon color="warning" @click="editOffice(item.selectable.id)">mdi-pencil</v-icon>
                    <v-icon color="error" @click="deleteOffice(item.selectable.id)">mdi-trash</v-icon>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
import axios from '@axios'

export default {
    props: {
        offices: {
            type: Array,
            default: () => []
        }
    },
    setup(_, {emit}) {
        const headers = [
            {
                title: 'Office Name',
                key: 'name'
            },
            {
                title: 'Category',
                key: 'office'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ]

        const office = ref(null)

        const editOffice = (id) => {
            axios.get(`/office/${id}`)
            .then(({data}) => {
                office.value = data.office
                emit('edit', office.value)
            })

        }

        const deleteOffice = (id) => {
            emit('delete', id)
        }

        return {

            //variable
            headers,

            //methods
            editOffice,
            deleteOffice,
        }
        
    },
}
</script>
<template>
    <v-card>
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="items"
                :loading="loading"
            >
                <template #[`item.created_at`]="{ item }">
                    {{ formattedDate(item.columns.created_at) }}
                </template>
                <template #[`item.actions`]="{ item }">
                    <v-icon @click="editRole(item.selectable)" color="warning">mdi-pencil</v-icon>
                    <v-icon @click="deleteRole(item.selectable)" color="error">mdi-delete</v-icon>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { formatDate } from '@/@core/utils/formatters';
export default {
    props: {
        items: {
            type: Array,
            default: () => []
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    setup(_, {emit}) {
        const headers = [
            {
                title: 'Name',
                key: 'name',
            },
            {
                title: 'Created At',
                key: 'created_at',
            },
            {
                title: 'Actions',
                key: 'actions',
            }
        ]


        const formattedDate = (date) => {
            return formatDate(date)
        }

        const editRole = (item) => {
            emit('edit', item)
        }

        const deleteRole = (item) => {
            emit('delete', item)
        }

        return{
            //variables
            headers,

            //computed

            // methods
            formattedDate,
            editRole,
            deleteRole,
        }
    },
}
</script>
<template>
    <p class="text-center" v-if="neighborhoods.length < 1">There are no neighborhoods to show.</p>
    <table v-else>
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Last Updated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="neighborhood in neighborhoods">
                <td class="py-2 px-3">
                    {{ neighborhood.name }}
                </td>
                <td class="py-2 px-3">{{ neighborhood.status }}</td>
                <td class="py-2 px-3">{{ neighborhood.created_at }}</td>
                <td>
                    <router-link :to="{name: 'editNeighborhood', params: { id: neighborhood.id, port: ':8890' }}" class="underline text-blue-400">Edit</router-link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                neighborhoods: []
            }
        },
        mounted(){
            axios.get('/api/neighborhoods').then(response => {
               this.neighborhoods = response.data.data
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
</script>
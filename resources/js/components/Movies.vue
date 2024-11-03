<script setup>
import Navbar from "./Navbar.vue";
</script>

<template>
    <Navbar />
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="display-6">Filmes para alugar</h2>
                </div>
            </div>
            <div class="row">
                <table class="table table-primary table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Sinopse</th>
                            <th scope="col">Nota</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <tr v-for="movie in result" :key="movie.id">
                            <td>{{ movie.id }}</td>
                            <td>{{ movie.name }}</td>
                            <td>{{ movie.synopsis }}</td>
                            <td>{{ movie.rating }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Movies',
    data() {
        return {
            result: {},
            movie: {
                id: '',
                name: '',
                synopsis: '',
                rating: ''
            }
        }
    },
    created() {
        this.getMovies();
    },
    mounted() {
        console.log('mounted.....');
    },
    methods: {
        async getMovies() {
            try {
                const movies = 'http://localhost:8090/api/v1/movies';
                console.log(movies);
                axios.get(movies).then(({data}) => {
                    console.log('Getting movies...');
                    this.result = data;
                })

                // const response = await fetch(movies);
                // const data = await response.json();
                // this.result = data;
                // this.movies = data.results[0];
            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
}
</script>

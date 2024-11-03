<script setup>
import Navbar from "./Navbar.vue";
import { CAlert } from '@coreui/vue';
import { ref } from 'vue'
</script>

<template>
    <Navbar />
    <div class="container-fluid">
        <div class="container">
            <CAlert :color=alertColor :visible="alertShow" dismissible @close="() => { alertShow = false }">{{ alertText }}</CAlert>

            <div class="row">
                <div class="col">
                    <h2 class="display-6">Devolução de filme</h2>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="p-3 bg-light">
                                <h4 class="card-title">Informe o ID da confirmação de aluguel do filme</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="bookingMovie">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="movieId" v-model="movieRental.scheduleId" placeholder="Id da reserva do filme">
                                </div>
                                <button type="submit" class="m-2 btn btn-primary">Devolver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import {ref} from "vue";

export const alertShow = ref(false)
export const alertText = ref('')
export const alertColor = ref('primary')
export default {
    name: 'Booking',
    data() {
        return {
            result: {},
            movieRental: {
                scheduleId: ''
            }
        }
    },
    methods: {
        async bookingMovie() {

            if (this.movieRental.scheduleId === '') {
                alertText.value = 'Por favor preencha o campo Id de confirmação do aluguel';
                alertColor.value = 'danger';
                alertShow.value = true;
                return;
            }

            this.sendData()
        },
        sendData() {
            try {
                const movies = 'http://localhost:8090/api/v1/rental/return';
                axios.post(movies, this.movieRental).then(({data}) => {
                    console.log('Sending return request...');
                    this.result = data;
                    console.log('Returned movie:');
                    console.log(this.result);

                    if (this.result.message !== undefined) {
                        alertText.value = this.result.message;
                        alertColor.value = 'warning';
                        alertShow.value = true;
                        return;
                    }

                    this.movieRental.scheduleId = '';

                    alertText.value = `Devolução realizada com sucesso!`;
                    alertColor.value = 'primary';
                    alertShow.value = true;
                }).catch((error) => {
                    console.error('Error sending booking request:');
                    console.error(error);
                    alertText.value = error.response.data.error;
                    alertColor.value = 'danger';
                    alertShow.value = true;
                })

            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
}
</script>

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
                    <h2 class="display-6">Confirmar alguel de filme</h2>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="p-3 bg-light">
                                <h4 class="card-title">Preencha os campos abaixo para confirmar o aluguel do filme </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="sendMovieRental">
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="movieId" v-model="movieRental.reserveId" placeholder="Id da reserva">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="name" v-model="movieRental.customer.name" placeholder="Nome completo">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="email" class="form-control" id="email" v-model="movieRental.customer.email" placeholder="E-mail">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="phone" v-mask="['(##) ####-####', '(##) #####-####']" v-model="movieRental.customer.phone" placeholder="Telefone">
                                </div>
                                <button type="submit" class="m-2 btn btn-primary">Confirmar</button>
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
import {mask} from 'vue-the-mask'

export const alertShow = ref(false)
export const alertText = ref('')
export const alertColor = ref('primary')
export default {
    name: 'MovieRental',
    directives: {mask},
    data() {
        return {
            result: {},
            movieRental: {
                reserveId: '',
                customer: {
                    name: '',
                    email: '',
                    phone: ''
                }
            }
        }
    },
    methods: {
        async sendMovieRental() {
            if (this.movieRental.reserveId === '') {
                alertText.value = 'Por favor preencha o campo código da reserva';
                alertColor.value = 'danger';
                alertShow.value = true;
                return;
            }
            if (this.movieRental.customer.name === '') {
                alertText.value = 'Por favor preencha o campo nome completo';
                alertColor.value = 'danger';
                alertShow.value = true;
                return;
            }
            if (this.movieRental.customer.email === '') {
                alertText.value = 'Por favor preencha o campo e-mail';
                alertColor.value = 'danger';
                alertShow.value = true;
                return;
            }
            if (this.movieRental.customer.phone === '') {
                alertText.value = 'Por favor preencha o campo telefone';
                alertColor.value = 'danger';
                alertShow.value = true;
                return;
            }

            this.sendData()
        },
        sendData() {
            try {
                const movies = 'http://localhost:8090/api/v1/rental/confirmation';
                axios.post(movies, this.movieRental).then(({data}) => {
                    console.log('Sending movie rental request...');
                    this.result = data;

                    if (this.result.message !== undefined) {
                        alertText.value = this.result.message;
                        alertColor.value = 'warning';
                        alertShow.value = true;
                        return;
                    }

                    this.movieRental.reserveId = ''
                    this.movieRental.customer.name = '';
                    this.movieRental.customer.email = '';
                    this.movieRental.customer.phone = '';

                    alertText.value = `Seu aluguel foi confirmado com sucesso, seu código de aluguel é o ${data.scheduleId}`;
                    alertColor.value = 'primary';
                    alertShow.value = true;
                }).catch((error) => {
                    console.error('Error sending booking request:');
                    console.error(error);
                    alertText.value = error.response.data.error ? error.response.data.error : error.response.data.message;
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

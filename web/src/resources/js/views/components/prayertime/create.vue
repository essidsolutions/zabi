<template>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">
                    <strong v-if="selectedUrl">Update Prayer Time</strong>
                    <strong v-else>Add Prayer Time</strong>
                </h1>
                <a :href="urlGenerator('prayer-time/list')" class="btn bg-primary text-white float-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-arrow-left align-middle me-2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <app-loader v-if="pageLoader"/>
                    <form v-else>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Date<span class="text-danger">*</span></label>
                                            <input type="date" name="date"
                                                   class="form-control"
                                                   v-model="formData.date">
                                            <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Sunrise<span class="text-danger">*</span></label>
                                            <input type="time" name="sunrise"
                                                   class="form-control"
                                                   v-model="formData.sunrise">

                                            <small class="text-danger" v-if="errors.sunrise">{{
                                                    errors.sunrise[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Sunset<span class="text-danger">*</span></label>
                                            <input type="time"
                                                   name="sunset"
                                                   class="form-control"
                                                   v-model="formData.sunset">

                                            <small class="text-danger" v-if="errors.sunset">{{
                                                    errors.sunset[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Fajr Azan<span
                                                class="text-danger">*</span></label>
                                            <input type="time"
                                                   name="fajr_azan"
                                                   class="form-control"
                                                   v-model="formData.fajr_azan">

                                            <small class="text-danger" v-if="errors.fajr_azan">{{
                                                    errors.fajr_azan[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Fajr Jamat<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="fajr_jamat"
                                                   class="form-control"
                                                   v-model="formData.fajr_jamat">

                                            <small class="text-danger" v-if="errors.fajr_jamat">{{
                                                    errors.fajr_jamat[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Zuhur Azan<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="zuhr_azan" class="form-control"
                                                   v-model="formData.zuhr_azan">

                                            <small class="text-danger" v-if="errors.zuhr_azan">{{
                                                    errors.zuhr_azan[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Zuhur Jamat<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="zuhr_jamat" class="form-control"
                                                   v-model="formData.zuhr_jamat">

                                            <small class="text-danger" v-if="errors.zuhr_jamat">{{
                                                    errors.zuhr_jamat[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Asr Azan<span class="text-danger">*</span></label>
                                            <input type="time" name="asr_azan" class="form-control"
                                                   v-model="formData.asr_azan">

                                            <small class="text-danger" v-if="errors.asr_azan">{{
                                                    errors.asr_azan[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Asr Jamat<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="asr_jamat" class="form-control"
                                                   v-model="formData.asr_jamat">

                                            <small class="text-danger" v-if="errors.asr_jamat">{{
                                                    errors.asr_jamat[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Maghrib Azan<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="maghrib_azan" class="form-control"
                                                   v-model="formData.maghrib_azan">

                                            <small class="text-danger" v-if="errors.maghrib_azan">{{
                                                    errors.maghrib_azan[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Maghrib Jamat<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="maghrib_jamat" class="form-control"
                                                   v-model="formData.maghrib_jamat">

                                            <small class="text-danger" v-if="errors.maghrib_jamat">{{
                                                    errors.maghrib_jamat[0]
                                                }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Isha Azan<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="isha_azan" class="form-control"
                                                   v-model="formData.isha_azan">

                                            <small class="text-danger" v-if="errors.isha_azan">{{
                                                    errors.isha_azan[0]
                                                }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Isha Jamat<span
                                                class="text-danger">*</span></label>
                                            <input type="time" name="isha_jamat" class="form-control"
                                                   v-model="formData.isha_jamat">

                                            <small class="text-danger" v-if="errors.isha_jamat">{{
                                                    errors.isha_jamat[0]
                                                }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Sehri End Time</label>
                                            <input type="time" name="sehri_end" class="form-control"
                                                   v-model="formData.sehri_end">
                                            <small class="text-danger" v-if="errors.sehri_end">{{
                                                    errors.sehri_end[0]
                                                }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Iftar Start Time</label>
                                            <input type="time" name="iftar_start" class="form-control"
                                                   v-model="formData.iftar_start">

                                            <small class="text-danger" v-if="errors.iftar_start">{{
                                                    errors.iftar_start[0]
                                                }}</small>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 col-sm-12 text-center d-grid gap-2">
                                        <button type="submit" class="btn btn-primary" @click.prevent="submit">
                                            <app-button-loader v-if="preloader"/>
                                            Submit
                                        </button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import {onMounted, ref} from "vue";
import Axios from "@/services/axios/index.js";
import {toast} from "vue3-toastify";
import {urlGenerator} from "@/utilities/urlGenerator.js";

const props = defineProps({
    selectedUrl: {
        type: String
    }
})
const preloader = ref(false);
const formData = ref({});
const errors = ref({});

const submit = () => {
    preloader.value = true;
    errors.value = {};
    if (props.selectedUrl) {
        Axios.patch(props.selectedUrl, formData.value).then((data) => {
            toast.success(data.data.message);
        }).catch(({response}) => {
            if (response.status === 422) {
                errors.value = response.data.errors
            } else {
                toast.error(response.data.message);
            }
        }).finally(() => preloader.value = false);
    } else {
        Axios.post('prayer-times', formData.value).then((data) => {
            toast.success(data.data.message);
            formData.value = {};
        }).catch(({response}) => {
            if (response.status === 422) {
                errors.value = response.data.errors
            } else {
                toast.error(response.data.message);
            }
        }).finally(() => preloader.value = false);
    }
}

const pageLoader = ref(false)
const getEditData = () => {
    pageLoader.value = true;
    Axios.get(props.selectedUrl).then((data) => {
        formData.value = data.data
    }).finally(() => pageLoader.value = false);
}
onMounted(() => {
    if (props.selectedUrl) {
        getEditData();
    }
})
</script>

<template>
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"><strong>Prayer Times</strong></h1>
                <a :href="urlGenerator('prayer-time/create')" v-if="$canAccess('create_prayer_times')" class="btn bg-primary text-white float-end">
                    Add Prayer Time
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item" v-for="(month, index) in Object.keys(dataSetList)">
                        <a :class="`nav-link ${moment().format('MMMM') === month ? 'active' : ''}`"
                           :id="`${month}-tab`" data-bs-toggle="pill" :href="`#${month}-content`">
                            {{ month }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10">
                <div class="tab-content mt-2">
                    <template v-for="(monthData, index) in Object.keys(dataSetList)">
                        <div :class="`tab-pane fade ${moment().format('MMMM') === monthData ? 'active show' : ''}`"
                             :id="`${monthData}-content`">
                            <h3 class="mb-3">{{ monthData }} Prayer Time</h3>

                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table mb-3">
                                        <thead>
                                        <tr>
                                            <th style="width: 10%">Date</th>
                                            <th>Sunrise</th>
                                            <th>Sunset</th>
                                            <th>Fajr Azan</th>
                                            <th>Fajr Jamat</th>
                                            <th>Zuhr Azan</th>
                                            <th>Zuhr Jamat</th>
                                            <th>Asr Azan</th>
                                            <th>Asr Jamat</th>
                                            <th>Maghrib Azan</th>
                                            <th>Maghrib Jamat</th>
                                            <th>Isha Azan</th>
                                            <th>Isha Jamat</th>
                                            <th>Sehri End</th>
                                            <th>Iftar Start</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <template v-for="prayerTime in dataSetList[monthData]">
                                            <tr :class="`${moment(prayerTime.date).format('YYYY-MM-DD')  === moment().format('YYYY-MM-DD') ? 'table-info' : ''}`">

                                                <td>{{ moment(prayerTime.date).format('MMMM-DD') }}</td>
                                                <td>{{ prayerTime.sunrise }}</td>
                                                <td>{{ prayerTime.sunset }}</td>
                                                <td>{{ prayerTime.fajr_azan }}</td>
                                                <td>{{ prayerTime.fajr_jamat }}</td>
                                                <td>{{ prayerTime.zuhr_azan }}</td>
                                                <td>{{ prayerTime.zuhr_jamat }}</td>
                                                <td>{{ prayerTime.asr_azan }}</td>
                                                <td>{{ prayerTime.asr_jamat }}</td>
                                                <td>{{ prayerTime.maghrib_azan }}</td>
                                                <td>{{ prayerTime.maghrib_jamat }}</td>
                                                <td>{{ prayerTime.isha_azan }}</td>
                                                <td>{{ prayerTime.isha_jamat }}</td>
                                                <td>{{ prayerTime.sehri_end }}</td>
                                                <td>{{ prayerTime.iftar_start }}</td>
                                                <td>
                                                    <a :href="urlGenerator('prayer-time/' + prayerTime.id + '/edit')"
                                                       class="text-decoration-none" v-if="$canAccess('update_prayer_times')">
                                                        <img class="action_icon"
                                                             :src="urlGenerator('assets/img/icons/edit.svg')" alt="Icon"/>
                                                    </a>
                                                    <a href="javascript:void(0)" @click="deletePrayerTime(prayerTime)"
                                                       class="text-decoration-none"
                                                       v-if="$canAccess('update_prayer_times')">
                                                        <img class="action_icon"
                                                             :src="urlGenerator('assets/img/icons/trash.svg')"
                                                             alt="Icon"/>
                                                    </a>
                                                </td>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <app-delete-modal v-if="isDeleteModal"
                          :selected-url="deleteUrl"
                          @cancelled="cancelled"/>
    </main>
</template>

<script setup>

import {onMounted, ref} from "vue";
import Axios from "@/services/axios/index.js";
import useEmitter from "@/composable/useEmitter.js";
import moment from 'moment'
import {urlGenerator} from "@/utilities/urlGenerator.js";
import {useDeleteModal} from "@/composable/useDeleteModal.js";

const {isDeleteModal, deleteUrl, cancelled} = useDeleteModal()


const dataSetList = ref({})
const preloader = ref(false)
const getServerData = () => {
    preloader.value = true
    Axios.get(`prayer-times`).then((data) => {
        dataSetList.value = data.data
    }).finally(() => preloader.value = false)
}
const deletePrayerTime = (row) => {
    isDeleteModal.value = true
    deleteUrl.value = `prayer-times/${row.id}`
}

const emitter = useEmitter();
const reloadDataTable = () => {
    emitter.on("reload-table", (value = true) => {
        if (value) {
            getServerData();
        }
    });
};

onMounted(() => {
    getServerData();
    reloadDataTable()

})
</script>


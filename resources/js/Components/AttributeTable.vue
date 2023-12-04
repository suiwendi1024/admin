<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import CheckCircle from "@/Components/Icons/CheckCircle.vue";
import XCircle from "@/Components/Icons/XCircle.vue";

const props = defineProps({
    title: String,
    items: Object,
})

/**
 * 每页显示条数
 */
const perPage = ref(localStorage.getItem('perPage') || 15)

const setPerPage = () => {
    localStorage.setItem('perPage', perPage.value)

    reloadTable({ perPage: perPage.value })
}

/**
 * 搜索框
 */
const search = ref(new URLSearchParams(location.search).get('search') || '')

const setSearch = () => {
    reloadTable({ search: search.value })
}

/**
 * 表格首列
 */
const checkboxes = ref([])

const setCheckboxes = (checked) => {
    for (let i = 0; i < perPage.value; i++) {
        checkboxes.value[i] = checked
    }
}

/**
 * 表格内容
 */
const laravelData = ref(props.items);

const getResults = (page = 1) => {
    reloadTable({ page })
}

/**
 * 重载表格
 */
const reloadTable = (data) => {
    router.visit(location.pathname, {
        data,
    })
}
</script>

<template>
    <div class="card bg-base-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="card-body space-y-4">
            <h2 class="card-title">{{ title }}</h2>

            <div class="card-actions justify-between">
                <!-- 每页显示条数 -->
                <form>
                    <select class="select select-bordered select-sm text-xs" v-model="perPage" @change="setPerPage">
                        <option v-for="n in [15, 25, 50, 100]">{{ n }}</option>
                    </select>
                    entries per page
                </form>

                <!-- 搜索框 -->
                <form @submit.prevent="setSearch">
                    <input type="search" v-model="search" placeholder="Search ..." class="input input-bordered w-full max-w-xs input-sm" />
                </form>
            </div>

            <!-- 表格 -->
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>
                            <label>
                                <input type="checkbox" class="checkbox" @change="setCheckboxes($event.target.checked)" />
                            </label>
                        </th>
                        <th v-for="(value, name) in laravelData.data[0]">{{ name }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- body -->
                    <tbody>
                    <tr v-for="(item, index) in laravelData.data" class="hover">
                        <th>
                            <label>
                                <input type="checkbox" class="checkbox" v-model="checkboxes[index]" />
                            </label>
                        </th>
                        <slot v-for="(value, name) in item" :item="item" :col="name" :value="value">
                            <td v-if="typeof value == 'boolean'">
                                <CheckCircle v-if="value" class="text-success"></CheckCircle>
                                <XCircle v-else class="text-error"></XCircle>
                            </td>
                            <td v-else>{{ value }}</td>
                        </slot>
                        <th>
                            <button class="btn btn-ghost btn-xs">details</button>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <TailwindPagination :data="laravelData" @pagination-change-page="getResults" class="mt-4" />
</template>

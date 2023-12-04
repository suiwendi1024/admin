<script setup>
import AuthenticatedLayoutDark from '@/Layouts/AuthenticatedLayoutDark.vue';
import AttributeTable from '@/Components/AttributeTable.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    posts: Object,
})

const title = 'Posts'
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayoutDark>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <AttributeTable :items="posts" :title="title"></AttributeTable>
            </div>
        </div>
    </AuthenticatedLayoutDark>
</template>

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import CafeteriaForm from "@/Components/CafeteriaForm.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({});
</script>

<template>
    <Head title="Cafeteria adminisztráció" />

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center p-10 bg-gray-100 dark:bg-gray-900"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="w-50 h-24 fill-current text-gray-500" />
            </Link>
        </div>
        <h1 class="my-6 text-slate-50 text-2xl font-semibold">
            Cafeteria adminisztráció
        </h1>
        <div
            class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <CafeteriaForm></CafeteriaForm>
        </div>
    </div>
</template>

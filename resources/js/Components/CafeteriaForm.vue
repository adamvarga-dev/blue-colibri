<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MonthsInput from "@/Components/MonthsInput.vue";
import { useForm } from "@inertiajs/vue3";
import { useCafeteriaStore } from "@/stores/cafeteria";
import { onMounted } from "vue";
import axios from "axios";

const cafeteriaStore = useCafeteriaStore();
const form = useForm({
    first: Array(12).fill(0),
    second: Array(12).fill(0),
    third: Array(12).fill(0),
    first_sub: 0,
    second_sub: 0,
    third_sub: 0,
    total: 0,
});

const submit = () => {
    form.post(route("cafeteria.store"));
};

const updateFormData = () => {
    form.first = cafeteriaStore.firstColumn;
    form.second = cafeteriaStore.secondColumn;
    form.third = cafeteriaStore.thirdColumn;
    form.first_sub = cafeteriaStore.firstSubTotal;
    form.second_sub = cafeteriaStore.secondSubTotal;
    form.third_sub = cafeteriaStore.thirdSubTotal;
    form.total = cafeteriaStore.total;
};

const convertToCSV = () => {
    cafeteriaStore.exportToCSV();
};

onMounted(async () => {
    try {
        const response = await axios.get("/getCafeteria");
        const data = response.data;

        if (data) {
            cafeteriaStore.setFirstColumnValues(JSON.parse(data.first));
            cafeteriaStore.setSecondColumnValues(JSON.parse(data.second));
            cafeteriaStore.setThirdColumnValues(JSON.parse(data.third));
            cafeteriaStore.setFirstSubTotal(JSON.parse(data.first_sub));
            cafeteriaStore.setSecondSubTotal(JSON.parse(data.second_sub));
            cafeteriaStore.setThirdSubTotal(JSON.parse(data.third_sub));
            cafeteriaStore.total = data.total;
        }
    } catch (error) {
        console.log(error);
    }
});
</script>

<template>
    <div>
        <div
            v-if="$page.props.flash.message"
            class="p-4 my-4 text-center text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.message }}
            </span>
        </div>
        <div
            v-if="$page.props.flash.error"
            v-for="error of $page.props.flash.error"
            class="p-4 my-4 text-center text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert"
        >
            <span class="font-medium">
                {{ error[0] }}
            </span>
        </div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h3 class="text-white text-center my-4">Szálláshely</h3>
                    <MonthsInput
                        :column="1"
                        :model="cafeteriaStore.firstColumn"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <div class="text-white my-8 w-full text-center">
                        {{ cafeteriaStore.firstSubTotal }} Ft
                    </div>
                </div>
                <div>
                    <h3 class="text-white text-center my-4">Vendéglátás</h3>
                    <MonthsInput
                        :column="2"
                        :model="cafeteriaStore.secondColumn"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <div class="text-white my-8 w-full text-center">
                        {{ cafeteriaStore.secondSubTotal }} Ft
                    </div>
                </div>
                <div>
                    <h3 class="text-white text-center my-4">Szabadidő</h3>
                    <MonthsInput
                        :column="3"
                        :model="cafeteriaStore.thirdColumn"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <div class="text-white my-8 w-full text-center">
                        {{ cafeteriaStore.thirdSubTotal }} Ft
                    </div>
                </div>
                <div class="grid grid-cols-2 text-white text-xl font-bold mb-5">
                    <h3 class="">Összesen:</h3>
                    <span>{{ cafeteriaStore.total }} Ft</span>
                </div>
            </div>
            <div class="flex items-center justify-center my-4">
                <PrimaryButton
                    class="w-40 py-3 items-center justify-center text-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Mentés
                </PrimaryButton>
            </div>
        </form>
        <div class="grid place-items-end">
            <PrimaryButton
                class="w-30 py-3 justify-center text-center dark:bg-green-300 dark:text-green"
                @click="convertToCSV"
            >
                Export
            </PrimaryButton>
        </div>
    </div>
</template>

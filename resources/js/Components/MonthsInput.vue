<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { useCafeteriaStore } from "@/stores/cafeteria";
import { ref } from "vue";

const props = defineProps({
    column: Number,
});
const cafeteriaStore = useCafeteriaStore();
const emit = defineEmits(["updateFormData"]);
const months = [
    {
        name: "Január",
        value: 0,
    },
    {
        name: "Február",
        value: 0,
    },
    {
        name: "Március",
        value: 0,
    },
    {
        name: "Április",
        value: 0,
    },
    {
        name: "Május",
        value: 0,
    },
    {
        name: "Június",
        value: 0,
    },
    {
        name: "Július",
        value: 0,
    },
    {
        name: "Augusztus",
        value: 0,
    },
    {
        name: "Szeptember",
        value: 0,
    },
    {
        name: "Október",
        value: 0,
    },
    {
        name: "November",
        value: 0,
    },
    {
        name: "December",
        value: 0,
    },
];

let subTotal = ref(0);

const handleInput = () => {
    subTotal.value = months.reduce((sum, month) => sum + month.value, 0);

    if (props.column == 1) {
        cafeteriaStore.setFirstColumnValues(months);
        cafeteriaStore.setFirstSubTotal(subTotal.value);
    } else if (props.column == 2) {
        cafeteriaStore.setSecondColumnValues(months);
        cafeteriaStore.setSecondSubTotal(subTotal.value);
    } else {
        cafeteriaStore.setThirdColumnValues(months);
        cafeteriaStore.setThirdSubTotal(subTotal.value);
    }

    cafeteriaStore.setTotal();
    emit("updateFormData");
};
</script>

<template>
    <div>
        <div v-for="month in months" class="mb-3">
            <InputLabel :value="month.name" />
            <input
                type="number"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                v-model="month.value"
                @input="handleInput"
            />
        </div>
        <div class="text-white my-8 w-full text-center">{{ subTotal }} Ft</div>
    </div>
</template>

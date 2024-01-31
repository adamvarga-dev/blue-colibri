<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { useCafeteriaStore } from "@/stores/cafeteria";
import { ref } from "vue";

const props = defineProps({
    column: Number,
    model: Object,
});
const cafeteriaStore = useCafeteriaStore();
const emit = defineEmits(["updateFormData"]);
const months = [
    {
        name: "Január",
    },
    {
        name: "Február",
    },
    {
        name: "Március",
    },
    {
        name: "Április",
    },
    {
        name: "Május",
    },
    {
        name: "Június",
    },
    {
        name: "Július",
    },
    {
        name: "Augusztus",
    },
    {
        name: "Szeptember",
    },
    {
        name: "Október",
    },
    {
        name: "November",
    },
    {
        name: "December",
    },
];

let subTotal = ref(0);

const handleInput = () => {
    if (props.column == 1) {
        subTotal.value = cafeteriaStore.firstColumn.reduce(
            (sum, month) => sum + month,
            0
        );
        cafeteriaStore.setFirstColumnValues(cafeteriaStore.firstColumn);
        cafeteriaStore.setFirstSubTotal(subTotal.value);
    } else if (props.column == 2) {
        subTotal.value = cafeteriaStore.secondColumn.reduce(
            (sum, month) => sum + month,
            0
        );
        cafeteriaStore.setSecondColumnValues(cafeteriaStore.secondColumn);
        cafeteriaStore.setSecondSubTotal(subTotal.value);
    } else {
        subTotal.value = cafeteriaStore.thirdColumn.reduce(
            (sum, month) => sum + month,
            0
        );
        cafeteriaStore.setThirdColumnValues(cafeteriaStore.thirdColumn);
        cafeteriaStore.setThirdSubTotal(subTotal.value);
    }

    cafeteriaStore.setTotal();
    emit("updateFormData");
};
</script>

<template>
    <div>
        <div v-for="(month, index) in months" class="mb-3">
            <InputLabel :value="month.name" />
            <input
                type="number"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                v-model="model[index]"
                @input="handleInput"
            />
        </div>
    </div>
</template>

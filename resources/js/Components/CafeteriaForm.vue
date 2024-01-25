<script setup>
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MonthsInput from "@/Components/MonthsInput.vue";
import { useForm } from "@inertiajs/vue3";
import { useCafeteriaStore } from "@/stores/cafeteria";

const cafeteriaStore = useCafeteriaStore();
const form = useForm({
    firstColumn: Array(12).fill(0),
    secondColumn: Array(12).fill(0),
    thirdColumn: Array(12).fill(0),
    total: 0,
});

const submit = () => {
    form.post(route("cafeteria.store"), {
        // onSuccess: () => form.reset(),
    });
};

const updateFormData = () => {
    form.firstColumn = cafeteriaStore.firstColumn;
    form.secondColumn = cafeteriaStore.secondColumn;
    form.thirdColumn = cafeteriaStore.thirdColumn;
    form.total = cafeteriaStore.total;
};
</script>

<template>
    <div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h3 class="text-white text-center my-4">Szálláshely</h3>
                    <MonthsInput
                        :column="1"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <InputError class="mt-2" :message="form.errors.first" />
                </div>
                <div>
                    <h3 class="text-white text-center my-4">Vendéglátás</h3>
                    <MonthsInput
                        :column="2"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <InputError class="mt-2" :message="form.errors.second" />
                </div>
                <div>
                    <h3 class="text-white text-center my-4">Szabadidő</h3>
                    <MonthsInput
                        :column="3"
                        @updateFormData="updateFormData"
                    ></MonthsInput>
                    <InputError class="mt-2" :message="form.errors.third" />
                </div>
                <div class="grid grid-cols-2 text-white text-xl font-bold mb-5">
                    <h3 class="">Összesen:</h3>
                    <span>{{ cafeteriaStore.total }} Ft</span>
                </div>
            </div>
            <div
                v-if="$page.props.flash.message"
                class="p-4 my-4 text-center text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert"
            >
                <span class="font-medium">
                    {{ $page.props.flash.message }}
                </span>
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
    </div>
</template>

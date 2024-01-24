<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("cafeteria.store"), {
        // onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Név" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Küld
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { client } = defineProps({
    client: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    contact_name: client.contact_name,
    contact_email: client.contact_email,
    contact_phone_number: client.contact_phone_number,
    company_name: client.company_name,
    company_address: client.company_address,
    company_city: client.company_city,
    company_zip: client.company_zip,
    company_vat: client.company_vat,
});

const createClient = () => {
    form.put(`/client/${client.id}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Update Client" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Update client
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <section class="max-w-xl">
                        <header>
                            <h2
                                class="text-lg font-medium text-gray-900 dark:text-gray-100"
                            >
                                Update client
                            </h2>

                            <p
                                class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                            >
                                Update client {{ client.company_name }}
                            </p>
                        </header>
                        <form
                            @submit.prevent="createClient"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel
                                    for="contact_name"
                                    value="Contact name"
                                />

                                <TextInput
                                    id="contact_name"
                                    v-model="form.contact_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.contact_name"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="contact_email"
                                    value="Contact email"
                                />

                                <TextInput
                                    id="contact_email"
                                    v-model="form.contact_email"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.contact_email"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="contact_phone_number"
                                    value="Contact phone number"
                                />

                                <TextInput
                                    id="contact_phone_number"
                                    v-model="form.contact_phone_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.contact_phone_number"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="company_name"
                                    value="Company name"
                                />

                                <TextInput
                                    id="company_name"
                                    v-model="form.company_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.company_name"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="company_address"
                                    value="Company address"
                                />

                                <TextInput
                                    id="company_address"
                                    v-model="form.company_address"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.company_address"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="company_city"
                                    value="Company city"
                                />

                                <TextInput
                                    id="company_city"
                                    v-model="form.company_city"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.company_city"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="company_zip"
                                    value="Company zip"
                                />

                                <TextInput
                                    id="company_zip"
                                    v-model="form.company_zip"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.company_zip"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="company_vat"
                                    value="Company vat"
                                />

                                <TextInput
                                    id="company_vat"
                                    v-model="form.company_vat"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.company_vat"
                                    class="mt-2"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing"
                                    >Update</PrimaryButton
                                >

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600 dark:text-green-400"
                                    >
                                        Client updated!
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

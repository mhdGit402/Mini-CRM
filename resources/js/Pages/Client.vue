<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const { clients } = defineProps({
    clients: {
        type: [Array, Object],
        required: true,
    },
});

const computedClients = computed(() => {
    // If clients is not an array, wrap it in an array
    return Array.isArray(clients) ? clients : [clients];
});

const form = useForm({});
const deleteClient = (id) => {
    form.delete(`/client/${id}`);
};
</script>

<template>
    <Head title="Client" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Client
            </h2>
        </template>

        <div
            class="relative overflow-x-auto sm:rounded-lg max-w-7xl mx-auto py-12"
        >
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <caption
                    class="py-2 text-start text-sm dark:text-white font-medium"
                >
                    <div class="flex justify-between items-center">
                        <Link :href="route('client.create')">
                            <button
                                type="button"
                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400"
                            >
                                Add client
                            </button>
                        </Link>
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
                                Client deleted!
                            </p>
                        </Transition>
                    </div>
                </caption>

                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Contact name</th>
                        <th scope="col" class="px-6 py-3">
                            Contact phone number
                        </th>
                        <th scope="col" class="px-6 py-3">Company name</th>
                        <th scope="col" class="px-6 py-3">Company city</th>
                        <th scope="col" class="px-10 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="client in computedClients"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="text-wrap px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ client.contact_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ client.contact_phone_number }}
                        </td>
                        <td class="px-6 py-4">{{ client.company_name }}</td>
                        <td class="px-6 py-4">{{ client.company_city }}</td>

                        <td class="px-6 py-4">
                            <Link
                                :href="route('client.edit', client)"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                >Edit</Link
                            >
                            |
                            <button
                                @click="deleteClient(client.id)"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

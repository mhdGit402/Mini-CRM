<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const { project } = defineProps({
    project: {
        type: Object,
        require: true,
    },
});

const form = useForm({
    title: project.title,
    description: project.description,
    user_id: project.user_id,
    client_id: project.client_id,
    deadline_at: project.deadline_at,
    status: project.status,
});

const updateProject = () => {
    let date = new Date(form.deadline_at);
    form.deadline_at = date.toISOString().split("T")[0];
    form.post("/project", {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Update Project" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Update project
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
                                Update project
                            </h2>

                            <p
                                class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                            >
                                Update project {{ form.title }}
                            </p>
                        </header>
                        <form
                            @submit.prevent="updateProject"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="title" value="Title" />

                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.title"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="description"
                                    value="Description"
                                />

                                <TextInput
                                    id="description"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                />

                                <InputError
                                    :message="form.errors.description"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="client"
                                    value="Select client"
                                />

                                <select
                                    id="client"
                                    class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                                    v-model="form.client_id"
                                >
                                    <option :value="project.client.id">
                                        {{ project.client.company_name }}
                                    </option>
                                </select>

                                <InputError
                                    :message="form.errors.status"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="deadline_at"
                                    value="Deadline"
                                />

                                <VueDatePicker
                                    :dark="true"
                                    class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                                    v-model="form.deadline_at"
                                ></VueDatePicker>

                                <InputError
                                    :message="form.errors.deadline_at"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="status"
                                    value="Select status"
                                />

                                <select
                                    id="status"
                                    class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                                    v-model="form.status"
                                >
                                    <option value="open">Open</option>
                                    <option value="in progress">
                                        In progress
                                    </option>
                                    <option value="blocked">Blocked</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>

                                <InputError
                                    :message="form.errors.status"
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
                                        Project updated!
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

<style scoped>
.dp__theme_dark {
    --dp-background-color: transparent;
    --dp-text-color: #fff;
    /* --dp-hover-color: #484848;
    --dp-hover-text-color: #fff;
    --dp-hover-icon-color: #959595; */
    --dp-primary-color: #005cb2;
    --dp-primary-disabled-color: #61a8ea;
    --dp-primary-text-color: #fff;
    --dp-secondary-color: #a9a9a9;
    --dp-border-color: transparent;
    --dp-menu-border-color: transparent;
    /* --dp-border-color-hover: #aaaeb7; */
    --dp-border-color-focus: #aaaeb7;
    --dp-disabled-color: #737373;
    --dp-disabled-color-text: #d0d0d0;
    --dp-scroll-bar-background: #212121;
    --dp-scroll-bar-color: #484848;
    --dp-success-color: #00701a;
    --dp-success-color-disabled: #428f59;
    --dp-icon-color: #959595;
    --dp-danger-color: #e53935;
    --dp-marker-color: #e53935;
    --dp-tooltip-color: #3e3e3e;
    --dp-highlight-color: rgb(0 92 178 / 20%);
    /* --dp-range-between-dates-background-color: var(--dp-hover-color, #484848);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #fff);
    --dp-range-between-border-color: var(--dp-hover-color, #fff); */
}
</style>

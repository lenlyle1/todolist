<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

defineProps(['items']);

const form = useForm({
    title: '',
    priority: '',
});

</script>

<script>
export default {
  methods: {
    updateStatus(id, status) {
        const item = {id: id, status: status}
        axios.post(route('items.update-status'))
    },
    markDone(event, id) {
        console.log(event)
    }
  },
}

</script>
<style>
.Low {
    color: green;
}
.Med {
    color: orange;
}
.High {
    color: red;
}
</style>
<template>
    <Head title="Todolist" />
 
    <AuthenticatedLayout>
        <div class="w-[400px] mx-auto p-[50px] mt-5 sm:p-6  border-2 border-black bg-white">

                <div class="bg-white divide-y p-3 mb-2 border-2" v-for="item in items">
                    <table>
                        <tr>
                            <td class="align-middle pr-3">
                                <input type="checkbox"
                                :value="item.id"
                                id="item.id"
                                v-model="item.id"
                                @change="markDone($event, item.id)"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"  />
                            </td>
                            <td class="w-full align-middle">{{ item.title }}</td>
                            <td :class="item.priority" class="align-middle text-md font-bold pr-2">{{ item.priority }}</td>
                            <td v-if="$page.props.auth.user.id === item.user_id || $page.props.auth.user.is_admin" class="align-middle">X</td>
                        </tr>
                    </table>
                </div>

                <form @submit.prevent="form.post(route('items.store'), { onSuccess: () => form.reset() })">
                    <div class="mt-7">
                        <label class="mt-5">Description</label>
                    </div>
                    <textarea
                        v-model="form.title"
                        placeholder="Enter todo task"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></textarea>

                    <div class="mt-7">
                        <label class="mt-5">Priority</label>
                    </div>
                    <select  v-model="form.priority" class=" border-slate-300 lock w-full ">
                        <option value="Low" >Low</option>
                        <option value="Med" :selected="true">Medium</option>
                        <option value="High">High</option>
                    </select>
                    <InputError :title="form.errors.title" class="mt-2" />
                    <InputError :title="form.errors.priority" class="mt-2" />
                    <PrimaryButton class="mt-4 bg-blue-500 rounded-md">Add Task</PrimaryButton>
                </form>
            </div>
    </AuthenticatedLayout>
</template>
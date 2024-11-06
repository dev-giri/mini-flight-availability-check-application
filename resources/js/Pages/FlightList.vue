<template>
    <div class="py-12">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Flight</h2>

            <form @submit.prevent="addFlight" class="space-y-6">
                <div>
                    <label for="flight_name" class="block text-sm font-medium text-gray-700">Flight Name</label>
                    <input
                        id="flight_name"
                        v-model="form.flight_name"
                        type="text"
                        placeholder="Enter flight name"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <div>
                    <label for="takeoff_location" class="block text-sm font-medium text-gray-700">Takeoff Location</label>
                    <input
                        id="takeoff_location"
                        v-model="form.takeoff_location"
                        type="text"
                        placeholder="Enter takeoff location"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <div>
                    <label for="landing_location" class="block text-sm font-medium text-gray-700">Landing Location</label>
                    <input
                        id="landing_location"
                        v-model="form.landing_location"
                        type="text"
                        placeholder="Enter landing location"
                        required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    />
                </div>

                <div>
                    <label for="operating_days" class="block text-sm font-medium text-gray-700">Operating Days</label>
                    <select
                        id="operating_days"
                        v-model="form.operating_days"
                        multiple
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                        <option v-for="day in days" :key="day" :value="day">{{ day }}</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Add Flight
                    </button>
                </div>
            </form>
        </div>
        <br>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
            >
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">List of Flights</h2>

                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Flight Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Takeoff Location</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Landing Location</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Operating Days</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="flight in flights" :key="flight.id">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ flight.flight_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ flight.takeoff_location }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ flight.landing_location }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <span v-for="(day, index) in flight.operating_days" :key="index" class="inline-block mr-2">
                                  {{ day }}
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

export default {
    props: {
        flights: Array,
    },
    layout: AuthenticatedLayout,
    setup() {
        const form = ref({
            flight_name: '',
            takeoff_location: '',
            landing_location: '',
            operating_days: [],
        });

        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        function addFlight() {
            router.post('/flights', form.value, {
                onSuccess: () => alert('Flight added!'),
            });
        }

        return { form, days, addFlight };
    },
};
</script>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetPrimaryButton from '@/Components/PrimaryButton.vue'
import { defineAsyncComponent } from 'vue'
    export default {
        components: {
            AppLayout,
    },
        methods: {
            componentName(index) {
                return defineAsyncComponent(() =>
                    import(
                        '@heroicons/vue/20/solid/'
                        + this.projects[index].icon_name
                        + 'Icon.js'
                    )
                )
            }
        },
        props: {
            projects: Object,
        }
    }
</script>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table v-if="projects.length > 0" class="w-full">
                    <thead class="border-b-2 border-gray-300 text-indigo-600">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left">
                                Color
                            </th>
                            <th class="px-6 py-3 text-left">
                                Icon
                            </th>
                            <th class="px-6 py-3 text-left">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="(project, index) in projects" :key="project.id">
                        <tr class="text-sm text-indigo-900 border-b border-gray-400">
                            <td class="px-6 py-4">
                                {{ project.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ project.description }}
                            </td>
                            <td class="px-6 py-4">
                                <p>
                                    <span class="mr-5 p-4 rounded" :class="project.color"></span>
                                    {{ project.color }}
                                </p>
                            </td>
                            <td class="px-6 py-4" :class="project.color">
                                <component :is="componentName(index)"></component>
                            </td>
                            <td class="px-6 py-4">
                                <JetPrimaryButton
                                    class="border border-indigo-500 text-indigo-500 bg-indigo-50 hover:bg-indigo-100 mr-2">
                                    Edit
                                </JetPrimaryButton>
                                <JetPrimaryButton
                                    class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100 ml-2">
                                    Delete
                                </JetPrimaryButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800">
                    There are no skills yet. Let's create one :)
                </div>
            </div>
        </div>
    </app-layout>
</template>

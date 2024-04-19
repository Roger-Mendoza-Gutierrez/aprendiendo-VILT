<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import JetApplicationMark from '@/Components/ApplicationMark.vue'
import JetPrimaryButton from '@/Components/PrimaryButton.vue'
import JetModal from '@/Components/Modal.vue'
import jetTextInput from '@/Components/TextInput.vue'
import jetInputError from '@/Components/InputError.vue'
import Section from '@/MyComponents/Section.vue'
import Skill from '@/MyComponents/Skill.vue'
import Project from '@/MyComponents/Project.vue'
import { BeakerIcon } from '@heroicons/vue/20/solid'
import { defineAsyncComponent, ref, reactive } from 'vue'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    skills: Object,
    projects: Object,
});

const contacting = ref(null);

const form = useForm({
    'email': '',
    'message': '',
});
const submit = () => {
    form.post(route('contact'));
};

const componentName = (index) => {
    return defineAsyncComponent(() => import(`@heroicons/vue/20/solid/${projects[index].icon_name}Icon.js`));
};

/*function componentName(index) {
    return defineAsyncComponent(() =>
        import(
            '@heroicons/vue/20/solid/'
            + this.projects[index].icon_name
            + 'Icon.js'
        )
    )
}*/

</script>

<template>

    <Head title="Welcome" />
    <div class="
        grid
        grid-cols-2
        text-right
        py-10
        px-72
        bg-gray-800
        text-gray-300
    ">
        <div>
            <JetApplicationMark class="h-12 w-auto"></JetApplicationMark>
        </div>
        <div v-if="canLogin">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm underline">
            Dashboard
            </Link>
            <template v-else>
                <Link :href="route('login')" class="text-base underline">
                Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="text-base underline place-self-end ml-4">
                Register
                </Link>
            </template>
        </div>
    </div>

    <Section class="
        bg-gray-800
        pt-16
        h-screen
    ">
        <div class="h-2/3 flex flex-wrap content-between border-gray-600 pb-36">
            <p class="
                border-b-2
                font-bold
                border-gray-400
                pb-3
                text-2xl
                text-gray-300
                uppercase
            ">
                Hey! This is Juan. I'm a Software Engineer and I would like to work with you.
            </p>
            <div class="flex items-end border-b-2 border-gray-500 pb-2">
                <p class="
                    font-bold
                    mr-5
                    text-gray-500
                    text-xl
                ">
                    Want to know more?
                </p>
                <JetPrimaryButton class="
                    bg-green-400
                    rounded
                    font-bold
                    text-sm
                    text-gray-800
                    hover:bg-green-500" @click="contacting = true">
                    {{
                    $page.props.flash.contacted ? 'Thanks' : 'Let\'s chat'
                    }}
                </JetPrimaryButton>
            </div>
        </div>
        <div class="animate-pulse mt-3 text-gray-300 text-center text-9xl">
            <a href="#skills">&#8675;</a>
        </div>
    </Section>

    <Section id="skills" class="bg-gray-200 text-gray-800 h-screen">
        <h2 class="text-6xl font-bold pt-3">Skills</h2>

        <div class="grid grid-cols-2">
            <div v-for="skill in skills" :key="skill.id">
                <Skill :background="skill.color">
                    {{ skill.name }}
                </Skill>
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <JetPrimaryButton class="
               bg-indigo-800
                rounded
                font-bold
                text-sm
                text-gray-200
                hover:bg-indigo-700" @click="contacting = true">
                {{
                $page.props.flash.contacted ? 'Thanks' : 'Get in touch'
                }}
            </JetPrimaryButton>
        </div>
    </Section>

    <Section class="bg-gray-600 text-gray-200 h-screen">
        <h2 class="text-6xl font-bold pt-3">Projects</h2>

        <div v-for="(project, index) in projects" :key="project.id">
            <Project :title="project.title" :description="project.description" :color="project.color">
                <component :is="componentName(index)"></component>
            </Project>

        </div>

        <div class="flex justify-center mt-10">
            <JetPrimaryButton class="
                bg-purple-100
                rounded
                font-bold
                text-sm
                text-gray-800
                hover:bg-purple-200" @click="contacting = true">
                {{
                $page.props.flash.contacted ? 'Thanks' : 'Now more'
                }}
            </JetPrimaryButton>
        </div>
    </Section>

    <Section class="flex justify-between bg-gray-800 text-gray-300 text-xl">
        <p>&copy; Roger Mendoza. All rights reserved</p>
        <div class="flex justify-evenly items-center">
            <Link href="#" class="border-b pb-1 px-2 hover:text-gray-50" target="_blank">
            Github
            </Link>
            <Link href="#" class="border-b pb-1 px-2 hover:text-gray-50" target="_blank">
            Twitter
            </Link>
            <Link href="#" class="border-b pb-1 px-2 hover:text-gray-50" target="_blank">
            StackOverflow
            </Link>
        </div>
    </Section>

    <JetModal :show="contacting" :closeable="true" @close="contacting = null">
        <div v-if="$page.props.flash.contacted" class="bg-green-400 shadow-2xl p-8 text-center font-bold">
            <p class="text-8xl m-5">👍</p>
            <p class="text-5xl font-bold m-2">Thanks!</p>
            <p class="text-xl m-2">I'll get back to you soon.</p>
        </div>
        <div v-else class="bg-gray-50 shadow-2xl p-8">
            <p class="text-gray-600 text-2xl font-extrabold text-center">Let me know some details</p>
            <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                <jetTextInput v-model="form.email" class=" px-5 py-3 w-96 border boder-gray-600 rounded" type="email"
                    name="email v-model" placeholder="Your email">
                </jetTextInput>

                <jetInputError :message="form.errors.email" />

                <textarea v-model="form.message" class=" px-5 py-3 w-96 boder border-gray-600 rounded mt-5"
                    name="message" placeholder="The details :)">
                </textarea>

                <jetInputError :message="form.errors.message" />

                <JetPrimaryButton class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                    :disabled="form.processing">
                    <span class="animate-spin mr-1" v-show="form.processing">
                        &#9696;
                    </span>
                    <span v-show="!form.processing">
                        Get in touch
                    </span>
                </JetPrimaryButton>
            </form>
        </div>
    </JetModal>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>

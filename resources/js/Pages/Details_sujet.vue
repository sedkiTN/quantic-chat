<template>
    <Head>
        <title>{{sujet.name}}</title>
    </Head>

    <div class="text-center">
        <h1 class="text-3xl">{{sujet.name}}</h1>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
                        <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                            <div v-for="message in sujet.messages" class="chat-message" :key="message.id">
                                <div class="flex" :class="{ 'justify-end' : (message.user.id == this.$page.props.auth.user.id), 'items-end' : (message.user.id != this.$page.props.auth.user.id) }">
                                    <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2" :class="{ 'items-end order-1' : (message.user.id == this.$page.props.auth.user.id), 'order-2 items-start' : (message.user.id != this.$page.props.auth.user.id) }">
                                        <div>
                                            <span class="px-4 py-2 rounded-lg inline-block" :class="{ 'bg-blue-600 text-white' : (message.user.id == this.$page.props.auth.user.id), 'bg-gray-300 text-gray-600' : (message.user.id != this.$page.props.auth.user.id) }">
                                                {{ message.body }}
                                                <span class="mt-2 block" :class="{'text-white' : (message.user.id == this.$page.props.auth.user.id), 'text-gray-900' : (message.user.id != this.$page.props.auth.user.id) }"><small>{{ message.user.name + "(" + message.user.email + ") - " + message.created_at }}</small></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="submit" class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
                            <div class="relative flex">
                                <input v-model="form.message" name="message" id="message" required type="text" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-6 bg-gray-200 rounded-full py-3">
                                <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
                                    <button type="submit" :disabled="form.processing" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 transform rotate-90">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div v-if="form.errors.message" v-text="form.errors.message" class="text-red-500 text-xs mt-1"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Pagination from '@/Shared/Pagination';
    import { useForm } from '@inertiajs/inertia-vue3';
    
    let props = defineProps({
        sujet: Object,
    });

    let form = useForm({
        message: '',
        id: props.sujet.id
    });
    
    let submit = () => {
        form.post('/message', {
            preserveScroll: true,
            onSuccess: () => form.reset('message'),
        });
    };
</script>
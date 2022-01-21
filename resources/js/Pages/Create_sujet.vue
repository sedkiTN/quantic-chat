<template>
    <Head>
        <title>Nouveau sujet</title>
    </Head>

    <h1 class="text-3xl">Nouveau sujet</h1>

    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Sujet </label>
            <input v-model="form.subject" class="border border-gray-400 p-2 w-full" type="text" name="subject" id="subject" required />
            <div v-if="form.errors.subject" v-text="form.errors.subject" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="message"> Message </label>
            <textarea v-model="form.message" class="border border-gray-400 p-2 w-full" name="message" id="message" required cols="30" rows="10"></textarea>
            <div v-if="form.errors.message" v-text="form.errors.message" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Creer</button>
        </div>
    </form>
</template>

<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';

    let form = useForm({
        subject: '',
        message: '',
    });

    let submit = () => {
        form.post('/sujets');
    };
</script>
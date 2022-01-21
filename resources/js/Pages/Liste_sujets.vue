<template>
    <Head>
        <title>Liste des sujets</title>
    </Head>

    <div class="flex justify-between">
        <h1 class="text-3xl">Liste des sujets</h1>
        <Link href="/sujets/create" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 ml-3">Nouveau sujet</Link>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="sujet in sujets.data" :key="sujet.id">
                                <td class="p-4 pl-0 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <Link :href="`/sujets/${sujet.id}`" class="text-indigo-600 hover:text-indigo-900 ml-4 w-full">
                                            <div class="text-sm font-medium text-gray-900 flex justify-between">
                                                <span class="flex justify-between items-center">
                                                    <span class="flex-shrink-0 text-2xl mr-3 text-indigo-600">
                                                        {{ sujet.messages.length }}
                                                    </span>
                                                    <span>
                                                        {{ sujet.name }}
                                                    </span>
                                                    &nbsp;
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        0
                                                    </span>
                                                </span>
                                                <span>{{ sujet.created_at }}</span>
                                            </div>
                                            <div v-if="sujet.latestMessage" class="text-sm text-gray-500">
                                                {{ sujet.latestMessage.body + ' - ' + sujet.latestMessage.created_at }}
                                            </div>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!sujets.data.length">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="items-center">
                                        <div class="text-center">
                                            <div class="text-sm font-medium text-gray-900 text-center">
                                                Aucun sujets pour le moment
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Pagination v-if="sujets.data.length" :links="sujets.links" class="mt-6 text-center" />
</template>

<script setup>
    import Pagination from '@/Shared/Pagination';
    
    let props = defineProps({
        sujets: Object,
    });
</script>
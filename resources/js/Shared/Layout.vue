<template>
    <Head>
        <title>
            Quantic chat
        </title>
    </Head>

    <section class="p-6 bg-gray-200">
        <header class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="font-bold text-lg"><img class="w-40" src="/logo_text_96.png" alt="Logo quantic-telecom"></h1>
            </div>
            <Nav />
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot/>
        </div>
    </section>

    <ModalUserInfos />
</template>

<script>
    import Nav from './Nav';

    export default {
        components: { Nav },
    };
</script>
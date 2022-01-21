<template>
    <nav>
        <ul class="flex space-x-6">
            <li><NavLink href="/" :active="$page.component === 'Liste_sujets'">Liste des sujets</NavLink></li>
        </ul>
    </nav>
</template>

<script>
    import NavLink from './NavLink.vue';
    export default {
        components: { NavLink },
    };
</script>
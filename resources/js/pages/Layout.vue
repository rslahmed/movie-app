<template>
    <main class="bg-gray-800">
        <nav class="w-full bg-gray-900 text-white py-4">
            <div class="container flex items-center mx-auto">
                <inertia-link href="/" class="logo w-40 flex items-center">
                    <i class="fas fa-video"></i><p class="text-xl ml-2">MovieApp</p>
                </inertia-link>
                <div class="navbar ml-8 flex items-center text-gray-300">
                    <inertia-link class="hover:text-white mr-4" :class="{'text-white' : activeHref === 'Home'}" :href="route('Home')">Home</inertia-link>
                    <inertia-link class="hover:text-white mr-4" :class="{'text-white' : activeHref === 'popular'}" :href="route('Movie.all', ['popular', 1])">Popular Movie</inertia-link>
                    <inertia-link class="hover:text-white mr-4" :class="{'text-white' : activeHref === 'now_playing'}" :href="route('Movie.all', ['now_playing', 1])">Now Playing</inertia-link>
                    <inertia-link class="hover:text-white mr-4" :class="{'text-white' : activeHref === 'upcoming'}" :href="route('Movie.all', ['upcoming', 1])">Upcoming</inertia-link>
                </div>
                <div class="searchbar ml-auto">
                    <search-result></search-result>
                </div>
            </div>
        </nav>

        <slot></slot>
    </main>
</template>

<script>
    import SearchResult from "../components/SearchResult";

    export default {
        name: "Layout",
        props: ['activeHref'],
        components: {
            'search-result' : SearchResult
        },
    }
</script>

<style scoped>

</style>

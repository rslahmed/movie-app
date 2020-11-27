<template>
    <app-layout activeHref="Home">

        <!--  popular movies  -->
        <div class="container mx-auto py-12 mt-10">
            <div class="flex justify-between items-baseline">
                <h3 class="text-2xl text-yellow-400 uppercase">Popular Movies</h3>
                <inertia-link :href="route('Movie.all', ['popular', 1])" class="text-lg text-gray-300 hover:text-white underline">See more</inertia-link>
            </div>
            <div class="flex -mx-3 mt-8 flex-wrap">
                <Movies v-for="(movie, index) in popularMovies" :key="index" :movie="movie" :genres="genres"></Movies>
            </div>
        </div>

        <!--  now playing movies  -->
        <div class="container mx-auto py-12">
            <div class="flex justify-between items-baseline">
                <h3 class="text-2xl text-yellow-400 uppercase">Now Playing</h3>
                <inertia-link :href="route('Movie.all', ['now_playing', 1])" class="text-lg text-gray-300 hover:text-white underline">See more</inertia-link>
            </div>
            <div class="flex -mx-3 mt-8 flex-wrap">
                <Movies v-for="(movie, index) in nowPlaying" :key="index" :movie="movie" :genres="genres"></Movies>
            </div>
        </div>


        <!--  upcoming movies  -->
        <div class="container mx-auto py-12">
            <div class="flex justify-between items-baseline">
                <h3 class="text-2xl text-yellow-400 uppercase">Upcoming Movies</h3>
                <inertia-link :href="route('Movie.all', ['upcoming', 1])" class="text-lg text-gray-300 hover:text-white underline">See more</inertia-link>
            </div>
            <div class="flex -mx-3 mt-8 flex-wrap">
                <Movies v-for="(movie, index) in upcomingMovies" :key="index" :movie="movie" :genres="genres"></Movies>
            </div>
        </div>


    </app-layout>
</template>

<script>
    import Movies from '../components/Movies';
    export default {
        name: "Home",
        props: ['popularMovies', 'upcomingMovies', 'nowPlaying', 'genres'],
        components:{
            Movies,
        },
    }
</script>

<style scoped>

</style>

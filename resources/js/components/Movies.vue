<template>
    <inertia-link :href="route('Movie.view', movie.id)" v-if="movie.poster_path" class="block px-3 w-1/5 mb-6" >
        <div>
            <img :src="getMovieImage(movie.poster_path)" alt="" class="w-100">
        </div>
        <h3 class="text-xl text-white mt-2">{{movie.title}}</h3>
        <div class="flex items-center text-white text-sm">
            <span class="text-yellow-500"><i class="fa fa-star"></i></span>
            <span class="ml-2">{{movie.vote_average * 10}}%</span>
            <span class="mx-2">|</span>
            <span>{{movie.release_date | moment('DD MMMM YYYY')}}</span>
        </div>
        <p class="text-sm text-gray-300">
            {{getGenreName(movie.genre_ids)}}
        </p>
    </inertia-link>
</template>

<script>
    export default {
        props: ['movie', 'genres'],
        name: "Movies",
    }
</script>

<style scoped>

</style>

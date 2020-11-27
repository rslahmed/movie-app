<template>
    <app-layout :activeHref="movieType">
        <!--  popular movies  -->
        <div class="container mx-auto py-12 mt-8">
            <h3 class="text-4xl text-yellow-400 uppercase text-center">{{movieType}}</h3>
            <div class="flex -mx-3 mt-10 flex-wrap">
                <Movies v-for="(movie, index) in movies" :key="index" :movie="movie" :genres="genres"></Movies>
            </div>

            <!-- pagination -->
            <div class="mt-16 text-center">
                <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
                    <inertia-link :href="thisPage === 1 ? 'javascript:void(0)':route('Movie.all', [movieType, thisPage-1])" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 text-sm font-medium text-gray-500" :class="thisPage===1 ? 'bg-gray-300': 'hover:bg-gray-100 bg-white'">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </inertia-link>
                    <inertia-link v-for="n in 20" :key="n" :href="route('Movie.all', [movieType,n])" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium hover:bg-gray-100" :class="n===thisPage ? 'text-white bg-yellow-500' : 'bg-white text-gray-700'">
                        {{n}}
                    </inertia-link>
                    <inertia-link :href="thisPage===20 ? 'javascript:void(0)':route('Movie.all', [movieType, thisPage+1])" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 text-sm font-medium text-gray-500" :class="thisPage===20 ? 'bg-gray-300': 'hover:bg-gray-100 bg-white'">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </inertia-link>
                </nav>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import Movies from "../components/Movies";

    export default {
        props: ['movies', 'genres', 'totalPages', 'movieType', 'page'],
        name: "AllMovies",
        components:{
            Movies,
        },
        computed:{
            thisPage(){
                return parseInt(this.page)
            }
        }
    }
</script>

<style scoped>

</style>

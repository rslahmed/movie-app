<template>
    <app-layout>
        <div class="flex container mx-auto py-20 border-b-1 border-gray-100">
            <div class="w-1/4">
                <img :src="getMovieImage(movie.poster_path)" alt="" class="w-100">
            </div>
            <div class="w-3/4 pl-20 text-gray-100">
                <h2 class="text-4xl text-white">{{movie.title}}</h2>
                <h5 class="text-base text-gray-300 mt-2">{{movie.tagline}}</h5>
                <div class="flex items-center text-white text-sm mt-2">
                    <span class="text-yellow-500"><i class="fa fa-star"></i></span>
                    <span class="ml-2">{{movie.vote_average * 10}}%</span>
                    <span class="ml-2">({{movie.vote_count}})</span>
                    <span class="mx-2">|</span>
                    <span>{{movie.release_date | moment('DD MMMM YYYY')}}</span>
                    <span class="mx-2">|</span>
                    <span v-for="(genre, index) in movie.genres" :key="index">
                         {{genre.name}}<span class="mr-1" v-if="index != Object.keys(movie.genres).length - 1">,</span>
                    </span>
                </div>
                <p class="text-base mt-8">
                    {{movie.overview}}
                </p>
                <p class="mt-12 text-xl mb-3 text-white font-medium">Featured Crew</p>

                <div class="text-base flex">
                    <div class="w-max mr-6" v-for="(crew,index) in movie.credits.crew" :key="index" v-if="index < 2">
                        <p class="text-white">{{crew.name}}</p>
                        <p class="text-sm">{{crew.job}}</p>
                    </div>
                </div>

                <div class="mt-8 text-base text-gray-200">
                    <p class="text-xl text-white mb-2">Details</p>
                    <p class="flex"><span class="w-24">Language</span> <span class="mr-8">:</span> <span class="uppercase">{{movie.original_language}}</span></p>
                    <p class="flex"><span class="w-24">Runtime</span> <span class="mr-8">:</span> {{movie.runtime}} minutes</p>
                    <p class="flex"><span class="w-24">Status</span> <span class="mr-8">:</span> {{movie.status}}</p>
                </div>

                <div class="mt-12">
                    <a :href="movie.videos.results[0] ? 'https://www.youtube.com/watch?v='+movie.videos.results[0].key : 'javascript:void(0)'" target="_blank" class="px-4 py-2 bg-yellow-600 rounded">
                        <i class="fa fa-play-circle mr-2"></i>
                        Play Trailer
                    </a>
                </div>
            </div>
        </div>

        <div class="border-b border-t border-gray-700">
            <div class="container mx-auto py-20">
                <h3 class="text-xl text-yellow-400 uppercase mb-6">Cast</h3>
                <div class="flex -mx-3 flex-wrap">
                    <div class="mx-3 w-2/12 mb-8" v-for="(cast, index) in movie.credits.cast" :key="index" v-if="cast.profile_path && index < 10">
                        <div>
                            <img :src="getMovieImage(cast.profile_path)" alt="">
                        </div>
                        <h3 class="text-white text-xl mt-2">{{cast.name}}</h3>
                        <p class="text-sm text-gray-200">{{cast.character}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-20">
            <h3 class="text-xl text-yellow-400 uppercase mb-6">Images</h3>
            <div class="flex -mx-3 flex-wrap">
                <div class="w-1/3 px-3 mb-8" v-for="(image, index) in movie.images.backdrops" :key="index" v-if="index < 6">
                    <img :src="getMovieImage(image.file_path)">
                </div>
            </div>
        </div>

        <div class="container mx-auto py-20">
            <div class="flex -mx-4">
                <div class="w-1/2 px-4">
                    <h3 class="text-xl text-yellow-400 uppercase mb-6 flex items-center">
                        <span class="text-yellow-500 text-lg mr-3"><i class="fa fa-star"></i></span> Movie Reviews
                    </h3>
                    <div class="text-lg text-white" v-if="reviews.length === 0">
                        No review yet
                    </div>
                    <div class="mb-8 text-white" v-for="(review, index) in reviews" :key="index">
                        <div class="flex mb-4 items-center">
                            <div class="w-12 mr-4">
                                <img class="w-full h-12 object-cover rounded-full" :src="getAuthorImage(review.author_details.avatar_path)" alt="">
                            </div>
                            <div class="flex w-auto items-center">
                                <p class="text-xl mr-6">{{review.author}}</p>
                                <p class="text-base">
                                    <span class="text-yellow-500 text-lg mr-2"><i class="fa fa-star"></i></span> {{Math.round(review.author_details.rating)}} /10
                                </p>
                            </div>
                        </div>
                        <div class="text-base">
                            {{review.content.substr(0,250)}}
                        </div>
                    </div>
                </div>
                <div class="w-1/2 px-4">
                    <h3 class="text-xl text-yellow-400 uppercase mb-6 flex items-center">
                        Related Movies
                    </h3>
                    <div class="text-lg text-white" v-if="similars.length === 0">
                        No related movie found
                    </div>
                    <div class="flex -mx-3 flex-wrap">
                        <div class="w-1/3 px-3 mb-8" v-for="(similar, index) in similars" :key="index">
                            <inertia-link :href="route('Movie.view', similar.id)">
                                <img class="w-full" :src="getMovieImage(similar.poster_path)">
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>

</template>

<script>
    export default {
        name: "MovieDetails",
        props: ['movie', 'reviews', 'similars'],
        methods:{
            getAuthorImage(img){
                if (img){
                    if(img.search('https://') !== -1){
                        return img.slice(1)
                    }else{
                        return this.getMovieImage(img)
                    }
                }else{
                    return 'https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png'
                }
            }
        }
    }
</script>

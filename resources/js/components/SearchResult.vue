<template>
    <div class="relative w-60">
        <span class="absolute text-sm left-2 top-2"><i class="fa fa-search"></i></span>
        <input type="text" class="border-0 rounded-full w-full py-1 pl-8 pr-2 text-gray-100 focus:outline-none bg-gray-700" placeholder="Search..." v-model="searchQuery" @keyup="getResult">
        <div class="absolute w-full left-0 top-10 bg-gray-700 rounded max-h-80 overflow-x-hidden overflow-y-auto" v-if="showResult">
            <inertia-link :href="route('Movie.view', result.id)" class="flex px-2 py-3 items-center border-b border-gray-600 hover:bg-gray-500" v-for="(result, index) in searchResult" :key="index" v-if="result.poster_path && result.title">
                <img :src="getMovieImage(result.poster_path)" alt="" class="w-1/5">
                <div class="ml-2 w-4/5 text-white text-base">{{result.title}}</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchResult",
        data() {
            return {
                searchQuery: '',
                showResult: false,
                searchResult : []
            }
        },
        methods:{
            getResult(){
                clearTimeout(this.timeout);
                let self = this;
                this.timeout = setTimeout(function () {
                    if(self.searchQuery.length > 1){
                        axios.get('/search/multi/'+self.searchQuery)
                            .then(response => {
                                self.searchResult = response.data
                            })
                        self.showResult = true
                    }else{
                        self.showResult = false
                    }
                }, 1000)
            }
        }
    }
</script>

<style scoped>

</style>

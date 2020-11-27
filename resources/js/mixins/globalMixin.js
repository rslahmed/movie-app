export default {
    methods: {
        getGenreName(genre){
            let genresName = []
            for (let g of genre){
                genresName.push(this.genres[g])
            }
            return genresName.join(', ')
        },
        getMovieImage(img){
            return 'https://image.tmdb.org/t/p/w500'+img
        }
    }
};

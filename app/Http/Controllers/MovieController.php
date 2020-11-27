<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class MovieController extends Controller
{
    public $baseUrl = 'https://api.themoviedb.org/3';
    function index(){
        //populer movies
        $ppMovies = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/popular')
            ->json()['results'];
        $popularMovies = collect($ppMovies)->take(10);

        //upcoming movies
        $upcoming = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/upcoming')
            ->json()['results'];
        $upcomingMovies = collect($upcoming)->take(10);

        //now playing movies
        $nowP = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/now_playing')
            ->json()['results'];
        $nowPlaying = collect($nowP)->take(10);

        return Inertia::render('Home', [
            'popularMovies' => $popularMovies,
            'upcomingMovies' => $upcomingMovies,
            'nowPlaying' => $nowPlaying,
            'genres' => $this->genres()
        ]);
    }

    function view($id){
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/'.$id.'?append_to_response=credits,videos,images')
            ->json();

        $reviews = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/'.$id.'/reviews')
            ->json()['results'];

        $similars = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/'.$id.'/similar')
            ->json()['results'];

        $similar = collect($similars)->take(6);


        return Inertia::render('MovieDetails', [
            'movie'=> $movie,
            'reviews'=> $reviews,
            'similars'=> $similar,
            'genres' => $this->genres()
        ]);
    }

    function getAll($type, $page){
        $movies = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/movie/'.$type.'?page='.$page)
            ->json()['results'];

        return Inertia::render('AllMovies', [
            'movies'=> $movies,
            'genres' => $this->genres(),
            'page' => $page,
            'movieType' => $type,
            'activeHref' => $type
        ]);
    }

    function search($query){
        $movies = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/search/multi?query='.$query)
            ->json()['results'];
        return $movies;
    }

    function genres(){
        //genres
        $genre = Http::withToken(config('services.tmdb.token'))
            ->get($this->baseUrl.'/genre/movie/list')
            ->json()['genres'];
        $genres = collect($genre)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

        return $genres;
    }
}

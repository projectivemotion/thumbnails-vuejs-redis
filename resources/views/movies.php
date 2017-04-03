<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Bootstrap -->
        <script type="text/javascript" src="//code.jquery.com/jquery-compat-git.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Fonts -->
<!--        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->

        <!-- Styles -->
        <style>/* Latest compiled and minified CSS included as External Resource*/

            /* Optional theme */
            @import url('//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css');

            body {
                margin: 10px;
            }

            .thumbnail-list li {
                float: left;
                width: 25%;
                height: 115px;
                /*padding: 10px;*/
                font-size: 10px;
                line-height: 1.4;
                text-align: center;
                /* background-color: #f9f9f9; */
                border: 1px solid #f9f9f9;
                list-style: none;
            }
            .thumbnail-list .thumbnail {
                border: none;
            }
            .thumbnail-list .thumbnail > img {
                max-height:107px;
            }
        </style>
    </head>
    <body>
    <script src="//unpkg.com/vue/dist/vue.js"></script>

    <div class="container">
        <ul class="thumbnail-list">
            <li v-for="movie in movies" v-on:dragover.prevent="dragovermovie(movie, $event)" v-on:dragleave.prevent="dragleavemovie(movie, $event)" v-on:drop.prevent="dropmovie(movie, $event)"
                v-bind:class="{ 'bg-primary' : movie.hover }" >
                <a href="#" class="thumbnail" v-if="movie.images.length">
                    <img v-bind:src="movie.images[0].src" alt="alt">
                </a>
                <div v-else>
                    <span class="glyphicon glyphicon-picture"></span> {{movie.label}}
                            <!-- <img src="https://www.placehold.it/350x150" alt="Image"> -->
                </div>
            </li>
        </ul>
    </div>
    </body>
</html>
<script>
    /* Latest compiled and minified JavaScript included as External Resource */

    var View = new Vue({
        el: '.container',
        created: function (){
            for(var i = 0; i < 500; i++)
                this.movies.push({id: i, images: [], label: 'movie-' + i, hover: false});
        },
        watch: {
            movies: function (){
                console.log(arguments);
            }
        },
        methods: {
            upload: function (movie, url){
                movie.images.push({src: url});
                var movies_withimages = this.movies.filter(function (movie){
                    if(movie.images.length) return true;
                    return false;
                }).length;
                if(this.autoremove > 0 && movies_withimages >= this.autoremove)
                    this.movies = this.movies.filter(function (movie){
                        return movie.images.length == 0;
                    });
//console.log(movies_withimages);
            },
            dropmovie(movie, e){
                console.log("drop", movie);
                movie.hover = false;
                this.upload(movie, 'https://www.placehold.it/350x250');
            },
            dragovermovie(movie, e){
// if(e.target.tagName != 'DIV') return;
                movie.hover = true;
                console.log(movie.hover);
            },
            dragleavemovie(movie, e){
// if(e.target.tagName != 'DIV') return;
                movie.hover = false;
                console.log(movie.hover);
            }
        },
        data: {
            autoremove: 5,
            movies: []
        }
    });
</script>

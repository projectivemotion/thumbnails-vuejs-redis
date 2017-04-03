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

            .thumbnail-list .no-image {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
    <script src="//unpkg.com/vue/dist/vue.js"></script>

    <div class="container">
        <ul class="thumbnail-list">
            <li v-for="movie in movies" v-on:dragover.prevent="dragovermovie(movie, $event)" v-on:dragleave.prevent="dragleavemovie(movie, $event)" v-on:drop.prevent="dropmovie(movie, $event)"
                v-bind:class="{ 'bg-primary' : movie.hover }" >
                <div class="no-image pull-left">
                    <h5>
                        <span class="glyphicon glyphicon-picture"></span> {{movie.label}}
                    </h5>
                    <!-- <img src="https://www.placehold.it/350x150" alt="Image"> -->
                </div>
                <a href="#" class="thumbnail" v-if="movie.images.length">
                    <img v-bind:src="movie.images[0].src" alt="alt">
                </a>
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
            autofilter: function (){

                if(this.lastadd.length >= this.autoremove)
                {
                    var self = this;
                    var deletecount = self.lastadd.length - self.autokeep;
                    for(var i =0 ; i < deletecount ; i++)
                        self.movies.splice(self.movies.indexOf(self.lastadd.shift()), 1);
                }
            },
            upload: function (movie, url){
                movie.images.push({src: url});
                this.lastadd.push(movie);
                this.autofilter();
            },
            dropmovie(movie, e){
                console.log("drop", movie);
                movie.hover = false;
                this.upload(movie, 'https://www.placehold.it/350x250');
            },
            dragovermovie(movie, e){
                movie.hover = true;
            },
            dragleavemovie(movie, e){
                movie.hover = false;
            }
        },
        data: {
            autoremove: 2,
            autokeep: 1,
            lastadd: [],
            movies: []
        }
    });
</script>

<template>
    <div>

    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">Build a landing page for your business or project and generate more leads!</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <input type="text" class="form-control form-control-lg" placeholder="Search..." v-model="search">
                            </div>
                            <div class="col-12 col-md-3">
                                <button  class="btn btn-block btn-lg btn-primary" v-on:click="searchapi">Search!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

   <!-- Pagination grid -->
    <section class="pagination">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto mt-3">

                    <ul class="pagination">

                        <button class="page-item" :disabled ="previous" @click="loadpreviouspage">Previous</button>
                        <button class="page-item" :disabled ="next" @click="loadnextpage">Next</button>
                        <input type="checkbox" id="checkbox" v-model="checked">
                        <label for="checkbox">Search author</label>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <!-- Book Grid -->
        <!-- Book Grid -->
        <section class="pagination">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                        <div v-if="books.length==0 && !error">
                            <h1 class="text-primary text-center">Your search result will appear here!</h1>
                        </div>
                        <div v-else-if="!error">
                            <h1 class="text-success text-center">Your search result</h1>
                            <div class="row row-eq-height">
                                <div class="col-lg-3 col-md-3 col-sm-3 mt-3 mb-3" v-for="book in books">
                                    <div>
                                        <img :src="book.volumeInfo.imageLinks.smallThumbnail" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else-if="error">
                            <h1 class="text-danger text-center">Api failed to provide us sources of knowledge! Wait few seconds and then try again!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
</template>

<script>


    export default {

        data(){
            return {
                books:[],
                search:'',
                totalitems:0,
                startIndex:0,
                maxResults:40,
                previous:true,
                error:false,
                next:true,
                checked:false
            }

        },

        methods:{
            setData(data){
                this.books=data.items.filter(item=>item.volumeInfo.imageLinks.smallThumbnail !='undefined');
                this.totalitems=data.totalItems;
                (this.totalitems-this.startIndex>=this.maxResults)?this.next=false:this.next=true;
                (this.startIndex-this.maxResults>=0)?this.previous=false:this.previous=true;
                this.error=false;
            },
            loadnextpage(){
                this.startIndex +=40;
                axios.get('https://www.googleapis.com/books/v1/volumes', {params: {q: this.searchquery,startIndex:this.startIndex,maxResults:this.maxResults}}).then(({data})=>{
                    this.setData(data);
                }).catch(error => {
                    this.error=true;
                    console.log(error.response);
                });
            },
            loadpreviouspage(){
                this.startIndex -=40;
                axios.get('https://www.googleapis.com/books/v1/volumes', {params: {q: this.searchquery,startIndex:this.startIndex,maxResults:this.maxResults}}).then(({data})=>{
                    this.setData(data);
                }).catch(error => {
                    this.error=true;
                    console.log(error.response);
                });
            },
            searchapi(e){
                e.preventDefault();
                this.startIndex=0;
                axios.get('https://www.googleapis.com/books/v1/volumes', {params: {q: this.searchquery,startIndex:this.startIndex,maxResults:this.maxResults}}).then(({data})=>{
                    this.setData(data);
                }).catch(error => {
                    this.error=true;
                    console.log(error.response);
                });
            }
        },
        computed: {
        searchquery(){
        return (this.checked)?this.search.concat(" inauthor"):this.search.concat(" intitle");
        }
        }
    }
</script>

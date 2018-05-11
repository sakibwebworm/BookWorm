<template>
    <div>

        <header class="masthead text-white text-center backgroundpic pt-5 pb-5">
           <div class="container">
               <div class="row">
                   <div class="alert alert-warning alert-dismissible fade show" v-if="message !=''" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="hideMessage">
                           <span aria-hidden="true">&times;</span>
                       </button>
                       <strong>{{message}}</strong>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12" v-if="!error">
                       <img :src="book.volumeInfo.imageLinks.thumbnail">
                       <h1 >{{book.volumeInfo.title}}</h1>
                       <p >{{book.volumeInfo.description}}</p>
                       <div>
                           <button class="btn-danger" @click="savebookordelete">{{this.saved}}</button>
                       </div>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12" v-else-if="error">
                       <h1 class="text-danger">Something went wrong!</h1>
                   </div>
               </div>
           </div>
        </header>
    </div>
</template>

<script>


    export default {
        props:['id','saved'],
        data(){
            return {
                book:[],
                error:false,
                message:'',
                searchUri:'https://www.googleapis.com/books/v1/volumes/'
            }

        },
        created(){
            axios.get(this.searchquery).then(({data})=>{
                this.book=data;
            }).catch(error => {
                this.error=true;
                console.log(error);
            });
        },

        methods:{
            hideMessage(){
              this.message='';
            },
            savebookordelete(){
                //save book
                if(this.saved=='Save') {
                    axios.post('/books', {
                        identifier: this.id,
                        picture: this.book.imageLinks.thumbnail
                    }).then(({data}) => {
                        this.saved = 'Delete';
                        this.message=data;
                    }).catch(error => {
                        this.message = error.message + ' You can not perform the action  ';
                    });
                }
                //delete book
                else if(this.saved=='Delete'){
                    axios.delete(this.deletequery).then(({data}) => {
                        this.message=data;
                        this.saved = 'Save';
                    }).catch(error => {
                        this.message = error.message + ' You can not perform the action  ';
                    });
                }
                //Must be a non logged user or a programmer
                else{
                    window.location.replace("/login");
                }
            }
        },
        computed: {
            searchquery(){
                return this.searchUri.concat(this.id);
            },
            deletequery(){
                return '/books/'.concat(this.id);
            }
        }

    }
</script>
<style>
    .backgroundpic{
        background: #DCE35B;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #45B649, #DCE35B);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #45B649, #DCE35B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
</style>
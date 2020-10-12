<template>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <!-- <div v-for="e on errors" class="alert alert-danger">
                            {{ e }}
                        </div> -->
                        <FlashMessage position="right bottom"></FlashMessage>
                        <form>
                            Name: <input type="text"
                            v-model="name"
                            class="form-control">

                            Phone: <input type="number"
                            v-model="phone"
                            class="form-control">

                            Email: <input type="email"
                            v-model="email"
                            class="form-control">
                            <input type="submit" @click.prevent="create">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

                errors: null,
                name: '',
                phone: '',
                email: ''
                }
             },

        method:{
            create(){
                if(!this.name){
                    this.errors=['Name cannot be empty']
                        return false;
                }
            }
        },
        mounted() {

        this.flashMessage.error({
        title: 'Error Message Title',
        message: 'Oh, you broke my heart! Shame on you!'
        });


        }
    }
</script>

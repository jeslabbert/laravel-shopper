<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img class="product-image" :src="product.image" :alt="product.name">
                <hr>
                <h3 class="title" v-html="product.name"></h3>
                <p class="text-muted">{{product.description}}</p>
                <h4>
                    <span class="small-text text-muted float-left">£ {{product.price}}</span>
                    <span class="small-text float-right">Available Quantity: {{product.quantity}}</span>
                </h4>
                <br>
                <hr>
                <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</router-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                product : []
            }
        },
        beforeMount(){
            axios.get(`/api/products/${this.$route.params.id}`)
            .then(response => {
                this.product = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .product-image {
        max-width: 100%;
        margin-bottom: 10px;
    }
    .small-text {
        font-size: 16px;
    }
    .title {
        font-size: 32px;
    }
</style>

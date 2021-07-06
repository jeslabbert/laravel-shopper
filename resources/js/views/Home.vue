<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Laravel Shopper Demo</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4" v-for="(product,index) in products" @key="index">
                            <div class="product-box">
                            <router-link :to="{ path: '/products/'+product.id}">
                                <div class="product-header">
                                <img class="product-image" :src="product.image" :alt="product.name">
                                    <span class="small-text text-muted float-right">$ {{product.price}}</span>
                                </div>
                                <div class="product-body">
                                <h5><span v-html="product.name"></span>

                                </h5>
                                </div>
                                <div class="product-footer">
                                <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                                </div>
                            </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/")
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-inner-box {
        margin: 10px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .product-box {
        margin: 10px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }

    .product-header {
        width: 100%;
        height:200px;
        text-align: center;
        margin-bottom: 10px;
    }
    .product-image {
        max-width: 100%;
        height:200px;
    }
    .product-body {
        width: 100%;
        height:70px;
        text-align: center;
        margin-bottom: 10px;
    }
    .product-footer {
        width: 100%;
        text-align: center;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>

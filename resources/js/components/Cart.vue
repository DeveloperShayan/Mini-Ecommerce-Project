<template>
<div>
    <li class="nav-item">
        <a href="/checkout" class="btn btn-warning btn-sm">Cart {{ itemCount }}</a>

    </li>
    
</div>
</template>

<script>
export default {
    data()
    {
        return{
            itemCount : ''
        }
    },
   
    mounted()
    {
        this.$root.$on('changeInCart', (Items) => {
            this.itemCount = Items
        });
    },
     methods :{
       async getCartItemsOnPageLoad(){
            let response = await axios.post('/cart');
            this.itemCount = response.data.Items
        }
    },
    created(){
        this.getCartItemsOnPageLoad();
    }
}
</script>

<template>
    <div>
        <aside class="widget widget_shop">
            <h4 class="widget-title">Categories</h4>
            <ul class="ps-list--categories">
                <li class="current-menu-item" v-for="cate in categories" :key="cate.name">
                    <a @click="showListproduct(cate.slug)" class="showpointer">{{ cate.name }}</a>
                </li>
            </ul>
        </aside>
        
        <aside class="widget widget_shop">
            <form class="ps-form--widget-search" style="padding: 3%;">
                <div class="row">
                    <h4 class="widget-title">BY PRODUCT</h4>
                    <input class="form-control" type="text" placeholder="" name="word" v-model="word">
                </div>
                <br>
                <div class="row">
                    <br>
                    <h4 class="widget-title">BY SELLER</h4>
                    <input class="form-control" type="text" placeholder="" name="by" v-model="by">
                </div>
                <figure>
                    <h4 class="widget-title">By Price</h4>
                    <div id="nonlinear"></div>
                    <p class="ps-slider__meta"><span class="ps-slider__value">{{ localization_setting.currency }}<span class="ps-slider__min"></span></span>-<span class="ps-slider__value">{{ localization_setting.currency }}<span class="ps-slider__max"></span></span></p>
                </figure>

                <div class="row submit" style="display: block; text-align: center;">
                    <button class="ps-btn" @click="submit" style="position: initial; transform: translateY(20%);">Search</button>
                </div>
            </form>
        </aside>
    </div>
</template>

<style scoped>
    .showpointer {
        cursor: pointer;
    }
</style>

<script>
    export default{
        data(){
            return {
                min_price: 0,
                category: '',
                max_price: 1000000,
                by: '',
                word: ''
            }
        },

        computed: {
            categories(){
                return this.$store.getters.CATEGORIS;
            }, 
            localization_setting(){
                return this.$store.getters.LOCALIZATION_SETTINGS;
            }
        },
        
        methods: {
            async showListproduct(slug) {
                const body ={
                    word: this.word,
                    by: this.by,
                    min_price: this.min_price,
                    max_price: this.max_price,
                    category: slug,
                    page: 1
                }

                this.category = slug;
                const res1 = await this.$store.dispatch('GET_PRODUCTS', body);
            },

            submit(e) {
                e.preventDefault();
                const min = document.getElementsByClassName('ps-slider__min')[0].innerText;
                const max = document.getElementsByClassName('ps-slider__max')[0].innerText;
                const cate_val = (this.category == '') ? -1 : this.category;
                const body ={
                    word: this.word,
                    by: this.by,
                    min_price: min,
                    max_price: max,
                    category: cate_val,
                    page: 1
                }

                const res = this.$store.dispatch('GET_PRODUCTS', body);
            }
        },

        created: async function() {
            const res = await this.$store.dispatch('GET_CATEGORIS');
            const res1 = await this.$store.dispatch('GET_LOCALIZATION_SETTINGS');
        }
    }
</script>
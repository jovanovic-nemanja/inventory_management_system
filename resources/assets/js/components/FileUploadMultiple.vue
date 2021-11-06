<template>
    <div class="">
        <loading :active.sync="isLoading" 
            :can-cancel="true" 
            :on-cancel="onCancel"
            :is-full-page="fullPage"></loading>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="name" name="name" placeholder="Name" v-model="product.name">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-8">
                <select required name="category_id" id="category_id" class="form-control js-example-basic-single" placeholder="Category" style="width: 100%;" v-model="selected">
                    <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Unit</label>
            <div class="col-sm-8">
                <select required name="unit_id" id="unit_id" class="form-control js-example-basic-single" placeholder="Unit" style="width: 100%;" v-model="selectedunit">
                    <option v-for="unit in units" :value="unit.id" :key="unit.id">{{ unit.name }}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="MOQ" class="col-sm-2 col-form-label">MOQ</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="MOQ" name="MOQ" placeholder="MOQ" v-model="product.MOQ">
            </div>
        </div>
        <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" v-model="product.quantity">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-8">
                <input type="hidden" name="description" class="description" :value="product.description" />
                <div id="quillExample1" class="quill-container" style="height: 20rem;">
                </div>
            </div>
        </div>
        <br><br>
        <div class="form-group row">
            <label for="meta_title" class="col-sm-2 col-form-label">Meta Title</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" v-model="product.meta_title">
            </div>
        </div>
        <div class="form-group row">
            <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" v-model="product.meta_description">
            </div>
        </div>
        <div class="form-group row">
            <label for="meta_keywords" class="col-sm-2 col-form-label">Meta Keywords</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" v-model="product.meta_keywords">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price ( From, To )</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="price_from" name="price_from" placeholder="Price From" required v-model="product.price_from">
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="price_to" name="price_to" placeholder="Price To" required v-model="product.price_to">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Product Images</label>
            <div class="col-md-8">
                <div class="large-12 medium-12 small-12 filezone">
                    <input type="file" id="files" name="images[]" ref="files" multiple v-on:change="handleFiles()"/>
                    <p>
                        Drop your files here <br>or click to search
                    </p>
                </div>

                <div>
                    <div v-for="image in images_item" :key="image.id" class="file-listing" :id="image.id">
                        <img class="preview" v-bind:ref="'preview'+parseInt(image.id)" v-bind:src="urls + image.url" />
                        {{ image.url }}
                        <div class="remove-container">
                            <a class="remove" v-on:click="removePhoto(image.id)">Remove</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div v-for="(file, key) in files" :key="file.id" class="file-listing">
                        <img class="preview" v-bind:ref="'preview'+parseInt(key)"/>
                        {{ file.name }}
                        <div class="remove-container">
                            <a class="remove" v-on:click="removeFile(key)">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <a style="color: #fff;" class="ps-btn float-right btn-flat hidden_btn" v-on:click="submitFiles()" :disabled="isSuspend">Save Product</a>
    </div>
</template>
<script>
    import JQuery from "jquery";
    let $ = JQuery;
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default{
        props: ['images', 'urls', 'categoriesjson', 'unitsjson', 'actions_urls', 'productinfo'],

        data(){
            return {
                files: [],
                selected: 1,
                selectedunit: 1,
                images_item: [],
                categories: [],
                units: [],
                product: [],
                is_addpage: true,
                isLoading: false,
                fullPage: true,
                key: '',
                isSuspend: false,
            }
        },

        components: {
            Loading
        },

        methods: {
            onCancel() {
                console.log('User cancelled the loader.')
            },
            removeFile( key ){
                this.files.splice( key, 1 );
                this.getImagePreviews();
            },
            removePhoto(id) {
                $('#'+id).remove();
                
                axios
                .post("/image/deleteimage/" + id)
                .then(res => {
                    this.images_item = JSON.parse(res.data);
                })
                .catch(err => {
                    
                });
            },
            handleFiles() {
                let uploadedFiles = this.$refs.files.files;

                for(var i = 0; i < uploadedFiles.length; i++) {
                    if(uploadedFiles[i].size >= 50000) {
                        alert("Maximum photo upload size is 500 KByte. Please choose another photo.");
                        return;
                    }
                    
                    this.files.push(uploadedFiles[i]);
                }
                this.getImagePreviews();
            },
            getImagePreviews(){
                for( let i = 0; i < this.files.length; i++ ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['preview'+parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.files[i] );
                    }else{
                        this.$nextTick(function(){
                            this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                        });
                    }
                }
            },
            submitFiles() {
                const name = this.product.name;
                const meta_title = this.product.meta_title;
                const meta_description = this.product.meta_description;
                const meta_keywords = this.product.meta_keywords;
                const category = $('#category_id').val();
                const unit_id = $('#unit_id').val();
                const MOQ = $('#MOQ').val();
                const quantity = $('#quantity').val();
                const description = $('#quillExample1 .ql-editor');
                var value = description[0].innerHTML;
                const price_from = this.product.price_from;
                const price_to = this.product.price_to;
                if(!name) {
                    alert('Name is required!');
                    return;
                }
                if(!category) {
                    alert('Category is required!');
                    return;
                }
                if(!unit_id) {
                    alert('Unit is required!');
                    return;
                }
                if(!MOQ) {
                    alert('MOQ is required!');
                    return;
                }
                if(!quantity) {
                    alert('Quantity is required!');
                    return;
                }
                if ($('#quillExample1 .ql-editor').children().text() == '') {
                    alert('Description is required.');
                    return;
                }
                $('.description').val('');
                $('.description').val(value);

                if(!meta_title) {
                    alert('Meta title is required!');
                    return;
                }
                if(!meta_description) {
                    alert('Meta description is required!');
                    return;
                }
                if(!meta_keywords) {
                    alert('Meta keywords is required!');
                    return;
                }

                if(!price_from) {
                    alert('Price from is required!');
                    return;
                }
                if(!price_to) {
                    alert('Price to is required!');
                    return;
                }

                const images_arr = $('.file-listing');

                if(!images_arr.length) {
                    alert('Please choose product image!');
                    return;
                }

                this.isLoading = true;
                this.isSuspend = true;

                let formData = new FormData();
                for (var x = 0; x < this.files.length; x++)
                    formData.append('images[]', this.files[x]);
                
                formData.append('product_id', this.product.id);
                formData.append('name', name);
                formData.append('category_id', category);
                formData.append('unit_id', unit_id);
                formData.append('MOQ', MOQ);
                formData.append('quantity', quantity);
                formData.append('description', value);
                formData.append('meta_title', meta_title);
                formData.append('meta_description', meta_description);
                formData.append('meta_keywords', meta_keywords);
                formData.append('price_from', price_from);
                formData.append('price_to', price_to);
                axios.post(this.actions_urls,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(data) {
                    this.isSuspend = false;
                    window.location.href = data.data.redirect_urls;
                }.bind(this)).catch(function(data) {
                    console.log('error');
                });
            }
        },
        created: function() {
            if(this.categoriesjson) {
                this.categories = JSON.parse(this.categoriesjson);
            }
            if(this.unitsjson) {
                this.units = JSON.parse(this.unitsjson);
            }
            if(this.images) {
                this.images_item = JSON.parse(this.images);
            }else{
            }
            if(this.productinfo){
                this.product = JSON.parse(this.productinfo);
                this.selected = this.product.category_id;
                this.selectedunit = this.product.unit;
            }

            this.isLoading = false;
            this.isSuspend = false;

            $(document).ready(function() {
                $('#quillExample1 .ql-editor').empty();
                var element = $('#quillExample1 .ql-editor');
                var value = $('.description').val();
                element.append(value);
            });
        }
    }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }
    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }

    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>
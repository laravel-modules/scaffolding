<template>
    <div class="row uploader">
        <div class="col-6 col-sm-4 col-md-3 px-3 col-lg-2" v-for="file in files">
            <div class="img-item mw-100 mb-4">
                <img class="mw-100" :src="file.conversions.large" alt="">
                <a class="delete" href="#"
                   title="Delete Image"
                   @click.prevent="deleteFile(file)">
                    <div class="fas fa-times"></div>
                </a>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 px-3 col-lg-2" v-for="i in max - files.length">
            <label class="img-item add mw-100 mb-4">
                <input class="d-none" ref="file" type="file" @change="readUrl" accept="image/jpeg,image/png,image/jpg,image/gif" multiple>
                <img class="mw-100" v-if="i <= pending" src="/images/loading-100.gif" alt="">
                <img class="mw-100" v-else src="/images/plus-circle-solid.svg" alt="">
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            max: {
                default: 12
            },
            media: {
                required: false,
            }
        },
        data() {
            return {
                files: this.media || [],
                values: [],
                inputFilesLength: 0,
                pending: -1,
            }
        },
        created() {
            this.values = this.files.map(file => {
                return file.id
            });
            this.complete();
        },
        methods: {
            readUrl(event) {
                this.$emit('beforeUpload');
                let input = event.target;
                if (input.files) {
                    let fileList = input.files;

                    let filesCount = fileList.length > this.max ? this.max : fileList.length;

                    this.inputFilesLength = filesCount;

                    this.pending = filesCount;
                    for (let i = 0; i < filesCount; i++) {
                        let filename = fileList[i].name;
                        var reader = new FileReader();

                        reader.onload = (event) => {
                            axios.post('/api/media/upload', {
                                image: event.target.result,
                                filename,
                            }).then(response => {
                                this.pending--;

                                let file = response.data.data;

                                this.files.push(file);

                                this.values.push(file.id);

                                this.complete();
                            })
                            .catch(error => {
                                this.pending--;
                                alert('The given data was invalid.');
                                this.complete();
                            });


                            input.value = '';
                        };

                        reader.readAsDataURL(input.files[i]);
                    }
                }
            },
            deleteFile(file) {
                if (file.data) {
                    return;
                }
                axios.delete(file.links.delete.href).then((response) => {
                    this.$delete(this.files, this.files.indexOf(file));
                });
                this.$delete(this.values, this.files.indexOf(file));
                this.inputFilesLength--;
                this.complete();
            },
            complete() {
                if(this.values.length >= this.inputFilesLength) {
                    this.$emit('complete', this.values);
                }
            }
        }
    }
</script>

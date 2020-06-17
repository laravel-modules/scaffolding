<template>
    <div class="form-group">
        <label>{{ label }}</label>
        <div class="row uploader">
            <div class="col-6 col-sm-4 col-md-3 px-3 col-lg-2" v-for="file in files">
                <div class="img-item mw-100 mb-4" :title="file.file_name">
                    <img class="mw-100" :src="file.preview" alt="">
                    <a class="delete" href="#"
                       title="Delete File"
                       @click.prevent="deleteFile(file)">
                        <div class="fas fa-times"></div>
                    </a>
                    <span class="size">{{ file.human_readable_size }}</span>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 px-3 col-lg-2"
                 v-for="i in (max - files.length < 0 ? 0 : max - files.length)">
                <label class="img-item add mw-100 mb-4">
                    <input class="d-none" ref="file" type="file" @change="readUrl"
                           :accept="accept" :multiple="max > 1">
                    <img class="mw-100" v-if="i <= pending" src="/images/loading-100.gif" alt="">
                    <img class="mw-100" v-else src="/images/plus-circle-solid.svg" alt="">
                </label>
            </div>
        </div>
        <input type="hidden" name="media[]" v-for="token in values" :value="token">
        <small class="text-muted">{{ notes }}</small>
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
                type: Array,
                default: []
            },
            accept: {
                required: false,
                type: String,
                default: '*',
            },
            notes: {
                required: false,
                type: String,
                default: '',
            },
            label: {
                required: false,
                type: String,
                default: '',
            },
            collection: {
                required: false,
                type: String,
                default: '',
            },
            tokens: {
                required: false,
                type: Array,
                default: [],
            }
        },
        data() {
            return {
                files: this.media || [],
                values: this.tokens,
                inputFilesLength: 0,
                pending: -1,
            }
        },
        created() {
            if (this.tokens.length) {
                axios.get('/api/media', {
                    params: {
                        tokens: this.tokens
                    }
                }).then(response => {
                    this.files = response.data.data;
                });
            }
        },
        methods: {
            async readUrl(event) {
                this.$emit('beforeUpload');
                let input = event.target;
                if (input.files) {
                    let fileList = input.files;

                    let filesCount = fileList.length > this.max - this.files.length
                        ? this.max - this.files.length : fileList.length;

                    this.inputFilesLength = filesCount;

                    this.pending = filesCount;

                    for (let i = 0; i < filesCount; i++) {
                        await this.upload(fileList[i])
                            .then(response => {
                                this.pending--;

                                let file = response.data.data;

                                this.files.push(file[0]);

                                this.values.push(response.data.token);

                                this.complete();
                            })
                            .catch(error => {
                                this.pending--;
                                this.complete();
                            });

                    }
                }
            },
            upload(file) {
                return new Promise((resolve, reject) => {
                    this.beforeUploading();
                    let formData = new FormData();
                    formData.append('file', file);
                    formData.append('collection', this.collection);
                    axios.post('/api/media/upload', formData)
                        .then(response => {
                            resolve(response);
                        })
                        .catch(error => {
                            reject(error);
                        });
                });
            },
            deleteFile(file) {
                if (file.data) {
                    return;
                }
                axios.delete(file.links.delete.href).then(() => {
                    this.$delete(this.files, this.files.indexOf(file));
                });
                this.$delete(this.values, this.files.indexOf(file));
                this.inputFilesLength--;
                this.complete();
            },
            beforeUploading() {
                $('[type=submit]').attr('disabled', 'disabled');
            },
            complete() {
                if (this.values.length >= this.inputFilesLength) {
                    $('[type=submit]').removeAttr('disabled');
                }
            }
        }
    }
</script>

<template>
    <div class="form-group">
        <label :for="name">{{ label }}</label>
        <select ref="select" class="form-control" :name="name" :id="name" v-model="selected">
            <option value="">{{ selectText }}</option>
            <option v-for="item in items.data" :value="item.id">{{ item.text }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                required: true,
                type: String,
            },
            label: {
                required: true,
                type: String,
            },
            selectText: {
                required: true,
                type: String,
            },
            remoteUrl: {
                required: true,
                type: String,
            },
            value: {
                required: false,
                type: String,
            },
        },
        data() {
            return {
                items: [],
                selected: '',
            }
        },
        mounted() {
            if (this.value) {
                axios.get(this.remoteUrl+`?selected_id=${this.value}`).then(response => {
                    this.items = response.data;
                    this.selected = this.value;
                });
            }
            let dir = $('html').attr('dir');
            $(this.$refs.select).select2({
                theme: 'bootstrap4',
                dir,
                ajax: {
                    url: this.remoteUrl,
                    dataType: 'json',
                    delay: 250,
                    data: (params) => {
                        return {
                            selected_id: this.value,
                            name: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {

                        this.items = data;
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 15) < data.meta.total
                            }
                        };
                    },
                    cache: true
                },
                language: {
                    errorLoading: () => {
                        return this.$t('select2.errorLoading');
                    },
                    inputTooLong: args => {
                        let overChars = args.input.length - args.maximum;

                        return this.$t('select2.inputTooLong', {overChars});
                    },
                    inputTooShort: args => {
                        let remainingChars = args.minimum - args.input.length;

                        return this.$t('select2.inputTooShort', {remainingChars});
                    },
                    loadingMore: () => {
                        return this.$t('select2.loadingMore');
                    },
                    maximumSelected: args => {
                        let maximum = args.maximum;

                        return this.$t('select2.maximumSelected', {maximum});
                    },
                    noResults: () => {
                        return this.$t('select2.noResults');
                    },
                    searching: () => {
                        return this.$t('select2.searching');
                    },
                    removeAllItems: () => {
                        return this.$t('select2.removeAllItems');
                    }
                },
                templateResult: this.formatRepo,
                templateSelection: this.formatRepoSelection
            });
            $(document).on('change', this.$refs.select, (e) => {
                this.selected = e.target.value;
            });
        },
        methods: {
            formatRepo(item) {
                if (item.loading) {
                    return this.$t('select2.searching');
                }
                let $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'>" +
                    "<img src='" + item.image + "' />" +
                    "</div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(item.text);

                return $container;
            },
            formatRepoSelection(item) {
                return item.text || this.selectText;
            },
        }
    }
</script>

<style>
    .select2-result-repository__avatar, .select2-result-repository__meta {
        display: inline-block;
    }

    .select2-result-repository__title {
        margin: 0 10px;
    }

    .select2-result-repository__avatar img {
        width: 30px;
        border-radius: 50%;
    }

    .select2-container .select2-selection--single {
        height: 34px;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #d2d6de;
        border-radius: 0;
    }
</style>

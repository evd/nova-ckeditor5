Nova.booting((Vue, router) => {
    Vue.component('index-nova-ckeditor5', require('./components/IndexField').default)
    Vue.component('detail-nova-ckeditor5', require('./components/DetailField').default)
    Vue.component('form-nova-ckeditor5', require('./components/FormField').default)
})

export default class NovaCKEditor5UploadAdapter {
    constructor (loader) {
        this.loader = loader
    }

    upload () {
        return this.loader.file
            .then((file) => {
                const data = new FormData()
                data.append('Content-Type', file.type)
                data.append('attachment', file)

                return Nova.request()
                    .post(`/nova-vendor/nova-ckeditor5/upload`, data, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        if (response.data.uploaded) {
                            return {
                                default: response.data.url
                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                        return Promise.reject(error)
                    })
            })
    }

    abort () {

    }
}

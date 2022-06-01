<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <textarea ref="editor" class="hidden" :id="field.attribute" :class="errorClasses" :value="value" />
        </template>
    </default-field>
</template>

<script>
import CkEditor from '../ckeditor/ckeditor'
import NovaCKEditor5UploadAdapter from '../ckeditor/plugins/upload-adapter'

import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],
    props: ['resourceName', 'resourceId', 'field', 'toolbar'],
    methods: {
        setInitialValue() {
            this.value = this.field.value || ''
        },

        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        handleChange(value) {
            this.value = value
        },

        handleEditorEvents(event, data) {
            if (['Tab', '/'].includes(data.key) || [191, 9].includes(data.keyCode)) {
                data.stopPropagation()
            }
        },

        handleEditorSync() {
            this.handleChange(this.$options.editor.getData())
        },
        uuid() {
            return crypto.getRandomValues(new Uint32Array(4)).join('-')
        },
    },
    created() {
        this.$options.uuid = this.uuid()
    },
    mounted() {
        /**
         * Create CKEditor upload adapter plugin.
         */
        function createUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = function( loader ) {
                return new NovaCKEditor5UploadAdapter(loader)
            }
        }

        const config = {
            attribute: this.$options.uuid,
            language: {
                ui: this.field.language,
                content: this.field.contentLanguage
            },
            toolbar: {
                items: this.field.toolbar,
                shouldNotGroupWhenFull: this.field.shouldNotGroupWhenFull
            },
            ...this.field.options,
            extraPlugins: [
                createUploadAdapterPlugin
            ]
        }

        CkEditor.create(this.$refs.editor, config)
            .then((editor) => {
                const {editing, model} = this.$options.editor = editor

                // prevent question-mark & slash from triggering nova search
                editing.view.document.on('keydown', this.handleEditorEvents, {
                    priority: 'highest'
                })

                // sync model changes to vue-model
                model.document.on('change', this.handleEditorSync, {
                    priority: 'lowest'
                })

                // set the height of the editor when editing
                if (this.field.height > 1) {
                    editor.editing.view.change(writer => {
                        writer.setStyle('height', `${this.field.height}px`, editor.editing.view.document.getRoot());
                    });
                }
            })
            .catch((e) => {
                this.$toasted.show(e.toString(), {type: 'error'})
            })
    },
    beforeDestroy() {
        if (this.$options.editor) {
            this.$options.editor.destroy()
                .then(() => this.$options.editor = null)
                .catch((e) => this.$toasted.show(e.toString(), {type: 'error'}))
        }
    }
}
</script>

<style lang="sass">
.ck.ck-reset_all, .ck.ck-reset_all *
    direction: ltr !important

.ck-content.ck-editor__editable
    resize: vertical

.ck.ck-reset.ck-editor
    .ck.ck-toolbar
        border-radius: 10px 10px 0 0

    .ck-editor__editable_inline
        border-radius: 0 0 10px 10px
        margin: 0
        padding: 0 10px
        @import "../../sass/field"

    .ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-focused
        box-shadow: none
</style>

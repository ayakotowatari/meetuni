<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                <span class="headline">Ask a question</span>
                </v-card-title>
                <v-card-subtitle>
                    The organiser will try their best to answer your questions during the event.
                </v-card-subtitle>
                <v-card-text>
                    <v-container>
                        <v-form ref="form">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-select
                                        v-model="selectedCategory"
                                        :items="categories"
                                        item-text="category"
                                        item-value='id'
                                        label="Select Categories"
                                        :rules="categoriesRules" 
                                        chips
                                        hint="What are your questions about?"
                                        persistent-hint
                                        required
                                        :error="allerror.category"
                                        :error-messages="allerror.category"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" sm="12" md="12">
                                    <v-textarea
                                        v-model="queryContents"
                                        counter
                                        label="Questions"
                                        rows="5"
                                        :rules="textareaRules"
                                        :error="allerror.contents"
                                        :error-messages="allerror.contents"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                    <small>*indicates required field</small>
                    <p>By clicking Confirm you agree that your questions will be shared with the organiser.</p>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey darken-1" text @click="closeDialog">Not Now</v-btn>
                <v-btn color="info darken-1" text @click="save">Confirm</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        user: Object,
        event: Object,
        dialog: Boolean
    },
    data: function(){
        return{
            selectedCategory: '',
            categoriesRules: [
                v => !!v || 'Category is required',
            ],
            queryContents: '',
            textareaRules: [
                v => !!v || v.length <= 200 || 'Max 200 characters'
            ],
        }
    },
    mounted(){
        this.$store.dispatch('studentaccount/fetchCategories');
    },
    computed: {
        ...mapState('studentaccount', [
            'categories',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('studentaccount', {
            closeDialog: 'closeDialog'
        }),
        ...mapActions('studentaccount', [
            'saveQuestions'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.saveQuestions({
                    id: this.user.id,
                    event_id: this.event.id,
                    category_id: this.selectedCategory,
                    contents: this.queryContents
                })
            }
        }
    }
}
</script>

<style>

</style>
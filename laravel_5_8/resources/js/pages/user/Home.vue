<template>
    <div class="md-layout md-alignment-top-center">
        <notifications></notifications>

        <div class="md-layout-item md-small-size-100" style="margin-top: 30px;">
            <form>
                <div v-for="(item, id) in questions" class="md-layout-row" v-bind:key="id">
                    <md-card md-with-hover class="quiz-item text-center">
                        <md-card-header>
                            <div class="md-title">{{ item.question_str }}</div>
                        </md-card-header>
                        <md-card-content>
                            <div class="quiz-label" style="color: red;" >Disagree</div>
                                <md-radio v-model="item.value" value="1"></md-radio>
                                <md-radio v-model="item.value" value="2"></md-radio>
                                <md-radio v-model="item.value" value="3"></md-radio>
                                <md-radio v-model="item.value" value="4"></md-radio>
                                <md-radio v-model="item.value" value="5"></md-radio>
                                <md-radio v-model="item.value" value="6"></md-radio>
                                <md-radio v-model="item.value" value="7"></md-radio>
                            <div class="quiz-label" style="color: green;">Agree</div>

                            <div class="md-error" v-if="touched && !$v.questions.$each[id].value.required">Please select the option</div>
                        </md-card-content>
                    </md-card>
                </div>
                <span class="md-error" v-if="touched && $v.$invalid">Please input valid all fields</span>
                <div class="md-layout-row mt-20">
                    <div class="md-headline text-center">
                        Your Email
                    </div>
                    <md-field :class="{ 'md-invalid' : touched && $v.$invalid}">
                        <label>Please input your email</label>
                        <md-input v-model="email" required></md-input>
                        <md-icon>email</md-icon>
                        <span class="md-error" v-if="!$v.email.required">Please input email</span>
                        <span class="md-error" v-else-if="!$v.email.email">Please input valid email</span>
                    </md-field>
                </div>
                <div class="md-layout-row mt-20 mb-100 text-center">
                    <md-button class="md-primary md-raised" @click="submit" style="align-self: center;">
                        Submit
                    </md-button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { http } from "../../services/http";
import { validationMixin } from 'vuelidate';
import {
  required,
  email,
  minLength
} from 'vuelidate/lib/validators';

export default {
    mixins: [validationMixin],
    data(){
        return {
            questions: [
                {
                    id  :   1,
                    question_str: "You find it takes effort to introduce yourself to other people.",
                    value: null,
                },
                {
                    id  :   2,
                    question_str: "You consider yourself more practical than creative.",
                    value: null,
                },
                {
                    id  :   3,
                    question_str: "Winning a debate matters less to you than making sure no one gets upset.",
                    value: null,
                },
                {
                    id  :   4,
                    question_str: "You get energized going to social events that involve many interactions.",
                    value: null,
                },
            ],
            email: "test@hotmail.com",

            touched: null
        }
    },
    validations: {
        questions: {
            required,
            $each: {
                id : {
                    required,
                },
                value: {
                    required
                }
            }
        },
        email : {
            email,
            required
        }
    },
    mounted(){
        this.$store.dispatch('result/clearResult');
        if(this.isLoading){
            return;
        }
        this.isLoading = true;
        http.get('questions')
            .then(( response ) => {
                this.isLoading = false;
                if(this.checkSucces(response)){
                    this.questions = response.data.questions
                }else{
                    this.$store.dispatch('alerts/error', "Connection Error");
                }
            })
            .catch( (response) => {
                this.isLoading = false;
                console.log(response)
                this.$store.dispatch('alerts/error', "Server side error")
            })
    },
    computed: {
        getEmailFieldClass(){
            this.$v.$invalid
        }
    },
    methods: {
        checkSucces(response, msg = null){
            if(response.status && response.status == 200){
                if(msg){
                    this.$store.dispatch('alerts/success', msg);
                }
                return true;
            }else{
                this.$store.dispatch('alerts/error', this.$t('Server Error'));
                return false;
            }
        },
        handleHttpError(response, msg = null){
            this.$store.dispatch("alerts/error", msg || 'Action Failed');
        },
        submit(){
            if(this.isLoading){
                return;
            }
            this.$v.$touch()
            this.touched = true;
            if(this.$v.$invalid){
                // console.log(this.$v.$invalid)
                return;
            }
            this.isLoading = true;
            http.post('submit', false, {
                'result'   : this.questions,
                'email'     :   this.email,
            })
            .then((response) => {
                console.log(response)
                this.isLoading = false;

                if(this.checkSucces(response)){
                    this.$store.dispatch('result/saveResult', response.data)
                        .then(() => {
                            location.href="/result"
                        })
                }else{
                    this.$store.dispatch('alerts/error', "Connection Error");
                }
            })
            .catch( ( response) => {
                console.log(response)
                this.isLoading = false;
                this.handleHttpError( response)
            })
        }
    }
}
</script>
<style scoped>
.quiz-item{
    margin: 10px;
}
.quiz-label{
    display: inline-block;
    font-size: 1.5em;
    padding: 10px;

}
.md-error{
    color: #ff0000;
}
</style>
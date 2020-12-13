<template>
    <div class="md-layout">
        <div class="md-layout-item md-size-100">
            <md-card>
                <md-card-header class="md-card-header-icon md-card-header-green">
                    <div class="card-icon">
                        <md-icon>assignment</md-icon>
                    </div>
                    <h4 class="title">Your MBTI tests</h4>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout md-alignment-top-center ">
                        <div class="md-layout-item md-size-30 md-small-size-100">
                            <md-table
                                :value="quiz_results"
                                :md-sort.sync="sortation.field"
                                :md-sort-order.sync="sortation.order"
                                :md-sort-fn="customSort"
                                @md-selected="onSelect"
                                class="paginated-table table-striped table-hover">
                                <md-table-toolbar style="padding-bottom: 20px!important;">
                                    <md-field>
                                        <label>Per page</label>
                                        <md-select v-model="pagination.perPage" name="pages">
                                            <md-option
                                                v-for="item in pagination.perPageOptions"
                                                :key="item"
                                                :label="item"
                                                :value="item">
                                                {{ item }}
                                            </md-option>
                                        </md-select>
                                    </md-field>
                                </md-table-toolbar>
                                <md-table-row slot="md-table-row" slot-scope="{ item }" :class="getRowClass(item)" md-selectable="single">
                                    <md-table-cell md-label="Tested At" md-sort-by="created_at">{{ item.created_at }}</md-table-cell>
                                    <md-table-cell md-label="mbti">{{ item.mbti }}</md-table-cell>
                                </md-table-row>
                            </md-table>
                            <div>
                                <div class="">
                                    <p class="card-category">
                                    {{ from + 1 }} - {{ to }} / {{ total }}
                                    </p>
                                </div>
                                <pagination
                                    class="pagination-no-border pagination-success"
                                    v-model="pagination.currentPage"
                                    :per-page="pagination.perPage"
                                    :total="total"
                                    @input="paginate"
                                />
                            </div>
                        </div>
                        <div class="md-layout-item md-size-60 md-small-size-100">
                            <div v-if="questions">
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
                                        </md-card-content>
                                    </md-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </md-card-content>
            </md-card>
        </div>
    </div>
    
</template>
<script>
import Pagination from "../../components/Pagination";
import { http } from "../../services/http"

export default {
    components: {
        "pagination" : Pagination,
    },
    data(){
        return {
            pagination: {
                perPage: 5,
                currentPage: 1,
                perPageOptions: [5, 10, 25, 50]
            },
            total: 0,
            sortation: {
                field: "created_at",
                order: "desc"
            },

            selected : null,
            quiz_results: [
                {
                    mbti: "ESTP",
                    created_at: "2010-10-23"
                },
                {
                    mbti: "ESTP",
                    created_at: "2010-10-23"
                },
                {
                    mbti: "ESTP",
                    created_at: "2010-10-23"
                }
            ],
            questions: [
                {
                    question_str: "You often spend time exploring unrealistic and impractical yet intriguing ideas.",
                    value: "2"
                },
                {
                    question_str: "You consider yourself more practical than creative.", 
                    value: "3"
                }
            ],
        }
    },
    methods: {
        customSort() {
            this.getList();
            return true;
        },
        onSelect(item){
            this.selected = item
            if(this.isLoading || !item) return;

            this.isLoading = true;
            http.get('questions/' + item.id, true)
                .then((response) => {
                    this.isLoading = false;
                    this.questions = response.data;
                })
                .catch(({response}) => {
                    this.isLoading= false;
                    this.handleError(response);
                })
        },
        getRowClass(item){
            return {
                'md-primary'  : this.selected == item,
            }
        },
        getList(){
            if(this.isLoading) return;
            this.isLoading = true;

            http.get('get/?per_page=' + this.pagination.perPage + '&page=' + this.pagination.currentPage 
                + '&sort_field=' + this.sortation.field + '&sort_order=' + this.sortation.order, true)
                .then( (response) => {
                    this.isLoading = false;
                    if(response.data){
                        this.quiz_results = response.data.data;
                        this.pagination.perPage = parseInt(response.data.per_page);
                        this.pagination.currentPage = parseInt(response.data.current_page);
                        this.total = parseInt(response.data.total);
                    }
                })
                .catch(({response}) => {
                    this.isLoading = false;
                    this.handleError(response);
                })
        },
        paginate(page){
            this.currentPage = page;
            this.getList();
        },

        handleError(response) {
            if( response && response.status && response.status == 401){
                this.$store.dispatch('logout')

            }else{
                this.$store.dispatch("alerts/error", this.$t("Action Failed"));
            }
        },
    },
    created(){
        this.getList();
    },
    computed: {
        sort(){
            if (this.sortation.order === "desc") {
                return `-${this.sortation.field}`
                }
            return this.sortation.field;
        },
        from(){
            return this.pagination.perPage * (this.pagination.currentPage - 1);
        },
        to() {
            let highBound = this.from + this.pagination.perPage;
            console.log(highBound)
            if (this.total < highBound) {
                highBound = this.total;
            }
            return highBound;
        },
    }
}
</script>

<style scoped>
.quiz-label{
    display: inline-block;
    font-size: 1.5em;
    padding: 10px;

}
</style>
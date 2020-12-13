<template>
    <div class="wrapper">
        <div class="main-panel">
            <zoom-center-transition :duration="200" mode="out-in">
                <div class="perspective">
                    <div class="md-layout md-alignment-top-center">
                        <div class="md-layout-item md-size-40 md-small-size-100" style="margin: auto; padding: 10px;">
                            <div class="md-display-1 place-center header-title">Your Perspective</div>
                            <div class="md-subheading place-center">Your Perspective Type is {{ scoreString }}</div>
                        </div>
                        <div class="md-layout-item md-size-60 md-small-size-100" style="margin-top: 30px; margin-bottom: 30px;">
                            <div class="md-layout md-alignment-top-center mt-10 mb-10">
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Introversion (I)</div>
                                </div>
                                <div class="md-layout-item md-size-40 ">
                                    <span class="bar left" :class="{active : mbti.EI == 1}"></span>
                                    <span class="bar right" :class="{active : mbti.EI == -1}"></span>
                                </div>
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Extroversion (E)</div>
                                </div>
                            </div>
                            <div class="md-layout md-alignment-top-center mt-10 mb-10">
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Sensing (S)</div>
                                </div>
                                <div class="md-layout-item md-size-40">
                                    <span class="bar left" :class="{active : mbti.SN == -1}"></span>
                                    <span class="bar right" :class="{active : mbti.SN == 1}"></span>
                                </div>
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Intuition (N)</div>
                                </div>
                            </div>
                            <div class="md-layout md-alignment-top-center mt-10 mb-10">
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Thinking (T)</div>
                                </div>
                                <div class="md-layout-item md-size-40">
                                    <span class="bar left" :class="{active : mbti.TF == -1}"></span>
                                    <span class="bar right" :class="{active : mbti.TF == 1}"></span>
                                </div>
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Feeling (F)</div>
                                </div>
                            </div>
                            <div class="md-layout md-alignment-top-center mt-10 mb-10">
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Judging (J)</div>
                                </div>
                                <div class="md-layout-item md-size-40">
                                    <span class="bar left" :class="{active : mbti.JP == -1}"></span>
                                    <span class="bar right" :class="{active : mbti.JP == 1}"></span>
                                </div>
                                <div class="md-layout-item md-size-20 text-wrap">
                                    <div class="md-body-1">Perceiving (P)</div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </zoom-center-transition>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            mbti : {
                EI : 0,
                SN : 0,
                TF : 0,
                JP : 0,
            }
        }
    },

    mounted(){
        this.mbti = this.$store.getters['result/result'] // || {EI : 0,SN : 0,TF : 0,JP : 0,}
        console.log(this.mbti)
    },
    computed: {
        scoreString(){
            if(this.mbti){
                return Object.entries(this.mbti).reduce((str, value) => {
                    let key = value[0];
                    return str + (value[1] == -1 ? key.split("")[0] : key.split("")[1])
                }, "")
            }else{
                return "????"
            }
        }
    }
}
</script>
<style scoped>
.main-panel {
    padding: 20px;
    margin: 30px;
    margin-top: 50px;
}
.perspective{
    border: 1px solid #ccc;
}
.bar{
    min-width: 45%;
    min-height: 13px;
    background: #ccc;
    display: inline-block;
    margin: 0 -5px;
    
}
.bar.left{
    border-radius: 5px 0 0 5px;
}
.bar.right{
    border-radius: 0 5px 5px 0;
}
.active{
    background: rgb(169,32,203);
}
.text-wrap{
    overflow-wrap: break-word;
}
.place-center{
    padding-left: calc((100% - 300px)/2);
}
.header-title{
    color: rgb(17,50,100) !important;
}
</style>
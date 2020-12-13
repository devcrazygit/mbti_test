<template>
    <div class="full-page">
        <md-toolbar md-elevation="0" class="md-transparent md-toolbar-absolute">
        <div class="md-toolbar-row md-offset">
            <div class="md-toolbar-section-start">
                <h1 class="header-dark-blue header-title">Discover your perspective</h1>
                <p class="md-subheading">Complete the 7min test and get a detailed report of your lenses on the world</p>
            </div>
            
        </div>
        </md-toolbar>
        <div class="wrapper wrapper-full-page mt-20">
            <div
                class="page-header header-filter"
                filter-color="white">
                <div class="container md-offset">
                    <zoom-center-transition :duration="200" mode="out-in">
                        <router-view/>
                    </zoom-center-transition>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.header{
    min-height: 100px;
    text-align: center;
    padding: 50px;
    font-size: 50px;
    box-shadow: 3px 2px 5px #888;
}
.page-header:before{
    background: #fff;
}
.header-dark-blue{
    color: rgb(17,50,100) !important;
}
.header-title{
    font-weight: bold;
    font-size: 2em;
    white-space: pre-wrap;
    
    height: initial;
    line-height: 1.2;
}
.md-subheading{
    font-size: 1.5em;
}
.md-toolbar-section-start{
    display: block;
}
.md-toolbar-row{
    padding: 20px;
}
.page-header > .container{
    padding-top: 120px;
}
</style>
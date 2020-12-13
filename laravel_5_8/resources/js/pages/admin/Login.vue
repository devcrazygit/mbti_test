<template>
  <div class="full-page">
    <md-toolbar md-elevation="0" class="md-transparent md-toolbar-absolute">
      <div class="md-toolbar-row md-offset">
        <div class="md-toolbar-section-start">
          <h3 class="md-title">Login</h3>
        </div>
      </div>
    </md-toolbar>
    <div class="wrapper wrapper-full-page" :style="setBgImage">
      <notifications/>
      <div
        class="page-header header-filter"
        filter-color="black"
        >
        <div class="container md-offset">
          <zoom-center-transition
            :duration="duration"
            mode="out-in">
            <div class="md-layout text-center login-fix-page">
                <div class="md-layout-item md-size-33 md-medium-size-50 md-small-size-70 md-xsmall-size-100">
                    <form @submit.prevent="login">
                        <login-card header-color="green">
                        <h4 slot="title" class="title"><md-icon style="color: #fff;">fingerprint</md-icon>Login</h4>
                        <md-field
                            class="form-group"
                            slot="inputs"
                            style="margin-bottom: 28px">
                            <md-icon>email</md-icon>
                            <label>Email...</label>
                            <md-input v-model="email" type="email" />
                        </md-field>
                        <!-- <md-field class="form-group" slot="inputs">
                            <md-icon>lock_outline</md-icon>
                            <label>Password...</label>
                            <md-input v-model="password" type="password" />
                        </md-field> -->
                        <md-button
                            slot="footer"
                            type="submit"
                            class="md-simple md-success md-lg"
                        >
                            Login
                        </md-button>
                        </login-card>
                    </form>
                </div>
            </div>
          </zoom-center-transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginCard from "../../components/LoginCard"
import { http } from "../../services/http";

export default {
    components: {
        LoginCard
    },
    data(){
        return {
            email: "test@hotmail.com",
            duration : 300
        }
    },
    methods: {
        async login() {
            const user = {
                email: this.email,
            };
            this.$store.dispatch('login', user);
        },
    },
    computed: {
        setBgImage() {
            return {
                background: `url(/img/login.jpg)`,
                backgroundSize: 'cover'
            };
        },
    }
}
</script>

<style lang="scss" scoped>
$scaleSize: 0.1;
$zoomOutStart: 0.7;
$zoomOutEnd: 0.46;
@keyframes zoomIn8 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  100% {
    opacity: 1;
  }
}
.wrapper{
  position: relative;
  top: 0;
  height: 100vh;
    &:after{
        display: table;
        clear: both;
        content: " ";
    }
    &.wrapper-full-page{
        height: auto;
        min-height: 100vh;
        height: auto;
        min-height: 100vh;

        .footer{
          position: absolute;
          bottom: 0;
          width: 100%;

          a{
            color: #fff;
          }
        }
    }
}

.wrapper-full-page .zoomIn {
  animation-name: zoomIn8;

}


@keyframes zoomOut8 {
  from {
    opacity: 1;
    transform: scale3d($zoomOutStart, $zoomOutStart, $zoomOutStart);
  }
  to {
    opacity: 0;
    transform: scale3d($zoomOutEnd, $zoomOutEnd, $zoomOutEnd);
  }
}
.wrapper-full-page .zoomOut {
  animation-name: zoomOut8;
}

.login-fix-page {
  padding-bottom: 7em;
  padding-top: 4em;
}

</style>
<style>
.md-field:after, .md-field:before {
  bottom: 7px;
}
</style>

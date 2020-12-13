import Vue from "vue";
import VueRouter from "vue-router";
import auth from '../middleware/auth';

Vue.use(VueRouter);

// router setup
import routes from "./routes";

// configure router
const router = new VueRouter({
  mode: "history",
  routes, // short for routes: routes
  scrollBehavior: to => {
    if (to.hash) {
      return {selector: to.hash};
    } else {
      return {x: 0, y: 0};
    }
  },
  linkExactActiveClass: "nav-item active"
});

router.beforeEach((to, from, next) => {

  if (to.meta.middleware) {
    // const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware];
    // const context = {from, next, to, router};
    // const nextMiddleware = nextFactory(context, middleware, 1);
    // console.log(nextMiddleware);

    // return middleware[0]({...context, next: nextMiddleware});
    const middleware = to.meta.middleware;
    if(middleware == "auth"){
      return auth({ next, router });
    }
    return next();
  }

  return next();
});
export default router;

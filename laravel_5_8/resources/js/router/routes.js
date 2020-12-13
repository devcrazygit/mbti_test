
//import middleware
import ExampleComponent from '../components/ExampleComponent'
import CustomerLayout from '../pages/CustomerLayout'
import Home from '../pages/user/Home'
import Result from '../pages/user/Result'
import Login from '../pages/admin/Login'
import MHistory from '../pages/admin/History'
const routes = [
  {
    path: "",
    name: "",
    component: CustomerLayout,
    children: [
      {
        path: "/",
        name: "home",
        components: { default: Home }
      },
    ],
  },
  {
    path: "/result",
    name: "result",
    component: Result
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/history',
    name: 'history',
    component: MHistory,
    meta: {middleware: "auth"}
  }
];

export default routes;

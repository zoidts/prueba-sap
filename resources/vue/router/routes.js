import LoginComponent from '../views/auth/forms/LoginComponent'

const routes = [

    {
        path: '/',
        name: 'login',
        props: {title: 'Iniciar Sesión'},
        meta: {
            title: "Inicio"
        },
        component: LoginComponent,
    },
    {
        path: '/registro',
        name: 'registro',
        component: () => import(/* webpackChunkName: "importar" */ '../views/auth/forms/RegisterComponent'),
        meta: {
            title: "Crear cuenta"
        },
    },
    {
        path: '/recuperar-contrasena',
        name: 'recuperarpassword',
        component: () => import(/* webpackChunkName: "importar" */ '../views/auth/forms/ForgotPasswordComponent'),
        meta: {
            title: "Recuperar contraseña"
        },
    },
    ,
    {
        path: '/reset-password/:token',
        name: 'restablecerpassword',
        component: () => import(/* webpackChunkName: "importar" */ '../views/auth/forms/ResetPasswordComponent'),
        meta: {
            title: "Restablecer contraseña"
        },
    },
    {
        path: "/dashboard",
        name: "dashboard",
        alias: '/dashboard',
        component: () =>  import(/* webpackChunkName: "ResetPassword"*/ "../views/dashboard/layouts/MasterComponent"),
        meta: {
            auth: true,
            title: "Dashboard"
        },
    }
];
export default routes;

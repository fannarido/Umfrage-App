export const routes = [
  {
    path: '/',
    component: render('frontend/Index'),
    children: [
      {
        path: '',
        component: render('frontend/Home'),
      },
      {
        path: 'question',
        component: render('frontend/Question'),
        auth: true,
      },
      {
        path: 'result',
        component: render('frontend/Result'),
        auth: true,
      },
      {
        path: 'group',
        component: render('frontend/Group'),
        auth: true,
      },
      {
        path: 'groups/:slug',
        props: true,
        component: render('frontend/GroupServey'),
      },
      {
        path: 'auth/login',
        component: render('frontend/auth/Login'),
      },
      {
        path: 'auth/register',
        component: render('frontend/auth/Register'),
      },
    ],
  },
];

function render(template) {
  return require(`@/pages/${template}.vue`).default;
}

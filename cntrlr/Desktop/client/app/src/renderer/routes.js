export default [
  {
    path: '/signup',
    name: 'signup',
    component: require('components/SignUpView')
  },
  {
    path: '/main',
    component: require('components/MainView'),
    children: [
      {path: 'text', component: require('components/MainView/SideText')},
      {path: 'sound', component: require('components/MainView/SideSound')}
    ]
  },
  {
    path: '/',
    name: 'landing-page',
    component: require('components/LandingPageView')
  },
  {
    path: '*',
    redirect: '/'
  }
]

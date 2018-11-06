import Router from 'koa-router'

const router = new Router({ prefix: '/getText'})

router.post('/', async (ctx, next) => {
    let data = await ctx.request.body.text;
    
    ctx.body = { text: data }
})

export default router
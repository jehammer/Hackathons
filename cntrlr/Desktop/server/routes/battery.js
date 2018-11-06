import Router from 'koa-router'

const router = new Router({ prefix: '/battery'})

router.post('/', async (ctx, next) => {
    let data = await ctx.request.body.battery;
    ctx.body = { level: data }
})

export default router
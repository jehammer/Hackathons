import Router from 'koa-router'

const router = new Router({ prefix: '/song'})

router.post('/', async (ctx, next) => {
    let data = await ctx.request.body.direction
    ctx.body = { direction: data }
})

export default router
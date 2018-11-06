import Router from 'koa-router'

const router = new Router({ prefix: '/volume'})

/**
 * @api {POST} /volume
 * @apiName getVolume
 * @apiGroup mobile
 *
 * @apiParam {Number} Volume Level
 *
 * @apiSuccess {String} Volume Level from mobile.
 */

router.post('/', async (ctx, next) => {
    let data = await ctx.request.body.direction
    ctx.body = { direction: data }
})

export default router
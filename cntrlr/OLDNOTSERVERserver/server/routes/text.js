import Router from 'koa-router'

const router = new Router({ prefix: '/text'})

/**
 * @api {POST} /text
 * @apiName sendText
 * @apiGroup normal
 *
 * @apiParam {String} Text
 * @apiParam {Number} Phone number
 * @apiSuccess {String} Volume Level from mobile.
 */



router.post('/', async (ctx, next) => {
    let data = await ctx.request.body;
    //send data variable to phone
})

export default router
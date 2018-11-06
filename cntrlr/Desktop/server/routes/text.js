import Router from 'koa-router'
import rp from 'request-promise'

const router = new Router({ prefix: '/sendText'})

router.post('/', async (ctx, next) => {
    let data = await ctx.request.body
    let option = {
        method: 'POST',
        uri: 'http://localhost:9080/message',
        body: {
            content: data.content
            number: data.number
            key: data.key
        },
        json: true
    }

    try {
        let response = await rp(option)
        console.log(`response is ${response}`)
        ctx.status = 200
    } catch(e) {
        console.log(`ERROR ${e}`)
        ctx.status = 400
    }
    
})

export default router
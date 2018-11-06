<template lang="pug">
    form(@submit.prevent='onSubmit').form
      input(type='text', placeholder='Type message here..', v-model='content')
      input(type='number', placeholder='number', v-model='number')
      button(type="submit")#login-button Submit
</template>

<script>
export default {
data: () => ({
		content: '',
		number: ''
	}),
    methods: {
		onSubmit() {
            console.log("SUBMITTITITI")
            let booty = JSON.stringify({
					content: this.content,
					number: this.number,
                    key: '970809298615271'
			})

            console.log("param", booty)

			fetch('http://ec2-34-207-101-233.compute-1.amazonaws.com:8090/message', {
				method: 'POST',
				body: booty,
                mode: 'no-cors',
				headers: {'Content-Type': 'application/json'}})
			.then(res => res)
            .then(res => console.log(res))
		}
	}
}
</script>
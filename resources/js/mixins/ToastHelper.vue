<script>

export default {
	
	methods: {
		showToast(message, color='secondary'){
			this.$q.notify({
				message: message,
				color: color,
				position: 'top-right',
				timeout: 1000
			})
		}
	}
}
</script>
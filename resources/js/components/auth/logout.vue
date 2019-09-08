<template>

</template>

<script type="text/javascript">
	
	export default {
		created(){
			User.logout()
			Toast.fire({
            type: 'success',
            title: 'Signed out successfully'
          	})
          	this.$router.push({name: '/'})
		}
	}

</script>

<style type="text/css">
	
</style>
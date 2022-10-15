<template>
    <div class="q-mx-lg home-wrapper">
		<!-- <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" /> -->
				<div class="box-wrapper search-desktop"></div>
				<div class="box-wrapper-mobile"></div>
				<div class="column items-center search-desktop">
					<div class="col">
						<div class="search-wrapper-desc">
							<div style="display: flex">
								<div class="logo-hash">#</div>
								<div class="logo-f">F</div>
								<div class="logo-first">Flo</div>
								<div class="logo-qast">Qast</div>
								<div class="logo-the">The</div>
							</div>
							<div class="fastest-text">Fastest, Most Accurate</div>
							<div class="way-text">Way to Close Your Books!</div>
						</div>
					</div>
					<div class="col search">
						<div class="search-wrapper">
							<div id="pointer">
								<div class="wrapper">
										<div class="header">SCHEDULE A DEMO</div>
										<div class="subheader">Learn More About FloQast</div>
								</div>
							</div>
							<div class="search-form">
								<div class="description"><span class="desc1">Learn How FloQast Can </span><span class="desc2"> Your Month-End</span></div>
								<div class="form-input" style="display: flex;">
									<input v-model="form.firstname" placeholder="First Name" class="q-mx-sm"/>
									<input v-model="form.email" placeholder="Email"/>
									<button class="q-ml-sm">SCHEDULE NOW</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="column items-center search-mobile-section">
					<div class="col">
						<div class="search-mobile-wrapper-desc">
							<div style="display: flex">
								<div class="logo-hash">#</div>
								<div class="logo-f">F</div>
								<div class="logo-first">Flo</div>
								<div class="logo-qast">Qast</div>
								<div class="logo-the">The</div>
							</div>
							<div class="fastest-text">Fastest, Most Accurate</div>
							<div class="way-text">Way to Close Your Books!</div>
						</div>
					</div>

					<div class="col" style="margin-top: 36px;">
						<div class="search-mobile search-mobile-wrapper">
							<div class="mobile-header">SCHEDULE A DEMO</div>
							<div class="mobile-subheader">Learn More About FloQast</div>
						</div>
						<div class="search-mobile-body">
							<div class="description-mobile" style="text-align: center;">
								<div class="desc1">Learn How FloQast Can </div>
								<div class="desc2"> Your Month-End</div>
							</div>
							<div class="mobile-form-input">
								<input v-model="form.firstname" placeholder="First Name" class="mob-form"/>
								<input v-model="form.email" placeholder="Email" class="mob-form"/>
								<button class="mobile-button" type="submit">SCHEDULE NOW</button>
							</div>
						</div>
					</div>
				</div>

    </div>
</template>
<script>

export default {
    data: () => ({
		form: {
			firstname: '',
			email: ''
		},
		hideDesktop: true
	}),
	mounted(){
		this.initialize()
	},
	methods: {
		initialize(){
			if(this.$q.platform.is.mobile){
				this.hideDesktop = false
			}
		}
	}
}
</script>
<template>
    <div class="q-mx-lg home-wrapper">
		<!-- <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" /> -->
		<div class="box-wrapper"></div>
			<div class="column items-center">
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
				<div class="search-mobile">
					<div class="search-mobile-wrapper">
						<div>SCHEDULE A DEMO</div>
						<div>Learn More About FloQast</div>
					</div>
					<div class="search-mobile-body">
						<div class="description-mobile" style="text-align: center;">
							<div class="desc1">Learn How FloQast Can </div>
							<div class="desc2"> Your Month-End</div>
						</div>
						<div class="mobile-form-input">
							<input v-model="form.firstname" placeholder="First Name"/>
							<input v-model="form.email" placeholder="Email"/>
						</div>
						<button class="mobile-button" type="submit">SCHEDULE NOW</button>
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
<style scoped>

.home-wrapper {
	/* background-image: url('https://www.nssf.org/wp-content/uploads/2019/05/businessMeeting.png'); */
	background-image: url('https://www.ringcentral.com/gb/en/blog/wp-content/uploads/2021/05/happy-manager-leads-a-meeting-in-the-office-640x427.jpg.webp');
	padding: 42px 0px;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	height: 450px;
}

.box-wrapper {
	background: #fff;
    width: 50%;
    height: 130px;
    top: 45px;
    position: absolute;
	border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
	opacity: 40%;
}

.fastest-text {
	color: #9cc448;
    font-size: 26px;
    position: absolute;
    top: 104px;
}

.way-text {
	font-size: 16px;
    position: absolute;
    top: 136px;
}

.logo-first {
	font-size: 45px;
	margin: 14px -8px;
	color: #9cc448;
	font-weight: 600;
	z-index: 5;
}

.logo-qast {
	font-size: 45px;
	margin: 14px 6px;
	color: #6d6e70;
	font-weight: 600;
	z-index: 5;
}

.logo-the {
	font-size: 16px;
	margin: 46px 6px;
	color: #6d6e70;
	font-weight: 600;
	z-index: 5;
}

.logo-f {
	font-size: 46px;
	margin: 14px -18px;
	color: #fff;
	font-weight: 600;
	z-index: 3;
}

.logo-hash {
	font-size: 55px;
	font-weight: 600;
	color: #6d6e70;
	z-index: 3;
}

.description {
	text-align: center;
	padding: 4px 0px;
	font-weight: 700;
	font-size: 16px;
}

.description .desc1 {
	color: #77787a;
}

.description .desc2 {
	color: #8bc540;
}

.search {
	margin-top: 148px;
}

.search-wrapper-desc {
	width: 688px;
	text-align: left !important;
	font-style: italic;
}

.search-wrapper {
  display: flex;
	widows: 688px;
}

.search-form {
	display: inline-block;
	padding: 10px 25px;
	background-color: #fff;
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
}

.search-form input, button {
	border: 1px solid #d9d5d5;
	border-radius: 5px;
	padding: 3px 6px;
}
.search-form input{
	width: 124px;
}

.search-form button {
	background: #8bc540;
	color: #fff;
	width: 172px;
}

#pointer .wrapper {
  padding: 20px 0px;
	/* text-align: center; */
	color: #fff;
}

#pointer .wrapper .header {
	font-weight: 700;
	font-size: 18px;
	padding-left: 18px;
}

#pointer .wrapper .subheader {
	font-weight: 500;
	font-size: 13px;
	padding-left: 26px;
}

#pointer {
	width: 194px;
	height: 81px;
	position: relative;
	background: #8bc540;
	border-top-left-radius: 5px;
	border-bottom-left-radius: 5px;
}
#pointer:after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 0;
	height: 0;
	border-left: 20px solid white;
/*   border-top: 20px solid transparent;
  border-bottom: 20px solid transparent; */
}
#pointer:before {
	content: "";
	position: absolute;
	right: -20px;
	bottom: 0;
	width: 0;
	height: 0;
	border-left: 20px solid #8bc540;
	border-top: 39px solid transparent;
	border-bottom: 41px solid transparent;
}


@media only screen and (min-width: 831px) {
  
  .search-mobile {
		display: none;
  }
}

@media only screen and (max-width: 830px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }

  .search {
		display: none;
  }

  .search-mobile-section {
		margin-top: 46px;
  }

  .search-mobile-wrapper {
		text-align: center;
    background: #8bc540;
    color: #fff;
    padding: 6px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .search-mobile-body {
		background: #fff;
		padding: 12px 16px;
		border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }

	.mobile-form-input input {
		width: 100%;
		margin: 4px 0px;
		border: 1px solid #d9d5d5;
		border-radius: 5px;
		padding: 3px 6px;
	}

	.mobile-button {
		width: 100%;
		margin-top: 8px;
		color: #fff;
		background: #9cc448;
	}

	.description-mobile {
    font-weight: 700;
    font-size: 16px;
	}

	.description-mobile .desc1 {
		color: #77787a;
	}

	.description-mobile .desc2 {
		color: #8bc540;
	}
}
</style>
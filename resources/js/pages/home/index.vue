<template>
    <div class="q-mx-lg home-wrapper">
        <div class="column items-center">
					<div class="col">
							One of three rows
					</div>

					<div class="col">
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

    </div>
</template>
<script>

export default {
    data: () => ({
			form: {
				firstname: '',
				email: ''
			}
		}),
}
</script>
<style scoped>

.home-wrapper {
	background-image: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80');
	padding: 42px 0px;
	object-fit: cover;
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

.search-wrapper {
  display: flex;
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
  padding: 24px 0px;
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
</style>
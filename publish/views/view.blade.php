<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin setup</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
	</head>
	<body>
		<div id="root">
			<admin-section label="Database">
				<admin-link route="drop-all-tables" >Drop all tables</admin-link>
			</admin-section>

			<admin-section label="Migrations">
				<admin-link route="migrate" >Run migrations</admin-link>
			</admin-section>

			<admin-section label="Seeding">
				<admin-link route="seed" >Seed all tables</admin-link>
				<list get="get-seeders" post="seed">Seed table</list>
				<list get="get-tables"  post="seed-generate">Generate seed</list>
			</admin-section>

		</div>
	</body>
	<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.15/dist/vue.js"></script>
	<script>

		Vue.component('admin-section', {
			props:['label'],
			template: '<section><h2 class="title is-2 has-text-centered" v-html="label"></h2><slot></slot></section>',
		})

		Vue.component('list', {
			props:['get','post'],
			template: '<div><a href="#" @click.prevent="postList"  target="_blank" ><slot></slot></a><li v-for="item in items"><input type="checkbox" @change="toggleItem(item)" >@{{item}}</li></div>',
			data(){
				return {
					items:[],
					selected:[],
				};
			},
			created(){
				axios.get('/admin-setup/'+this.get).then( response => this.items = response.data );
			},
			methods: {
				toggleItem(item) {
					if(this.selected.indexOf(item)==-1)
						this.selected.push(item)
					else
						this.selected.splice(this.selected.indexOf(item), 1)
				},
				postList(){
					var answer = confirm ('Do You want ' + event.target.innerHTML +' ?\n\n    '+ this.selected.join('\n    ') );
					if (answer)
						window.open( '/admin-setup/'+this.post+'/'+this.selected.join(), "_blank")
					//alert( this.selected.join() );
				}

			 }

		})

		Vue.component('admin-link', {
			props:['route'],
			template: '<li><a href="#" :data-route="route" @click.prevent="confirmLink"  target="_blank" ><slot></slot></a></li>',
			methods:{
				confirmLink(){
					var answer = confirm ('Do You want\n\n    ' + event.target.innerHTML + ' ?');
					if (answer)
						window.open( '/admin-setup/'+event.target.dataset.route, "_blank")
				}
			},

		})

		var app = new Vue({
			el: '#root',
		})
	</script>

</html>




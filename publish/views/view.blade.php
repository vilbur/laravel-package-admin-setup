<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin setup</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-extensions@1.0.14/bulma-tooltip/dist/bulma-tooltip.min.css">		
		<style>
			body{
				background-color:#2B2B2B;
				color: white;
			}
			.title{
				color: white;
				margin: 0.5em 0 0.2em 0 !important;
				border-bottom:	1px solid white ;
			}
			a{
				color: #16B7F7;
			}
			a:hover{
				color: orange;
			}
			input[type="checkbox"]{
				-webkit-transform: scale(1.5); /* Safari and Chrome */
				margin-right: 15px;
			}
			ul li {
			  list-style-type: none;
			}
			label[for$="DatabaseSeeder"]{
				color:yellow !important;
				font-weight: bold;
			}
			label[for="DatabaseSeeder"]{
				color:orange !important;
				font-weight: bold;
			}
			label[for$="FakerSeeder"]{
				color:cyan !important;
			}
			label[for$="TableSeeder"]{
				color:lightgreen !important;
			}
		</style>
	</head>
	<body>
		<div id="root">
			<section class="section">
				<div class="container">
				
					<h2 class="title is-2 has-text-centered">Environment: {{ \App::environment() }}</h2>

					<div class="columns is-mobile">
						<div class="column is-6">
							<list ref="tables" get="get-tables">Tables</list>
						</div>
						<div class="column is-6">
							<list ref="seeders" get="get-seeders">Seeders</list>
						</div>
					</div> 

					<admin-section label="Tables">
						<admin-link route="drop-all-tables" >Drop all tables</admin-link>
						<admin-link route="truncate-tables" list="tables" >Truncate tables</admin-link>
					</admin-section>

					<admin-section label="Migrations">
						<admin-link route="migrate" >Run migrations</admin-link>
					</admin-section>

					<admin-section label="Seeding">
						<admin-link route="seed" list="seeders" >Seed</admin-link>
						<admin-link route="seed-generate" list="tables" >Generate Seeders</admin-link>
					</admin-section>
						
					<admin-section label="Database">
						<admin-link route="database/refresh" list="seeders" class="tooltip is-tooltip-multiline"
									data-tooltip="Drop all tables, migrate and seed selected seeders or DatabaseSeeder if nothing selected."
						>Refresh database</admin-link>
					</admin-section>
						
					<admin-section label="Cache">
						<admin-link route="cache-clear" >Clear cache</admin-link>
					</admin-section>

				</div>
			</section>
		</div>
	</body>
	<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.15/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-bulma-tooltip@1.0.4/src/index.min.js"></script>		
	<script>

		Vue.component('admin-section', {
			props:['label'],
			template: '<section><h2 class="title is-2" v-html="label"></h2><slot></slot></section>',
		})

		Vue.component('list', {
			props:['get'],
			template: '<ul><h5 class="title is-5 has-text-centered"><slot></slot></h5><li click="toggleItem(item)" v-for="item in items"><input type="checkbox" @change="toggleItem(item)" :id="item"><label :for="item">@{{item}}</label></li></ul>',
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
			 }
		})

		Vue.component('admin-link', {
			props:['route','list'],
			template: '<li><a href="#" :data-route="route" :data-list="list" @click.prevent="confirmLink"  target="_blank" ><slot></slot></a></li>',
			methods:{
				getSelectedItems(list)
				{
					return list && this.$root.$refs[list].selected.length > 0 ? this.$root.$refs[list].selected : [];
				},
				confirmLink(){
					var list	= event.target.dataset.list
					var selected_items	= this.getSelectedItems( list );
					
					if( list=='seeders' && selected_items.length == 0 )
						selected_items = ['DatabaseSeeder']
					
					var answer	= confirm ( event.target.innerHTML + ' ?' + ( selected_items.length > 0 ? '\n\n    '+selected_items.join('\n    ') : '' ) );
					if (answer)
						window.open( '/admin-setup/'+event.target.dataset.route + ( selected_items.length > 0 ? '/'+selected_items.join() : '' ) , "_blank")

				}
			},
		})

		var app = new Vue({
			el: '#root',
		})
	</script>

</html>

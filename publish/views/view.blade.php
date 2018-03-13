<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin setup</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
		<style>
			input[type="checkbox"]{
				-webkit-transform: scale(1.5); /* Safari and Chrome */
				margin-right: 15px;
			}
			ul li {
			  list-style-type: none;
			}

		</style>
	</head>
	<body>
		<div id="root">
			<section class="section">
				<div class="container">

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
						<admin-link route="truncate-tables" list="tables" >Truncate selected tables</admin-link>
					</admin-section>

					<admin-section label="Migrations">
						<admin-link route="migrate" >Run migrations</admin-link>
					</admin-section>

					<admin-section label="Seeding">
						<admin-link route="seed" >Seed all tables</admin-link>
						<admin-link route="seed" list="seeders" >Seed selected Seeders</admin-link>
						<admin-link route="seed-generate" list="tables" >Generate seeds for selected tables</admin-link>
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
					var selected_items	= this.getSelectedItems( event.target.dataset.list );
					var answer	= confirm ('Do You want\n\n    ' + event.target.innerHTML + ' ?' + ( selected_items.length > 0 ? '\n\n    '+selected_items.join('\n    ') : '' ) );
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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD PHP VUEJS</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="vue-material.min.css"> -->
    <style type="text/css">
	  	:root {
	      --color-primary: #47bac1;
	      --color-secondary: #41B883;
	      --bg-color: #727F80;
		}

		.btn,.btn-large {
	      background-color: var(--color-primary);
	    }
	    .btn:hover, .btn-large:hover {
	      background-color: var(--color-secondary);
	    }

	    .ModalWindow {
	      position: fixed;
	      z-index: 999;
	      top: 0;
	      left: 0;
	      right: 0;
	      bottom: 0;
	      background-color: rgba(0, 0, 0, .25);
	      display: none;
	    }

	    .ModalWindow-container{
	      margin: 5vh auto 0;
	      width: 60%;
	      background-color: #FFF;
	    }

	    .ModalWindow-heading{
	      padding: 0 1rem;
	      background-color:  var(--bg-color);
	      color: #FFF;
	    }

	    .ModalWindow-content {
	      padding: 1rem;
	    }
	    .u-flexColumnCenter {
	      padding: 1rem;
	      display: flex;
	      justify-content: center;
	      align-items: center;
	    }
	    .u-show {
	      display: initial;
	    }
    

    </style>
</head>
<body>
	<main id="app" class="container center">
		<section class="row valign-wrapper">
			<div class="col s12 m3">
				<img src="https://vuejs.org/images/logo.png" alt="vue.js" class="responsive-img">
				<!-- <img src="https://lorempixel.com/300/300/" alt="imagen"> -->
			</div>
			<div class="col s12 m6">
				<h1>CRUD</h1>
				<h4>(PHP + MYSQL)</h4>
			</div>
			<div class="col s12 m3">
				<img src="https://ed.team/themes/custom/escueladigital/img/EDteam-logo.svg" alt="EDteam" class="responsive-img">
			</div>
		</section>
		<section>
			<div class="col s12">
		    	<h4>Curso de Vue.js desde cero</h4>
		    </div>
		</section>
		<section class="row valign-wrapper" >
	      <div class="col s10">
	        <h3 class="left">Lista de estudiantes</h3>
	      </div>
	      <div class="col s2">
	        <button class="btn-floating btn-large  waves-effect waves-light" v-on:click="toggleModal('add')">
	          <i class="material-icons">add_circle</i>
	        </button>
	      </div>
	    </section>
	    <hr>
	    <transition name="fade">
	      <p class="u-flexColumnCenter red accent-1 red-text text-darken-4" v-if="errorMessage">
	        {{ errorMessage }}
	        <i class="material-icons prefix">error</i>
	      </p>
	      <p class="u-flexColumnCenter green accent-1 green-text text-darken-4" v-if="successMessage" >
	        {{ successMessage }}
	        <i class="material-icons prefix">check_circle</i>
	      </p>
	    </transition>
	    <transition>
	    	<table class="responsive-table highlight centered">
	    		<thead>
		          <tr>
		              <th>ID</th>
		              <th>Name</th>
		              <th>Email</th>
		              <th>Web</th>
		              <th class="">Opciones</th>
		          </tr>
		        </thead>

		        <tbody>
		          <tr v-for="student in students" :key="student.idstudent">
		            <td>{{ student.idstudent }}</td>
		            <td>{{ student.name }}</td>
		            <td>{{ student.email }}</td>
		            <td>{{ student.web }}</td>
		            <td>
		            	<button class="btn-floating btn-large " style="margin-right: 20px;">
		            		<i class="material-icons">edit</i>
		            	</button>
		            	<button class="btn-floating btn-large ">
		            		<i class="material-icons">delete</i>
		            	</button>
		            </td>
		          </tr>
        		</tbody>
	    	</table>
	    </transition>
	    <transition name="fade">
	      <section v-bind:class="['ModalWindow',displayAddModal]" v-if="showAddModal">
	        <div class="ModalWindow-container">
	          <header class="ModalWindow-heading">
	            <div class="row valign-wrapper">
	              <div class="col s10">
	                <h4 class="left">Agregar Estudiante</h4>
	              </div>
	              <div class="col s2">
	                <button class="btn btn-floating right" @click="toggleModal('add')">
	                  <i class="material-icons">close</i>
	                </button>
	              </div>
	            </div>
	          </header>
	          <form class="ModalWindow-content row" v-on:submit.prevent="createStudent">
	            <div class="input-field col s12">
	              <i class="material-icons prefix">account_circle</i>
	              <input id="name" name="name" type="text" class="validate" required >
		          <label for="name">Nombres</label>
	              <span class="helper-text" data-error="Escriba correctamente el campo" data-success="Muy bien!">Texto de ayuda</span>
	            </div>
	            <div class="input-field col s12">
	              <i class="material-icons prefix">email</i>
	              <input id="email" name="email" type="email" class="validate" required>
	              <label for="email">Email</label>
	              <span class="helper-text" data-error="Escriba correctamente el campo" data-success="Email correcto!">Texto de ayuda</span>
	            </div>
	            <div class="input-field col s12">
	              <i class="material-icons prefix">web</i>
	              <input id="web" name="web" type="text" class="validate" required>
	              <label for="web">Web</label>
	              <span class="helper-text" data-error="Escriba correctamente el campo" data-success="Muy bien!">Texto de ayuda</span>
	            </div>
	            <div class="input-field col s12">
	              <button class="btn-large btn-floating right" type="submit">
	                <i class="material-icons">save</i>
	              </button>
	            </div>

	          </form>
	        </div>
	      </section>
	    </transition>
	</main>


	<!-- <footer class="page-footer"> -->
		<!-- <div class="container">
            <div class="row">

              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>

            </div>
        </div> -->
		<!-- <div class="footer-copyright ">
			<div class="container">
				 © 2018 Copyright 
				 <a class="grey-text text-lighten-4 " href="#!">More Links</a>
			</div>
		</div>
	</footer> -->
<script type="text/javascript" src="js/vue.min.js"></script>
<script type="text/javascript" src="js/axios.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
	const app = new Vue({
		el:"#app",
		data:{
			showAddModal:false,
			showEditModal:false,
			showDeleteModal:false,
			errorMessage:'',
			successMessage:'',
			students:[],
			activeStudent:{}
		},
		mounted(){
			this.getAllStudents();
		},
		computed:{
			displayAddModal:function(){
				return (this.showAddModal) ? 'u-show' : '';
			},
			displayEditModal(){
				return (this.showEditModal) ? 'u-show' : '';

			},
			displayDeleteModal(){
				return (this.showDeleteModal) ? 'u-show' : '';

			}
		},
		methods:{
			toggleModal(modal){
				if(modal === 'add'){
					this.showAddModal = !this.showAddModal;
				}else if(modal === 'edit'){
					this.showEditModal = !this.showEditModal;
				}else if(modal === 'delete'){
					this.showDeleteModal = !this.showDeleteModal;
				}
			},
			setMessages(res){
				if(res.data.error){
					this.errorMessage = res.data.message;
				}else{
					this.successMessage = res.data.message;
					this.getAllStudents();
				}

				setTimeout(() => {
					this.errorMessage=false;
					this.successMessage=false;
				},2000);
			},
			getAllStudents(){
				axios.post('config.php?action=read')
					.then(res=>{
						// this.setMessages(res)
						// this.getAllStudents()
						console.log("d");
						this.students = res.data.students
					})
			},
			createStudent(e){

				form = new FormData(e.target);
				axios.post('config.php?action=create',form)
					.then(res=>{
						this.toggleModal('add');
						this.setMessages(res)
					})
			},
			getStudent(){

			},
			updateStudent(){

			},

		}
	}) 

</script>
</body>
</html>
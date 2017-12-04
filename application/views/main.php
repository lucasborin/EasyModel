
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="<?php echo site_url('main')?>">Unisinos</a>
	  <div class="nav-collapse">
		<ul class="nav">
		  <li> <a href='<?php echo site_url('main/areaprocesso')?>'>Area Processo</a> </li>
		  <li> <a href='<?php echo site_url('main/categoria')?>'>Categoria</a> </li>
		  <li> <a href='<?php echo site_url('main/metaespecifica')?>'>Meta Especifica</a> </li>
		  <li> <a href='<?php echo site_url('main/metagenerica')?>'>Meta Generica</a> </li>
		  <li> <a href='<?php echo site_url('main/modelo')?>'>Modelo</a> </li>
		  <li> <a href='<?php echo site_url('main/nivelcapacidade')?>'>Nivel Capacidade</a> </li>
		  <li> <a href='<?php echo site_url('main/nivelmaturidade')?>'>Nivel Maturidade</a> </li>
		  <li> <a href='<?php echo site_url('main/praticaespecifica')?>'>Pratica Especifica</a> </li>
		  <li> <a href='<?php echo site_url('main/produtotrabalho')?>'>Produto de Trabalho</a> </li>	
		</ul>
	  </div>
	</div>
  </div>
</div>

<div class="container">

  <?php if($output) { echo $output; } ?> 
  
  <hr>
  
  <footer>
	<p>&copy; Company 2012</p>
  </footer>
  
</div>



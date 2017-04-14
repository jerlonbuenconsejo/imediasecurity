<?php $cats = $db->getRows("SELECT * FROM categories"); ?>
<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="#"><span class="highlight">iMedia </span> Admin</a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="">
        <a href="./index.html">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div id="title" class="title">Dashboard</div>
        </a>
      </li> 
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-cube" aria-hidden="true"></i>
          </div>
          <div class="title">Maintenance</div>
        </a>
        <div class="dropdown-menu">
        <ul>
        <!--<li><a href="./add-new-account.php">Accounts</a></li>--> 
            <li><a href="./brand.php">Brand</a></li>        
            <li><a href="./camera-type.php">Camera-Type</a></li>
            <li><a href="./add.categories.php">Categories</a></li>
            <li><a href="./supplier.php">Supplier</a></li>
            <li><a href="./vat.php">VAT</a></li>
        </ul>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-cube" aria-hidden="true"></i>
          </div>
          <div class="title">Category List</div>
        </a>
        <div class="dropdown-menu">
        <ul>
            <?php 
              foreach($cats as $cat){
                echo"<li><a href='show-cat.php?catID=$cat->catID'> $cat->catName</a></li>";
              }
            ?>
        </ul>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
          </div>
          <div class="title">Quotation</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i></li>
            <li><a href="./quotation.php">New Quotation</a></li>
          </ul>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
          </div>
          <div class="title">Sales</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i></li>
            <li><a href="./quotation.php">Reports</a></li>
          </ul>
        </div>
      </li>
      <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-gear" aria-hidden="true"></i>
          </div>
          <div class="title">Settings</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i>Utilities</li>
          </ul>
        </div>
      </li>
    </ul> -->
  </div>
</aside>
<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
    {{list}}
  </div>
</script>
<?php

// use System\Shop\Shop;
// $Shop=new Shop();
$uid=$_SESSION["uid"]??"";



?>
<div class="container-fluid  dashboard">
    <div class="">
        <div class="row mb-4 metrics">
		     <div class="col-xl-6 col-lg-6 col-md-6 mb-3 col-sm-12 col-12 mt-3 mt-xl-0 pe-md-0 <?=getpages($uid,'tasks')==1?:"d-none" ?>">
                <div class="card">
                    <a href="<?=$LA?>/protocols">  
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="text-muted">ოქმები</h5>
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span><i class="fa fa-fw fa-plus"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        
            <div class="col-xl-6 col-lg-6 col-md-6 mb-3 col-sm-12 col-12 mt-3 mt-xl-0 <?=getpages($uid,'task')==1?:"d-none" ?>">
                <div class="card">
                    <a href="<?=$LA?>/protocols">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="text-muted">ახალი ოქმი</h5>
                            <div class="metric-value d-inline-block">
                                <h3 class="mb-1"></h3>
                            </div>
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span><i class="fa fa-fw fa-plus"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
          
           
     
        
        </div>
        <section class="my-4">
            <div class="col-12 px-0">
              
            </div>
        </section>
        <div class="row my-4">
       



        </div>               
    </div>
</div>

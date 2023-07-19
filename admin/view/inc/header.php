<?php

// if($user_logged){
?>
    <header class="">

        <div class="dashboard-header">
		<nav class="navbar navbar-expand-md bg-white fixed-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<div class="burger">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div>
				</button>
			<a class="navbar-brand" href="./">Nbr Admin</a>
				<?php
				$notf=0;
	 // $ntf=mysqli_query($con, "SELECT id FROM protocol WHERE seen=0 "); 
	  //$notf=mysqli_num_rows($ntf);
	?>
	<div class="notf" ln='<?=$LA ?>' page='protocols'>
		<i class="fas fa-bell seenord"></i>
		<div class="n-count ">
		  <?=$notf ?>
		</div>
	</div>
			<div class="collapse d-flex navbar ml-auto" id="navbarSupportedContent">

				<ul class="row mx-0 navbar-right-top">
					
					<li class="nav-item">
						<a class="nav-link" href="<?=$LA ?>/profile">
							<i class="fas fa-user"></i> <small class="ml-2 nav-user-name"><?=$Guid!=""? $radm["firstname"] .' '. $radm["lastname"]:"სახელი გვარი" ?> (<?=$radm["tpname"] ?>) </small>
						</a>
					</li>
					<li class="nav-item d-flex align-items-center ml-3">
						<a id="logout" class="" href="./">
							<h4>
								<i class="fad fa-sign-out LGT"></i>
							</h4>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
    	
	<div class="nav-left-sidebar sidebar-dark">
		<div class="menu-list">
			<nav class="navbar navbar-expand-md navbar-light">				
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav flex-column">
						<li class="nav-divider">
							ნავიგაცია 
						</li>
						<li class="nav-item <?=getpages($Guid,'dashboard')==1?:"d-none" ?>">
							<a class="nav-link <?=$p=="dashboard"?"active":"" ?>" href="<?=$LA?>/dashboard"><i class="fas fa-home"></i>Dashboard
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>
					
						<li class="nav-item  <?=getpages($Guid,'protocols')==1?:"d-none" ?>">
							<a class="nav-link <?=$p=="protocols"?"active":"" ?>" href="<?=$LA?>/protocols"><i class="fas fa-tasks"></i>Users
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>
						<li class="nav-item <?=getpages($Guid,'indicators')==1?:"d-none" ?>">
							<a class="nav-link  <?=$p=="indicators"?"active":"" ?>" href="<?=$LA?>/indicators" ><i class="fas fa-list"></i>Purchases
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>
					
						<li class="nav-item <?=getpages($Guid,'lessons')==1?:"d-none" ?> ">
							<a class="nav-link <?=$p=="lessons"?"active":"" ?>" href="<?=$LA?>/lessons"><i class="fas fa-list"></i>Lessons
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link <?=$p=="courses"?"active":"" ?>" href="<?=$LA?>/courses"><i class="fas fa-list"></i>Courses
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>	
						<li class="nav-item ">
							<a class="nav-link <?=$p=="exammethods"?"active":"" ?>" href="<?=$LA?>/exammethods"><i class="fas fa-list"></i>Quizzes
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>	
						<li class="nav-item <?=getpages($Guid,'units')==1?:"d-none" ?> ">
							<a class="nav-link <?=$p=="blog"?"active":"" ?>" href="<?=$LA?>/units"><i class="fa fa-balance-scale"></i>Blog Posts
                            <!-- <span class="badge badge-success">6</span> -->
                        	</a>
						</li>
						<li class="nav-item <?=$p=="archive"?"active":"" ?>">
							<a class="nav-link <?=$p=="archive"?"active":"" ?>" href="<?=$LA?>/archive"><i class="fa fa-archive"></i>Testimonials
                        	</a>
						</li>
						<li class="nav-item <?=$p=="archive"?"active":"" ?>">
							<a class="nav-link <?=$p=="archive"?"active":"" ?>" href="<?=$LA?>/archive"><i class="fa fa-archive"></i>Contents
                        	</a>
						</li>
						<li class="nav-item <?=$p=="archive"?"active":"" ?>">
							<a class="nav-link <?=$p=="archive"?"active":"" ?>" href="<?=$LA?>/archive"><i class="fa fa-archive"></i>FAQ
                        	</a>
						</li>
						<li class="nav-item d-none" >
							<a class="nav-link" href="<?=$LA?>/history"><i class="fa fa-calendar"></i>ისტორია
                        	</a>
						</li>
						<li class="nav-item d-none">
							<a class="nav-link " href="<?=$LA?>/clients"><i class="fas fa-users"></i>მომხმარებლები
                        	</a>
						</li>	
						<li class="nav-divider">
							Seo
						</li>
						<li class="nav-item <?=getpages($Guid,'admins')==1?:"d-none" ?>">
							<a class="nav-link <?=$p=="admins"?"active":"" ?>" href="<?=$LA?>/admins"><i class="fas fa-user-shield"></i>ადმინები
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'roles')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="roles"?"active":"" ?>" href="<?=$LA?>/roles"><i class="fa fa-lock"></i>როლები
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'journal')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="journal"?"active":"" ?>" href="<?=$LA?>/journal"><i class="fas fa-book-reader"></i>ჟურნალი
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'contact')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="contact"?"active":"" ?>" href="<?=$LA?>/contact"><i class="fa fa-address-book"></i>რეკვიზიტები
						</a>
					</li>


						<li class="nav-divider">
							მართვა
						</li>
						<li class="nav-item <?=getpages($Guid,'admins')==1?:"d-none" ?>">
							<a class="nav-link <?=$p=="admins"?"active":"" ?>" href="<?=$LA?>/admins"><i class="fas fa-user-shield"></i>ადმინები
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'roles')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="roles"?"active":"" ?>" href="<?=$LA?>/roles"><i class="fa fa-lock"></i>როლები
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'roles')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="roles"?"active":"" ?>" href="<?=$LA?>/roles"><i class="fa fa-lock"></i>ენები
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'journal')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="journal"?"active":"" ?>" href="<?=$LA?>/journal"><i class="fas fa-book-reader"></i>ჟურნალი
						</a>
					</li>
					<li class="nav-item <?=getpages($Guid,'contact')==1?:"d-none" ?>">
						<a class="nav-link <?=$p=="contact"?"active":"" ?>" href="<?=$LA?>/contact"><i class="fa fa-address-book"></i>რეკვიზიტები
						</a>
					</li>
				
					
					

					</ul>
				</div>
			</nav>
		</div>
	</div>
    </header>
 <div class="dashboard-main-wrapper">
        <div class="dashboard-wrapper">
           <?php
//    echo "<pre>";
//    print_r($user);
//    echo "</pre>";
//}
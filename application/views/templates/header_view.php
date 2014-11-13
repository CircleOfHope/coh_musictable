        <!-- Admin nav bar or login bar -->
                <div id="login-bar" class="top-bar">
           <span>Admin? </span><a href="<?php if(!$admin){echo site_url('songs/login');}else{echo site_url('songs/logout');}?>"><?php if(!$admin){echo 'Login here';}else{echo 'Logout';}?></a>
                </div>

        <!-- Header -->
        <div id="header">

                <!-- Nav bar -->
                <ul id="navbar-bg" class="basic horizontal"> <li></li> <li></li> <li></li> <li></li> </ul>
                <ul id="navbar" class="basic horizontal">
                        <li class="<?=($this->uri->segment(1, 0)===0)?'selected':''?>"><a href="<?=site_url()?>">Music</a></li>
                        <li><a href="http://www.circleofhope.net">Church</a></li>
                        <li class="<?=($this->uri->segment(1)==='feedback')?'selected':''?>"><a href="<?=site_url("feedback")?>">Feedback</a></li>
                        <li class="<?=($this->uri->segment(1)==='about')?'selected':''?>"><a href="<?=site_url("about")?>">About</a></li>
                </ul>
        </div>
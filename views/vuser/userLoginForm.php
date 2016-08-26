<div class="jumbotron text-center">
  <h1>Cloud Diary</h1>
  <p>Save a story of yourself</p> 
</div>
  
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<h3>Why Diary?</h3>
			<p>Why would anyone write diary while anyone can update their status on Facebook, post their pics on Instagram, and tweet their daily activity?</p>
			<p>Because most of our social updates are a bit 'lies'. We don't tell the world the real of us. You deserve the truth of yourself.</p>
			<p><a href='http://google.com'>And more reasons ..</a></p>
		</div>
		<div class="col-sm-4">
			<h3>Log In</h3>
			<?php
			echo form_open('Cuser/user_login');
		
				echo '<div class="form-group">';
				echo '<div>';
					echo form_label('Username', 'username');
				echo '</div>';
				echo '<div>';
					echo form_input('username', '', 'class=form-control');
				echo '</div>';
			echo '</div>';
		
			echo '<div class=form-group>';
				echo '<div>';
					echo form_label('Password', 'password');
				echo '</div>';
				echo '<div>';
					echo form_password('password', '', 'class="form-control"');
				echo '</div>';
			echo '</div>';
		
				echo form_submit('submit', 'Log in');
			echo form_close();
			?>
		</div>
		<div class="col-sm-4">
			<h3>Sign Up</h3>        
			<p>Have an account and save stories of your life</p>
			<p>How much storage would you want? It's Unlimited.</p>
			<p>

<?php ?>


</p>
		</div>
	</div>
</div>



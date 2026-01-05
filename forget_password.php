<?php
	include("includes/header.php");
	include("includes/connection.php");
	include("functions/notification.php");

	display_notification_messages();
?>

		<div class="container bg-gradient-light p-5  min-vh-100">
			<div class="m-auto w-50">
				<div class="rounded-4 shadow">
					<div class="p-5 pb-4 border-bottom-0">
						<h1 class="fw-bold mb-0 fs-2">Forget Password</h1>
					</div>

					<div class="p-5 pt-0">
						<!-- Forget Password Form -->
						<form action="functions/forget_password_process.php" method="POST">
							<!-- User Name Input -->
							<div class="form-floating mb-3">
								<input name="username" type="text" class="form-control rounded-3" placeholder="">
								<label>User Name</label>
							</div>

							<!-- Security Question Selection -->
							<select class="form-select mb-3" name="question" aria-label="Default select example">
							<option>What is your Favourite Book?</option>
              <option>Which type of book do you like?</option>
							</select>

							<!-- Security Answer -->
							<div class="form-floating mb-3">
								<input name="answer" type="text" class="form-control rounded-3" placeholder="">
								<label>Security answer</label>
							</div>
							
							<!-- Password Input -->
							<div class="form-floating mb-3">
								<input name="password" type="password" class="form-control rounded-3" placeholder="">
								<label>New Password</label>
							</div>

							<!-- Confirm Password Input -->
							<div class="form-floating mb-3">
								<input name="confirm_password" type="password" class="form-control rounded-3" placeholder="">
								<label>Confirm Password</label>
							</div>

							<!-- Submit Button -->
							<input type="submit" class="w-100 mb-2 btn rounded-3 btn-outline-light" value="Change Password">
							
						</form>
					</div>
				</div>
			</div>
		</div>

<?php
	include("includes/footer.php");
?>
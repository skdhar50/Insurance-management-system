<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Registration</title>
	</head>
	<body
		class="
			bg-gray-500
			content-center
			w-screen
			h-screen
			flex
			justify-center
			items-center
		"
	>

		<?php
			require('dbcon.php');

			if(isset($_POST['submit']))
			{
				$user = $_POST['username'];
				$email = $_POST['email']; 
				$password = $_POST['password'];

				$sql = "insert into admin (admin_name,email,password) values('$user','$email','$password')";

				$result = mysqli_query($con,$sql);

				if($result)
				{
					// echo "<div class='form'>
					// 	<h3>You are registered successfully!</h3><br/>
					// 	<p class='link'><a href='login.php'>Click to Login</a></p>
					// 	</div>";
					header("Location:login.php");
				}
				else
				{
					echo "<div class='form'>
						<h3>Required fields are missing.</h3><br/>
						<p class='link'><a href='registration.php'>Click to Register Again</a></p>
						</div>";
				}
			}
		?>
		<div
			class="
				bg-gray-200
                w-6/12
				p-8
				rounded-lg
				shadow-lg
			"
		>
			<div class="">
				<div class="text-2xl font-semibold border-b-2 border-gray-400 pb-2">Registration</div>
				<div class="mt-2">
					<form action="" method="post" class="flex flex-col space-y-2">
						<div class="flex flex-col max-w-full">
							<label for="">Username</label>
							<input
								type="text"
								name="username"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Email</label>
							<input
								type="email"
								name="email"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Password</label>
							<input
								type="password"
								name="password"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Confirm Password</label>
							<input
								type="password"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="w-full">
							<button
								type="submit"
								name="submit"
								class="w-full mt-4 px-1 py-2 bg-blue-400 rounded-lg text-white text-xl"
							>
								Sign Up
							</button>
						</div>
					</form>
					<div class="flex mt-4 justify-center">
						<p class="text-md text-gray-600 pr-2">Already signed up?</p>
						<a href="login.php" class="text-md text-blue-600 font-semibold italic">Login</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
